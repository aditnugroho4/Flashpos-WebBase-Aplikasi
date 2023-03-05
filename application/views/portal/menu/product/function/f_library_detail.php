<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<script src="<?=  base_url(); ?>asset/portal/plugins/pdfview/web/pdfobject.2.2.0.js"></script>
<script>
'use strict'
var $limit = 5;
var $ctgr = 0;
$(window).on('load', function() {
    $('.artikel').find('.set-bg').each(function() {
        var bg = $(this).data('setbg');
        $(this).css('background-image', 'url(' + bg + ')');
    });

    $('.loading-load').append(
        "<div class='loader'><span><i class='fa fa-spinner fa-spin'></i> Waiting from Load Dokument...</span></div>"
    );
    var myPDF;
    var files = "<?= $Seo['Perpus']['OneFile'];?>";
    var options = {
        width: "100%",
        height: "600px",
        pdfOpenParams: {
            view: 'FitV',
            pagemode: 'thumbs'
        },
        forcePDFJS: true,
        PDFJS_URL: "<?= base_url('asset/portal/plugins')?>/pdfview/web/viewer.html"
    };
    if (files != null) {

        var url = "<?= base_url()?>" + files;
        myPDF = PDFObject.embed(url, "#my_pdf_viewer", options);
        $("#my_pdf_viewer").find('iframe').attr('style', 'width:100%;height:600px;');
        $('.loading-load').find(".loader").remove();
    }

    $.load_file_lib = function($id) {
        $('.loading-load').append(
            "<div class='loader'><span><i class='fa fa-spinner fa-spin'></i> Waiting from Load Dokument...</span></div>"
        );
        $.ajax({
            url: "<?php echo site_url('elibrary/get_dokument');?>",
            type: 'post',
            enctype: 'multipart/form-data',
            dataType: 'json',
            data: {
                'id': $id
            },
            success: function(data) {
                var url = "<?= base_url()?>" + data.files;
                myPDF = PDFObject.embed(url, "#my_pdf_viewer", options);
                $("#my_pdf_viewer").find('iframe').attr('style', 'width:100%;height:600px;');
                $('.loading-load').find(".loader").remove();
            }
        });
    }
})
</script>