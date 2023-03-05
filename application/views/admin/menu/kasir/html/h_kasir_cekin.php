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
                        <img src="<?php if(!$user->foto){echo (base_url('asset/images/user/avatar5.png'));}else {echo  (base_url('asset/images/user/'.$user->foto));}  ?>"
                            alt="User Image">
                    </div>
                    <form class="lockscreen-credentials" id="post_cekin_kasir">
                        <div class="input-group">
                            <input type="password" id="txtPin" class="form-control" maxlength="6"
                                placeholder="Masukan Pin" required>

                            <div class="input-group-append">
                                <button type="submit" id="btn-pin" class="btn"><i
                                        class="fas fa-arrow-right text-muted"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="help-block text-center">
                Masukan Pin Initial Kasir
            </div>
            <div class="text-center">
                Untuk Melanjutkan Transaksi
            </div>
            <div class="lockscreen-footer text-center">
                <marquee bgcolor="#111f29">
                    <h5 class="text-white">Acita Angkringan & cofe'</h5>
                </marquee>
            </div>
        </div>
    </div>
</section>