<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php $id=$this->input->get('route'); $date = R::isoDateTime(); $this->load->view('admin/menu/katalogue/function/f_master_customer');?>
<section class="content-header">
    <div class="container-fluid">
        <!-- Breadcrumb -->
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Data Customer</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url();?>">Home</a></li>
                    <li class="breadcrumb-item">Data Customer</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-brown"><i class="fas fa-warehouse"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Customer Baru</span>
                        <span class="info-box-number"><?= R::count('k_items_inventory')?></span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-brown"><i class="fas fa-shipping-fast"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Customer Booking</span>
                        <span class="info-box-number"><?= R::count('k_items_inventory')?></span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-brown"><i class="fas fa-dolly"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Event</span>
                        <span class="info-box-number"><?= R::count('k_items_inventory')?></span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-brown"><i class="fas fa-hard-hat"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Selesai</span>
                        <span class="info-box-number"><?= R::count('k_items_inventory')?></span>
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
                                <span onclick="$.get_menu('\admin-menu-katalogue-html-h_customer_list')"
                                    class="btn nav-link text-left mn-1">
                                    <i class="fas fa-fw fa-warehouse"></i> Customer List
                                    <span class="badge bg-primary float-right"><?= R::count('b_customer_list')?></span>
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-10 load-view-menu">
                <?php $this->load->view("admin/menu/katalogue/html/h_customer_list");?>
            </div>
        </div>
    </div>
</section>