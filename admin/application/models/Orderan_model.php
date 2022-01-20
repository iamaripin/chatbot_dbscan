<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Orderan_model extends CI_Model
{
    private $_table = "orderan";

    public $idPengajuan;
    public $idKaryawan;
    public $datePengajuan;
    public $periodePerjalanan;
    public $descPengajuan;
    public $nominalPengajuan;
    public $statusPengajuan;

    public function rules()
    {
        return [
            ['field' => 'idKaryawan',
            'label' => 'Judul',
            'rules' => 'required'],
			
            ['field' => 'descPengajuan',
            'label' => 'Deskripsi',
            'rules' => 'required'],
            
            ['field' => 'datePengajuan',
            'label' => 'Tanggal',
            'rules' => 'required'],
			
            ['field' => 'nominalPengajuan',
            'label' => 'Nominal',
            'rules' => 'required'],
			
            ['field' => 'periodePerjalanan',
            'label' => 'Perjalanan',
            'rules' => 'required'],
			
            ['field' => 'imgBerita',
            'label' => 'Bukti Perjalanan',
            'rules' => 'required'],
			
            ['field' => 'norek',
            'label' => 'No Rekening',
            'rules' => 'required'],			
			
            ['field' => 'anrek',
            'label' => 'Atas Nama',
            'rules' => 'required'],
			
            ['field' => 'bankrek',
            'label' => 'Bank',
            'rules' => 'required']
        ];
    }

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }
	public function jointabel() {
		//$idKaryawans = $this->session->userdata('idkaryawan');
		
		$this->db->select('*');
		$this->db->from('orderan');
		$this->db->join('user','user.idUser=orderan.idUser');
		$this->db->group_by('orderan.kdOrder'); 
		$this->db->order_by('orderan.dateOrder', 'desc'); 
		$this->db->order_by('orderan.kdOrder', 'desc'); 
		$query = $this->db->get();
		return $query->result();
	}
	
	    
    public function getById($id)
    {
        return $this->db->get_where($this->_table, ["kdOrder" => $id])->row();
    }

    public function save()
    {
        $post = $this->input->post();
    }

    public function update()
    {
        $post = $this->input->post();
    }

    public function delete($id)
    {
        return $this->db->delete($this->_table, array("kdOrder" => $id));
    }
	
}
