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
    satuan: null,
    qty: 0,
    foto: null,
    idJenis: null,
    idUser: null,
    idAkun: null,
    dataTable: null
};
$(document).ready(function() {
    Globalize.culture("id-ID");
    $('.mn-1').addClass('bg-brown');
    $('.stock').click(function() {
        $('#txtTglStock').removeAttr('disabled');
        $('#txtTglStock').focus();
    });
    $("#tblData").dataTable({
        "bJQueryUI": true,
        "bAutoWidth": false,
        // "bProcessing": true,
        "iDisplayLength": 10,
        "aLengthMenu": [10, 20, 50, 100],
        "bServerSide": true,
        "sPaginationType": "full_numbers",
        "sAjaxSource": "<?php echo site_url('admin/get_data_table_source'); ?>?table=k_faktur&columns=,tanggal,faktur&jwhere=user_id,akun_id&fildjoins=,m_user.nama as name,m_akun.nama as Akun&joins=m_user,m_akun&exports=m_user,m_akun",
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
                "sTitle": "Permintaan",
                "mData": "Akun",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "akun_id-" + oData.id;
                    $(nTd).attr("id", id);
                }
            },
            {
                "sTitle": "Faktur",
                "mData": "faktur",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "faktur-" + oData.id;
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
                "sTitle": "Di Buat",
                "mData": "name",
                "sClass": "text-center",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "user_id-" + oData.id;
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
                        "<div class='btn-group'><div class='btn btn-xs btn-info'><i id='i-color-" +
                        oData.id +
                        "' class='fas fa-bell'></i> <span></span></div></div>"
                    );
                    if (oData.status == null) {
                        $($(nTd).children()[0]).find("span").html("&nbsp;Permohonan");
                    } else if (oData.status == 'Y') {
                        $($(nTd).children()[0]).find("div").attr("class",
                            "btn btn-xs btn-success");
                        $($(nTd).children()[0]).find("i").html("&nbsp;Approve");
                        $.loop("#i-color-" + oData.id);
                    } else if (oData.status == 'N') {
                        $($(nTd).children()[0]).find("div").attr("class",
                            "btn btn-xs btn-danger");
                        $($(nTd).children()[0]).find("span").html("&nbsp;Cancel");
                        $.loop("#i-color-" + oData.id);
                    } else if (oData.status == 'P') {
                        $($(nTd).children()[0]).find("div").attr("class",
                            "btn btn-xs btn-brown");
                        $($(nTd).children()[0]).find("span").html("&nbsp;Stock in");
                        $.loop("#i-color-" + oData.id);
                    }
                }
            },
            {
                "sTitle": "Action",
                "mData": "id",
                "sClass": "text-center",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    $(nTd).html(
                        "<div class='btn-group'><button type='button' class='btn btn-xs bg-blue mr-1'><i class='fas fa-print'></i> Print</button><button type='button' class='btn btn-xs bg-green '><i class='fas fa-cart-plus'></i> Terima</button></div>"
                    );
                    $($(nTd).find('.btn-group').children()[0]).button().click(function() {
                        selectedId = oData.id;
                        window.open(
                            "<?= site_url('Kasir/print_permintaan'); ?>?id=" +
                            $.base64.encode(selectedId), 'Data Permintaan',
                            'width=390,height=670');
                        return false;
                    });
                    $($(nTd).find('.btn-group').children()[1]).button().click(function() {
                        if (oData.status == null) {
                            selectedId = oData.id;
                            objItems.idAkun = selectedId;
                            $.get_detail_permintaan(selectedId);
                            $('#tab-stock a[href="#AddStock"]').trigger('click');
                        } else if (oData.status == 'Y') {
                            selectedId = oData.id;
                            $.alert_swal_info("Process Permintaan",
                                "Data Sudah Di Process", "warning");
                            $('#tab-stock a[href="#RincianStock"]').trigger('click');
                            $.data_rincian(selectedId);

                        } else if (oData.status == 'N') {
                            $.alert_swal_info("Process Permintaan", "Data Di Tolak",
                                "warning");
                            $('#tab-stock a[href="#DataStock"]').trigger('click');
                        }
                    });
                }
            }
        ]
    });
    $("#tblListStock").DataTable({
        "bJQueryUI": true,
        "bPaginate": false,
        "bLengthChange": false,
        "bFilter": false,
        "bSort": false,
        "bInfo": false,
        "bAutoWidth": true,
        "aoColumns": [{
                "sTitle": "#"
            },
            {
                "sTitle": "Kode Barang"
            },
            {
                "sTitle": "Nama Barang"
            },
            {
                "sTitle": "Satuan"
            },
            {
                "sTitle": "Permintaan",
                "sClass": "text-center",
            },
            {
                "sTitle": "Stock",
                "sClass": "text-center",
            },
            {
                "sTitle": "Tanggal",
                "sClass": "center"
            },
            {
                "sTitle": "Action",
                "sClass": "text-center",
            }
        ]
    });
    $.get_detail_permintaan = function(id) {
        $('#tblListStock').dataTable().fnClearTable();
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "<?php echo site_url('admin/multi_select');?>?table=k_permintaan&select=faktur_id&id=" +
                id,
            success: function(data) {
                if (data.error == true) {
                    $.alert_swal_info('Form Penerimaan', data.message, 'warning');
                } else {
                    var ctr = 0;
                    for (var i = 0; i < data.length; i++) {
                        if (data[i].status == null) {
                            $("#tblListStock").dataTable().fnAddData(
                                [
                                    $("#tblListStock").dataTable().fnGetData().length + 1,
                                    data[i].kode,
                                    data[i].nama,
                                    data[i].satuan,
                                    data[i].qty,
                                    data[i].stock,
                                    data[i].tanggal,
                                    '<div class="btn-group"><button type="button" id="btn-del' +
                                    data[i].id +
                                    '"class="btn bg-red mr-1"><i class="fas fa-trash"></i></button>' +
                                    '</div>',
                                    data[i].foto,
                                    data[i].jenis_id,
                                    data[i].id
                                ]
                            );
                        }
                        $("#btn-del" + data[i].id).button().click(function() {
                            var idx = $($(this).parent().parent().siblings()[0])
                                .html() - 1;
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
                                        type: "POST",
                                        dataType: 'json',
                                        url: "<?php echo site_url('admin/aktive/k_permintaan'); ?>/status/" +
                                            row[8] + "/N",
                                        success: function(msg) {
                                            if (msg.error ==
                                                false) {
                                                $.alert_swal_info(
                                                    'Hapus Item',
                                                    msg.message,
                                                    'success');
                                                $("#tblListStock")
                                                    .dataTable()
                                                    .fnDeleteRow(
                                                        idx);
                                                $("#tblListStock")
                                                    .dataTable()
                                                    .fnDraw();
                                            } else {
                                                $.alert_swal_info(
                                                    'Hapus Item',
                                                    msg.message,
                                                    'warning');
                                                $("#tblListStock")
                                                    .dataTable()
                                                    .fnDraw();
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
                        // $("#btn-min" + data[i].id).button().click(function() {
                        //     var qty = $(this).closest('tr').find("td:nth-child(5)")
                        //         .text();
                        //     if (qty > 0) {
                        //         $(this).closest('tr').find("td:nth-child(5)").text(
                        //             Globalize.parseInt(qty) - 1);
                        //     } else if (qty == 0) {
                        //         $(this).closest('tr').find("td:nth-child(5)").text(1);
                        //     }
                        //     $("#tblListStock").dataTable().fnDraw();
                        // });
                        // $("#btn-plus" + data[i].id).button().click(function() {
                        //     var qty = $(this).closest('tr').find("td:nth-child(5)")
                        //         .text();
                        //     if (qty > 0) {
                        //         $(this).closest('tr').find("td:nth-child(5)").text(
                        //             Globalize.parseInt(qty) + 1);
                        //     } else if (qty == 0) {
                        //         $(this).closest('tr').find("td:nth-child(5)").text(1);
                        //     }
                        //     $("#tblListStock").dataTable().fnDraw();
                        // });

                    }
                }
            }
        });
    }
    $("#submit_prosses").button().click(function() {
        if ($("#tblListStock").dataTable().fnGetData().length > 0) {
            $('.load-Barang').append(
                '<div class="overlay"><i class="fas fa-2x fa-sync-alt fa-spin"></i></div>'
            );
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
                        $.alert_swal('Form Penerimaan', msg.message, 'success');
                    } else {
                        $('.load-Barang').find('.overlay').remove();
                        $.alert_swal('Form Penerimaan', msg.message, 'warning');
                    }
                }
            });
        } else {
            $.alert_swal_info("Prosess Data", " Data Tabel Masih Kosong", "warning");
            $("#txtTglStock").focus();
        }
    });
    $("#submit_print").button().click(function() {
        if ($("#tblDataRincian").dataTable().fnGetData().length > 0) {
            objItems.dataTable = $("#tblDataRincian").dataTable().fnGetData();
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
    $("#submit_batal").button().click(function() {
        if ($('#tblListStock').dataTable().fnGetData().length > 0) {
            $('#tblListStock').dataTable().fnClearTable();
            $('#tab-stock a[href="#DataStock"]').trigger('click');
            $("#tblData").dataTable().fnDraw();
        }
    });
    $('#Rincian-Stock').click(function() {
        if (!selectedId) {
            $.alert_swal('Data Permintaan', 'Pilih Data Yang Akan Prosess', 'warning');
        } else {
            $("#submit_edit").show();
        }
    });
    $('#Add-Stock').click(function() {
        if (!selectedId) {
            $.alert_swal('Data Permintaan', 'Pilih Data Yang Akan Prosess', 'warning');
        } else {
            $("#submit_edit").show();
        }
    });
    $('#Data-Stock').click(function() {
        selectedId = false;
        if ($.fn.DataTable.isDataTable("#tblDataRincian")) {
            $("#tblDataRincian").dataTable().fnDestroy();
        }
    });
    $.data_rincian = function($id) {
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
            "sAjaxSource": "<?php echo site_url('admin/get_data_table_source'); ?>?table=k_penerimaan&columns=,tanggal,kode,jenis,nama,qty&filds=faktur_id&var=" +
                $id,
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
                    "sTitle": "Kode",
                    "mData": "kode",
                    "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                        var id = "kode-" + oData.id;
                        $(nTd).attr("id", id);
                    }
                },
                {
                    "sTitle": "Nama Barang",
                    "mData": "nama",
                    "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                        var id = "nama-" + oData.id;
                        $(nTd).attr("id", id);
                        $(nTd).html(oData.nama + " (" + oData.satuan + ")");
                    }
                },
                {
                    "sTitle": "qty",
                    "mData": "qty",
                    "sClass": "text-center",
                    "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                        var id = "qty-" + oData.id;
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
                            "<div class='btn-group'><div class='btn btn-xs btn-warning'><i id='i-color-" +
                            oData.id +
                            "' class='fas fa-bell'></i> <span></span></div></div>"
                        );
                        if (oData.status == null) {
                            $($(nTd).children()[0]).find("span").html("&nbsp;Menunggu");
                        } else if (oData.status == 'Y') {
                            $($(nTd).children()[0]).find("div").attr("class",
                                "btn btn-xs btn-info");
                            $($(nTd).children()[0]).find("i").html("&nbsp;Approve");
                            $.loop("#i-color-" + oData.id);
                        } else if (oData.status == 'N') {
                            $($(nTd).children()[0]).find("div").attr("class",
                                "btn btn-xs btn-danger");
                            $($(nTd).children()[0]).find("span").html("&nbsp;Cancel");
                        }
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
                selectedId = false;
            }
        })
    }

});
</script>
<div class="col-md-12">
    <div class="card card-outline card-yellow load-Barang">
        <div class="card-header">
            <h3 class="card-title col-lg-4 col-sm-12 mb-2">Penerimaan Permintaan</h3>
        </div>
        <div class="card-body">
            <ul class="nav nav-pills" id="tab-stock">
                <li class="nav-item" id="Data-Stock"><a class="nav-link active border-left" href="#DataStock"
                        data-toggle="tab"><i class="fas fa-clipboard-check"></i> Data Permintaan</a>
                </li>
                <li class="nav-item" id="Add-Stock"><a class="nav-link border-left" href="#AddStock"
                        data-toggle="tab"><i class="fas fa-truck"></i> Form Penerimaan</a>
                </li>
                <li class="nav-item" id="Rincian-Stock"><a class="nav-link border-left" href="#RincianStock"
                        data-toggle="tab"><i class="fas fa-clipboard-list"></i> Rincian Penerimaan</a>
                </li>
            </ul>
            <hr>
            <div class="tab-content">
                <div class="active tab-pane" id="DataStock">
                    <div class="callout callout-info">
                        <div class="table-responsive scroll-bar" style="max-height:350px;">
                            <table table id="tblData" class="table table-bordered table-striped"></table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="AddStock">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="callout callout-info">
                                <label>List Permintaan</label>
                                <div class="table-responsive scroll-bar" style="max-height:350px;">
                                    <table table id="tblListStock" class="table table-bordered table-striped"
                                        style="width:100%;">
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="form-group">
                                    <button type="button" id="submit_prosses" class="btn btn-success float-right"><i
                                            class="fa fa-send"></i> Prosses</button>
                                    <button type="button" id="submit_batal" class="btn btn-danger float-right mr-1"><i
                                            class="fas fa-ban"></i>Batal</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="RincianStock">
                    <div class="callout callout-info">
                        <div class="table-responsive scroll-bar" style="max-height:350px;">
                            <table table id="tblDataRincian" class="table table-bordered table-striped"></table>
                        </div>
                        <div class="card-footer">
                            <div class="form-group">
                                <button type="button" id="submit_print" class="btn btn-info float-right mr-1"><i
                                        class="fas fa-print"></i> Print</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>