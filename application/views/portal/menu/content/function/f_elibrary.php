<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<script>
var $limit = 8;
var $ctgr = 0;
var Kategory = null;
$(window).on('load', function() {
    $('.navbar-nav ul').find('li .active').removeAttr('class', 'active');
    $('.navbar-nav li').find('.mn-3').addClass('active');

    var date = "<?= R::isoDateTime(); ?>";
    var user = "<?= $user->id ?>";

    var gridContainer = $('#grid-container'),
        filtersContainer = $('#filters-container');

    $_pagination_get($limit, 'All');

    function $_pagination_get(limit, ctgr) {
        $('.lib-loading').append(
            "<div class='loading-elibrary'><i class='fa fa-spinner fa-spin'></i> Loading from data e-library...</div>"
        );
        $('#pagination').pagination({
            dataSource: '<?=site_url('elibrary/json_load_data'); ?>?table=w_post_elibrary',
            locator: 'data.items',
            pageSize: limit,
            pageRange: null,
            showPageNumbers: true,
            totalNumberLocator: function(response) {
                if (response) {
                    Kategory = response.data.ctgr;
                    return Math.floor(response.total);
                }
            },
            ajax: {
                beforeSend: function(data) {}
            },
            callback: function(data, pagination) {
                var html = Templating(data);
                gridContainer.html(html);
            }
        });
    }

    function Templating(msg) {
        var html = "";
        if (msg) {
            gridContainer.find('ul').empty();
            for (var a = 0; a < Kategory.length; a++) {
                for (var i = 0; i < msg.length; i++) {
                    if (Kategory[a].id == msg[i].data.ctgr_id) {
                        var img = "<?= base_url("asset/images/product/brosur")?>/difteri-1.png";
                        if (msg[i].data.foto) {
                            img = "<?= base_url("asset/images/thumbnail")?>/" + msg[i].data.foto;
                        }
                        html += '<li class="cbp-item ctgr-' + Kategory[a].id + '">' +
                            '<a href="' + img + '" class="cbp-caption cbp-lightbox">' +
                            '<div class="cbp-caption-defaultWrap">' +
                            '<img src="' + img + '" alt="' + msg[i].data.judul + '" width="100%">' +
                            '</div>' +
                            '<div class="cbp-caption-activeWrap">' +
                            '<div class="cbp-l-caption-alignCenter">' +
                            '<div class="cbp-l-caption-body">' +
                            '<div class="cbp-l-caption-text">' + msg[i].data.judul + '</div>' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '</a>' +
                            '<a href="#" class="cbp-singlePage cbp-l-grid-team-name">' + msg[
                                i].data.nama + '</a>' +
                            '<div class="cbp-l-grid-team-position">' + Kategory[a].nama + '</div>' +
                            '<div class="cbp-l-grid-team-button"><button type="button" class="btn btn-warning btn-xs"><i class="fas fa-comment"></i></button><button type="button" class="btn btn-primary btn-xs" onclick="$.get_data_file(\'' +
                            msg[i].data.slug +
                            '\');"><i class="fas fa-download"></i>Unduh</button></div>' +
                            '</li>';
                    }
                }

            }

        }
        if (filtersContainer.length > 0) {
            filtersContainer.empty();
            filtersContainer.append(
                '<div data-filter="*" class="cbp-filter-item-active cbp-filter-item">All (<div class="cbp-filter-counter"></div>)</div>'
            );
            for (var i = 0; i < Kategory.length; i++) {
                filtersContainer.append('<div data-filter=".ctgr-' + Kategory[i].id +
                    '" class="cbp-filter-item">' + Kategory[i].nama +
                    ' (<div class="cbp-filter-counter"></div>)</div>');
            }
        }
        $('.lib-loading').find(".loading-elibrary").remove();
        gridContainer.cubeportfolio('destroy');
        gridContainer.find('ul').append(html);
        gridContainer.cubeportfolio('init', 'appendItems', html);

        gridContainer.cubeportfolio('showCounter', filtersContainer.find('.cbp-filter-item'));

        filtersContainer.find("[data-filter='*']").click();
        return;
    }

    $.get_data_file = function($id) {
        var session = user;
        if (session == 0) {
            $("#dlg-login").modal("show");
        } else {
            window.location.href = "<?= base_url('elibrary/detail');?>/" + $id;
        }
    };

});
</script>