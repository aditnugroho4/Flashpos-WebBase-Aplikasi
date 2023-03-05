<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<script>
String.prototype.replaceAll = function(str1, str2, ignore) {
    return this.replace(new RegExp(str1.replace(/([\/\,\!\\\^\$\{\}\[\]\(\)\.\*\+\?\|\<\>\-\&])/g, "\\$&"), (
        ignore ? "gi" : "g")), (typeof(str2) == "string") ? str2.replace(/\$/g, "$$$$") : str2);
};
var selectedId;
var fildeselect;
var active;
var parsing = null;
var $path = null;
var dokterId;
var Content = '';
var Status;
Dropzone.autoDiscover = false;
$(document).ready(function() {
    $('.mn-5').addClass('bg-green');

    $('.sidebar-mini').addClass('sidebar-collapse');

    $('.dropify').dropify({
        messages: {
            default: 'Kembali Ke asal..',
            replace: 'Ganti file Atau Gambar',
            remove: 'Hapus',
            error: 'Ada Kesalahan Saat Upload File atau gambar..!'
        }
    });
    $("#txtDateSIP").datepicker({
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        maxDate: '2018',
        minDate: '@minDate',
        dateFormat: "yy-mm-dd",
        onSelect: function(date) {
            var day1 = $(this).datepicker('getDate').getDate();
            var months = ["January", "February", "Maret", "April", "May", "Juni",
                "Juli", "Augustus", "September", "October", "November", "December"
            ];
            var month1 = months[$(this).datepicker('getDate').getMonth()];
            var year1 = $(this).datepicker('getDate').getFullYear();
            $(this).val(day1 + ' ' + month1 + ' ' + year1);
        }
    });
    $("#txtAddDateSIP").datepicker({
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        maxDate: '2018',
        minDate: '@minDate',
        dateFormat: "yy-mm-dd",
        onSelect: function(date) {
            var day1 = $(this).datepicker('getDate').getDate();
            var months = ["January", "February", "Maret", "April", "May", "Juni",
                "Juli", "Augustus", "September", "October", "November", "December"
            ];
            var month1 = months[$(this).datepicker('getDate').getMonth()];
            var year1 = $(this).datepicker('getDate').getFullYear();
            $(this).val(day1 + ' ' + month1 + ' ' + year1);
        }
    });
    $('.bootstrap-tagsinput').addClass('form-control');
    $('.bootstrap-tagsinput').css({
        'min-height': '80px',
        'height': 'auto'
    });

    $_pagination_get();

    function $_pagination_get() {
        $('#pagination').pagination({
            dataSource: '<?= site_url('admin/json_load_data');?>?table=m_dokter',
            locator: 'data',
            pageSize: 6,
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
                    $('.list__dokter').empty();
                    $('.load__overlay').append(
                        '<div class="overlay"><i class="fas fa-2x fa-sync-alt fa-spin"></i></div>'
                    );
                }
            },
            callback: function(data, pagination) {
                $('.load__overlay').find('.overlay').remove();
                var html = Templating(data);
                $('.list__dokter').html(html);
                var pagebar = $('#pagination');
                pagebar.find('.paginationjs-pages').attr('class', 'paginationjs-pages float-right');

            }
        });
    }
    $.edit_profile = function($id) {
        $('#btn-edit-content').show();
        $("#btn-simpan-content").hide();
        var detailElement = $("#detail_profile");

        if (CKEDITOR.instances['txtContent']) {
            CKEDITOR.instances['txtContent'].getData('');
            CKEDITOR.instances['txtContent'].setReadOnly(false);
            CKEDITOR.instances['txtContent'].destroy();
        }
        $('.load__overlay').append(
            '<div class="overlay"><i class="fas fa-2x fa-sync-alt fa-spin"></i></div>'
        );
        try {
            $.ajax({
                type: "POST",
                dataType: 'json',
                url: "<?php echo site_url('admin/multi_select');?>?table=m_dokter&select=id&id=" +
                    $id,
                success: function(data) {
                    if (data != "") {
                        $('.load__overlay').find('.overlay').remove();
                        $("#data_profile").hide();
                        $("#detail_profile").show();
                        CKEDITOR.replace('txtContent', {
                            "height": '600px',
                            "extraPlugins": 'imagebrowser',
                            "imageBrowser_listUrl": "<?php echo site_url('admin/get_images_list');?>?table=w_post_images"
                        });
                        var img = "<?= base_url('asset/images/dokter/preview.png') ?>";
                        for (var i = 0; i < data.length; i++) {
                            if (data[i].foto == null || data[i].foto == "") {
                                detailElement.find(".profile-dr-img").attr('src', img);
                            } else {
                                img = "<?= base_url('asset/images/dokter') ?>/" + data[i].foto;
                                detailElement.find(".profile-dr-img").attr('src', img);
                            }
                            detailElement.find('.profile-dr-sts').empty();
                            if (data[i].status == null || data[i].status == "N") {
                                detailElement.find('.profile-dr-sts').append(
                                    "<span class='badge badge-warning'>Tidak Aktive</span>");
                            } else {
                                detailElement.find('.profile-dr-sts').append(
                                    "<span class='badge badge-success'> Aktive</span>");
                            }
                            if (data[i].link_id != null) {
                                $.get_seo(data[i].link_id);
                            }
                            detailElement.find(".profile-dr-name").html(data[i].nama_dokter);
                            detailElement.find(".prof1").html(data[i].kategory);
                            detailElement.find(".prof2").html(data[i].keterangan);
                            detailElement.find(".prof3").html(data[i].alamat);
                            dokterId = $.base64.encode(data[i].id);
                            detailElement.find("#txtNipDr").val(data[i].nip);
                            detailElement.find("#txtNama").val(data[i].nama_dokter);
                            detailElement.find("#txtKeterangan").val(data[i].keterangan);
                            detailElement.find("#txtAlamat").val(data[i].alamat);
                            detailElement.find("#txtTelpon").val(data[i].phone);
                            detailElement.find("#txtEmail").val(data[i].email);
                            detailElement.find("#cmbCtgr").val(data[i].kategory);
                            detailElement.find("#txtSIP").val(data[i].sip);
                            detailElement.find("#txtDateSIP").val(data[i].sip_date);
                            $(".lbl-edit-header").html(data[i].keterangan);
                            if (data[i].status == null || data[i].status == 'N') {
                                $('#Switch__Status').bootstrapSwitch('state', false);
                            } else if (data[i].status == "Y") {
                                $('#Switch__Status').bootstrapSwitch('state', true);
                            }
                            Content = data[i].content;
                            selectedId = data[i].id;
                            linkId = data[i].link_id;
                            $.get_poli(data[i].poli_id);
                        }
                    } else {
                        $('.load__overlay').find('.overlay').remove();
                    }
                }
            });
        } catch (ex) {
            alert(ex);
        }
    }

    $('#Switch__Status').on('switchChange.bootstrapSwitch', function() {
        if ($(this).prop('checked') == true) {
            Status = "Y";
            alert("Status Dokter Aktif..!");
        } else {
            Status = "N";
            alert("Status Dokter Non Aktif..!");
        }
    });
    $("#btn-edit-content").button().click(function() {
        if (CKEDITOR.instances['txtContent']) {
            CKEDITOR.instances['txtContent'].getData('');
            CKEDITOR.instances['txtContent'].insertHtml(
                Content);
        }
        $('#btn-simpan-content').show();
        $(this).hide();
    });
    $.get_seo = function($id) {
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "<?php echo site_url('admin/multi_select');?>?table=m_seo&select=id&id=" +
                $id,
            success: function(data) {
                if (data) {
                    $("#txtImg_e").val(data[0].icon);
                    $("#txtAuthor_e").val(data[0].author);
                    $("#txtKeyword_e").tagsinput('removeAll');
                    $("#txtKeyword_e").tagsinput('add', data[0].keyword);
                    $("#txtDeskripsi_e").val(data[0].deskripsi);
                    $("#txtTitle_e").val(data[0].title);
                }
            }
        });
    }
    $.get_poli = function($id) {
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "<?= site_url('admin/multi_select');?>?table=m_poli",
            success: function(data) {
                $('#cmbPoli').empty();
                $('#cmbPoli').append(
                    '<option value="">--- Tempat Layanan --- </option>');
                for (var i = 0; i < data.length; i++) {
                    $('#cmbPoli').append("<option value='" + data[i].id + "'>" +
                        data[i].nama + "</option>");
                }
                if ($id != false) {
                    $("#cmbPoli").val($id);
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
    $('#txtKeyword_e').tagsinput({
        'tagClass': 'badge bg-info',
        'maxChars': 500,
        'minChars': 2
    });
    $("#btnReload").button().click(function() {
        $("#detail_profile").hide();
        $("#data_profile").show();
        $_pagination_get();
    });
    $('#btn-Edit-batal').button().click(function() {
        $("#detail_profile").hide();
        $("#data_profile").show();
        if (CKEDITOR.instances['txtArtikel']) {
            CKEDITOR.instances['txtArtikel'].getData('');
            CKEDITOR.instances['txtArtikel'].setReadOnly(false);
            CKEDITOR.instances['txtArtikel'].destroy();
        }
    });
    $("#btn-reset").button().click(function() {
        $("#detail_profile").hide();
        $("#data_profile").show();
        if (CKEDITOR.instances['txtArtikel']) {
            CKEDITOR.instances['txtArtikel'].getData('');
            CKEDITOR.instances['txtArtikel'].setReadOnly(false);
            CKEDITOR.instances['txtArtikel'].destroy();
        }
    });
    $('#btnAdd').button().click(function() {
        $("#frm-add").modal("show");
    });
    $('#btn-prosess').button().click(function() {
        $.ajax({
            url: "<?php echo site_url('admin/aktive/w_post_images'); ?>/" +
                fildeselect +
                "/" +
                selectedId + "/" + active,
            success: function(data) {
                $("#dlg-edit-status").modal("hide");
                $("#tblData").dataTable().fnDraw();
            }
        });
    });
    $('.edit-foto-profile').button().click(function() {
        $("#frm-edit-foto").modal("show");
    });
    $('#edit-foto-prof').submit(function(e) {
        e.preventDefault();
        if ($('#edit-foto-prof').valid()) {
            $('.loading-foto').append(
                '<div class="overlay"><i class="fas fa-2x fa-sync-alt fa-spin"></i></div>'
            );
            var confiq = {
                id: dokterId,
                sizeH: 190,
                sizeW: 190,
                tbL: "m_dokter",
                path: "asset-images-dokter"
            };
            var fd = new FormData(document.getElementById("edit-foto-prof"));
            var parsing = $.base64.encode(JSON.stringify(confiq));
            parsing = parsing.replaceAll(".", "^");
            parsing = parsing.replaceAll("+", "-");
            parsing = parsing.replaceAll("/", "_");
            $.ajax({
                url: "<?php echo site_url('admin/edit_upload_foto');?>?data=" +
                    parsing,
                type: "post",
                data: fd,
                dataType: 'json',
                processData: false,
                contentType: false,
                cache: false,
                async: false,
                success: function(data) {
                    if (data.error == false) {
                        $('.dropify-clear').click();
                        $("#edit-foto-prof")[0].reset();
                        $('.loading-foto').find('.overlay').remove();
                        $("#frm-edit-foto").modal("hide");
                        $.edit_profile($.base64.decode(dokterId));
                    } else {
                        $('.dropify-clear').click();
                        $('.loading-foto').find('.overlay').remove();
                        $("#edit-foto-prof")[0].reset();
                    }
                }
            });
        }
    });
    $('#add-data-dokter').submit(function(e) {
        e.preventDefault();
        if ($('#add-data-dokter').valid()) {
            $('.load-add-prof').append(
                '<div class="overlay"><i class="fas fa-2x fa-sync-alt fa-spin"></i></div>'
            );
            $.ajax({
                url: "<?php echo site_url('admin/create/m_dokter');?>",
                type: "post",
                dataType: "JSON",
                data: {
                    nip: $("#txtAddKode").val(),
                    nama_dokter: $("#txtAddNama").val(),
                    kategory: $("#cmbAddCtgr option:selected").val(),
                    keterangan: $("#txtAddKeterangan").val(),
                    alamat: $("#txtAddAlamat").val(),
                    phone: $("#txtAddTelpon").val(),
                    email: $("#txtAddEmail").val(),
                    sip: $("#txtAddSIP").val(),
                    sip_date: $("#txtAddDateSIP").val(),
                    tgl_update: $date,
                },
                success: function(data) {
                    if (data.error == false) {
                        $('.load-add-prof').find('.overlay').remove();
                        var title = "Profile Dokter";
                        var label = "Tambah Data Dokter";
                        var message = data.message;
                        $("#add-data-dokter")[0].reset();
                        alert_success(title, label, message);
                        $.edit_profile(data.id);

                    } else {
                        $('.load-add-prof').find('.overlay').remove();
                        var title = "Profile Dokter";
                        var label = "Tambah Data Dokter";
                        var message = data.message;
                        alert_alert(title, label, message);
                    }
                }
            });
        }
    });
    $('#edit-data-prof').submit(function(e) {
        e.preventDefault();
        if ($('#edit-data-prof').valid()) {
            $('.load-prof').append(
                '<div class="overlay"><i class="fas fa-2x fa-sync-alt fa-spin"></i></div>'
            );
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('admin/update/m_dokter'); ?>",
                dataType: "JSON",
                data: {
                    id: $.base64.decode(dokterId),
                    nip: $("#txtNipDr").val(),
                    nama_dokter: $("#txtNama").val(),
                    kategory: $("#cmbCtgr option:selected").val(),
                    poli_id: $("#cmbPoli option:selected").val(),
                    keterangan: $("#txtKeterangan").val(),
                    sip: $("#txtSIP").val(),
                    sip_date: $("#txtDateSIP").val(),
                    alamat: $("#txtAlamat").val(),
                    phone: $("#txtTelpon").val(),
                    email: $("#txtEmail").val(),
                    status: Status,
                    tgl_update: $date,
                },
                success: function(data) {
                    if (data.error == false) {
                        $('.load-prof').find('.overlay').remove();
                        var title = "Profile Dokter";
                        var label = "Edit Data Dokter";
                        var message = data.message;
                        alert_success(title, label, message);
                        $.edit_profile(data.id);
                    } else {
                        $('.load-prof').find('.overlay').remove();
                        var title = "Profile Dokter";
                        var label = "Edit Data Dokter";
                        var message = data.message;
                        alert_alert(title, label, message);
                    }
                }
            });
        }
    });
    $("#edit-Content-dokter").submit(function(e) {
        e.preventDefault();
        if ($('#edit-Content-dokter').valid()) {
            $('.load-edit').append(
                '<div class="overlay text-center"><i class="fas fa-2x fa-sync-alt fa-spin"></i></div>'
            );
            var link = $("#txtTitle_e").val();
            link = link.replaceAll(' ', '-');
            link = link.replaceAll('&', 'dan');
            link = link.replaceAll('/', '-');
            link = link.replaceAll('|', '-');
            link = link.replaceAll('--', '-');
            var urls = "<?= site_url('admin/create/m_seo'); ?>";
            if (linkId == null) {
                urls = "<?= site_url('admin/update/m_seo'); ?>";
            }
            $.ajax({
                type: "POST",
                url: urls,
                dataType: "JSON",
                data: {
                    id: linkId,
                    title: $("#txtTitle_e").val(),
                    deskripsi: $("#txtDeskripsi_e").val(),
                    icon: $("#txtImg_e").val(),
                    keyword: $("#txtKeyword_e").val(),
                    author: $("#txtAuthor_e").val(),
                    short_link: link,
                    date: $date
                },
                success: function(msg) {
                    if (msg.error == false) {
                        $.ajax({
                            type: "POST",
                            dataType: "JSON",
                            url: "<?php echo site_url('admin/update/m_dokter'); ?>",
                            data: {
                                id: selectedId,
                                content: CKEDITOR.instances[
                                        'txtContent']
                                    .getData(),
                                link_id: msg.id
                            },
                            success: function(msg) {
                                var title = "Peringatan";
                                var label = "Edit Data";
                                var message = msg.message;
                                alert_warning(title, label,
                                    message);
                                CKEDITOR.instances['txtContent']
                                    .setData(
                                        '');
                                $('#edit-Content-dokter')[0]
                                    .reset();
                                $('.load-edit').find('.overlay')
                                    .remove();
                                // location.reload();
                            }
                        });
                    }
                }
            });
        }
    });
    $.search_img = function() {
        $('#frm-find-img').modal('show');
        $("#cmbImg").empty();
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "<?php echo site_url('admin/multi_select');?>?table=w_post_images",
            success: function(data) {
                if (data == '') {
                    $("#cmbImg").append(
                        "<option value=''> -- No Result -- </option>");
                } else {
                    for (var i = 0; i < data.length; i++) {
                        $("#cmbImg").append("<option value='" + data[i].id +
                            "' data-img_src='<?=base_url()?>" + data[i].img +
                            "' name='" +
                            data[i].img + "'>" + data[i].name + "</option>");
                    }
                }
            }
        });
    }
    /* Fungsi Nyisipin Objek Ke Dropdown Gyus.. */
    function drp_template(obj) {
        var data = $(obj.element).data();
        var text = $(obj.element).text();
        if (data && data['img_src']) {
            img_src = data['img_src'];
            template = $("<div class='row'><img class='img-thumbnail img-md col-4' src='" +
                img_src +
                "'/><label class='col-8'>" + text + "</label></div>");
            return template;
        }
    }
    var options = {
        'templateSelection': drp_template,
        'templateResult': drp_template,
    }
    $('#cmbImg').select2(options);
    $('.select2').css({
        'width': '100%'
    });
    $('.select2-container--default .select2-selection--single').css({
        'height': '80px'
    });
    $("#cmbImg").change(function() {
        var img = $("#cmbImg option:selected").attr('name');
        $("#txtImg_e").val(img);
        $("#txtImg_e").attr('disabled', 'disabled');
    });
    /* Function End */
});

