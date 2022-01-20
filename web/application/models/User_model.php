<?php defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    private $_table = "user";

    public function masuk()
    {
        $post = $this->input->post();

        // cari user berdasarkan email dan username
        $this->db->where('emailUser', $post["email"])
            ->or_where('tlpnUser', $post["email"]);
        $user = $this->db->get($this->_table)->row();

        // jika user terdaftar
        if ($user) {
            // periksa password-nya
            $isPasswordTrue = md5($post["password"]);
            $passw = $user->passwordUser;
            // periksa role-nya
            //$isAdmin = $user->role == "admin";

            // jika password benar dan dia admin
            if ($isPasswordTrue == $passw) {
                // login sukses yay!
                $this->session->set_userdata(['user_logged' => $user]);
                $this->session->set_userdata('idMitra', $user->idUser);
                $this->session->set_userdata('nama', $user->nameUser);
                $this->session->set_userdata('status', $user->statusUser);
                $this->session->set_userdata('kontak', $user->tlpnUser);
                $this->session->set_userdata('email', $user->emailUser);
                $this->session->set_userdata('alamat', $user->alamatUser);
                //$this->_updateLastLogin($user->user_id);
                return true;
            } else {
                $this->session->set_flashdata('success', 'Wrong Password');
                return false;
            }
        } else {
            $this->session->set_flashdata('success', 'Email or Phone Number Not Found');
            return false;
        }

        // login gagal
        return false;
    }

    public function isNotLogin()
    {
        return $this->session->userdata('user_logged') === null;
    }

    private function _updateLastLogin($user_id)
    {
        $sql = "UPDATE {$this->_table} SET last_login=now() WHERE idKaryawan={$user_id}";
        $this->db->query($sql);
    }

    public function daftar()
    {
        $post = $this->input->post();

        $pass = md5($post['passwords']);

        $this->db->query("INSERT INTO user(
            nameUser,
            passwordUser,
            emailUser,
            kontakUser
        )VALUES(
            '1',
            '$post[namas]',
            '$pass',
            '$post[emails]',
            '$post[phones]'
        )");

        return true;
    }
}
