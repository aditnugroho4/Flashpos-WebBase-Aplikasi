<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); $date = R::isoDateTime();?>
<?php $this->load->view('admin/menu/kasir/function/f_kasir_initial'); ?>
<section class="hold-transition lockscreen">
    <div class="lockscreen-wrapper" id="lockscreen">
        <div class="card card-outline card-gray load-initial p-1">
            <div class="lockscreen-logo">
                <b>Flash</b>POS
            </div>
            <div class="card-footer bg-brown rounded">
                <div class="lockscreen-name"><?php echo $user->nama; ?></div>
                <div class="lockscreen-item">
                    <div class="lockscreen-image bg-dark">
                        <i class="fas fa-exclamation-triangle fa-2x"></i>
                    </div>
                </div>
            </div>
            <div class="help-block text-center">
                Akun Initial Sedang di gunakan di Device Lain
            </div>
            <div class="lockscreen-item">
                <a
                    href="<?php echo site_url('admin/page/user?mod='.base64_encode("admin-menu-kasir-html-h_frm_closing").'&route='.base64_encode($role->id));?>">
                    <button type="button" class="btn btn-info col-12">Back<i
                            class="fas fa-arrow-right mt-1 float-right"></i></button></a>
            </div>
            <div class="lockscreen-footer text-center">
                <marquee bgcolor="#111f29">
                    <h5 class="text-white">Acita Angkringan & cofe'</h5>
                </marquee>
            </div>
        </div>
    </div>
</section>