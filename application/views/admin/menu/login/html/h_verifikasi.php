<?php if ( ! defined( 'BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view('admin/menu/login/function/f_forgot');?>
<div class="login-box">
    <div class="login-logo">
        <a href="<?= site_url('login')?>"><b>Verifikasi</b>User</a>
    </div>
    <div class="card loading">
        <div class="card-body register-card-body">
            <p class="login-box-msg">HAI.. <?= $user->nama;?> </br> SILAHKAN MASUKAN ID PEGAWAI ANDA</p>

            <form id="verif" method="post">
                <div class="input-group mb-3">
                    <input type="number" id="txtnip" name="NIP" maxlength="18" class="form-control"
                        placeholder="Masukan NIP/NIPB/NRPTT"
                        oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                        required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <div class="col-12 mt-10">
                    <button type="submit" class="btn btn-primary btn-block">Verifikasi</button>
                </div>
            </form>
        </div>
    </div>
</div>