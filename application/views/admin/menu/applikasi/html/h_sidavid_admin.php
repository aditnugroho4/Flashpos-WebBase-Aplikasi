<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); $date = R::isoDateTime();?>
<?php $this->load->view('admin/menu/applikasi/function/f_sikontras'); ?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-lg-12">
                <div class="card card-outline card-purple">
                    <div class="justify-content-center text-center">
                        <img width="125" height="180" class="p-4"
                            src="<?= base_url()?>asset/portal/img/dummy/rsud-new.png" alt="Logo RSUDL">
                        <h3><?php if($unit){echo($unit['name']);}else{echo("Penetapan Posisi Anda Kerja Belum Lengkap");}?>
                        </h3>
                        <marquee bgcolor="#111f29">
                            <h1 style="color:#fff;">SELAMAT DATANG DI APLIKASI SI DAVIDS</h1>
                        </marquee>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box btn mn-1 btn-outline-secondary"
                    onclick="$.get_menu('\admin-menu-applikasi-html-h_data_covid')">
                    <span class="info-box-icon bg-info"><i class="fas fa-viruses"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">INPUT DATA COVID</span>
                        <span class="info-box-number"><?= R::count('t_data_pengaduan','status="K"')?></span>
                    </div>
                    <div class=" info-box-more">
                        <button class="btn btn-sm btn-primary"><i class="fas fa-plus-square"></i> 0</button>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box btn mn-2 btn-outline-secondary"
                    onclick="$.get_menu('\admin-menu-applikasi-html-h_data_oksigen')">
                    <span class="info-box-icon bg-danger"><i class="fas fa-pump-medical"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">INPUT DATA OKSIGEN</span>
                        <span class="info-box-number"><?= R::count('t_data_prosess','status is null')?></span>
                    </div>
                    <div class=" info-box-more">
                        <button class="btn btn-sm btn-warning"><i class="fas fa-eye"></i>
                            <?= R::count('t_data_prosess','status="P"')?></button>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box btn mn-3 btn-outline-secondary"
                    onclick="$.get_menu('\admin-menu-applikasi-html-h_laporan_aduan')">
                    <span class="info-box-icon bg-success"><i class="fas fa-chart-pie"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">CHART</span>
                        <span class="info-box-number"><?= R::count('t_data_pengaduan','status="Y"')?></span>
                    </div>
                    <div class=" info-box-more">
                        <button class="btn btn-sm btn-primary"><i class="fas fa-dolly"></i>
                            0</button>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box mn-3">
                    <span class="info-box-icon btn btn-outline-secondary"
                        onclick="$.get_menu('\admin-menu-applikasi-html-h_laporan_david')">
                        <i class="fas fa-clipboard"></i>
                    </span>
                    <div class="info-box-content text-center">
                        <span class="info-box-text">Laporan & Print</span>
                        <span class="info-box-number">0</span>
                    </div>
                    <span class="info-box-icon btn btn-outline-success"
                        onclick="$.get_menu('\admin-menu-applikasi-html-h_print_david')">
                        <i class="fas fa-print"></i>
                    </span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-outline card-purple card-loading">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-edit"></i>
                        </h3>
                    </div>
                    <div class="card-body load-view-menu">
                        <?php $this->load->view("admin/menu/applikasi/html/h_data_aduan");?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>