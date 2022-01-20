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
						<form>
							<label>Laporan Chat</label>
							
						</form>
					</div>
					<div class="card-body">

						<div class="table-responsive">
							<table class="table table-hover" width="100%" cellspacing="0">
								<thead>
									<tr>
										<th>No</th>
										<th>Pertanyaan</th>
										<th>Tanggal</th>
										<th>Jawaban</th>
									</tr>
								</thead>
								<tbody>
									<?php $no=0; 
										$this->db->select('*');
										$this->db->from('chat');
										$query = $this->db->get();
										$result = $query->result_array();
										
										foreach ($result as $rows){ $no++?>
										<tr>
											<td>
												<?php echo $no ?>
											</td>
											<td>
												<?php echo"$rows[pertanyaan]"; ?>
											</td>
											<td>
												<?php echo"$rows[dateChat]"; ?>
											</td>
											<td>
												<?php echo"$rows[jawaban]"; ?>
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
