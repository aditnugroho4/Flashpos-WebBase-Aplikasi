<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PRINT | OUT</title>
    <link rel="shortcut icon" href="<?= base_url(); ?>asset/portal/img/fav.png">
    <link href="<?= base_url(); ?>asset/admin/plugins/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>asset/admin/dist/css/icon.css" rel="stylesheet">
    <link href="<?= base_url(); ?>asset/admin/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <script src="<?= base_url(); ?>asset/admin/plugins/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>asset/admin/plugins/globalize/globalize.js"></script>
    <script src="<?php echo base_url(); ?>asset/admin/plugins/globalize/cultures/globalize.culture.id-ID.js"></script>
</head>
<script>
$(function() {
    window.print();
    setTimeout("window.close()", 5000);
});
</script>

<body>
        <div>
            <div class="row">
                <div class="col-12">
                    <div class="text-center">
                        <h2>ACITA</h2>
                        <h4>ANGKRINGAN & CAFE'</h4>
                        <h5>Form Permintaan <?= $akun;?></h5>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table width="100%" style="border-bottom:1px solid black;">
                        <tr>
                            <td width="5%">Tanggal</td>
                            <td width="1%" class="text-left"> : </td>
                            <td width="20%" class="text-left"><?= $tanggal;?></td>
                        </tr>
                        <tr>
                            <td>Dibuat</td>
                            <td>:</td>
                            <td><?= $user;?></td>
                        </tr>
                        <tr>
                            <td>No. PO</td>
                            <td>:</td>
                            <td><?= $faktur;?></td>
                        </tr>
                    </table>
                </div>
                <hr>
                <div class="col-md-12">
                    <table width="100%">
                        <tr style="border-bottom:1px solid black;">
                            <th style="width:5%;" class="text-left">Kode</th>
                            <th style="width:50%;" class="text-left">Deskripsi</th>
                            <th style="width:5%;" class="text-right">Qty</th>
                        </tr>
                        <?php $t=1; $i=0;?>
                        <?php foreach($detail as $value){$t++; $i+=$value['qty'];?>
                        <tr style="font-size:10px;">
                            <td><?= $value['kode'];?></td>
                            <td><?= $value['nama'].substr(0,50);?></td>
                            <td class="text-right"><?= $value['qty'];?></td>
                        </tr>
                        <?php }?>
                        <tr style="border-top:1px solid black;">
                            <th></th>
                            <th class="text-right" style="width:50%;">Jumlah</th>
                            <th class="text-right"><?=$i;?></th>
                        </tr>
                        <tr>
                            <th></th>
                            <th class="text-right" style="width:50%;">Item's</th>
                            <th class="text-right"><?=$t;?></th>
                        </tr>
                    </table>
                    <div class="col-lg-12">
                        <div style="float:right; margin-top:15px;">
                            <h5 style="margin-bottom:50px;">TTD</h5>
                            <p>(Kepala Toko)</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <hr>
                <div class="col-12">
                    <div class="text-center">
                        <h4>ACITA</h4>
                        <h5>Jl.Kayumanis No.25 Kel.Kencana, Kec.Tanah Sareal, Kota Bogor.</h5>
                    </div>
                </div>
            </div>
        </div>
    <script src="<?= base_url(); ?>asset/admin/plugins/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>