<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<script type="text/javascript">
var fildeselect;
var active;
var eleFocus = '';
var divisiID;
var akunID;
$(document).ready(function() {
    Globalize.culture("id-ID");
    $('.mn-3').addClass('bg-brown');
    $('.dropify').dropify({
        messages: {
            default: 'Kembali Ke asal..',
            replace: 'Ganti file Atau Gambar',
            remove: 'Hapus',
            error: 'Ada Kesalahan Saat Upload File atau gambar..!'
        }
    });
    $("#txtTglBeli,#txtTglExpierd,#txtTglBeliE,#txtTglExpierdE").datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        yearRange: '2021:2050'
    });
    $("#tblData").dataTable({
        "bJQueryUI": true,
        "bAutoWidth": false,
        "bProcessing": true,
        "iDisplayLength": 10,
        "aLengthMenu": [10, 20, 50, 100],
        "bServerSide": true,
        "sPaginationType": "full_numbers",
        "sAjaxSource": "<?php echo site_url('admin/get_data_table_source'); ?>?table=k_item_inventory&columns=,kode,nama,deskripsi,harga_penyusutan,jenis_id&jwhere=jenis_id&fildjoins=,k_jenis_inventory.nama as Jenis&joins=k_jenis_inventory&exports=k_jenis_inventory",
        "aoColumns": [{
                "sTitle": "#",
                "mData": "no",
                "bSortable": false,
                "sClass": "center"
            },
            {
                "sTitle": "Kode ",
                "mData": "kode",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "kode-" + oData.id;
                    $(nTd).attr("id", id);
                }
            },
            {
                "sTitle": "Jenis",
                "mData": "Jenis",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "jenis_id-" + oData.id;
                    $(nTd).attr("id", id);
                    $(nTd).editable(
                        "<?php echo site_url('admin/update_grid/k_item_inventory'); ?>?table=k_jenis_inventory", {
                            loadurl: "<?php echo site_url('admin/get_editable_select'); ?>?table=k_jenis_inventory&filds=nama&select=" +
                                oData.jenis_id,
                            type: "select",
                            submit: "OK",
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
                    $(nTd).html(oData.nama + " (" + oData.satuan + ")");
                    $(nTd).editable(
                        "<?php echo site_url('admin/update_grid/k_item_inventory'); ?>", {
                            "callback": function(sValue, y) {
                                /* Redraw the table from the new data on the server */
                                $("#tblData").dataTable().fnDraw();
                            }
                        });
                }
            },
            {
                "sTitle": "Foto",
                "mData": "foto",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "foto-" + oData.id;
                    $(nTd).attr("id", id);
                    if (oData.foto == null) {
                        htmlx =
                            "<div class='from-group'><img class='img-thumbnail' width='65' height='65' src='<?= base_url('asset/images/product/no-img.png'); ?>'></div>";
                        $(nTd).html(htmlx);
                    } else {
                        htmlx =
                            "<div class='from-group thumbnail'><img class='img-thumbnail'width='65' height='65' src='<?= base_url('asset/images/product/kuliner'); ?>/" +
                            oData.foto + "' alt='' ></div>";
                        $(nTd).html(htmlx);
                    }
                }
            },
            {
                "sTitle": "Edit",
                "mData": "id",
                "sClass": "center",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    $(nTd).html(
                        "<div class='btn-group'><button type='button' class='btn btn-xs bg-yellow mr-1'>Edit</button><button type='button' class='btn btn-xs bg-info'>Logo</button></div>"
                    );
                    $($(nTd).find('.btn-group').children()[0]).button().click(function() {
                        selectedId = oData.id;
                        $("#txtKdBarangE").val(oData.kode);
                        $("#txtNamaBarangE").val(oData.nama);
                        $("#txtDescBarangE").val(oData.deskripsi);
                        $("#txtMerekE").val(oData.merek);
                        $("#txtHargaBeliE").val(Globalize.format(oData.harga_beli,
                            "c"));
                        Globalize.format($("#txtHargaPenyusutanE").val(oData
                            .harga_penyusutan), "c");
                        Globalize.format($("#txtHargaDiskonE").val(oData.tanggal_beli),
                            "c");
                        $('#tab-Barang a[href="#EditBarang"]').trigger('click');
                        if (oData.satuan != false) {
                            $("#cmbSatuanE").val(oData.satuan);
                        }
                        $("#txtTglBeliE").val(oData.tanggal);
                        $("#txtTglExpierdE").val(oData.expierd);
                        divisiID = oData.jenis_id;
                        akunID = oData.akun_id;
                        $.get_data_divisi("#cmbJenisE");
                        $.get_data_akun("#cmbKdAkunE");
                    });
                    $($(nTd).find('.btn-group').children()[1]).button().click(function() {
                        selectedId = oData.id;
                        $('#dlg-edit-foto').modal('show');
                    });
                }
            }
        ]
    });
    $('#Add-Barang').click(function() {
        $('#add_data_barang')[0].reset();
        $.auto_number("k_item_inventory", "4", "#txtKdBarang");
        $.get_data_divisi("#cmbJenis");
        $.get_data_akun("#cmbKdAkun");
        $("#txtNamaBarang").focus();
    });
    $("#add_data_barang").submit(function(e) {
        e.preventDefault();
        if ($('#add_data_barang').valid()) {
            $('.load-Barang').append(
                '<div class="overlay"><i class="fas fa-2x fa-sync-alt fa-spin"></i></div>');
            $.ajax({
                type: "POST",
                dataType: 'json',
                url: "<?php echo site_url('admin/create/k_item_inventory'); ?>",
                data: {
                    kode: $("#txtKdBarang").val(),
                    barcode: $("#txtBarcode").val(),
                    nama: $("#txtNamaBarang").val(),
                    deskripsi: $("#txtDescBarang").val(),
                    merek: $("#txtMerek").val(),
                    satuan: $("#cmbSatuan option:selected").val(),
                    jenis_id: $("#cmbJenis option:selected").val(),
                    akun_id: $("#cmbKdAkun option:selected").val(),
                    harga_beli: Globalize.parseInt($("#txtHargaBeli").val()),
                    harga_penyusutan: Globalize.parseInt($("#txtHargaPenyusutan").val()),
                    tanggal: $("#txtTglBeli").val(),
                    expierd: $("#txtTglExpierd").val()
                },
                success: function(msg) {
                    if (msg.error == false) {
                        $('.load-Barang').find('.overlay').remove();
                        $('#add_data_barang')[0].reset();
                        $("#tblData").dataTable().fnDraw();
                        $.alert_swal('Data Barang', msg
                            .message, 'success');
                    } else {
                        $('.load-Barang').find('.overlay').remove();
                        $("#tblData").dataTable().fnDraw();
                        $.alert_swal_info('Data Barang', msg
                            .message, 'warning');
                    }
                }
            });
        }
    });
    $('#Edit-Barang').click(function() {
        if (!selectedId) {
            $.alert_swal('Edit Data Barang', 'Pilih Data Yang Akan di Edit', 'warning');
        } else {
            $("#submit_edit").show();
        }
    });
    $.get_data_divisi = function(tag) {
        $(tag).empty();
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "<?php echo site_url('admin/multi_select');?>?table=k_jenis_inventory",
            success: function(data) {
                if (data == '') {
                    $(tag).append("<option value=''> -- No Result -- </option>");
                } else {
                    $(tag).append(
                        "<option value=''> -- Silahkan Pilih -- </option>");
                    for (var i = 0; i < data.length; i++) {
                        $(tag).append("<option value='" + data[i].id + "'>" +
                            data[i].nama + "</option>");
                    }
                    if (divisiID != false) {
                        $(tag).val(divisiID);
                    }
                }
            }
        });
    }
    $.get_data_akun = function(tag) {
        $(tag).empty();
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "<?php echo site_url('admin/multi_select');?>?table=m_akun",
            success: function(data) {
                if (data == '') {
                    $(tag).append("<option value=''> -- No Result -- </option>");
                } else {
                    $(tag).append(
                        "<option value=''> -- Pilih Kode Akun -- </option>");
                    for (var i = 0; i < data.length; i++) {
                        $(tag).append("<option value='" + data[i].id + "'>" +
                            data[i].nama + "</option>");
                    }
                    if (akunID != false) {
                        $(tag).val(akunID);
                    }
                }
            }
        });
    }
    $("#submit_edit").hide();
    $('#edit_data_barang').submit(function(e) {
        e.preventDefault();
        if ($('#edit_data_barang').valid()) {
            $('.load-Barang').append(
                '<div class="overlay"><i class="fas fa-2x fa-sync-alt fa-spin"></i></div>');
            $.ajax({
                url: "<?php echo site_url('admin/update/k_item_inventory');?>",
                type: "post",
                dataType: "JSON",
                data: {
                    id: selectedId,
                    kode: $("#txtKdBarangE").val(),
                    nama: $("#txtNamaBarangE").val(),
                    deskripsi: $("#txtDescBarangE").val(),
                    satuan: $("#cmbSatuanE option:selected").val(),
                    jenis_id: $("#cmbJenisE option:selected").val(),
                    akun_id: $("#cmbKdAkunE option:selected").val(),
                    harga_beli: Globalize.parseInt($("#txtHargaBeliE").val()),
                    harga_penyusutan: Globalize.parseInt($("#txtHargaPenyusutanE").val()),
                    tahun_pembelian: $("#txtThnBeliE").val()
                },
                success: function(msg) {
                    if (msg.error == false) {
                        $('.load-Barang').find('.overlay').remove();
                        $('#edit_data_barang')[0].reset();
                        $.alert_swal('Upload Images', msg.message, 'success');
                    } else {
                        $.alert_swal_info('Upload Images', msg.message, 'warning');
                        $('.load-Barang').find('.overlay').remove();
                    }
                }
            });
        }
    });
    $('#edit-foto-prof').submit(function(e) {
        e.preventDefault();
        if ($('#edit-foto-prof').valid()) {
            $('.loading').append(
                '<div class="overlay text-center"><i class="fas fa-2x fa-sync-alt fa-spin"></i></div>'
            );
            try {
                if (selectedId) {
                    var confiq = {
                        id: $.base64.encode(selectedId),
                        sizeH: 100,
                        sizeW: 100,
                        tbL: "k_item_inventory",
                        path: "asset-images-inventory"
                    };
                    var fd = new FormData(document.getElementById("edit-foto-prof"));
                    var parsing = $.base64.encode(JSON.stringify(confiq));
                    parsing = parsing.replaceAll(".", "^");
                    parsing = parsing.replaceAll("+", "-");
                    parsing = parsing.replaceAll("/", "_");
                    $.ajax({
                        url: "<?php echo site_url('admin/edit_upload_foto');?>?data=" + parsing,
                        type: "post",
                        data: fd,
                        dataType: 'json',
                        processData: false,
                        contentType: false,
                        cache: false,
                        async: false,
                        success: function(msg) {
                            if (msg.error == false) {
                                $('.dropify-clear').click();
                                $("#edit-foto-prof")[0].reset();
                                $("#tblData").dataTable().fnDraw();
                                $('.loading').find('.overlay').remove();
                                $("#dlg-edit-foto").modal("hide");
                                $.alert_swal_info('Upload Images', msg.message, 'success');
                            } else {
                                $('.dropify-clear').click();
                                $("#edit-foto-prof")[0].reset();
                                $("#tblData").dataTable().fnDraw();
                                $('.loading').find('.overlay').remove();
                                $("#dlg-edit-foto").modal("hide");
                                $.alert_swal_info('Upload Images', msg.message, 'warning');
                            }
                        }
                    });
                }
            } catch (e) {

            }
        }
    });
    $.alert_swal = function($info, $message, $alert) {
        Swal.fire({
            icon: $alert,
            title: $info,
            text: $message,
            confirmButtonText: "OK",
            focusConfirm: true
        }).then((result) => {
            if (result.value) {
                $('#tab-Barang a[href="#DataBarang"]').trigger('click');
                $("#tblData").dataTable().fnDraw();
            }
        })
    }
});
</script>
<div class="col-md-12">
    <div class="card card-outline card-yellow load-Barang">
        <div class="card-header">
            <h3 class="card-title col-lg-4 col-sm-12 mb-2">Data Inventory</h3>
        </div>
        <div class="card-body ">
            <ul class="nav nav-pills" id="tab-Barang">
                <li class="nav-item" id="Data-Barang"><a class="nav-link active border-left" href="#DataBarang"
                        data-toggle="tab">Data Barang</a>
                </li>
                <li class="nav-item" id="Add-Barang"><a class="nav-link border-left" href="#AddBarang"
                        data-toggle="tab">Tambah Barang</a>
                </li>
                <li class="nav-item" id="Edit-Barang"><a class="nav-link border-left" href="#EditBarang"
                        data-toggle="tab">Edit Barang</a>
                </li>
            </ul>
            <hr>
            <div class="tab-content">
                <div class="active tab-pane" id="DataBarang">
                    <div class="callout callout-info">
                        <div class="table-responsive">
                            <table table id="tblData" class="table table-bordered table-striped"></table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="AddBarang">
                    <!-- Tambah Barang -->
                    <div class="callout callout-info">
                        <div class="row">
                            <div class="col-lg-12">
                                <form id="add_data_barang">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Kode Barang</label>
                                                <input type="text" id="txtKdBarang" disabled="disabled" maxlength="3"
                                                    class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Jenis</label>
                                                <select id="cmbJenis" class="form-control" required>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Nama Barang</label>
                                                <input type="text" id="txtNamaBarang" maxlength="100"
                                                    class="form-control" onfocus required>
                                            </div>
                                            <div class="form-group">
                                                <label>Satuan</label>
                                                <select id="cmbSatuan" class="form-control" required>
                                                    <option value="">-- Pilih Satuan Barang --</option>
                                                    <option value="Pcs">Pcs</option>
                                                    <option value="Box">Box</option>
                                                    <option value="Unit">Unit</option>
                                                    <option value="Buah">Buah</option>
                                                    <option value="Galon">Galon</option>
                                                    <option value="Gram">Gram</option>
                                                    <option value="Kg">Kilo</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Merek</label>
                                                <input type="text" id="txtMerek" maxlength="100" class="form-control"
                                                    required>
                                            </div>
                                            <div class="form-group">
                                                <label>Deskripsi</label>
                                                <textarea type="text" id="txtDescBarang" class="form-control" required>
                                                </textarea>
                                            </div>

                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Kode Akuntansi</label>
                                                <select id="cmbKdAkun" class="form-control" required>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="txtHargaBeli" class="col-form-label">Harga Beli</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" maxlength="20"
                                                        id="txtHargaBeli" onfocus="$.format_text(this);" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="txtHargaPenyusutan" class="col-form-label">Harga Penyustuan
                                                    (x %)</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" maxlength="20"
                                                        id="txtHargaPenyusutan" onfocus="$.format_text(this);" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <label for="txtTglBeli" class="col-form-label">Tanggal
                                                            Pembelian</label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" maxlength="35"
                                                                id="txtTglBeli" required>
                                                            <span class="input-group-append">
                                                                <button type="button"
                                                                    class="btn btn-dark btn-flat btn-views1"><i
                                                                        class="fas fa-calendar"></i></button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label for="txtTglExpierd"
                                                            class="col-form-label">Expierd</label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" maxlength="35"
                                                                id="txtTglExpierd" required>
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
                                                <button type="submit"
                                                    class="btn btn-primary float-right">Simpan</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="EditBarang">
                    <!-- Edit Barang -->
                    <div class="callout callout-info">
                        <form class="form-horizontal" id="edit_data_barang">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Kode Barang</label>
                                        <input type="text" id="txtKdBarangE" disabled="disabled" maxlength="3"
                                            class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Jenis</label>
                                        <select id="cmbJenisE" class="form-control" required>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Barang</label>
                                        <input type="text" id="txtNamaBarangE" maxlength="100" class="form-control"
                                            onfocus required>
                                    </div>
                                    <div class="form-group">
                                        <label>Satuan</label>
                                        <select id="cmbSatuanE" class="form-control" required>
                                            <option value="">-- Pilih Satuan Barang --</option>
                                            <option value="Pcs">Pcs</option>
                                            <option value="Box">Box</option>
                                            <option value="Unit">Unit</option>
                                            <option value="Buah">Buah</option>
                                            <option value="Galon">Galon</option>
                                            <option value="Gram">Gram</option>
                                            <option value="Kg">Kilo</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Merek</label>
                                        <input type="text" id="txtMerekE" maxlength="100" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Deskripsi</label>
                                        <textarea type="text" id="txtDescBarangE" class="form-control" required>
                                                </textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Kode Akuntansi</label>
                                        <select id="cmbKdAkunE" class="form-control" required>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="txtHargaBeliE" class="col-form-label">Harga Beli</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" maxlength="20" id="txtHargaBeliE"
                                                onfocus="$.format_text(this);" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="txtHargaPenyusutanE" class="col-form-label">Harga Penyustuan
                                            (x %)</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" maxlength="20"
                                                id="txtHargaPenyusutanE" onfocus="$.format_text(this);" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label for="txtTglBeliE" class="col-form-label">Tanggal
                                                    Pembelian</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" maxlength="35"
                                                        id="txtTglBeliE" required>
                                                    <span class="input-group-append">
                                                        <button type="button"
                                                            class="btn btn-dark btn-flat btn-views1"><i
                                                                class="fas fa-calendar"></i></button>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="txtTglExpierdE" class="col-form-label">Expierd</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" maxlength="35"
                                                        id="txtTglExpierdE">
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
                                        <div class="col-sm-12">
                                            <hr>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" required> I agree to the <a href="#">terms
                                                        and
                                                        conditions</a>
                                                </label>
                                                <button type="submit" id="submit_edit"
                                                    class="btn btn-danger float-right">Submit</button>
                                            </div>
                                        </div>
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
<div id="dlg-edit-foto" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content modal-col-light-blue loading">
            <div class="modal-header">
                <h4 id="dlg-edit-foto-Label" class="modal-title">Form Edit</h4>
            </div>
            <div class="modal-body ">
                <div class="card card-primary">
                    <div class="card-header">
                        <p>Edit Gambar</p>
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