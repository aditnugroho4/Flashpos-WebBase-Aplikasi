<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $title?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="<?= base_url(); ?>asset/admin/plugins/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>asset/admin/dist/css/icon.css" rel="stylesheet">
    <link href="<?=base_url('asset/admin')?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css" rel="stylesheet">
    <link href="<?=base_url('asset/admin')?>/plugins/sweetalert2/sweetalert2.min.css" rel="stylesheet">
    <link href="<?=base_url('asset/admin')?>/dist/css/adminlte.css" rel="stylesheet">
    <script src="<?=base_url('asset/admin')?>/plugins/jquery/jquery.js"></script>
</head>

<body class="hold-transition login-page">
    <!-- ini tampilan Login -->
    <?=$_signin;?>
    <!-- jQuery -->
    <script src="<?=base_url('asset/admin')?>/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?=base_url('asset/admin')?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?=base_url('asset/admin')?>/dist/js/adminlte.min.js"></script>
    <!-- jQuery Tools -->
    <script src="<?=base_url('asset/admin')?>/plugins/jquery-base64/jquery.base64.min.js"></script>
    <script src="<?=base_url(); ?>asset/admin/plugins/jquery-validation/jquery.validate.js"></script>
    <script src="<?=base_url(); ?>asset/admin/plugins/sweetalert2/sweetalert2.all.min.js"></script>
</body>

</html>