<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<script type="text/javascript">
var fildeselect;
var active;
var eleFocus = '';
var divisiID;
var akun = null;
$(document).ready(function() {
    Globalize.culture("id-ID");
    $('.mn-1').addClass('bg-brown');

    $("#tblData").dataTable({
        "bJQueryUI": true,
        "bAutoWidth": false,
        // "bProcessing": true,
        "iDisplayLength": 10,
        "aLengthMenu": [10, 20, 50, 100],
        "bServerSide": true,
        "sPaginationType": "full_numbers",
        "sAjaxSource": "<?php echo site_url('admin/get_data_table_source'); ?>?table=k_data_suplier&columns=,tanggal,kode,jenis,nama,harga,diskon,stock,qty",
        "aoColumns": [{
                "sTitle": "#",
                "mData": "no",
                "bSortable": false,
                "sClass": "center"
            },
            {
                "sTitle": "Kode Suplier",
                "mData": "kode",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "kode-" + oData.id;
                    $(nTd).attr("id", id);
                }
            },
            {
                "sTitle": "Nama Suplier",
                "mData": "nama",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "nama-" + oData.id;
                    $(nTd).attr("id", id);
                }
            },
            {
                "sTitle": "Alamat",
                "mData": "alamat",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "alamat-" + oData.id;
                    $(nTd).attr("id", id);
                }
            },
            {
                "sTitle": "No Kontak",
                "mData": "contack",
                "sClass": "text-center",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "contack-" + oData.id;
                    $(nTd).attr("id", id);
                }
            },
            {
                "sTitle": "Email",
                "mData": "email",
                "sClass": "text-center",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "email-" + oData.id;
                    $(nTd).attr("id", id);
                }
            }
        ]
    });
    // $("#btn-print-table").button().click(function() {
    //     if ($('#tblDataDetail').dataTable().fnGetData().length > 0 && selectedId) {
    //         window.open("<?= site_url('Kasir/print_permintaan'); ?>?id=" + $.base64.encode(
    //             selectedId), 'Form Permintaan', 'width=390,height=750');
    //     }
    // });
    $.alert_swal = function($info, $message, $alert) {
        Swal.fire({
            icon: $alert,
            title: $info,
            text: $message,
            confirmButtonText: "OK",
            focusConfirm: true
        }).then((result) => {
            if (result.value) {
                $('#tab-stock a[href="#DataSuplier"]').trigger('click');
                $("#tblData").dataTable().fnDraw();
            }
        })
    }
});
</script>
<div class="col-md-12">
    <div class="card card-outline card-yellow load-Barang">
        <div class="card-header">
            <h3 class="card-title col-lg-4 col-sm-12 mb-2">Master Data</h3>
        </div>
        <div class="card-body">
            <ul class="nav nav-pills" id="tab-stock">
                <li class="nav-item" id="Data-Suplier"><a class="nav-link border-left active" href="#DataSuplier"
                        data-toggle="tab"><i class="fas fa-clipboard-list"></i> Data Suplier</a>
                </li>
            </ul>
            <hr>
            <div class="tab-content">
                <div class="active tab-pane" id="DataSuplier">
                    <div class="callout callout-info">
                        <div class="table-responsive ">
                            <table id="tblData" class="table table-bordered table-striped" width="100%"></table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>