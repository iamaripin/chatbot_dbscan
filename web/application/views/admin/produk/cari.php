<?php $this->load->view("admin/_partials/head.php") ?>


<?php $this->load->view("admin/_partials/menu.php") ?>
<!-- Content -->
<div class="container">
    <div class="row clearfix py-4 kanankiri bg-white pads">
        <div class="col-lg-12 mb-4">
            <select class="mdb-select md-outline md-form" searchable="Search here..">
                <option value="" disabled selected>Sort Product</option>
                <option value="1">Price, Low to High</option>
                <option value="2">Price, High to Low</option>
                <option value="3">Name, A-Z</option>
                <option value="4">Name, Z-A</option>
                <option value="5">Date, old to New</option>
                <option value="6">Date, New to Old</option>
                <option value="7">Best Selling</option>
            </select>
        </div>

        <?php
        if (count($search) == 0) {
            echo "<div class='col-lg-12 mb-4'>Data tidak ditemukan</div>";
        } else {
            foreach ($search as $pro) :

                $linkproduk = str_replace(" ", "-", $pro->nameProduk);
                $harga = number_format($pro->hargaProduk, 0, ',', '.');
        ?>

                <div class="col-lg-3 col-md-4 col-sm-6 col-6 mb-4 ">
                    <a href="<?php echo site_url('produks/det/' . $linkproduk) ?>" class="text-decoration-none text-dark">
                        <div class="card bg-transparent">
                            <img src="<?php echo $pro->imgProduk; ?>" class="card-img-top imgcard" alt="...">
                            <div class="card-body">
                                <div style="width: 100%;overflow: hidden; text-overflow: ellipsis;white-space: nowrap;text-align:center"><?php echo $pro->nameProduk; ?></div>
                                <div class="text-center"><strong> Rp <?php echo $harga; ?></strong></div>

                            </div>
                        </div>
                    </a>
                </div>

        <?php endforeach;
        }
        ?>

    </div>
</div>

<?php $this->load->view("admin/_partials/footer.php") ?>
</body>

</html>