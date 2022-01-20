<?php defined('BASEPATH') or exit('No direct script access allowed');

class Produk_model extends CI_Model
{
    private $_table = "produk";

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

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }

    public function jointabel()
    {
        $this->db->select('idProduk, nameProduk, hargaProduk, imgProduk');
        $this->db->from('produk');
        $query = $this->db->get();
        return $query->result();
    }

    public function getById($id)
    {

        $linkproduk = str_replace("-", " ", $id);
        return $this->db->get_where($this->_table, ["nameProduk" => $linkproduk])->row();
    }

    public function getBykategori($id)
    {

        $this->db->select('idProduk, nameProduk, hargaProduk, imgProduk,katProduk');
        $this->db->from('produk');
        $this->db->like('katProduk', $id);
        $query = $this->db->get();
        return $query->result();

        //$linkproduk = str_replace("-"," ",$id);
        //return $this->db->get_where($this->_table, ["katProduk" => $linkproduk])->row();
    }

    public function cariproduk()
    {
        //$post = $this->input->post();
        $cari = $this->input->GET('search', TRUE);
        $this->db->select('idProduk, nameProduk, hargaProduk, imgProduk');
        $this->db->from('produk');
        $this->db->like('nameProduk', $cari);
        $query = $this->db->get();
        return $query->result();
        //return $this->db->get_where($this->_table, ["nameProduk" => $post["search"]])->row();
    }

    public function sortproduk($x, $i)
    {
        if ($i != "") {
            if ($x == 1) {
                $this->db->select('idProduk, nameProduk, hargaProduk, imgProduk');
                $this->db->from('produk');
                $this->db->where('katProduk=', $i);
                $this->db->order_by('hargaProduk', 'ASC');
                $query = $this->db->get();
                $resultproduk = $query->result_array();

                foreach ($resultproduk as $pro) :
                    $linkproduk = str_replace(" ", "-", $pro['nameProduk']);
                    $harga = number_format($pro['hargaProduk'], 0, ',', '.');

                    echo '
                <div class="col-lg-3 col-md-4 col-sm-6 col-6 mb-4 ">
                    <a href="' . site_url('produks/det/' . $linkproduk) . '" class="text-decoration-none text-dark">
                    <div class="card bg-transparent">
                    <img src="' . $pro['imgProduk'] . '" class="card-img-top imgcard" alt="...">
                    <div class="card-body">
                        <div style="width: 100%;overflow: hidden; text-overflow: ellipsis;white-space: nowrap;text-align:center"> ' . $pro['nameProduk'] . '</div>
                        <div class="text-center"><strong> Rp ' . $harga . '</strong></div>
                        
                    </div>
                    </div>
                    </a>
                </div>';

                endforeach;

                return;
            } else if ($x == 2) {
                $this->db->select('idProduk, nameProduk, hargaProduk, imgProduk');
                $this->db->from('produk');
                $this->db->where('katProduk=', $i);
                $this->db->order_by('hargaProduk', 'DESC');
                $query = $this->db->get();
                $resultproduk = $query->result_array();

                foreach ($resultproduk as $pro) :
                    $linkproduk = str_replace(" ", "-", $pro['nameProduk']);
                    $harga = number_format($pro['hargaProduk'], 0, ',', '.');

                    echo '
                <div class="col-lg-3 col-md-4 col-sm-6 col-6 mb-4 ">
                    <a href="' . site_url('produks/det/' . $linkproduk) . '" class="text-decoration-none text-dark">
                    <div class="card bg-transparent">
                    <img src="' . $pro['imgProduk'] . '" class="card-img-top imgcard" alt="...">
                    <div class="card-body">
                        <div style="width: 100%;overflow: hidden; text-overflow: ellipsis;white-space: nowrap;text-align:center"> ' . $pro['nameProduk'] . '</div>
                        <div class="text-center"><strong> Rp ' . $harga . '</strong></div>
                        
                    </div>
                    </div>
                    </a>
                </div>';

                endforeach;

                return;
            } else if ($x == 3) {
                $this->db->select('idProduk, nameProduk, hargaProduk, imgProduk');
                $this->db->from('produk');
                $this->db->where('katProduk=', $i);
                $this->db->order_by('nameProduk', 'ASC');
                $query = $this->db->get();
                $resultproduk = $query->result_array();

                foreach ($resultproduk as $pro) :
                    $linkproduk = str_replace(" ", "-", $pro['nameProduk']);
                    $harga = number_format($pro['hargaProduk'], 0, ',', '.');

                    echo '
                <div class="col-lg-3 col-md-4 col-sm-6 col-6 mb-4 ">
                    <a href="' . site_url('produks/det/' . $linkproduk) . '" class="text-decoration-none text-dark">
                    <div class="card bg-transparent">
                    <img src="' . $pro['imgProduk'] . '" class="card-img-top imgcard" alt="...">
                    <div class="card-body">
                        <div style="width: 100%;overflow: hidden; text-overflow: ellipsis;white-space: nowrap;text-align:center"> ' . $pro['nameProduk'] . '</div>
                        <div class="text-center"><strong> Rp ' . $harga . '</strong></div>
                        
                    </div>
                    </div>
                    </a>
                </div>';

                endforeach;

                return;
            } else if ($x == 4) {
                $this->db->select('idProduk, nameProduk, hargaProduk, imgProduk');
                $this->db->from('produk');
                $this->db->where('katProduk=', $i);
                $this->db->order_by('nameProduk', 'DESC');
                $query = $this->db->get();
                $resultproduk = $query->result_array();

                foreach ($resultproduk as $pro) :
                    $linkproduk = str_replace(" ", "-", $pro['nameProduk']);
                    $harga = number_format($pro['hargaProduk'], 0, ',', '.');

                    echo '
                <div class="col-lg-3 col-md-4 col-sm-6 col-6 mb-4 ">
                    <a href="' . site_url('produks/det/' . $linkproduk) . '" class="text-decoration-none text-dark">
                    <div class="card bg-transparent">
                    <img src="' . $pro['imgProduk'] . '" class="card-img-top imgcard" alt="...">
                    <div class="card-body">
                        <div style="width: 100%;overflow: hidden; text-overflow: ellipsis;white-space: nowrap;text-align:center"> ' . $pro['nameProduk'] . '</div>
                        <div class="text-center"><strong> Rp ' . $harga . '</strong></div>
                        
                    </div>
                    </div>
                    </a>
                </div>';

                endforeach;

                return;
            }
        } else {
            if ($x == 1) {
                $this->db->select('idProduk, nameProduk, hargaProduk, imgProduk');
                $this->db->from('produk');
                $this->db->order_by('hargaProduk', 'ASC');
                $query = $this->db->get();
                $resultproduk = $query->result_array();

                foreach ($resultproduk as $pro) :
                    $linkproduk = str_replace(" ", "-", $pro['nameProduk']);
                    $harga = number_format($pro['hargaProduk'], 0, ',', '.');

                    echo '
                <div class="col-lg-3 col-md-4 col-sm-6 col-6 mb-4 ">
                    <a href="' . site_url('produks/det/' . $linkproduk) . '" class="text-decoration-none text-dark">
                    <div class="card bg-transparent">
                    <img src="' . $pro['imgProduk'] . '" class="card-img-top imgcard" alt="...">
                    <div class="card-body">
                        <div style="width: 100%;overflow: hidden; text-overflow: ellipsis;white-space: nowrap;text-align:center"> ' . $pro['nameProduk'] . '</div>
                        <div class="text-center"><strong> Rp ' . $harga . '</strong></div>
                        
                    </div>
                    </div>
                    </a>
                </div>';

                endforeach;

                return;
            } else if ($x == 2) {
                $this->db->select('idProduk, nameProduk, hargaProduk, imgProduk');
                $this->db->from('produk');
                $this->db->order_by('hargaProduk', 'DESC');
                $query = $this->db->get();
                $resultproduk = $query->result_array();

                foreach ($resultproduk as $pro) :
                    $linkproduk = str_replace(" ", "-", $pro['nameProduk']);
                    $harga = number_format($pro['hargaProduk'], 0, ',', '.');

                    echo '
                <div class="col-lg-3 col-md-4 col-sm-6 col-6 mb-4 ">
                    <a href="' . site_url('produks/det/' . $linkproduk) . '" class="text-decoration-none text-dark">
                    <div class="card bg-transparent">
                    <img src="' . $pro['imgProduk'] . '" class="card-img-top imgcard" alt="...">
                    <div class="card-body">
                        <div style="width: 100%;overflow: hidden; text-overflow: ellipsis;white-space: nowrap;text-align:center"> ' . $pro['nameProduk'] . '</div>
                        <div class="text-center"><strong> Rp ' . $harga . '</strong></div>
                        
                    </div>
                    </div>
                    </a>
                </div>';

                endforeach;

                return;
            } else if ($x == 3) {
                $this->db->select('idProduk, nameProduk, hargaProduk, imgProduk');
                $this->db->from('produk');
                $this->db->order_by('nameProduk', 'ASC');
                $query = $this->db->get();
                $resultproduk = $query->result_array();

                foreach ($resultproduk as $pro) :
                    $linkproduk = str_replace(" ", "-", $pro['nameProduk']);
                    $harga = number_format($pro['hargaProduk'], 0, ',', '.');

                    echo '
                <div class="col-lg-3 col-md-4 col-sm-6 col-6 mb-4 ">
                    <a href="' . site_url('produks/det/' . $linkproduk) . '" class="text-decoration-none text-dark">
                    <div class="card bg-transparent">
                    <img src="' . $pro['imgProduk'] . '" class="card-img-top imgcard" alt="...">
                    <div class="card-body">
                        <div style="width: 100%;overflow: hidden; text-overflow: ellipsis;white-space: nowrap;text-align:center"> ' . $pro['nameProduk'] . '</div>
                        <div class="text-center"><strong> Rp ' . $harga . '</strong></div>
                        
                    </div>
                    </div>
                    </a>
                </div>';

                endforeach;

                return;
            } else if ($x == 4) {
                $this->db->select('idProduk, nameProduk, hargaProduk, imgProduk');
                $this->db->from('produk');
                $this->db->order_by('nameProduk', 'DESC');
                $query = $this->db->get();
                $resultproduk = $query->result_array();

                foreach ($resultproduk as $pro) :
                    $linkproduk = str_replace(" ", "-", $pro['nameProduk']);
                    $harga = number_format($pro['hargaProduk'], 0, ',', '.');

                    echo '
                <div class="col-lg-3 col-md-4 col-sm-6 col-6 mb-4 ">
                    <a href="' . site_url('produks/det/' . $linkproduk) . '" class="text-decoration-none text-dark">
                    <div class="card bg-transparent">
                    <img src="' . $pro['imgProduk'] . '" class="card-img-top imgcard" alt="...">
                    <div class="card-body">
                        <div style="width: 100%;overflow: hidden; text-overflow: ellipsis;white-space: nowrap;text-align:center"> ' . $pro['nameProduk'] . '</div>
                        <div class="text-center"><strong> Rp ' . $harga . '</strong></div>
                        
                    </div>
                    </div>
                    </a>
                </div>';

                endforeach;

                return;
            }
        }
    }

    public function addtocart()
    {
        $post = $this->input->post();
        $ids = session_id();

        $subtotal = $post["qty"] * $post["harga"];

        $this->db->query("INSERT INTO temp(
            idProduk,
            qtyTemp,
            hargaTemp,
            subtotalTemp,
            statusTemp,
            idUser
        )VALUES(
            '$post[idProduk]',
            '$post[qty]',
            '$post[harga]',
            '$subtotal',
            'Jual',
            '$ids'
        )");
    }

    public function update()
    {

        date_default_timezone_set('Asia/Jakarta');
        $waktu = date('H:i:s');
        $tanggal = date('Y-m-d');

        $post = $this->input->post();
        $this->db->query("UPDATE produk SET balas = '$post[balas]',tanggalbalas = '$tanggal' WHERE idproduk = '$post[id]'");
    }

    public function delete($id)
    {
        return $this->db->delete($this->_table, array("idproduk" => $id));
    }
}
