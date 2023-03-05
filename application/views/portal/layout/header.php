<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<script>
$(document).ready(function() {
    window.lazySizesConfig = {
        addClasses: true
    };
    $(".carousel-banner").owlCarousel({
        items: 1,
        loop: true,
        nav: true,
        dots: false,
        autoplay: true,
        autoplayTimeout: 15000,
        smartSpeed: 120,
        margin: 30,
        stagePadding: 10,
        animateIn: 'animate__backInDown',
    });
});
</script>
<!-- Section: intro -->
<section id="intro" class="intro">
    <div class="intro-content">
        <div class="container">
            <div class="row">
                <div id="carousel-banner" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="item active">
                            <div class="col-lg-6">
                                <div class="wow fadeInDown" data-wow-offset="0" data-wow-delay="0.1s">
                                    <h2 class="h-ultra">SELAMAT DATANG</h2>
                                </div>
                                <div class="wow fadeInUp" data-wow-offset="0" data-wow-delay="0.1s">
                                    <h4 class="h-light"><span class="color"></span>DI RSUD LEUWILIANG KAB.BOGOR
                                    </h4>
                                </div>
                                <div class="well well-trans">
                                    <div class="wow fadeInRight" data-wow-delay="0.1s">
                                        <ul class="lead-list">
                                            <li><span class="fa fa-check fa-2x icon-success"></span><span
                                                    class="list"><strong>E-LIBRARY</strong><br />
                                                    Perpustakan Online Yang Menyajikan Data Seputar Kesehatan</span>
                                            </li>
                                            <li><span class="fa fa-check fa-2x icon-success"></span> <span
                                                    class="list"><strong>Dashboard</strong><br />Realtime Report RSUD
                                                    Leuwiliang</span></li>
                                            <li><span class="fa fa-check fa-2x icon-success"></span> <span
                                                    class="list"><strong>Blog
                                                        Dan Informasi
                                                    </strong><br />Artikel, Info Kesehatan dan Tenaga Medis</span></li>
                                        </ul>
                                        <p class="text-right wow bounceIn" data-wow-delay="0.4s">
                                            <a href="#" class="btn btn-skin btn-lg">Learn more <i
                                                    class="fa fa-angle-right"></i></a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xs-12 marginbot-20">
                                <div class="wow fadeInUp" data-wow-duration="2s" data-wow-delay="0.2s">
                                    <img width="555" height="450"
                                        data-src="<?= site_url(); ?>asset/portal/img/dummy/img-2.png" class="lazyload"
                                        alt="Foto Direktur Rumah Sakit Umum Daerah Leuwiliang" />
                                </div>
                            </div>
                            <div class="col-lg-6 col-xs-12 marginbot-10 single-btn" style="display:none;">
                                <div class="text-center wow bounceIn" data-wow-delay="0.4s">
                                    <a href="#" class="btn btn-skin btn-lg">Learn more <i
                                            class="fa fa-angle-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <?php if($banner){ foreach($banner['data'] as $i=> $value){?>
                        <div class="item">
                            <div class="col-lg-6 col-xs-12">
                                <div class="wow fadeInDown" data-wow-offset="0" data-wow-delay="0.1s">
                                    <h2 class="h-ultra"><?= $value['Title']?></h2>
                                </div>
                                <div class="wow fadeInUp" data-wow-offset="0" data-wow-delay="0.1s">
                                    <h4 class="h-light"><span class="color"><?= $value['Judul']?>
                                    </h4>
                                </div>
                                <div class="well well-trans">
                                    <div class="wow fadeInRight" data-wow-delay="0.1s">
                                        <ul class="lead-list">
                                            <li><span class="fa fa-check fa-2x icon-success"></span>
                                                <p><?= $value['Desc']?></p>
                                            </li>
                                        </ul>
                                        <p class="text-right wow bounceIn" data-wow-delay="0.4s">
                                            <a href="<?= base_url('services/detail/').strtolower($value['Link']['link_target']); ?>"
                                                class="btn btn-skin btn-lg">Learn more <i
                                                    class="<?= $value['Link']['icon']?>"></i></a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xs-12 marginbot-20">
                                <div class="wow fadeInUp " data-wow-duration="2s" data-wow-delay="0.2s">
                                    <img data-src=" <?= base_url('asset/images/product/gallery/').$value['Img']; ?>"
                                        class="lazyload" alt="<?= $value['Judul']?>" width="555" height="450" />
                                </div>
                            </div>
                            <div class="col-lg-6 col-xs-12 marginbot-10 single-btn" style="display:none;">
                                <div class="text-center wow bounceIn" data-wow-delay="0.4s">
                                    <a href="<?= base_url('services/detail/').strtolower($value['Link']['link_target']); ?>"
                                        class="btn btn-skin btn-lg">Learn more
                                        <i class="<?= $value['Link']['icon']?>"></i></a>
                                </div>
                            </div>
                        </div>
                        <?php }}?>
                    </div>
                    <a class="left carousel-control" href="#carousel-banner" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </a>
                    <a class="right carousel-control" href="#carousel-banner" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- /Section: intro -->