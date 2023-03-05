<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!-- Section: intro -->
<section id="intro" class="intro">
    <div class="intro-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <div class="wow fadeInDown" data-wow-delay="0.1s">
                        <div class="section-title">
                            <h2 class="h-bold text-center">LAYANAN KAMI</h2>
                            <p class="text-center">Melayanni Dengan Hati Bertindak Dengan Logika</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Section: services -->
<section class="home-section paddingtop-80">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-6">
                <div class="wow fadeInUp" data-wow-delay="0.2s">
                    <img src="<?=base_url(); ?>asset/portal/img/dummy/img-6.png" width="100%" class="lazyload"
                        alt="Layanan Rumah sakit RSUD Leuwiliang" width="555" />
                </div>
            </div>
            <?php foreach($Product['data'] as $all){?>
            <div class="col-xs-6 col-md-3">
                <?php   $link = $all[0]['name'];
                                    $link = str_replace(' ','-',$link);
                                    $link = str_replace('&','dan',$link);
                            ?>
                <div class="wow fadeInRight" data-wow-delay="0.1s">
                    <a href="<?= base_url('services/detail/').strtolower($link); ?>">
                        <div class="service-box">
                            <div class="service-icon">
                                <span class="<?=$all[0]['img']; ?>"></span>
                            </div>
                            <div class="service-desc">
                                <h5 class="h-light"><?= $all[0]['name']?></h5>
                                <p><?= substr($all[0]['label'],0,100)?>...More</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <?php }?>
        </div>
    </div>
</section>
<!-- /Section: services -->