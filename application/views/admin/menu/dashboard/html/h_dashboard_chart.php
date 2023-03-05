<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); $date = R::isoDateTime();?>
<?php $this->load->view('admin/menu/dashboard/function/f_dashboard_chart'); ?>
<?php if($role->name=="Kasir"){?>
<section class="hold-transition lockscreen">
    <div class="lockscreen-wrapper">
        <div class="lockscreen-logo">
            <h1>Menu</h1>
        </div>
        <div class="row">
            <div class="col-12">
                <a
                    href="<?= site_url('Kasir/page/user?mod='.base64_encode("admin-menu-kasir-html-h_kasir_template").'&role='.base64_encode($role->id));?>">
                    <div class="info-box btn-outline-brown">
                        <span class="info-box-icon bg-brown"><i class="fas fa-cash-register"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Transaksi</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-12">
                <a
                    href="<?= site_url('Kasir/page/user?mod='.base64_encode("admin-menu-kasir-html-h_frm_closing").'&role='.base64_encode($role->id));?>">
                    <div class="info-box btn-outline-brown">
                        <span class="info-box-icon bg-brown"><i class="fas fa-calculator"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Closing</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-12">
                <div class="info-box btn-outline-brown">
                    <span class="info-box-icon bg-brown"><i class="fas fa-undo"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Retur</span>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="info-box btn-outline-brown">
                    <span class="info-box-icon bg-brown"><i class="fas fa-clipboard-check"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Stock Opname</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php }else{?>
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Dashboard</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url('admin')?>">Home</a></li>
                    <li class="breadcrumb-item active"><a href="#">Dashboard</a></li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-brown"><i class="fas fa-calculator"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Jumlah Pembayaran</span>
                        <span class="info-box-number">0</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-brown"><i class="fas fa-hourglass-half"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Pembayaran Pending</span>
                        <span class="info-box-number"><?= R::count('m_user','auth="Y"')?></span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-brown"><i class="fas fa-eraser"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Cancel Bon</span>
                        <span class="info-box-number">0</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-brown"><i class="fas fa-undo"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Retur Produk</span>
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
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="d-flex justify-content-between">

                            <h3 class="card-title">Pelanggan Mingguan</h3>
                            <a href="javascript:void(0);">View Report</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex">
                            <p class="d-flex flex-column">
                                <span class="text-bold text-lg" id="lbl-count">820</span>
                                <span>Pelanggan Setiap Waktu</span>
                            </p>
                            <p class="ml-auto d-flex flex-column text-right">
                                <span class="text-success">
                                    <i class="fas fa-arrow-up"></i> 12.5%
                                </span>
                                <span class="text-muted">Dari minggu sebelumnya</span>
                            </p>
                        </div>
                        <!-- /.d-flex -->
                        <div class="position-relative mb-4">
                            <div class="chartjs-size-monitor">
                                <div class="chartjs-size-monitor-expand">
                                    <div class=""></div>
                                </div>
                                <div class="chartjs-size-monitor-shrink">
                                    <div class=""></div>
                                </div>
                            </div>
                            <canvas id="Chart-customer" height="200" width="764"
                                style="display: block; width: 764px; height: 200px;"
                                class="chartjs-render-monitor"></canvas>
                        </div>

                        <div class="d-flex flex-row justify-content-end">
                            <span class="mr-2">
                                <i class="fas fa-square text-primary"></i> Minggu ini
                            </span>

                            <span>
                                <i class="fas fa-square text-gray"></i> Minggu Lalu
                            </span>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header border-0">
                        <h3 class="card-title">10 Produk Terlaris </h3>
                        <div class="card-tools">
                            <a href="#" class="btn btn-tool btn-sm">
                                <i class="fas fa-download"></i>
                            </a>
                            <a href="#" class="btn btn-tool btn-sm">
                                <i class="fas fa-bars"></i>
                            </a>
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table id="tblData" class="table table-striped table-valign-middle">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Harga</th>
                                    <th>Terjual</th>
                                    <th>More</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title">Pendapatan</h3>
                            <a href="javascript:void(0);">View Report</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex">
                            <p class="d-flex flex-column">
                                <span class="text-bold text-lg" id="lbl-sales">Rp.18,230.00</span>
                                <span>Pendapatan Setiap Waktu</span>
                            </p>
                            <p class="ml-auto d-flex flex-column text-right">
                                <span class="text-success">
                                    <i class="fas fa-arrow-up"></i> 33.1%
                                </span>
                                <span class="text-muted">1 Minggu kemarin</span>
                            </p>
                        </div>
                        <!-- /.d-flex -->

                        <div class="position-relative mb-4">
                            <div class="chartjs-size-monitor">
                                <div class="chartjs-size-monitor-expand">
                                    <div class=""></div>
                                </div>
                                <div class="chartjs-size-monitor-shrink">
                                    <div class=""></div>
                                </div>
                            </div>
                            <canvas id="Sales-chart" height="200" style="display: block; width: 764px; height: 200px;"
                                width="764" class="chartjs-render-monitor"></canvas>
                        </div>

                        <div class="d-flex flex-row justify-content-end">
                            <span class="mr-2">
                                <i class="fas fa-square text-primary"></i> Minggu ini
                            </span>

                            <span>
                                <i class="fas fa-square text-gray"></i> Minggu Kemarin
                            </span>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header border-0">
                        <h3 class="card-title">10 Produk Kurang Laris </h3>
                        <div class="card-tools">
                            <a href="#" class="btn btn-tool btn-sm">
                                <i class="fas fa-download"></i>
                            </a>
                            <a href="#" class="btn btn-tool btn-sm">
                                <i class="fas fa-bars"></i>
                            </a>
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table id="tblData1" class="table table-striped table-valign-middle">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Harga</th>
                                    <th>Terjual</th>
                                    <th>More</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php }?>