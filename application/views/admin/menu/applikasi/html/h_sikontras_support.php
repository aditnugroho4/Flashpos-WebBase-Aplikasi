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
                            <h1 style="color:#fff;">SELAMAT DATANG DI APLIKASI SI KONTRAS</h1>
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
                    onclick="$.get_menu('\admin-menu-applikasi-html-h_tangani_aduan')">
                    <span class="info-box-icon bg-danger"><i class="far fa-calendar-check"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Ambil Penugasan</span>
                        <span
                            class="info-box-number"><?php if($role->name =="Admin" || $role->name =="Support"){ echo(R::count('t_data_prosess','status is null AND unit_id=?',array($unit['id'])));}else{echo(R::count('t_data_prosess','status is null'));} ?></span>
                    </div>
                    <div class=" info-box-more">
                        <button class="btn btn-sm btn-warning"><i class="fas fa-eye"></i> 0</button>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box btn mn-2 btn-outline-secondary"
                    onclick="$.get_menu('\admin-menu-applikasi-html-h_status_pengerjaan')">
                    <span class="info-box-icon bg-info"><i class="fas fa-bullhorn"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Status pengerjaan</span>
                        <span
                            class="info-box-number"><?php if(!$role->name =="Admin" || $role->name =="Support"){ echo(R::count('t_data_perbaikan','status is null AND unit_id=?',array($unit['id'])));}else{echo(R::count('t_data_perbaikan','status is null'));} ?></span>
                    </div>
                    <div class=" info-box-more">
                        <button class="btn btn-sm btn-danger"><i class="fas fa-bell"></i>
                            <?php if(!$role->name =="Admin" || $role->name =="Support"){ echo(R::count('t_data_prosess','status="P" AND unit_id=?',array($unit['id'])));}else{echo(R::count('t_data_prosess','status="P"'));} ?></button>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box btn mn-3 btn-outline-secondary"
                    onclick="$.get_menu('\admin-menu-applikasi-html-h_aduan_selesai')">
                    <span class="info-box-icon bg-warning"><i class="fas fa-archive"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Laporan</span>
                        <span class="info-box-number">
                            <?php if(!$role->name =="Admin" || $role->name =="Support"){ echo(R::count('t_data_prosess','status="Y" AND unit_id=?',array($unit['id'])));}else{echo(R::count('t_data_prosess','status="Y"'));} ?>
                        </span>
                    </div>
                    <div class=" info-box-more">
                        <button class="btn btn-sm btn-primary"><i class="fas fa-file-export"></i> 0</button>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box btn mn-4 btn-outline-secondary"
                    onclick="$.get_menu('\admin-menu-applikasi-html-h_logistik')">
                    <span class="info-box-icon bg-success"><i class="fas fa-boxes"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Data Logistik</span>
                        <span class="info-box-number">0</span>
                    </div>
                    <div class=" info-box-more">
                        <button class="btn btn-sm btn-primary"><i class="fas fa-dolly"></i>
                            0</button>
                    </div>
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
                        <?php $this->load->view("admin/menu/applikasi/html/h_tangani_aduan");?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>