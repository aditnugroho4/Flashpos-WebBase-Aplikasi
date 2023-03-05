<script>
Dropzone.autoDiscover = false;
$(document).ready(function() {
    $('.mn-1').addClass('bg-secondary');
    $('.dropify').dropify({
        messages: {
            default: 'Kembali Ke asal..',
            replace: 'Ganti file Atau Gambar',
            remove: 'Hapus',
            error: 'Ada Kesalahan Saat Upload File atau gambar..!'
        }
    });
    var data_wajib_pajak = $("#data_wajib_pajak");
    $("#txtTglLahir").datepicker({
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        yearRange: '1920:@maxDate',
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
    $("#txtThnSpt").datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        yearRange: '2010:@maxDate'
    });
    $("#tblData").dataTable({
        "bJQueryUI": true,
        "bAutoWidth": false,
        // "bProcessing": true,
        "iDisplayLength": 10,
        "aLengthMenu": [10, 20, 50, 100],
        "bServerSide": true,
        "sPaginationType": "full_numbers",
        "sAjaxSource": "<?php echo site_url('admin/get_data_table_source'); ?>?table=m_datapegawai&columns=,nip,nama,tmptlahir,tgllahir,kelamin,pendidikan,profesi,golongan,tmtgol,jabatan,tmtdinas,status",
        "aoColumns": [{
                "sTitle": "#",
                "mData": "no",
                "bSortable": false,
                "sClass": "center"
            },
            {
                "sTitle": "NIP/NIRPTT/NIPB",
                "mData": "nip",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "nip-" + oData.id;
                    $(nTd).attr("id", id);
                }
            },
            {
                "sTitle": "Nama",
                "mData": "nama",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "nama-" + oData.id;
                    $(nTd).attr("id", id);
                }
            },
            {
                "sTitle": "Tempat Lahir",
                "mData": "tmptlahir",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "tmptlahir-" + oData.id;
                    $(nTd).attr("id", id);
                }
            },
            {
                "sTitle": "Tgl Lahir",
                "mData": "tgllahir",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "tgllahir-" + oData.id;
                    $(nTd).attr("id", id);
                }
            },
            {
                "sTitle": "Action",
                "mData": "foto",
                "sClass": "center",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    $(nTd).html(
                        "<div class='btn-group'><button type='button' class='btn btn-xs bg-blue'>UPLOAD</button></div>"
                    );
                    $($(nTd).children()[0]).button().click(function() {
                        $.edit_profile(oData.id);
                        data_wajib_pajak.find('[data-card-widget="collapse"]').click();
                    });

                }
            }

        ]
    });
    var detailElement = $("#detail_profile");
    $.edit_profile = function($id) {
        $('#btn-edit-content').show();
        $("#btn-simpan-content").hide();
        $('.load__overlay').append(
            '<div class="overlay"><i class="fas fa-2x fa-sync-alt fa-spin"></i></div>'
        );
        $.data_pajak($id);
        try {
            $.ajax({
                type: "POST",
                dataType: 'json',
                url: "<?php echo site_url('admin/multi_select');?>?table=m_datapegawai&select=id&id=" +
                    $id,
                success: function(data) {
                    if (data != "") {
                        $('.load__overlay').find('.overlay').remove();
                        $("#data_profile").hide();
                        $("#detail_profile").show();
                        $("#edit-foto-prof")[0].reset();
                        var img = "<?= base_url('asset/images/dokter/preview.png') ?>";
                        for (var i = 0; i < data.length; i++) {
                            if (data[i].foto == null || data[i].foto == "") {
                                detailElement.find(".profile-dr-img").attr('src', img);
                            } else {
                                img = "<?= base_url('asset/images/user') ?>/" + data[i].foto;
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
                            detailElement.find(".profile-dr-name").html(data[i].nama);
                            detailElement.find(".prof1").html(data[i].kategory);
                            detailElement.find(".prof2").html(data[i].keterangan);
                            detailElement.find(".prof3").html(data[i].alamat);
                            employId = $.base64.encode(data[i].id);
                            detailElement.find("#txtNip").html(data[i].nip);
                            detailElement.find("#txtNama").val(data[i].nama);
                            detailElement.find("#txtTmtLahir").val(data[i].tmptlahir);
                            detailElement.find("#txtTglLahir").val(data[i].tgllahir);


                            data_wajib_pajak.find('[data-card-widget="collapse"]').click();
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
    $.data_pajak = function($id) {
        try {
            $.ajax({
                type: "POST",
                dataType: 'json',
                url: "<?php echo site_url('admin/multi_select');?>?table=m_dataprofile&select=employ_id&id=" +
                    $id,
                success: function(data) {
                    if (data != "") {
                        $('#btn-Edit-simpan').hide();
                        $('#btn-Edit-upload').show();
                        for (var i = 0; i < data.length; i++) {
                            detailElement.find("#txtNik").val(data[i].nik);
                            detailElement.find("#txtNPWP").val(data[i].npwp);
                            detailElement.find("#txtAlamat").val(data[i].alamat);
                            detailElement.find("#txtEmail").val(data[i].email);
                            detailElement.find("#txtTelpon").val(data[i].phone);
                            $idPajak = data[i].id;
                        }

                    } else {
                        $('#btn-Edit-simpan').show();
                        $('#btn-Edit-upload').hide();
                    }

                }
            });
        } catch (ex) {
            alert(ex);
        }
    }
    $('#btn-Edit-batal').button().click(function() {
        detailElement.find("#txtNip").html("");
        detailElement.find("#txtNama").val("");
        detailElement.find("#txtTmtLahir").val("");
        detailElement.find("#txtTglLahir").val("");
        detailElement.find("#txtNik").val("");
        detailElement.find("#txtNPWP").val("");
        detailElement.find("#txtAlamat").val("");
        detailElement.find("#txtEmail").val("");
        detailElement.find("#txtTelpon").val("");
        $("#detail_profile").hide();
        $("#data_profile").show();
    });
    $('.edit-foto-profile').button().click(function() {
        $("#frm-edit-foto").modal("show");
    });
    $('#btn-Edit-upload').button().click(function() {
        $("#dlg-add_upload").modal("show");
    });
    $('#edit-foto-prof').submit(function(e) {
        e.preventDefault();
        if ($('#edit-foto-prof').valid()) {
            $('.loading-foto').append(
                '<div class="overlay"><i class="fas fa-2x fa-sync-alt fa-spin"></i></div>'
            );
            var confiq = {
                id: employId,
                sizeH: 140,
                sizeW: 190,
                tbL: "m_datapegawai",
                path: "asset-images-user"
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
                        $.edit_profile($.base64.decode(employId));
                    } else {
                        $('.dropify-clear').click();
                        $('.loading-foto').find('.overlay').remove();
                        $("#edit-foto-prof")[0].reset();
                    }
                }
            });
        }
    });
    $('#edit-data-pajak').submit(function(e) {
        e.preventDefault();
        if ($('#edit-data-pajak').valid()) {
            $('.load__overlay').append(
                '<div class="overlay"><i class="fas fa-2x fa-sync-alt fa-spin"></i></div>'
            );
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('admin/create/m_dataprofile'); ?>",
                dataType: "JSON",
                data: {
                    employ_id: $.base64.decode(employId),
                    nama: $("#txtNama").val(),
                    nik: $("#txtNik").val(),
                    npwp: $("#txtNPWP").val(),
                    alamat: $("#txtAlamat").val(),
                    email: $("#txtEmail").val(),
                    phone: $("#txtTelpon").val()
                },
                success: function(data) {
                    if (data.id) {
                        $idPajak = data.id;
                        $.ajax({
                            type: "POST",
                            url: "<?php echo site_url('admin/update/m_datapegawai'); ?>",
                            dataType: "JSON",
                            data: {
                                id: $.base64.decode(employId),
                                tmptlahir: $("#txtTmtLahir").val(),
                                tgllahir: $("#txtTglLahir").val(),
                                kelamin: $("#cmbKelamin option:selected").val(),
                            },
                            success: function(msg) {
                                if (msg.error == false) {
                                    $('.load__overlay').find('.overlay')
                                        .remove();
                                    var title = "Edit Data";
                                    var label = "Edit Data Pegawai";
                                    var message = msg.message;
                                    alert_success(title, label, message);
                                    $.edit_profile(data.id);
                                } else {
                                    $('.load__overlay').find('.overlay')
                                        .remove();
                                    var title = "Edit Data";
                                    var label = "Edit Data Pegawai";
                                    var message = msg.message;
                                    alert_alert(title, label, message);
                                }
                            }
                        });

                    }
                }
            });
        }
    });
    var myDropzone = new Dropzone("#myDropzone", {
        url: "<?php echo site_url('admin/add_upload_file');?>",
        paramName: "file",
        autoProcessQueue: false,
        uploadMultiple: true, // uplaod files in a single request
        parallelUploads: 100, // use it with uploadMultiple
        maxFilesize: 2, // MB
        maxFiles: 2,
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
});
Dropzone.options.myDropzone = {
    // The setting up of the dropzone
    init: function() {
        var totalFile = 0;
        var myDropzone = this;
        // First change the button to actually tell Dropzone to process the queue.
        $("#add-data-upload").submit(function(e) {
            // Make sure that the form isn't actually being sent.
            e.preventDefault();
            e.stopPropagation();
            if (myDropzone.files != "") {
                $('.load-ding-upload').append(
                    '<div class="overlay text-center"><i class="fas fa-2x fa-sync-alt fa-spin"></i></div>'
                );
                var confiq = {
                    id: $user,
                    name: $("#txtNameFile").val() + "-" + $("#txtThnSpt").val().substr(0, 7),
                    tbL: "m_file_spt",
                    path: "asset-images-product-dokument",
                    idUpd: $idPajak
                };
                var parsings = $.base64.encode(JSON.stringify(confiq));
                parsings = parsings.replaceAll(".", "^");
                parsings = parsings.replaceAll("+", "-");
                parsings = parsings.replaceAll("/", "_");

                myDropzone.on('sending', function(file, xhr, formData) {
                    formData.append('data', parsings);
                });
                myDropzone.processQueue();

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
            var label = "Upload Files";
            var message = "Gagal Upload File";
            alert_danger(title, label, message);

        });
        this.on("complete", function(file) {
            if (totalFile == 2) {
                var title = "Add Form";
                var label = "Upload Foto";
                var message = "Maximum Upload 2 File Gambar..!!";
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
            var label = "Upload Files";
            var message = "Upload File Berhasil";
            alert_success(title, label, message);
            $('.load-ding-upload').find('.overlay').remove();
            $("#add-data-upload")[0].reset();
            Dropzone.forElement('#myDropzone').removeAllFiles(true);
            $('.load-ding-upload').find('.overlay').remove();
            $("#dlg-add_upload").modal("hide");
        });
    }
};
</script>
<div id="data_wajib_pajak" class="card load__overlay">
    <div class="card-header">
        <h3 class="card-title">
            <i class="far fa-clock"></i>
            DATA WAJIB PAJAK
        </h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                title="Collapse">
                <i class="fas fa-minus"></i></button>
        </div>
    </div>
    <div class="card-body">
        <div class="row" id="data_profile">
            <div class="table-responsive">
                <table table id="tblData" class="table table-bordered table-striped"></table>
            </div>
        </div>
        <div class="row" id="detail_profile" style="display:none;">
            <div class="col-md-3">
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle profile-dr-img"
                                src="<?= base_url('asset/images/dokter/preview.png');?>" alt="User profile picture">
                        </div>

                        <h3 class="profile-username text-center profile-dr-name">..</h3>

                        <p class="text-muted text-center profile-dr-sts">..</p>

                        <button type="button" class="btn btn-primary btn-block edit-foto-profile"><b>Edit
                                Foto</b></button>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#profile" data-toggle="tab">Profile
                                    Pajak</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="profile">
                                <form class="form-horizontal" id="edit-data-pajak">
                                    <div class="post">
                                        <div class="form-group">
                                            <label for="txtNip">NIP</label>
                                        </div>
                                        <p id="txtNip"></p>
                                    </div>
                                    <div class="form-group row">
                                        <label for="txtNik" class="col-sm-2 col-form-label">NIK</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="txtNik" maxlength="16"
                                                placeholder="ex:3271062509890005" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="txtNPWP" class="col-sm-2 col-form-label">NO NPWP</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="txtNPWP" maxlength="20"
                                                placeholder="ex:24.413.511.7-404-000" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="txtNama" class="col-sm-2 col-form-label">Nama</label>
                                        <div class="col-sm-10">
                                            <input type="text" maxlength="20" class="form-control" id="txtNama"
                                                placeholder="ex:dr.Sutomo" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="cmbKelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                                        <div class="col-sm-4">
                                            <select id="cmbKelamin" class="form-control" required>
                                                <option value="L">Laki - Laki</option>
                                                <option value="P">Perempuan</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="txtTmtLahir" class="col-sm-2 col-form-label">Tempat Tanggal
                                            Lahir</label>
                                        <div class="col-sm-4">
                                            <div class="input-group">
                                                <input type="text" maxlength="45" class="form-control" id="txtTmtLahir"
                                                    placeholder="Bogor" required>
                                                <span class="input-group-append">
                                                    <button type="button" class="btn btn-dark btn-flat btn-views1"><i
                                                            class="fas fa-user-circle"></i></button>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="txtTglLahir"
                                                    placeholder="1989-09-01">
                                                <span class="input-group-append">
                                                    <button type="button" onclick="$('#txtTglLahir').click()"
                                                        class="btn btn-dark btn-flat btn-views2"><i
                                                            class="fas fa-calendar-check"></i></button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="txtAlamat" class="col-sm-2 col-form-label">Alamat</label>
                                        <div class="col-sm-10">
                                            <textarea type="text" col="5" row="5" class="form-control" id="txtAlamat"
                                                required></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="txtTelpon" class="col-sm-2 col-form-label">Telpon</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" maxlength="16" id="txtTelpon"
                                                required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="txtEmail" class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" maxlength="45" id="txtEmail"
                                                placeholder="ex: example@example.com" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-10">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" required> Saya Setuju <a href="#">Untuk
                                                        melakukan perubahan data NPWP</a>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-10">
                                            <button type="submit" id="btn-Edit-simpan"
                                                class="btn btn-success">Simpan</button>
                                            <button id="btn-Edit-batal" type="button"
                                                class="btn btn-danger">Batal</button>
                                            <button id="btn-Edit-upload" type="button" style="display:none;"
                                                class="btn btn-info">Upload</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="frm-edit-foto" tabindex="-1" data-backdrop="static" role="dialog" aria-hidden="true"
    class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content modal-col-light-blue loading-foto">
            <div class="modal-header">
                <h4 id="frm-edit-foto-Label" class="modal-title">Form Edit</h4>
            </div>
            <div class="modal-body">
                <div class="card card-primary loading-foto">
                    <div class="card-header">
                        <p>Edit Foto Profile</p>
                    </div>
                    <form id="edit-foto-prof">
                        <div class="card-body">
                            <div class="form-group">
                                <input type="file" id="upl-upd-foto-prof" data-allowed-file-extensions="png jpg jpeg"
                                    name="file" class="dropify" data-max-file-size="2M" required>
                            </div>
                            <div class="input-group">
                                <div class="input-group-append ">
                                    <button type="submit" class="input-group-text bg-gradient btn-info">Upload</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-secondary ">Close</button>
            </div>
        </div>
    </div>
</div>
<div id="dlg-add_upload" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true" class="modal fade">
    <div role="document" class="modal-dialog modal-lg">
        <div class="modal-content modal-col-light-blue">
            <div class="modal-header">
                <h4 class="modal-title">Form Upload</h4>
            </div>
            <div class="modal-body">
                <div class="card card-primary">
                    <div class="card-header">
                        <p>Upload File</p>
                    </div>
                    <form id="add-data-upload" method="POST">
                        <div class="card-body load-ding-upload">
                            <div class="row">
                                <div class="col-lg-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="logo-img">Images</label>
                                        <div id="myDropzone" class="dropzone"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="txtNameFile">Nama File</label>
                                        <input type="text" id="txtNameFile" placeholder="Spt Pegawai"
                                            class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="txtThnSpt">SPT Tahun</label>
                                        <input type="text" id="txtThnSpt" placeholder="2020" class="form-control"
                                            required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="form-group text-right">
                                <button type="button" data-dismiss="modal" class="btn btn-secondary">Close</button>
                                <button type="submit" class="btn btn-primary ">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>