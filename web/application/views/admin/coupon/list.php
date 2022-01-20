
<?php $this->load->view("admin/_partials/head.php") ?>

    
<?php $this->load->view("admin/_partials/menu.php") ?>
<!-- Content -->
<div class="container">
    <div class="row clearfix py-4 kanankiri bg-white pads" style="min-height:800px;">
       
        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="batas"><span><b>Voucher Diskon</b></span></div>
            
            <div class="row" id="hasilsort">
            <?php

            foreach ($kupon as $pro):
                $linkproduk = $pro->kdPromo;
                $harga = $pro->potPromo;
            ?>
    
            <div class="col-lg-4 col-md-4 col-sm-6 col-6 mb-4 ">
                <div class="card">
                <img src="<?php echo $pro->imgPromo; ?>" class="card-img-top imgcard" alt="...">
                <div class="card-body">
                    <div style="width: 100%;overflow: hidden; text-overflow: ellipsis;white-space: nowrap;text-align:center">Kode : <?php echo $pro->kdPromo; ?></div>
                    <div class="text-center"><strong> Potongan <?php echo $harga; ?>%</strong></div>
                </div>
                </div>
            </div>

            <?php endforeach; ?>
            </div>

        </div>

    </div>
    
</div>

<?php $this->load->view("admin/_partials/footer.php") ?> 

</body>
</html>
