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
					<div class="card-header">
					</div>
					<div class="card-body">
						<div class="table-responsive">
						<table class="table table-hover" id="myTable" width="100%" cellspacing="0">
							<thead>
								<tr>
									<th>No</th>
									<th>Invoice</th>
									<th>Tanggal Pembayaran</th>
									<th>Pelanggan</th>
									<th>Bukti Pembayaran</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php $no=0; foreach ($pembayarans as $pembayaran): $no++?>
								<tr>
									<td>
										<?php echo $no ?>
									</td>
									<td>
										<?php echo $pembayaran->kdOrder ?>
									</td>
									<td>
										<?php echo $pembayaran->dateBayar ?>
									</td>
									<td>
										<?php echo $pembayaran->nameUser ?>
									</td>
									<td>
										<a href="<?php echo $pembayaran->buktiBayar ?>" target="_blank"><img src="<?php echo $pembayaran->buktiBayar ?>" width="80px"/></a>
									</td>
									<td>
										<?php echo $pembayaran->statusOrder ?>
									</td>
									<td >
										<a href="<?php echo site_url('admin/pembayarans/edit/'.$pembayaran->kdOrder) ?>"
										 class="btn btn-success btn-sm"><i class="material-icons">loop</i> Lihat</a>
										 
										<a onclick="deleteConfirm('<?php echo site_url('admin/pembayarans/delete/'.$pembayaran->kdOrder) ?>')"
										 href="#!" class="btn btn-danger btn-sm"><i class="material-icons">delete</i> Hapus</a>
										
									</td>
								</tr>
								<?php endforeach; ?>

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
