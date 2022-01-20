<?php defined('BASEPATH') OR exit('No direct script access allowed');

class coupon_model extends CI_Model
{
    
	public function jointabel() {
		$this->db->select('kdPromo,berlakuPromo,namePromo,descPromo,potPromo,imgPromo');
		$this->db->from('promo');
		$query = $this->db->get();
		return $query->result();
	}

}
