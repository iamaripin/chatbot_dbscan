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
							<a href="<?php echo site_url('admin/produks/add') ?>" class="btn btn-primary"><i class="material-icons">add</i> Tambah Data</a>
						</div>
						<div class="card-body">

							<div class="table-responsive">
								<table class="table table-hover" id="myTable" width="100%" cellspacing="0">
									<thead>
										<tr>
											<th>No</th>
											<th>Kode</th>
											<th>Nama Produk</th>
											<th>Kategori</th>
											<th>Harga</th>
											<th>Gambar</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php $no = 0;
										foreach ($produks as $produk) : $no++ ?>
											<tr>
												<td>
													<?php echo $no ?>
												</td>
												<td>
													<?php echo $produk->kdProduk ?>
												</td>
												<td>
													<?php echo $produk->nameProduk ?>
												</td>
												<td>
													<?php echo $produk->katProduk ?>
												</td>
												<td>
													<?php echo number_format($produk->hargaProduk, 0, ",", "."); ?>
												</td>
												<td>
													<img src="<?php echo $produk->imgProduk ?>" width="70px" />
												</td>
												<td>
													<a href="<?php echo site_url('admin/produks/edit/' . $produk->idProduk) ?>" class="btn btn-success btn-sm"><i class="material-icons">edit</i> Ubah</a>
													<?php
													if ($produk->statusPengajuan == '') {
													?>

														<a onclick="deleteConfirm('<?php echo site_url('admin/produks/delete/' . $produk->idProduk) ?>')" href="#!"  class="btn btn-danger btn-sm"><i class="material-icons">delete</i> Hapus</a>

													<?php
													}
													?>
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
		function deleteConfirm(url) {
			$('#btn-delete').attr('href', url);
			$('#deleteModal').modal();
		}
	</script>

	<script>
		$(document).ready(function() {
			$('#myTable').DataTable();
		});
	</script>
</body>

</html>