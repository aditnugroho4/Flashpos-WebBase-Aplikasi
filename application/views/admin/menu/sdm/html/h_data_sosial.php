<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<script type="text/javascript">
$(document).ready(function() {
    var idSelected = false;
    var idProvinsi = false;
    var idKota = false;
    var idKecamatan = false;
    var idKelurahan = false;
    $('.mn-1').addClass('bg-brown');
    $("#tblData").dataTable({
        "bJQueryUI": true,
        "bAutoWidth": false,
        // "bProcessing": true,
        "iDisplayLength": 10,
        "aLengthMenu": [10, 20, 50, 100],
        "bServerSide": true,
        "sPaginationType": "full_numbers",
        "sAjaxSource": "<?php echo site_url('admin/get_data_table_source'); ?>?table=m_datasosial&columns=,nik,npwp,nama,tgllahir,alamat,contact,email",
        "aoColumns": [{
                "sTitle": "#",
                "mData": "no",
                "bSortable": false,
                "sClass": "center"
            },
            {
                "sTitle": "KTP",
                "mData": "nik",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "nik-" + oData.id;
                    $(nTd).attr("id", id);
                    $(nTd).editable(
                        "<?php echo site_url('admin/update_grid/m_datasosial'); ?>", {
                            "callback": function(sValue, y) {
                                /* Redraw the table from the new data on the server */
                                $("#tblData").dataTable().fnDraw();
                            }
                        });
                }
            },
            {
                "sTitle": "No. NPWP",
                "mData": "npwp",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "npwp-" + oData.id;
                    $(nTd).attr("id", id);
                    $(nTd).editable(
                        "<?php echo site_url('admin/update_grid/m_datasosial'); ?>", {
                            "callback": function(sValue, y) {
                                /* Redraw the table from the new data on the server */
                                $("#tblData").dataTable().fnDraw();
                            }
                        });
                }
            },
            {
                "sTitle": "Nama",
                "mData": "nama",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "nama-" + oData.id;
                    $(nTd).attr("id", id);
                    $(nTd).editable(
                        "<?php echo site_url('admin/update_grid/m_datasosial'); ?>", {
                            "callback": function(sValue, y) {
                                /* Redraw the table from the new data on the server */
                                $("#tblData").dataTable().fnDraw();
                            }
                        });
                }
            },
            {
                "sTitle": "Tempat Lahir",
                "mData": "tmptlahir",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "tmptlahir-" + oData.id;
                    $(nTd).attr("id", id);
                    $(nTd).editable(
                        "<?php echo site_url('admin/update_grid/m_datasosial'); ?>", {
                            "callback": function(sValue, y) {
                                /* Redraw the table from the new data on the server */
                                $("#tblData").dataTable().fnDraw();
                            }
                        });
                }
            },
            {
                "sTitle": "Tanggal Lahir",
                "mData": "tgllahir",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "tgllahir-" + oData.id;
                    $(nTd).attr("id", id);
                    $(nTd).editable(
                        "<?php echo site_url('admin/update_grid/m_datasosial'); ?>", {
                            type: "datepicker",
                            datepicker: {
                                dateFormat: "yy-mm-dd",
                                changeMonth: true,
                                changeYear: true,
                                showButtonPanel: true,
                                yearRange: '1920:2050'
                            },
                            "callback": function(sValue, y) {
                                /* Redraw the table from the new data on the server */
                                $("#tblData").dataTable().fnDraw();
                            }
                        });
                }
            },
            {
                "sTitle": "Alamat",
                "mData": "alamat",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "alamat-" + oData.id;
                    $(nTd).attr("id", id);
                    $(nTd).editable(
                        "<?php echo site_url('admin/update_grid/m_datasosial'); ?>", {
                            "callback": function(sValue, y) {
                                /* Redraw the table from the new data on the server */
                                $("#tblData").dataTable().fnDraw();
                            }
                        });
                }
            },
            {
                "sTitle": "No Telpon",
                "mData": "contact",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "contact-" + oData.id;
                    $(nTd).attr("id", id);
                    $(nTd).editable(
                        "<?php echo site_url('admin/update_grid/m_datasosial'); ?>", {
                            "callback": function(sValue, y) {
                                /* Redraw the table from the new data on the server */
                                $("#tblData").dataTable().fnDraw();
                            }
                        });
                }
            },
            {
                "sTitle": "Edit",
                "mData": "foto",
                "sClass": "center",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    $(nTd).html(
                        "<div class='btn-group'><button type='button' class='btn btn-xs bg-yellow'>Edit</button></div>"
                    );
                    $($(nTd).find('.btn-group').children()[0]).button().click(function() {
                        selectedId = oData.id;
                        $('#tab-data a[href="#Edit-Data"]').trigger('click');
                        $("#txtNikE").val(oData.nik);
                        $("#txtNPWPE").val(oData.npwp);
                        $("#txtNamaE").val(oData.nama);
                        $("#txtTmptLahirE").val(oData.tmptlahir);
                        $("#txtTglLahirE").val(oData.tgllahir);
                        $("#txtAlamatE").val(oData.alamat);
                        idSelected = oData.provinsi_id;
                        idKota = oData.kota_id;
                        idKecamatan = oData.kecamatan_id;
                        idKelurahan = oData.kelurahan_id;
                        $.get_data_provinsi("#cmbProvinsiE");

                        if (oData.jnsklmn != false) {
                            $("#cmbKelaminE").val(oData.jnsklmn);
                        }
                        $("#txtEmailE").val(oData.email);
                        $("#txtContacE").val(oData.contact);

                    });
                }
            }

        ]
    });
    $("#txtTglLahir,#txtTglLahirE").datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        yearRange: '1920:2050'
    });
    $('#AddData').click(function() {
        $('#add_data_sosial')[0].reset();
        $.get_data_provinsi("#cmbProvinsi");
        $("#txtNik").focus();
        selectedId = false;
    });
    $("#txtNik").keypress(function(event) {
        if (event.which == 13) {
            if ($(this).val().length > 0) {

                $("#txtNPWP").focus();
            } else {
                $(this).focus();
            }
        }
    });
    $("#txtNPWP").keypress(function(event) {
        if (event.which == 13) {
            if ($(this).val().length > 0) {

                $("#txtNama").focus();
            } else {
                $(this).focus();
            }
        }
    });
    $("#txtNama").keypress(function(event) {
        if (event.which == 13) {
            if ($(this).val().length > 0) {

                $("#cmbKelamin").focus();
            } else {
                $(this).focus();
            }
        }
    });
    $("#cmbKelamin").change(function() {
        $("#txtTmptLahir").focus();
    });
    $("#txtTmptLahir").keypress(function(event) {
        if (event.which == 13) {
            if ($(this).val().length > 0) {

                $("#txtTglLahir").focus();
            } else {
                $(this).focus();
            }
        }
    });
    $("#cmbProvinsi").change(function() {
        $("#cmbKota").empty();
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "<?php echo site_url('admin/multi_select');?>?table=m_kota&select=idprovinsi&id=" +
                $(this).val(),
            success: function(data) {
                if (data == '') {
                    $("#cmbKota").append("<option value=''>-- No Data --</option>");
                } else {
                    $("#cmbKota").append("<option value=''>-- Pilih --</option>");
                    for (var i = 0; i < data.length; i++) {

                        $("#cmbKota").append("<option value='" + data[i].id + "'>" + data[i]
                            .name + "</option>");
                    }
                }
                $("#cmbKota").focus();

            }
        });
    });
    $("#cmbKota").change(function() {
        $("#cmbKecamatan").empty();
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "<?php echo site_url('admin/multi_select');?>?table=m_kecamatan&select=idkota&id=" +
                $(this).val(),
            success: function(data) {
                if (data == '') {
                    $("#cmbKecamatan").append("<option value=''>-- No Data --</option>");
                } else {
                    $("#cmbKecamatan").append("<option value=''>-- Pilih --</option>");
                    for (var i = 0; i < data.length; i++) {

                        $("#cmbKecamatan").append("<option value='" + data[i].id + "'>" +
                            data[i]
                            .name + "</option>");
                    }
                }
                $("#cmbKecamatan").focus();

            }
        });
    });
    $("#cmbKecamatan").change(function() {
        $("#cmbKelurahan").empty();
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "<?php echo site_url('admin/multi_select');?>?table=m_kelurahan&select=idkecamatan&id=" +
                $(this).val(),
            success: function(data) {
                if (data == '') {
                    $("#cmbKelurahan").append("<option value=''>-- No Data --</option>");
                } else {
                    $("#cmbKelurahan").append("<option value=''>-- Pilih --</option>");
                    for (var i = 0; i < data.length; i++) {

                        $("#cmbKelurahan").append("<option value='" + data[i].id + "'>" +
                            data[i].name + "</option>");
                    }
                }
                $("#cmbKelurahan").focus();

            }
        });
    });
    $("#cmbKelurahan").change(function() {
        $('#txtEmail').focus();
    });
    $("#txtEmail").keypress(function(event) {
        if (event.which == 13) {
            if ($(this).val().length > 0) {

                $("#txtContact").focus();
            } else {
                $(this).focus();
            }
        }
    });
    $("#add_data_sosial").submit(function(e) {
        e.preventDefault();
        if ($('#add_data_sosial').valid()) {
            $('.loadding').append(
                '<div class="overlay"><i class="fas fa-2x fa-sync-alt fa-spin"></i></div>');
            $.ajax({
                type: "POST",
                dataType: 'json',
                url: "<?php echo site_url('admin/create/m_datasosial'); ?>",
                data: {
                    nik: $("#txtNik").val(),
                    npwp: $("#txtNPWP").val(),
                    nama: $("#txtNama").val(),
                    alamat: $("#txtAlamat").val(),
                    jnsklmn: $("#cmbKelamin option:selected").val(),
                    tmptlahir: $("#txtTmptLahir").val(),
                    tgllahir: $("#txtTglLahir").val(),
                    provinsi_id: $("#cmbProvinsi option:selected").val(),
                    kota_id: $("#cmbKota option:selected").val(),
                    kecamatan_id: $("#cmbKecamatan option:selected").val(),
                    kelurahan_id: $("#cmbKelurahan option:selected").val(),
                    email: $("#txtEmail").val(),
                    contact: $("#txtContact").val()
                },
                success: function(msg) {
                    if (msg.error == false) {
                        $('.loadding').find('.overlay').remove();
                        $('#add_data_sosial')[0].reset();
                        $.alert_swal('Data Sosial', msg
                            .message, 'success');
                    } else {
                        $('.loadding').find('.overlay').remove();
                        $.alert_swal_info('Data Sosial', msg
                            .message, 'warning');
                    }
                }
            });
        }
    });
    $("#btn-batal-simpan").button().click(function() {
        $('#add_data_sosial')[0].reset();
        $('#tab-data a[href="#Data-List"]').trigger('click');
        selectedId = false;
    });
    $('#EditData').click(function() {
        if (!selectedId) {
            $.alert_swal('Edit Data Sosial', 'Pilih Data Yang Akan di Edit', 'warning');
        } else {
            $("#submit_edit").show();
        }
    });
    $("#btn-batal-edit").button().click(function() {
        $('#edit-data-prof')[0].reset();
        $('#tab-data a[href="#Data-List"]').trigger('click');
        selectedId = false;
    });
    $.get_data_provinsi = function(tag) {
        $(tag).empty();
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "<?php echo site_url('admin/multi_select');?>?table=m_provinsi",
            success: function(data) {
                if (data == '') {
                    $(tag).append("<option value=''> -- No Result -- </option>");
                } else {
                    $(tag).append(
                        "<option value=''> -- Silahkan Pilih -- </option>");
                    for (var i = 0; i < data.length; i++) {
                        $(tag).append("<option value='" + data[i].id + "'>" +
                            data[i].name + "</option>");
                    }
                    if (idSelected != false) {
                        $(tag).val(idSelected);
                        $(tag).change();
                    }
                }
            }
        });
    }
    $("#cmbProvinsiE").change(function() {
        $.get_data_mix("#cmbKotaE", "m_kota", "idprovinsi", $(this).val());
        idSelected = idKota;
    });
    $("#cmbKotaE").change(function() {
        $.get_data_mix("#cmbKecamatanE", "m_kecamatan",
            "idkota", $(this).val());
        idSelected = idKecamatan;
    });
    $("#cmbKecamatanE").change(function() {
        $.get_data_mix("#cmbKelurahanE", "m_kelurahan",
            "idkecamatan", $(this).val());
        idSelected = idKelurahan;
    });
    $("#cmbKelurahanE").change(function() {
        $("#txtEmailE").focus();
    });
    $("#edit-data-prof").submit(function(e) {
        e.preventDefault();
        if ($('#edit-data-prof').valid()) {
            $('.loadding').append(
                '<div class="overlay"><i class="fas fa-2x fa-sync-alt fa-spin"></i></div>');
            $.ajax({
                type: "POST",
                dataType: 'json',
                url: "<?php echo site_url('admin/update/m_datasosial'); ?>",
                data: {
                    id: selectedId,
                    nik: $("#txtNikE").val(),
                    npwp: $("#txtNPWPE").val(),
                    nama: $("#txtNamaE").val(),
                    alamat: $("#txtAlamatE").val(),
                    jnsklmn: $("#cmbKelaminE option:selected").val(),
                    tmptlahir: $("#txtTmptLahirE").val(),
                    tgllahir: $("#txtTglLahirE").val(),
                    provinsi_id: $("#cmbProvinsiE option:selected").val(),
                    kota_id: $("#cmbKotaE option:selected").val(),
                    kecamatan_id: $("#cmbKecamatanE option:selected").val(),
                    kelurahan_id: $("#cmbKelurahanE option:selected").val(),
                    email: $("#txtEmailE").val(),
                    contact: $("#txtContactE").val()
                },
                success: function(msg) {
                    if (msg.error == false) {
                        $('.loadding').find('.overlay').remove();
                        $('#edit-data-prof')[0].reset();
                        $.alert_swal('Data Sosial', msg
                            .message, 'success');
                    } else {
                        $('.loadding').find('.overlay').remove();
                        $.alert_swal_info('Data Sosial', msg
                            .message, 'warning');
                    }
                }
            });
        }
    });
    $.get_data_mix = function(tag, table, selectd, id) {
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "<?php echo site_url('admin/multi_select');?>?table=" + table + "&select=" +
                selectd + "&id=" + id,
            success: function(data) {
                $(tag).empty();
                if (data == '') {
                    $(tag).append("<option value=''> -- No Result -- </option>");
                } else {
                    $(tag).append(
                        "<option value=''> -- Silahkan Pilih -- </option>");
                    for (var i = 0; i < data.length; i++) {
                        $(tag).append("<option value='" + data[i].id + "'>" +
                            data[i].name + "</option>");
                    }
                    if (idSelected != false) {
                        $(tag).val(idSelected);
                        $(tag).change();
                    }
                }
            }
        });
        return id;
    }
    $.alert_swal = function($info, $message, $alert) {
        Swal.fire({
            icon: $alert,
            title: $info,
            text: $message,
            confirmButtonText: "OK",
            focusConfirm: true
        }).then((result) => {
            if (result.value) {
                $('#tab-data a[href="#Data-List"]').trigger('click');
                $("#tblData").dataTable().fnDraw();
            }
        })
    }
});
</script>
<div class="col-lg-12">
    <div class="card card-outline card-brown">
        <div class="card-header">
            <h3 class="card-title col-lg-4 col-sm-12 mb-2">DATA SOSIAL</h3>
        </div>
        <div class="card-body">
            <div class="card loadding">
                <div class="card-header p-2">
                    <ul class="nav nav-pills" id="tab-data">
                        <li class="nav-item" id="ListData"><a class="nav-link active" href="#Data-List"
                                data-toggle="tab">Data
                                Sosial</a>
                        </li>
                        <li class="nav-item" id="AddData"><a class="nav-link" href="#Add-Data" data-toggle="tab">Tambah
                                Data</a>
                        </li>
                        <li class="nav-item" id="EditData"><a class="nav-link" href="#Edit-Data" data-toggle="tab">Edit
                                Data</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="Data-List">
                            <div class="table-responsive">
                                <table table id="tblData" class="table table-bordered table-striped"></table>
                            </div>
                        </div>
                        <div class="tab-pane" id="Add-Data">
                            <form id="add_data_sosial">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>No. KTP</label>
                                                <input type="text" id="txtNik" maxlength="16" class="form-control"
                                                    required>
                                            </div>
                                            <div class="form-group">
                                                <label>No. NPWP</label>
                                                <input type="text" id="txtNPWP" maxlength="20" class="form-control"
                                                    required>
                                            </div>
                                            <div class="form-group">
                                                <label>Nama</label>
                                                <input type="text" id="txtNama" maxlength="30" class="form-control"
                                                    required>
                                            </div>
                                            <div class="form-group">
                                                <label>Jenis Kelamin</label>
                                                <select id="cmbKelamin" class="form-control" required>
                                                    <option value="">-- Pilih --</option>
                                                    <option value="L">Laki - Laki</option>
                                                    <option value="P">Perempuan</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label">Tempat Lahir</label>
                                                        <div class="input-group">
                                                            <input type="text" id="txtTmptLahir" maxlength="30"
                                                                class="form-control" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label">Tgl Lahir</label>
                                                        <div class="input-group">
                                                            <input type="text" id="txtTglLahir"
                                                                Placeholder="contoh : 1989-25-09" maxlength="10"
                                                                class="form-control" required>
                                                            <span class="input-group-append">
                                                                <button type="button"
                                                                    class="btn btn-dark btn-flat btn-views2"><i
                                                                        class="fas fa-calendar"></i></button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Alamat</label>
                                                <textarea type="text" id="txtAlamat" class="form-control"
                                                    required></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Provinsi</label>
                                                <select id="cmbProvinsi" class="form-control" required></select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Kabupaten / Kota</label>
                                                <select id="cmbKota" class="form-control" required></select>
                                            </div>
                                            <div class="form-group">
                                                <label>Kecamatan</label>
                                                <select id="cmbKecamatan" class="form-control" required></select>
                                            </div>
                                            <div class="form-group">
                                                <label>Kelurahan</label>
                                                <select id="cmbKelurahan" class="form-control" required></select>
                                            </div>
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="email" id="txtEmail" maxlength="100" class="form-control"
                                                    required>
                                            </div>
                                            <div class="form-group">
                                                <label>No. Contact</label>
                                                <input type="text" id="txtContact" maxlength="16" class="form-control"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <button type="submit" class="btn btn-brown float-right">Simpan</button>
                                            <button type="button" id="btn-batal-simpan"
                                                class="btn btn-brown float-right mr-1">Batal</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane" id="Edit-Data">
                            <form id="edit-data-prof">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>No. KTP</label>
                                                <input type="text" id="txtNikE" maxlength="20" class="form-control"
                                                    required>
                                            </div>
                                            <div class="form-group">
                                                <label>No. NPWP</label>
                                                <input type="text" id="txtNPWPE" maxlength="20" class="form-control"
                                                    required>
                                            </div>
                                            <div class="form-group">
                                                <label>Nama</label>
                                                <input type="text" id="txtNamaE" maxlength="30" class="form-control"
                                                    required>
                                            </div>
                                            <div class="form-group">
                                                <label>Jenis Kelamin</label>
                                                <select id="cmbKelaminE" class="form-control" required>
                                                    <option value="">-- Pilih --</option>
                                                    <option value="L">Laki - Laki</option>
                                                    <option value="P">Perempuan</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label">Tempat Lahir</label>
                                                        <div class="input-group">
                                                            <input type="text" id="txtTmptLahirE" maxlength="30"
                                                                class="form-control" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label">Alamat</label>
                                                        <div class="input-group">
                                                            <input type="text" id="txtTglLahirE"
                                                                Placeholder="contoh : 1989-25-09" maxlength="10"
                                                                class="form-control" required>
                                                            <span class="input-group-append">
                                                                <button type="button"
                                                                    class="btn btn-dark btn-flat btn-views2"><i
                                                                        class="fas fa-calendar"></i></button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Alamat</label>
                                                <textarea type="text" id="txtAlamatE" class="form-control"
                                                    required></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Provinsi</label>
                                                <select id="cmbProvinsiE" class="form-control" required></select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Kabupaten / Kota</label>
                                                <select id="cmbKotaE" class="form-control" required></select>
                                            </div>
                                            <div class="form-group">
                                                <label>Kecamatan</label>
                                                <select id="cmbKecamatanE" class="form-control" required></select>
                                            </div>
                                            <div class="form-group">
                                                <label>Kelurahan</label>
                                                <select id="cmbKelurahanE" class="form-control" required></select>
                                            </div>
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="email" id="txtEmailE" maxlength="100" class="form-control"
                                                    required>
                                            </div>
                                            <div class="form-group">
                                                <label>No. Contact</label>
                                                <input type="text" id="txtContacE" maxlength="16" class="form-control"
                                                    required>
                                            </div>
                                            <div class="form-group">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" required> Saya Setuju Merubah Data <a
                                                            href="#">Dengan Ketentuan Aturan sistem</a>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <button type="button" id="btn-batal-edit"
                                                class="btn btn-brown float-right">Batal</button>
                                            <button type="submit" class="btn btn-brown float-right mr-1">Update</button>
                                        </div>
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