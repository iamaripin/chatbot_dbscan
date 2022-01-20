<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view("admin/_partials/head.php") ?>
</head>
<body class="h-100">
	<div class="container-fluid">
		<div class="row">
			<?php $this->load->view("admin/_partials/sidebar.php") ?>

		<main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">
			<div class="main-navbar sticky-top bg-white">

				<?php $this->load->view("admin/_partials/navbar.php") ?>
			
			</div>
			<div class="main-content-container container-fluid px-4">

				<?php if ($this->session->flashdata('success')): ?>
				<div class="alert alert-success" role="alert">
					<?php echo $this->session->flashdata('success'); ?>
				</div>
				<?php endif; ?>

				<!-- Card  -->
				<div class="card mb-3 mt-3">
					<div class="card-header">

						<a href="<?php echo site_url('admin/pembayarans/') ?>"><i class="material-icons">keyboard_backspace</i>
							Kembali</a>
					</div>
					<div class="card-body">
						<?php
							$this->db->select('*');
							$this->db->from('orderan');
							$this->db->join('user','user.idUser=orderan.idUser');
							$this->db->where('orderan.kdOrder', $pembayaran->kdOrder);
							$query = $this->db->get();
							$result = $query->result_array();
							$count = count($result);
							
							foreach ($result as $row)
							{
								$nameUser = $row['nameUser'];
								$kdOrder = $row['kdOrder'];
								$dateOrder = $row['dateOrder'];
								$statusOrder = $row['statusOrder'];
								$alamat = $row['alamatUser'];
							}
						
						?>

						<form action="<?php base_url("admin/pembayaran/edit") ?>" method="post" enctype="multipart/form-data" >

							<input type="hidden" name="id" value="<?php echo $kdOrder?>" />

							<div class="form-group">
								<h4><b for="nameUser">Data Pelanggan</b></h4>
							</div>
							<div class="row">
							<div class="form-group col-md-6">
								<label for="nameUser">Nama Pelanggan</label>
								<br/>
								<?php echo $nameUser ?>
							</div>
							<div class="form-group col-md-6">
								<label for="nameUser">Kode Pesanan</label>
								<br/>
								<?php echo $kdOrder ?>
							</div>
							<div class="form-group col-md-6">
								<label for="nameUser">Periode Pesanan</label>
								<br/>
								<?php echo $dateOrder ?>
							</div>
							<div class="form-group col-md-6">
								<label for="nameUser">Alamat Pemesan</label>
								<br/>
								<?php echo $alamat ?>
							</div>
							
							<div class="form-group col-md-6">
								<label for="nameUser">Status Pesanan</label>
								<br/>
								<?php echo $statusOrder ?>
							</div>
							
							<div class="form-group">
								<label for="nameUser">Bukti Tranfer</label>
								<br/>
								<a href="<?php echo $pembayaran->buktiBayar ?>" target="_blank"><img src="<?php echo $pembayaran->buktiBayar ?>" width="100px"/></a>
							</div>
							</div>
							
							<div class="form-group">
								<h4><b for="nameUser">Detail Transaksi</b></h4>
							</div>
							<div class="table-responsive">
								<table class="table table-hover" id="myTable" width="100%" cellspacing="0">
									<thead>
										<tr>
											<th>No</th>
											<th>Produk</th>
											<th>Harga</th>
											<th>Jumlah</th>
											<th>Subtotal</th>
										</tr>
									</thead>
									<tbody>
										<?php $no=0; 
										$this->db->select('*');
										$this->db->from('orderan');
										$this->db->join('produk','produk.idProduk=orderan.idProduk');
										$this->db->where('orderan.kdOrder', $pembayaran->kdOrder);
										$query = $this->db->get();
										$result = $query->result_array();
										
										foreach ($result as $rows){ $no++?>
										<tr>
											<td>
												<?php echo $no ?>
											</td>
											<td>
												<?php echo"$rows[kdProduk] - $rows[nameProduk]"; ?>
											</td>
											<td>
												<?php echo $rows['hargaOrder'] ?>
											</td>
											<td>
												<?php echo $rows['qtyOrder'] ?>
											</td>
											<td>
												<?php echo $rows['subtotalOrder'] ?>
											</td>
										</tr>
										<?php } ?>

									</tbody>
								</table>
							</div>
							
							
							<?php
							if($statusOrder == 'Pembayaran'){
							?>
							
							<a href="<?php echo site_url('admin/pembayarans/validasi/'.$pembayaran->kdOrder) ?>"
							 class="btn btn-warning btn-sm">Pengiriman</a>
							 
							<?php
							}
							?>
							
						</form>

					</div>


				</div>

			</div>
		<?php $this->load->view("admin/_partials/footer.php") ?>

		</main>
		</div>
    </div>

<?php $this->load->view("admin/_partials/js.php") ?>
</body>

</html>
