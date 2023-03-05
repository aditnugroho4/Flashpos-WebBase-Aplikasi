<?php if ( ! defined( 'BASEPATH')) exit(
'No direct script access allowed'); ?>
<script>
String.prototype.replaceAll = function(str1, str2, ignore) {
    return this.replace(new RegExp(str1.replace(/([\/\,\!\\\^\$\{\}\[\]\(\)\.\*\+\?\|\<\>\-\&])/g, "\\$&"), (
        ignore ? "gi" : "g")), (typeof(str2) == "string") ? str2.replace(/\$/g, "$$$$") : str2);
};
$(document).ready(function() {
    $('#verif').submit(function(e) {
        e.preventDefault();
        if ($('#txtnip').val().length < 7) {
            $.alert_info('User Verifikasi', 'Harus Lebih 7 Digit', 'warning');
        } else {
            $('.loading').append(
                '<div class="overlay text-center"><i class="fas fa-2x fa-sync-alt fa-spin"></i></div>'
            );
            if ($('#verif').valid()) {
                $.ajax({
                    type: "POST",
                    dataType: 'json',
                    url: "<?php echo site_url('login/verif_to');?>",
                    data: {
                        id: "<?= $user->id ?>",
                        nip: $.base64.encode($("#txtnip").val()),
                        token: "<?= $_GET['token']?>"
                    },
                    success: function(msg) {
                        //debugger;
                        if (msg.error == false) {
                            $.alert_success('User Verifikasi', msg.message, 'success');
                            $('#verif')[0].reset();
                            window.location.replace("<?= base_url('admin');?>");
                        } else if (msg.error == true) {
                            $('.loading').find('.overlay').remove();
                            $.alert_info('User Verifikasi', msg.message, 'warning');
                        }
                    }
                });
            }
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
                window.location.replace("<?= base_url();?>");
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