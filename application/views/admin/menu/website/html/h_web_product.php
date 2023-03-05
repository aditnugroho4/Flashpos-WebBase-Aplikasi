<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php $id=$this->input->get('route'); $date = R::isoDateTime(); $this->load->view('admin/menu/website/function/f_web_product');?>
<section class="content-header">
    <div class="container-fluid">
        <!-- Breadcrumb -->
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>SETTING PRODUCT & KATAGORI</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active"><a href="<?= base_url('admin');?>">Dashboard</a></li>
                    <li class="breadcrumb-item "><a href=""></a>Product & Katagori</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-info"><i class="fas fa-wifi"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Pengunjung</span>
                        <span class="info-box-number">0</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-success"><i class="fas fa-check-circle"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Tamu E-library</span>
                        <span class="info-box-number">0</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="fas fa-download"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Download</span>
                        <span class="info-box-number">0</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-danger"><i class="fas fa-upload"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Upload</span>
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
                        <h3 class="card-title">Product Dan Katagori</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <ul class="nav nav-pills flex-column">
                            <li class="nav-item active">
                                <span onclick="$.get_menu('\admin-menu-website-html-h_menu_product')"
                                    class="btn nav-link text-left mn-1">
                                    <i class="fas fa-fw fa-building"></i> Nama Product
                                    <span class="badge bg-primary float-right"><?= R::count('w_post_product')?></span>
                                </span>
                            </li>
                            <li class="nav-item">
                                <span onclick="$.get_menu('\admin-menu-website-html-h_ctgr_elibrary')"
                                    class="btn nav-link text-left mn-2">
                                    <i class="fas fa-fw fa-book-reader"></i> Katagori E-Library
                                    <span class="badge bg-primary float-right"><?= R::count('w_post_ctgr_lib')?></span>
                                </span>
                            </li>
                            <li class="nav-item">
                                <span onclick="$.get_menu('\admin-menu-website-html-h_ctgr_blog')"
                                    class="btn nav-link text-left mn-3">
                                    <i class="far fa-fw fa-newspaper"></i> Katagori Blog
                                    <span class="badge bg-primary float-right"><?= R::count('w_post_ctgr_blog')?></span>
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-9 load-view-menu">
                <?php $this->load->view("admin/menu/website/html/h_menu_product");?>
            </div>
        </div>
    </div>
</section>