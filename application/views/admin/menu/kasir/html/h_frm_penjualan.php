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

    $("#tblData").dataTable({
        "bJQueryUI": true,
        "bAutoWidth": false,
        "bProcessing": true,
        "iDisplayLength": 10,
        "aLengthMenu": [10, 20, 50, 100],
        "bServerSide": true,
        "sPaginationType": "full_numbers",
        "sAjaxSource": "<?php echo site_url('admin/get_data_table_source'); ?>?table=k_penjualan&columns=,k_penjualan.kode,k_penjualan.nama,harga,diskon,qty,stock_akhir,jenis_id,k_jenis_barang.nama&jwhere=jenis_id&fildjoins=,k_jenis_barang.nama AS Jenis&joins=k_jenis_barang&exports=k_jenis_barang",
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
                        "<?php echo site_url('admin/update_grid/k_penjualan'); ?>", {
                            "callback": function(sValue, y) {
                                /* Redraw the table from the new data on the server */
                                $("#tblData").dataTable().fnDraw();
                            }
                        });
                }
            },
            {
                "sTitle": "Harga",
                "mData": "harga",
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
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "diskon-" + oData.id;
                    $(nTd).attr("id", id);
                },
                "mRender": function(data, type, full) {
                    return Globalize.format(Globalize.parseInt(data), "c");
                }
            },
            {
                "sTitle": "Stock",
                "mData": "stock_akhir",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "stock_akhir-" + oData.id;
                    $(nTd).attr("id", id);
                }
            },
            {
                "sTitle": "Terjual",
                "mData": "qty",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "qty-" + oData.id;
                    $(nTd).attr("id", id);
                }
            },
            {
                "sTitle": "Katagori",
                "mData": "Jenis",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "jenis_id-" + oData.id;
                    $(nTd).attr("id", id);
                    $(nTd).editable(
                        "<?php echo site_url('admin/update_grid/k_penjualan'); ?>?table=k_jenis_barang", {
                            loadurl: "<?php echo site_url('admin/get_editable_select'); ?>?table=k_jenis_barang&filds=nama&select=" +
                                oData.jenis_id,
                            type: "select",
                            submit: "OK",
                            "callback": function(sValue, y) {
                                /* Redraw the table from the new data on the server */
                                $("#tblData").dataTable().fnDraw();
                            }
                        });
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
});
</script>
<div class="col-md-12">
    <div class="card card-outline card-yellow load-Barang">
        <div class="card-header">
            <h3 class="card-title col-lg-4 col-sm-12 mb-2">Data Penjualan </h3>
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