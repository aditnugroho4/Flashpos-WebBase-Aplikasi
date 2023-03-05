<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<script type="text/javascript">
String.prototype.replaceAll = function(str1, str2, ignore) {
    return this.replace(new RegExp(str1.replace(/([\/\,\!\\\^\$\{\}\[\]\(\)\.\*\+\?\|\<\>\-\&])/g, "\\$&"), (
        ignore ? "gi" : "g")), (typeof(str2) == "string") ? str2.replace(/\$/g, "$$$$") : str2);
};
var htmlx = '';
var selectedId;
var active;
var tbls;
var filds;
var seoId;
var fildeselect;
var tables;
var Edit = false;
$(document).ready(function() {
    var $role = "<?php echo $role->id;?>";
    if ($role == 1) {
        $('[data-toggle="#Datamaster"]').addClass('menu-open');
    } else {
        $('[data-toggle="#MainMenu"]').addClass('menu-open');
    }
    $('a[href="' + location + '"]').addClass('active');

    $(".btn-back").attr('href', location);

    $.get_menu = function($url) {
        $('.flex-column').find('.bg-yellow').removeClass('bg-yellow');
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
    // Function CRUD //
    $('#btnChange').button().click(function() {
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "<?php echo site_url('admin/aktive'); ?>/" + tbls + "/" + filds + "/" +
                selectedId + "/" +
                active,
            success: function(data) {
                $.swalDefaultAlert("error: " + data.error + "<br> Code: " + data.code +
                    " <br> message: " + data.message, 'success');
                $("#tblData").dataTable().fnDraw();
                $("#dlgAlert").modal("hide");
            }
        });
    });
    // alert //
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
    /* END */
});

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
</script>