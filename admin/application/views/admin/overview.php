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

				
				<div class="main-content-container container-fluid px-4" style="padding-top: 30px;">
				
				<div class="alert alert-info alert-dismissible fade show" role="alert">
					<strong>Selamat datang, </strong><?php echo $this->session->userdata('username'); ?>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>

					<?php
					$query = $this->db->get('produk');
					$result = $query->result_array();
					$count = count($result);

					$this->db->select('idUser');
					$this->db->from('user');
					$this->db->where('statusUser', 'Pelanggan');
					$querysweb = $this->db->get();
					$resultsweb = $querysweb->result_array();
					$countweb = count($resultsweb);


					$this->db->select('kdOrder');
					$this->db->from('orderan');
					$queryswebs = $this->db->get();
					$resultswebs = $queryswebs->result_array();
					$countpengajuan = count($resultswebs);


					$this->db->select_sum('subtotalOrder');
					$this->db->from('orderan');
					$queryswebss = $this->db->get();
					$resultswebss = $queryswebss->result_array();
					foreach ($resultswebss as $rowss) {
						$countwebs = number_format($rowss['subtotalOrder'], 0, ",", ".");
					}
					?>
					<!-- Icon Cards-->
					<div class="row">
						<div class="col-xl-3 col-sm-6 mb-3">
							<div class="card text-white bg-primary o-hidden h-100">
								<div class="card-body">
									<div class="card-body-icon">
										<i class="material-icons">inventory</i> Data Produk
									</div>
									<div class="mr-5"><?php echo "$count"; ?> </div>
								</div>
								<a class="card-footer text-white clearfix small z-1" href="<?php echo site_url('admin/produks') ?>">
									<span class="float-left"> Produk Yang tersedia</span>

								</a>
							</div>
						</div>
						<div class="col-xl-3 col-sm-6 mb-3">
							<div class="card text-white bg-warning o-hidden h-100">
								<div class="card-body">
									<div class="card-body-icon">
										<i class="material-icons">people</i> Data Pelanggan
									</div>
									<div class="mr-5"><?php echo "$countweb"; ?></div>
								</div>
								<a class="card-footer text-white clearfix small z-1" href="<?php echo site_url('admin/pelanggans') ?>">
									<span class="float-left">Total Pelanggan</span>

								</a>
							</div>
						</div>
						<div class="col-xl-3 col-sm-6 mb-3">
							<div class="card text-white bg-success o-hidden h-100">
								<div class="card-body">
									<div class="card-body-icon">
										<i class="material-icons">receipt</i> Data Pesanan
									</div>
									<div class="mr-5"><?php echo "$countpengajuan"; ?> </div>
								</div>
								<a class="card-footer text-white clearfix small z-1" href="<?php echo site_url('admin/orderans') ?>">
									<span class="float-left">Total Pesanan</span>

								</a>
							</div>
						</div>

						<div class="col-xl-3 col-sm-6 mb-3">
							<div class="card text-white bg-danger o-hidden h-100">
								<div class="card-body">
									<div class="card-body-icon">
										<i class="material-icons">payments</i> Data Laporan
									</div>
									<div class="mr-5"><?php echo "$countwebs"; ?> </div>
								</div>
								<a class="card-footer text-white clearfix small z-1" href="<?php echo site_url('admin/laporans') ?>">
									<span class="float-left">Total Pendapatan</span>

								</a>
							</div>
						</div>

					</div>

				</div>
				<!-- /.container-fluid -->

				<!-- Sticky Footer -->
				<?php $this->load->view("admin/_partials/footer.php") ?>

			</main>
		</div>
	</div>
	<!-- /#wrapper -->

	<?php $this->load->view("admin/_partials/js.php") ?>
	<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

</body>

</html>