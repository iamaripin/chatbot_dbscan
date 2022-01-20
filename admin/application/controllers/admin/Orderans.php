<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Orderans extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("orderan_model");
        $this->load->library('form_validation');
		$this->load->model("user_model");
		if($this->user_model->isNotLogin()) redirect(site_url('admin/login'));
    }

    public function index()
    {
        $data["orderans"] = $this->orderan_model->jointabel();
        $this->load->view("admin/orderan/list", $data);
    }

    public function add()
    {
        $orderan = $this->orderan_model;
        $validation = $this->form_validation;
        $validation->set_rules($orderan->rules());
		
		$post = $this->input->post();

        //$this->load->view("admin/orderan/new_form");
    }
		
    public function edit($id = null)
    {
        if (!isset($id)) redirect('admin/orderans');
       
        $orderan = $this->orderan_model;
        $validation = $this->form_validation;
        $validation->set_rules($orderan->rules());

        if ($validation->run()) {
            $orderan->update();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
            redirect(site_url('admin/orderans'));
        }

        $data["orderan"] = $orderan->getById($id);
        if (!$data["orderan"]) show_404();
        
        $this->load->view("admin/orderan/edit_form", $data);
    }

    public function delete($id=null)
    {
        if (!isset($id)) show_404();
        
        if ($this->orderan_model->delete($id)) {
            redirect(site_url('admin/orderans'));
        }
    }
	
}
