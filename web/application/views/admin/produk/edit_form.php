<?php $this->load->view("admin/_partials/head.php") ?>


<?php $this->load->view("admin/_partials/menu.php") ?>
<!-- Content -->
<div class="container">
    <div class="row clearfix py-4 kanankiri bg-white pads">
        <div class="preview col-md-5">

            <div class="preview-pic tab-content">
                <div class="tab-pane active" id="pic-1"><img src="<?php echo $produk->imgProduk; ?>" /></div>
            </div>
            <ul class="preview-thumbnail nav nav-tabs">
                <li class="active"><a data-target="#pic-1" data-toggle="tab"><img src="<?php echo $produk->imgProduk; ?>" /></a></li>
            </ul>

        </div>
        <div class=" col-md-7">
            <p class="h2 text-uppercase"><?php echo $produk->nameProduk; ?></p>
            <p class="h3">Rp. <?php $harga = number_format($produk->hargaProduk, 0, ',', '.');
                                echo $harga; ?></p>


            <form class="d-flex" action="<?php echo base_url('produks/addtocart') ?>" method="POST" enctype="multipart/form-data">
                <input name="idProduk" type="hidden" value="<?php echo $produk->idProduk; ?>" />
                <input name="harga" type="hidden" value="<?php echo $produk->hargaProduk; ?>" />
                <input name="namabarang" type="hidden" value="<?php echo $produk->nameProduk; ?>" />
                <input class="me-2" name="qty" type="number" min="1" placeholder="1" value="1" style="text-align:center;width:15vmax;" />
                <button class="btn btn-success col-lg-4 col-md-4 col-8" type="submit">MASUKAN KERANJANG</button>
            </form>

        </div>


        <div class="col-md-12 mt-3">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Keterangan</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active p-3" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <?php echo $produk->descProduk; ?>
                </div>
            </div>
        </div>

    </div>

    <div class="row clearfix kanankiri bg-white pads">

        <div class="batas mb-4"><span><b>Produk Lainnya</b></span></div>


        <div class="col-lg-12 menu-wrapper">
            <ul class="menu">
                <?php
                $this->db->select('idProduk, nameProduk, hargaProduk, imgProduk');
                $this->db->from('produk');
                $this->db->where('katProduk', $produk->katProduk);
                $this->db->where('idProduk !=', $produk->idProduk);
                $this->db->limit('6');
                $queryproduk = $this->db->get();
                $resultproduk = $queryproduk->result_array();

                foreach ($resultproduk as $pro) :
                    $linkproduk = str_replace(" ", "-", $pro['nameProduk']);
                    $harga = number_format($pro['hargaProduk'], 0, ',', '.');
                ?>

                    <li class="item">
                        <a href="<?php echo site_url('produks/det/' . $linkproduk) ?>" class="text-decoration-none text-dark">
                            <div class="card bg-transparent">
                                <img src="<?php echo $pro['imgProduk']; ?>" class="card-img-top imgcard" alt="...">
                                <div class="card-body">
                                    <div style="width: 100%;overflow: hidden; text-overflow: ellipsis;white-space: nowrap;text-align:center"><?php echo $pro['nameProduk']; ?></div>
                                    <div class="text-center"><strong> Rp <?php echo $harga; ?></strong></div>

                                </div>
                            </div>
                        </a>
                    </li>

                <?php endforeach; ?>
            </ul>

            <div class="paddles">
                <button class="left-paddle paddle hidden">
                    <span class="fa fa-arrow-left"></span>
                </button>
                <button class="right-paddle paddle">
                    <span class="fa fa-arrow-right"></span>
                </button>
            </div>
        </div>
    </div>
</div>


<?php $this->load->view("admin/_partials/footer.php") ?>
<script>
    $(document).ready(function() {
        $("input[type='radio']").click(function() {
            var sim = $("input[type='radio']:checked").val();
            //alert(sim);
            if (sim < 3) {
                $('.myratings').css('color', 'red');
                $(".myratings").text(sim);
            } else {
                $('.myratings').css('color', 'green');
                $(".myratings").text(sim);
            }
        });
    });
</script>
</body>

</html>