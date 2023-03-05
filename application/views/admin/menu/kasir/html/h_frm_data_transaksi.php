<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<script type="text/javascript">
var fildeselect;
var active;
var eleFocus = '';
$(document).ready(function() {
    Globalize.culture("id-ID");
    $('.mn-2').addClass('bg-brown');
    let Url = "";
    if ($role == 1) {
        Url =
            "<?php echo site_url('admin/get_data_table_source'); ?>?table=k_transaksi&columns=,nota,tanggal,shift,user_id&jwhere=user_id&fildjoins=,m_user.nama&joins=m_user&exports=m_user";
    } else {
        Url =
            "<?php echo site_url('admin/get_data_table_source'); ?>?table=k_transaksi&columns=,nota,tanggal,shift,user_id&jwhere=user_id&fildjoins=,m_user.nama&joins=m_user&exports=m_user&filds=k_transaksi.user_id&var=" +
            $User;
    }
    $("#tblData").dataTable({
        "bJQueryUI": true,
        "bAutoWidth": false,
        // "bProcessing": true,
        "iDisplayLength": 5,
        "aLengthMenu": [10, 20, 50],
        "bServerSide": true,
        "sPaginationType": "full_numbers",
        "sAjaxSource": Url,
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
                "sTitle": "Nota",
                "mData": "nota",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "nota-" + oData.id;
                    $(nTd).attr("id", id);
                }
            },
            {
                "sTitle": "Shift",
                "mData": "shift",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "shift-" + oData.id;
                    $(nTd).attr("id", id);
                }
            },
            {
                "sTitle": "No Meja",
                "mData": "meja",
                "sClass": "text-center",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "meja-" + oData.id;
                    $(nTd).attr("id", id);
                }
            },
            {
                "sTitle": "Item's",
                "mData": "qty",
                "sClass": "text-center",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "qty-" + oData.id;
                    $(nTd).attr("id", id);
                }
            },
            {
                "sTitle": "Kasir",
                "mData": "nama",
                "sClass": "text-center",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "user_id-" + oData.id;
                    $(nTd).attr("id", id);
                }
            },
            {
                "sTitle": "Status",
                "mData": "canceled",
                "sClass": "text-center",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "canceled-" + oData.id;
                    $(nTd).html(
                        "<div class='btn-group'><div class='btn btn-sm btn-info'><i id='i-color-" +
                        oData.id +
                        "' class='fas fa-bell'></i> <span></span></div></div>"
                    );
                    if (oData.canceled == null) {
                        $($(nTd).children()[0]).find("span").html("&nbsp;Valid");
                    } else if (oData.canceled == 'Y') {
                        $($(nTd).children()[0]).find("div").attr("class",
                            "btn btn-sm btn-success");
                        $($(nTd).children()[0]).find("i").html("&nbsp;Cancel");
                    }
                }
            },
            {
                "sTitle": "Action",
                "mData": "id",
                "sClass": "text-center",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    $(nTd).html(
                        "<div class='btn-group'><button type='button' class='btn btn-xs bg-blue mr-1'><i class='fas fa-print'></i> Print</button><button type='button' class='btn btn-xs bg-green '><i class='fas fa-cart-plus'></i> Pilih</button></div>"
                    );
                    $($(nTd).find('.btn-group').children()[0]).button().click(function() {
                        selectedId = oData.id;
                        if (oData.canceled == null) {
                            window.open(
                                "<?= site_url('Kasir/print_struk'); ?>?id=" +
                                selectedId +
                                "&fak=1", 'Struk Pembelian', 'width=390,height=670');
                        }
                    });
                    $($(nTd).find('.btn-group').children()[1]).button().click(function() {
                        if (oData.canceled == null) {
                            selectedId = oData.id;
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
            <h3 class="card-title col-lg-4 col-sm-12 mb-2">Data Transakasi </h3>
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