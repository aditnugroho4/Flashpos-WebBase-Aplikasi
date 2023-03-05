<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<script type="text/javascript">
String.prototype.replaceAll = function(str1, str2, ignore) {
    return this.replace(new RegExp(str1.replace(/([\/\,\!\\\^\$\{\}\[\]\(\)\.\*\+\?\|\<\>\-\&])/g, "\\$&"), (
        ignore ? "gi" : "g")), (typeof(str2) == "string") ? str2.replace(/\$/g, "$$$$") : str2);
};
var htmlx = '';
var selectedId;
var $date = "<?php echo R::isoDateTime(); ?>";
var $user = "<?php echo $role->id;?>";
var $role = "<?php echo $role->id;?>";
$(document).ready(function() {
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

});

function alert_info(title, label, message) {
    $(document).Toasts('create', {
        body: message,
        class: 'bg-info',
        title: title,
        subtitle: label,
        icon: 'fas fa-envelope fa-lg',
        autohide: true,
        delay: 1000
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
        delay: 1000
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
        delay: 1000
    });
};
</script>