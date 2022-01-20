<nav class="navbar align-items-stretch navbar-light flex-md-nowrap p-0" style="background:#283747">
  <form action="#" class="main-navbar__search w-100 d-none d-md-flex d-lg-flex">
	<div class="input-group input-group-seamless ml-3">
	</div>
  </form>
  <ul class="navbar-nav border-left flex-row ">
	<li class="nav-item dropdown" style="margin-top:10px;">
	  <a class="dropdown-item text-white" href="<?php echo site_url('admin/profils/edit/'.$this->session->userdata('idkaryawan')) ?>">
		  <i class="material-icons text-white">manage_accounts</i> Profil </a>
	</li>
	<li class="nav-item dropdown" style="margin-top:10px;">
	  <a class="dropdown-item  text-white" href="<?= site_url('admin/login/logout') ?>">
		  <i class="material-icons text-white">&#xE879;</i> Logout </a>
	</li>
  </ul>
  <nav class="nav">
	<a href="#" class="nav-link nav-link-icon toggle-sidebar d-md-inline d-lg-none text-center border-left" data-toggle="collapse" data-target=".header-navbar" aria-expanded="false" aria-controls="header-navbar">
	  <i class="material-icons">&#xE5D2;</i>
	</a>
  </nav>
</nav>
