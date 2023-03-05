<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php $id=$this->input->get('route'); $date = R::isoDateTime(); $this->load->view('admin/menu/website/function/f_web_editor');?>
<section class="content-header">
    <div class="container-fluid">
        <!-- Breadcrumb -->
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Conten Editor</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active"><a href="<?= base_url('admin');?>">Dashboard</a></li>
                    <li class="breadcrumb-item "><a href=""></a>Website Editor</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-info"><i class="far fa-flag"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Posting</span>
                        <span class="info-box-number"><?= R::count('w_post_artikel');?></span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-success"><i class="fas fa-chart-line"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Pengunjung</span>
                        <span class="info-box-number">0</span>
                    </div>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="fas fa-user-check"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Tamu</span>
                        <span class="info-box-number"><?= R::count('m_user_member');?></span>
                    </div>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-danger"><i class="far fa-comment-alt"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Ulasan</span>
                        <span class="info-box-number"><?= R::count('m_user_ulasan');?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 col-sm-12">
                <div class="row">
                    <div class="col-12">
                        <a href="#" class="btn btn-primary btn-block mb-3 btn-back">Back to
                            Default</a>
                        <div class="card card-loading">
                            <div class="card-header">
                                <h3 class="card-title">Menu Website</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                            class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <ul class="nav nav-pills flex-column">
                                    <li class="nav-item active">
                                        <span onclick="$.get_menu('\admin-menu-website-html-h_edit_header')"
                                            class="btn nav-link text-left mn-1">
                                            <i class="fas fa-fw fa-desktop"></i> Header
                                            <span
                                                class="badge bg-pink float-right"><?= R::count('w_post_banner');?></span>
                                        </span>
                                    </li>
                                    <li class="nav-item">
                                        <span onclick="$.get_menu('\admin-menu-website-html-h_edit_gallery')"
                                            class="btn nav-link text-left mn-2">
                                            <i class="fas fa-fw fa-images"></i> Gallery
                                            <span
                                                class="badge bg-pink float-right"><?= R::count('w_post_images');?></span>
                                        </span>
                                    </li>
                                    <li class="nav-item">
                                        <span onclick="$.get_menu('\admin-menu-website-html-h_edit_services')"
                                            class="btn nav-link text-left mn-3">
                                            <i class="far fa-fw fa-file-alt"></i> Services (Layanan)
                                            <span
                                                class="badge bg-pink float-right"><?= R::count('w_post_product');?></span>
                                        </span>
                                    </li>
                                    <li class="nav-item">
                                        <span onclick="$.get_menu('\admin-menu-website-html-h_edit_elibrary')"
                                            class="btn nav-link text-left mn-4">
                                            <i class="fas fa-fw fa-book-reader"></i> E-library
                                            <span
                                                class="badge bg-pink float-right"><?= R::count('w_post_elibrary');?></span>
                                        </span>
                                    </li>
                                    <li class="nav-item">
                                        <span onclick="$.get_menu('\admin-menu-website-html-h_data_dokter')"
                                            class="btn nav-link text-left mn-5">
                                            <i class="fas fa-fw fa-user-md"></i> Data Dokter
                                            <span
                                                class="badge bg-pink float-right"><?= R::count('m_dokter','status ="Y"');?></span>
                                        </span>
                                    </li>
                                    <li class="nav-item">
                                        <span onclick="$.get_menu('\admin-menu-website-html-h_edit_blog')"
                                            class="btn nav-link text-left mn-6">
                                            <i class="fas fa-fw fa-file-alt"></i> Blog
                                            <span
                                                class="badge bg-pink float-right"><?= R::count('w_post_artikel');?></span>
                                        </span>
                                    </li>
                                    <li class="nav-item">
                                        <span onclick="$.get_menu('\admin-menu-website-html-h_edit')"
                                            class="btn nav-link text-left mn-7">
                                            <i class="fas fa-fw fa-indent"></i> Footer
                                            <span class="badge bg-pink float-right">0</span>
                                        </span>
                                    </li>
                                    <li class="nav-item">
                                        <span onclick="$.get_menu('\admin-menu-website-html-h_seo_tools')"
                                            class="btn nav-link text-left mn-8">
                                            <i class="fas fa-fw fa-server"></i> SEO Tools
                                        </span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">View</span>
                                <span class="info-box-number">0</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-success"><i class="far fa-hand-point-right"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Like</span>
                                <span class="info-box-number">0</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-warning"><i class="far fa-copy"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Comment</span>
                                <span class="info-box-number">0</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-danger"><i class="fa fa-share-alt"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Dibagikan</span>
                                <span class="info-box-number">0</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9 col-sm-12 load-view-menu">
                <?php $this->load->view("admin/menu/website/html/h_edit_header");?>
            </div>
        </div>
    </div>
</section>