
<?php $this->load->view("admin/_partials/head.php") ?>

    
<?php $this->load->view("admin/_partials/menu.php") ?>
<!-- Content -->
<div class="container">
    <div class="row clearfix py-4 kanankiri bg-white pads" style="min-height:800px;">
       
        <div class="col-lg-8 col-md-8 col-sm-6 col-12">
            <div class="form-group">
                <label class="mb-2">Order Code</label>
                <input class="form-control" type="text" name="kdJual" id="kdJual" placeholder="Insert Order Code" value="<?php echo $order->kdJual;?>" />
            </div>
            <br/>
            <input class="btn btn-success col-lg-4 col-md-4 col-12 mb-4 rounded-pill" type="button" name="btn" onclick="sortby()" value="Tracking Order" />
            
            <div id="hasilsort"></div>
        </div>

    </div>
    
</div>

<?php $this->load->view("admin/_partials/footer.php") ?> 
<script>
function sortby() {
    var x = document.getElementById("kdJual").value;   
   
    if (x != '') {         
        $.ajax({
            url: '<?= base_url(); ?>orders/sortproduk',
            method: 'POST',
            data: {
                x: x
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
