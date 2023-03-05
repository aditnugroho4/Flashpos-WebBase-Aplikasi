<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
    <div class="top-area">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-md-6">
                    <p class="bold text-left"><label for="Day" id="Day"></label> , <label for="Time" id="Time"></label>
                    </p>
                </div>
                <div class="col-sm-6 col-md-6">
                    <p class="bold text-right"><i class="fas fa-ambulance fa-1x red"> Gawat Darurat</i> (0251) 8643290
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="container navigation">
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="<?= base_url();?>">
                <div class="row">
                    <img class="lazyload" data-src="<?= base_url(); ?>asset/portal/img/logo-baru.png"
                        alt="Logo RSUD Leuwiliang" width="65" height="83" />
                    <span>RSUD LEUWILIANG</span>
                </div>
            </a>
        </div>
        <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
            <?php if($Menu['data'] == 0){?>
            <ul class="nav navbar-nav">
                <li><a href="<?= base_url('portal/about');?>"><i class="fab fa-creative-commons-share fa-circle"></i>
                        TENTANG
                        APLIKASI</a>
                </li>
            </ul>
            <?php }else{?>
            <ul class="nav navbar-nav">
                <?php 
                foreach($Menu['data'] as $i=> $key){
                    if(!$key['submenu']){ ?>

                <?php if($key['menu']['menu'] == "MORE"){ ?>
                <li class="dropdown mn-<?= $i+1 ?>">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="badge custom-badge red pull-right">
                            <i class="fa far fa-copy"></i></span><?= $key['menu']['menu'] ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <?php if($user->id !=0){?>
                        <li class="ma-<?= $i+2?>">
                            <a href="<?= base_url('login/member_logout?end=').base64_encode($user->id); ?>">LOG
                                OUT</a>
                        </li>
                        <?php }else { ?>
                        <li class="ma-<?= $i+3?>"><a href="#" onclick="$.login_click();">LOGIN</a>
                        </li>
                        <?php }  ?>
                    </ul>
                </li>
                <?php } else {?>
                <li class="mn-<?= $i+1 ?>">
                    <a href="<?= base_url($key['menu']['url']) ?>"><?= $key['menu']['menu'] ?></a>
                </li>
                <?php }?>
                <?php } else{?>
                <li class="dropdown mn-<?= $i+1 ?>">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="badge custom-badge red pull-right">
                            <i class="fa far fa-copy"></i></span><?= $key['menu']['menu'] ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <?php $url=strtolower($this->uri->segment(1, 0)); 
                            $urls ="";foreach($key['submenu'] as $b=> $val ){ 
                            $link=$val[0]['url']; 
                            if($url !="home"){
                                $link= base_url("home").$val[0]['url'];
                            } 
                        ?>
                        <li class="ma-<?= $b+1?>">
                            <a href="<?= $link ?>"><?= $val[0]['name']; ?></a>
                        </li>
                        <?php } if($key['menu']['menu'] == "MORE"){ if($user->id !=0){?>
                        <li class="ma-<?= $b+2?>">
                            <a href="<?= base_url('login/member_logout?end=').base64_encode($user->id); ?>">LOG
                                OUT</a>
                        </li>
                        <?php }else { ?>
                        <li class="ma-<?= $b+3?>"><a href="#" onclick="$.login_click();">LOGIN</a>
                        </li>
                        <?php } } ?>
                    </ul>
                </li>
                <?php } }?>
            </ul>
            <?php }?>
        </div>
    </div>
</nav>
<script>
var d = new Date();
var days = ['MINGGU', 'SENIN', 'SELASA', 'RABU', 'KAMIS', 'JUMAT', 'SABTU'];
var Month = ['JANUARI', 'FEBRUARI', 'MARET', 'APRIL', 'MEI', 'JUNI', 'JULI', 'AGUSTUS', 'SEPTEMBER', 'OKTOBER',
    'NOVEMBER', 'DESEMBER'
];
setInterval(function() {
    d = new Date();
    var x = d.getDay();
    var seconds = d.getSeconds();
    var hours = d.getHours();
    var mins = d.getMinutes();
    $("#Time").html(" JAM : " + hours + " : " + mins + " : " + seconds);

    $("#Day").html(days[x] + " - " + d.getDate() + ", " + Month[d.getMonth()] + " " + d.getFullYear());

}, 1000);
</script>