<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php $id=$this->input->get('route'); $date = R::isoDateTime(); 
$this->load->view('admin/menu/reporting/function/f_lap_pendapatan');?>
<section class="content-header">
    <div class="container-fluid">
        <!-- Breadcrumb -->
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Laporan Pendapatan</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url();?>">Home</a></li>
                    <li class="breadcrumb-item">Laporan Pendapatan</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-brown"><i class="fas fa-calculator"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Pendapatan Cafe</span>
                        <span class="info-box-number"><?= R::count('m_user','employ_id is null')?></span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-brown"><i class="far fa-house-user"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Pendapatan Boutique</span>
                        <span class="info-box-number"><?= R::count('m_user','verifikasi is null')?></span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-brown"><i class="fas fa-newspaper"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Penerimaan Kas</span>
                        <span class="info-box-number"><?= R::count('m_user','auth="N"')?></span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-brown"><i class="fas fa-notes-medical"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Pengeluaran Kas</span>
                        <span class="info-box-number"><?= R::count('m_user','auth="Y"')?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <a href="#" class="btn btn-primary btn-block mb-3 btn-back">Back to
                    Default</a>
                <div class="card card-loading">
                    <div class="card-header">
                        <h3 class="card-title">Data Master</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <ul class="nav nav-pills flex-column">
                            <li class="nav-item">
                                <span onclick="$.get_menu('\admin-menu-reporting-html-h_frm_penjualan')"
                                    class="btn nav-link text-left mn-1">
                                    <i class="fas fa-fw fa-calculator"></i> Pendapatan Cafe
                                    <span class="badge bg-primary float-right">Rp</span>
                                </span>
                            </li>
                            <li class="nav-item">
                                <span onclick="$.get_menu('\admin-menu-reporting-html-h_jurnal_pembelian')"
                                    class="btn nav-link text-left mn-2">
                                    <i class="fas fa-fw fa-house-user"></i> Pendapatan Boutique
                                    <span class="badge bg-primary float-right">Rp</span>
                                </span>
                            </li>
                            <li class="nav-item">
                                <span onclick="$.get_menu('\admin-menu-reporting-html-h_frm_pembelian')"
                                    class="btn nav-link text-left mn-3">
                                    <i class="fas fa-fw fa-newspaper"></i> Lap Pembelian
                                    <span class="badge bg-primary float-right">Rp</span>
                                </span>
                            </li>
                            <li class="nav-item">
                                <span onclick="$.get_menu('\admin-menu-reporting-html-h_frm_pengeluaran')"
                                    class="btn nav-link text-left mn-4">
                                    <i class="fas fa-fw fa-notes-medical"></i> Lap Pengeluaran
                                    <span class="badge bg-primary float-right">Rp</span>
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-9 load-view-menu">
                <?php $this->load->view("admin/menu/reporting/html/h_frm_penjualan");?>
            </div>
        </div>
    </div>
</section>