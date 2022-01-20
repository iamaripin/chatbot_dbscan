<?php defined('BASEPATH') or exit('No direct script access allowed');

class Profil_model extends CI_Model
{
    private $_table = "user";

    public $idUser;
    public $nameUser;
    public $emailUser;
    public $passwordUser;
    public $statusUser;

    public function rules()
    {
        return [
            [
                'field' => 'nameUser',
                'label' => 'Nama',
                'rules' => 'required'
            ],

            [
                'field' => 'emailUser',
                'label' => 'Email',
                'rules' => 'required'
            ],

            [
                'field' => 'passwordUser',
                'label' => 'Password',
                'rules' => 'required'
            ],

            [
                'field' => 'statusUser',
                'label' => 'status',
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
        $this->db->select('*');
        $this->db->from('user');
        $query = $this->db->get();
        return $query->result();
    }

    public function getById($id)
    {
        return $this->db->get_where($this->_table, ["idUser" => $id])->row();
    }

    public function save()
    {
        $post = $this->input->post();
        $this->nameUser = $post["nameUser"];
        $this->emailUser = $post["emailUser"];
        $this->passwordUser = md5($post["passwordUser"]);
        $this->statusUser = $post["statusUser"];
        $this->db->insert($this->_table, $this);
    }

    public function update()
    {
        $post = $this->input->post();
        $te = md5($post["passwordUser"]);

        $this->db->query("UPDATE User SET passwordUser = '$te' WHERE idUser = '$post[id]'");
    }

    public function delete($id)
    {
        return $this->db->delete($this->_table, array("idUser" => $id));
    }
}
