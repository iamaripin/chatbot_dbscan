<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_model extends CI_Model
{
    private $_table = "orderan";

    public $idDepartemen;
    public $nameDepartemen;
    public $descDepartemen;
    public $manajerDepartemen;
    public $emailDepartemen;
    public $kodebiayaDepartemen;

    public function rules()
    {
        return [
            ['field' => 'nameDepartemen',
            'label' => 'Nama',
            'rules' => 'required'],

            ['field' => 'descDepartemen',
            'label' => 'Keterangan',
            'rules' => 'required'],
            

            ['field' => 'manajerDepartemen',
            'label' => 'Manager',
            'rules' => 'required'],

            ['field' => 'emailDepartemen',
            'label' => 'Email',
            'rules' => 'required'],

            ['field' => 'kodebiayaDepartemen',
            'label' => 'Kode Biaya',
            'rules' => 'required'],
        ];
    }

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }
    
    public function getById($id)
    {
        return $this->db->get_where($this->_table, ["kdOrder" => $id])->row();
    }

    public function save()
    {
        $post = $this->input->post();
        $this->nameDepartemen = $post["nameDepartemen"];
        $this->descDepartemen = $post["descDepartemen"];
        $this->manajerDepartemen = $post["manajerDepartemen"];
        $this->emailDepartemen = $post["emailDepartemen"];
        $this->kodebiayaDepartemen = $post["kodebiayaDepartemen"];
        $this->db->insert($this->_table, $this);
    }

    public function update()
    {
        $post = $this->input->post();
        $this->idDepartemen = $post["id"];
        $this->nameDepartemen = $post["nameDepartemen"];
        $this->descDepartemen = $post["descDepartemen"];
        $this->manajerDepartemen = $post["manajerDepartemen"];
        $this->emailDepartemen = $post["emailDepartemen"];
        $this->kodebiayaDepartemen = $post["kodebiayaDepartemen"];
        $this->db->update($this->_table, $this, array('idDepartemen' => $post['id']));
    }

    public function delete($id)
    {
        return $this->db->delete($this->_table, array("idDepartemen" => $id));
    }
}
