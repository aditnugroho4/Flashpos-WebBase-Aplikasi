<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php $id=$this->input->get('route'); $date = R::isoDateTime(); $this->load->view('admin/menu/katalogue/function/f_master_product');?>
<section class="content-header">
    <div class="container-fluid">
        <!-- Breadcrumb -->
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Product Jasa</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url();?>">Home</a></li>
                    <li class="breadcrumb-item">Master Product</li>
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
            <div class="col-lg-2">
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
                                <span onclick="$.get_menu('\admin-menu-katalogue-html-h_product_grup')"
                                    class="btn nav-link text-left mn-1">
                                    <i class="fas fa-fw fa-tag"></i> Product
                                    <span class="badge bg-primary float-right"><?= R::count('b_product_grup')?></span>
                                </span>
                            </li>
                            <li class="nav-item">
                                <span onclick="$.get_menu('\admin-menu-katalogue-html-h_product_ctgr')"
                                    class="btn nav-link text-left mn-2">
                                    <i class="far fa-file-alt fa-fw"></i> Katagori
                                    <span class="badge bg-primary float-right"><?= R::count('b_product_ctgr')?></span>
                                </span>
                            </li>
                            <li class="nav-item">
                                <span onclick="$.get_menu('\admin-menu-katalogue-html-h_product_item')"
                                    class="btn nav-link text-left mn-3">
                                    <i class="fas fa-fw fa-shopping-basket"></i> Item's Satuan
                                    <span class="badge bg-primary float-right"><?= R::count('b_product_item')?></span>
                                </span>
                            </li>
                            <li class="nav-item">
                                <span onclick="$.get_menu('\admin-menu-katalogue-html-h_product_paket')"
                                    class="btn nav-link text-left mn-4">
                                    <i class="fas fa-fw fa-tasks"></i> Paket List
                                    <span class="badge bg-primary float-right"><?= R::count('b_product_paket')?></span>
                                </span>
                            </li>
                            <li class="nav-item">
                                <span onclick="$.get_menu('\admin-menu-katalogue-html-h_paket_detail')"
                                    class="btn nav-link text-left mn-5">
                                    <i class="fas fa-fw fa-tags"></i> Item's Paket
                                    <span class="badge bg-primary float-right"><?= R::count('b_detailpaket')?></span>
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-10 load-view-menu">
                <?php $this->load->view("admin/menu/katalogue/html/h_product_item");?>
            </div>
        </div>
    </div>
</section>