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
    idUser: null,
    idPaket: null,
    idGrup: null,
    dataTable: null
};
$(document).ready(function() {
    Globalize.culture("id-ID");
    $('.mn-5').addClass('bg-brown');
    $("#tblData").dataTable({
        "bJQueryUI": true,
        "bAutoWidth": false,
        // "bProcessing": true,
        "iDisplayLength": 10,
        "aLengthMenu": [10, 20, 50, 100],
        "bServerSide": true,
        "sPaginationType": "full_numbers",
        "sAjaxSource": "<?php echo site_url('admin/get_data_table_source'); ?>?table=b_product_paketdetail&columns=,deskripsi,paket_id,item_id&jwhere=paket_id,item_id,b_product_item.grup_id&fildjoins=,b_product_paket.nama as Paket,b_product_item.nama as Items,b_product_item.harga,b_product_grup.nama as Grup&joins=b_product_paket,b_product_item,b_product_grup&exports=b_product_paket,b_product_item,b_product_grup",
        "aoColumns": [{
                "sTitle": "#",
                "mData": "no",
                "bSortable": false,
                "sClass": "center"
            },
            {
                "sTitle": "Paket",
                "mData": "Paket",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "paket_id-" + oData.id;
                    $(nTd).attr("id", id);
                }
            },
            {
                "sTitle": "Product",
                "mData": "Grup",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "grup_id-" + oData.id;
                    $(nTd).attr("id", id);
                }
            },
            {
                "sTitle": "Items",
                "mData": "Items",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "item_id-" + oData.id;
                    $(nTd).attr("id", id);
                }
            },
            {
                "sTitle": "Deskripsi",
                "mData": "deskripsi",
                "sClass": "text-center",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "deskripsi-" + oData.id;
                    $(nTd).attr("id", id);
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
                    if (data != null) {
                        return Globalize.format(Globalize.parseInt(data), "c");
                    } else {
                        return Globalize.format(0, "c");;
                    }
                }
            },
            {
                "sTitle": "Status",
                "sClass": "text-center",
                "mData": null,
                "bSortable": false,
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "status-" + oData.id;
                    $(nTd).attr("id", id);
                    fildeselect = "status";
                    if (oData.status == 'Y') {
                        htmlx =
                            "<button class='btn btn-xs bg-green'><i class='fas fa-check'></i></button>";
                        $(nTd).html(htmlx);
                        $($(nTd).children()[0]).button().click(function() {
                            selectedId = oData.id;
                            active = 'N';
                            $("#txtAlert").html("Menu ini akan di non aktive..?");
                            $("#dlgAlert").modal("show")
                        });
                    } else if (oData.status == 'N' || oData.status == null) {
                        htmlx =
                            "<button class='btn btn-xs bg-danger'><i class='fa fa-ban'></i></button>";
                        $(nTd).html(htmlx);
                        $($(nTd).children()[0]).button().click(function() {
                            selectedId = oData.id;
                            active = 'Y';
                            $("#txtAlert").html("Menu ini akan di aktive kan..?");
                            $("#dlgAlert").modal("show");
                        });
                    }
                }
            },
            {
                "sTitle": "Action",
                "mData": "id",
                "sClass": "text-center",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    $(nTd).html(
                        "<div class='btn-group'><button type='button' class='btn btn-xs bg-blue mr-1'><i class='fas fa-eye'></i> Edit</button></div>"
                    );
                    $($(nTd).find('.btn-group').children()[0]).button().click(function() {
                        selectedId = oData.id;
                        $('#frm-edit-paket').modal('show');
                        $.get_data_selected('#cmbGrup_e',oData.grup_id);
                        $('#txtNama_e').val(oData.Paket);
                        $('#txtItems_e').val(oData.Items);
                        $('#txtDeskripsi_e').val(oData.deskripsi);
                    });
                }
            }
        ]
    });
    
    jenis_paket();
    function jenis_paket() {
        $("#cmbPaket").empty();
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "<?php echo site_url('admin/multi_select');?>?table=b_product_paket",
            success: function(data) {
                if (data == '') {
                    $("#cmbPaket").append("<option value=''> -- No Result -- </option>");
                } else {
                    $("#cmbPaket").append(
                        "<option value=''> -- Pilih -- </option>");
                    for (var i = 0; i < data.length; i++) {
                        $("#cmbPaket").append("<option value='" + data[i].id + "'name='" + data[i]
                            .price + "'>" +
                            data[i].nama + "</option>");
                    }
                }
            }
        });
    }
    $("#cmbPaket").change(function() {
        $(this).attr('disabled', 'disabled');
        akunPaket = $(this).find('option:selected').attr('name');
        objItems.idPaket = $(this, 'option:selected').val();
        $("#cmbProduct").empty();
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "<?php echo site_url('admin/multi_select');?>?table=b_product_grup",
            success: function(data) {
                if (data == '') {
                    $("#cmbProduct").append("<option value=''> -- No Result -- </option>");
                } else {
                    $("#cmbProduct").append(
                        "<option value=''> -- Pilih -- </option>");
                    for (var i = 0; i < data.length; i++) {
                        $("#cmbProduct").append("<option value='" + data[i].id + "'>" +
                            data[i]
                            .nama + "</option>");
                    }
                }
            }
        });
    });
    $("#cmbProduct").change(function() {
        $(this).attr('disabled', 'disabled');
        objItems.idGrup= $(this, 'option:selected').val();
    });
    $("#txtSearch").autocomplete({
        source: function(query, response) {
            $.ajax({
                type: "POST",
                dataType: 'json',
                url: "<?= site_url('admin/get_data_product');?>?table=b_product_item&columns=,nama,deskripsi,kode&fild=grup_id&id="+objItems.idGrup+"&aSearch=" + query.term,
                success: function(data) {
                    response($.map(data, function(value, key) {
                        // console.log(value);
                        return {
                            label: value.kode + " (" + value.nama +" )",
                            value: value
                        };
                    }));
                }
            });
        },
        minLength: 3,
        focus: function(event, ui) {
            $("#txtSearch").val(ui.item.label);
            return false;
        },
        select: function(event, ui) {
            objItems.id = ui.item.value.id;
            objItems.kode = ui.item.value.kode;
            objItems.nama = ui.item.value.nama;
            objItems.idUser = $User;
            $("#txtDeskripsi").focus();
            return false;
        }
    });
    $("#tblDataPaket").DataTable({
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
                "sTitle": "Kode Item",
                "sClass": "text-center"
            },
            {
                "sTitle": "Nama Item"
            },
            {
                "sTitle": "Deskripsi",
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
                        var row = $("#tblDataPaket").dataTable().fnGetData()[idx];
                        $("#tblDataPaket").dataTable().fnDeleteRow(idx);
                        if ($("#tblDataPaket").dataTable().fnGetData().length > 0) {
                            $("#tblDataPaket tbody tr").each(function(index) {
                                $($(this).children()[0]).html(index + 1);
                            });
                        }
                        $('#txtSearch').focus()
                    });
                }
            }
        ]
    });
    $("#submit_input").button().click(function() {
       if ($('#txtDeskripsi').val().length > 0 ) {
            $("#tblDataPaket").dataTable().fnAddData(
                [
                    $("#tblDataPaket").dataTable().fnGetData().length + 1,
                    objItems.kode,
                    objItems.nama,
                    $('#txtDeskripsi').val(),
                    $('#cmbPaket option:selected').val(),
                    $('#cmbProduct option:selected').val(),
                    objItems.id
                ]
            );
            $("#txtDeskripsi").val('');
            $("#txtSearch").val('');
            $("#txtSearch").focus();
        } else {
            $('#txtDeskripsi').focus();
        }
    });
    $("#submit_clear").button().click(function() {
        $('#cmbPaket').attr('disabled', 'disabled');
        $('#cmbProduct').attr('disabled', 'disabled');
        $("#txtDeskripsi").val('');
        $("#txtSearch").val('');
        $("#txtSearch").focus();
    });
    $("#submit_batal").button().click(function() {
        if ($('#tblDataPaket').dataTable().fnGetData().length > 0) {
            $('#tblDataPaket').dataTable().fnClearTable();
        }
        $('#cmbPaket').removeAttr('disabled', 'disabled');
        $('#cmbProduct').removeAttr('disabled', 'disabled');
        $("#txtDeskripsi").val('');
        $("#txtSearch").val('');
        $("#txtSearch").focus();
    });
    $("#submit_prosses").button().click(function() {
        if ($("#tblDataPaket").dataTable().fnGetData().length >0) {
            $('.load-Barang').append(
                '<div class="overlay"><i class="fas fa-2x fa-sync-alt fa-spin"></i></div>');
            objItems.dataTable = $("#tblDataPaket").dataTable().fnGetData();
            var data = $.base64.encode(JSON.stringify(objItems));
            data = data.replaceAll(".", "^");
            data = data.replaceAll("+", "-");
            data = data.replaceAll("/", "_");
            $.ajax({
                type: "POST",
                data: "data=" + data,
                dataType: 'json',
                url: "<?php echo site_url('admin/create_item_paket'); ?>",
                success: function(msg) {
                    if (msg.error == false) {
                        $('#tblDataPaket').dataTable().fnClearTable();
                        $('.load-Barang').find('.overlay').remove();
                        $.alert_swal('Tambah Item Paket', msg.message, 'success');
                    } else {
                        $('.load-Barang').find('.overlay').remove();
                        $.alert_swal('Tambah Item Paket', msg.message, 'warning');
                    }
                }
            });
        } else {
            $.alert_swal_info("Tambah Item Paket", " Item Masih Kosong..", "warning");
            $("#txtSearch").focus();
        }
    });
    $('#Data-Paket').click(function() {
        selectedId = false;
    });
    $.get_data_selected = function(tag,id) {
        $(tag).empty();
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "<?php echo site_url('admin/multi_select');?>?table=b_product_grup",
            success: function(data) {
                if (data == '') {
                    $(tag).append("<option value=''> -- No Result -- </option>");
                } else {
                    $(tag).append(
                        "<option value=''> -- Pilih -- </option>");
                    for (var i = 0; i < data.length; i++) {
                        $(tag).append("<option value='" + data[i].id + "'>" +
                            data[i].nama + "</option>");
                    }
                    if (id != false) {
                        $(tag).val(id);
                        $(tag).change();
                    }
                }
            }
        });
    }
    $("#cmbGrup_e").change(function() {
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "<?php echo site_url('admin/multi_select');?>?table=b_product_item&select=grup_id&id=" +
                $("#cmbGrup_e option:selected").val(),
            success: function(data) {
                $("#cmbItems_e").empty();
                if (data == '') {
                    $("#cmbItems_e").append(
                        "<option value=''> -- No Result -- </option>");
                } else {
                    $("#cmbItems_e").append(
                        "<option value=''> -- Pilih -- </option>");
                    for (var i = 0; i < data.length; i++) {
                        $("#cmbItems_e").append('<option value="' + data[i].id + '">' +
                            data[i].nama+ '</option>');
                    }
                }
            }
        });
    });
    $("#edit-data-paket").submit(function(e) {
        e.preventDefault();
            if ($('#edit-data-paket').valid()) {
                $('.loadding').append(
                    '<div class="overlay"><i class="fas fa-2x fa-sync-alt fa-spin"></i></div>');
                $.ajax({
                    type: "POST",
                    dataType: 'json',
                    url: "<?php echo site_url('admin/update/b_product_paketdetail'); ?>",
                    data: {
                        id: selectedId,
                        grup_id: $("#cmbGrup_e option:selected").val(),
                        item_id: $("#cmbItems_e option:selected").val(),
                        deskripsi: $("#txtDeskripsi_e").val()
                    },
                    success: function(msg) {
                        if (msg.error == false) {
                            $('.loadding').find('.overlay').remove();
                            $('#edit-data-paket')[0].reset();
                            $('#frm-edit-paket').modal('hide');
                            $.alert_swal('Data Item Paket', msg
                                .message, 'success');
                        } else {
                            $('.loadding').find('.overlay').remove();
                            $('#frm-edit-paket').modal('hide');
                            $.alert_swal_info('Data Item Paket', msg
                                .message, 'warning');
                        }
                    }
                });
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
                $('#tab-items-paket a[href="#DataPaket"]').trigger('click');
                $("#tblData").dataTable().fnDraw();
            }
        })
    }
});
</script>
<div class="col-md-12">
    <div class="card card-outline card-yellow load-Barang">
        <div class="card-header">
            <h3 class="card-title col-lg-4 col-sm-12 mb-2">Daftar Item Paket</h3>
        </div>
        <div class="card-body">
            <ul class="nav nav-pills" id="tab-items-paket">
                <li class="nav-item" id="Data-Paket"><a class="nav-link active border-left" href="#DataPaket"
                        data-toggle="tab"><i class="fas fa-clipboard-check"></i> Data Item Paket</a>
                </li>
                <li class="nav-item" id="Add-Paket"><a class="nav-link border-left" href="#AddItems"
                        data-toggle="tab"><i class="fas fa-plus"></i> Tambah Item Paket</a>
                </li>
            </ul>
            <hr>
            <div class="tab-content">
                <div class="active tab-pane" id="DataPaket">
                    <div class="callout callout-info">
                        <div class="table-responsive scroll-bar" style="max-height:350px;">
                            <table table id="tblData" class="table table-bordered table-striped"></table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="AddItems">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="callout callout-info">
                                    <div class="form-group">
                                        <label for="cmbPaket" class="col-form-label">Nama Paket</label>
                                        <div class="input-group">
                                            <select id="cmbPaket" class="form-control"></select>
                                            <div class="input-group-append">
                                                <span class="input-group-text btn"><i class="fas fa-folder"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="cmbProduct" class="col-form-label">Product</label>
                                        <div class="input-group">
                                            <select id="cmbProduct" class="form-control"></select>
                                            <div class="input-group-append">
                                                <span class="input-group-text btn"><i class="fas fa-folder"></i>
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
                                        <label>Deskripsi</label>
                                        <textarea type="text" id="txtDeskripsi" class="form-control"
                                            maxlength="200"></textarea>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="form-group">
                                        <button type="button" id="submit_input"
                                            class="btn btn-info float-right">Input</button>
                                        <button type="button" id="submit_clear"
                                            class="btn btn-warning ml-1 float-right">Clear</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="callout callout-info">
                                    <label>List Paket</label>
                                    <div class="table-responsive scroll-bar" style="min-height:320px;max-height:320px;">
                                        <table table id="tblDataPaket" class="table table-bordered table-striped">
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
            </div>
        </div>
    </div>
