<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php $id=$this->input->get('route'); $date = R::isoDateTime(); $this->load->view('admin/menu/master/function/f_management');?>
<section class="content-header">
    <div class="container-fluid">
        <!-- Breadcrumb -->
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>USER MANAGEMENT</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active"><a href="<?= base_url('admin');?>">Dashboard</a></li>
                    <li class="breadcrumb-item "><a href=""></a>User Management</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-info"><i class="fas fa-user-plus"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Registrasi User Baru</span>
                        <span class="info-box-number"><?= R::count('m_user','employ_id is null')?></span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-success"><i class="fas fa-fw fa-user-circle"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">User Tervalidasi</span>
                        <span class="info-box-number"><?= R::count('m_user','verifikasi="Y"')?></span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="fas fa-signal"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">User Online</span>
                        <span class="info-box-number"><?= R::count('m_user','auth="N"')?></span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-danger"><i class="fas fa-exclamation-circle"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">User Offline</span>
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
                        <h3 class="card-title">Struktur User</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <ul class="nav nav-pills flex-column">
                            <li class="nav-item active">
                                <span onclick="$.get_menu('\admin-menu-master-html-h_struktur')"
                                    class="btn nav-link text-left mn-1">
                                    <i class="fas fa-fw fa-building"></i> Divisi
                                </span>
                            </li>
                            <li class="nav-item">
                                <span onclick="$.get_menu('\admin-menu-master-html-h_unit')"
                                    class="btn nav-link text-left mn-2">
                                    <i class="fas fa-fw fa-sitemap"></i> Unit / Bagian
                                </span>
                            </li>
                            <li class="nav-item">
                                <span onclick="$.get_menu('\admin-menu-master-html-h_role')"
                                    class="btn nav-link text-left mn-3">
                                    <i class="far fa-fw fa-file-alt"></i> Role (Hak Aksess)
                                </span>
                            </li>
                            <li class="nav-item">
                                <span onclick="$.get_menu('\admin-menu-master-html-h_user')"
                                    class="btn nav-link text-left mn-4">
                                    <i class="fas fa-fw fa-user-circle"></i> User
                                    <span
                                        class="badge bg-primary float-right"><?= R::count('m_user','verifikasi="Y"')?></span>
                                </span>
                            </li>
                            <li class="nav-item">
                                <span onclick="$.get_menu('\admin-menu-master-html-h_reg_user')"
                                    class="btn nav-link text-left mn-5">
                                    <i class="fas fa-fw fa-user-plus"></i> Registrasi & Validasi
                                    <span
                                        class="badge bg-primary float-right"><?= R::count('m_user','verifikasi is null')?></span>
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-9 load-view-menu">
                <?php $this->load->view("admin/menu/master/html/h_struktur");?>
            </div>
        </div>
    </div>
</section>
<div id="dlgAlert" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-col-light-blue ">
            <div class="modal-header">
                <h4 class="modal-title">Warning...</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="txtAlert"></p>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnChange" class="btn bg-green waves-effect">Setuju</button>
                <button type="button" class="btn btn-warning waves-effect" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>
<div id="dlgDecision" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade text-left">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pilihan Lanjutan</h5>
            </div>
            <div class="modal-body">
                <p id="txtDecision"></p>
            </div>
            <div class="modal-footer">
                <button type="button" id="btn-prosess" class="btn bg-green waves-effect">Prosess</button>
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>