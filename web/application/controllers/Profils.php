<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Profils extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("profil_model");
        $this->load->library('form_validation');
		$this->load->model("user_model");
		if($this->user_model->isNotLogin()) redirect(site_url('admin/login'));
    }

    public function index()
    {
        $data["profils"] = $this->profil_model->jointabel();
        $this->load->view("admin/profil/edit_form", $data);
    }

    public function add()
    {
        $profil = $this->profil_model;
        $validation = $this->form_validation;
        $validation->set_rules($profil->rules());

        if ($validation->run()) {
            $profil->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
            redirect(site_url('admin/profils'));
        }

        $this->load->view("admin/profil/new_form");
    }

    public function edit($id = null)
    {
        if (!isset($id)) redirect('admin/profils');
       
        $profil = $this->profil_model;
        $validation = $this->form_validation;
        $validation->set_rules($profil->rules());

        $post = $this->input->post();
        if ($post['passwordKaryawan'] <> '') {
            $profil->update();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
            redirect(site_url('admin'));
        }

        $data["profil"] = $profil->getById($id);
        if (!$data["profil"]) show_404();
        
        $this->load->view("admin/profil/edit_form", $data);
    }

    public function delete($id=null)
    {
        if (!isset($id)) show_404();
        
        if ($this->profil_model->delete($id)) {
            redirect(site_url('admin/profils'));
        }
    }
}
