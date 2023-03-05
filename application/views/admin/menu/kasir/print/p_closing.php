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
    setTimeout("window.close()", 100);
});
</script>
<style type="text/css">
body {
    font-family: monospace;
    font-size: 10px;
    padding: 0;
    margin: 0;
}
</style>

<body>
    <table style="width:100%" cellpadding="0" cellspacing="0">
        <tr colspan="2">
            <td class="text-center"><b>ACITA</b></td>
        </tr>
        <tr colspan="2">
            <td class="text-center"><b>Angkringan & Cafe</b></td>
        </tr>
        <tr>
            <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="2">
                Tanggal : <?= $tanggal;?>
                <br>
                Jam Start : <?= $start;?>
                <br>
                Shift : <?= $shift;?>
                <br>
                Operator : <?= $user;?>
                <br>
                Jam End : <?= $end;?>
            </td>
        </tr>
        <tr>
            <td>
                <table style="width:100%">
                    <tr style="border-bottom:1px solid black;">
                        <th style="width:50%;" class="text-left">Nota</th>
                        <th style="width:10%;" class="text-left">Meja</th>
                        <th style="width:5%;" class="text-center">Qty</th>
                        <th style="width:10%;" class="text-right">Total</th>
                        <th style="width:10%;" class="text-right">Jenis</th>
                    </tr>
                    <?php $i=0;?>
                    <?php foreach($detail as $value){ ?>
                    <tr>
                        <td class="text-left"><?= $value['nota'];?></td>
                        <td class="text-left"><?= $value['meja'];?></td>
                        <td class="number text-center"><?= $value['qty'];?></td>
                        <td class="currency text-right"><?= $value['netto'];?></td>
                        <td class="text-right"><?= $value['jenis'];?></td>
                    </tr>
                    <?php }?>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table style="width:100%">
                    <tr colspan="2">
                        <td class="text-right" style="width:50%;">Bayar Cash</td>
                        <td class="currency text-right"><?=$cash;?></td>
                    </tr>
                    <tr colspan="2">
                        <td class="text-right" style="width:50%;">Bayar Debet</td>
                        <td class="currency text-right"><?=$debet;?></td>
                    </tr>
                    <tr colspan="2">
                        <td class="text-right" style="width:50%;">Bayar E-Payment</td>
                        <td class="currency text-right"><?=$epayment;?></td>
                    </tr>
                    <tr colspan="2">
                        <td class="text-right" style="width:50%;">Total Pemasukan</td>
                        <td class="currency text-right"><?=$total;?></td>
                    </tr>
                    <tr colspan="2">
                        <td class="text-right" style="width:50%;">Total Penjualan</td>
                        <td class="currency text-right"><?=$netto?></td>
                    </tr>
                    <tr colspan="2">
                        <td class="text-right" style="width:50%;">Total Uang Cash</td>
                        <td class="currency text-right"><?=$cashDrawer;?></td>
                    </tr>
                    <tr colspan="2">
                        <td class="text-right" style="width:50%;">Modal</td>
                        <td class="currency text-right"><?=$modal;?></td>
                    </tr>
                    <tr colspan="2">
                        <?php if($cashDrawer > $cash){?>
                        <td class="text-right" style="width:50%;">Lebih</td>
                        <td class="currency text-right"><?= $selisih = ($cashDrawer - $cash);?></td>
                        <?php } else if($cashDrawer < $cash) { ?>
                        <td class="text-right" style="width:50%;">Kurang</td>
                        <td class="currency text-right"><?= $selisih = ($cashDrawer - $cash);?></td>
                        <?php }else if($cashDrawer == $cash) { ?>
                        <td class="text-right" style="width:50%;">Balance</td>
                        <td class="currency text-right"><?= $selisih = ($cashDrawer - $cash);?></td>
                        <?php }?>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <script src="<?= base_url(); ?>asset/admin/plugins/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>