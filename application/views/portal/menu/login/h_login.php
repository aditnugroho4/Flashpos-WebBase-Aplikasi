<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<script>
'use strict'
String.prototype.replaceAll = function(str1, str2, ignore) {
    return this.replace(new RegExp(str1.replace(/([\/\,\!\\\^\$\{\}\[\]\(\)\.\*\+\?\|\<\>\-\&])/g, "\\$&"), (
        ignore ? "gi" : "g")), (typeof(str2) == "string") ? str2.replace(/\$/g, "$$$$") : str2);
};
$(window).on('load', function() {

    var date = "<?= R::isoDateTime(); ?>";
    var user = "<?= $user->id ?>";
    $(".frm-reg").hide();
    $.login_click = function() {
        $("#dlg-login").modal("show");
    }
    $('#sign_in').submit(function(e) {
        e.preventDefault();
        if ($('#sign_in').valid()) {
            $('.loading-signin').append(
                "<div class='overlay'><span><i class='fa fa-spinner fa-spin'></i> Waiting from Login...</span></div>"
            );
            var datalogin = {
                username: $("#l-email").val(),
                password: $.base64.encode($("#l-password").val())
            };
            $.ajax({
                type: "POST",
                dataType: 'json',
                url: "<?php echo base_url('login/member_auth');?>",
                data: datalogin,
                success: function(msg) {
                    if (msg.auth == false) {
                        alert(msg.message);
                        $('.loading-signin').find(".overlay").remove();
                        location.reload();
                    } else {
                        alert(msg.message);
                        $('.loading-signin').find(".overlay").remove();
                        location.reload();
                    }

                }
            });
        }

    });
    $('#sign_up').submit(function(e) {
        e.preventDefault();
        if ($('#sign_in').valid()) {
            $.ajax({
                type: "POST",
                dataType: 'json',
                url: "<?php echo base_url('login/member_singup');?>",
                data: {
                    first_name: $("#first_name").val(),
                    last_name: $("#last_name").val(),
                    email: $("#email").val(),
                    password: $.base64.encode($("#password").val()),
                    datetime: date,
                },
                success: function(msg) {
                    if (msg) {
                        alert(msg.message);
                    }
                    location.reload();
                }
            });
        }
    });
    $("#btn-frm-login").button().click(function() {
        $(".frm-login").show();
        $(".frm-reg").hide();
    });
    $("#lbl-regist").click(function() {
        $(".frm-login").hide();
        $(".frm-reg").show();
    });
});
</script>
<div id="dlg-login" tabindex="-1" data-backdrop="false" role="dialog" aria-hidden="true" class="modal fade">
    <div class="modal-dialog" role="document">
        <div class="modal-content loading-signin">
            <div class="modal-header">
                <h5 class="modal-title text-center">ISI BUKU TAMU</h5>
            </div>
            <div class="modal-body ">
                <div class="form-wrapper">
                    <div class="panel panel-skin ">
                        <div class="panel-heading">
                            <h3 class="panel-title"><span class="fa fa-pencil-square-o"></span> Masukan Data
                                <small> Untuk Mengunduh</small>
                            </h3>
                        </div>
                        <div class="panel-body">
                            <div class="frm-login">
                                <form id="sign_in" class="lead">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="email" id="l-email" class="form-control input-md" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>password</label>
                                                <input type="password" id="l-password" class="form-control input-md"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <button type="submit" value="Login" id="btn-login"
                                                class="btn btn-primary btn-skin btn-block"><i
                                                    class="fas fa-download"></i>
                                                Login</button>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group paddingtop-10 text-right">
                                                <span class="btn btn-flat btn-info btn-xs" id="lbl-regist"><i
                                                        class="fas fa-registered"> </i> Registrasi..
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="frm-reg">
                                <form id="sign_up" class="lead">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label>Nama Depan</label>
                                                <input type="text" id="first_name" class="form-control input-md"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label>Nama Belakang</label>
                                                <input type="text" id="last_name" class="form-control input-md"
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="email" name="email" id="email"
                                                    class="form-control input-md" required>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label>Buat Password</label>
                                                <input type="password" name="password" id="password"
                                                    class="form-control input-md" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="submit" id="btn-signin"
                                                class="btn btn-skin btn-block btn-lg">Daftar</button>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Langsung Login Jika Sudah Berlangganan..</label>
                                                <button type="button" id="btn-frm-login"
                                                    class="btn btn-skin btn-block btn-lg">Login <i
                                                        class="fas fa-angle-double-right"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>