<?php defined('BASEPATH') or exit('No direct script access allowed');

class Cart_model extends CI_Model
{
    private $_table = "temp";

    public $idProduk;
    public $nameProduk;
    public $imgProduk;
    public $hargaProduk;

    public function rules()
    {
        return [
            [
                'field' => 'pengirim',
                'label' => 'Name',
                'rules' => 'required'
            ],

            [
                'field' => 'penerima',
                'label' => 'Price',
                'rules' => 'numeric'
            ],

            [
                'field' => 'pesan',
                'label' => 'Description',
                'rules' => 'required'
            ]
        ];
    }

    public function jointabel()
    {
        $ids = session_id();
        $this->db->select('temp.*,produk.kdProduk,produk.nameProduk,produk.imgProduk');
        $this->db->from('produk');
        $this->db->join('temp', 'temp.idProduk=produk.idProduk');
        $this->db->where('temp.idUser=', $ids);
        $query = $this->db->get();
        $datas = $query->result_array();
        $hasilcek = count($datas);

        if ($hasilcek > 0) {
            return $query->result();
        } else {
            redirect(site_url('carts/kosong'));
        }
    }

    public function plus($id)
    {
        $this->db->select('qtyTemp,hargaTemp');
        $this->db->from('temp');
        $this->db->where('idTemp=', $id);
        $query = $this->db->get();
        $resultproduk = $query->result_array();
        foreach ($resultproduk as $pro) {
            $qty = $pro['qtyTemp'] + 1;
            $subtotal = $pro['hargaTemp'] * $qty;
        }

        return $this->db->query("UPDATE temp SET qtyTemp = '$qty',subtotalTemp = '$subtotal' WHERE idTemp = '$id'");
    }

    public function minus($id)
    {
        $this->db->select('qtyTemp,hargaTemp');
        $this->db->from('temp');
        $this->db->where('idTemp=', $id);
        $query = $this->db->get();
        $resultproduk = $query->result_array();
        foreach ($resultproduk as $pro) {
            $qty = $pro['qtyTemp'] - 1;
            if ($qty <= 0) {
                $this->db->query("DELETE FROM temp WHERE idTemp = '$id'");
            } else {
                $qty = $qty;
            }
            $subtotal = $pro['hargaTemp'] * $qty;
        }

        return $this->db->query("UPDATE temp SET qtyTemp = '$qty',subtotalTemp = '$subtotal' WHERE idTemp = '$id'");
    }

    public function insertcheckout()
    {
        $ids = session_id();
        $post = $this->input->post();
        $date = date("Y-m-d");
        //$idMitra = $this->session->userdata('idMitra');

        if ($this->session->userdata('idMitra') != '') {
            $idMitra = $this->session->userdata('idMitra');
        } else {
            $this->db->select('idUser');
            $this->db->from('user');
            $this->db->where('user.emailUser=', $post['emailpembeli']);
            $querymit = $this->db->get();
            $resultmitra = $querymit->result_array();
            $jumlahmitra = count($resultmitra);


            if ($jumlahmitra == 0) {
                $pass = md5($post['emailpembeli']);

                $this->db->query("INSERT INTO user(
                    nameUser,
                    passwordUser,
                    emailUser,
                    tlpnUser,
                    alamatUser
                )VALUES(
                    '$post[namapembeli]',
                    '$pass',
                    '$post[emailpembeli]',
                    '$post[kontakpembeli]',
                    '$post[alamatpembeli]'
                )");

                $this->db->select('idUser');
                $this->db->from('user');
                $this->db->where('user.emailUser=', $post['emailpembeli']);
                $querymits = $this->db->get();
                $resultmitras = $querymits->result_array();
                $idMitra = $resultmitras[0]['idUser'];
            } else {
                $idMitra = $resultmitra[0]['idUser'];
            }
        }

        $q = $this->db->query("SELECT MAX(RIGHT(kdOrder,4)) AS kd_max FROM orderan WHERE DATE(dateOrder)=CURDATE()");
        $kd = "";
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $k) {
                $tmp = ((int)$k->kd_max) + 1;
                $kd = sprintf("%04s", $tmp);
            }
        } else {
            $kd = "0001";
        }
        date_default_timezone_set('Asia/Jakarta');
        $kdOrder = date('dmy') . $kd;

        $this->db->select('*');
        $this->db->from('temp');
        $this->db->where('temp.idUser=', $ids);
        $query = $this->db->get();
        $resultproduk = $query->result_array();

        $time = date("H:i:s");

        foreach ($resultproduk as $pro) :
            $this->db->query("INSERT INTO orderan (
                                                idUser,
                                                dateOrder,
                                                timeOrder,
                                                kdOrder,
                                                idProduk,
                                                qtyOrder,
                                                hargaOrder,
                                                subtotalOrder,
                                                descOrder,
                                                ongkirOrder
                                            ) VALUES (
                                                '$idMitra',
                                                '$date',
                                                '$time',
                                                '$kdOrder',
                                                '$pro[idProduk]',
                                                '$pro[qtyTemp]',
                                                '$pro[hargaTemp]',
                                                '$pro[subtotalTemp]',
                                                '$post[alamatpembeli] $post[sel22] $post[kodepos] $post[kurir]',
                                                '$post[ongkirbeli]'
                                            )");

            $this->db->query("DELETE FROM temp WHERE idTemp='$pro[idTemp]'");
        endforeach;

        redirect(site_url('orders/det/' . encrypt_url($kdOrder)));
    }

    public function checkoutcode($id)
    {
        $this->db->select('jual.*,produk.imgProduk,produk.nameProduk');
        $this->db->from('jual');
        $this->db->join('produk', 'produk.idProduk=jual.idProduk');
        $this->db->where('jual.kdOrder=', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function cekkupon($kupon, $subtotal)
    {

        $this->db->select('kdPromo,berlakuPromo,namePromo,potPromo');
        $this->db->from('promo');
        $this->db->where('kdPromo=', $kupon);
        $query = $this->db->get();
        $resultproduk = $query->result_array();
        $jumlah = count($resultproduk);
        if ($jumlah == 0) {
            $potongans = 0;
        } else {
            foreach ($resultproduk as $pro) {
                $potongans = $pro['potPromo'] / 100;
            }
        }
        $potongan = $potongans * $subtotal;

        return $potongan;
    }

    public function cekmitra($emailpembeli)
    {

        $this->db->select('nameMitra,kontakMitra,pengirimanMitra,kodeposMitra');
        $this->db->from('mitra');
        $this->db->where('emailMitra=', $emailpembeli);
        $query = $this->db->get();
        $resultproduk = $query->result_array();
        $jumlah = count($resultproduk);
        if ($jumlah == 0) {
            $mitra = ";;;";
        } else {
            foreach ($resultproduk as $pro) {
                $mitra = "$pro[nameMitra];$pro[kontakMitra];$pro[pengirimanMitra];$pro[kodeposMitra]";
            }
        }

        return $mitra;
    }

    public function delete($id)
    {
        return $this->db->delete($this->_table, array("idTemp" => $id));
    }
}
