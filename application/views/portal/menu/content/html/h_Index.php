<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<script>
$(window).on('load', function() {
    var date = "<?= R::isoDateTime(); ?>";
    var user = "<?= $user->id ?>";
    $('#dlg-popUp').modal('show');
});
</script>
<section id="wellcome" class="intro">
    <div class="intro-index">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 text-center">
                    <div class="wow fadeInDown" data-wow-offset="0" data-wow-delay="0.1s">
                        <h2>PORTAL INFORMASI TERPADU</h2>
                    </div>
                    <div class="wow fadeInUp" data-wow-offset="0" data-wow-delay="0.2s">
                        <h1 class="h-bold font-light">RUMAH SAKIT UMUM DAERAH LEUWILIANG KAB.BOGOR</h1>
                    </div>
                    <div class="wow fadeInUp" data-wow-offset="0" data-wow-delay="0.2s">
                        <a href="<?= base_url('home');?>" class="btn-primary btn-lg"><i
                                class="fas fa-user-ninja fa-circle"></i> JELAJAHI
                            KAMI</a>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="wow fadeInUp" data-wow-duration="2s" data-wow-delay="0.2s">
                        <img width="360" height="292" src="<?= site_url(); ?>asset/portal/img/dummy/img-2.png"
                            data-src="<?= site_url(); ?>asset/portal/img/dummy/img-2.png" class="lazyload "
                            alt="Direktur Rumah Sakit" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="index" class="home-section paddingtop-100 paddingbot-100">
    <div class="container">
        <div class="row">
            <?php foreach($Apps['data'] as $i=> $value){ ?>
            <div class="col-xs-6 col-sm-3 col-md-3 marginbot-40">
                <a href="<?=$value['url'];?>" target="_blank" rel="noopener">
                    <div class="wow fadeInUp" data-wow-delay="0.2s">
                        <div class="box text-center box__animate">
                            <i class="<?=$value['icon'];?> fa-3x circled bg-skin"></i>
                            <h4 class="h-bold"><?=$value['nama'];?></h4>
                            <p><?=$value['deskripsi'];?></p>
                        </div>
                    </div>
                </a>
            </div>
            <?php } ?>
        </div>
    </div>
</section>
<div id="dlg-popUp" tabindex="-1" data-backdrop="false" role="dialog" aria-hidden="true" data-keyboard="false"
    class="modal fade">
    <div class="modal-dialog" role="document">
        <div class="modal-content loading-popup">
            <div class="modal-header">
                <h5 class="modal-title text-center">INFO LAYANAN</h5>
            </div>
            <div class="modal-body">
                <div class="panel panel-skin">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <span class="fas fa-bell fa-2x circled bg-skin"> </span>
                            <i>SALAM SEHAT UNTUK KITA SEMUA</i>
                        </h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6 text-center marginbot-20">
                                <img width="125" height="168" class="lazyload"
                                    src="<?=site_url().str_replace('-','/',$Seo['data']['img']);?>"
                                    alt="<?=$Seo['data']['deskripsi'];?>">
                            </div>
                            <div class="col-lg-6 marginbot-20">
                                <p><?=$Seo['data']['deskripsi'];?></p>
                            </div>
                            <div class="col-lg-12 text-center margintop-40">
                                <h5>TERIMA KASIH</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>