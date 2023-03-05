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
    tanggal: null,
    faktur: null,
    idUser: null,
    dataTable: null
};
$(document).ready(function() {
    Globalize.culture("id-ID");
    $('.mn-3').addClass('bg-brown');
    $("#txtTglStock").datepicker({
        changeMonth: true,
        changeYear: false,
        showButtonPanel: true,
        maxDate: '2018',
        minDate: -3,
        dateFormat: "yy-mm-dd",
        onSelect: function(date) {
            $(this).attr('disabled', 'disabled');
            $.get_detail_pembelian($(this).val());
        }
    });
    $('.stock').click(function() {
        $('#txtTglStock').removeAttr('disabled');
        $('#txtTglStock').focus();
    });
    $.get_detail_pembelian = function(tanggal) {
        $('#tblListStock').dataTable().fnClearTable();
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "<?php echo site_url('admin/multi_select');?>?table=k_pembelian_toko&select=tanggal&id='" +
                tanggal + "'",
            success: function(data) {
                if (data.error == true) {
                    $.alert_swal_info('Form Penerimaan', data.message, 'warning');
                } else {
                    for (var i = 0; i < data.length; i++) {
                        let price = (data[i].harga - data[i].diskon) * data[i].stock;
                        $("#tblListStock").dataTable().fnAddData(
                            [
                                $("#tblListStock").dataTable().fnGetData().length + 1,
                                data[i].kode,
                                data[i].nama,
                                data[i].stock,
                                data[i].harga,
                                data[i].diskon,
                                price,
                                data[i].satuan,
                                data[i].jenis_id,
                                data[i].tanggal,
                                data[i].foto,
                                data[i].faktur,
                                data[i].id
                            ]
                        );
                    }
                }
            }
        });
    }
    $("#tblData").dataTable({
        "bJQueryUI": true,
        "bAutoWidth": false,
        // "bProcessing": true,
        "iDisplayLength": 15,
        "aLengthMenu": [15, 30, 50, 100],
        "bServerSide": true,
        "sPaginationType": "full_numbers",
        "sAjaxSource": "<?php echo site_url('admin/get_data_table_source'); ?>?table=k_penerimaan_toko&columns=,tanggal,faktur&jwhere=user_id&fildjoins=,m_user.nama as name&joins=m_user&exports=m_user",
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
                "sTitle": "Faktur Penerimaan",
                "mData": "faktur",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "kode-" + oData.id;
                    $(nTd).attr("id", id);
                }
            },
            {
                "sTitle": "Jumlah",
                "mData": "qty",
                "sClass": "text-center",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "qty-" + oData.id;
                    $(nTd).attr("id", id);
                }
            },
            {
                "sTitle": "Total",
                "mData": "total",
                "sClass": "text-right",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "total-" + oData.id;
                    $(nTd).attr("id", id);
                },
                "mRender": function(data, type, full) {
                    return Globalize.format(Globalize.parseInt(data), "c");
                }
            },
            {
                "sTitle": "Di Buat",
                "mData": "user_id",
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
                        "<div class='btn-group'><button type='button' class='btn btn-xs bg-blue mr-1'><i class='fas fa-print'></i> Print</button><button type='button' class='btn btn-xs bg-yellow '><i class='fas fa-eye'></i> View</button></div>"
                    );
                    $($(nTd).find('.btn-group').children()[0]).button().click(function() {
                        selectedId = oData.id;
                        window.open(
                            "<?= site_url('Kasir/print_penerimaan_toko'); ?>?id=" +
                            $.base64.encode(selectedId), 'Penerimaan Barang',
                            'width=390,height=670');
                        return false;
                    });
                    $($(nTd).find('.btn-group').children()[1]).button().click(function() {
                        selectedId = oData.id;
                        $.data_rincian(oData.id);
                        $('#tab-stock a[href="#RincianStock"]').trigger('click');
                    });

                }
            }
        ]
    });
    $("#tblListStock").DataTable({
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
                "sTitle": "Harga Jual",
                "sClass": "center",
                "mRender": function(data, type, full) {
                    return Globalize.format(data, "c");
                }
            },
            {
                "sTitle": "Diskon",
                "sClass": "center",
                "mRender": function(data, type, full) {
                    return Globalize.format(data, "c");
                }
            },
            {
                "sTitle": "Jumlah",
                "sClass": "center",
                "mRender": function(data, type, full) {
                    return Globalize.format(data, "c");
                }
            },
            {
                "sTitle": "Action",
                "sClass": "text-center",
                "fnCreatedCell": function(nTd, sData, oData, data, iRow, iCol) {
                    $(nTd).html(
                        "<div class='btn-group'><button type='button' class='btn btn-xs bg-red'><i class='fas fa-trash'></i></button></div>",
                    );
                    $($(nTd).children()[0]).button().click(function() {
                        var idx = $($(this).parent().siblings()[0]).html() - 1;
                        var row = $("#tblListStock").dataTable().fnGetData()[idx];
                        Swal.fire({
                            icon: 'warning',
                            title: 'Hapus Pembelian',
                            text: 'Akan Menghapus Item..?',
                            confirmButtonText: "OK",
                            showCancelButton: true,
                            focusConfirm: true
                        }).then((result) => {
                            if (result.value) {
                                $.ajax({
                                    dataType: 'json',
                                    url: "<?php echo site_url('admin/delete/k_pembelian_toko'); ?>/" +
                                        row[12],
                                    success: function(msg) {
                                        if (msg.error == false) {
                                            $("#tblListStock")
                                                .dataTable()
                                                .fnDeleteRow(idx);
                                            $.alert_swal_info(
                                                'Hapus Item',
                                                msg.message,
                                                'success');
                                        } else {
                                            $.alert_swal_info(
                                                'Hapus Item',
                                                msg.message,
                                                'warning');
                                        }
                                    }
                                });
                            }
                        });
                        if ($("#tblListStock").dataTable().fnGetData().length > 0) {
                            $("#tblListStock tbody tr").each(function(index) {
                                $($(this).children()[0]).html(index + 1);
                            });
                        }
                    });
                }
            }
        ]
    });
    $("#submit_prosses").button().click(function() {
        if ($("#tblListStock").dataTable().fnGetData().length > 0) {
            $('.load-Barang').append(
                '<div class="overlay"><i class="fas fa-2x fa-sync-alt fa-spin"></i></div>');
            objItems.dataTable = $("#tblListStock").dataTable().fnGetData();
            var data = $.base64.encode(JSON.stringify(objItems));
            data = data.replaceAll(".", "^");
            data = data.replaceAll("+", "-");
            data = data.replaceAll("/", "_");
            $.ajax({
                type: "POST",
                data: "data=" + data,
                dataType: 'json',
                url: "<?php echo site_url('kasir/prosess_stock_penerimaan'); ?>",
                success: function(msg) {
                    if (msg.error == false) {
                        $('#tblListStock').dataTable().fnClearTable();
                        $('.load-Barang').find('.overlay').remove();
                        $.alert_swal('Upload Images', msg.message, 'success');
                    } else {
                        $('.load-Barang').find('.overlay').remove();
                        $.alert_swal('Upload Images', msg.message, 'warning');
                    }
                }
            });
        } else {
            $.alert_swal_info("Prosess Data", " Tentukan Tanggal atau Data masih Kosing", "warning");
            $("#txtTglStock").focus();
        }
    });
    $("#submit_print").button().click(function() {
        if ($("#tblListStock").dataTable().fnGetData().length > 0) {
            objItems.dataTable = $("#tblListStock").dataTable().fnGetData();
            var data = $.base64.encode(JSON.stringify(objItems));
            data = data.replaceAll(".", "^");
            data = data.replaceAll("+", "-");
            data = data.replaceAll("/", "_");
            window.open("<?= site_url('Kasir/print_stock_awal'); ?>?id=" + data,
                'Print Permintaan Barang', 'width=390,height=670');
            return false;
        } else {
            $.alert_swal_info("Prosess Stock", "Data Table Stock Masih Kosong", "warning");
        }
    });
    $('#Rincian-Stock').click(function() {
        if (!selectedId) {
            $.alert_swal('Edit Data Barang', 'Pilih Data Yang Akan di Edit', 'warning');
        } else {
            $("#submit_edit").show();
        }
    });
    $.data_rincian = function($batch) {
        if ($.fn.DataTable.isDataTable("#tblDataRincian")) {
            $("#tblDataRincian").dataTable().fnDestroy();
        }
        $("#tblDataRincian").dataTable({
            "bJQueryUI": true,
            "bAutoWidth": false,
            // "bProcessing": true,
            "iDisplayLength": 15,
            "aLengthMenu": [15, 30, 50, 100],
            "bServerSide": true,
            "sPaginationType": "full_numbers",
            "sAjaxSource": "<?php echo site_url('admin/get_data_table_source'); ?>?table=k_penjualan_toko&columns=,tanggal,kode,jenis,nama,harga,diskon,stock,qty&filds=faktur_id&var=" +
                $batch,
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
                    "mData": "pbno",
                    "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                        var id = "pbno-" + oData.id;
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
                    "sTitle": "Nama Items",
                    "mData": "nama",
                    "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                        var id = "nama-" + oData.id;
                        $(nTd).attr("id", id);
                        $(nTd).html(oData.nama + " (" + oData.satuan + ")");
                    }
                },
                {
                    "sTitle": "Stock",
                    "mData": "stock_awal",
                    "sClass": "text-center",
                    "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                        var id = "stock_awal-" + oData.id;
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
                }
            ]
        });
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
            <h3 class="card-title col-lg-4 col-sm-12 mb-2">Penerimaan Pembelian</h3>
        </div>
        <div class="card-body">
            <ul class="nav nav-pills" id="tab-stock">
                <li class="nav-item" id="Data-Stock"><a class="nav-link active border-left" href="#DataStock"
                        data-toggle="tab"><i class="fas fa-clipboard-check"></i> Pembelian</a>
                </li>
                <li class="nav-item" id="Add-Stock"><a class="nav-link border-left" href="#AddStock"
                        data-toggle="tab"><i class="fas fa-truck"></i> Penerimaan</a>
                </li>
                <li class="nav-item" id="Rincian-Stock"><a class="nav-link border-left" href="#RincianStock"
                        data-toggle="tab"><i class="fas fa-clipboard-list"></i> Rincian Pembelian</a>
                </li>
            </ul>
            <hr>
            <div class="tab-content">
                <div class="active tab-pane" id="DataStock">
                    <div class="callout callout-info">
                        <div class="table-responsive">
                            <table table id="tblData" class="table table-bordered table-striped"></table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="AddStock">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="callout callout-info">
                                        <div class="form-group">
                                            <label for="txtTglStock" class="col-form-label">Cari Tanggal
                                                Pembelian</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="txtTglStock">
                                                <div class="input-group-append">
                                                    <span class="input-group-text btn stock"><i
                                                            class="fa fa-calendar"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="callout callout-info">
                                        <label>List Penerimaan</label>
                                        <div class="table-responsive scroll-bar" style="max-height:450px;">
                                            <table table id="tblListStock" class="table table-bordered table-striped">
                                            </table>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <button type="button" id="submit_prosses"
                                            class="btn btn-danger float-right">Prosses</button>
                                        <button type="button" id="submit_print" class="btn btn-info float-right mr-1"><i
                                                class="fas fa-print"></i> Print</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="RincianStock">
                    <div class="callout callout-info">
                        <div class="table-responsive">
                            <table table id="tblDataRincian" class="table table-bordered table-striped"></table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>