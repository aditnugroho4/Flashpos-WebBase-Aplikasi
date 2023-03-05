<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php $id=$this->input->get('route'); $date = R::isoDateTime(); $this->load->view('admin/menu/inventory/function/f_master_inventory');?>
<section class="content-header">
    <div class="container-fluid">
        <!-- Breadcrumb -->
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Master Barang Inventory</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url();?>">Home</a></li>
                    <li class="breadcrumb-item">Asset Inventory</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-brown"><i class="fas fa-warehouse"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Asset Tetap</span>
                        <span class="info-box-number">Rp. <?= R::count('k_items_inventory')?></span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-brown"><i class="fas fa-shipping-fast"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Asset Berjalan</span>
                        <span class="info-box-number">Rp. <?= R::count('k_items_inventory')?></span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-brown"><i class="fas fa-dolly"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Asset Bertambah</span>
                        <span class="info-box-number">Rp. <?= R::count('k_items_inventory')?></span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-brown"><i class="fas fa-hard-hat"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Asset Penyusutan</span>
                        <span class="info-box-number">Rp. <?= R::count('k_items_inventory')?></span>
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
                <a href="#" class="btn btn-brown btn-block mb-3 btn-back">Back to
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
                                <span onclick="$.get_menu('\admin-menu-inventory-html-h_grup_inventory')"
                                    class="btn nav-link text-left mn-1">
                                    <i class="fas fa-fw fa-warehouse"></i> Grup Inventory
                                    <span class="badge bg-primary float-right"><?= R::count('k_grup_inventory')?></span>
                                </span>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body p-0">
                        <ul class="nav nav-pills flex-column">
                            <li class="nav-item">
                                <span onclick="$.get_menu('\admin-menu-inventory-html-h_jenis_inventory')"
                                    class="btn nav-link text-left mn-2">
                                    <i class="fas fa-fw fa-boxes"></i> Jenis Inventory
                                    <span
                                        class="badge bg-primary float-right"><?= R::count('k_jenis_inventory')?></span>
                                </span>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body p-0">
                        <ul class="nav nav-pills flex-column">
                            <li class="nav-item">
                                <span onclick="$.get_menu('\admin-menu-inventory-html-h_items_inventory')"
                                    class="btn nav-link text-left mn-3">
                                    <i class="fas fa-fw fa-box"></i> Items's Inventory
                                    <span
                                        class="badge bg-primary float-right"><?= R::count('k_items,inventory')?></span>
                                </span>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body p-0">
                        <ul class="nav nav-pills flex-column">
                            <li class="nav-item">
                                <span onclick="$.get_menu('\admin-menu-inventory-html-h_saldo_asset')"
                                    class="btn nav-link text-left mn-4">
                                    <i class="fas fa-fw fa-clipboard-list"></i> Saldo Awal Asset
                                    <span class="badge bg-primary float-right">0</span>
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-9 load-view-menu">
                <?php $this->load->view("admin/menu/inventory/html/h_items_inventory");?>
            </div>
        </div>
    </div>
</section>