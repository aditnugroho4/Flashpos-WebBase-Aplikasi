<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<script type="text/javascript">
String.prototype.replaceAll = function(str1, str2, ignore) {
    return this.replace(new RegExp(str1.replace(/([\/\,\!\\\^\$\{\}\[\]\(\)\.\*\+\?\|\<\>\-\&])/g, "\\$&"), (
        ignore ? "gi" : "g")), (typeof(str2) == "string") ? str2.replace(/\$/g, "$$$$") : str2);
};
var selectedId;
var fildeselect;
var active;
var parsing = null;
var $path = null;
Dropzone.autoDiscover = false;
$(document).ready(function() {
    $('.mn-4').addClass('bg-green');

    var tags = $("#dlg-add_upload");

    $('#txtSumber,#txtKeyword_e').tagsinput({
        'tagClass': 'badge bg-pink',
        'maxChars': 500
    });
    $("#dlg-post-library").find('.bootstrap-tagsinput').css({
        'min-height': '80px',
        'height': 'auto'
    });
    $("#tblData").dataTable({
        "bJQueryUI": true,
        "bAutoWidth": true,
        "bProcessing": true,
        "iDisplayLength": 10,
        "aLengthMenu": [10, 25, 50, 100],
        "bServerSide": true,
        "sPaginationType": "full_numbers",
        "sAjaxSource": "<?php echo site_url('admin/get_data_table_source'); ?>?table=w_post_elibrary&columns=,w_post_elibrary.nama,w_post_elibrary.date,m_kategory.name,size,ctgr_id&jwhere=ctgr_id&fildjoins=,m_kategory.name,w_post_elibrary.nama&joins=m_kategory&exports=m_kategory",
        "aoColumns": [{
                "sTitle": "#",
                "mData": "no",
                "bSortable": false,
                "sClass": "center"
            },
            {
                "sTitle": "Cover",
                "mData": "foto",
                "sClass": "center",
                "bSortable": false,
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "foto-" + oData.id;
                    $(nTd).attr("id", id);
                    if (oData.foto == null) {
                        htmlx =
                            "<div class='from-group'><img class='img-thumbnail' width='65' src='<?php echo base_url('asset/admin/dist/img/default-150x150.png'); ?>'alt='AKbar Grup'></div>";
                        $(nTd).html(htmlx);
                    } else {
                        var sizeinbytes = getImageSizeInBytes(
                            "<?php echo base_url('asset/images/thumbnail'); ?>/" +
                            oData.foto);
                        var fSExt = new Array('Bytes', 'KB', 'MB', 'GB');
                        fSize = sizeinbytes;
                        i = 0;
                        while (fSize > 900) {
                            fSize /= 1024;
                            i++;
                        }
                        var hasil = (Math.round(fSize * 100) / 100) + ' ' + fSExt[i];

                        htmlx = "<div id='img-" + oData.id +
                            "' class='from-group'><img class='img-thumbnail'width='65' src='<?php echo base_url('asset/images/thumbnail/'); ?>/" +
                            oData.foto + "' alt='" + oData.nama +
                            "'><span class='ml-5'>Size: (" + hasil + ")</span></div>";
                        $(nTd).html(htmlx);
                    }
                }
            },
            {
                "sTitle": "Nama Buku",
                "mData": "nama",
                "sClass": "center",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "nama-" + oData.id;
                    $(nTd).attr("id", id);
                    $(nTd).editable(
                        "<?php echo site_url('admin/update_grid/w_post_elibrary'); ?>", {
                            "callback": function(sValue, y) {
                                /* Redraw the table from the new data on the server */
                                $("#tblData").dataTable().fnDraw();
                            }
                        });
                }
            },
            {
                "sTitle": "Judul",
                "mData": "judul",
                "sClass": "center",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "judul-" + oData.id;
                    $(nTd).attr("id", id);
                    $(nTd).editable(
                        "<?php echo site_url('admin/update_grid/w_post_elibrary'); ?>", {
                            "callback": function(sValue, y) {
                                /* Redraw the table from the new data on the server */
                                $("#tblData").dataTable().fnDraw();
                            }
                        });
                }
            },
            {
                "sTitle": "Sinopsis",
                "mData": "sinopsis",
                "sClass": "center",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "sinopsis-" + oData.id;
                    $(nTd).attr("id", id);
                    $(nTd).editable(
                        "<?php echo site_url('admin/update_grid/w_post_elibrary'); ?>", {
                            "callback": function(sValue, y) {
                                /* Redraw the table from the new data on the server */
                                $("#tblData").dataTable().fnDraw();
                            }
                        });
                }
            },
            {
                "sTitle": "Kategori",
                "mData": "name",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "ctgr_id-" + oData.id;
                    $(nTd).attr("id", id);
                    $(nTd).editable(
                        "<?php echo site_url('admin/update_grid/w_post_elibrary'); ?>?table=m_kategory", {
                            loadurl: "<?php echo site_url('admin/get_editable_select'); ?>?table=m_kategory&filds=name&select=" +
                                oData.ctgr_id,
                            type: "select",
                            submit: "OK",
                            "callback": function(sValue, y) {
                                /*Redraw the table from the new data on the server */
                                $("#tblData").dataTable().fnDraw();
                            }
                        });
                }
            },
            {
                "sTitle": "Tgl-Upload",
                "mData": "date",
                "sClass": "center",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "date-" + oData.id;
                    $(nTd).attr("id", id);
                }
            }, {
                "sTitle": "STATUS",
                "sClass": "text-center",
                "mData": "status",
                "bSortable": false,
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    if (oData.status == 'Y') {
                        htmlx =
                            "<button class='btn btn-xs bg-green'><i class='fas fa-check'></i></button>";
                        $(nTd).html(htmlx);
                        $($(nTd).children()[0]).button().click(function() {
                            var id = "status-" + oData.id;
                            $(nTd).attr("id", id);
                            selectedId = oData.id;
                            fildeselect = "status";
                            active = 'N';
                            $("#txt-status").html(
                                "Status akan di Ubah Menjadi Non aktif..?");
                            $("#dlg-edit-status").modal("show");
                        });
                    } else if (oData.status == null || oData.status == 'N') {
                        htmlx =
                            "<button class='btn btn-xs bg-danger'><i class='fa fa-ban'></i></button>";
                        $(nTd).html(htmlx);
                        $($(nTd).children()[0]).button().click(function() {
                            var id = "status-" + oData.id;
                            $(nTd).attr("id", id);
                            fildeselect = "status";
                            selectedId = oData.id;
                            active = 'Y';
                            $("#txt-status").html(
                                "Status akan di Ubah Menjadi aktif..?");
                            $("#dlg-edit-status").modal("show");
                        });
                    }
                }
            }, {
                "sTitle": "REVIEW",
                "sClass": "text-center",
                "mData": "status",
                "bSortable": false,
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    if (oData.status == 'Y') {
                        $(nTd).html(
                            "<button class='btn btn-xs bg-success btn-sm'>TAYANG</button>");
                    } else {
                        $(nTd).html(
                            "<button class='btn btn-xs bg-pink btn-sm'>PUBLIKASI</button>");
                        $($(nTd).children()[0]).button().click(function() {
                            $("#dlg-post-library").modal("show");
                            selectedId = oData.id;
                            $("#txtTitle_e").val(oData.judul);
                            $("#txtDeskripsi_e").val(oData.sinopsis);
                            $("#txtImg_e").val(oData.foto);
                            $("#txtShortLink_e").val(oData.judul);
                        });
                    }

                }
            }
        ]
    });
    $("#btnUpload").button().click(function() {
        $("#cmbKategory-upd").empty();
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "<?php echo site_url('admin/multi_select');?>?table=w_post_ctgr_lib&select=status&id='Y'",
            success: function(data) {
                if (data == '') {
                    $("#cmbKategory-upd").append(
                        "<option value=''> -- No Result -- </option>");
                } else {
                    $("#cmbKategory-upd").append(
                        "<option value=''> -- Silahkan Pilih -- </option>");
                    for (var i = 0; i < data.length; i++) {
                        $("#cmbKategory-upd").append("<option value='" + data[i].id +
                            "' name='" + data[i].folder + "'>" + data[i].nama +
                            "</option>");
                    }
                }
                $("#dlg-add_upload").modal("show");
                tags.find('.bootstrap-tagsinput').addClass('form-control');
                tags.find('.bootstrap-tagsinput').css({
                    'min-height': '80px',
                    'height': 'auto'
                });
            }
        });
    });
    $('#btn-prosess').button().click(function() {
        $.ajax({
            url: "<?php echo site_url('admin/aktive/w_post_elibrary'); ?>/" + fildeselect +
                "/" +
                selectedId + "/" + active,
            success: function(data) {
                $("#dlg-edit-status").modal("hide");
                $("#tblData").dataTable().fnDraw();
            }
        });
    });
    $("#publikasi_perpus").submit(function(e) {
        e.preventDefault();
        if ($('#publikasi_perpus').valid()) {
            $('.load-publis').append(
                '<div class="overlay text-center"><i class="fas fa-2x fa-sync-alt fa-spin"></i></div>'
            );
            var link = $("#txtTitle_e").val();
            link = link.replaceAll(' ', '-');
            link = link.replaceAll('&', 'dan');
            link = link.replaceAll('/', '-');
            link = link.replaceAll('|', '-');
            link = link.replaceAll('--', '-');
            link = link.replaceAll('(', '');
            link = link.replaceAll(')', '');
            link = link.replaceAll('?', '');
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('admin/create/m_seo'); ?>",
                dataType: 'json',
                data: {
                    title: $("#txtTitle_e").val(),
                    deskripsi: $("#txtDeskripsi_e").val(),
                    icon: "asset/images/thumbnail/" + $("#txtImg_e").val(),
                    keyword: $("#txtKeyword_e").val(),
                    author: $("#txtAuthor_e").val(),
                    short_link: link.toLowerCase(),
                    date: $date
                },
                success: function(msg) {
                    $.ajax({
                        type: "POST",
                        url: "<?php echo site_url('admin/update/w_post_elibrary'); ?>",
                        dataType: 'json',
                        data: {
                            id: selectedId,
                            status: 'Y',
                            link_id: msg.id,
                            slug: link.toLowerCase()
                        },
                        success: function(msg) {
                            $('.load-publis').find('.overlay').remove();
                            $('#publikasi_perpus')[0].reset();
                            $("#dlg-post-library").modal("hide");
                            $("#tblData").dataTable().fnDraw();
                        }
                    });

                }
            });

        }
    });

    function imgSize(path) {
        var img = $('#resize-show');
        img.attr("src", path);
        var sizeinbytes = getImageSizeInBytes(path);
        var fSExt = new Array('Bytes', 'KB', 'MB', 'GB');
        fSize = sizeinbytes;
        i = 0;
        while (fSize > 900) {
            fSize /= 1024;
            i++;
        }
        var hasil = (Math.round(fSize * 100) / 100) + ' ' + fSExt[i];
        $('#uk-size').html("Original Size= " + hasil + ' kb');
        $("#load-size").button().click();
    };

    function getImageSizeInBytes(imgURL) {
        var request = new XMLHttpRequest();
        request.open("HEAD", imgURL, false);
        request.send(null);
        var headerText = request.getAllResponseHeaders();
        var re = /Content\-Length\s*:\s*(\d+)/i;
        re.exec(headerText);
        return parseInt(RegExp.$1);
    }

    function imgResize(path) {
        $('.load-ding-resize').append(
            '<div class="overlay text-center"><i class="fas fa-2x fa-sync-alt fa-spin"></i></div>');
        var file = path.split('/').pop();
        var ext = path.split('.').pop();
        var path = path.split("/").slice(0, -1).join("/");
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "<?php echo site_url('admin/resizeImageTo');?>",
            data: {
                file: file,
                path: path
            },
            success: function(data) {
                if (data.error == false) {
                    var newpath = '<?= base_url();?>' + data.path;
                    $('#resize-show').attr("src", '');
                    imgSize(newpath);
                    $path = null;
                    // $("#tblData").dataTable().fnDraw();
                    var title = "Setting Form";
                    var label = "Resize Foto";
                    var message = "Merubah Ukuran Berhasil..! (";
                    alert_info(title, label, message + data.message + ")");
                }
                $('.load-ding-resize').find('.overlay').remove();
            }
        });
    }
    $('.dropify').dropify({
        messages: {
            default: 'Kembali Ke asal..',
            replace: 'Ganti file Atau Gambar',
            remove: 'Hapus',
            error: 'Ada Kesalahan Saat Upload File atau gambar..!'
        }
    });


    $("#load-size").button().click(function() {
        var myImg = document.querySelector("#resize-show");
        var realWidth = myImg.naturalWidth;
        var realHeight = myImg.naturalHeight;
        $('#uk-width').html("Original width= " + realWidth);
        $('#uk-height').html("Original height= " + realHeight);

    });
    $("#resize-img").button().click(function() {
        if ($path != null) {
            imgResize($path);
        } else {
            var title = "Setting Form";
            var label = "Resize Foto";
            var message = "Sudah Melakukan Resize Image";
            alert_danger(title, label, message);
            $("#dlg-resize-images").modal("hide");
        }
    });
    $("#btnReload").button().click(function() {
        $("#tblData").dataTable().fnDraw();
    });
    var myDropzone = new Dropzone("#myDropzone", {
        url: "<?php echo site_url('admin/add_upload_file');?>",
        paramName: "file",
        autoProcessQueue: false,
        uploadMultiple: true, // uplaod files in a single request
        parallelUploads: 10, // use it with uploadMultiple
        maxFilesize: 10, // MB
        maxFiles: 5,
        acceptedFiles: ".pdf, .doc, .xls, .csv",
        addRemoveLinks: true,
        // Language Strings
        dictFileTooBig: "Data Terlalu Besar ({{filesize}}mb). Max allowed file size is {{maxFilesize}}mb",
        dictInvalidFileType: "Jenis File Tidak di Izinkan",
        dictCancelUpload: "Cancel",
        dictRemoveFile: "Remove",
        dictMaxFilesExceeded: "Only {{maxFiles}} files are allowed",
        dictDefaultMessage: "Drag File yang akan di Upload Di sini gan.."
    });
    $("#cmbKategory-upd").change(function() {
        $path = $("#cmbKategory-upd option:selected").attr('name');
    });
});

