<?php if ( ! defined( 'BASEPATH')) exit(
'No direct script access allowed'); ?>
<script>
String.prototype.replaceAll = function(str1, str2, ignore) {
    return this.replace(new RegExp(str1.replace(/([\/\,\!\\\^\$\{\}\[\]\(\)\.\*\+\?\|\<\>\-\&])/g, "\\$&"), (
        ignore ? "gi" : "g")), (typeof(str2) == "string") ? str2.replace(/\$/g, "$$$$") : str2);
};
var eleCaptcha = false;
var ipKomputer;
var OSName = "Unknown OS";
var HDInfo = "Unknown Iformation";
var Device = "No Detect";
var d = new Date();
$(document).ready(function() {
    load_computer_information();
    // $("#Capthca").find("img").addClass("img");
    $('#sign_in').submit(function(e) {
        e.preventDefault();
        if ($("#txtPassword").val().length > 0) {
            $('.loading').append(
                '<div class="overlay text-center"><i class="fas fa-2x fa-sync-alt fa-spin"></i></div>'
            );
            if ($('#sign_in').valid()) {
                $.ajax({
                    type: "POST",
                    dataType: 'json',
                    url: "<?= site_url('login/auth');?>",
                    data: {
                        username: $("#txtUsername").val(),
                        password: $.base64.encode($("#txtPassword").val()),
                        ipaddress: ipKomputer,
                    },
                    success: function(msg) {
                        //debugger;
                        if (msg.auth == false) {
                            $('#btn_sigin').attr('disabled', 'disabled');
                            window.location.reload('admin');
                        } else if (msg.auth == true) {
                            $('.loading').find('.overlay').remove();
                            $.alert_swal('Login', msg.message, 'warning');
                        }
                    }
                });
            }
        } else {
            $("#txtPassword").focus();
            $.alert_swal('Password', 'Password Masih Kosong', 'warning');
        }
    });
    $("#txtPassword").keydown(function(event) {
        if (event.which == 13) {
            if ($(this).val().length > 0) {
                eleCaptcha = true;
                $('#sign_in').submit().click();
            } else {
                $("#txtPassword").focus();
            }
        }
    });
    // $("#txtcaptcha").keyup(function() {
    //     if ($("#txtcaptcha").val().length >= 6) {
    //         $("#txtcaptcha").attr('disabled', 'disabled');
    //         $.ajax({
    //             type: "POST",
    //             dataType: 'json',
    //             url: "<?php echo site_url('login/cek_captcha');?>?id=" + $(this).val(),
    //             success: function(msg) {
    //                 if (msg.error == true) {
    //                     eleCaptcha = false;
    //                     $.alert_swal('Captcha', msg
    //                         .message, 'warning');
    //                 } else if (msg.error == false) {
    //                     eleCaptcha = true;
    //                     $('#sign_in').submit().click();
    //                 }
    //             }
    //         });
    //     }
    // });
    $.alert_swal = function($info, $message, $alert) {
        Swal.fire({
            icon: $alert,
            title: $info,
            text: $message,
            confirmButtonText: "OK",
            focusConfirm: true
        }).then((result) => {
            if (result.value) {
                window.location.reload('login');
                load_computer_information();
            }
        })
    }

    function load_computer_information($ip) {
        try {
            if (navigator.appVersion.indexOf("Win") != -1) OSName = "Windows";
            else if (navigator.appVersion.indexOf("Mac") != -1) OSName = "MacOS";
            else if (navigator.appVersion.indexOf("X11") != -1) OSName = "UNIX";
            else if (navigator.appVersion.indexOf("Linux") != -1) OSName = "Linux";
            HDInfo = OSName + " " + navigator.platform;
            // console.log(HDInfo);
        } catch (e) {
            // console.log(HDInfo);
            HDInfo = ('Permission to access computer name is denied');
        }
        sys_security(Device, HDInfo);
    }

    function sys_security($ipaddress, $devices, $OSName) {
        var date = "<?php echo R::isoDateTime(); ?>";
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "<?php echo site_url('home/sys_user_monitoring/n_web_monitoring'); ?>",
            data: {
                devices: $devices,
                os: $OSName,
                upd_time: d.getHours() + ":" + d.getMinutes() + ":" + d.getSeconds(),
                tanggal: date.substring(0, 10),
            },
            success: function(msg) {
                ipKomputer = msg.ipAddress;
            }
        });
    }
});
</script>