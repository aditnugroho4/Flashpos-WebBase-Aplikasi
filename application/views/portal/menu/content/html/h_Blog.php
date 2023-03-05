<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('portal/menu/content/function/f_blog');
?>
<section id="intro-blog-detail" class="intro">
    <div class="intro-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <div class="wow fadeInDown" data-wow-delay="0.1s">
                        <div class="section-title text-center">
                            <h2 class="h-bold">Informasi</h2>
                            <p class="text-center">Blog, Artikel dan informasi seputar Kesehatan</p>
                        </div>
                    </div>
                    <div class="divider-short"></div>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="blog" class="home-section paddingtop-40">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <ul class="artikel-breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Informasi</a></li>
                </ul>

                <div class="row">
                    <div class="list-blog"></div>
                </div>
                <div class="section-row text-center">
                    <div id="pagination"></div>
                </div>
                <div class="aside-widget">
                    <div class="section-title">
                        <h2 class="title">TAG</h2>
                    </div>
                    <div class="widget-tags">
                        <ul>
                            <?php $count=explode(',',$Seo['data']['keyword']); $link=$Seo['data']['short_link']; $link=str_replace(" ", "-",$link); $link=str_replace('&', 'dan',$link); $link=str_replace("/", "-",$link); $link=str_replace("|", "-",$link); for($i=0 ; $i<count($count) ; $i++){?>
                            <li><a href="<?=base_url('blog');?>"><?=$count[$i]; ?></a></li>
                            <?php }?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <!-- <div class="aside-widget text-center">
                    <a href="#" style="display: inline-block;margin: auto;">
                        <img class="img-responsive" src="./img/ad-3.jpg" alt="">
                    </a>
                </div> -->
                <div class="aside-widget">
                    <div class="section-title">
                        <h2 class="title">Social Media</h2>
                    </div>
                    <div class="social-widget">
                        <ul>
                            <li>
                                <a href="#" class="social-facebook">
                                    <i class="fab fa-facebook-f"></i>
                                    <span>21.2K<br>Followers</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="social-twitter">
                                    <i class="fab fa-twitter"></i>
                                    <span>10.2K<br>Followers</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="social-google-plus">
                                    <i class="fab fa-youtube"></i>
                                    <span>5K<br>Followers</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="aside-widget">
                    <div class="section-title">
                        <h2 class="title">Katagori</h2>
                    </div>
                    <div class="category-widget">
                        <ul>
                            <li>
                                <label onclick="$.load_ctgr_blog(5,'All')">All.. <span>25</span></label>
                            </li>
                            <?php foreach($Seo['Blogs']['Ctgr'] as $ctgr){?><li>
                                <label onclick="$.load_ctgr_blog(10,<?=$ctgr[0]['id'];?>)"><?=$ctgr[0]['nama'];?>
                                    <span>25</span></label>
                            </li><?php }?>
                        </ul>
                    </div>
                </div>
                <div class="aside-widget">
                    <div class="wow bounceInUp" data-wow-delay="0.2s">
                        <div class="section-title">
                            <h2 class="title">Berlangganan</h2>
                        </div>
                        <div class="newsletter-widget">
                            <form>
                                <p>Masukan Alamat email untuk berlangganan informasi kami.</p>
                                <input class="input" placeholder="Enter Your Email">
                                <button class="primary-button">Subscribe</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="aside-widget">
                    <div class="section-title">
                        <h2 class="title">Infromasi Populer</h2>
                    </div>
                    <?php foreach($Seo['Blogs']['All'] as $all){ 
                        $link=$all['seo']['short_link']; $link=str_replace(" ", "-",$link); $link=str_replace('&', 'dan',$link); $link=str_replace("/", "-",$link); $link=str_replace("|", "-",$link); ?>
                    <div class="aside-widget post-widget">
                        <a class="post-img" href="<?=base_url('blog/detail/'.$link).'/'?>">
                            <img src="<?=base_url().$all[0]['img']?>" alt="<?=$all[0]['judul']?>">
                        </a>
                        <div class="post-body">
                            <div class="post-category">
                                <a href="<?=base_url('blog/detail/'.$link).'/'?>"><?=$all[0]['judul']?></a>
                                <span><?=date("F j, Y, g:i a", strtotime($all[0]['date']))?></span>
                            </div>
                            <h3 class="post-title">
                                <a
                                    href="<?=base_url('blog/detail/'.$link).'/'?>"><?= $all['seo']['deskripsi'].substr(0,75);?>...</a>
                            </h3>
                        </div>
                    </div>
                    <?php }?>
                </div>
                <!-- <div class="aside-widget">
                    <div class="section-title">
                        <h2 class="title">Instagram</h2>
                    </div>
                    <div class="galery-widget">
                        <ul>
                            <li><a href="#"><img src="./img/galery-1.jpg" alt=""></a></li>
                            <li><a href="#"><img src="./img/galery-2.jpg" alt=""></a></li>
                            <li><a href="#"><img src="./img/galery-3.jpg" alt=""></a></li>
                            <li><a href="#"><img src="./img/galery-4.jpg" alt=""></a></li>
                            <li><a href="#"><img src="./img/galery-5.jpg" alt=""></a></li>
                            <li><a href="#"><img src="./img/galery-6.jpg" alt=""></a></li>
                        </ul>
                    </div>
                </div>
                <div class="aside-widget text-center">
                    <a href="#" style="display: inline-block;margin: auto;">
                        <img class="img-responsive" src="./img/ad-1.jpg" alt="">
                    </a>
                </div> -->
            </div>
        </div>
    </div>
</section>