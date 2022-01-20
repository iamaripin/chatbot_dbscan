<?php $this->load->view("admin/_partials/head.php") ?>


<?php $this->load->view("admin/_partials/menui.php") ?>
<!-- Content -->
<div class="container">
    <div class="row clearfix py-4 kanankiri bg-white pads">
        <div class="col-lg-12 col-md-12 col-12">

            <div class="batas mb-4"><span><b>CHECKOUT</b></span></div>
        </div>
        <div class="col-lg-8 col-md-8 col-12">
            <div class="table-responsive">
                <table class="table" id="myTable" width="100%" cellspacing="0">
                    <tbody>
                        <?php $no = 0;
                        $subtotalsf = 0;
                        foreach ($carts as $admin) :
                            $no++;
                        ?>
                            <tr>
                                <td width="80px">
                                    <img src="<?php echo $admin->imgProduk ?>" width="50px" />
                                </td>
                                <td>
                                    <small><?php echo $admin->nameProduk ?></small><br />
                                    <small>Rp. <?php echo number_format($admin->hargaTemp, 0, ",", "."); ?> </small>

                                    <div class="input-group mb-3">
                                        <a href="<?php echo site_url('carts/minus/' . $admin->idTemp) ?>" class="text-decoration-none"><span class="input-group-text" id="minus" style="width: auto;height:20px;cursor:pointer;border-radius:none;">-</span></a>

                                        <input type="number" class="" name="qty" id="qty" value="<?php echo $admin->qtyTemp ?>" min='0' style="width:50px;border:1px solid #ddd;height:20px;text-align:center;font-size:12px;">

                                        <a href="<?php echo site_url('carts/plus/' . $admin->idTemp) ?>" class="text-decoration-none"><span class="input-group-text" id="plus" style="width: auto;height:20px;cursor:pointer;border-radius:none;">+</span></a>
                                    </div>
                                </td>
                                <td style='text-align:right;'>
                                    <?php echo number_format($admin->subtotalTemp, 0, ",", "."); ?>
                                </td>
                                <td style='text-align:center'>
                                    <a onclick="deleteConfirm('<?php echo site_url('carts/delete/' . $admin->idTemp) ?>')" href="#!" class="text-danger "><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php
                            $subtotalsf = $subtotalsf + ($admin->hargaTemp * $admin->qtyTemp);

                        endforeach;

                        $totalsub = number_format($subtotalsf, 0, ",", ".");

                        ?>

                    </tbody>
                </table>
            </div>

        </div>
        <div class="col-lg-4 col-md-4 col-12">

            <div class="form-group">
                <label for="nameDepartemen">Subtotal</label>
                <input class="form-control" type="hidden" name="subtotal" placeholder="" value="<?php echo $subtotalsf; ?>" />
                <?php echo "<strong class='float-end'>Rp. $totalsub</strong>"; ?>
            </div>
            <hr />

            <a href="<?php echo site_url('carts/oncheckout'); ?>"><input class="btn btn-success col-lg-12 col-md-12 col-12 rounded-pill mb-4" type="submit" value="Langsung Bayar" /></a>


            <a href="<?php echo site_url('produks'); ?>"><input class="btn btn-outline-secondary col-lg-12 col-md-12 col-12 rounded-pill" type="button" name="btn" value="Belanja Kembali" /></a>

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
                    $harga = number_format($pro['hargaProduk'], 0, ',', '.');
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