<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
        $this->load->model("produk_model");
    }

	public function index()
	{
		//$this->load->view('admin/home');
		$data["produks"] = $this->produk_model->jointabel();
        $this->load->view("admin/home",$data);
	}

	public function about()
	{
		$this->load->view('about.php');
	}

	public function contact()
	{
		$this->load->view('contact.php');
	}
}
