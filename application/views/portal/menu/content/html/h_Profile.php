<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<section id="profile" class="intro">
    <div class="intro-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <div class="wow fadeInDown" data-wow-delay="0.1s">
                        <div class="section-title text-center">
                            <h2 class="h-bold">PROFIL RSUD LEUWILIANG</h2>
                            <p class="text-center">Melayanni Dengan Hati Bertindak Dengan Logika</p>
                        </div>
                    </div>
                    <div class="divider-short"></div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Section: services -->
<section class="home-section nopadding paddingtop-60">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-6">
                <div class="wow fadeInUp" data-wow-delay="0.2s">
                    <img src="<?=base_url(); ?>asset/portal/img/photo/rs-1.png" class="img-responsive"
                        alt="Foto Rumah Sakit" />
                </div>
            </div>
            <div class="col-xs-12 col-md-6">
                <div class="wow fadeInUp" data-wow-delay="0.2s">
                    <div class="wow fadeInUp" data-wow-delay="0.2s">
                        <div class="box text-center box__animate">
                            <i class="fas fa-hospital fa-3x circled bg-skin"></i>
                            <h4 class="h-bold">RUMAH SAKIT UMUM DAERAH LEUWILIANG</h4>
                            <p>Melayanai dengan Hari Bertindak Dengan Logika</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <?= $Profil;?>
            </div>
        </div>
    </div>
</section>
<!-- /Section: services -->