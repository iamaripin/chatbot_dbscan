<?php $this->load->view("admin/_partials/head.php") ?>


<?php $this->load->view("admin/_partials/menui.php") ?>
<!-- Content -->
<div class="container">
    <div class="row clearfix py-4 kanankiri bg-white pads">
        <div class="col-lg-12 col-md-12 col-12">
            <div class="batas mb-4"><span><b>KERANJANG BELANJA</b></span></div>
        </div>
        <div class="col-lg-12 col-md-12 col-12">
            <div class="page-wrap d-flex flex-row align-items-center" style="height:35vmax;">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-12 text-center">
                            <div class="mb-4 lead">
                                <p>
                                    <h1><b>Yaaaahhh.......</b></h1>
                                    <h3>Keranjang Kosong, Yuk Belanja Lagi.</h3>
                                </p>
                            </div>
                            <a href="<?php echo site_url('produks') ?>" class="btn btn-link">Lihat Produk</a>
                        </div>
                    </div>
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
                $this->db->limit('6');
                $queryproduk = $this->db->get();
                $resultproduk = $queryproduk->result_array();

                foreach ($resultproduk as $pro) :
                    $linkproduk = str_replace(" ", "-", $pro['nameProduk']);
                    $harga = number_format($pro['jualProduk'], 0, ',', '.');
                ?>

                    <li class="item">
                        <a href="<?php echo site_url('produks/det/' . $linkproduk) ?>" class="text-decoration-none text-dark">
                            <div class="card">
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

<?php $this->load->view("admin/_partials/modal.php") ?>
<?php $this->load->view("admin/_partials/footer.php") ?>
<script>
    //$('#search').on('click', function (e) {
    function deleteConfirm(url) {
        //alert(url);
        $('#btn-delete').attr('href', url);
        $('#deleteModal').modal('show');
    }

    $(".hidemodal").click(function() {
        $("#deleteModal").modal('hide');
    });
</script>
</body>

</html>