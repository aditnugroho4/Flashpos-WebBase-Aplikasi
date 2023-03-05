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
                    <h4>ANGKRINGAN</h4>
                    <h5>Rincian Pembelian</h5>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table>
                    <tr>
                        <td width="5%">Tanggal</td>
                        <td> : </td>
                        <td><?= $tanggal;?></td>
                    </tr>
                    <tr>
                        <td>User</td>
                        <td>:</td>
                        <td><?= $user;?></td>
                    </tr>
                    <tr>
                        <td>Cetak</td>
                        <td>:</td>
                        <td>Stock Pembelian</td>
                    </tr>
                </table>
            </div>
            <hr>
            <div class="col-md-12">
                <table>
                    <tr style="border-bottom:1px solid black;">
                        <th style="width:5%;text-center;">#</th>
                        <th style="width:5%;text-center;">Kode</th>
                        <th style="width:50%;text-center;">Nama</th>
                        <th style="width:5%;text-center;">Qty</th>
                        <th style="width:5%;text-center;">Batch</th>
                    </tr>
                    <?php $i=0;?>
                    <?php foreach($detail as $value){ $i+=$value[3];?>
                    <tr>
                        <td><?= $value[0];?></td>
                        <td><?= $value[1].substr(0,50);?></td>
                        <td><?= $value[2];?></td>
                        <td class="text-center"><?= $value[3];?></td>
                        <td class="text-center"><?= $value[11];?></td>
                    </tr>
                    <?php }?>
                    <tr>
                        <th></th>
                        <th class="text-right" style="width:50%;">Jumlah</th>
                        <th class="text-right"><?=$i;?></th>
                        <th></th>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row">
            <hr>
            <div class="col-12">
                <div class="text-center">
                    <h4>Akbar Grup Boutique & Resto</h4>
                    <h5>Jl.Kayumanis No.25 Kel.Kencana, Kec.Tanah Sareal, Kota Bogor.</h5>
                </div>
            </div>
        </div>
    </div>
    <script src="<?= base_url(); ?>asset/admin/plugins/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>