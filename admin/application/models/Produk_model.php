<?php defined('BASEPATH') or exit('No direct script access allowed');

class Produk_model extends CI_Model
{
	private $_table = "produk";

	public $idProduk;
	public $nameProduk;
	public $descProduk;
	public $katProduk;
	public $hargaProduk;
	public $kdProduk;

	public function rules()
	{
		return [

			[
				'field' => 'nameProduk',
				'label' => 'Nama',
				'rules' => 'required'
			],

			[
				'field' => 'hargaProduk',
				'label' => 'harga',
				'rules' => 'required'
			],

			[
				'field' => 'descProduk',
				'label' => 'Keterangan',
				'rules' => 'required'
			],

			[
				'field' => 'kdProduk',
				'label' => 'Kode',
				'rules' => 'required'
			]
		];
	}

	public function getAll()
	{
		return $this->db->get($this->_table)->result();
	}
	public function jointabel()
	{
		$this->db->select('*');
		$this->db->from('produk');
		$this->db->order_by("idProduk", "desc");
		$query = $this->db->get();
		return $query->result();
	}


	public function getById($id)
	{
		return $this->db->get_where($this->_table, ["idProduk" => $id])->row();
	}

	public function save()
	{
		$post = $this->input->post();

		date_default_timezone_set('Asia/Jakarta');
		$waktu = date('H:i:s');
		$tanggal = date('Y-m-d');

		$gambar = $this->_uploadImage();

		$this->db->select_max('kdProduk');
		$this->db->from('produk');
		$queryweb = $this->db->get();
		$resultweb = $queryweb->result_array();
		foreach ($resultweb as $row) {
			$kodeBarang = $row['kdProduk'];
		}
		$huruf = "FU";

		$urutan = (int) substr($kodeBarang, 2, 3);
		$urutan++;

		$kodeBarang = $huruf . sprintf("%03s", $urutan);

		$base = base_url();
		$gambarnya = $base . "upload/$gambar";

		$this->db->query("INSERT INTO produk(
										nameProduk,
										descProduk,
										kdProduk,
										imgProduk,
										hargaProduk,
										katProduk
									)VALUES(
										'$post[nameProduk]',
										'$post[descProduk]',
										'$kodeBarang',									
										'$gambarnya',
										'$post[hargaProduk]',	
										'$post[katProduk]'
									)");
	}

	public function update()
	{
		$post = $this->input->post();

		$this->db->query("UPDATE produk SET nameProduk = '$post[nameProduk]',
										hargaProduk = '$post[hargaProduk]',
										kdProduk = '$post[kdProduk]',
										descProduk = '$post[descProduk]',
										katProduk = '$post[katProduk]'
									WHERE idProduk = '$post[id]'");


		if ($_FILES["image"]["name"] != '') {
			$gambar = $this->_uploadImage();
			$base = base_url();
			$gambarnya = $base . "upload/$gambar";
			$this->db->query("UPDATE produk SET imgProduk = '$gambarnya' WHERE idProduk = '$post[id]'");
		}
	}

	public function delete($id)
	{
		$this->_deleteImage($id);
		return $this->db->delete($this->_table, array("idProduk" => $id));
	}


	public function _uploadImage()
	{
		$config['upload_path']          = './upload/';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['file_name']            = $_FILES["image"]["name"];
		$config['overwrite']			= true;
		$config['max_size']             = 1024; // 1MB
		// $config['max_width']         = 1024;
		// $config['max_height']        = 768;

		$this->load->library('upload', $config);

		if ($this->upload->do_upload('image')) {
			return $this->upload->data("file_name");
		}

		return "default.jpg";
	}

	private function _deleteImage($id)
	{
		$produk = $this->getById($id);
		if ($produk->imgProduk != "default.jpg") {
			$filename = explode(".", $produk->imgProduk)[0];
			return array_map('unlink', glob(FCPATH . "upload/$filename.*"));
		}
	}
}
