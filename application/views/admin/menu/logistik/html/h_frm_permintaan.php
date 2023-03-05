<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<script type="text/javascript">
var fildeselect;
var active;
var eleFocus = '';
var divisiID;
var akun = null;
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
    $('.mn-2').addClass('bg-brown');
    $("#tblData").dataTable({
        "bJQueryUI": true,
        "bAutoWidth": false,
        // "bProcessing": true,
        "iDisplayLength": 10,
        "aLengthMenu": [10, 20, 50, 100],
        "bServerSide": true,
        "sPaginationType": "full_numbers",
        "sAjaxSource": "<?php echo site_url('admin/get_data_table_source'); ?>?table=k_permintaan&columns=,tanggal,kode,jenis,nama,harga,diskon,stock,qty",
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
                "sTitle": "Kode Barang",
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
                "sTitle": "Qty",
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
                        "<div class='btn-group'><div class='btn btn-sm btn-warning'><i id='i-color-" +
                        oData.id +
                        "' class='fas fa-bell'></i> <span></span></div></div>"
                    );
                    if (oData.status == null) {
                        $($(nTd).children()[0]).find("span").html("&nbsp;Menunggu");
                    } else if (oData.status == 'Y') {
                        $($(nTd).children()[0]).find("div").attr("class",
                            "btn btn-sm btn-info");
                        $($(nTd).children()[0]).find("i").html("&nbsp;Di Terima");
                        $.loop("#i-color-" + oData.id);
                    } else if (oData.status == 'N') {
                        $($(nTd).children()[0]).find("div").attr("class",
                            "btn btn-sm btn-danger");
                        $($(nTd).children()[0]).find("span").html("&nbsp;Cancel");
                    } else if (oData.status == 'P') {
                        $($(nTd).children()[0]).find("div").attr("class",
                            "btn btn-sm btn-brown");
                        $($(nTd).children()[0]).find("span").html("&nbsp;Stock in");
                    }
                }
            }
        ]
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
    $("#btn-print-table").button().click(function() {
        if ($('#tblDataDetail').dataTable().fnGetData().length > 0 && selectedId) {
            window.open("<?= site_url('Kasir/print_permintaan'); ?>?id=" + $.base64.encode(
                selectedId), 'Form Permintaan', 'width=390,height=750');
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
            <h3 class="card-title col-lg-4 col-sm-12 mb-2">History </h3>
        </div>
        <div class="card-body">
            <ul class="nav nav-pills" id="tab-stock">
                <li class="nav-item" id="Data-Stock"><a class="nav-link border-left active" href="#DataStock"
                        data-toggle="tab"><i class="fas fa-clipboard-list"></i> Data Penerimaan</a>
                </li>
            </ul>
            <hr>
            <div class="tab-content">
                <div class="active tab-pane" id="DataStock">
                    <div class="callout callout-info">
                        <div class="table-responsive ">
                            <table id="tblData" class="table table-bordered table-striped" width="100%"></table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="float-right">
                            <button type="button" id="btn-print-table" class="btn btn-brown"><i
                                    class="fas fa-print"></i> Print Out</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>