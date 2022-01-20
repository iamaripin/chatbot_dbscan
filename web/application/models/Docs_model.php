<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Docs_model extends CI_Model
{
    public function jointabel() {
		$this->db->select('*');
		$this->db->from('setting');
		$query = $this->db->get();
		return $query->result();
	}
}
?>