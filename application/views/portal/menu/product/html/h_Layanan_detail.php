<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<section id="intro" class="intro">
    <div class="intro-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <div class="wow fadeInDown" data-wow-delay="0.1s">
                        <div class="section-title">
                            <h2 class="h-bold text-center">DETAIL LAYANAN</h2>
                            <p class="text-center">Melayanni Dengan Hati Bertindak Dengan Logika</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="home-section margintop-5">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-6 col-lg-6 content__hide">
                <div class="wow fadeInUp" data-wow-delay="0.2s">
                    <a href="<?= base_url('services'); ?>">
                        <img data-src="<?=site_url().str_replace('-','/',$Seo['data']['img']);?>" class="lazyload"
                            alt="Layanan <?= $Product['nama']?>" width="100%" height="300" />
                    </a>
                </div>
            </div>
            <div class="col-xs-12 col-md-6 col-lg-6">
                <div class="service-box">
                    <div class="service-desc">
                        <div class="service-icon col-md-12">
                            <span class="<?=$Product['img']; ?> col-md-2"></span>
                            <h1 class="text-center col-md-10"><?= $Product['nama']?></h1>
                        </div>
                        <div class="col-md-12">
                            <p><?= $Product['deskripsi']?></p>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="fb-share-button"
                            data-href="<?= site_url().str_replace('-','/',$Seo['data']['link']);?>"
                            data-layout="button_count" data-size="small"><a target="_blank" rel="nofollow"
                                href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Frsudleuwiliang.id%2F&amp;src=sdkpreparse"
                                class="badge"><i class="fas fa-share"></i> Bagikan</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="home-section paddingtop-60">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-lg-8">
                <div class="service-content">
                    <?= $Product['content']?>
                </div>
            </div>
            <div class="col-xs-12 col-lg-4">
                <?php foreach($Layanan['data'] as $all){?>
                <div class="col-xs-6 col-md-12">
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
        <div class="col-lg-12 mt-3">
            <div class="widget-tags marginbot-20 margintop-20">
                <ul>
                    <?php $count=explode(',',$Seo['data']['keyword']); $link=$Seo['data']['short_link']; $link=str_replace(" ", "-",$link); $link=str_replace('&', 'dan',$link); $link=str_replace("/", "-",$link); $link=str_replace("|", "-",$link); for($i=0 ; $i<count($count) ; $i++){?>
                    <li><a href="<?=base_url('services');?>"><?=$count[$i]; ?></a></li>
                    <?php }?>
                </ul>
            </div>
        </div>
    </div>
</section>
<!-- /Section: services -->