function Templating(data) {
    var $html = '';
    for (var i = 0, len = data.length; i < len; i++) {
        $img = "<?= base_url("asset/images/dokter")?>/preview.png";
        if (data[i].items.foto) {
            $img = "<?= base_url("asset/images/dokter")?>/" + data[i].items.foto;
        }
        $html += '<div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">' +
            '<div class="card bg-light">' +
            '<div class="card-header text-muted border-bottom-0">' + data[i].items.kategory +
            '</div>' +
            '<div class="card-body pt-0">' +
            '<div class="row">' +
            '<div class="col-7">' +
            '<h2 class="lead"><b>' + data[i].items.nama_dokter + '</b></h2>' +
            '<p class="text-muted text-sm"><b>Detail: </b> ' + data[i].items.keterangan + ' </p>' +
            '<ul class="ml-4 mb-0 fa-ul text-muted">' +
            '<li class="small mb-2"><span class="fa-li"><i class="fas fa-lg fa-stethoscope"></i></span><b>SIP: </b>' +
            data[i]
            .items.sip + '</li>' +
            '<li class="small mb-2"><span class="fa-li"><i class="fas fa-lg fa-calendar"></i></span><b>BERLAKU SIP: </b>' +
            data[i]
            .items.sip_date + '</li>' +
            '<li class="small mb-2"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span><b>ALAMAT: </b> ' +
            data[
                i].items.alamat +
            '<li class="small mb-2"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span><b>PHONE: </b>' +
            data[i]
            .items.phone + '</li>' +
            '<li class="small mb-2"><span class="fa-li"><i class="fas fa-lg fa-mail-bulk"></i></span><b>EMAIL: </b>' +
            data[i]
            .items.email + '</li>' +
            '</ul>' +
            '</div>' +
            '<div class="col-5 text-center">' +
            '<img src="' + $img + '" alt="' + data[i].items.nama_dokter +
            '"class="img-circle img-fluid">' +
            '</div>' +
            '</div>' +
            '</div>' +
            '<div class="card-footer">' +
            '<div class="text-right">' +
            '<span class="btn btn-sm bg-teal mr-1">' +
            '<i class="fas fa-comments"></i>' +
            '</span>' +
            '<span onclick="$.edit_profile(' + data[i].items.id + ');" class="btn btn-sm btn-primary">' +
            '<i class="fas fa-user"></i> View Profile' +
            '</span>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>';
    }
    return $html;
};
</script>