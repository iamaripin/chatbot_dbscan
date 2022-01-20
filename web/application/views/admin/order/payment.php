
<?php $this->load->view("admin/_partials/head.php") ?>

    
<?php $this->load->view("admin/_partials/menu.php") ?>
<!-- Content -->
<div class="container" style="min-height:800px;">
    <div class="row clearfix py-4 kanankiri bg-white " >
        <div class="col-lg-12 col-md-12 col-12 mb-4">
            <a href="<?php echo site_url("orders/history"); ?>" class="btn btn-outline-success"><i class="fa fa-arrow-left"></i> Back</a>

        </div>
        <div class="col-lg-12 col-md-12 col-12 mb-4">
            <div class="batas"><span><b>Payment Confirmation</b></span></div>
            <form action="<?php echo site_url('orders/paymentsend') ?>" method="post" enctype="multipart/form-data" >
            <div class="row">
                <div class="form-group col-lg-12 col-md-12 col-12 mb-2 bg-light text-center">
                    <label class="mb-2">No. Invoice : <?php echo $order->kdJual ?></label>
                    <input class="form-control" type="hidden" name="kdJual" id="kdJual" placeholder="" value="<?php echo $order->kdOrder ?>" required/>
                </div>
                <div class="form-group col-lg-12 col-md-12 col-12 mb-2">
                    <label class="mb-2">Transfer Ke Bank?</label>
                    <select class="form-control" id="banksend" name="banksend" required>
                        <option value=""> Pilih Bank</option> 
                        <option value="BCA"> BCA</option> 
                        <option value="BNI"> BNI</option> 
                        <option value="BRI"> BRI</option> 
                        <option value="Mandiri"> Mandiri</option> 
                        <option value="gopay"> Gopay</option>
                        <option value="OVO"> OVO</option>
                        <option value="Alfamart"> Alfamart</option>
                        <option value="Indomaret"> Indomaret</option>
                        
                    </select>
                </div>
                <div class="form-group col-lg-6 col-md-6 col-12 mb-2">
                    <label class="mb-2">Nama Pengirim (Sesuai Nama Rekening)</label>
                    <input class="form-control" type="text" name="namasend" id="namasend" placeholder="" value="" required/>
                </div>                
                <div class="form-group col-lg-6 col-md-6 col-12 mb-2">
                    <label class="mb-2">Upload Bukti Transfer*</label>
                    <input class="form-control col-lg-4" type="file" name="image" accept="image/*"/>
                </div>
                
            </div>
            
                <hr/>

                <input class="btn btn-success col-lg-4 col-md-4 col-12 rounded-pill" type="submit" id="submitbutton" name="btn" value="Konfirmasi Pembayaran" />
            </form>
    
        </div>
        
    </div>
    
</div>

<?php $this->load->view("admin/_partials/footer.php") ?> 
</body>
</html>
