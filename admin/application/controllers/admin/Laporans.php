<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Laporans extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("laporan_model");
        $this->load->library('form_validation');
		$this->load->model("user_model");
		if($this->user_model->isNotLogin()) redirect(site_url('admin/login'));
    }

    public function index()
    {
        $data["laporans"] = $this->laporan_model->getAll();
        $this->load->view("admin/laporan/list", $data);
    }

    public function add()
    {
        $laporan = $this->laporan_model;
        $validation = $this->form_validation;
        $validation->set_rules($laporan->rules());

        if ($validation->run()) {
            $laporan->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
			redirect(site_url('admin/laporans'));
        }

        $this->load->view("admin/laporan/new_form");
    }

    public function edit($id = null)
    {
        if (!isset($id)) redirect('admin/laporans');
       
        $laporan = $this->laporan_model;
        $validation = $this->form_validation;
        $validation->set_rules($laporan->rules());

        if ($validation->run()) {
            $laporan->update();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
			redirect(site_url('admin/laporans'));
        }

        $data["laporan"] = $laporan->getById($id);
        if (!$data["laporan"]) show_404();
        
        $this->load->view("admin/laporan/edit_form", $data);
    }

    public function delete($id=null)
    {
        if (!isset($id)) show_404();
        
        if ($this->laporan_model->delete($id)) {
            redirect(site_url('admin/laporans'));
        }
    }
}
