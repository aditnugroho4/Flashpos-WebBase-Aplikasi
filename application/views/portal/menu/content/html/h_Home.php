<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view('portal/menu/content/function/f_home');?>
<?php echo $_header;?>
<section id="boxes" class="home-section paddingtop-80">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-sm-3 col-md-3">
                <div class="wow fadeInUp" data-wow-delay="0.2s">
                    <a href="<?= base_url('elibrary');?>">
                        <div class="box text-center box__animate">
                            <i class="fas fa-book-reader fa-3x circled bg-skin"></i>
                            <h4 class="h-bold">E-Library</h4>
                            <p class="text-center">
                                Perpustakan Online , dengan menyediakan Berbagai macam Buku-Buku dan dokument mengenai
                                dunia
                                kesehatan
                            </p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-xs-6 col-sm-3 col-md-3">
                <div class="wow fadeInUp" data-wow-delay="0.2s">
                    <div class="box text-center box__animate">
                        <i class="fas fa-chart-bar fa-3x circled bg-skin"></i>
                        <h4 class="h-bold">Dashboard</h4>
                        <p>Lihat Detail Laporan Terpadu yang Valid serta Akurat , mengenai demografi kesehatan di
                            masyarakat</p>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-3 col-md-3">
                <div class="wow fadeInUp" data-wow-delay="0.2s">
                    <a href="<?= base_url('blog');?>">
                        <div class="box text-center box__animate">
                            <i class="fas fa-user-md fa-3x circled bg-skin"></i>
                            <h4 class="h-bold">Informasi</h4>
                            <p>Lihat Informasi Terbaru mengenai Layanan Kesehatan dan Artikel tentang kesehatan yang
                                bermanfaat</p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-xs-6 col-sm-3 col-md-3">
                <div class="wow fadeInUp" data-wow-delay="0.2s">
                    <div class="box text-center box__animate" onclick="$('#prime').click();">
                        <i class="far fa-comments fa-3x circled bg-skin"></i>
                        <h4 class="h-bold">Chat Room</h4>
                        <p>Fitur Layanan Chating Dengan secara Live Chat oleh pihak Kami sebagai Usaha kami menangani
                            masyarakat secara cepat</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="callaction" class="home-section paddingtop-40">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="callaction bg-gray">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="wow fadeInUp" data-wow-delay="0.1s">
                                <div class="cta-text">
                                    <h3>Mengenal Dekat Tentang Pelayanan Kami</h3>
                                    <p>Manfaatkan detail Informasi Tentang setiap pelayanan yang kami berikan</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="wow lightSpeedIn" data-wow-delay="0.1s">
                                <div class="cta-btn">
                                    <a href="#" class="btn btn-skin btn-lg">Masukan Data Anda</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="services" class="home-section nopadding paddingtop-60">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-6">
                <div class="wow fadeInUp" data-wow-delay="0.2s">
                    <img data-src="<?=base_url(); ?>asset/portal/img/dummy/img-6.png" class="lazyload img-responsive"
                        alt="Dr Layanan Rsud Leuwiliang @rsudluwiliang" width="500" height="406" />
                </div>
            </div>
            <div class="col-sm-6 col-md-6">
                <div class="row">
                    <?php foreach($Product['data'] as $all){?>
                    <div class="col-xs-6 col-md-6">
                        <?php   $link = $all[0]['name'];
                        $link = str_replace(' ','-',$link);
                        $link = str_replace('&', 'dan',$link);
                        $link = str_replace("/", "-",$link);
                        $link = str_replace("|", "-",$link);
                        $link = str_replace("(", "-",$link);
                        $link = str_replace(")", "-",$link);
                        ?>
                        <div class="wow fadeInRight p-5" data-wow-delay="0.1s">
                            <a href="<?= base_url('services/detail/').strtolower($link); ?>">
                                <div class="service-box service__animate">
                                    <div class="service-icon">
                                        <span class="<?=$all[0]['img']; ?>"></span>
                                    </div>
                                    <div class="service-desc mb-5">
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
        </div>
    </div>
</section>
<section id="doctor" class="home-section bg-gray paddingbot-60">
    <div class="container marginbot-50">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <div class="wow fadeInDown" data-wow-delay="0.1s">
                    <div class="section-heading text-center">
                        <h2 class="h-bold">INFO DOKTER</h2>
                        <p class="text-center">Dokter Profesional dan Berpengalaman RSUD Leuwiliang</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 lib-loading">
                <div id="filters-container" class="cbp-l-filters-alignLeft">
                </div>
                <div id="grid-container" class="cbp-l-grid-team">
                    <ul></ul>
                </div>
            </div>
            <div class="col-lg-12 text-center paddingtop-40">
                <div class="load__more"></div>
            </div>
        </div>
    </div>
</section>
<section id="facilities" class="home-section paddingbot-60">
    <div class="container marginbot-50">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <div class="wow fadeInDown" data-wow-delay="0.1s">
                    <div class="section-heading text-center">
                        <h2 class="h-bold">Fasilitas Unggulan</h2>
                        <p class="text-center">Memberikan Fasilitas Unggulan Demi Kenyamanan dan Kualitas Kesehatan</p>
                    </div>
                </div>
                <div class="divider-short"></div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="wow bounceInUp" data-wow-delay="0.2s">
                    <div id="owl-works" class="owl-carousel">
                        <div class="item"><a href="<?=base_url(); ?>asset/portal/img/photo/1.jpg"
                                title="This is an image title" data-lightbox-gallery="gallery1"
                                data-lightbox-hidpi="img/works/1@2x.jpg"><img width="265" height="198"
                                    data-src="<?=base_url(); ?>asset/portal/img/photo/1.jpg" class="lazyload"
                                    alt="Ruang rawat inap"></a></div>
                        <div class="item"><a href="<?=base_url(); ?>asset/portal/img/photo/2.jpg"
                                title="This is an image title" data-lightbox-gallery="gallery1"
                                data-lightbox-hidpi="img/works/2@2x.jpg"><img width="265" height="198"
                                    data-src="<?=base_url(); ?>asset/portal/img/photo/2.jpg" class="lazyload"
                                    alt="Ruang Oprasi"></a>
                        </div>
                        <div class="item"><a href="<?=base_url(); ?>asset/portal/img/photo/3.jpg"
                                title="This is an image title" data-lightbox-gallery="gallery1"
                                data-lightbox-hidpi="img/works/3@2x.jpg"><img width="265" height="198"
                                    data-src="<?=base_url(); ?>asset/portal/img/photo/3.jpg" class="lazyload"
                                    alt="Ruang Rawat Igd"></a>
                        </div>
                        <div class="item"><a href="<?=base_url(); ?>asset/portal/img/photo/4.jpg"
                                title="This is an image title" data-lightbox-gallery="gallery1"
                                data-lightbox-hidpi="img/works/4@2x.jpg"><img width="265" height="198"
                                    data-src="<?=base_url(); ?>asset/portal/img/photo/4.jpg" class="lazyload"
                                    alt="Radiologi"></a>
                        </div>
                        <div class="item"><a href="<?=base_url(); ?>asset/portal/img/photo/5.jpg"
                                title="This is an image title" data-lightbox-gallery="gallery1"
                                data-lightbox-hidpi="img/works/5@2x.jpg"><img width="265" height="198"
                                    data-src="<?=base_url(); ?>asset/portal/img/photo/5.jpg" class="lazyload"
                                    alt="Ruang Oprasi"></a>
                        </div>
                        <div class="item"><a href="<?=base_url(); ?>asset/portal/img/photo/6.jpg"
                                title="This is an image title" data-lightbox-gallery="gallery1"
                                data-lightbox-hidpi="img/works/6@2x.jpg"><img width="265" height="198"
                                    data-src="<?=base_url(); ?>asset/portal/img/photo/6.jpg" class="lazyload"
                                    alt="Layanan Igd"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="testimonial" class="home-section paddingbot-60 parallax" data-stellar-background-ratio="0.5">
    <div class="carousel-reviews broun-block">
        <div class="container">
            <div class="row">
                <div id="carousel-reviews" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <?php if($Ulasan['data']){ ?>
                        <?php foreach($Ulasan['data'] as $i=> $all){
                            if($i == 0) { ?>
                        <div class="item active">
                            <?php foreach($all['ulasan'] as $a=> $val){
                                        $foto =""; if($val['foto']){$foto=$val['foto'];}else{$foto="avatar5.png";}
                                    ?>
                            <div class="col-md-4 col-xs-4">
                                <div class="block-text rel zmin">
                                    <a title="" href="<?=base_url('services')?>">Pelayanan
                                        <?= $all['product']['name'] ?></a>
                                    <div class="mark">My rating: <span class="rating-input">
                                            <span data-value="0" class="glyphicon glyphicon-star"></span>
                                            <span data-value="1" class="glyphicon glyphicon-star"></span>
                                            <span data-value="2" class="glyphicon glyphicon-star"></span>
                                            <span data-value="3" class="glyphicon glyphicon-star"></span>
                                            <span data-value="4" class="glyphicon glyphicon-star-empty"></span>
                                            <span data-value="5" class="glyphicon glyphicon-star-empty"></span>
                                        </span>
                                    </div>
                                    <p><?= $val['ulasan'] ?></p>
                                    <ins class="ab zmin sprite sprite-i-triangle block"></ins>
                                </div>
                                <div class="person-text rel text-light">
                                    <img width="80" height="80" data-src="<?= base_url('asset/images/user/'.$foto)?>"
                                        alt="<?= $val['first_name'].' '.$val['last_name'] ?>"
                                        class="lazyload person img-circle" />
                                    <a title="" href="#"><?= $val['first_name'].' '.$val['last_name'] ?></a>
                                    <span><?= $val['alamat'] ?></span>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                        <?php } else {?>
                        <div class="item">
                            <?php foreach($all['ulasan'] as $a=> $val){ 
                                        $foto =""; if($val['foto']){$foto=$val['foto'];}else{$foto="avatar5.png";}
                                        ?>
                            <div class="col-md-4 col-xs-4">
                                <div class="block-text rel zmin">
                                    <a title="" href="#"><?= $all['product']['name'] ?></a>
                                    <div class="mark">My rating: <span class="rating-input"><span data-value="0"
                                                class="glyphicon glyphicon-star"></span><span data-value="1"
                                                class="glyphicon glyphicon-star"></span><span data-value="2"
                                                class="glyphicon glyphicon-star"></span><span data-value="3"
                                                class="glyphicon glyphicon-star"></span><span data-value="4"
                                                class="glyphicon glyphicon-star-empty"></span><span data-value="5"
                                                class="glyphicon glyphicon-star-empty"></span> </span></div>
                                    <p><?= $val['ulasan'] ?></p>
                                    <ins class="ab zmin sprite sprite-i-triangle block"></ins>
                                </div>
                                <div class="person-text rel text-light">
                                    <img width="80" height="80" data-src="<?= base_url('asset/images/user/'.$foto)?>"
                                        alt="<?= $val['first_name'].' '.$val['last_name'] ?>"
                                        class="lazyload person img-circle" />
                                    <a title="" href="#"><?= $val['first_name'].' '.$val['last_name'] ?></a>
                                    <span><?= $val['alamat'] ?></span>
                                </div>
                            </div>
                            <?php }?>
                        </div>
                        <?php } }?>
                        <?php } ?>
                    </div>

                    <a class="left carousel-control" href="#carousel-reviews" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </a>
                    <a class="right carousel-control" href="#carousel-reviews" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="blog" class="home-section bg-gray paddingbot-60">
    <div class="container marginbot-50">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <div class="wow lightSpeedIn" data-wow-delay="0.1s">
                    <div class="section-heading text-center">
                        <h2 class="h-bold">INFORMASI</h2>
                        <p class="text-center">Informasi mengenai Layanan , Artikel dan Berita Seputar Kesehatan</p>
                    </div>
                </div>
                <div class="divider-short"></div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <?php $con=0; foreach($Blogs['All'] as $all){ 
                $link = $all['seo']['short_link'];
                $link = str_replace(" ", "-",$link);
                $link = str_replace('&', 'dan',$link);
                $link = str_replace("/", "-",$link);
                $link = str_replace("|", "-",$link);
                $link = str_replace("(", "-",$link);
                $link = str_replace(")", "-",$link);
                $con +=1 ;
                $css ="pricing-box";
                $css1 ="pricing-content general";
                if($con == 2){
                    $css ="pricing-box featured-price";
                    $css1 ="pricing-content featured";
                }
                if($con == 3){
                    $css1 ="pricing-content general last";
                }
            ?>
            <div class="col-sm-4 <?= $css ?>">
                <div class="wow bounceInUp" data-wow-delay="0.1s">
                    <div class="<?= $css1 ?>">
                        <h2><?= $all['ctgr']?></h2>
                        <h3><sup></sup> <span><?= date("F j, Y, g:i a", strtotime($all[0]['date']))?></span></h3>
                        <ul>
                            <li><img width="292" height="195" class="lazyload"
                                    data-src="<?= base_url().$all[0]['img']?>" alt="<?= $all['seo']['title']?>"></li>
                            <li>
                                <h4><a href="<?= base_url('blog/detail/').$link.'/'?>"><?= $all[0]['judul']?></a></h4>
                            </li>
                            <li>
                                <p><?= $all['seo']['deskripsi'] ?>...</p>
                            </li>
                        </ul>
                        <div class="price-bottom">
                            <a href="<?= base_url('blog/detail/').$link.'/'?>" class="btn btn-skin btn-lg"><i
                                    class="fa fa-eye"></i> Read More..</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php  if($con == 3) break; } ?>
        </div>
    </div>
</section>
<section id="partner" class="home-section paddingbot-60">
    <div class="container marginbot-50">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <div class="wow lightSpeedIn" data-wow-delay="0.1s">
                    <div class="section-heading text-center">
                        <h2 class="h-bold">KOMITE DAN POKJA</h2>
                        <p class="text-center">Terakreditasi Paripurna Kars Versi 2012 Menuju SNARS Versi 1.1</p>
                    </div>
                </div>
                <div class="divider-short"></div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="wow bounceInUp" data-wow-delay="0.2s">
                <div id="carousel-partner" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="item active">
                            <div class="col-sm-6 col-md-3">
                                <div class="partner marginbot-10">
                                    <a href="#"><img width="85" height="65"
                                            data-src="<?php echo base_url(); ?>asset/portal/img/dummy/kemkes.png"
                                            alt="akreditasi dan komite 1" class="lazyload" /></a>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="partner marginbot-10">
                                    <a href="#"><img width="85" height="65"
                                            data-src="<?php echo base_url(); ?>asset/portal/img/dummy/kabbogor.png"
                                            alt="akreditasi dan komite 2" class="lazyload" /></a>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="partner marginbot-10">
                                    <a href="#"><img width="85" height="65"
                                            data-src="<?php echo base_url(); ?>asset/portal/img/dummy/pkrs.png"
                                            alt="akreditasi dan komite 3" class="lazyload" /></a>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="partner marginbot-10">
                                    <a href="#"><img width="85" height="65"
                                            data-src="<?php echo base_url(); ?>asset/portal/img/dummy/kars.png"
                                            alt="akreditasi dan komite 4" class="lazyload" /></a>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="col-sm-6 col-md-3">
                                <div class="partner marginbot-10">
                                    <a href="#"><img width="85" height="65"
                                            data-src="<?php echo base_url(); ?>asset/portal/img/dummy/komdik.png"
                                            alt="akreditasi dan komite 5" class="lazyload" /></a>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="partner marginbot-10">
                                    <a href="#"><img width="85" height="65"
                                            data-src="<?php echo base_url(); ?>asset/portal/img/dummy/ppi.png"
                                            alt="akreditasi dan komite 6" class="lazyload" /></a>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="partner marginbot-10">
                                    <a href="#"><img width="85" height="65"
                                            data-src="<?php echo base_url(); ?>asset/portal/img/dummy/komiteetik.png"
                                            alt="akreditasi dan komite 7" class="lazyload" /></a>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="partner marginbot-10">
                                    <a href="#"><img width="85" height="65"
                                            data-src="<?php echo base_url(); ?>asset/portal/img/dummy/k3rs.png"
                                            alt="akreditasi dan komite 8" class="lazyload" /></a>
                                </div>
                            </div>
                        </div>
                        <a class="left carousel-control" href="#carousel-partner" role="button" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                        </a>
                        <a class="right carousel-control" href="#carousel-partner" role="button" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right"></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
</section>