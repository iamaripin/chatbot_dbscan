<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("order_model");
        $this->load->library('form_validation');
		//$this->load->model("user_model");
		//if($this->user_model->isNotLogin()) redirect(site_url('admin/login'));
    }

    public function index()
    {
        //$data["orders"] = $this->order_model->jointabel();

       // $this->load->view("admin/order/list",$data);
        
    }
    public function history()
    {
        $data["orders"] = $this->order_model->jointabel();
        $this->load->view("admin/order/history",$data);
        
    }
    public function tracking($id=null)
    {
        $ids = decrypt_url($id);
        $order = $this->order_model;
        $data["order"] = $order->getBykode($ids);
        $this->load->view("admin/order/tracking", $data);
        
    }
    public function payment($id=null)
    {
        $ids = decrypt_url($id);
        $order = $this->order_model;
        $data["order"] = $order->getBykode($ids);
        $this->load->view("admin/order/payment", $data);
        
    }
    public function paymentsend()
    {
        $order = $this->order_model;
		$post = $this->input->post();
        //if ($post['image'] <> '') {
            $order->paymentsend();
            redirect(site_url('orders/history'));
       // }
        
    }
    public function det($id=null)
    {       
        $ids = decrypt_url($id);
        $order = $this->order_model;
        $data["order"] = $order->getById($ids);
        if (!$data["order"]) redirect('my404s');
        
        $this->load->view("admin/order/detail", $data);
        
    }

    
    public function sortproduk()
    {
        if ($this->input->post('x')) {
            echo $this->order_model->sortproduk($this->input->post('x'));
        }
    }
}
