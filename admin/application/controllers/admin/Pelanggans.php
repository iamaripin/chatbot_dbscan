<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggans extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("pelanggan_model");
        $this->load->library('form_validation');
		$this->load->model("user_model");
		if($this->user_model->isNotLogin()) redirect(site_url('admin/login'));
    }

    public function index()
    {
        $data["pelanggans"] = $this->pelanggan_model->jointabel();
        $this->load->view("admin/pelanggan/list", $data);
    }

    public function add()
    {
        $pelanggan = $this->pelanggan_model;
        $validation = $this->form_validation;
        $validation->set_rules($pelanggan->rules());

        if ($validation->run()) {
            $pelanggan->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
            redirect(site_url('admin/pelanggans'));
        }

        $this->load->view("admin/pelanggan/new_form");
    }

    public function edit($id = null)
    {
        if (!isset($id)) redirect('admin/pelanggans');
       
        $pelanggan = $this->pelanggan_model;
        $validation = $this->form_validation;
        $validation->set_rules($pelanggan->rules());

        $post = $this->input->post();
        if ($post['id'] <> '') {
            $pelanggan->update();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
            redirect(site_url('admin/pelanggans'));
        }

        $data["pelanggan"] = $pelanggan->getById($id);
        if (!$data["pelanggan"]) show_404();
        
        $this->load->view("admin/pelanggan/edit_form", $data);
    }

    public function delete($id=null)
    {
        if (!isset($id)) show_404();
        
        if ($this->pelanggan_model->delete($id)) {
            redirect(site_url('admin/pelanggans'));
        }
    }
}
