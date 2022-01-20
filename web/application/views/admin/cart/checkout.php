<?php $this->load->view("admin/_partials/head.php") ?>


<?php $this->load->view("admin/_partials/menui.php") ?>
<!-- Content -->
<div class="container">
    <div class="row clearfix py-4 kanankiri bg-white pads">
        <div class="col-lg-8 col-md-8 col-12 mb-3">
            <div class="batas mb-4"><span><b>Data Pembeli</b></span></div>
            <form action="<?php echo site_url('carts/checkoutx') ?>" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="form-group col-lg-12 col-md-12 col-12 mb-4">
                        <label class="mb-2">Email</label>
                        <input class="form-control" type="text" name="emailpembeli" id="emailpembeli" placeholder="" value="" required />
                        <input class="" type="checkbox" name="kirimpenawaran" /> Kirim Saya Berita dan Penawaran
                    </div>
                    <div class="form-group col-lg-6 col-md-6 col-12">
                        <label class="mb-2">Nama Lengkap</label>
                        <input class="form-control" type="text" name="namapembeli" id="namapembeli" placeholder="" value="" required />
                    </div>
                    <div class="form-group col-lg-6 col-md-6 col-12">
                        <label class="mb-2">Kontak</label>
                        <input class="form-control" type="text" name="kontakpembeli" id="kontakpembeli" placeholder="" value="" required />
                    </div>
                    <div class="form-group col-lg-12 col-md-12 col-12">
                        <label class="mb-2">Alamat Pengiriman</label>
                        <textarea class="form-control" name="alamatpembeli" id="alamatpembeli" required></textarea>
                    </div>
                    <div class="form-group col-lg-6 col-md-6 col-12">
                        <label class="mb-2">Provinsi</label>
                        <select class="form-control" id="sel11" required>
                            <option value=""> Pilih Provinsi</option>
                        </select>
                    </div>

                    <div class="form-group col-lg-6 col-md-6 col-12 mb-2">
                        <label class="mb-2">Kota</label>
                        <select class="form-control" id="sel22" name="sel22" disabled>
                            <option value=""> Pilih Kota</option>
                        </select>
                    </div>
                    <div class="form-group col-lg-6 col-md-6 col-12">
                        <label class="mb-2">Kode Pos</label>
                        <input class="form-control" type="text" name="kodepos" id="kodepos" placeholder="Kode Pos" value="" required />
                    </div>
                    <div class="form-group col-lg-6 col-md-6 col-12">
                        <label class="mb-2"></label>
                    </div>
                    <div class="form-group col-lg-6 col-md-6 col-12 mb-2">
                        <label class="mb-2">Jasa Pengiriman</label>
                        <select class="form-control" id="kurir" name="kurir" disabled required>
                            <option value=""> Pilih Kurir</option>
                            <option value="jne">JNE</option>
                            <option value="pos">J&T</option>
                            <option value="pos">SiCepat</option>
                            <option value="tiki">TIKI</option>
                            <option value="pos">POS Indonesia</option>
                        </select>
                    </div>

                    <div class="form-group col-lg-6 col-md-6 col-12 mb-2">
                        <label class="mb-2">Pilih Ongkir</label>
                        <select class="form-control" id="hasil" required>
                            <option value=""> Pilih Ongkir </option>
                        </select>
                    </div>

                    <div class="form-group col-lg-6 col-md-6 col-12 mb-2">
                        <label class="mb-2" for="descDepartemen">Voucher</label>
                        <input class="form-control" type="hidden" name="idJual" placeholder="" value="<?php echo $checkout[0]->kdJual ?>" />
                        <input class="form-control" type="text" name="kupon" id="kupon" placeholder="" value="<?php echo $checkout[0]->kdPromo ?>" />
                    </div>

                    <input type="hidden" value="" id="kota" name="kota" />
                    <input type="hidden" value="" id="subtotalnya" name="subtotalnya" />
                    <input type="hidden" value="0" id="ongkirbeli" name="ongkirbeli" />
                    <input type="hidden" value="0" id="potongan" name="potongan" />
                    <input type="hidden" value="" id="total" name="total" />
                </div>

                <hr />

                <input class="btn btn-success col-lg-4 col-md-4 col-12 rounded-pill" disabled type="submit" id="submitbutton" name="btn" value="Langsung Bayar" />
            </form>
        </div>
        <div class="col-lg-4 col-md-4 col-12">
            <div class="batas mb-4"><span><b>Detail Pesanan</b></span></div>
            <div class="table-responsive bg-light">
                <table class="table" id="myTable" width="100%" cellspacing="0">
                    <tbody>
                        <?php $no = 0;
                        $subtotalsf = 0;
                        foreach ($checkout as $admin) :
                            $no++;
                        ?>
                            <tr>
                                <td width="80px" style='font-size:13px;'>
                                    <img src="<?php echo $admin->imgProduk ?>" width="50px" />
                                </td>
                                <td style='font-size:13px;'>
                                    <small><?php echo $admin->nameProduk ?></small><br />
                                    <small>Rp. <?php echo number_format($admin->hargaTemp, 0, ",", "."); ?> </small>

                                    x <?php echo $admin->qtyTemp ?>
                                </td>
                                <td style='text-align:right;font-size:13px;'>
                                    <?php echo number_format($admin->subtotalTemp, 0, ",", "."); ?>
                                </td>
                            </tr>
                        <?php
                            $subtotalsf = $subtotalsf + $admin->subtotalTemp;

                        endforeach;

                        $totalsub = number_format($subtotalsf, 0, ",", ".");

                        ?>
                        <input type="hidden" value="<?php echo $subtotalsf ?>" id="subtotalsd" />
                        <tr>
                            <th colspan="2" style="text-align:right;font-size:12px;">
                                Subtotal
                            </th>
                            <th style="text-align:right;font-size:12px;"><?php echo $totalsub; ?> </th>
                        </tr>
                        <tr>
                            <th colspan="2" style="text-align:right;font-size:12px;">
                                Potongan
                            </th>
                            <th style="text-align:right;font-size:12px;" id="potongannya"></th>
                        </tr>
                        <tr>
                            <th colspan="2" style="text-align:right;font-size:12px;">
                                Ongkir
                            </th>
                            <th style="text-align:right;font-size:12px;" id="ongkirnya"></th>
                        </tr>
                        <tr>
                            <th colspan="2" style="text-align:right;font-size:12px;">
                                Total
                            </th>
                            <th style="text-align:right;font-size:12px;" id="totalnya"></th>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>

