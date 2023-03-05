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
    $('.mn-1').addClass('bg-brown');
    $("#txtTglStock").datepicker({
        changeMonth: true,
        changeYear: false,
        showButtonPanel: true,
        maxDate: '2018',
        minDate: -3,
        dateFormat: "yy-mm-dd",
        onSelect: function(date) {
            $(this).attr('disabled', 'disabled');
            $.get_detail_permintaan($(this).val());
        }
    });
    $("#tblData").dataTable({
        "bJQueryUI": true,
        "bAutoWidth": false,
        // "bProcessing": true,
        "iDisplayLength": 15,
        "aLengthMenu": [15, 30, 50, 100],
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
                "sTitle": "Kode",
                "mData": "kode",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "kode-" + oData.id;
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
                "sTitle": "Tanggal",
                "mData": "tanggal",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "tanggal-" + oData.id;
                    $(nTd).attr("id", id);
                }
            },
            {
                "sTitle": "Faktur",
                "mData": "faktur",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "kode-" + oData.id;
                    $(nTd).attr("id", id);
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
                "sTitle": "Di Buat",
                "mData": "name",
                "sClass": "text-right",
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
                        "<div class='btn-group'><div class='btn btn-sm btn-warning'><i id='i-color-" +
                        oData.id +
                        "' class='fas fa-bell'></i> <span></span></div></div>"
                    );
                    if (oData.status == null) {
                        $($(nTd).children()[0]).find("span").html("&nbsp;Menunggu");
                    } else if (oData.status == 'Y') {
                        $($(nTd).children()[0]).find("div").attr("class",
                            "btn btn-sm btn-info");
                        $($(nTd).children()[0]).find("i").html("&nbsp;Approve");
                        $.loop("#i-color-" + oData.id);
                    } else if (oData.status == 'Y') {
                        $($(nTd).children()[0]).find("div").attr("class",
                            "btn btn-sm btn-danger");
                        $($(nTd).children()[0]).find("span").html("&nbsp;Cancel");
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
                        "<div class='btn-group'><button type='button' class='btn btn-xs bg-blue mr-1'><i class='fas fa-print'></i> Print</button><button type='button' class='btn btn-xs bg-yellow '><i class='fas fa-eye'></i> Prosess</button></div>"
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
                        if (oData.status == null || oData.status == 'N') {
                            $.alert_swal_info('Prosess Penerimaan',
                                'Data Penerimaan Belum Di Approve',
                                'warning');
                            selectedId = false;
                        } else {
                            $.data_rincian(selectedId);
                            $('#tab-stock a[href="#FormTerima"]').trigger('click');
                        }
                    });

                }
            }
        ]
    });
    $("#submit_prosses").button().click(function() {
        if ($("#tblDataPenerimaan").dataTable().fnGetData().length > 0) {
            $('.load-Barang').append(
                '<div class="overlay"><i class="fas fa-2x fa-sync-alt fa-spin"></i></div>');
            objItems.dataTable = $("#tblDataPenerimaan").dataTable().fnGetData();
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
                        $('#tblDataPenerimaan').dataTable().fnClearTable();
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
        if ($("#tblDataPenerimaan").dataTable().fnGetData().length > 0) {
            objItems.dataTable = $("#tblDataPenerimaan").dataTable().fnGetData();
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
    $('#Form-Terima').click(function() {
        if (!selectedId) {
            $.alert_swal('Form Terima', 'Pilih Data Faktur Penerimaan', 'warning');
        } else {
            $("#submit_edit").show();
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
            "sAjaxSource": "<?php echo site_url('admin/get_data_table_source'); ?>?table=k_penjualan_toko&columns=,tanggal,kode,jenis,nama,satuan,qty&filds=faktur_id&var=" +
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
                    "sTitle": "qty",
                    "mData": "qty",
                    "sClass": "text-center",
                    "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                        var id = "qty-" + oData.id;
                        $(nTd).attr("id", id);
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
                $('#tab-stock a[href="#DataPermintaan"]').trigger('click');
                $("#tblData").dataTable().fnDraw();
            }
        })
    }
});
</script>
<div class="col-md-12">
    <div class="card card-outline card-yellow load-Barang">
        <div class="card-header">
            <h3 class="card-title col-lg-4 col-sm-12 mb-2">Data Faktur Penerimaan</h3>
        </div>
        <div class="card-body">
            <ul class="nav nav-pills" id="tab-stock">
                <li class="nav-item" id="Data-Permintaan"><a class="nav-link active border-left" href="#DataPermintaan"
                        data-toggle="tab"><i class="fas fa-clipboard-check"></i> List Faktur</a>
                </li>
                <li class="nav-item" id="Form-Terima"><a class="nav-link border-left" href="#FormTerima"
                        data-toggle="tab"><i class="fas fa-truck"></i> Form Penerimaan</a>
                </li>
            </ul>
            <hr>
            <div class="tab-content">
                <div class="active tab-pane" id="DataPermintaan">
                    <div class="callout callout-info">
                        <div class="table-responsive">
                            <table table id="tblData" class="table table-bordered table-striped"></table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="FormTerima">
                    <div class="callout callout-info">
                        <div class="table-responsive">
                            <table table id="tblDataRincian" class="table table-bordered table-striped"></table>
                        </div>
                        <div class="card-footer">
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
    </div>
</div>