<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<script>
'use strict'
var start = 0;
var limit = 4;
var action = 'none';
$(window).on('load', function() {
    var control = $("#filters-container"),
        wrap, filtersCallback;
    var gallery = $("#grid-container");

    $.pagination_get = function($start, $limit) {
        $_load_dokter($start, $limit);
    }

    $_load_dokter(start, limit);

    function $_load_dokter($start, $limit) {
        $('.lib-loading').append(
            "<div class='loading-elibrary'><i class='fa fa-spinner fa-spin'></i> Loading from data Dokter...</div>"
        );
        $('.load__more').empty();
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "<?= site_url('home/json_load_dokter');?>",
            data: {
                start: $start,
                limit: $limit
            },
            success: function(msg) {
                var html = "";
                if (msg.dokter) {
                    gallery.find('ul').empty();
                    for (var a = 0; a < msg.data.length; a++) {
                        for (var i = 0; i < msg.dokter.length; i++) {
                            if (msg.data[a].name == msg.dokter[i].kategory) {
                                var img = "<?= base_url("asset/images/dokter")?>/preview.png";
                                if (msg.dokter[i].foto) {
                                    img = "<?= base_url("asset/images/dokter")?>/" + msg.dokter[i]
                                        .foto;
                                }
                                html += '<li class="cbp-item dokter' + msg.data[a].css + '">' +
                                    '<a href="' + img + '" class="cbp-caption cbp-lightbox">' +
                                    '<div class="cbp-caption-defaultWrap">' +
                                    '<img class="lazyload" src="' + img + '" alt="' + msg.dokter[i]
                                    .keterangan +
                                    '(' + msg.dokter[i].nama_dokter +
                                    ')" width="100%" height="198">' +
                                    '</div>' +
                                    '<div class="cbp-caption-activeWrap">' +
                                    '<div class="cbp-l-caption-alignCenter">' +
                                    '<div class="cbp-l-caption-body">' +
                                    '<div class="cbp-l-caption-text">VIEW PROFILE</div>' +
                                    '</div>' +
                                    '</div>' +
                                    '</div>' +
                                    '</a>' +
                                    '<a href="<?= base_url("home/get_profile_dokter")."?id="; ?>' +
                                    msg.dokter[i].id +
                                    '" class="cbp-singlePage cbp-l-grid-team-name">' +
                                    msg.dokter[i].nama_dokter + '</a>' +
                                    '<div class="cbp-l-grid-team-position">' + msg.dokter[i]
                                    .keterangan + '</div>' +
                                    '</li>';
                            }
                        }
                    }
                }

                if (control.length > 0) {
                    control.empty();
                    control.append(
                        '<div data-filter="*" class="cbp-filter-item-active cbp-filter-item">All (<div class="cbp-filter-counter"></div>)</div>'
                    );
                    for (var i = 0; i < msg.data.length; i++) {
                        control.append('<div data-filter=".dokter' + msg.data[i].css +
                            '" class="cbp-filter-item">' + msg.data[i].name +
                            ' (<div class="cbp-filter-counter"></div>)</div>');
                    }
                }
                $('.lib-loading').find(".loading-elibrary").remove();
                gallery.find('ul').append(html);
                $('.load__more').append(msg.more);
                gallery.cubeportfolio('destroy');
                gallery.cubeportfolio('init', 'appendItems', html);
                gallery.cubeportfolio('showCounter', control.find(
                    '.cbp-filter-item'));

                control.find("[data-filter='*']").click();
                return;
            }
        });

    };
});
</script>