<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<script type="text/javascript">
var fildeselect;
var active;
var eleFocus = '';
var divisiID;
var objItems = {
    id: null,
    kode: null,
    nama: null,
    deskripsi: null,
    satuan: null,
    harga: 0,
    diskon: 0,
    idJenis: null,
    qty: 0,
    foto: null,
    idUser: null,
    dataTable: null
};
$(document).ready(function() {
    Globalize.culture("id-ID");
    $('.mn-2').addClass('bg-brown');
    $("#txtTglStock").datepicker({
        changeMonth: true,
        changeYear: false,
        showButtonPanel: true,
        maxDate: '2018',
        minDate: '@minDate',
        dateFormat: "yy-mm-dd",
        onSelect: function(date) {
            $(this).attr('disabled', 'disabled');
        }
    });
    $('.stock').click(function() {
        $('#txtTglStock').removeAttr('disabled');
        $('#txtTglStock').focus();
    });
    $("#tblData").dataTable({
        "bJQueryUI": true,
        "bAutoWidth": false,
        // "bProcessing": true,
        "iDisplayLength": 15,
        "aLengthMenu": [15, 30, 50, 100],
        "bServerSide": true,
        "sPaginationType": "full_numbers",
        "sAjaxSource": "<?php echo site_url('admin/get_data_table_source'); ?>?table=k_pembelian_toko&columns=,tanggal,faktur&jwhere=user_id&fildjoins=,m_user.nama&joins=m_user&exports=m_user&cVoid= GROUP BY k_pembelian_toko.faktur ASC",
        "aoColumns": [{
                "sTitle": "#",
                "mData": "no",
                "bSortable": false,
                "sClass": "center"
            },
            {
                "sTitle": "Tanggal",
                "mData": "tanggal",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "tanggal-" + oData.id;
                    $(nTd).attr("id", id);
                }
            },
            {
                "sTitle": "Faktur Pembelian",
                "mData": "faktur",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "faktur-" + oData.id;
                    $(nTd).attr("id", id);
                }
            },
            {
                "sTitle": "Di Buat",
                "mData": "nama",
                "sClass": "text-right",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "user_id-" + oData.id;
                    $(nTd).attr("id", id);
                }
            },
            {
                "sTitle": "Action",
                "mData": "id",
                "sClass": "text-center",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    $(nTd).html(
                        "<div class='btn-group'><button type='button' class='btn btn-xs bg-blue'><i class='fas fa-print'></i> Print</button></div>"
                    );
                    $($(nTd).find('.btn-group').children()[0]).button().click(function() {
                        window.open(
                            "<?= site_url('Kasir/print_pembelian_toko'); ?>?id=" +
                            $.base64.encode(oData.faktur), 'Saldo Pembelian',
                            'width=390,height=670');
                        return false;
                    });
                }
            }
        ]
    });
    $("#tblDataDetail").dataTable({
        "bJQueryUI": true,
        "bAutoWidth": false,
        // "bProcessing": true,
        "iDisplayLength": 15,
        "aLengthMenu": [15, 30, 50, 100],
        "bServerSide": true,
        "sPaginationType": "full_numbers",
        "sAjaxSource": "<?php echo site_url('admin/get_data_table_source'); ?>?table=k_pembelian_toko&columns=,tanggal,kode,jenis,nama,harga,diskon,stock,qty",
        "aoColumns": [{
                "sTitle": "#",
                "mData": "no",
                "bSortable": false,
                "sClass": "center"
            },
            {
                "sTitle": "Tanggal",
                "mData": "tanggal",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "tanggal-" + oData.id;
                    $(nTd).attr("id", id);
                }
            },
            {
                "sTitle": "Faktur Pembelian",
                "mData": "faktur",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "faktur-" + oData.id;
                    $(nTd).attr("id", id);
                }
            },
            {
                "sTitle": "Kode",
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
                    $(nTd).html(oData.nama + " (" + oData.satuan + ")");
                }
            },
            {
                "sTitle": "Stock",
                "mData": "stock",
                "sClass": "text-center",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "stock-" + oData.id;
                    $(nTd).attr("id", id);
                }
            },
            {
                "sTitle": "Harga Jual",
                "mData": "harga",
                "sClass": "text-right",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "harga-" + oData.id;
                    $(nTd).attr("id", id);
                },
                "mRender": function(data, type, full) {
                    return Globalize.format(Globalize.parseInt(data), "c");
                }
            },
            {
                "sTitle": "Diskon",
                "mData": "diskon",
                "sClass": "text-right",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "diskon-" + oData.id;
                    $(nTd).attr("id", id);
                },
                "mRender": function(data, type, full) {
                    return Globalize.format(Globalize.parseInt(data), "c");
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
            }
        ]
    });
    $("#txtSearch").autocomplete({
        source: function(query, response) {
            $.ajax({
                type: "POST",
                dataType: 'json',
                url: "<?= site_url('kasir/json_search_data');?>?table=k_item_barang&columns=,nama,deskripsi,kode&aSearch=" +
                    query.term,
                success: function(data) {
                    response($.map(data, function(value, key) {
                        console.log(value);
                        return {
                            label: value.kode + " (" + value.deskripsi +
                                ", Rp." +
                                value.harga_jual +
                                " )",
                            value: value
                        };
                    }));

                }
            });
        },
        minLength: 2,
        focus: function(event, ui) {
            $("#txtSearch").val(ui.item.label);
            return false;
        },
        select: function(event, ui) {
            objItems.id = ui.item.value.id;
            objItems.kode = ui.item.value.kode;
            objItems.deskripsi = ui.item.value.deskripsi;
            objItems.satuan = ui.item.value.satuan;
            objItems.idJenis = ui.item.value.jenis_id;
            objItems.harga = ui.item.value.harga_jual;
            objItems.diskon = ui.item.value.harga_diskon;
            objItems.idUser = $user;
            $("#lbl-items").html(ui.item.value.deskripsi + " (" + ui.item.value.satuan + ")");
            $("#lbl-harga").html("Rp." + objItems.harga);
            $("#lbl-diskon").html("Rp." + objItems.diskon);
            $("#txtQty").removeAttr('disabled');
            $("#txtQty").focus();
            return false;
        }
    });
    $("#tblDataStock").DataTable({
        "responsive": true,
        "bJQueryUI": false,
        "bPaginate": false,
        "bAutoWidth": false,
        "bLengthChange": false,
        "bFilter": true,
        "bSort": false,
        "bInfo": false,
        "bRetrieve": true,
        "iDisplayLength": 10,
        "sPaginationType": "full_numbers",
        "aoColumns": [{
                "sTitle": "#"
            },
            {
                "sTitle": "Kode"
            },
            {
                "sTitle": "Nama"
            },
            {
                "sTitle": "Stock",
                "sClass": "center"
            },
            {
                "sTitle": "Action",
                "sClass": "center",
                "fnCreatedCell": function(nTd, sData, oData, data, iRow, iCol) {
                    $(nTd).html(
                        "<div class='btn-group'><button type='button' class='btn btn-xs bg-red'><i class='fas fa-trash'></i></button></div>",
                    );
                    $($(nTd).children()[0]).button().click(function() {
                        var idx = $($(this).parent().siblings()[0]).html() - 1;
                        var row = $("#tblDataStock").dataTable().fnGetData()[idx];
                        $("#tblDataStock").dataTable().fnDeleteRow(idx);
                        if ($("#tblDataStock").dataTable().fnGetData().length > 0) {
                            $("#tblDataStock tbody tr").each(function(index) {
                                $($(this).children()[0]).html(index + 1);
                            });
                        }
                    });
                }
            }
        ]
    });
    $("#txtQty").attr('disabled', 'disabled');
    $("#txtQty").keypress(function(event) {
        if (event.which == 13) {
            if ($(this).val().length > 0) {
                $("#submit_input").button().click();
            } else {
                ('#txtQty').focus();
            }
        }
    });
    $("#submit_input").button().click(function() {
        if ($('#txtTglStock').val() == "") {
            $.alert_swal_info("Input Stock", " Tentukan Tanggal ", "warning");
        } else if ($('#txtQty').val().length > 0 && $.isNumeric($('#txtQty').val())) {
            $("#tblDataStock").dataTable().fnAddData(
                [
                    $("#tblDataStock").dataTable().fnGetData().length + 1,
                    objItems.kode,
                    objItems.deskripsi,
                    $("#txtQty").val(),
                    objItems.harga,
                    objItems.diskon,
                    objItems.satuan,
                    objItems.idJenis,
                    objItems.idUser,
                    objItems.foto,
                    objItems.tanggal = $('#txtTglStock').val(),
                ]
            );
            $("#txtQty").val('');
            $("#txtSearch").val('');
            $("#lbl-items").html('..');
            $("#lbl-harga").html('Rp.0');
            $("#lbl-diskon").html('Rp.0');
            $("#txtSearch").focus();
        } else {
            $('#txtQty').focus();
        }
    });
    $("#submit_clear").button().click(function() {
        $("#txtQty").val('');
        $("#txtSearch").val('');
        $("#lbl-items").html('..');
        $("#lbl-harga").html('Rp.0');
        $("#lbl-diskon").html('Rp.0');
        $("#txtSearch").focus();
    });
    $("#submit_prosses").button().click(function() {
        if ($("#txtTglStock").val().length > 0 && $("#tblDataStock").dataTable().fnGetData().length >
            0) {
            $('.load-Barang').append(
                '<div class="overlay"><i class="fas fa-2x fa-sync-alt fa-spin"></i></div>');
            objItems.dataTable = $("#tblDataStock").dataTable().fnGetData();
            var data = $.base64.encode(JSON.stringify(objItems));
            data = data.replaceAll(".", "^");
            data = data.replaceAll("+", "-");
            data = data.replaceAll("/", "_");
            $.ajax({
                type: "POST",
                data: "data=" + data,
                dataType: 'json',
                url: "<?php echo site_url('kasir/prosess_stock_pembelian'); ?>",
                success: function(msg) {
                    if (msg.error == false) {
                        $('#tblDataStock').dataTable().fnClearTable();
                        $('.load-Barang').find('.overlay').remove();
                        $.alert_swal('Upload Images', msg.message, 'success');
                    } else {
                        $('.load-Barang').find('.overlay').remove();
                        $.alert_swal('Upload Images', msg.message, 'warning');
                    }
                }
            });
        } else {
            $.alert_swal_info("Prosess Stock", " Tentukan Tanggal atau Data masih Kosing", "warning");
            $("#txtTglStock").focus();
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
                $('#tab-stock a[href="#DataStock"]').trigger('click');
                $("#tblData").dataTable().fnDraw();
            }
        })
    }
});
</script>
<div class="col-md-12">
    <div class="card card-outline card-yellow load-Barang">
        <div class="card-header">
            <h3 class="card-title col-lg-4 col-sm-12 mb-2">Permintaan Pembelian</h3>
        </div>
        <div class="card-body">
            <ul class="nav nav-pills" id="tab-stock">
                <li class="nav-item" id="Add-Stock"><a class="nav-link active border-left" href="#AddStock"
                        data-toggle="tab"><i class="fas fa-cart-plus"></i> Buat Permintaan</a>
                </li>
                <li class="nav-item" id="Data-Stock"><a class="nav-link border-left" href="#DataStock"
                        data-toggle="tab"><i class="fas fa-clipboard-list"></i> Data Pembelian</a>
                </li>
                <li class="nav-item" id="Detail-Stock"><a class="nav-link border-left" href="#DetailStock"
                        data-toggle="tab"><i class="fas fa-boxes"></i> Rincian Pembelian</a>
                </li>
            </ul>
            <hr>
            <div class="tab-content">
                <div class="active tab-pane" id="AddStock">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="callout callout-info">
                                        <div class="form-group">
                                            <label for="txtTglStock" class="col-form-label">Tanggal Pembelian</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="txtTglStock"
                                                    disabled="disabled">
                                                <div class="input-group-append">
                                                    <span class="input-group-text btn stock"><i
                                                            class="fa fa-calendar"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Cari Item Barang</label>
                                            <div class="input-group">
                                                <input id="txtSearch" class="form-control" type="text" maxlength="100"
                                                    placeholder="Search">
                                                <div class="input-group-append">
                                                    <span class="input-group-text btn search"><i
                                                            class="fas fa-search"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label>Nama Item</label>
                                            <span class="form-inline">
                                                <p id="lbl-items">..</p>
                                            </span>
                                        </div>
                                        <div class="form-group">
                                            <label>Harga Jual</label>
                                            <span class="form-inline">
                                                <p id="lbl-harga">Rp.0</p>
                                            </span>
                                        </div>
                                        <div class="form-group">
                                            <label>Diskon</label>
                                            <span class="form-inline">
                                                <p id="lbl-diskon">Rp.0</p>
                                            </span>
                                        </div>
                                        <div class="form-group">
                                            <label>Stock Qty</label>
                                            <div class="input-group">
                                                <input type="numeric" id="txtQty" maxlength="10" class="form-control"
                                                    required>
                                                <div class="input-group-append">
                                                    <button type="button" id="submit_input"
                                                        class="btn btn-info float-right">Input</button>
                                                    <button type="button" id="submit_clear"
                                                        class="btn btn-warning ml-1 float-right">Clear</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="callout callout-info">
                                        <label>List Stock</label>
                                        <div class="table-responsive scroll-bar" style="max-height:450px;">
                                            <table table id="tblDataStock" class="table table-bordered table-striped">
                                            </table>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <button type="button" id="submit_prosses" class="btn btn-danger float-right"><i
                                                class="fas fa-cart-plus"></i> Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class=" tab-pane" id="DataStock">
                    <div class="callout callout-info">
                        <div class="table-responsive">
                            <table table id="tblData" class="table table-bordered table-striped"></table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="DetailStock">
                    <div class="callout callout-info">
                        <div class="table-responsive">
                            <table table id="tblDataDetail" class="table table-bordered table-striped"></table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>