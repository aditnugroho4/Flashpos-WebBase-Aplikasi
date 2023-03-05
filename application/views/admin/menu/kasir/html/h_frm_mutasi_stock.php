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
    $('.mn-1').addClass('bg-brown');

    $('.stock').click(function() {
        $('#txtTglStock').removeAttr('disabled');
        $('#txtTglStock').focus();
    });
    $("#tblData").dataTable({
        "bJQueryUI": true,
        "bAutoWidth": false,
        // "bProcessing": true,
        "iDisplayLength": 5,
        "aLengthMenu": [10, 20, 50],
        "bServerSide": true,
        "sPaginationType": "full_numbers",
        "sAjaxSource": "<?php echo site_url('admin/get_data_table_source'); ?>?table=k_penjualan&columns=,kode,nama,harga,diskon,stock_awal,stock_akhir&jwhere=jenis_id&fildjoins=,k_jenis_barang.nama as Jenis&joins=k_jenis_barang&exports=k_jenis_barang",
        "aoColumns": [{
                "sTitle": "#",
                "mData": "no",
                "bSortable": false,
                "sClass": "center"
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
                "sTitle": "Jenis",
                "mData": "Jenis",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "jenis_id-" + oData.id;
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
                "sTitle": "Mutasi",
                "mData": "qty",
                "sClass": "text-center",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "qty-" + oData.id;
                    $(nTd).attr("id", id);
                }
            },
            {
                "sTitle": "Stock Akhir",
                "mData": "stock_akhir",
                "sClass": "text-center",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "stock_akhir-" + oData.id;
                    $(nTd).attr("id", id);
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
            <h3 class="card-title col-lg-4 col-sm-12 mb-2">Mutasi Stock </h3>
        </div>
        <div class="card-body">
            <div class="callout callout-info">
                <div class="table-responsive ">
                    <table id="tblData" class="table table-bordered table-striped" width="100%"></table>
                </div>
            </div>
        </div>
    </div>
</div>