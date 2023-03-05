<?php if ( ! defined( 'BASEPATH')) exit(
'No direct script access allowed'); ?>
<script>
String.prototype.replaceAll = function(str1, str2, ignore) {
    return this.replace(new RegExp(str1.replace(/([\/\,\!\\\^\$\{\}\[\]\(\)\.\*\+\?\|\<\>\-\&])/g, "\\$&"), (
        ignore ? "gi" : "g")), (typeof(str2) == "string") ? str2.replace(/\$/g, "$$$$") : str2);
};
var eleFocus;
$(document).ready(function() {
    $('#signup_registrasi').submit(function(e) {
        e.preventDefault();
        if ($('#tPass').val().length < 8 || $('#tRePass').val().length < 8) {
            eleFocus = '#tPass';
            $.alert_info('Daftar User', 'Password Harus 8 Digit', 'warning');
        } else if ($('#tPass').val() == $('#tRePass').val()) {
            $('.loading').append(
                '<div class="overlay text-center"><i class="fas fa-2x fa-sync-alt fa-spin"></i></div>'
            );
            if ($('#signup_registrasi').valid()) {
                $.ajax({
                    type: "POST",
                    dataType: 'json',
                    url: "<?php echo site_url('login/signup_to');?>",
                    data: $(this).serialize(),
                    success: function(msg) {
                        //debugger;
                        if (msg.error == false) {
                            $.alert_success('Daftar User', msg.message, 'success');
                            $('#signup_registrasi')[0].reset();
                        } else if (msg.error == true) {
                            $.alert_info('Daftar User', msg.message, 'warning');
                            $('.loading').find('.overlay').remove();
                        }
                    }
                });
            }
        } else {
            $.alert_info('Daftar User', 'Mengulang Password Tidak Sama..', 'warning');
            $('#tRePass').focus();
        }
    });
    $.alert_question = function($info, $message, $alert) {
        Swal.fire({
            icon: $alert,
            title: $info,
            text: $message,
            confirmButtonText: "OK",
            focusConfirm: true
        }).then((result) => {
            if (result.value) {
                window.location.reload();
            }
        })
    }
    $.alert_info = function($info, $message, $alert) {
        Swal.fire({
            icon: $alert,
            title: $info,
            text: $message,
            confirmButtonText: "OK",
            focusConfirm: true
        }).then((result) => {
            if (result.value) {
                $(eleFocus).focus();
            }
        })
    }
    $.alert_success = function($info, $message, $alert) {
        Swal.fire({
            icon: $alert,
            title: $info,
            text: $message,
            confirmButtonText: "OK",
            focusConfirm: true
        }).then((result) => {
            if (result.value) {
                location.reload('login');
            }
        })
    }
});
</script>