<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PRINT | OUT</title>
    <link href="<?= base_url(); ?>asset/admin/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="<?= base_url(); ?>asset/admin/plugins/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>asset/admin/plugins/globalize/globalize.js"></script>
    <script src="<?php echo base_url(); ?>asset/admin/plugins/globalize/cultures/globalize.culture.id-ID.js"></script>
</head>
<script>
$(function() {
    Globalize.culture("id-ID");
    $(".currency").each(function() {
        $(this).html(Globalize.format(Globalize.parseInt($(this).html()), "c0"));
    });
    $(".number").each(function() {
        $(this).html(Globalize.format(Globalize.parseInt($(this).html()), "n0"));
    });
    window.print();
    setTimeout("window.close()", 1000);
});
</script>
<body>
    <table style="width:100%" cellpadding="0" cellspacing="0">
        <tr colspan="2">
            <td class="text-center"><b>ACITA</b></td>
        </tr>
        <tr colspan="2">
            <td class="text-center"><b>Angkringan & Cafe</b></td>
        </tr>
        <tr>
            <td colspan="2">LAPORAN PENJUALAN</td>
        </tr>
        <tr>
            <td colspan="2">
                Tanggal : <?= $dateStart;?> s/d <?= $dateEnd;?>
                <br>
                Operator : <?= $user;?>
            </td>
        </tr>
    </table>
    <table id="tblPrint" class="table table-striped table-bordered table-hover ">
        <thead>
            <tr>
                <th rowspan="2">NO</th>
                <th rowspan="2" class="text-center"><i class="fas fa-box"></i> Kode</th>
                <th colspan="5" class="text-center"><i class="fas fa-clipboard-check"></i> Item Product</th>
                <th colspan="2" class="text-center"><i class="fas fa-boxes"></i> JUMLAH</th>
            </tr>
            <tr>
                <th>Katagori</th>
                <th>Item</th>
                <th>Harga Pokok</th>
                <th>Diskon</th>
                <th>Harga Jual</th>
                <th>Terjual</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php $i=1;
            $Items =0;
            $Modal =0;
            $Diskon =0;
            $Penjualan =0;
            $Laba =0;
            foreach($data as $value){ ?>
                    <tr>
                        <td class="text-left"><?= $i++?></td>
                        <td class="text-left"><?= $value['kode'];?></td>
                        <td class="text-left"><?= $value['katagori'];?></td>
                        <td class="text-left"><?= $value['nama'];?></td>
                        <td class="currency text-left"><?= $value['harga_dasar'];?></td>
                        <td class="currency text-left"><?= $value['diskon'];?></td>
                        <td class="currency text-left"><?= $value['harga'];?></td>
                        <td class="number text-center"><?= $value['terjual'];?></td>
                        <td class="currency text-right"><?= $value['total'];?></td>
                    </tr>
            <?php 
            $Items +=$value['terjual'];
            $Modal += ($value['harga_dasar']*$value['terjual']);
            $Diskon += ($value['diskon']*$value['terjual']);
            $Penjualan += $value['total'];
            $Laba = ($Penjualan - $Modal);
        }?>
            <tr>
            <table style="width:100%">
                <tr colspan="2" style="border-top:2px solid black;">
                    <td class="text-right" style="width:50%;">ITEM TERJUAL</td>
                    <td class="text-right number"><?= $Items;?></td>
                </tr>
                <tr colspan="2" >
                    <td class="text-right " style="width:50%;">TOTAL MODAL</td>
                    <td class="text-right currency "><?= $Modal;?></td>
                </tr>
                <tr colspan="2">
                    <td class="text-right" style="width:50%;">DISKON</td>
                    <td class="text-right currency"><?= $Diskon;?></td>
                </tr>
                <tr colspan="2">
                    <td class="text-right" style="width:50%;">PENJUALAN KOTOR</td>
                    <td class="text-right currency"><?= $Penjualan;?>.</td>
                </tr>
                <tr colspan="2">
                    <td class="text-right" style="width:50%;">LABA BERSIH</td>
                    <td class="text-right currency"><?= $Laba;?></td>
                </tr>
            </table>
            </tr>
        </tbody>
    </table>
    
    <script src="<?= base_url(); ?>asset/admin/plugins/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>