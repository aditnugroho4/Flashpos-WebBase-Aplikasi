<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php $id=$this->input->get('route'); $date = R::isoDateTime(); $this->load->view('admin/menu/inventory/function/f_master_barang');?>
<section class="content-header">
    <div class="container-fluid">
        <!-- Breadcrumb -->
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Product Jual</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url();?>">Home</a></li>
                    <li class="breadcrumb-item">Master Barang</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-brown"><i class="fas fa-shopping-basket"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Data product</span>
                        <span class="info-box-number"><?= R::count('k_item_barang')?></span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-brown"><i class="far fa-flag"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Product Off</span>
                        <span class="info-box-number"><?= R::count('k_item_barang','status="N"')?></span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-brown"><i class="fas fa-cart-plus"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Product On</span>
                        <span class="info-box-number"><?= R::count('k_item_barang','status="Y"')?></span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-brown"><i class="fas fa-folder"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Menu</span>
                        <span class="info-box-number"><?= R::count('k_jenis_barang')?></span>
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
                                <span onclick="$.get_menu('\admin-menu-inventory-html-h_grup_barang')"
                                    class="btn nav-link text-left mn-1">
                                    <i class="fas fa-fw fa-columns"></i> Grup Barang
                                    <span class="badge bg-primary float-right"><?= R::count('k_grup_barang')?></span>
                                </span>
                            </li>
                            <li class="nav-item">
                                <span onclick="$.get_menu('\admin-menu-inventory-html-h_jenis_barang')"
                                    class="btn nav-link text-left mn-2">
                                    <i class="fas fa-fw fa-columns"></i> Jenis Barang
                                    <span class="badge bg-primary float-right"><?= R::count('k_jenis_barang')?></span>
                                </span>
                            </li>
                            <li class="nav-item">
                                <span onclick="$.get_menu('\admin-menu-inventory-html-h_items_barang')"
                                    class="btn nav-link text-left mn-3">
                                    <i class="fas fa-fw fa-shopping-basket"></i> Item / Barang
                                    <span class="badge bg-primary float-right"><?= R::count('k_item_barang')?></span>
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-9 load-view-menu">
                <?php $this->load->view("admin/menu/inventory/html/h_items_barang");?>
            </div>
        </div>
    </div>
</section>