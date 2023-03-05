<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<script type="text/javascript">
String.prototype.replaceAll = function(str1, str2, ignore) {
    return this.replace(new RegExp(str1.replace(/([\/\,\!\\\^\$\{\}\[\]\(\)\.\*\+\?\|\<\>\-\&])/g, "\\$&"), (
        ignore ? "gi" : "g")), (typeof(str2) == "string") ? str2.replace(/\$/g, "$$$$") : str2);
};
var htmlx = '';
var selectedId;
var eleFocus;
var $date = "<?php echo R::isoDateTime(); ?>";
var $user = "<?php echo $role->id;?>";
var $role = "<?php echo $role->id;?>";
$(document).ready(function() {
    $('.sidebar-mini').addClass('sidebar-collapse');
    if ($role == 1) {
        $('[data-toggle="#Inventory"]').addClass('menu-open');
    } else if ($role == 2) {
        $('[data-toggle="#Inventory"]').addClass('menu-open');
    } else {
        $('[data-toggle="#DataMaster"]').addClass('menu-open');
    }
    $('a[href="' + location + '"]').addClass('active');
    $(".btn-back").attr('href', location);

    $.get_menu = function($url) {
        $('.flex-column').find('.bg-brown').removeClass('bg-brown');
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

    $.format_text = function(element) {
        $(element).keyup(function(event) {
            if ($(this).val().length > 0) {
                if (!isNaN(Globalize.parseInt($(element).val()))) {
                    $(this).val(Globalize.format(Math.abs(Globalize.parseInt($(this).val())),
                        "c"));
                } else {
                    $(this).val('');
                    $(this).focus();
                }
            }
            return false;
        });
        $(element).click(function(event) {
            if ($(this).val().length > 0) {
                if (!isNaN(Globalize.parseInt($(element).val()))) {
                    $(this).val(Globalize.format(Math.abs(Globalize.parseInt($(this).val())),
                        "c"));
                } else {
                    $(this).val('');
                    $(this).focus();
                }
            }
            return false;
        });
    }

    $.alert_swal_info = function($info, $message, $alert) {
        Swal.fire({
            icon: $alert,
            title: $info,
            text: $message,
            confirmButtonText: "OK",
            focusConfirm: true
        })
    }
    $.auto_number = function($tables, $length, $tag) {
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "<?php echo site_url('admin/autonumber');?>",
            data: {
                tables: $tables,
                length: $length
            },
            success: function(msg) {
                $($tag).val(msg);
            }
        });
    }
    $.loop = function(tag) {
        var myArray = ["#07f6ff", "#ffff", "#212529"];
        setInterval(function() {
            var rand = myArray[Math.round(Math.random() * (myArray.length - 0))];
            //$(tag).attr("class", rand);
            $(tag).css("color", rand);
        }, 200);
        return;
    }
});
</script>