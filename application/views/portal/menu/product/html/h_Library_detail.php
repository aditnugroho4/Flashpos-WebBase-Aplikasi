<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php if($user->id != 0){ 
    $this->load->view('portal/menu/product/function/f_library_detail');
?>
<section id="intro" class="intro">
    <div class="intro-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <div class="wow fadeInDown" data-wow-delay="0.1s">
                        <div class="section-title text-center">
                            <h2 class="h-bold">E-Library</h2>
                            <p class="text-center">Perpustakaan digital Untuk Memenuhi informasi yang optimal bagi
                                Masyarakat,maupun
                                tenaga medis di rumah sakit RSUD Leuwiliang Kab.Bogor</p>
                        </div>
                    </div>
                    <div class="divider-short"></div>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="Perpustakaan" class="home-section paddingtop-40">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <ul class="artikel-breadcrumb">
                    <li><a href="<?= base_url('home')?>">Home</a></li>
                    <li><a href="<?= base_url('elibrary')?>">E-Library</a></li>
                    <li><a href="<?= base_url().$this->uri->uri_string()?>">Detail</a></li>
                </ul>
                <article class="artikel artikel-post">
                    <div class="artikel-share">
                        <a href="#" class="facebook"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="twitter"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="google"><i class="fab fa-google-plus"></i></a>
                    </div>
                    <div class="artikel-main-img">
                        <div class="artikel__item__pic lazyloaded set-bg"
                            data-setbg="<?= base_url('asset/images/thumbnail/').$Seo['Perpus']['Img'];?>"></div>

                    </div>
                    <div class="artikel-body loading-load">
                        <ul class="artikel-info">
                            <li class="artikel-category"><a href="#"><?=$Seo['Perpus']['Kategory']; ?></a></li>
                            <li class="artikel-type"><i class="far fa-copy"></i></li>
                        </ul>
                        <h1 class="artikel-title"><?=$Seo['Perpus']['Judul'];?></h1>
                        <ul class="artikel-meta">
                            <li><i class="fa fa-clock"></i> <?=$Seo['Perpus']['Date']; ?></li>
                            <li><i class="fa fa-comments"></i> ( <?=$Seo['Perpus']['Comment']; ?> )</li>
                            <li><i class="fa fa-eye"></i> ( <?=$Seo['data']['view'] ?> )</li>
                        </ul>
                        <p><?=$Seo['Perpus']['Sinopsis']?></p>
                        <div class="mt-5 mb-5">
                            <div id="my_pdf_viewer"></div>
                        </div>
                    </div>
                </article>
                <div class="widget-tags">
                    <ul>
                        <?php $count=explode(',',$Seo['data']['keyword']); $link=$Seo['data']['short_link']; $link=str_replace(" ", "-",$link); $link=str_replace('&', 'dan',$link); $link=str_replace("/", "-",$link); $link=str_replace("|", "-",$link); for($i=0 ; $i<count($count) ; $i++){?>
                        <li><a href="<?= base_url('elibrary');?>"><?=$count[$i]; ?></a></li>
                        <?php }?>
                    </ul>
                </div>
                <div class="artikel-comments">
                    <div class="section-title">
                        <h2 class="title">Diskusi Terkait</h2>
                    </div>
                    <div class="media scrollups">
                        <div class="media-left">
                            <img src="<?php echo base_url(); ?>asset/images/user/avatar5.png" alt="">
                        </div>
                        <div class="media-body">
                            <div class="media-heading">
                                <h5>Admin <span class="reply-time">Desember 04, 2019 At 12:30 AM</span></h5>
                            </div>
                            <p>Apakah Bermanfaat Dengan dokument ini..?,</p>
                            <a href="#" class="reply-btn">Reply</a>
                        </div>

                        <!-- comment -->
                        <div class="media">
                            <div class="media-left">
                                <img src="<?php echo base_url(); ?>asset/images/user/avatar2.png" alt="">
                            </div>
                            <div class="media-body">
                                <div class="media-heading">
                                    <h5>Fulandika <span class="reply-time">Desember 04, 2019 At 9:30 AM</span></h5>
                                </div>
                                <p>Sangat Bermanfaat Untuk Dokument ini,</p>
                                <a href="#" class="reply-btn">Reply</a>
                            </div>

                            <!-- comment -->
                            <div class="media">
                                <div class="media-left">
                                    <img src="<?= base_url(); ?>asset/images/user/avatar5.png" alt="">
                                </div>
                                <div class="media-body">
                                    <div class="media-heading">
                                        <h5>Admin <span class="reply-time">Desember 04, 2019 At 10:30 AM</span></h5>
                                    </div>
                                    <p>Terima Kasih Komentar Yang Di berikan,</p>
                                    <a href="#" class="reply-btn">Reply</a>
                                </div>
                            </div>
                            <!-- /comment -->
                        </div>
                        <!-- /comment -->
                    </div>
                    <div class="media scrollups">
                        <div class="media-left">
                            <img src="<?= base_url(); ?>asset/images/user/avatar5.png" alt="">
                        </div>
                        <div class="media-body">
                            <div class="media-heading">
                                <h5>Fulandika <span class="reply-time">April 04, 2017 At 9:30 AM</span></h5>
                            </div>
                            <p>Sama sama Semoga terus Memberikan Info yang bermanfaat,</p>
                            <a href="#" class="reply-btn">Reply</a>
                        </div>
                    </div>
                </div>
                <div class="artikel-reply-form">
                    <div class="wow lightSpeedIn" data-wow-delay="0.1s">
                        <div class="section-title">
                            <h2 class="title">Balas Diskusi</h2>
                        </div>
                        <div class="panel panel-skin">
                            <form id="send_comment">
                                <div class="panel-body">
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label for="txtKomentar">Jawab Atau Bertanya</label>
                                            <textarea class="form-control" id="txtKomentar" placeholder="Message"
                                                require></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-footer">
                                    <button type="submit" class="btn btn-skin ">Kirim Pesan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="aside-widget text-center">
                    <a href="#" style="display: inline-block;margin: auto;">
                        <img class="img-responsive" src="./img/ad-3.jpg" alt="">
                    </a>
                </div>
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
                        <h2 class="title">File Tersedia</h2>
                    </div>
                    <div class="category-widget">
                        <ul>
                            <li>
                                <label>Jumlah<span>( <?= $Seo['Perpus']['ToFile']?> )</span></label>
                            </li>
                            <?php foreach($Seo['Perpus']['Files'] as $ctgr){?><li>
                                <label onclick="$.load_file_lib(<?=$ctgr[0]['id'];?>)"> <?=$ctgr[0]['name'];?>
                                    <span><i class="fas fa-file-pdf bg-red"></i></span></label>
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
                        <h2 class="title">Data Populer</h2>
                    </div>
                    <?php foreach($Seo['Perpus']['All'] as $all){ 
                        $link=$all['seo']['short_link']; $link=str_replace(" ", "-",$link); $link=str_replace('&', 'dan',$link); $link=str_replace("/", "-",$link); $link=str_replace("|", "-",$link);$link=str_replace("(", "-",$link);$link=str_replace(")", "-",$link); ?>
                    <div class="aside-widget post-widget">
                        <a class="post-img" href="<?=base_url('elibrary/detail/'.$link).'/'?>">
                            <img src="<?=base_url('asset/images/thumbnail/').$all[0]['foto']?>"
                                alt="<?=$all[0]['judul']?>">
                        </a>
                        <div class="post-body">
                            <div class="post-category">
                                <a href="<?=base_url('elibrary/detail/'.$link).'/'?>"><?=$all[0]['judul']?></a>
                                <span><?=date("F j, Y, g:i a", strtotime($all[0]['date']))?></span>
                            </div>
                            <h3 class="post-title">
                                <a
                                    href="<?=base_url('elibrary/detail/'.$link).'/'?>"><?= $all['seo']['deskripsi'].substr(0,75);?>...</a>
                            </h3>
                        </div>
                    </div>
                    <?php }?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php }else { redirect('elibrary','refresh');}?>