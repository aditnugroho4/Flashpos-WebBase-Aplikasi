<?php if ( ! defined( 'BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view('admin/menu/login/function/f_signin');?>
<div class="login-box card rounded-lg">
    <div class="login-logo">
        <img width="165" height="85" class="img-responsive mt-3" src="<?= base_url()?>asset/admin/dist/img/icon.png"
            alt="Flash POS logo">
    </div>
    <!-- /.login-logo -->
    <div class="card loading p-2">
        <div class="card-body login-card-body rounded">
            <p class="login-box-msg">Login dengan user anda..</p>
            <form id="sign_in" method="POST">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="username" id="txtUsername" placeholder="Username"
                        required autofocus>
                    <div class="input-group-append">
                        <div class="input-group-text bg-white">
                            <span class="fas fa-envelope "></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" id="txtPassword" name="password" placeholder="Password"
                        required>
                    <div class="input-group-append">
                        <div class="input-group-text bg-white">
                            <span class="fas fa-lock "></span>
                        </div>
                    </div>
                </div>
                <!-- <div class="row mt-4" id="Capthca">
                    <div class="col-12">
                        <div class="text-left" id="notif">
                            <span>
                                <i class="material-icons text-green">notifications</i>
                                <label> Siapa anda..? </label>
                            </span>
                        </div>
                    </div>
                    <div class="col-12">

                        <div class="text-center">
                            <label><small>Bukan Robot kan..? masukan kode..</small></label>
                        </div>
                        <div class="input-group mt-2">
                            <input type="text" id="txtcaptcha" style="text-transform:uppercase" maxlength="6"
                                class="form-control" placeholder="Capthca" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="material-icons"><a href="<?= site_url('login')?>">loop</a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
                <div class="row mt-4">
                    <div class="col-12">
                        <button type="submit" id="btn_sigin" class="btn bg-dark btn-block">LOGIN</button>
                    </div>
                    <!-- <div class="col-8">
                        <div class="icheck-primary mt-2">
                            <input type="checkbox" id="remember">
                            <label for="remember">
                                Ingatkan Saya.
                            </label>
                        </div>
                    </div> -->
                </div>
            </form>
            <div class="social-auth-links text-center mb-3">
                <p>- JANGAN LUPA TERSENYUM -</p>
            </div>
            <!-- <p class="mb-1">
                <a href="<?= site_url('login/forgot')?>">Lupa password..?</a>
            </p>
            <p class="mb-0">
                <a href="<?= site_url('login/signup')?>" class="text-center">Daftar akun untuk login..</a>
            </p> -->
        </div>
    </div>
</div>