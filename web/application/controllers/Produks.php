<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Produks extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("produk_model");
        $this->load->library('form_validation');
		//$this->load->model("user_model");
		//if($this->user_model->isNotLogin()) redirect(site_url('admin/login'));
    }

    public function index()
    {
        $data["produks"] = $this->produk_model->jointabel();

        //if (!isset($id)) {
            $this->load->view("admin/produk/list",$data);
        //}else{

            //$this->load->view("admin/produk/list");

           // $produk = $this->produk_model;
           // $data["produk"] = $produk->getBykategori($id);
            //if (!$data["produk"]) redirect('my404s');
            
            //$this->load->view("admin/produk/kategori_form", $data);
       // }
    }

    public function addtocart()
    {
        $produk = $this->produk_model;
        $post = $this->input->post();
        if ($post['qty'] <> '') {
            $produk->addtocart();
            //$this->session->set_flashdata('success', 'Berhasil disimpan');
        }

        $linkproduk = str_replace(" ","-",$post['namabarang']);
        //redirect(site_url('produks/det/'.$linkproduk));
        redirect(site_url('carts'));
    }

    
    public function cari()
    {
        $data2['search'] = $this->produk_model->cariproduk();
		$this->load->view('admin/produk/cari', $data2);
    }

    public function edit($id = null)
    {
        if (!isset($id)) redirect('produks');
       
        $produk = $this->produk_model;
		/*
		$post = $this->input->post();
        if ($post['balas'] <> '') {
            $produk->update();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
            redirect(site_url('admin/produks'));
        }
        */
        $data["produk"] = $produk->getById($id);
        if (!$data["produk"]) redirect('my404s');
        
        $this->load->view("admin/produk/edit_form", $data);
    }

    public function kategori($id = null)
    {
        if (!isset($id)) redirect('produks');
       
        $produk = $this->produk_model;
        $data["produk"] = $produk->getBykategori($id);
        if (!$data["produk"]) redirect('my404s');
        
        $this->load->view("admin/produk/kategori_form", $data);
    }

    public function det($id = null)
    {
        if (!isset($id)) redirect('produks');
       
        $produk = $this->produk_model;
		/*
		$post = $this->input->post();
        if ($post['balas'] <> '') {
            $produk->update();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
            redirect(site_url('admin/produks'));
        }
        */
       $data["produk"] = $produk->getById($id);
       if (!$data["produk"]) redirect('my404s');
        
        $this->load->view("admin/produk/edit_form", $data);
    }

    public function sortproduk()
    {
        if ($this->input->post('x')) {
            echo $this->produk_model->sortproduk($this->input->post('x'),$this->input->post('i'));
        }
    }

    public function delete($id=null)
    {
        if (!isset($id)) redirect('my404s');
        
        if ($this->produk_model->delete($id)) {
            redirect(site_url('admin/produks'));
        }
    }
}