<?php $this->load->view("admin/_partials/footer.php") ?>
<script type="text/javascript">
    function getLokasi() {
        //var $op = $("#sel1"), $op1 = $("#sel11");
        var $op1 = $("#sel11");
        $.getJSON("<?php echo base_url('carts/provinsi') ?>", function(data) {
            $.each(data, function(i, field) {
                //$op.append('<option value="'+field.province_id+'">'+field.province+'</option>'); 
                $op1.append('<option value="' + field.province_id + '">' + field.province + '</option>');
            });
        });
    }

    getLokasi();

    $("#sel11").on("change", function(e) {
        e.preventDefault();
        var option = $('option:selected', this).val();
        $('#sel22 option:gt(0)').remove();
        $('#kurir').val('');
        if (option === '') {
            alert('null');
            $("#sel22").prop("disabled", true);
            $("#kurir").prop("disabled", true);
        } else {
            $("#sel22").prop("disabled", false);
            getKota1(option);
        }
    });


    $("#sel22").on("change", function(e) {
        e.preventDefault();
        var option = $('option:selected', this).val();
        $('#kurir').val('');
        if (option === '') {
            alert('null');
            $("#kurir").prop("disabled", true);
        } else {
            $("#kurir").prop("disabled", false);
        }
    });


    $("#kurir").on("change", function(e) {
        e.preventDefault();
        var option = $('option:selected', this).val();
        var origin = 152;
        var dess = $("#sel22").val();
        var qty = 1;

        var idkota = dess.split(";");
        var des = idkota[0];

        document.getElementById("kota").value = idkota[1];

        getOrigin(origin, des, qty, option);
    });


    function getOrigin(origin, des, qty, cour) {
        var $op = $("#hasil");
        var i, j, x = "";
        var biaya;
        $.getJSON("<?php echo base_url('carts/tarif/') ?>" + origin + "/" + des + "/" + qty + "/" + cour, function(data) {
            $.each(data, function(i, field) {

                for (i in field.costs) {
                    // x += "<div style='border:1px solid #dbdbdb;padding:10px;cursor:pointer;'><p class='mb-0'><b>" + field.costs[i].service + "</b> : "+field.costs[i].description+"</p>";
                    for (j in field.costs[i].cost) {
                        //x += "<b>Ongkir" + "</b> : "+field.costs[i].cost[j].value +"<br>"+"<b>Estimasi" + "</b> : "+field.costs[i].cost[j].etd+"<br>"+field.costs[i].cost[j].note;
                        biaya = field.costs[i].cost[j].value;

                        $op.append('<option value="' + field.costs[i].service + ';' + biaya + '">' + field.costs[i].service + ', Rp. ' + biaya + ', Estimasi ' + field.costs[i].cost[j].etd + ' Hari</option>');
                    }
                    //x += "<input class='form-check-input pilihongkir' type='radio' value='' name='flexCheckDefault'></div>";                
                }
                //$op.html(x);
            });
        });

    }


    function getKota1(idpro) {
        var $op = $("#sel22");
        $.getJSON("<?php echo base_url('carts/kota/') ?>" + idpro, function(data) {
            $.each(data, function(i, field) {
                $op.append('<option value="' + field.city_id + ';' + field.city_name + '">' + field.type + ' ' + field.city_name + '</option>');
            });
        });
    }

    $("#hasil").on("change", function(e) {
        e.preventDefault();
        var option = $('option:selected', this).val();
        var subtotal = eval($('#subtotalsd').val());
        var potongan = eval($('#potongan').val());
        var onglkirnya = option.split(";");

        totalnya = subtotal - potongan + eval(onglkirnya[1]);

        document.getElementById("ongkirnya").innerHTML = "<b>" + formatNumber(onglkirnya[1]) + "</b>";
        document.getElementById("totalnya").innerHTML = "<b>" + formatNumber(totalnya) + "</b>";


        document.getElementById("subtotalnya").value = subtotal;
        document.getElementById("ongkirbeli").value = onglkirnya[1];
        document.getElementById("total").value = totalnya;
        $("#submitbutton").prop("disabled", false);
    });


    $("#sel11").on("click", function(e) {
        e.preventDefault();
        var kupon = $('#kupon').val();
        var subtotal = eval($('#subtotalsd').val());
        var ongkir = eval($('#ongkirbeli').val());
        if (kupon != '') {
            $.ajax({
                url: '<?= base_url(); ?>carts/cekkupon',
                method: 'POST',
                data: {
                    kupon: kupon,
                    subtotal: subtotal,
                    ongkir: ongkir
                },
                success: function(data) {
                    //$('#potongan').html(data)
                    totalnya = eval(subtotal) - eval(data) + eval(ongkir);

                    document.getElementById("potongannya").innerHTML = "<b>" + formatNumber(data) + "</b>";
                    document.getElementById("totalnya").innerHTML = "<b>" + formatNumber(totalnya) + "</b>";

                    document.getElementById("potongan").value = data;
                    document.getElementById("total").value = totalnya;
                }
            });
        }
    });

    $("#kupon").on("change", function(e) {
        e.preventDefault();
        var kupon = $('#kupon').val();
        var subtotal = eval($('#subtotalsd').val());
        var ongkir = eval($('#ongkirbeli').val());
        if (kupon != '') {
            $.ajax({
                url: '<?= base_url(); ?>carts/cekkupon',
                method: 'POST',
                data: {
                    kupon: kupon,
                    subtotal: subtotal,
                    ongkir: ongkir
                },
                success: function(data) {
                    //$('#potongan').html(data)
                    totalnya = eval(subtotal) - eval(data) + eval(ongkir);

                    document.getElementById("potongannya").innerHTML = "<b>" + formatNumber(data) + "</b>";
                    document.getElementById("totalnya").innerHTML = "<b>" + formatNumber(totalnya) + "</b>";

                    document.getElementById("potongan").value = data;
                    document.getElementById("total").value = totalnya;
                }
            });
        }
    });

    $("#emailpembeli").on("change", function(e) {
        e.preventDefault();
        var emailpembeli = $('#emailpembeli').val();
        if (emailpembeli != '') {
            $.ajax({
                url: '<?= base_url(); ?>carts/cekmitra',
                method: 'POST',
                data: {
                    emailpembeli: emailpembeli
                },
                success: function(data) {
                    datanya = data.split(";");

                    document.getElementById("namapembeli").value = datanya[0];
                    document.getElementById("kontakpembeli").value = datanya[1];
                    document.getElementById("alamatpembeli").value = datanya[2];
                    document.getElementById("kodepos").value = datanya[3];
                }
            });
        }
    });

    function formatNumber(num) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.')
    }
</script>
</body>

</html>