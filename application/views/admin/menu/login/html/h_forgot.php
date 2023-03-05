<?php if ( ! defined( 'BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view('admin/menu/login/function/f_forgot');?>
<div class="login-box">
    <div class="login-logo">
        <a href="<?= site_url('login')?>"><b>Admin</b>Dashboard</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Anda lupa password.? Masukan alamat email anda yang terdaftar.</p>

            <form action="<?= site_url('login')?>" method="post">
                <div class="input-group mb-3">
                    <input type="email" class="form-control" placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Request password baru</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <p class="mt-3 mb-1">
                <a href="<?= base_url('login');?>">Kembali Login</a>
            </p>
            <p class="mb-0">
                <a href="<?= base_url('login/signup');?>" class="text-center">Daftar akun baru..</a>
            </p>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>