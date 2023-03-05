<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PRINT | OUT</title>
    <link rel="shortcut icon" href="<?= base_url(); ?>asset/portal/img/fav.png">
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
                No. Receipt : <?= $nota;?>
                <br>
                No. Meja : <b> <?php $vals = $meja; if($vals){echo($vals);}else{echo("Take Away");}?></b>
                <br>
                Operator : <?= $user;?>
            </td>
        </tr>
        <tr>
            <td>
                <table style="width:100%">
                    <tr style="border-bottom:1px solid black;">
                        <th style="width:40%;" class="text-left">Item's</th>
                        <th style="width:20%;" class="text-left">Harga</th>
                        <th style="width:5%;" class="text-center">Qty</th>
                        <th style="width:20%;" class="text-right">Total</th>
                    </tr>
                    <?php $i=0;?>
                    <?php foreach($detail as $value){ $i+=$value['qty'];?>
                    <tr>
                        <td class="text-left"><?= $value['nama'].substr(0,50);?></td>
                        <td class="currency text-left"><?= $value['harga'];?></td>
                        <td class="number text-center"><?= $value['qty'];?></td>
                        <td class="currency text-right"><?= $value['total'];?></td>
                    </tr>
                    <?php }?>
                </table>
            </td>
        </tr>
        <tr>
            <td style="border-bottom:1px dashed black;">
                <table style="width:100%">
                    <tr colspan="2" style="border-top:1px solid black;">
                        <td class="text-right" style="width:50%;">Qty</td>
                        <td class="text-right"><?=$i;?></td>
                    </tr>
                    <tr colspan="2">
                        <td class="text-right" style="width:50%;">Sub Total</td>
                        <td class="currency text-right"><?=$subtotal;?></td>
                    </tr>
                    <tr colspan="2">
                        <td class="text-right" style="width:50%;">Diskon</td>
                        <td class="currency text-right"><?=$diskon;?></td>
                    </tr>
                    <?php if($type =="Debet" || $type =="E-payment" ) {?>
                    <tr colspan="2">
                        <td class="text-right" style="width:50%;">Fee Merchant</td>
                        <td class="currency text-right"><?=$fee;?></td>
                    </tr>
                    <tr colspan="2">
                        <td class="text-right" style="width:50%;">Total</td>
                        <td class="currency text-right"><?=$total;?></td>
                    </tr>
                    <?php } else {?>
                    <tr colspan="2">
                        <td class="text-right" style="width:50%;">Total</td>
                        <td class="currency text-right"><?=$total;?></td>
                    </tr>
                    <tr colspan="2">
                        <td class="text-right" style="width:50%;">Bayar</td>
                        <td class="currency text-right"><?=$cashin;?></td>
                    </tr>
                    <tr colspan="2">
                        <td class="text-right" style="width:50%;">Uang Kembali</td>
                        <td class="currency text-right"><?=$cashout;?></td>
                    </tr>
                    <?php }?>
                    <tr colspan="2">
                        <td class="text-right" style="width:50%;">Type</td>
                        <td class="text-right"><?=$type;?></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <script src="<?= base_url(); ?>asset/admin/plugins/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>