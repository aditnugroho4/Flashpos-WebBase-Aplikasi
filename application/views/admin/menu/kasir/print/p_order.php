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
    setTimeout("window.close()", 1000);
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
    <table style="width:100%;" cellpadding="0" cellspacing="0">
        <tr colspan="0">
            <td class="text-center">
                <h5>LIST ORDER</h5>
                <b><?= $nota;?></b>
                <h5>MEJA NO.(<?php $vals = $meja; if($vals){echo($vals);}else{echo("Take Away");}?>)</h5>
            </td>
        </tr>
        <?php ?>
        <?php $b=0;?>
        <tr>
            <td>
                <table style="width:100%;">
                    <tr>
                        <td class="text-left"><b>ORDER (<?= $detailOrder[0]['Grup'];?>)</b></td>
                    </tr>
                    <tr style="border-bottom:1px solid black;">
                        <th style="width:80%;" class="text-left">Item's</th>
                        <th style="width:10%;" class="text-center">Qty</th>
                        <th style="width:10%;" class="text-center">Ceklist</th>
                    </tr>
                    <?php $i=0; foreach($detailOrder as $value){ $i++;
                    ?>
                    <tr>
                        <td class="text-left"><?= $value['nama'].substr(0,60);?></td>
                        <td class="number text-center"><?= $value['qty'];?></td>
                        <td class="text-center"></td>
                    </tr>
                    <?php } ?>
                    <tr style="border-top:1px solid black;">
                        <td class="text-right" style="width:50%;">Jumlah</td>
                        <td class="text-right"><?= $i;?></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <script src="<?= base_url(); ?>asset/admin/plugins/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>