<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class docs extends CI_Controller
{

    public function index()
    {
        //$data["docs"] = $this->docs_model->jointabel();

        //if (!isset($id)) redirect(site_url('docs'));

        //$this->load->view("admin/docs/about",$data);
    }

    public function about()
    {
        //$data["docs"] = $this->docs_model->jointabel();
        $this->load->view("admin/docs/about.php");
    }

    public function store()
    {
        //$data["docs"] = $this->docs_model->jointabel();
        $this->load->view('admin/docs/store.php');
    }
    
    public function term()
    {
        //$data["docs"] = $this->docs_model->jointabel();
        $this->load->view('admin/docs/term.php');
    }

    public function refund()
    {
        //$data["docs"] = $this->docs_model->jointabel();
        $this->load->view('admin/docs/refund.php');
    }
    
}
