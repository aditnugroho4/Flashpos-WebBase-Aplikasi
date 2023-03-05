<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php $id=$this->input->get('route'); $date = R::isoDateTime(); $this->load->view('admin/menu/logistik/function/f_masterstock');?>
<section class="content-header">
    <div class="container-fluid">
        <!-- Breadcrumb -->
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Stock Bahan Baku</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url();?>">Home</a></li>
                    <li class="breadcrumb-item">Stock Bahan Baku</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-brown"><i class="fas fa-dolly-flatbed"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Stock</span>
                        <span class="info-box-number">0</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-brown"><i class="fas fa-warehouse"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Warning</span>
                        <span class="info-box-number">0</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-brown"><i class="fas fa-clipboard-check"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Over Stock</span>
                        <span class="info-box-number">0</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-brown"><i class="fas fa-cash-register"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Out Of Stock</span>
                        <span class="info-box-number">0</span>
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
                        <h3 class="card-title">Master Data</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <ul class="nav nav-pills flex-column">
                            <li class="nav-item">
                                <span onclick="$.get_menu('\admin-menu-logistik-html-h_frm_bahanbaku')"
                                    class="btn nav-link text-left mn-1">
                                    <i class="fas fa-fw fa-warehouse"></i> Bahan Baku
                                    <span class="badge bg-primary float-right">0</span>
                                </span>
                            </li>
                            <li class="nav-item">
                                <span onclick="$.get_menu('\admin-menu-logistik-html-h_frm_hitungstock')"
                                    class="btn nav-link text-left mn-2">
                                    <i class="fas fa-fw fa-clipboard-check"></i> Hitung Stock
                                    <span class="badge bg-primary float-right">0</span>
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-9 load-view-menu">
                <?php $this->load->view("admin/menu/logistik/html/h_frm_bahanbaku");?>
            </div>
        </div>
    </div>
</section>