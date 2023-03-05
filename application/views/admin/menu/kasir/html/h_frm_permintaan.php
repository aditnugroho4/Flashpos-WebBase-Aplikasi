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
    $("#txtTglStock").datepicker({
        changeMonth: true,
        changeYear: false,
        showButtonPanel: true,
        maxDate: '2018',
        minDate: '@minDate',
        dateFormat: "yy-mm-dd",
        onSelect: function(date) {
            $(this).attr('disabled', 'disabled');
            $('#txtSearch').focus();
        }
    });
    jenis_permintaan();

    function jenis_permintaan() {
        $("#cmbJenis").empty();
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "<?php echo site_url('admin/multi_select');?>?table=m_akun",
            success: function(data) {
                if (data == '') {
                    $("#cmbJenis").append("<option value=''> -- No Result -- </option>");
                } else {
                    $("#cmbJenis").append(
                        "<option value=''> -- Pilih -- </option>");
                    for (var i = 0; i < data.length; i++) {
                        $("#cmbJenis").append("<option value='" + data[i].id + "'name='" + data[i]
                            .kode + "'>" +
                            data[i].nama + "</option>");
                    }
                }
            }
        });
    }
    $("#cmbJenis").change(function() {
        $(this).attr('disabled', 'disabled');
        akun = $(this).find('option:selected').attr('name');
        objItems.idAkun = $(this, 'option:selected').val();
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
        "sAjaxSource": "<?php echo site_url('admin/get_data_table_source'); ?>?table=k_faktur&columns=,tanggal,faktur&jwhere=user_id&fildjoins=,m_user.nama&joins=m_user&exports=m_user",
        "aoColumns": [{
                "sTitle": "#",
                "mData": "no",
                "bSortable": false,
                "sClass": "center"
            },
            {
                "sTitle": "Kode",
                "mData": "kode",
                "sClass": "text-center",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "kode-" + oData.id;
                    $(nTd).attr("id", id);
                }
            },
            {
                "sTitle": "Tanggal",
                "mData": "tanggal",
                "sClass": "text-center",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "tanggal-" + oData.id;
                    $(nTd).attr("id", id);
                }
            },
            {
                "sTitle": "Faktur",
                "mData": "faktur",
                "sClass": "text-center",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "faktur-" + oData.id;
                    $(nTd).attr("id", id);
                }
            },
            {
                "sTitle": "Di Buat",
                "mData": "nama",
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
                    } else if (oData.status == 'P') {
                        $($(nTd).children()[0]).find("div").attr("class",
                            "btn btn-sm btn-brown");
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
                        "<div class='btn-group'><button type='button' class='btn btn-xs bg-blue mr-1'><i class='fas fa-print'></i> Print</button><button type='button' class='btn btn-xs bg-yellow '><i class='fas fa-eye'></i> View</button></div>"
                    );
                    $($(nTd).find('.btn-group').children()[0]).button().click(function() {
                        selectedId = oData.id;
                        window.open(
                            "<?= site_url('Kasir/print_permintaan'); ?>?id=" +
                            $.base64.encode(oData.id), 'Form Permintaan',
                            'width=390,height=650');
                        return false;
                    });
                    $($(nTd).find('.btn-group').children()[1]).button().click(function() {
                        selectedId = oData.id;
                        $.data_rincian(selectedId);
                        $('#tab-stock a[href="#DetailStock"]').trigger('click');
                    });
                }
            }
        ]
    });
    $("#txtSearch").autocomplete({
        source: function(query, response) {
            var Url = "";
            if (akun == "01") {
                Url =
                    "<?= site_url('kasir/json_search_data');?>?table=k_item_barang&columns=,nama,deskripsi,kode&Sts=Y&aSearch=";
            } else {
                Url =
                    "<?= site_url('kasir/json_search_data');?>?table=k_item_inventory&columns=,nama,deskripsi,kode&Sts=Y&aSearch=";
            }
            $.ajax({
                type: "POST",
                dataType: 'json',
                url: Url + query.term,
                success: function(data) {
                    response($.map(data, function(value, key) {
                        // console.log(value);
                        return {
                            label: value.kode + " (" + value.nama + " )",
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
            objItems.nama = ui.item.value.nama;
            objItems.satuan = ui.item.value.satuan;
            objItems.foto = ui.item.value.foto;
            objItems.idJenis = ui.item.value.jenis_id;
            objItems.idUser = $User;
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
                "sTitle": "Kode Barang",
                "sClass": "text-center"
            },
            {
                "sTitle": "Nama Barang"
            },
            {
                "sTitle": "Stock",
                "sClass": "text-center"
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
                        var row = $("#tblDataStock").dataTable().fnGetData()[idx];
                        $("#tblDataStock").dataTable().fnDeleteRow(idx);
                        if ($("#tblDataStock").dataTable().fnGetData().length > 0) {
                            $("#tblDataStock tbody tr").each(function(index) {
                                $($(this).children()[0]).html(index + 1);
                            });
                        }
                        $('#txtSearch').focus()
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
                    objItems.nama,
                    $("#txtQty").val(),
                    objItems.tanggal = $('#txtTglStock').val(),
                    objItems.foto,
                    objItems.satuan,
                    objItems.idJenis,
                ]
            );
            $("#txtQty").val('');
            $("#txtSearch").val('');
            $("#txtSearch").focus();
        } else {
            $('#txtQty').focus();
        }
    });
    $("#submit_clear").button().click(function() {
        $("#txtQty").val('');
        $("#txtSearch").val('');
        $("#txtSearch").focus();
        $("#txtSearch").removeAttr('disabled');
    });
    $("#submit_batal").button().click(function() {
        if ($('#tblDataStock').dataTable().fnGetData().length > 0) {
            $('#tblDataStock').dataTable().fnClearTable();
        }
        $(this).removeAttr('disabled');
    });
    $("#submit_prosses").button().click(function() {
        if ($("#txtTglStock").val().length > 0 && $("#tblDataStock").dataTable().fnGetData().length >
            0) {
            $('.load-Barang').append(
                '<div class="overlay"><i class="fas fa-2x fa-sync-alt fa-spin"></i></div>');
            objItems.dataTable = $("#tblDataStock").dataTable().fnGetData();
            objItems.idUser = $User;
            var data = $.base64.encode(JSON.stringify(objItems));
            data = data.replaceAll(".", "^");
            data = data.replaceAll("+", "-");
            data = data.replaceAll("/", "_");
            $.ajax({
                type: "POST",
                data: "data=" + data,
                dataType: 'json',
                url: "<?php echo site_url('kasir/prosess_stock_permintaan'); ?>",
                success: function(msg) {
                    if (msg.error == false) {
                        $('#tblDataStock').dataTable().fnClearTable();
                        $('.load-Barang').find('.overlay').remove();
                        $.alert_swal('Form Permintaan', msg.message, 'success');
                    } else {
                        $('.load-Barang').find('.overlay').remove();
                        $.alert_swal('Form Permintaan', msg.message, 'warning');
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
    $('#Detail-Stock').click(function() {
        if (!selectedId) {
            $.alert_swal('Rincian Permintaan', 'Pilih Button View Di Data Tabel', 'warning');
            if ($.fn.DataTable.isDataTable("#tblDataDetail")) {
                $("#tblDataDetail").dataTable().fnDestroy();
            }
        } else {
            $("#btn-print-permintaan").show();
        }
    });
    $('#Data-Stock').click(function() {
        selectedId = false;
    });
    $("#btn-print-table").button().click(function() {
        if ($('#tblDataDetail').dataTable().fnGetData().length > 0 && selectedId) {
            window.open("<?= site_url('Kasir/print_permintaan'); ?>?id=" + $.base64.encode(
                selectedId), 'Form Permintaan', 'width=390,height=750');
        }
    });
    $("#btn-import").button().click(function() {
        if ($("#txtTglStock").val().length > 0 && $("#cmbJenis option:selected").val().length > 0) {
            $('.load-Barang').append(
                '<div class="overlay"><i class="fas fa-2x fa-sync-alt fa-spin"></i></div>');
            $("#txtSearch").attr('disabled, disabled');
            $.ajax({
                type: "POST",
                dataType: 'json',
                url: "<?php echo site_url('admin/multi_select');?>?table=k_item_barang",
                success: function(data) {
                    if (data != "") {
                        $('#tblDataStock').dataTable().fnClearTable();
                        for (var i = 0; i < data.length; i++) {
                            $("#tblDataStock").dataTable().fnAddData(
                                [
                                    $("#tblDataStock").dataTable().fnGetData().length +
                                    1,
                                    data[i].kode,
                                    data[i].nama,
                                    0,
                                    objItems.tanggal = $('#txtTglStock').val(),
                                    data[i].foto,
                                    data[i].satuan,
                                    data[i].jenis_id,
                                ]
                            );
                        }
                        $('.load-Barang').find('.overlay').remove();
                        $("#txtSearch").removeAttr('disabled');
                        $("#btn-import").attr('disabled', 'disabled');
                        $.alert_swal_info('Form Permintaan', data.message, 'success');
                    } else {
                        $('.load-Barang').find('.overlay').remove();
                        $.alert_swal_info('Form Permintaan', data.message, 'warning');
                    }
                }
            });
        } else {
            $.alert_swal_info("Prosess Stock", " Tentukan Tanggal atau Data masih Kosing", "warning");
            $("#txtTglStock").focus();
        }
    });
    $.data_rincian = function($id) {
        if ($.fn.DataTable.isDataTable("#tblDataDetail")) {
            $("#tblDataDetail").dataTable().fnDestroy();
        }
        $("#tblDataDetail").dataTable({
            "bJQueryUI": true,
            "bAutoWidth": false,
            // "bProcessing": true,
            "iDisplayLength": 15,
            "aLengthMenu": [15, 30, 50, 100],
            "bServerSide": true,
            "sPaginationType": "full_numbers",
            "sAjaxSource": "<?php echo site_url('admin/get_data_table_source'); ?>?table=k_permintaan&columns=,tanggal,kode,jenis,nama,harga,diskon,stock,qty&filds=faktur_id&var=" +
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
                    "sTitle": "Nama",
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
                    "sTitle": "Foto",
                    "mData": "foto",
                    "sClass": "text-center",
                    "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                        var id = "foto-" + oData.id;
                        $(nTd).attr("id", id);
                        if (oData.foto == null) {
                            htmlx =
                                "<div class='from-group'><img class='img-thumbnail' width='45' height='45' src='<?= base_url('asset/images/product/no-img.png'); ?>'></div>";
                            $(nTd).html(htmlx);
                        } else {
                            htmlx =
                                "<div class='from-group thumbnail'><img class='img-thumbnail'width='45' height='45' src='<?= base_url('asset/images/product/kuliner'); ?>/" +
                                oData.foto + "' alt='' ></div>";
                            $(nTd).html(htmlx);
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
            }
        })
    }
});
</script>
<div class="col-md-12">
    <div class="card card-outline card-yellow load-Barang">
        <div class="card-header">
            <h3 class="card-title col-lg-4 col-sm-12 mb-2">Permintaan Barang </h3>
        </div>
        <div class="card-body">
            <ul class="nav nav-pills" id="tab-stock">
                <li class="nav-item" id="Add-Stock"><a class="nav-link active border-left" href="#AddStock"
                        data-toggle="tab"><i class="fas fa-cart-plus"></i> Buat Permintaan</a>
                </li>
                <li class="nav-item" id="Data-Stock"><a class="nav-link border-left" href="#DataStock"
                        data-toggle="tab"><i class="fas fa-clipboard-list"></i> Data Permintaan</a>
                </li>
                <li class="nav-item" id="Detail-Stock"><a class="nav-link border-left" href="#DetailStock"
                        data-toggle="tab"><i class="fas fa-boxes"></i> Rincian Permintaan</a>
                </li>
            </ul>
            <hr>
            <div class="tab-content">
                <div class="active tab-pane" id="AddStock">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="callout callout-info">
                                    <div class="form-group">
                                        <label for="cmbJenis" class="col-form-label">Permintaan</label>
                                        <div class="input-group">
                                            <select id="cmbJenis" class="form-control"></select>
                                            <div class="input-group-append">
                                                <span class="input-group-text btn"><i class="fas fa-folder"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="txtTglStock" class="col-form-label">Tanggal</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="txtTglStock"
                                                disabled="disabled">
                                            <div class="input-group-append">
                                                <span class="input-group-text btn stock"><i class="fa fa-calendar"></i>
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
                                                <span class="input-group-text btn search"><i class="fas fa-search"></i>
                                                </span>
                                            </div>
                                        </div>
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
                                    <div class="form-group">
                                        <label>Import Dari Data Master</label>
                                        <div class="input-group">
                                            <button type="button" id="btn-import"
                                                class="btn btn-warning float-right">Import</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="callout callout-info">
                                    <label>List Stock</label>
                                    <div class="table-responsive scroll-bar" style="min-height:320px;max-height:320px;">
                                        <table table id="tblDataStock" class="table table-bordered table-striped">
                                        </table>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="float-right">
                                        <button type="button" id="submit_prosses" class="btn btn-brown"><i
                                                class="fas fa-cart-plus"></i>
                                            Prosess</button>
                                        <button type="button" id="submit_batal" class="btn btn-brown"><i
                                                class="fas fa-eraser"></i>
                                            Batal</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class=" tab-pane" id="DataStock">
                    <div class="callout callout-info">
                        <div class="table-responsive">
                            <table id="tblData" class="table table-bordered table-striped" width="100%"></table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="DetailStock">
                    <div class="callout callout-info">
                        <div class="table-responsive">
                            <table id="tblDataDetail" class="table table-bordered table-striped" width="100%"></table>
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