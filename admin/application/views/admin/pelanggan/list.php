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
							<a href="<?php echo site_url('admin/pelanggans/add') ?>" class="btn btn-primary"><i class="material-icons">add</i> Tambah Pengguna</a>
						</div>
						<div class="card-body">
							<h4>Data Admin</h4>
							<div class="table-responsive">
								<table class="table table-hover myTable" width="100%" cellspacing="0">
									<thead>
										<tr>
											<th>No</th>
											<th>Nama</th>
											<th>Email</th>
											<th>Kontak</th>
											<th>Alamat</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php $this->db->select('*');
										$this->db->from('user');
										$this->db->where('user.statusUser', 'Admin');
										$query = $this->db->get();
										$result = $query->result_array();

										foreach ($result as $rows) {
											$no++ ?>
											<tr>
												<td>
													<?php echo $no ?>
												</td>
												<td>
													<?php echo $rows['nameUser'] ?>
												</td>
												<td>
													<?php echo $rows['emailUser'] ?>
												</td>
												<td>
													<?php echo $rows['tlpnUser'] ?>
												</td>
												<td>
													<?php echo $rows['alamatUser'] ?>
												</td>
												<td>
													<a href="<?php echo site_url('admin/pelanggans/edit/' . $rows['idUser']) ?>" class="btn btn-success btn-sm"><i class="material-icons">edit</i> Edit</a>

													<a onclick="deleteConfirm('<?php echo site_url('admin/pelanggans/delete/' . $rows['idUser']) ?>')" href="#!" class="btn btn-danger btn-sm"><i class="material-icons">delete</i> Hapus</a>
												</td>
											</tr>
										<?php } ?>

									</tbody>
								</table>
							</div>
							<br />
							<br />
							<br />
							<h4>Data Pelanggan</h4>
							<div class="table-responsive">
								<table class="table table-hover myTable" width="100%" cellspacing="0">
									<thead>
										<tr>
											<th>No</th>
											<th>Nama</th>
											<th>Email</th>
											<th>Kontak</th>
											<th>Alamat</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php $no = 0;
										foreach ($pelanggans as $pelanggan) : $no++ ?>
											<tr>
												<td>
													<?php echo $no ?>
												</td>
												<td>
													<?php echo $pelanggan->nameUser ?>
												</td>
												<td>
													<?php echo $pelanggan->emailUser ?>
												</td>
												<td>
													<?php echo $pelanggan->tlpnUser ?>
												</td>
												<td>
													<?php echo $pelanggan->alamatUser ?>
												</td>
												<td>
													<a href="<?php echo site_url('admin/pelanggans/edit/' . $pelanggan->idUser) ?>" class="btn btn-success btn-sm"><i class="material-icons">edit</i> Edit</a>

													<a onclick="deleteConfirm('<?php echo site_url('admin/pelanggans/delete/' . $pelanggan->idUser) ?>')" href="#!" class="btn btn-danger btn-sm"><i class="material-icons">delete</i> Hapus</a>
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
			$('.myTable').DataTable();
		});
	</script>


</body>

</html>