Dropzone.options.myDropzone = {
    init: function() {
        var totalFile = 0;
        var myDropzone = this;
        // First change the button to actually tell Dropzone to process the queue.
        $("#add-data-upload").submit(function(e) {
            e.preventDefault();
            e.stopPropagation();
            if (myDropzone.files != "") {
                $('.load-ding-upload').append(
                    '<div class="overlay text-center"><i class="fas fa-2x fa-sync-alt fa-spin"></i></div>'
                );
                $.ajax({
                    url: "<?php echo site_url('admin/create/w_post_elibrary');?>",
                    type: "post",
                    dataType: "JSON",
                    data: {
                        nama: $("#txtNamaBuku").val(),
                        judul: $("#txtJudul").val(),
                        sinopsis: $("#txtSinopsis").val(),
                        sumber: $("#txtSumber").val(),
                        ctgr_id: $("#cmbKategory-upd option:selected").val(),
                        user_id: $user,
                        date: $date,
                    },
                    success: function(data) {
                        if (data.error == false) {
                            upload($.base64.encode(data.id));
                            var confiq = {
                                id: $user,
                                name: $("#txtNamaBuku").val(),
                                tbL: "w_post_files",
                                path: $path,
                                idUpd: data.id
                            };
                            var parsings = $.base64.encode(JSON.stringify(confiq));
                            parsings = parsings.replaceAll(".", "^");
                            parsings = parsings.replaceAll("+", "-");
                            parsings = parsings.replaceAll("/", "_");
                            parsings = parsings.replaceAll("?", "");

                            myDropzone.on('sending', function(file, xhr, formData) {
                                formData.append('data', parsings);
                            });
                            myDropzone.processQueue();
                        }
                    }
                });
            } else {
                $("#myDropzone").submit();
            }
        });
        // on add file
        this.on("addedfile", function(file) {
            totalFile += 1;
            if (myDropzone.files[2] != null) {
                myDropzone.removeFile(myDropzone.files[2]);
            }
        });
        // on error
        this.on("error", function(file, response) {
            var title = "Add Form";
            var label = "Upload File";
            var message = "Maximum Upload 2 File!!";
            alert_danger(title, label, message);

        });
        this.on("complete", function(file) {
            if (totalFile == 2) {
                var title = "Add Form";
                var label = "Upload File";
                var message = "Maximum Upload 2 File!!";
                alert_danger(title, label, message);
            }

        });
        // on start
        this.on("sendingmultiple", function(file) {
            // console.log(file);	

        });
        // on success
        this.on("successmultiple", function(file) {
            var title = "Add Form";
            var label = "Upload File";
            var message = "Upload File Berhasil";
            alert_success(title, label, message);
            $path = "";
            Dropzone.forElement('#myDropzone').removeAllFiles(true);
            $('.load-ding-upload').find('.overlay').remove();
            $("#add-data-upload")[0].reset();
            $("#dlg-add_upload").modal("hide");
            $("#tblData").dataTable().fnDraw();
        });
    }
};

function upload(id) {
    try {
        if (id) {
            var confiq = {
                id: id,
                sizeH: 125,
                sizeW: 125,
                tbL: "w_post_elibrary",
                path: "asset-images-thumbnail"
            };
            var fd = new FormData(document.getElementById("add-data-upload"));
            var parsing = $.base64.encode(JSON.stringify(confiq));
            parsing = parsing.replaceAll(".", "^");
            parsing = parsing.replaceAll("+", "-");
            parsing = parsing.replaceAll("/", "_");
            parsing = parsing.replaceAll("?", "");
            $.ajax({
                url: "<?php echo site_url('admin/edit_upload_foto');?>?data=" + parsing,
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
                        var title = "Add Form";
                        var label = "Tambah Tampilan Banner";
                        var message = data.message;
                        alert_success(title, label, message);
                    } else {
                        $('.dropify-clear').click();
                        var title = "Add Form";
                        var label = "Tambah Tampilan Banner";
                        var message = data.message;
                        alert_danger(title, label, message);
                    }
                }
            });
        }
    } catch (e) {

    }
};
</script>