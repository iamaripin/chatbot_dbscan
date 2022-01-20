<?php defined('BASEPATH') or exit('No direct script access allowed');

class Pertanyaan_model extends CI_Model
{
    private $_table = "pertanyaan";

    public $idPertanyaan;
    public $pertanyaan;
    public $jawaban;

    public function rules()
    {
        return [
            [
                'field' => 'pertanyaan',
                'label' => 'Name',
                'rules' => 'required'
            ],

            [
                'field' => 'jawaban',
                'label' => 'Keterangan',
                'rules' => 'required'
            ],

        ];
    }

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }

    public function jointabel()
    {
        $this->db->select('*');
        $this->db->from('pertanyaan');
        $query = $this->db->get();
        return $query->result();
    }

    public function getById($id)
    {
        return $this->db->get_where($this->_table, ["idPertanyaan" => $id])->row();
    }

    public function save()
    {
        $post = $this->input->post();
        $this->pertanyaan = $post["pertanyaan"];
        $this->jawaban = $post["jawaban"];
        $this->db->insert($this->_table, $this);
    }

    public function update()
    {

        $post = $this->input->post();
        $this->idPertanyaan = $post["id"];
        $this->pertanyaan = $post["pertanyaan"];
        $this->jawaban = $post["jawaban"];
        $this->db->update($this->_table, $this, array('idPertanyaan' => $post['id']));
    }

    public function delete($id)
    {
        return $this->db->delete($this->_table, array("idPertanyaan" => $id));
    }
}
