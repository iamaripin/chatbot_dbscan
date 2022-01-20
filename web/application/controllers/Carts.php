<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Carts extends CI_Controller
{

    private $url = "https://api.rajaongkir.com/starter/";
    private $apiKey = "0890a6f07c9d59a2be080a034cb4ff0f";

    public function __construct()
    {
        parent::__construct();
        $this->load->model("cart_model");
        $this->load->library('form_validation');
		$this->load->model("user_model");
		//if($this->user_model->isNotLogin()) redirect(site_url('admin/login'));
    }

    public function index()
    {
        $data["carts"] = $this->cart_model->jointabel();
        $this->load->view("admin/cart/list",$data);
		
    }

	public function kosong()
    {
        $this->load->view("admin/cart/kosong");
		
    }

    public function plus($id=null)
    {
        if (!isset($id)) redirect('my404s');
        
        if ($this->cart_model->plus($id)) {
            redirect(site_url('carts'));
        }
    }
    public function minus($id=null)
    {
        if (!isset($id)) redirect('my404s');
        
        if ($this->cart_model->minus($id)) {
            redirect(site_url('carts'));
        }
    }

    public function delete($id=null)
    {
        if (!isset($id)) redirect('my404s');
        
        if ($this->cart_model->delete($id)) {
            redirect(site_url('carts'));
        }
    }

    public function oncheckout()
    {
        //if (!isset($id)) redirect('carts');
        //$checkout = $this->cart_model;        
        //$data["checkout"] = $checkout->insertcheckout();
        $data["checkout"] = $this->cart_model->jointabel();
		$this->load->view("admin/cart/checkout",$data);
    }
    
    public function checkoutx()
    {
        $checkout = $this->cart_model;        
        $data["checkout"] = $checkout->insertcheckout();
    }

    public function checkout($id=null)
    {
        $data["checkout"] = $this->cart_model->checkoutcode($id);
        $this->load->view("admin/cart/checkout",$data);
    }

    function _api_ongkir_post($origin,$des,$qty,$cour)
    {
  	  $curl = curl_init();
	  curl_setopt_array($curl, array(
	  CURLOPT_URL => "http://api.rajaongkir.com/starter/cost",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 30,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "POST",
	  CURLOPT_POSTFIELDS => "origin=".$origin."&destination=".$des."&weight=".$qty."&courier=".$cour,	  
	  CURLOPT_HTTPHEADER => array(
	    /*"content-type: application/x-www-form-urlencoded",*/
	    /* masukan api key disini*/
	    "key: ".$this->apiKey
		  ),
		));
		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		if ($err) {
		  return $err;
		} else {
		  return $response;
		}
   }
   function _api_ongkir($data)
   {
	   	$curl = curl_init();
		curl_setopt_array($curl, array(
		  CURLOPT_URL => "http://api.rajaongkir.com/starter/".$data,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",		  
		  CURLOPT_HTTPHEADER => array(
		  	/* masukan api key disini*/
            "key: ".$this->apiKey
		  ),
		));
		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		if ($err) {
		  return  $err;
		} else {
		  return $response;
		}
   }
	public function provinsi()
	{
		$provinsi = $this->_api_ongkir('province');
		$data = json_decode($provinsi, true);
		echo json_encode($data['rajaongkir']['results']);
	}
	
	public function kota($provinsi="")
	{
		if(!empty($provinsi))
		{
			if(is_numeric($provinsi))
			{
				$kota = $this->_api_ongkir('city?province='.$provinsi);	
				$data = json_decode($kota, true);
				echo json_encode($data['rajaongkir']['results']);		  					 
			}
			else
			{
				show_404();
			}
		}
	   else
	   {
	   	show_404();
	   }
	}
	public function tarif($origin,$des,$qty,$cour)
	{
		$berat = $qty*1000;
		$tarif = $this->_api_ongkir_post($origin,$des,$berat,$cour);		
		$data = json_decode($tarif, true);
		echo json_encode($data['rajaongkir']['results']);	
			
	}

	public function cekkupon()
	{
		if ($this->input->post('kupon')) {
            echo $this->cart_model->cekkupon($this->input->post('kupon'),$this->input->post('subtotal'));
        }

	}

	public function cekmitra()
	{
		if ($this->input->post('emailpembeli')) {
            echo $this->cart_model->cekmitra($this->input->post('emailpembeli'));
        }

	}
}
