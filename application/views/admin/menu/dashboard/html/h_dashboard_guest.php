<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); $date = R::isoDateTime();?>
<?php $this->load->view('admin/menu/dashboard/function/f_dashboard_guest'); ?>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 mt-2">
                <div class="card card-outline card-purple">
                    <div class="justify-content-center text-center">
                        <img width="250" height="150" class="p-4" src="<?= base_url()?>asset/admin/dist/img/icon.png"
                            alt="Logo RSUDL">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle"
                                src="<?php if(!$user->foto){echo (base_url('asset/images/user/avatar5.png'));}else {echo  (base_url('asset/images/user/'.$user->foto));}  ?>"
                                alt="User profile picture">
                        </div>
                        <h3 class="profile-username text-center"><?= $user->nama; ?></h3>
                        <p class="text-muted text-center"><?= $role->name; ?></p>
                    </div>
                </div>
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Data Sosial</h3>
                    </div>
                    <div class="card-body">
                        <strong><i class="fab fa-whatsapp mr-1"></i> WhatsApp</strong>

                        <p class="text-muted">
                            <?= $user->whatsapp;?>
                        </p>

                        <hr>

                        <strong><i class="fas fa-map-marker-alt mr-1"></i> Alamat</strong>

                        <p class="text-muted"><?= $user->alamat;?></p>

                        <hr>

                        <strong><i class="fas fa-pencil-alt mr-1"></i> Sosial Media</strong>

                        <p class="text-muted">
                            <span class="tag tag-danger"><?php echo $user->email;?></span>
                            <span class="tag tag-success"><?php echo $user->facebook;?></span>
                            <span class="tag tag-info"><?php echo $user->instagram;?></span>
                            <span class="tag tag-warning"><?php echo $user->youtube;?></span>
                            <span class="tag tag-primary"><?php echo $user->twitter;?></span>
                        </p>

                        <hr>

                        <strong><i class="far fa-file-alt mr-1"></i> Experience</strong>

                        <p class="text-muted"><?php echo $user->pengalaman;?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">STATUS ACCOUNT</h3>
                    </div>
                    <div class="card-body box-profile">
                        <div class="timeline"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="modal fade show" id="SendMail" aria-modal="true" backdrop-static="true">
    <div class="modal-dialog loading">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Kirim Email</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Mengirim Ulang Verifikasi Ke Email ( <?= $user->email?> )</p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" id="btn-send-o" class="btn btn-primary "><i class="fas fa-paper-plane"></i>
                    Kirim</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<div class="modal fade show" id="dlg-posisi" aria-modal="true" backdrop-static="true">
    <div class="modal-dialog loading">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Lengkapi Data</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p><i class="fas fa-exclamation-triangle"></i> Lengkapi dengan benar Penempatan Anda Bekerja Saat ini..
                </p>
                <div class="form-group">
                    <label for="cmbUnit">Unit / Bagian</label>
                    <select id="cmbUnit" name="unit" class="form-control" required></select>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" id="Send-lengkapi" class="btn btn-primary "><i class="fas fa-paper-plane"></i>
                    Kirim</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>