<?php $this->load->view("admin/_partials/head.php") ?>

<?php $this->load->view("admin/_partials/menu.php") ?>


<!-- Content -->
<div class="container">

    <div class="row clearfix py-4 kanankiri bg-white pads">

        <div class="col-lg-12 col-md-12 col-12">

            <div class="batas mb-4"><span><b><?php echo $produk[1]->katProduk ?></b></span></div>
        </div>
        <div class="col-lg-12 mb-4">
            <select class="mdb-select md-outline md-form" searchable="Search here.." id="myselect" onchange="sortby()">
            <option value="" disabled selected>Urut Berdasarkan</option>
                <option value="1">Harga, Rendah ke Tingg</option>
                <option value="2">harga, Tinggi ke Rendah</option>
                <option value="3">Nama, A-Z</option>
                <option value="4">Nama, Z-A</option>
                <option value="5">Paling Laris</option>
            </select>
            <input type="hidden" value="<?php echo $produk[1]->katProduk ?>" id="kategori">
        </div>
    </div>

    <div class="row kanankiri bg-white pads" id="hasilsort">
        <?php

        foreach ($produk as $pro) :
            $linkproduk = str_replace(" ", "-", $pro->nameProduk);
            $harga = number_format($pro->hargaProduk, 0, ',', '.');
        ?>

            <div class="col-lg-3 col-md-4 col-sm-6 col-6 mb-4">
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
        var i = document.getElementById("kategori").value;
        //alert(x);
        if (x != '') {
            $.ajax({
                url: '<?= base_url(); ?>produks/sortproduk',
                method: 'POST',
                data: {
                    x: x,
                    i: i
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