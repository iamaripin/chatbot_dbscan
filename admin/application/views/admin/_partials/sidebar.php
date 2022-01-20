<!-- Sidebar -->

<aside class="main-sidebar col-12 col-md-3 col-lg-2 px-0">
	<div class="main-navbar">
		<nav class="navbar align-items-stretch navbar-light bg-white flex-md-nowrap border-bottom p-0">
			<a class="navbar-brand w-100 " href="<?php echo site_url('admin') ?>" style="line-height: 25px;">
				<div class="d-table m-auto">
					<span>A&F STORE</span>
				</div>
			</a>
			<a class="toggle-sidebar d-sm-inline d-md-none d-lg-none">
				<i class="material-icons">&#xE5C4;</i>
			</a>
		</nav>
	</div>
	<div class="nav-wrapper">
		<ul class="nav flex-column">


			<li class="nav-item">
				<a class="nav-link <?php echo $this->uri->segment(2) == 'admin' ? 'active' : '' ?>" href="<?php echo site_url('admin') ?>">
					<i class="material-icons">home</i>
					<span>Beranda</span>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link <?php echo $this->uri->segment(2) == 'pertanyaans' ? 'active' : '' ?>" href="<?php echo site_url('admin/pertanyaans') ?>">
					<i class="material-icons">category</i>
					<span>Pertanyaan</span>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link <?php echo $this->uri->segment(2) == 'produks' ? 'active' : '' ?>" href="<?php echo site_url('admin/produks') ?>">
					<i class="material-icons">inventory</i>
					<span>Produk</span>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link <?php echo $this->uri->segment(2) == 'orderans' ? 'active' : '' ?>" href="<?php echo site_url('admin/orderans') ?>">
					<i class="material-icons">receipt</i>
					<span>Pesanan</span>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link <?php echo $this->uri->segment(2) == 'pembayarans' ? 'active' : '' ?>" href="<?php echo site_url('admin/pembayarans') ?>">
					<i class="material-icons">payments</i>
					<span>Pembayaran</span>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link <?php echo $this->uri->segment(2) == 'pelanggans' ? 'active' : '' ?>" href="<?php echo site_url('admin/pelanggans') ?>">
					<i class="material-icons">people</i>
					<span>Data Pengguna</span>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link <?php echo $this->uri->segment(2) == 'laporans' ? 'active' : '' ?>" href="<?php echo site_url('admin/laporans') ?>">
					<i class="material-icons">print</i>
					<span>Laporan Pesanan</span>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link <?php echo $this->uri->segment(2) == 'laporanchats' ? 'active' : '' ?>" href="<?php echo site_url('admin/laporanchats') ?>">
					<i class="material-icons">equalizer</i>
					<span>Laporan Chat</span>
				</a>
			</li>

		</ul>
	</div>
</aside>