<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); $date = R::isoDateTime();?>
<?php $this->load->view('admin/menu/applikasi/function/f_sidavid'); ?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">APPLIKASI SIDAVID</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= site_url('admin');?>">Home</a></li>
                    <li class="breadcrumb-item active">Wellcome</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-outline card-purple">
                    <div class="justify-content-center text-center">
                        <img width="180" height="230" class="p-4"
                            src="<?= base_url()?>asset/portal/img/dummy/rsud-new.png" alt="Logo RSUDL">
                        <h3><?php if($unit){echo($unit['name']);}else{echo("Penetapan Posisi Anda Kerja Belum Lengkap");}?>
                        </h3>
                        <marquee bgcolor="#111f29">
                            <h1 style="color:#fff;">SELAMAT DATANG DI APLIKASI SI DAVID</h1>
                        </marquee>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">

        </div>
    </div>
</section>