<?php

class Accounts extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("user_model");
        $this->load->library('form_validation');
    }

    public function index()
    {
        // jika form login disubmit
        if($this->input->post()){
            if($this->user_model->masuk()) redirect(site_url('admin/overview'));
        }

        // tampilkan halaman login
        $this->load->view("admin/login_page.php");
    }

    public function signup()
    {
        // tampilkan halaman login
        $this->load->view("admin/signup.php");
    }
    
    public function login()
    {
         // jika form login disubmit
        if($this->input->post()){
            if($this->user_model->masuk()) redirect(site_url('produks'));
        }

        // tampilkan halaman login
        $this->load->view("admin/login_page.php");
    }
    
    public function register()
    {
        if($this->input->post()){
            if($this->user_model->daftar()) redirect(site_url('accounts'));
        }
    }

    public function logout()
    {
        // hancurkan semua sesi
        $this->session->sess_destroy();
        redirect(site_url('admin/login'));
    }
}