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
        "sAjaxSource": "<?php echo site_url('admin/get_data_table_source'); ?>?table=b_customer_list&columns=,name,alamat,contact,email",
        "aoColumns": [{
                "sTitle": "#",
                "mData": "no",
                "bSortable": false,
                "sClass": "center"
            },
            {
                "sTitle": "Customer ID",
                "mData": "kode",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "kode-" + oData.id;
                    $(nTd).attr("id", id);
                }
            },
            {
                "sTitle": "Name",
                "mData": "name",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "name-" + oData.id;
                    $(nTd).attr("id", id);
                }
            },
            {
                "sTitle": "Event Date",
                "mData": "event_date",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "event_date-" + oData.id;
                    $(nTd).attr("id", id);
                }
            },
            {
                "sTitle": "Address",
                "mData": "alamat",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "alamat-" + oData.id;
                    $(nTd).attr("id", id);
                }
            },
            {
                "sTitle": "Contact",
                "mData": "contact",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "contact-" + oData.id;
                    $(nTd).attr("id", id);
                }
            },
            {
                "sTitle": "Status",
                "mData": "status",
                "sClass": "text-center",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "status-" + oData.id;
                    $(nTd).html(
                        "<div class='btn-group'><div class='btn btn-sm btn-info'><i class='fas fa-bell'></i> <span></span></div></div>"
                    );
                    if (oData.status == null) {
                        $($(nTd).children()[0]).find("span").html("&nbsp;Permohonan");
                    } else if (oData.status == 'B') {
                        $($(nTd).children()[0]).find("div").attr("class",
                            "btn btn-sm btn-warning");
                        $($(nTd).children()[0]).find("i").html("&nbsp;Booking");
                    } else if (oData.status == 'Y') {
                        $($(nTd).children()[0]).find("div").attr("class",
                            "btn btn-sm btn-success");
                        $($(nTd).children()[0]).find("span").html("&nbsp;Selesai");
                    } else if (oData.status == 'N') {
                        $($(nTd).children()[0]).find("div").attr("class",
                            "btn btn-sm btn-brown");
                        $($(nTd).children()[0]).find("span").html("&nbsp; Batal");
                    }
                }
            },
            {
                "sTitle": "Action",
                "mData": "id",
                "sClass": "text-center",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    $(nTd).html(
                        "<div class='btn-group'><button type='button' class='btn btn-xs bg-yellow mr-1'>Pilih</button></div>"
                    );
                    $($(nTd).find('.btn-group').children()[0]).button().click(function() {
                        selectedId = oData.id;

                    });
                }
            }
        ]
    });
    $('#Add-Barang').click(function() {
        $('#add_data_barang')[0].reset();
        $.auto_number("b_customer_list", "4", "#txtKdBarang");
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
                url: "<?php echo site_url('admin/create/b_customer_list'); ?>",
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
    $('#Edit-Tamu').click(function() {
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
                url: "<?php echo site_url('admin/update/b_customer_list');?>",
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
                        tbL: "b_customer_list",
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
                $('#tab-Barang a[href="#DataTamu"]').trigger('click');
                $("#tblData").dataTable().fnDraw();
            }
        })
    }
});
</script>
<div class="col-md-12">
    <div class="card card-outline card-yellow load-Barang">
        <div class="card-header">
            <h3 class="card-title col-lg-4 col-sm-12 mb-2">Guest List</h3>
        </div>
        <div class="card-body ">
            <ul class="nav nav-pills" id="tab-Barang">
                <li class="nav-item" id="Data-Tamu"><a class="nav-link active border-left" href="#DataTamu"
                        data-toggle="tab">Data Tamu</a>
                </li>
                <li class="nav-item" id="Booking-Event"><a class="nav-link border-left" href="#BookingEvent"
                        data-toggle="tab">Booking</a>
                </li>
                <li class="nav-item" id="Billing-Kasir"><a class="nav-link border-left" href="#Billing"
                        data-toggle="tab">Billing</a>
                </li>
                <li class="nav-item" id="Invoice-Kasir"><a class="nav-link border-left" href="#Invoice"
                        data-toggle="tab">Invoice</a>
                </li>
            </ul>
            <hr>
            <div class="tab-content">
                <div class="active tab-pane" id="DataTamu">
                    <div class="callout callout-info">
                        <div class="table-responsive">
                            <table table id="tblData" class="table table-bordered table-striped"></table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="BookingEvent">
                    <div class="callout callout-info">
                    <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label for="Customerid" class="col-form-label">Customer Id</label>
                                                    <input type="text" class="form-control" disabled="disabled"
                                                            id="txtCustomerid"  required>
                                                </div>
                                                <div class="col-sm-8">
                                                    <label class="col-form-label">Customer Name</label>
                                                    <input type="text" id="txtCustomer" disabled="disabled" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                            <div class="form-group">
                                                <label>Product</label>
                                                <select id="cmbProduct" class="form-control" required>
                                                    <option value="">-- Pilih --</option>
                                                </select>
                                            </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                                <label>Event Name</label>
                                                <select id="cmbEventName" class="form-control" required>
                                                    <option value="">-- Pilih --</option>
                                                </select>
                                            </div>
                                        <div class="form-group">
                                                <label>Event Date</label>
                                                <input type="text" id="txtEventDate" maxlength="100" class="form-control" onfocus required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class=" tab-pane" id="Billing">
                    <!-- Blank -->
                </div>
                <div class=" tab-pane" id="Invoice">
                    <div class="callout callout-info">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <table style="width:100%">
                                            <tr></tr>
                                            <tr>
                                                <td>Jl. Raya Kencana, Mekarwangi, Kec. Tanah Sereal,</td>
                                            </tr>
                                            <tr>
                                                <td>Kota Bogor, Jawa Barat 16168</td>
                                            </tr>
                                            <tr>
                                                <td>+6285780555092</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="float-right">
                                            <img width="180" src="<?= base_url()?>asset/admin/dist/img/icon-2.png"
                                                alt="Logo">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="border bg-brown mt-2">
                                    <h3 class="ml-3">INVOICE</h3>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <table style="width:100%">
                                    <tr>
                                        <td width="20%"><b>DATE</b> </td>
                                        <td width="40%"><b>BILL TO </b></td>
                                        <td width="40%"><b>INSTRUCTIONS</b></td>
                                    </tr>
                                    <tr>
                                        <td>2022-01-01</td>
                                        <td>Untuk Dirimu Yang masih lajang Dan ingin Bercinta</td>
                                        <td>Wire transfer to MANDIRI 1330013516133 a/n Ari Akbar</td>
                                    </tr>
                                    <tr>
                                        <td><b>Package:</b></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>PAKET GEDUNG NON CATERING</td>
                                        <td></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-lg-12">
                                <table style="width:100%" class="border">
                                    <tr class="border bg-brown">
                                        <td width="10%"><b>Qty</b> </td>
                                        <td width="50%"><b>Deskripsi</b></td>
                                        <td width="20%"><b>Price</b></td>
                                        <td width="20%"><b>Jumlah</b></td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>Untuk Dirimu Yang masih lajang Dan ingin Bercinta</td>
                                        <td>Rp.25000</td>
                                        <td>Rp.50000</td>
                                    </tr>
                                </table>
                                <table style="width:100%">
                                    <tr colspan="2">
                                        <td class="text-right" style="width:50%;">Item's</td>
                                        <td class="text-right">1</td>
                                    </tr>
                                    <tr colspan="2">
                                        <td class="text-right" style="width:50%;">Sub Total</td>
                                        <td class="currency text-right">1</td>
                                    </tr>
                                    <tr colspan="2">
                                        <td class="text-right" style="width:50%;">Diskon</td>
                                        <td class="currency text-right">1</td>
                                    </tr>
                                    <tr colspan="2">
                                        <td class="text-right" style="width:50%;">Total</td>
                                        <td class="currency text-right">1</td>
                                    </tr>
                                    <tr colspan="2">
                                        <td class="text-right" style="width:50%;">DP</td>
                                        <td class="currency text-right">1</td>
                                    </tr>
                                    <tr colspan="2">
                                        <td class="text-right" style="width:50%;">Sisa Pembayaran</td>
                                        <td class="currency text-right">1</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-lg-12">
                                <label>PAYMENT DETAILS</label>
                                <table style="width:100%" class="border">
                                    <tr class="border bg-brown">
                                        <td width="10%"><b>DATE</b> </td>
                                        <td width="50%"><b>TOTAL</b></td>
                                    </tr>
                                    <tr>
                                        <td>2021-01-02</td>
                                        <td>Rp.25000</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="float-right">
                                <button type="button" id="btn-print-invoice" class="btn btn-brown"><i
                                        class="fas fa-print"></i> Print Out</button>
                            </div>
                        </div>
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