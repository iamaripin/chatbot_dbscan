<?php $this->load->view("admin/_partials/head.php") ?>


<?php $this->load->view("admin/_partials/menu.php") ?>


<!-- Content -->
<div class="container">
    <div class="row clearfix kanankiri">
        <div class="col-lg-12 mb-4">
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="<?php echo base_url() ?>/upload/1.jpg" class="d-block w-100" alt="<?php echo base_url() ?>/upload/1.jpg">
                    </div>
                    <div class="carousel-item">
                        <img src="<?php echo base_url() ?>/upload/1.jpg" class="d-block w-100" alt="<?php echo base_url() ?>/upload/1.jpg">
                    </div>
                    <div class="carousel-item">
                        <img src="<?php echo base_url() ?>/upload/1.jpg" class="d-block w-100" alt="<?php echo base_url() ?>/upload/1.jpg">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
    <div class="row clearfix py-4 kanankiri bg-white pads">
        <div class="col-lg-12 mb-4">
            <select class="mdb-select md-outline md-form" searchable="Search here.." id="myselect" onchange="sortby()">
                <option value="" disabled selected>Urut Berdasarkan</option>
                <option value="1">Harga, Rendah ke Tingg</option>
                <option value="2">harga, Tinggi ke Rendah</option>
                <option value="3">Nama, A-Z</option>
                <option value="4">Nama, Z-A</option>
                <option value="5">Paling Laris</option>
            </select>
        </div>
    </div>

    <div class="row kanankiri bg-white pads" id="hasilsort">

        <?php

        foreach ($produks as $pro) :
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

        <?php endforeach; ?>

    </div>
</div>

<?php $this->load->view("admin/_partials/footer.php") ?>
<script>
    function sortby() {
        var x = document.getElementById("myselect").value;
        if (x != '') {
            $.ajax({
                url: '<?php base_url(); ?>produks/sortproduk',
                method: 'POST',
                data: {
                    x: x,
                    i: ''
                },
                success: function(data) {

                    $('#hasilsort').html(data)
                }
            });
        }
    }
</script>
</body>

</html>