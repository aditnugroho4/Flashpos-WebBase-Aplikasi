<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<script type="text/javascript">
var fildeselect;
var active;
var eleFocus = '';
var divisiID;
var akunID;
$(document).ready(function() {
    Globalize.culture("id-ID");
    $('.mn-1').addClass('bg-brown');
    $("#tblData").dataTable({
        "bJQueryUI": true,
        "bAutoWidth": false,
        "bProcessing": true,
        "iDisplayLength": 10,
        "aLengthMenu": [10, 20, 50, 100],
        "bServerSide": true,
        "sPaginationType": "full_numbers",
        "sAjaxSource": "<?php echo site_url('admin/get_data_table_source'); ?>?table=k_stock_bahan&columns=,k_stock_bahan.kode,k_stock_bahan.nama,deskripsi,grup_id&jwhere=grup_id&fildjoins=,k_grup_barang.nama AS Grup&joins=k_grup_barang&exports=k_grup_barang",
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
                "sTitle": "Nama",
                "mData": "nama",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "nama-" + oData.id;
                    $(nTd).attr("id", id);
                    $(nTd).html(oData.nama);
                }
            },
            {
                "sTitle": "Volume",
                "mData": "volume",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "volume-" + oData.id;
                    $(nTd).attr("id", id);
                    $(nTd).html(oData.volume + " (" + oData.satuan + ")");
                }
            },
            {
                "sTitle": "Persaji",
                "mData": "sajian",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "sajian-" + oData.id;
                    $(nTd).attr("id", id);
                }
            },
            {
                "sTitle": "Departemen",
                "mData": "Grup",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "grup_id-" + oData.id;
                    $(nTd).attr("id", id);
                }
            },
            {
                "sTitle": "Stock",
                "mData": "stock",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "stock-" + oData.id;
                    $(nTd).attr("id", id);
                }
            },
            {
                "sTitle": "Edit",
                "mData": "id",
                "sClass": "center",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    $(nTd).html(
                        "<div class='btn-group'><button type='button' class='btn btn-xs bg-yellow mr-1'>Edit</button></div>"
                    );
                    $($(nTd).find('.btn-group').children()[0]).button().click(function() {
                        selectedId = oData.id;
                        divisiID = oData.grup_id;
                        $.get_data_divisi("#cmbGrupE");
                        $("#txtKdBahanE").val(oData.kode);
                        $("#txtNamaBarangE").val(oData.nama);
                        $("#txtDescBarangE").val(oData.deskripsi);
                        $("#txtSajianE").val(oData.sajian);
                        $("#txtVolumeE").val(oData.volume);
                        if (oData.satuan != false) {
                            $("#cmbSatuanE").val(oData.satuan);
                        }
                        $("#txtTglBeliE").val(oData.tanggal);
                        $("#txtExpierdE").val(oData.expierd);
                        $('#tab-Barang a[href="#EditBarang"]').trigger('click');

                    });
                }
            }
        ]
    });
    $('#Add-Barang').click(function() {
        $('#add_data_barang')[0].reset();
        $.auto_number("k_stock_bahan", "4", "#txtKdBahan");
        $.get_data_divisi("#cmbGrup");
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
                url: "<?php echo site_url('admin/create/k_stock_bahan'); ?>",
                data: {
                    kode: $("#txtKdBahan").val(),
                    grup_id: $("#cmbGrup option:selected").val(),
                    nama: $("#txtNamaBarang").val(),
                    volume: $("#txtVolume").val(),
                    satuan: $("#cmbSatuan option:selected").val(),
                    sajian: $("#txtSajian").val(),
                    deskripsi: $("#txtDescBarang").val(),
                    expierd: $("#txtExpierd").val()
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
            url: "<?php echo site_url('admin/multi_select');?>?table=k_grup_barang",
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
    $("#submit_edit").hide();
    $('#edit_data_barang').submit(function(e) {
        e.preventDefault();
        if ($('#edit_data_barang').valid()) {
            $('.load-Barang').append(
                '<div class="overlay"><i class="fas fa-2x fa-sync-alt fa-spin"></i></div>');
            $.ajax({
                url: "<?php echo site_url('admin/update/k_stock_bahan');?>",
                type: "post",
                dataType: "JSON",
                data: {
                    id: selectedId,
                    grup_id: $("#cmbGrupE option:selected").val(),
                    nama: $("#txtNamaBarangE").val(),
                    volume: $("#txtVolumeE").val(),
                    satuan: $("#cmbSatuanE option:selected").val(),
                    sajian: $("#txtSajianE").val(),
                    deskripsi: $("#txtDescBarangE").val(),
                    expierd: $("#txtExpierdE").val()
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
    $.alert_swal = function($info, $message, $alert) {
        Swal.fire({
            icon: $alert,
            title: $info,
            text: $message,
            confirmButtonText: "OK",
            focusConfirm: true
        }).then((result) => {
            if (result.value) {
                $('#tab-Barang a[href="#DataBahan"]').trigger('click');
                $("#tblData").dataTable().fnDraw();
            }
        })
    }
});
</script>
<div class="col-md-12">
    <div class="card card-outline card-yellow load-Barang">
        <div class="card-header">
            <h3 class="card-title col-lg-4 col-sm-12 mb-2">Data Bahan Baku</h3>
        </div>
        <div class="card-body ">
            <ul class="nav nav-pills" id="tab-Barang">
                <li class="nav-item" id="Data-Barang"><a class="nav-link active border-left" href="#DataBahan"
                        data-toggle="tab">Data Bahan</a>
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
                <div class="active tab-pane" id="DataBahan">
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
                                                <label>Kode Bahan</label>
                                                <input type="text" id="txtKdBahan" disabled="disabled" maxlength="3"
                                                    class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Department</label>
                                                <select id="cmbGrup" class="form-control" required></select>
                                            </div>
                                            <div class="form-group">
                                                <label>Nama Barang</label>
                                                <input type="text" id="txtNamaBarang" maxlength="100"
                                                    class="form-control" onfocus required>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <label for="txtVolume" class="col-form-label">Volume</label>
                                                        <div class="input-group">
                                                            <input type="numeric" class="form-control" maxlength="3"
                                                                id="txtVolume" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Gramasi</label>
                                                            <select id="cmbSatuan" class="form-control" required>
                                                                <option value="">-- Pilih --</option>
                                                                <option value="Pcs">Pcs</option>
                                                                <option value="Box">Box</option>
                                                                <option value="Unit">Unit</option>
                                                                <option value="Buah">Buah</option>
                                                                <option value="Galon">Galon</option>
                                                                <option value="Gram">Gram</option>
                                                                <option value="Kg">Kilo</option>
                                                                <option value="Liter">Liter</option>
                                                                <option value="Ml">Ml</option>
                                                                <option value="Cc">Cc</option>
                                                                <option value="Cup">Cup</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <label for="txtSajian" class="col-form-label">Jumlah
                                                            Saji</label>
                                                        <div class="input-group">
                                                            <input type="numeric" class="form-control" maxlength="3"
                                                                id="txtSajian" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label for="txtExpierd" class="col-form-label">Expierd</label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" maxlength="2"
                                                                id="txtExpierd" required>
                                                            <span class="input-group-append">
                                                                <button type="button"
                                                                    class="btn btn-dark btn-flat btn-views2">hari <i
                                                                        class="fas fa-calendar"></i></button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="txtDescBarang" class="col-form-label">Deskripsi</label>
                                                <textarea type="text" id="txtDescBarang" class="form-control" required>
                                                </textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="card-footer">
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
                                        <label>Kode Bahan</label>
                                        <input type="text" id="txtKdBahanE" disabled="disabled" maxlength="3"
                                            class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Department</label>
                                        <select id="cmbGrupE" class="form-control" required></select>
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Barang</label>
                                        <input type="text" id="txtNamaBarangE" maxlength="100" class="form-control"
                                            onfocus required>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label for="txtVolumeE" class="col-form-label">Volume</label>
                                                <div class="input-group">
                                                    <input type="numeric" class="form-control" maxlength="3"
                                                        id="txtVolumeE" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Gramasi</label>
                                                    <select id="cmbSatuanE" class="form-control" required>
                                                        <option value="">-- Pilih --</option>
                                                        <option value="Pcs">Pcs</option>
                                                        <option value="Box">Box</option>
                                                        <option value="Unit">Unit</option>
                                                        <option value="Buah">Buah</option>
                                                        <option value="Galon">Galon</option>
                                                        <option value="Gram">Gram</option>
                                                        <option value="Kg">Kilo</option>
                                                        <option value="Liter">Liter</option>
                                                        <option value="Ml">Ml</option>
                                                        <option value="Cc">Cc</option>
                                                        <option value="Cup">Cup</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label for="txtSajianE" class="col-form-label">Jumlah
                                                    Saji</label>
                                                <div class="input-group">
                                                    <input type="numeric" class="form-control" maxlength="3"
                                                        id="txtSajianE" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="txtExpierdE" class="col-form-label">Expierd</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" maxlength="2"
                                                        id="txtExpierdE" required>
                                                    <span class="input-group-append">
                                                        <button type="button"
                                                            class="btn btn-dark btn-flat btn-views2">hari <i
                                                                class="fas fa-calendar"></i></button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="txtDescBarangE" class="col-form-label">Deskripsi</label>
                                        <textarea type="text" id="txtDescBarangE" class="form-control" required>
                                                </textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary float-right">Simpan</button>
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