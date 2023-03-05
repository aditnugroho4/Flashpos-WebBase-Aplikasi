<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php $id=$this->input->get('route'); $date = R::isoDateTime(); $this->load->view('admin/menu/website/function/f_web_confiq');?>
<section class="content-header">
    <div class="container-fluid">
        <!-- Breadcrumb -->
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Pengaturan Website</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active"><a href="<?= base_url('admin');?>">Dashboard</a></li>
                    <li class="breadcrumb-item "><a href=""></a>Website Config</li>
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
                        <h3 class="card-title">Pengaturan Website</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <ul class="nav nav-pills flex-column">
                            <li class="nav-item active">
                                <span onclick="$.get_menu('\admin-menu-website-html-h_data_web')"
                                    class="btn nav-link text-left mn-1">
                                    <i class="fas fa-fw fa-user-edit"></i> Profile Website
                                    <span class="badge bg-primary float-right">0</span>
                                </span>
                            </li>
                            <li class="nav-item">
                                <span onclick="$.get_menu('\admin-menu-website-html-h_web_menu')"
                                    class="btn nav-link text-left mn-2">
                                    <i class="fas fa-fw fa-server"></i> Menu Website
                                    <span
                                        class="badge bg-primary float-right"><?= R::count('m_menu','status="Y"')?></span>
                                </span>
                            </li>
                            <li class="nav-item">
                                <span onclick="$.get_menu('\admin-menu-website-html-h_web_submenu')"
                                    class="btn nav-link text-left mn-3">
                                    <i class="fas fa-fw fa-sitemap"></i> SubMenu Website
                                    <span
                                        class="badge bg-primary float-right"><?= R::count('m_submenu','status="Y"')?></span>
                                </span>
                            </li>
                            <li class="nav-item">
                                <span onclick="$.get_menu('\admin-menu-website-html-h_menu_portal')"
                                    class="btn nav-link text-left mn-4">
                                    <i class="fas fa-fw fa-desktop"></i> Menu Portal
                                    <span
                                        class="badge bg-primary float-right"><?= R::count('w_post_apps','status="Y"')?></span>
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-9 load-view-menu">
                <?php $this->load->view("admin/menu/website/html/h_data_web");?>
            </div>
        </div>
    </div>
</section>
<div id="dlg-edit-status" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade text-left">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Status</h5>
            </div>
            <div class="modal-body">
                <p id="txtMessage"></p>
            </div>
            <div class="modal-footer">
                <button type="button" id="btn-prosess" class="btn bg-green waves-effect">Prosess</button>
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>