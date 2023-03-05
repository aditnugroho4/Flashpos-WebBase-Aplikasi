<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<script type="text/javascript">
var fildeselect;
var active;
var eleFocus = '';
var divisiID;
var akunID;
$(document).ready(function() {
    Globalize.culture("id-ID");
    $('.mn-4').addClass('bg-brown');
    $('.dropify').dropify({
        messages: {
            default: 'Kembali Ke asal..',
            replace: 'Ganti file Atau Gambar',
            remove: 'Hapus',
            error: 'Ada Kesalahan Saat Upload File atau gambar..!'
        }
    });
    $("#tblData").dataTable({
        "bJQueryUI": true,
        "bAutoWidth": false,
        "bProcessing": true,
        "iDisplayLength": 10,
        "aLengthMenu": [10, 20, 50, 100],
        "bServerSide": true,
        "sPaginationType": "full_numbers",
        "sAjaxSource": "<?php echo site_url('admin/get_data_table_source'); ?>?table=b_product_paket&columns=,nama,harga,margin,discount,price",
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
                    $(nTd).editable(
                        "<?php echo site_url('admin/update_grid/b_product_paket'); ?>", {
                            "callback": function(sValue, y) {
                                /* Redraw the table from the new data on the server */
                                $("#tblData").dataTable().fnDraw();
                            }
                        });
                }
            },
            {
                "sTitle": "Deskripsi",
                "mData": "deskripsi",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "deskripsi-" + oData.id;
                    $(nTd).attr("id", id);
                    $(nTd).editable(
                        "<?php echo site_url('admin/update_grid/b_product_paket'); ?>", {
                            "callback": function(sValue, y) {
                                /* Redraw the table from the new data on the server */
                                $("#tblData").dataTable().fnDraw();
                            }
                        });
                }
            },
            {
                "sTitle": "Harga Dasar",
                "mData": "harga",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "harga-" + oData.id;
                    $(nTd).attr("id", id);
                },
                "mRender": function(data, type, full) {
                    if (data != null) {
                        return Globalize.format(Globalize.parseInt(data), "c");
                    } else {
                        return 0;
                    }
                }
            },
            {
                "sTitle": "Margin Of",
                "mData": "margin",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "margin-" + oData.id;
                    $(nTd).attr("id", id);
                },
                "mRender": function(data, type, full) {
                    if (data != null) {
                        return data + "%";
                    } else {
                        return 0;
                    }
                }
            },
            {
                "sTitle": "Price",
                "mData": "price",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "price-" + oData.id;
                    $(nTd).attr("id", id);
                },
                "mRender": function(data, type, full) {
                    if (data != null) {
                        return Globalize.format(Globalize.parseInt(data), "c");
                    } else {
                        return 0;
                    }
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
                "sTitle": "Status",
                "sClass": "text-center",
                "mData": null,
                "bSortable": false,
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "status-" + oData.id;
                    $(nTd).attr("id", id);
                    fildeselect = "status";
                    if (oData.status == 'Y') {
                        htmlx =
                            "<button class='btn btn-xs bg-green'><i class='fas fa-check'></i></button>";
                        $(nTd).html(htmlx);
                        $($(nTd).children()[0]).button().click(function() {
                            selectedId = oData.id;
                            active = 'N';
                            $("#txtAlert").html("Menu ini akan di non aktive..?");
                            $("#dlgAlert").modal("show")
                        });
                    } else if (oData.status == 'N' || oData.status == null) {

                        htmlx =
                            "<button class='btn btn-xs bg-danger'><i class='fa fa-ban'></i></button>";
                        $(nTd).html(htmlx);
                        $($(nTd).children()[0]).button().click(function() {
                            selectedId = oData.id;
                            active = 'Y';
                            $("#txtAlert").html("Menu ini akan di aktive kan..?");
                            $("#dlgAlert").modal("show");
                        });
                    }
                }
            },
            {
                "sTitle": "Edit",
                "mData": "id",
                "sClass": "center",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    $(nTd).html(
                        "<div class='btn-group'><button type='button' class='btn btn-xs bg-yellow mr-1'>Edit</button><button type='button' class='btn btn-xs bg-info'>Foto</button></div>"
                    );
                    $($(nTd).find('.btn-group').children()[0]).button().click(function() {
                        selectedId = oData.id;
                        $("#txtKdBarangE").val(oData.kode);
                        $("#txtNamaBarangE").val(oData.nama);
                        $("#txtDescBarangE").val(oData.deskripsi);
                        $("#txtHargaModalE").val(Globalize.format(oData.harga,
                            "c"));
                        $("#txtMarginE").val(Globalize.format(oData.margin, "c"));
                        $("#txtProfitE").val(Globalize.format(oData.profit, "c"));
                        $("#txtPriceE").val(Globalize.format(oData.price, "c"));
                        $('#tab-Barang a[href="#EditBarang"]').trigger('click');
                        if (oData.satuan != false) {
                            $("#cmbSatuanE").val(oData.satuan);
                        }
                        divisiID = oData.grup_id;
                        akunID = oData.akun_id;
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
        $.auto_number("b_product_paket", "4", "#txtKdBarang");
        $.get_data_akun("#cmbKdAkun");
        $("#txtNamaBarang").focus();
        Edit = false;
    });
    $("#add_data_barang").submit(function(e) {
        e.preventDefault();
        if ($('#add_data_barang').valid()) {
            $('.load-Barang').append(
                '<div class="overlay"><i class="fas fa-2x fa-sync-alt fa-spin"></i></div>');
            $.ajax({
                type: "POST",
                dataType: 'json',
                url: "<?php echo site_url('admin/create/b_product_paket'); ?>",
                data: {
                    kode: $("#txtKdBarang").val(),
                    nama: $("#txtNamaBarang").val(),
                    deskripsi: $("#txtDescBarang").val(),
                    satuan: $("#cmbSatuan option:selected").val(),
                    grup_id: $("#cmbJenis option:selected").val(),
                    akun_id: $("#cmbKdAkun option:selected").val(),
                    harga_dasar: Globalize.parseInt($("#txtHargaDasar").val()),
                    harga_jual: Globalize.parseInt($("#txtHargaJual").val()),
                    harga_diskon: Globalize.parseInt($("#txtHargaDiskon").val())
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
    $.hitung_margin = function(element) {
        var textBoxM = "#txtHargaModal";
        var textBoxP = "#txtProfit";
        var textBoxH = "#txtPrice";
        if (Edit == true) {
            textBoxM = "#txtHargaModalE";
            textBoxP = "#txtProfitE";
            textBoxH = "#txtPriceE";
        }
        $(element).keyup(function(event) {
            if ($(this).val().length > 0) {
                let harga = Globalize.parseInt($(textBoxH).val());
                let profit = Math.round(harga * (Globalize.parseFloat($(this).val()) / 100.0 ));
                if (!isNaN(profit)) {
                    $(textBoxP).val(Globalize.format(profit,"c"));
                    let modal =  harga - profit;
                    if (!isNaN(modal)) {
                        $(textBoxM).val(Globalize.format(modal,"c"));
                    }
                } else {
                    $(this).val('');
                    $(this).focus();
                }
            }
            return false;
        });
        $(element).click(function(event) {
            if ($(this).val().length > 0) {
                let harga = Globalize.parseInt($(textBoxH).val());
                let profit = Math.round(harga * (Globalize.parseFloat($(this).val()) / 100.0 ));
                if (!isNaN(profit)) {
                    $(textBoxP).val(Globalize.format(profit,"c"));
                    let modal =  harga - profit;
                    if (!isNaN(modal)) {
                        $(textBoxM).val(Globalize.format(modal,"c"));
                    }
                } else {
                    $(this).val('');
                    $(this).focus();
                }

            }
            return false;
        });
    }
    $('#Edit-Barang').click(function() {
        if (!selectedId) {
            $.alert_swal('Edit Data Barang', 'Pilih Data Yang Akan di Edit', 'warning');
        } else {
            Edit = true;
            $("#submit_edit").show();
        }
    });
    $.get_data_divisi = function(tag) {
        $(tag).empty();
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "<?php echo site_url('admin/multi_select');?>?table=b_product_grup",
            success: function(data) {
                if (data == '') {
                    $(tag).append("<option value=''> -- No Result -- </option>");
                } else {
                    $(tag).append(
                        "<option value=''> -- Pilih Jenis Items-- </option>");
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
                url: "<?php echo site_url('admin/update/b_product_paket');?>",
                type: "post",
                dataType: "JSON",
                data: {
                    id: selectedId,
                    kode: $("#txtKdBarangE").val(),
                    nama: $("#txtNamaBarangE").val(),
                    deskripsi: $("#txtDescBarangE").val(),
                    satuan: $("#cmbSatuanE option:selected").val(),
                    grup_id: $("#cmbJenisE option:selected").val(),
                    akun_id: $("#cmbKdAkunE option:selected").val(),
                    harga: Globalize.parseInt($("#txtHargaModalE").val()),
                    margin: $("#txtMarginE").val(),
                    profit: Globalize.parseInt($("#txtProfitE").val()),
                    price: Globalize.parseInt($("#txtPriceE").val())
                },
                success: function(msg) {
                    if (msg.error == false) {
                        $('.load-Barang').find('.overlay').remove();
                        $('#edit_data_barang')[0].reset();
                        Edit = false;
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
                        tbL: "b_product_paket",
                        path: "asset-images-product-kuliner"
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
    $('#btnChange').button().click(function() {
        $.ajax({
            url: "<?php echo site_url('admin/aktive/b_product_paket'); ?>/" + fildeselect +
                "/" +
                selectedId + "/" + active,
            success: function(data) {
                $("#tblData").dataTable().fnDraw();
                $("#dlgAlert").modal("hide");
            }
        });
    });
});
</script>
<div class="col-md-12">
    <div class="card card-outline card-yellow load-Barang">
        <div class="card-header">
            <h3 class="card-title col-lg-4 col-sm-12 mb-2">Data Items Paket</h3>
        </div>
        <div class="card-body ">
            <ul class="nav nav-pills" id="tab-Barang">
                <li class="nav-item" id="Data-Barang"><a class="nav-link active border-left" href="#DataBarang"
                        data-toggle="tab">Data
                        Paket</a>
                </li>
                <li class="nav-item" id="Add-Barang"><a class="nav-link border-left" href="#AddBarang"
                        data-toggle="tab">Tambah Paket</a>
                </li>
                <li class="nav-item" id="Edit-Barang"><a class="nav-link border-left" href="#EditBarang"
                        data-toggle="tab">Edit Paket</a>
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
                                                <label>Kode Paket</label>
                                                <input type="text" id="txtKdBarang" disabled="disabled" maxlength="3"
                                                    class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Nama Paket</label>
                                                <input type="text" id="txtNamaBarang" maxlength="100"
                                                    class="form-control" onfocus required>
                                            </div>
                                            <div class="form-group">
                                                <label>Satuan</label>
                                                <select id="cmbSatuan" class="form-control" required>
                                                    <option value="">-- Pilih --</option>
                                                    <option value="Set">Paket</option>
                                                    <option value="Set">Set</option>
                                                    <option value="Event">Event</option>
                                                    <option value="Hari">Hari</option>
                                                    <option value="Prosesi">Prosesi</option>
                                                </select>
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
                                                <div class="row">
                                                <div class="col-sm-6">
                                                        <label for="txtPrice" class="col-form-label">Price</label>
                                                        <div class="input-group">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text">Rp</span>
                                                            </div>
                                                            <input type="text" class="form-control" maxlength="35"
                                                                id="txtPrice" onfocus="$.format_text(this);" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label for="txtMargin" class="col-form-label">Margin Of</label>
                                                        <div class="input-group">
                                                            <input type="numeric" class="form-control"
                                                                onfocus="$.hitung_margin(this);" maxlength="3"
                                                                id="txtMargin" required>
                                                            <div class="input-group-append">
                                                                <span class="input-group-text">%</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <label for="txtProfit" class="col-form-label">Profit</label>
                                                        <div class="input-group">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text">Rp</span>
                                                            </div>
                                                            <input type="text" class="form-control" maxlength="35"
                                                                id="txtProfit" disabled="disabled" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label for="txtHargaModal" class="col-form-label">Harga
                                                            Modal</label>
                                                        <div class="input-group">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text">Rp</span>
                                                            </div>
                                                            <input type="text" class="form-control" maxlength="20"
                                                                id="txtHargaModal" disabled="disabled" 
                                                                required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <b>Rumus: <i>Price=(Harga Modal * Margin%)+Keuntungan</i></b>
                                                <hr>
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
                                        <label>Kode Paket</label>
                                        <input type="text" id="txtKdBarangE" disabled="disabled" maxlength="3"
                                            class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Paket</label>
                                        <input type="text" id="txtNamaBarangE" maxlength="100" class="form-control"
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <label>Satuan</label>
                                        <select id="cmbSatuanE" class="form-control" required>
                                            <option value="">-- Pilih --</option>
                                            <option value="Set">Paket</option>
                                            <option value="Set">Set</option>
                                            <option value="Event">Event</option>
                                            <option value="Hari">Hari</option>
                                            <option value="Prosesi">Prosesi</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Deskripsi</label>
                                        <textarea type="text" id="txtDescBarangE" class="form-control"
                                            required></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Kode Akuntansi</label>
                                        <select id="cmbKdAkunE" class="form-control" required>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                        <div class="col-sm-6">
                                                <label for="txtPriceE" class="col-form-label">Price</label>
                                                <div class="input-group">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">Rp</span>
                                                    </div>
                                                    <input type="text" class="form-control" maxlength="35"
                                                        id="txtPriceE"  onfocus="$.format_text(this);" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="txtMarginE" class="col-form-label">Margin Of</label>
                                                <div class="input-group">
                                                    <input type="numeric" class="form-control"
                                                        onfocus="$.hitung_margin(this);" maxlength="3" id="txtMarginE"
                                                        required>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">%</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label for="txtProfitE" class="col-form-label">Profit</label>
                                                <div class="input-group">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">Rp</span>
                                                    </div>
                                                    <input type="text" class="form-control" maxlength="35"
                                                        id="txtProfitE" disabled="disabled" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="txtHargaModalE" class="col-form-label">Harga
                                                    Modal</label>
                                                <div class="input-group">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">Rp</span>
                                                    </div>
                                                    <input type="text" class="form-control" maxlength="20"
                                                        id="txtHargaModalE" disabled="disabled" required>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <b>Rumus: <i>Price=(Harga Modal * Margin%)+Keuntungan</i></b>
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
<div id="dlgAlert" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-col-light-blue ">
            <div class="modal-header">
                <h4 class="modal-title">Warning...</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="txtAlert"></p>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnChange" class="btn bg-green waves-effect">Setuju</button>
                <button type="button" class="btn btn-warning waves-effect" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>