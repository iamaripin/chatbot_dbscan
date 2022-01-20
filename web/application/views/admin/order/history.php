<?php $this->load->view("admin/_partials/head.php") ?>


<?php $this->load->view("admin/_partials/menu.php") ?>
<!-- Content -->
<div class="container">
    <div class="row clearfix py-4 kanankiri bg-white pads" style="min-height:800px;">

        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="batas"><span><b>Pesanan Saya</b></span></div>
            <div class="table-responsive">
                <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Tanggal</th>
                            <th>Total</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($orders as $track) :
                            if ($track->statusOrder == '') {
                                $status = "Menunggu Pembayaran";
                                $link = "orders/det/" . encrypt_url($track->kdOrder);
                            } else {
                                $status = $track->statusOrder;
                                $link = "orders/det/" . encrypt_url($track->kdOrder);
                            }
                        ?>
                            <tr>
                                <td>
                                    <a href="<?php echo site_url($link); ?>" class="text-decoration-none"><?php echo $track->kdOrder ?></a>
                                </td>
                                <td>
                                    <?php echo $track->dateOrder ?>
                                </td>
                                <td align="right">
                                    <?php echo number_format($track->subtotalOrder, 0, ",", ".") ?>
                                </td>
                                <td>
                                    <?php echo $status ?>
                                </td>
                            </tr>
                        <?php
                        endforeach;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</div>

<?php $this->load->view("admin/_partials/footer.php") ?>
<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
</script>
</body>

</html>