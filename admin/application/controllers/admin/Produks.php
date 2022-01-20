<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Produks extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("produk_model");
        $this->load->library('form_validation');
		$this->load->model("user_model");
		if($this->user_model->isNotLogin()) redirect(site_url('admin/login'));
    }

    public function index()
    {
        $data["produks"] = $this->produk_model->jointabel();
        $this->load->view("admin/produk/list", $data);
    }

    public function add()
    {
        $produk = $this->produk_model;
        $validation = $this->form_validation;
        $validation->set_rules($produk->rules());

        $post = $this->input->post();
        if ($post['nameProduk'] <> '') {
            $produk->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
            redirect(site_url('admin/produks'));
        }

        $this->load->view("admin/produk/new_form");
    }
	
    public function edit($id = null)
    {
        if (!isset($id)) redirect('admin/produks');
       
        $produk = $this->produk_model;
        $validation = $this->form_validation;
        $validation->set_rules($produk->rules());

       $post = $this->input->post();
        if ($post['id'] <> '') {
            $produk->update();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
            redirect(site_url('admin/produks'));
        }

        $data["produk"] = $produk->getById($id);
        if (!$data["produk"]) show_404();
        
        $this->load->view("admin/produk/edit_form", $data);
    }

    public function delete($id=null)
    {
        if (!isset($id)) show_404();
        
        if ($this->produk_model->delete($id)) {
            redirect(site_url('admin/produks'));
        }
    }
	
}