</div>
<div id="frm-edit-paket" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
    <div role="document" class="modal-dialog">
        <div class="modal-content loadding">
            <div class="modal-header">
                <h4 class="modal-title">Edit Items</h4>
            </div>
            <div class="modal-body">
                <div class="card card-primary">
                    <div class="card-header">
                        <p>Ubah Data Item Paket</p>
                    </div>
                    <form id="edit-data-paket">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="txtNama_e">Nama Paket</label>
                                        <input id="txtNama_e" type="text" disabled="disabled"class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="cmbGrup_e">Product</label>
                                        <select id="cmbGrup_e" class="form-control" required></select>
                                    </div>
                                    <div class="form-group">
                                        <label for="txtItems_e">Product Item Sebelumnya</label>
                                        <input type="text" id="txtItems_e" class="form-control" disabled="disabled" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="cmbItems_e">Product Item Baru</label>
                                        <select id="cmbItems_e" class="form-control" required></select>
                                    </div>
                                    <div class="form-group">
                                        <label for="txtDeskripsi_e">Deskripsi</label>
                                        <textarea id="txtDeskripsi_e" class="form-control" required></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary float-right">Simpan</button>
                                <button type="button" data-dismiss="modal"
                                    class="btn btn-secondary float-right mr-2">Close</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>