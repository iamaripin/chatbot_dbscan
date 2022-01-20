<!-- Sidebar -->

<aside class="main-sidebar col-12 col-md-3 col-lg-2 px-0">
  <div class="main-navbar">
	<nav class="navbar align-items-stretch navbar-light bg-white flex-md-nowrap border-bottom p-0">
	  <a class="navbar-brand w-100 " href="<?php echo site_url('admin') ?>" style="line-height: 25px;">
		<div class="d-table m-auto">
		  <span><img src="http://localhost/klaim/logo.png" width="60px"/></span>
		</div>
	  </a>
	  <a class="toggle-sidebar d-sm-inline d-md-none d-lg-none">
		<i class="material-icons">&#xE5C4;</i>
	  </a>
	</nav>
  </div>
  <div class="nav-wrapper">
	<ul class="nav flex-column">
	<?php	
		if($this->session->userdata('status') == 'Admin'){
	?>
		
	  <li class="nav-item">
		<a class="nav-link <?php echo $this->uri->segment(2) == 'berandas' ? 'active': '' ?>" href="<?php echo site_url('admin') ?>">
		  <i class="material-icons">home</i>
		  <span>Dashboard</span>
		</a>
	  </li>
	  <li class="nav-item">
		<a class="nav-link <?php echo $this->uri->segment(2) == 'departemens' ? 'active': '' ?>" href="<?php echo site_url('admin/departemens') ?>">
		  <i class="material-icons">manage_accounts</i>
		  <span>Kelola Departemen</span>
		</a>
	  </li>
	  <li class="nav-item">
		<a class="nav-link <?php echo $this->uri->segment(2) == 'karyawans' ? 'active': '' ?>" href="<?php echo site_url('admin/karyawans') ?>">
		  <i class="material-icons">people_alt</i>
		  <span>Kelola Karyawan</span>
		</a>
	  </li>
	  <li class="nav-item">
		<a class="nav-link <?php echo $this->uri->segment(2) == 'pengajuans' ? 'active': '' ?>" href="<?php echo site_url('admin/pengajuans') ?>">
		  <i class="material-icons">receipt</i>
		  <span>Kelola Pengajuan Klaim</span>
		</a>
	  </li>
	  <li class="nav-item">
		<a class="nav-link <?php echo $this->uri->segment(2) == 'bantuans' ? 'active': '' ?>" href="<?php echo site_url('admin/bantuans') ?>">
		  <i class="material-icons">help</i>
		  <span>Bantuan</span>
		</a>
	  </li>
	  <!-- <li class="nav-item">
		<a class="nav-link <?php echo $this->uri->segment(2) == 'laporans' ? 'active': '' ?>" href="<?php echo site_url('admin/laporans') ?>">
		  <i class="material-icons">print</i>
		  <span>Laporan Grafik</span>
		</a>
	  </li>-->
	  
	<?php	
		}else if($this->session->userdata('status') == 'Manager'){
	?>
		
	  <li class="nav-item">
		<a class="nav-link <?php echo $this->uri->segment(2) == 'berandas' ? 'active': '' ?>" href="<?php echo site_url('admin') ?>">
		  <i class="material-icons">home</i>
		  <span>Dashboard</span>
		</a>
	  </li>
	  
	  <li class="nav-item">
		<a class="nav-link <?php echo $this->uri->segment(2) == 'pengajuans' ? 'active': '' ?>" href="<?php echo site_url('admin/pengajuans') ?>">
		  <i class="material-icons">receipt</i>
		  <span>Kelola Pengajuan Klaim</span>
		</a>
	  </li>
	  <!--<li class="nav-item">
		<a class="nav-link <?php echo $this->uri->segment(2) == 'bantuans' ? 'active': '' ?>" href="<?php echo site_url('admin/bantuans') ?>">
		  <i class="material-icons">help</i>
		  <span>Bantuan</span>
		</a>
	  </li>
	  <li class="nav-item">
		<a class="nav-link <?php echo $this->uri->segment(2) == 'laporans' ? 'active': '' ?>" href="<?php echo site_url('admin/laporans') ?>">
		  <i class="material-icons">print</i>
		  <span>Laporan Grafik</span>
		</a>
	  </li>-->
	<?php	
		}else{
	?>		
	  <li class="nav-item">
		<a class="nav-link <?php echo $this->uri->segment(2) == 'berandas' ? 'active': '' ?>" href="<?php echo site_url('admin') ?>">
		  <i class="material-icons">home</i>
		  <span>Dashboard</span>
		</a>
	  </li>
	  <li class="nav-item">
		<a class="nav-link <?php echo $this->uri->segment(2) == 'klaims' ? 'active': '' ?>" href="<?php echo site_url('admin/klaims') ?>">
		  <i class="material-icons">receipt</i>
		  <span>Klaim</span>
		</a>
	  </li>
	  <li class="nav-item">
		<a class="nav-link <?php echo $this->uri->segment(2) == 'bantuanklaims' ? 'active': '' ?>" href="<?php echo site_url('admin/bantuanklaims') ?>">
		  <i class="material-icons">help</i>
		  <span>Bantuan</span>
		</a>
	  </li>
	<?php	
		}
	?>	
	</ul>
  </div>
</aside>
