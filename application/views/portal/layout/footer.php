<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('portal/menu/login/h_login');
?>
<footer>
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-4">
                <div class="wow fadeInDown" data-wow-delay="0.1s">
                    <div class="widget">
                        <h5>MOTO RUMAH SAKIT</h5>
                        <p>
                            RUMAH SAKIT TERPERCAYA PILIHAN MASYARAKAT
                        </p>
                    </div>
                </div>
                <div class="wow fadeInDown" data-wow-delay="0.1s">
                    <div class="widget">
                        <h5>MENU APPLIKASI</h5>
                        <ul>
                            <?php if($Menu['data'] == 0){?>
                            <li><a href="<?= base_url('portal/about');?>">Tentang Applikasi</a></li>
                            <?php }else { ?>
                            <?php $url=""; foreach($Menu['data'] as $i=> $key){?>
                            <li><a href="<?= $key['menu']['url'] ?>"><?= $key['menu']['menu'] ?></a></li>
                            <?php } }?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="wow fadeInDown" data-wow-delay="0.1s">
                    <div class="widget">
                        <h5>Information center</h5>
                        <p>
                            Gedung A Lantai 1
                        </p>
                        <ul>
                            <li>
                                <span class="fa-stack fa-lg">
                                    <i class="far fa-circle fa-stack-2x"></i>
                                    <i class="fas fa-calendar-alt fa-stack-1x"></i>
                                </span> Senin - Minggu, 8am to 11pm
                            </li>
                            <li>
                                <span class="fa-stack fa-lg">
                                    <i class="far fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-phone fa-stack-1x"></i>
                                </span> (0251) 8643290
                            </li>
                            <li>
                                <span class="fa-stack fa-lg" onclick="$('#prime').click();">
                                    <i class="far fa-circle fa-stack-2x"></i>
                                    <i class="far fa-comment fa-stack-1x"></i>
                                </span> Live Chat Dengan Information Center
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="wow fadeInDown" data-wow-delay="0.1s">
                    <div class="widget">
                        <h5>Alamat Rumah Sakit</h5>
                        <p>Jl. Raya Leuwiliang - Bogor, Cibeber I, Leuwiliang, Bogor, Jawa Barat 16640</p>
                    </div>
                </div>
                <div class="wow fadeInDown" data-wow-delay="0.1s">
                    <div class="widget">
                        <h5>Sosial media</h5>
                        <ul class="company-social">
                            <li class="social-facebook"><a href="https://www.facebook.com/pg/rsudl/posts/"
                                    target="_blank" rel="noopener"><i class="fab fa-facebook"></i></a></li>
                            <li class="social-twitter"><a href="https://twitter.com/rsud_leuwiliang" target="_blank"
                                    rel="noopener"><i class="fab fa-twitter"></i></a></li>
                            <li class="social-google"><a href="https://www.instagram.com/rsudleuwiliang/"
                                    target="_blank" rel="noopener"><i class="fab fa-instagram"></i></a></li>
                            <li class="social-vimeo"><a href="https://www.youtube.com/channel/UCenwoUXAvIsgVIB90hjWqvA"
                                    rel="noopener" target="_blank"><i class="fab fa-youtube"></i></a></li>
                            <li class="social-dribble"><a
                                    href="https://api.whatsapp.com/send?phone=+628111188601&text=Hallo%20RSUD%20Leuwiliang..%20%20Saya%20ingin%20mengajukan%20Pertanyaan%20tolong%20berikan%20kemudahan%20kepada%20saya%20..?"
                                    target="_blank" rel="noopener"><i class=" fab fa-whatsapp"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="sub-footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-md-6 col-lg-6">
                    <div class="wow fadeInLeft" data-wow-delay="0.1s">
                        <div class="text-left">
                            <p>&copy;Copyright 2021 RSUD Leuwiliang. All Rights Reserved.</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-6">
                    <div class="wow fadeInRight" data-wow-delay="0.1s">
                        <div class="text-right">
                            <p><a href="https://rsudleuwiliang.id">Kontak Developer</a> (0251) 8643290 Ext:111</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>