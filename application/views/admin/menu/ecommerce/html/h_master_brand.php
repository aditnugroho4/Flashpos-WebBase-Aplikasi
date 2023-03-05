<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php $id=$this->input->get('route'); $date = R::isoDateTime(); $this->load->view('admin/menu/ecommerce/function/f_master_brand');?>
<section class="content-header">
    <div class="container-fluid">
        <!-- Breadcrumb -->
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Master Brand</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url();?>">Home</a></li>
                    <li class="breadcrumb-item">Master Brand</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-info"><i class="fas fa-user-plus"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Data Brand</span>
                        <span class="info-box-number"><?= R::count('m_user','employ_id is null')?></span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-success"><i class="far fa-flag"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Data Pegawai</span>
                        <span class="info-box-number"><?= R::count('m_user','verifikasi is null')?></span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="fas fa-signal"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Data Asset</span>
                        <span class="info-box-number"><?= R::count('m_user','auth="N"')?></span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-danger"><i class="fas fa-exclamation-circle"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Data Member</span>
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
                                <span onclick="$.get_menu('\admin-menu-ecommerce-html-h_data_brand')"
                                    class="btn nav-link text-left mn-1">
                                    <i class="fas fa-fw far fa-copyright"></i> Data Brand
                                    <span class="badge bg-primary float-right"><?= R::count('m_brand')?></span>
                                </span>
                            </li>
                            <li class="nav-item">
                                <span onclick="$.get_menu('\admin-menu-ecommerce-html-h_data_pegawai')"
                                    class="btn nav-link text-left mn-2">
                                    <i class="fas fa-fw fa-user-circle"></i> Data Pegawai
                                    <span class="badge bg-primary float-right"><?= R::count('m_absen')?></span>
                                </span>
                            </li>
                            <li class="nav-item">
                                <span onclick="$.get_menu('\admin-menu-ecommerce-html-h_data_asset')"
                                    class="btn nav-link text-left mn-3">
                                    <i class="fas fa-fw fas fa-cubes"></i> Data Asset
                                    <span class="badge bg-primary float-right"><?= R::count('m_absen')?></span>
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-9 load-view-menu">
                <?php $this->load->view("admin/menu/ecommerce/html/h_data_brand");?>
            </div>
        </div>
    </div>
</section>