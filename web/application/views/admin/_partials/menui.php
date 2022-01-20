<div id="myNav" class="overlay">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <form class="ms-5 me-4 mt-3" action="<?php echo site_url('produks/cari') ?>" method="GET" enctype="multipart/form-data">
        <div class="input-group">
            <input class="form-control border-end-0 border rounded-pill" name="search" type="search" placeholder="search" id="example-search-input">
            <span class="input-group-append">
                <button class="btn btn-outline-secondary bg-white border-bottom-0 border rounded-pill ms-n5" type="submit">
                    <i class="fa fa-search"></i>
                </button>
            </span>
        </div>

    </form>
    <div class="overlay-content">
        <a href="<?php echo site_url('carts') ?>" class="border-bottom">Keranjang</a>
      <!--  <a href="<?php echo site_url('orders/tracking') ?>" class="border-bottom">Lacak Pesanan</a>-->
        <a href="<?php echo site_url('docs/about') ?>" class="border-bottom">Tentang Kami</a>
        <?php
        if ($this->session->userdata('idMitra')) {
        ?>
            <a href="<?php echo site_url('orders/history') ?>" class="border-bottom">Pesanan Saya</a>
            <a href="<?php echo site_url('profils') ?>" class="border-bottom">Profil (<?= $this->session->userdata('nama') ?>)</a>
            <!-- <a href="<?php echo site_url('coupons') ?>" class="border-bottom">Voucher</a> -->
            <a href="<?php echo site_url('admin/login') ?>" class="border-bottom">Keluar</a>
        <?php
        }
        ?>
    </div>
    <?php
    if (!$this->session->userdata('idMitra')) {
    ?>
        <a href="<?php echo site_url('accounts') ?>" class="rounded-pill btn btn-success ms-4 me-4 text-light position-absolute bottom-0 mb-4" style="width:90%;">
            Log in - Daftar
        </a>
    <?php
    }
    ?>
</div>

<nav class="navbar navbar-expand-lg navbar-light fixed-top border-bottom" style="background:#fff">
    <div class="container">

        <a class="headmenu text-dark" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" onclick="openNav()">
            <span class="fa fa-bars"></span>
        </a>


        <div class="row kanankiri">

            <a class="navbar-brand" href="<?php echo site_url() ?>">A&F STORE</a>
        </div>
        <div class="row kanankiri">

            <form class="headmenu" action="<?php echo site_url('produks/cari') ?>" method="GET" enctype="multipart/form-data">
                <div class="input-group">
                    <input class="form-control border-end-0 border rounded-pill" name="search" type="search" placeholder="search" id="example-search-input">
                    <span class="input-group-append">
                        <button class="btn btn-outline-secondary bg-white border-bottom-0 border rounded-pill ms-n5" type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>

            </form>

            <ul class="navbar-nav me-auto mb-2 mb-lg-0 headmenus">
                <li class="nav-item me-3">
                    <form class="" action="<?php echo site_url('produks/cari') ?>" method="GET" enctype="multipart/form-data">
                        <div class="input-group">
                            <input class="form-control border-end-0 border rounded-pill" name="search" type="search" placeholder="search" id="example-search-input">
                            <span class="input-group-append">
                                <button class="btn btn-outline-secondary bg-white border-bottom-0 border rounded-pill ms-n5" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>

                    </form>
                </li>
                <?php
                if (!$this->session->userdata('idMitra')) {
                ?>
                    <li class="nav-item me-3">
                        <a class="nav-link active" aria-current="page" href="<?php echo site_url('accounts') ?>">Log-in</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo site_url('accounts/signup') ?>" class="rounded-pill btn btn-success ps-5 pe-5">
                            Daftar
                        </a>
                    </li>
                <?php
                } else {
                ?>
                    <li class="nav-item me-3">
                        <a class="nav-link bg-white " href="#" onclick="openNav()">
                            <i class="fa fa-user"></i>
                            <?php echo $this->session->userdata('nama'); ?>
                        </a>
                    </li>
                <?php
                }
                ?>
            </ul>

        </div>

    </div>
</nav>


<div class="nav-scroller py-1" style="margin-top:20px;">
</div>

<?php
$ids = session_id();
$this->db->select('idTemp');
$this->db->from('temp');
$this->db->where('temp.idUser=', $ids);
$querykeranjang = $this->db->get();
$resultkeranjang = $querykeranjang->result_array();
$countkeranjang = count($resultkeranjang);

if ($countkeranjang > 0) {
    echo "
			<a href='" . site_url('carts') . "' class='floatkeranjang text-decoration-none cartgd'>
				<i class='fa fa-shopping-cart'></i> ($countkeranjang)
			</a>
		";
}
?>


<a href='https://api.whatsapp.com/send?phone=6281261700028&text=Halo%20Kak,%20mau%20info%20produknya%20dong?' class="floatwa" target="_blank">
    <i class='fa fa-whatsapp'></i>
</a>


<!-- Bottom Navbar -->
<nav class="navbar navbar-light bg-light border-top navbar-expand d-lg-none d-md-none fixed-bottom">
    <ul class="navbar-nav nav-justified w-100">
        <li class="nav-item">
            <a href="<?php echo site_url() ?>" class="nav-link">
                <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z" />
                    <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z" />
                </svg>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?php echo site_url('produks') ?>" class="nav-link">
                <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                </svg>
            </a>
        </li>
        <li class="nav-item">
            <?php if ($countkeranjang > 0) { ?>
                <span class="position-absolute top-2 translate-middle badge rounded-pill bg-danger">
                    <?php echo $countkeranjang; ?>
                    <span class="visually-hidden">unread messages</span>
                </span>
            <?php } ?>
            <a href="<?php echo site_url('carts') ?>" class="nav-link">

                <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" fill="currentColor" class="bi bi-bag" viewBox="0 0 16 16">
                    <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z" />
                </svg>
            </a>
        </li>
        <li class="nav-item">
            <a href="#" onclick="openNav()" class="nav-link">
                <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                </svg>
            </a>
        </li>
    </ul>
</nav>