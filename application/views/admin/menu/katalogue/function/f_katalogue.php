<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<script src="<?= base_url(); ?>asset/admin/plugins/globalize/cultures/globalize.culture.id-ID.js"></script>
<script type="text/javascript">
String.prototype.replaceAll = function(str1, str2, ignore) {
    return this.replace(new RegExp(str1.replace(/([\/\,\!\\\^\$\{\}\[\]\(\)\.\*\+\?\|\<\>\-\&])/g, "\\$&"), (
        ignore ? "gi" : "g")), (typeof(str2) == "string") ? str2.replace(/\$/g, "$$$$") : str2);
};
var htmlx = '';
var selectedId;
var eleFocus;
var $date = "<?php echo R::isoDateTime(); ?>";
var $User = "<?php echo $user->id;?>";
var $Role = "<?php echo $role->id;?>";
$(document).ready(function() {
    Globalize.culture("id-ID");
    if ($Role == 1) {
        $('[data-toggle="#Katalogue"]').addClass('menu-open');
    } else if ($Role == 2) {
        $('[data-toggle="#Applikasi"]').addClass('menu-open');
    } else {
        $('[data-toggle="#Applikasi"]').addClass('menu-open');
    }
    $('a[href="' + location + '"]').addClass('active');
    $(".btn-back").attr('href', location);
    get_jenis_items();
    $_pagination_get();
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

    function get_jenis_items() {
        $(".product-list").empty();
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "<?php echo site_url('admin/multi_select');?>?table=b_product_grup",
            success: function(data) {
                var html = "";
                for (var i = 0; i < data.length; i++) {
                    let images = "";
                    if (data[i].foto == null) {
                        images =
                            "<img style='height:70px;' class='img-thumbnail ml-2' src='<?= base_url('asset/images/product/no-img.png'); ?>' alt='Jenis Menu'>";
                    } else {
                        images =
                            "<img  style='height:70px;' class='img-thumbnail ml-2' src='<?= base_url('asset/images/product/kuliner'); ?>/" +
                            data[i].foto + "' alt='Jenis Menu' >";
                    }
                    $(".product-list").append('<div class="col-md-3 col-sm-6 col-12">' +
                        '<div class="info-box btn mn-1 btn-outline-secondary" onclick=""> ' +
                        '<span class="info-box-icon bg-brown">' + images + '</span>' +
                        '<div class="info-box-content">' +
                        '<span class="info-box-text"><b>' + data[i].nama + '</b></span>' +
                        '<span class="info-box-number"><?= R::count('b_product_item','grup_id=?',array('data[i].id'))?></span>' +
                        '</div>' +
                        '</div>' +
                        '</div>');
                }
            }
        });
    }

    function $_pagination_get() {
        $('#pagination').pagination({
            dataSource: '<?= site_url('admin/json_load_page'); ?>?table=b_product_paket',
            locator: 'data',
            pageSize: 5,
            pageRange: null,
            showPageNumbers: true,
            totalNumberLocator: function(response) {
                // you can return totalNumber by analyzing response content
                if (response) {
                    return Math.floor(response.total);
                }

            },
            ajax: {
                beforeSend: function(data) {
                    $('.load__overlay').append(
                        '<div class="overlay"><i class="fas fa-2x fa-sync-alt fa-spin"></i></div>'
                    );
                }
            },
            callback: function(data, pagination) {
                var html = Templating(data);
                $('#paket-list_1').html(html);
                var pagebar = $('#pagination');
                pagebar.find('.paginationjs-pages').attr('class', 'card-tools float-right');
                pagebar.find('ul').addClass('pagination pagination-sm');
                pagebar.find('li').addClass('page-item');
                pagebar.find('a').addClass('page-link');
                $('.load__overlay').find('.overlay').remove();

            }
        });
    };

    function Templating(data) {
        var $html = '';
        var status = '';
        for (var i = 0, len = data.length; i < len; i++) {
            if (data[i].items.status == null) {
                if (data[i].items.status == null) {
                    status =
                        '<small> <span class="btn btn-xs bg-info bg-gradient"><i class="far fa-clock"></i> Lihat</span></small>';
                }
                if (data[i].items.status == 'C') {
                    status =
                        '<small><span class="btn btn-xs bg-red bg-gradient"><i class="far fa-calendar-times"></i> Lihat</span></small>';
                }
                $html += '<li>' +
                    '<div class="row">' +
                    '<div class="col-xs-12 col-md-6">' +
                    '<i class="fas fa-ellipsis-v"></i>' +
                    '<i class="fas fa-ellipsis-v"></i>' +
                    '<span class="text">' +
                    data[i].items.nama + ' (' + data[i].items.deskripsi + ') Harga Paket Rp.' + data[i].items
                    .price + '</span>' +
                    '</div>' +
                    '<div class="col-xs-12 col-md-6">' +
                    '<span class="float-right" onclick="$.view_status(' +
                    data[i].items.id +
                    ');">' + status +
                    '</span></div></div>' +
                    '</li>';
            }
        }
        return $html;
    };
});
</script>