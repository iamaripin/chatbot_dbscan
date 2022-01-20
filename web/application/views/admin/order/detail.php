<?php $this->load->view("admin/_partials/head.php") ?>


<?php $this->load->view("admin/_partials/menu.php") ?>
<!-- Content -->
<div class="container" style="min-height:800px;">
    <div class="row clearfix py-4 kanankiri bg-white ">
        <div class="col-lg-12 col-md-12 col-12 mb-4">
            <a href="<?php echo site_url("orders/history"); ?>" class="btn btn-outline-success"><i class="fa fa-arrow-left"></i> Kembali</a>

<!--        <a href="<?php echo site_url("orders/tracking/$order->kdOrder"); ?>" class="btn btn-outline-danger float-end">Lacak <i class="fa fa-arrow-right"></i></a> -->
        </div>


        <?php
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('user.idUser=', $order->idUser);
        $queryuser = $this->db->get();
        $resultuser = $queryuser->result_array();
        ?>
        <div class="col-lg-4 col-md-4 col-12 mb-4">
            <div class="batas"><span><b>Detail Pesanan</b></span></div>
            <div class="row">
                <div class="form-group col-lg-6 col-md-6 col-6 mb-4">
                    <label class="text-secondary text-sm-start">Kode Pesanan</label><br />
                    <?php echo $order->kdOrder ?>
                </div>
                <div class="form-group col-lg-6 col-md-6 col-6 mb-2">
                    <label class="text-secondary text-sm-start">Nama Lengkap</label><br />
                    <?php echo $resultuser[0]['nameUser'] ?>
                </div>

                <div class="form-group col-lg-6 col-md-6 col-6 mb-2">
                    <label class="text-secondary text-sm-start">Status Pesanan</label><br />
                    <?php echo $order->statusOrder ?>
                </div>

                <div class="form-group col-lg-12 col-md-12 col-12 mb-2">
                    <label class="text-secondary text-sm-start">Alamat Pesanan</label><br />
                    <?php echo $order->descOrder ?>
                </div>

                <div class="form-group col-lg-6 col-md-6 col-6 mb-2">
                    <label class="text-secondary text-sm-start">Tanggal Pesanan</label><br />
                    <?php echo $order->dateOrder ?>
                </div>

                <div class="form-group col-lg-6 col-md-6 col-6 mb-2">
                    <label class="text-secondary text-sm-start">Kontak</label><br />
                    <?php echo $resultuser[0]['tlpnUser'] ?>
                </div>

            </div>

        </div>
        <div class="col-lg-8 col-md-8 col-12">
            <div class="batas"><span><b>Detail Produk</b></span></div>
            <div class="table-responsive">
                <table class="table " width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Produk </th>
                            <th>Jumlah</th>
                            <th style='text-align:right;'>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $this->db->select('orderan.qtyOrder,orderan.hargaOrder,orderan.subtotalOrder,produk.imgProduk,produk.nameProduk');
                        $this->db->from('orderan');
                        $this->db->join('produk', 'produk.idProduk=orderan.idProduk');
                        $this->db->where('orderan.kdOrder=', $order->kdOrder);
                        $queryproduk = $this->db->get();
                        $resultproduk = $queryproduk->result_array();
                        $subtotalsf = 0;
                        foreach ($resultproduk as $admin) :
                        ?>
                            <tr>
                                <td width="80px">
                                    <img src="<?php echo $admin['imgProduk'] ?>" width="50px" />
                                </td>
                                <td>
                                    <small><?php echo $admin['nameProduk'] ?></small><br />
                                    <small>Rp. <?php echo number_format($admin['hargaOrder'], 0, ",", "."); ?> </small>
                                    x
                                    <?php echo $admin['qtyOrder'] ?>
                                </td>
                                <td style='text-align:right;'>
                                    <?php echo number_format($admin['subtotalOrder'], 0, ",", "."); ?>
                                </td>
                            </tr>
                        <?php
                            $subtotalsf = $subtotalsf + ($admin['subtotalOrder']);
                        endforeach;

                        $totalsub = number_format($subtotalsf, 0, ",", ".");
                        $ongkir = $order->ongkirOrder;
                        $toalas = $subtotalsf + $ongkir;
                        ?>

                        <tr>
                            <th colspan="2" style="text-align:right;">
                                Subtotal
                            </th>
                            <th style="text-align:right;"><?php echo $totalsub; ?> </th>
                        </tr>
                        <tr>
                            <th colspan="2" style="text-align:right;">
                                Ongkir
                            </th>
                            <th style="text-align:right;" id="ongkirnya"><?php echo number_format($order->ongkirOrder, 0, ",", "."); ?></th>
                        </tr>
                        <tr>
                            <th colspan="2" style="text-align:right;">
                                Total
                            </th>
                            <th style="text-align:right;" id="totalnya"><?php echo number_format($toalas, 0, ",", "."); ?></th>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>

        <div class="col-lg-12 col-md-12 col-12">
            <strong>Silahkan lakukan pembayaran melalui transfer rekening berikut :</strong>
            <hr />
            <div class="row">

                <div class="col-lg-3 col-md-4 col-sm-6 col-6 mb-4 ">
                    <div class="card bg-outline-info">
                        <div class="card-body">
                            <div style="width: 100%;overflow: hidden; text-overflow: ellipsis;white-space: nowrap;text-align:center">BRI</div>
                            <div class="text-center"><strong> 1234567</strong></div>
                            <div style="width: 100%;overflow: hidden; text-overflow: ellipsis;white-space: nowrap;text-align:center">an AF STORE</div>

                        </div>
                    </div>
                </div>

            </div>

            <a href="<?php echo site_url("orders/payment/" . encrypt_url($order->kdOrder)); ?>" class="btn btn-outline-primary"><i class="fa fa-upload"></i> Konfirmasi Pembayaran</a>
        </div>
    </div>

</div>

<?php $this->load->view("admin/_partials/footer.php") ?>
</body>

</html>