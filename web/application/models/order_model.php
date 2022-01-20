<?php defined('BASEPATH') or exit('No direct script access allowed');

class Order_model extends CI_Model
{
    private $_table = "orderan";

    public $idOrder;
    public $dateOrder;
    public $kdOrder;
    public $posisiOrder;
    public $totalOrder;

    public function jointabel()
    {
        $this->db->select('orderan.*,user.nameUser,user.tlpnUser');
        $this->db->select_sum('orderan.subtotalOrder');
        $this->db->from('orderan');
        $this->db->join('user', 'user.idUser=orderan.idUser');
        $this->db->group_by('orderan.kdOrder');
        $this->db->order_by('orderan.idOrder', 'desc');
        $query = $this->db->get();
        return $query->result();
    }

    public function getById($id)
    {
        /*$this->db->select('orderan.*,user.nameUser,user.tlpnUser');
        $this->db->from('orderan');
        $this->db->join('user', 'user.idUser=orderan.idUser');
        $this->db->where('orderan.kdOrder=', $id);
        $query = $this->db->get();
        return $query->result();*/
        return $this->db->get_where($this->_table, ["kdOrder" => $id])->row();
    }

    public function getBykode($id)
    {
        return $this->db->get_where($this->_table, ["kdOrder" => $id])->row();
    }
	
	public function paymentsend()
    {
		$date = date("Y-m-d");
        $post = $this->input->post();
		
		$gambar = $this->_uploadImage();
		$base = base_url();
		$gambarnya = $base . "upload/$gambar";
			
		$this->db->query("INSERT INTO bayar(
                    kdOrder,
                    buktiBayar,
                    dateBayar,
					keterangan
                )VALUES(
                    '$post[kdJual]',
                    '$gambarnya',
                    '$date',
					'$post[banksend], $post[namasend]'
                )");
				
        $this->db->query("UPDATE orderan SET statusOrder = 'Pembayaran' WHERE kdOrder = '$post[kdJual]'");
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

    public function sortproduk($x)
    {
        $this->db->select('*');
        $this->db->from('tracking');
        $this->db->where('kdOrder=', $x);
        $query = $this->db->get();
        $resulttrack = $query->result_array();
        $resultsum = count($resulttrack);

        if ($resultsum > 0) {
            echo '
        <div class="table-responsive">
            <table class="table table-hover" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>';
            foreach ($resulttrack as $track) :
                echo '
                    <tr>
                        <td>
                            ' . $track['dateTracking'] . '
                        </td>
                        <td>
                            ' . $track['descTracking'] . '
                        </td>
                    </tr>';
            endforeach;
            echo '
                </tbody>
            </table>
        </div>';
        } else {
            echo "No Data Found";
        }

        return;
    }

    public function delete($id)
    {
        return $this->db->delete($this->_table, array("idTemp" => $id));
    }
}
