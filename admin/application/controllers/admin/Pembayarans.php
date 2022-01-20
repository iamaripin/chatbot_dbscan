<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pembayarans extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("pembayaran_model");
        $this->load->library('form_validation');
		$this->load->model("user_model");
		if($this->user_model->isNotLogin()) redirect(site_url('admin/login'));
    }

    public function index()
    {
        $data["pembayarans"] = $this->pembayaran_model->jointabel();
        $this->load->view("admin/pembayaran/list", $data);
    }

    public function add()
    {
        $pembayaran = $this->pembayaran_model;
        //$validation = $this->form_validation;
        //$validation->set_rules($pembayaran->rules());

		$post = $this->input->post();
        if ($post['pesan'] <> '') {
            $pembayaran->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
            redirect(site_url('admin/pembayarans'));
        }

        $this->load->view("admin/pembayaran/new_form");
    }

    public function edit($id = null)
    {
        if (!isset($id)) redirect('admin/pembayarans');
       
        $pembayaran = $this->pembayaran_model;
        $validation = $this->form_validation;
        $validation->set_rules($pembayaran->rules());

        if ($validation->run()) {
            $pembayaran->update();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }

        $data["pembayaran"] = $pembayaran->getById($id);
        if (!$data["pembayaran"]) show_404();
        
        $this->load->view("admin/pembayaran/edit_form", $data);
    }

    public function delete($id=null)
    {
        if (!isset($id)) show_404();
        
        if ($this->pembayaran_model->delete($id)) {
            redirect(site_url('admin/pembayarans'));
        }
    }
	
	public function validasi($id=null)
    {
        if (!isset($id)) show_404();
        
        if ($this->pembayaran_model->validasi($id)) {
            redirect(site_url('admin/pembayarans'));
        }
    }
}
