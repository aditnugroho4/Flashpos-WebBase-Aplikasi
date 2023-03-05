<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); $date = R::isoDateTime();?>
<?php $this->load->view('admin/menu/katalogue/function/f_katalogue'); ?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-lg-12">
                <div class="card card-outline card-purple">
                    <div class="justify-content-center text-center">
                        <img width="285" height="180" class="p-4" src="<?= base_url()?>asset/admin/dist/img/icon-2.png"
                            alt="Logo Acita">
                        <h3>KATALOGUE</h3>
                        <marquee bgcolor="#111f29">
                            <h1 style="color:#fff;">SELAMAT DATANG DI ACITA MEDIA</h1>
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
            <div class="col-lg-12">
                <div class="product-list row"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-outline card-purple card-loading">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-list"></i>
                            RINCIAN PRODUCT
                        </h3>
                    </div>
                    <div class="card-body load-view-menu">
                        <div id="status__product" class="card">
                            <div class="card-body">
                                <div id="product__satuan" class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">
                                            <i class="fas fa-pencil"></i>
                                            SATUAN
                                        </h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                                data-toggle="tooltip" title="Collapse">
                                                <i class="fas fa-minus"></i></button>
                                        </div>
                                    </div>
                                    <div class="card-body">

                                    </div>
                                </div>
                                <div id="product__paket" class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">
                                            <i class="fas fa-pencil"></i>
                                            PAKET
                                        </h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                                data-toggle="tooltip" title="Collapse">
                                                <i class="fas fa-minus"></i></button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <ul class="todo-list" id="paket-list_1" data-widget="todo-list">
                                            <li>
                                                <div class="row">
                                                    <div class="col-xs-12 col-md-6">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                        <i class="fas fa-ellipsis-v"></i>
                                                        <span class="text">Data Product Kosong</span>
                                                    </div>
                                                    <div class="col-xs-12 col-md-6">
                                                        <span class="float-right" onclick="">
                                                            <small class="btn btn-sm bg-green bg-gradient"><i
                                                                    class="far fa-clock"></i> Kosong</small>
                                                        </span>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="card-footer">
                                        <div id="pagination"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>