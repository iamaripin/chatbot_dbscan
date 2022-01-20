<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Laporanchat_model extends CI_Model
{
    private $_table = "orderan";

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }
    
    
}
