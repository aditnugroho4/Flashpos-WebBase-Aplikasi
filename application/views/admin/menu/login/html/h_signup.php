<?php if ( ! defined( 'BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view('admin/menu/login/function/f_signup');?>
<div class="register-box">
    <div class="register-logo">
        <a href="<?= site_url('login')?>"><b>Admin</b>Dashboard</a>
    </div>
    <div class="card loading">
        <div class="card-body register-card-body">
            <p class="login-box-msg">Mendaftar akun baru</p>
            <form id="signup_registrasi" method="post">
                <div class="input-group mb-3">
                    <input type="text" name="Nama" maxlength="45" minlength="4" class="form-control"
                        placeholder="Nama Lengkap & Gelar" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="email" name="Email" class="form-control" placeholder="Email" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="Password" id="tPass" maxlength="8" class="form-control"
                        placeholder="Password" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="RePassword" id="tRePass" maxlength="8" class="form-control"
                        placeholder="Retype password" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-key"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" id="agreeTerms" name="terms" value="agree" required>
                            <label for="agreeTerms">
                                Saya setuju <a href="#">dengan aturan yang berlaku</a>
                            </label>
                        </div>
                    </div>
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Daftar</button>
                    </div>
                </div>
            </form>
            <div class="social-auth-links text-center mb-3">
                <p>- OR -</p>
            </div>
            <a href="<?= base_url('login');?>" class="text-center">Saya sudah memiliki akun..</a>
        </div>
    </div>
</div>