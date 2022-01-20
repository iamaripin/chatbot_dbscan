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

				<?php $this->load->view("admin/_partials/breadcrumb.php") ?>

				<!-- DataTables -->
				<div class="card mb-3 mt-3">
				<div class="card mb-3">
					<div class="card-header">
						<form>
							<label>Periode Pesanan</label>
							<div class="row">
								<div class="col-lg-6">
									<div class="input-group mb-3">
										<input class="form-control" type="date" name="mulai" placeholder="Mulai" value="<?php echo $_GET['mulai'] ?>"/>
										
										<div class="input-group-prepend">
											<button class="btn btn-outline-secondary" type="button">s/d</button>
										</div>
										<input class="form-control" type="date" name="sampai" placeholder="Sampai" value="<?php echo $_GET['sampai'] ?>"/>
									</div>
								</div>
								<div class="col-lg-12">
									<input class="btn btn-success" type="submit" name="btn" value="Cari" />
									<a href="<?php echo base_url()?>print.php?mulai=<?php echo $_GET['mulai'] ?>&sampai=<?php echo $_GET['sampai'] ?>" target="_blank"><input class="btn btn-primary" type="button" name="btn" value="Cetak" /></a>
								</div>
							</div>
						</form>
					</div>
					<div class="card-body">

						<div class="table-responsive">
							<table class="table table-hover" width="100%" cellspacing="0">
								<thead>
									<tr>
										<th>No</th>
										<th>Invoice</th>
										<th>Tanggal</th>
										<th>Pelanggan</th>
										<th>Produk</th>
										<th>Harga</th>
										<th>Jumlah</th>
										<th>Subtotal</th>
										<th>Status</th>
									</tr>
								</thead>
								<tbody>
									<?php $no=0; 
										$this->db->select('*');
										$this->db->from('orderan');
										$this->db->join('produk','produk.idProduk=orderan.idProduk');
										$this->db->join('user','user.idUser=orderan.idUser');
										$this->db->where('orderan.dateOrder >=', $_GET['mulai']);
										$this->db->where('orderan.dateOrder <=', $_GET['sampai']);
										$this->db->order_by('orderan.dateOrder DESC');
										$query = $this->db->get();
										$result = $query->result_array();
										
										foreach ($result as $rows){ $no++?>
										<tr>
											<td>
												<?php echo $no ?>
											</td>
											<td>
												<?php echo"$rows[kdOrder]"; ?>
											</td>
											<td>
												<?php echo"$rows[dateOrder]"; ?>
											</td>
											<td>
												<?php echo"$rows[nameUser]"; ?>
											</td>
											<td>
												<?php echo"$rows[kdProduk] - $rows[nameProduk]"; ?>
											</td>
											<td>
												<?php echo number_format($rows['hargaOrder'],0,",",".") ?>
											</td>
											<td>
												<?php echo $rows['qtyOrder'] ?>
											</td>
											<td>
												<?php echo number_format($rows['subtotalOrder'],0,",",".") ?>
											</td>
											<td> 		
												<?php
													if($rows['statusOrder'] == ""){
														echo "Belum Bayar";
													}else{
														echo $rows['statusOrder'];
													}
												?>
											</td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>

			</div>
			<!-- /.container-fluid -->
		<?php $this->load->view("admin/_partials/footer.php") ?>

		</main>
		</div>
    </div>

	<?php $this->load->view("admin/_partials/modal.php") ?>
<?php $this->load->view("admin/_partials/js.php") ?>
	<script>
	function deleteConfirm(url){
		$('#btn-delete').attr('href', url);
		$('#deleteModal').modal();
	}
	</script>
    
	<script>
	$(document).ready( function () {
		$('#myTable').DataTable();
	});
	</script>
</body>
</html>
