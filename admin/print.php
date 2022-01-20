<!DOCTYPE html>
<html lang="en">
<head>
  <title>Print Laporan</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
	<div style='float:left;' class="mb-4">
		<table>
			<tbody>
				<tr>
					<th colspan=2><h3>Laporan Penjualan A&F STORE</h3></th>
				</tr>
				<tr>
					<th>Tanggal Cetak</th>
					<td>: <?php  echo tanggal_indo( date("Y-m-d")); ?></td>
				</tr>
				<tr>
					<th>Periode Laporan</th>
					<td>: <?php  echo tanggal_indo($_GET['mulai'])." s/d ".tanggal_indo($_GET['sampai']); ?></td>
				</tr>
			</tbody>
		</table>
	</div>
	<div class="col-lg-12"><br/></div>
	<table class="table table-bordered" width="100%" cellspacing="0">
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
			<?php 
				include "config/koneksi.php";
				 
				
				$no=0; 
				$print = mysql_query("SELECT * FROM orderan INNER JOIN user ON user.idUser = orderan.idUser INNER JOIN produk ON produk.idProduk = orderan.idProduk WHERE orderan.dateOrder BETWEEN '$_GET[mulai]' AND '$_GET[sampai]' ");
				
				while($rows = mysql_fetch_array($print)){ 
				$no++
			?>
				<tr>
					<td>
						<?php echo $no ?>
					</td>
					<td>
						<?php echo"$rows[kdOrder]"; ?>
					</td>
					<td>
						<?php echo tanggal_indo($rows['dateOrder']); ?>
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

</body>
</html>

<script>
	window.print();
</script>
<?php
function tanggal_indo($tanggal)
{
	$bulan = array (1 =>   'Januari',
				'Februari',
				'Maret',
				'April',
				'Mei',
				'Juni',
				'Juli',
				'Agustus',
				'September',
				'Oktober',
				'November',
				'Desember'
			);
	$split = explode('-', $tanggal);
	return $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
}
?>