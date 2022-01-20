<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pertanyaans extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("pertanyaan_model");
        $this->load->library('form_validation');
        $this->load->model("user_model");
        if ($this->user_model->isNotLogin()) redirect(site_url('admin/login'));
    }

    public function index()
    {
        $data["pertanyaans"] = $this->pertanyaan_model->getAll();
        $this->load->view("admin/pertanyaan/list", $data);
    }

    public function add()
    {
        $pertanyaan = $this->pertanyaan_model;
        $validation = $this->form_validation;
        $validation->set_rules($pertanyaan->rules());

        if ($validation->run()) {
            $pertanyaan->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }

        $this->load->view("admin/pertanyaan/new_form");
    }

    public function edit($id = null)
    {
        if (!isset($id)) redirect('admin/pertanyaans');

        $pertanyaan = $this->pertanyaan_model;
        $validation = $this->form_validation;
        $validation->set_rules($pertanyaan->rules());

        if ($validation->run()) {
            $pertanyaan->update();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
            redirect(site_url('admin/pertanyaans'));
        }

        $data["pertanyaan"] = $pertanyaan->getById($id);
        if (!$data["pertanyaan"]) show_404();

        $this->load->view("admin/pertanyaan/edit_form", $data);
    }

    public function delete($id = null)
    {
        if (!isset($id)) show_404();

        if ($this->pertanyaan_model->delete($id)) {
            redirect(site_url('admin/pertanyaans'));
        }
    }
}
