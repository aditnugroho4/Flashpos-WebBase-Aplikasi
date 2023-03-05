<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<script>
'use strict'
var $limit = 5;
var $ctgr = 0;
$(window).on('load', function() {
    $('.artikel').find('.set-bg').each(function() {
        var bg = $(this).data('setbg');
        $(this).css('background-image', 'url(' + bg + ')');
    });
    $.load_ctgr_blog = function(limit, ctgr) {
        $_pagination_get(limit, ctgr);
    }
    $_pagination_get($limit, 'All');

    function $_pagination_get(limit, ctgr) {
        $('.list-artikel').append('<div class="loader" style="z-index:1000;"></div>');
        $('#pagination').pagination({
            dataSource: '<?=site_url('blog/json_load_data'); ?>?table=w_post_artikel&ctgr=' + ctgr,
            locator: 'data',
            pageSize: limit,
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
                    if (typeof(data) == 'object') {
                        $('.list-artikel').find('.loader').remove();
                    }
                }
            },
            callback: function(data, pagination) {
                $('.list-artikel').find('.loader').remove();
                var html = Templating(data);
                $('.list-blog').html(html);
                $('.list-blog').find('.set-bg').each(function() {
                    var bg = $(this).data('setbg');
                    $(this).attr('src', bg);
                });
            }
        });
    }

    function Templating(data) {
        var $html = "";
        for (var i = 0, len = data.length; i < len; i++) {
            $html += '<div class="col-md-6">' +
                '<div class="aside-widget">' +
                '<a class="post-img" href="<?=base_url('blog/detail')?>/' + data[i].seo.short_link
                .replaceAll(' ', '-').replaceAll('&', 'dan') +
                '">' +
                '<img class="lazyloaded set-bg" data-setbg="<?=base_url()?>' + data[i]
                .items
                .img + '"></a>' +
                '<div class="post-body">' +
                '<div class="post-category">' +
                '<a href="category.html">' + data[i].ctgr + '</a>' +
                '</div>' +
                '<h3 class="post-title"><a href="<?=base_url('blog/detail')?>/' + data[i].seo.short_link
                .replaceAll(' ', '-').replaceAll('&', 'dan') + '">' + data[i].items.judul + '</a></h3>' +
                '<ul class="post-meta">' +
                '<li><a href="author.html">' + data[i].user + '</a></li>' +
                '<li>' + data[i].items.date + '</li>' +
                '</ul>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>';
        }
        $html += '<div class="clearfix visible-md visible-lg"></div>';
        return $html;
    };
})
</script>