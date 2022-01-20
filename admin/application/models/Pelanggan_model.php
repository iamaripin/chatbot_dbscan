<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan_model extends CI_Model
{
    private $_table = "user";

    public $idUser;
    public $nameUser;
    public $emailUser;
    public $passwordUser;
    public $tlpnUser;
    public $statusUser;
    public $alamatUser;

    public function rules()
    {
        return [
            ['field' => 'nameUser',
            'label' => 'Nama',
            'rules' => 'required'],

            ['field' => 'emailUser',
            'label' => 'Email',
            'rules' => 'required'],
            
            ['field' => 'passwordUser',
            'label' => 'Password',
            'rules' => 'required'],
			
            ['field' => 'tlpnUser',
            'label' => 'Kontak',
            'rules' => 'required'],
												
            ['field' => 'alamatUser',
            'label' => 'Alamat',
            'rules' => 'required']
        ];
    }

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }
	public function jointabel() {
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('user.statusUser', 'Pelanggan');
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
        $this->tlpnUser = $post["tlpnUser"];
        $this->statusUser = $post["statusUser"];
        $this->alamatUser = $post["alamatUser"];
        $this->db->insert($this->_table, $this);
    }

    public function update()
    {
		$post = $this->input->post();

		if($post["passwordUser"] == ""){
			
			$this->db->query("UPDATE user SET nameUser = '$post[nameUser]',
										emailUser = '$post[emailUser]',
										tlpnUser = '$post[tlpnUser]',
										statusUser = '$post[statusUser]',
										alamatUser = '$post[alamatUser]'
									WHERE idUser = '$post[id]'");
		}else{
			$pass = md5($post["passwordUser"]);
				$this->db->query("UPDATE user SET nameUser = '$post[nameUser]',
										emailUser = '$post[emailUser]',
										tlpnUser = '$post[tlpnUser]',
										statusUser = '$post[statusUser]',
										alamatUser = '$post[alamatUser]',
										passwordUser = '$pass'
									WHERE idUser = '$post[id]'");
		}
    }

    public function delete($id)
    {
        return $this->db->delete($this->_table, array("idUser" => $id));
    }
}
