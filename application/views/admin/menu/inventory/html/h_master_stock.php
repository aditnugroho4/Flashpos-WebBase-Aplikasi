<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php $id=$this->input->get('route'); $date = R::isoDateTime(); $this->load->view('admin/menu/inventory/function/f_master_stock');?>
<section class="content-header">
    <div class="container-fluid">
        <!-- Breadcrumb -->
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Master Stock</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url();?>">Home</a></li>
                    <li class="breadcrumb-item">Master Stock</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-success"><i class="fas fa-dolly-flatbed"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Stock Pembelian</span>
                        <span
                            class="info-box-number"><?= R::count('k_stock_pembelian','tanggal like ?',array(substr($date,0,7).'%'))?></span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-info"><i class="fas fa-warehouse"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Stock Awal</span>
                        <span class="info-box-number"><?= R::count('k_stok_awal','tanggal like ?',array(substr($date, 0, 10).'%'))?></span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="fas fa-clipboard-check"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Data Penjualan</span>
                        <span
                            class="info-box-number"><?= R::count('k_data_penjualan','tanggal like ?',array(substr($date, 0, 10).'%'))?></span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-danger"><i class="fas fa-poll"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Stock Terjual</span>
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
                        <h3 class="card-title">Master Stock</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <ul class="nav nav-pills flex-column">
                            <li class="nav-item">
                                <span onclick="$.get_menu('\admin-menu-inventory-html-h_stock_awal')"
                                    class="btn nav-link text-left mn-1">
                                    <i class="fas fa-fw fa-warehouse"></i> Stock Awal
                                    <span class="badge bg-primary float-right">0</span>
                                </span>
                            </li>
                            <li class="nav-item">
                                <span onclick="$.get_menu('\admin-menu-inventory-html-h_stock_pembelian')"
                                    class="btn nav-link text-left mn-2">
                                    <i class="fas fa-fw fa-clipboard-list"></i> Stock Pembelian
                                    <span class="badge bg-primary float-right">0</span>
                                </span>
                            </li>
                            <li class="nav-item">
                                <span onclick="$.get_menu('\admin-menu-inventory-html-h_stock_penerimaan')"
                                    class="btn nav-link text-left mn-3">
                                    <i class="fas fa-fw fa-dolly-flatbed"></i> Stock Penerimaan
                                    <span class="badge bg-primary float-right">0</span>
                                </span>
                            </li>
                            <li class="nav-item">
                                <span onclick="$.get_menu('\admin-menu-inventory-html-h_stock_penjualan')"
                                    class="btn nav-link text-left mn-4">
                                    <i class="fas fa-fw fa-clipboard-check"></i> Stock Penjualan
                                    <span class="badge bg-primary float-right">0</span>
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-9 load-view-menu">
                <?php $this->load->view("admin/menu/inventory/html/h_stock_pembelian");?>
            </div>
        </div>
    </div>
</section>