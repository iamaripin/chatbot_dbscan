<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pembayaran_model extends CI_Model
{
    private $_table = "bayar";

    public $idBantuan;
    public $pengirim;
    public $penerima;
    public $pesan;

    public function rules()
    {
        return [
            ['field' => 'pengirim',
            'label' => 'Name',
            'rules' => 'required'],

            ['field' => 'penerima',
            'label' => 'Price',
            'rules' => 'numeric'],
            
            ['field' => 'pesan',
            'label' => 'Description',
            'rules' => 'required']
        ];
    }

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }
	
	public function jointabel() {
		$this->db->select('*');
		$this->db->from('bayar');
		$this->db->join('orderan','bayar.kdOrder=orderan.kdOrder');
		$this->db->join('user','orderan.idUser=user.idUser');
		$this->db->group_by('orderan.kdOrder');
		$this->db->order_by('bayar.idBayar','desc');
		$query = $this->db->get();
		return $query->result();
	}
    
    public function getById($id)
    {
        return $this->db->get_where($this->_table, ["kdOrder" => $id])->row();
    }

    public function save()
    {
		//$idKaryawans = $this->session->userdata('idkaryawan');
        $post = $this->input->post();
		
    }
	
    public function validasi($id)
    {
		return $this->db->query("UPDATE orderan SET statusOrder = 'Pengiriman' WHERE kdOrder = '$id'");
    }

    public function update()
    {
        $post = $this->input->post();
    }

    public function delete($id)
    {
		$this->db->query("UPDATE orderan SET statusOrder = 'Order' WHERE kdOrder = '$id'");
        return $this->db->delete($this->_table, array("kdOrder" => $id));
    }
}
