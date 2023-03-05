<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?=$Seo['data']['title']; ?></title>

    <meta name="title" content="<?=$Seo['data']['title'];?>" />
    <meta name="url" content="<?=site_url().$Seo['data']['link'];?>" />
    <meta name="author" content="<?=$Seo['data']['author'];?>" />
    <meta name="description" content="<?=$Seo['data']['deskripsi'];?>">
    <meta name="keywords" content="<?=$Seo['data']['keyword'];?>">
    <meta name="image" content="<?=site_url().str_replace('-','/',$Seo['data']['img']);?>">

    <meta property="fb:app_id" content="" />
    <meta property="og:url" content="<?=site_url().$Seo['data']['link'];?>" />
    <meta property="og:title" content="<?=$Seo['data']['title'];?>" />
    <meta property="og:type" content="website" />
    <meta property="og:image:url" content="<?=site_url().str_replace('-','/',$Seo['data']['img']);?>" />
    <meta property="og:image:alt" content="<?=$Seo['data']['title'];?>" />
    <meta property="og:description" content="<?=$Seo['data']['deskripsi'];?>" />
    <meta property="og:site_name" content="RSUD LEUWILIANG" />
    <meta property="article:author" content="<?=$Seo['data']['author'];?>" />

    <meta name="twitter:card" content="summary" />
    <meta name="twitter:site" content="@rsudleuwiliang" />
    <meta name="twitter:creator" content="@rsudleuwiliang" />
    <meta name="twitter:url" content="<?=site_url().$Seo['data']['link'];?>" />
    <meta name="twitter:title" content="<?=$Seo['data']['title'];?>" />
    <meta name="twitter:description" content="<?=$Seo['data']['deskripsi'];?>" />
    <meta name="twitter:image" content="<?=site_url().str_replace('-','/',$Seo['data']['img']);?>" />
    <meta name="twitter:image:alt" content="<?=$Seo['data']['deskripsi'];?>" />

    <meta name="robots" content="index, follow" />
    <meta name="googlebot" content="index,follow" />
    <meta name="Googlebot-Image" content="follow, all" />
    <meta name="Scooter" content="follow, all" />
    <meta name="msnbot" content="follow, all" />
    <meta name="alexabot" content="follow, all" />
    <meta name="Slurp" content="follow, all" />
    <meta name="ZyBorg" content="follow, all" />

    <link href="<?=base_url(); ?>asset/portal/img/fav.png" rel="shortcut icon" />

    <link rel="stylesheet" href="<?=base_url(); ?>asset/portal/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?=base_url(); ?>asset/portal/font-awesome/css/all.min.css" />
    <link rel="stylesheet" href="<?=base_url(); ?>asset/portal/plugins/cubeportfolio/css/cubeportfolio.min.css" />
    <link rel="stylesheet" href="<?=base_url(); ?>asset/portal/css/owl.carousel.css" media="screen" />
    <link rel="stylesheet" href="<?=base_url(); ?>asset/portal/css/owl.theme.css" media="screen" />
    <link rel="stylesheet" href="<?=base_url(); ?>asset/portal/css/nivo-lightbox-theme/default/default.css" />
    <link rel="stylesheet" href="<?=base_url(); ?>asset/portal/css/animate.css" />
    <link rel="stylesheet" href="<?=base_url(); ?>asset/admin/plugins/pagination/pagination-min.css" />
    <link rel="stylesheet" id="bodybg" href="<?=base_url(); ?>asset/portal/bodybg/bg1.css" />
    <link rel="stylesheet" id="t-colors" href="<?=base_url(); ?>asset/portal/color/green.css" />
    <link rel="stylesheet" href="<?=base_url(); ?>asset/portal/css/style.css" />
    <link rel="stylesheet" href="<?= base_url(); ?>asset/admin/plugins/chat-room/css/chat_style.css" />

    <script async src="https://www.googletagmanager.com/gtag/js?id=G-LPZ4W9CCFY">
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());
    gtag('config', 'G-LPZ4W9CCFY');
    </script>
    <script data-ad-client="ca-pub-3500053889711919" async
        src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-custom">
    <script src="<?=base_url(); ?>asset/portal/js/jquery-3.4.1.min.js">
    'use strict'
    String.prototype.replaceAll = function(str1, str2, ignore) {
        return this.replace(new RegExp(str1.replace(/([\/\,\!\\\^\$\{\}\[\]\(\)\.\*\+\?\|\<\>\-\&])/g, "\\$&"),
            (
                ignore ? "gi" : "g")), (typeof(str2) == "string") ? str2.replace(/\$/g, "$$$$") : str2);
    };
    </script>
    <div id="wrapper">
        <?php echo $_navbar;?>
        <?php echo $_container;?>
        <?php echo $_footer;?>
    </div>
    <?= $_chatboot;?>
    <a href="#" class="scrollup"><i class="fa fa-angle-up active"></i></a>
    <script src="<?=base_url(); ?>asset/portal/js/jquery.min.js"></script>
    <script src="<?=base_url(); ?>asset/portal/js/bootstrap.min.js"></script>
    <script src="<?=base_url(); ?>asset/portal/js/jquery.easing.min.js"></script>
    <script src="<?=base_url(); ?>asset/portal/js/wow.min.js"></script>
    <script src="<?=base_url(); ?>asset/portal/js/jquery.scrollTo.js"></script>
    <script src="<?=base_url(); ?>asset/portal/js/jquery.appear.js"></script>
    <script src="<?=base_url(); ?>asset/portal/js/stellar.js"></script>
    <script src="<?=base_url(); ?>asset/portal/plugins/cubeportfolio/js/jquery.cubeportfolio.min.js"></script>
    <script src="<?=base_url(); ?>asset/portal/js/owl.carousel.min.js"></script>
    <script src="<?=base_url(); ?>asset/portal/js/nivo-lightbox.min.js"></script>
    <script src="<?=base_url(); ?>asset/admin/plugins/pagination/pagination.min.js"></script>
    <script src="<?=base_url(); ?>asset/portal/js/custom.js"></script>
    <script src="<?=base_url(); ?>asset/portal/js/lazysizes.min.js" async></script>
    <script src="<?=base_url(); ?>asset/admin/plugins/jquery-validation/jquery.validate.js"></script>
    <script src="<?=base_url(); ?>asset/admin/plugins/jquery-base64/jquery.base64.min.js"></script>

</body>

</html>