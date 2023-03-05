<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php $id=$this->input->get('route'); $date = R::isoDateTime(); $this->load->view('admin/menu/master/function/f_fiturmenu');?>
<section class="content-header">
    <div class="container-fluid">
        <!-- Breadcrumb -->
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>FITUR & MENU</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active"><a href="<?= base_url('admin');?>">Dashboard</a></li>
                    <li class="breadcrumb-item "><a href=""></a>Fitur & Menu</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-info"><i class="fas fa-laptop-house"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Menu Utama</span>
                        <span class="info-box-number"><?= R::count('m_menu')?></span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-success"><i class="fas fa-fw fa-sitemap"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Sub Menu</span>
                        <span class="info-box-number"><?= R::count('m_submenu')?></span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="fas fa-power-off"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Menu Aktif</span>
                        <span class="info-box-number"><?= R::count('m_submenu','active="Y"')?></span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-danger"><i class="fas fa-upload"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Request Menu</span>
                        <span class="info-box-number"><?= R::count('m_submenu','active="N"')?></span>
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
                        <h3 class="card-title">Struktur</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <ul class="nav nav-pills flex-column">
                            <li class="nav-item active">
                                <span onclick="$.get_menu('\admin-menu-master-html-h_menu')"
                                    class="btn nav-link text-left mn-1">
                                    <i class="fas fa-laptop-house"></i> Menu Utama
                                    <span class="badge bg-primary float-right"><?= R::count('m_menu')?></span>
                                </span>
                            </li>
                            <li class="nav-item">
                                <span onclick="$.get_menu('\admin-menu-master-html-h_submenu')"
                                    class="btn nav-link text-left mn-2">
                                    <i class="fas fa-fw fa-sitemap"></i> Sub Menu
                                    <span class="badge bg-primary float-right"><?= R::count('m_submenu')?></span>
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-9 load-view-menu">
                <?php $this->load->view("admin/menu/master/html/h_menu");?>
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