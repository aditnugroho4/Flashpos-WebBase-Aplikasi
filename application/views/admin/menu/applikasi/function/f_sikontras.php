<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<script type="text/javascript">
String.prototype.replaceAll = function(str1, str2, ignore) {
    return this.replace(new RegExp(str1.replace(/([\/\,\!\\\^\$\{\}\[\]\(\)\.\*\+\?\|\<\>\-\&])/g, "\\$&"), (
        ignore ? "gi" : "g")), (typeof(str2) == "string") ? str2.replace(/\$/g, "$$$$") : str2);
};
var selectedId;
var $date = "<?php echo R::isoDateTime(); ?>";
var $user = "<?php echo $user->id;?>";
var $foto =
    "<?php if(!$user->foto){echo (base_url('asset/images/user/avatar5.png'));}else {echo (base_url('asset/images/user/'.$user->foto));}?>";
var $role = "<?php echo $role->id;?>";
var $roleName = "<?= $role->name;?>";
var $userName = "<?= $user->nama;?>";
var $tables;
var $filds;
var $noAduan;
var $idAduan;
var $idAdmin;
var $idProsess;
var $idUnit = "<?= $unit['id'];?>";
$(document).ready(function() {
    if ($role == 1) {
        $('[data-toggle="#Aplikasi"]').addClass('menu-open');
    } else {
        $('[data-toggle="#MainMenu"]').addClass('menu-open');
    }
    $('a[href="' + location + '"]').addClass('active');

    $.get_menu = function($url) {
        $('.info-box').removeClass('bg-secondary');
        $('.card-loading').append(
            '<div class="overlay"><i class="fas fa-2x fa-sync-alt fa-spin"></i></div>'
        );
        $.ajax({
            type: "POST",
            dataType: 'html',
            data: {
                html: $url
            },
            url: "<?php echo site_url('admin/get_html_menu');?>",
            success: function(msg) {
                if (msg) {
                    $('.load-view-menu').html("");
                    $('.load-view-menu').html(msg);
                    $('.card-loading').find('.overlay').remove();
                } else {
                    $('.card-loading').find('.overlay').remove();
                    alert('Menu Belum Tersedia');
                }
            }
        });
    }
    $.queryLength = function(element, lbl) {
        $(element).keyup(function(event) {
            if (event.keyCode == 8 || event.keyCode == 48) {
                if ($(this).val().length > 0) {
                    var count = $(this).val().length;
                    $(lbl).html(count - 1);
                }
            } else {
                if ($(this).val().length > 0) {
                    var count = $(this).val().length;
                    $(lbl).html(count);
                }
            }
            return false;
        });
    }
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });

    $.swalDefaultAlert = function(label, icons) {
        Toast.fire({
            icon: icons,
            title: label
        })
    }

    function alert_info(title, label, message) {
        $(document).Toasts('create', {
            body: message,
            class: 'bg-info',
            title: title,
            subtitle: label,
            icon: 'fas fa-envelope fa-lg',
            autohide: true,
            delay: 750
        });
    };

    function alert_warning(title, label, message) {
        $(document).Toasts('create', {
            body: message,
            class: 'bg-warning',
            title: title,
            subtitle: label,
            icon: 'fas fa-envelope fa-lg',
            autohide: true,
            delay: 750
        });
    };

    function alert_success(title, label, message) {
        $(document).Toasts('create', {
            body: message,
            class: 'bg-success',
            title: title,
            subtitle: label,
            icon: 'fas fa-envelope fa-lg',
            autohide: true,
            delay: 750
        });
    };
});
</script>