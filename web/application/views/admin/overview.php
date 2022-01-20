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
			
			<?php	
				if($this->session->userdata('status') == 'Admin'){
					
				
				$query = $this->db->get('karyawan');
				$result = $query->result_array();
				$count = count($result); 
				
				$queryweb = $this->db->get('departemen');
				$resultweb = $queryweb->result_array();
				$countweb = count($resultweb); 
				
				$querypengajuan = $this->db->get('pengajuan');
				$resultpengajuan = $querypengajuan->result_array();
				$countpengajuan = count($resultpengajuan); 
			?>
			<!-- Icon Cards-->
			<div class="row">
				<div class="col-xl-4 col-sm-6 mb-3">
				<div class="card text-white bg-primary o-hidden h-100">
					<div class="card-body">
					<div class="card-body-icon">
						<i class="material-icons">people_alt</i>
					</div>
					<div class="mr-5"><?php echo"$count"; ?> Data Karyawan</div>
					</div>
					<a class="card-footer text-white clearfix small z-1" href="<?php echo site_url('admin/karyawans') ?>">
					<span class="float-left">View Details</span>
					
					</a>
				</div>
				</div>
				<div class="col-xl-4 col-sm-6 mb-3">
				<div class="card text-white bg-warning o-hidden h-100">
					<div class="card-body">
					<div class="card-body-icon">
						<i class="material-icons">manage_accounts</i>
					</div>
					<div class="mr-5"><?php echo"$countweb"; ?> Data Departemen</div>
					</div>
					<a class="card-footer text-white clearfix small z-1" href="<?php echo site_url('admin/departemens') ?>">
					<span class="float-left">View Details</span>
					
					</a>
				</div>
				</div>
				<div class="col-xl-4 col-sm-6 mb-3">
				<div class="card text-white bg-success o-hidden h-100">
					<div class="card-body">
					<div class="card-body-icon">
						<i class="material-icons">receipt</i>
					</div>
					<div class="mr-5"><?php echo"$countpengajuan"; ?> Data Pengajuan</div>
					</div>
					<a class="card-footer text-white clearfix small z-1" href="<?php echo site_url('admin/pengajuans') ?>">
					<span class="float-left">View Details</span>
					
					</a>
				</div>
				</div>
				
			</div>

			<div class="jumbotron">
				<h3><center>Grafik Pengajuan Biaya Dinas Luar</center></h3>
				<br>
				<div class="col-lg-12">
					<div style="width: 800px;margin: 0px auto;">
						<canvas id="myChart"></canvas>
					</div>
				</div>
			</div>
			<?php $this->load->view("admin/_partials/js.php") ?>
<script>
	var ctx = document.getElementById("myChart").getContext('2d');
	var myChart = new Chart(ctx, {
		type: 'bar',
		data: {
			labels: ["Proses", "Disetujui", "Ditolak", "Total Pengajuan"],
			datasets: [{
				label: '',
				data: [
				<?php 
				$query = $this->db->get('pengajuan');
				$result = $query->result_array();
				$count = count($result); 
				
				$this->db->select('idPengajuan');
				$this->db->from('pengajuan');
				$this->db->where('statusPengajuan', '');	
				$queryweb = $this->db->get();
				$resultweb = $queryweb->result_array();
				$countweb = count($resultweb); 
				
				$this->db->select('idPengajuan');
				$this->db->from('pengajuan');
				$this->db->where('statusPengajuan', 'Divalidasi');	
				$querypengajuan = $this->db->get();
				$resultpengajuan = $querypengajuan->result_array();
				$countvalidasi = count($resultpengajuan); 
				
				$this->db->select('idPengajuan');
				$this->db->from('pengajuan');
				$this->db->where('statusPengajuan', 'Ditolak');	
				$querypengajuans = $this->db->get();
				$resultpengajuan = $querypengajuans->result_array();
				$counttolak = count($resultpengajuan); 
				
				echo $countweb;
				?>, 
				<?php 
				echo $countvalidasi;
				?>, 
				<?php 
				echo $counttolak;
				?>, 
				<?php 
				echo $count;
				?>
				],
				backgroundColor: [
				'rgba(255, 99, 132, 0.2)',
				'rgba(54, 162, 235, 0.2)',
				'rgba(255, 206, 86, 0.2)',
				'rgba(75, 192, 192, 0.2)'
				],
				borderColor: [
				'rgba(255,99,132,1)',
				'rgba(54, 162, 235, 1)',
				'rgba(255, 206, 86, 1)',
				'rgba(75, 192, 192, 1)'
				],
				borderWidth: 1
			}]
		},
		options: {
			scales: {
				yAxes: [{
					ticks: {
						beginAtZero:true
					}
				}]
			}
		}
	});
</script>
			<?php	
				}else{
					
				$idkar = $this->session->userdata('idkaryawan');
				
				$this->db->select('idPengajuan');
				$this->db->from('pengajuan');
				$this->db->where('idKaryawan', $idkar);	
				$this->db->where('statusPengajuan', '');	
				$querys = $this->db->get();
				$results = $querys->result_array();
				$count = count($results); 
				
				$this->db->select('idPengajuan');
				$this->db->from('pengajuan');
				$this->db->where('idKaryawan', $idkar);	
				$this->db->where('statusPengajuan', 'Diproses');	
				$querysweb = $this->db->get();
				$resultsweb = $querysweb->result_array();
				$countweb = count($resultsweb); 
				
				$this->db->select('idPengajuan');
				$this->db->from('pengajuan');
				$this->db->where('idKaryawan', $idkar);	
				$this->db->where('statusPengajuan', 'Divalidasi');	
				$queryswebs = $this->db->get();
				$resultswebs = $queryswebs->result_array();
				$countpengajuan = count($resultswebs);
				
				$this->db->select('idPengajuan');
				$this->db->from('pengajuan');
				$this->db->where('idKaryawan', $idkar);	
				$this->db->where('statusPengajuan', 'Ditolak');	
				$queryswebss = $this->db->get();
				$resultswebss = $queryswebss->result_array();
				$countwebs = count($resultswebss); 
				
			?>
			<div class="row">
				<div class="col-xl-3 col-sm-6 mb-3">
				<div class="card text-white bg-primary o-hidden h-100">
					<div class="card-body">
					<div class="card-body-icon">
						<i class="material-icons">receipt</i>
					</div>
					<?php echo"$count"; ?>
					<div class="mr-5"> Klaim Diproses</div>
					</div>
				</div>
				</div>
				
				<div class="col-xl-3 col-sm-6 mb-3">
				<div class="card text-white bg-warning o-hidden h-100">
					<div class="card-body">
					<div class="card-body-icon">
						<i class="material-icons">receipt</i>
					</div>
					<?php echo"$countweb"; ?>
					<div class="mr-5"> Klaim Disetujui</div>
					</div>
				</div>
				</div>
				
				<div class="col-xl-3 col-sm-6 mb-3">
				<div class="card text-white bg-success o-hidden h-100">
					<div class="card-body">
					<div class="card-body-icon">
						<i class="material-icons">receipt</i>
					</div>
					<?php echo"$countpengajuan"; ?>
					<div class="mr-5"> Klaim Validasi</div>
					</div>
				</div>
				</div>
				
				<div class="col-xl-3 col-sm-6 mb-3">
				<div class="card text-white bg-danger o-hidden h-100">
					<div class="card-body">
					<div class="card-body-icon">
						<i class="material-icons">receipt</i>
					</div>
					<?php echo"$countwebs"; ?>
					<div class="mr-5"> Klaim Ditolak</div>
					</div>
				</div>
				</div>
				
			</div>
			<?php	
				}
			?>

				


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
