<script>
$(document).ready(function() {
    $('.mn-1').addClass('bg-brown');
    $("#tblData").dataTable({
        "bJQueryUI": true,
        "bAutoWidth": true,
        "bProcessing": true,
        "iDisplayLength": 10,
        "aLengthMenu": [10, 20, 50, 100],
        "bServerSide": true,
        "sPaginationType": "full_numbers",
        "sAjaxSource": "<?php echo site_url('admin/get_data_table_source'); ?>?table=k_grup_inventory&columns=,kode,nama,brand_id&jwhere=brand_id&fildjoins=,m_brand.nama as Brands&joins=m_brand&exports=m_brand",
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
                "sTitle": "Grup Items",
                "mData": "nama",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "nama-" + oData.id;
                    $(nTd).attr("id", id);
                    $(nTd).editable(
                        "<?php echo site_url('admin/update_grid/k_grup_inventory'); ?>", {
                            "callback": function(sValue, y) {
                                /* Redraw the table from the new data on the server */
                                $("#tblData").dataTable().fnDraw();
                            }
                        });
                }
            },
            {
                "sTitle": "Brand",
                "mData": "Brands",
                "sClass": "center",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "brand_id-" + oData.id;
                    $(nTd).attr("id", id);
                    $(nTd).editable(
                        "<?php echo site_url('admin/update_grid/k_grup_inventory'); ?>?table=m_brand", {
                            loadurl: "<?php echo site_url('admin/get_editable_select'); ?>?table=m_brand&filds=nama&select=" +
                                oData.unit_id,
                            type: "select",
                            submit: "OK",
                            "callback": function(sValue, y) {
                                /*Redraw the table from the new data on the server */
                                $("#tblData").dataTable().fnDraw();
                            }
                        });
                }
            }

        ]
    });
    $("#btnAdd").button().click(function() {
        $('#add-data-ctgr')[0].reset();
        $.auto_number("k_grup_inventory", "2", "#txtKode");
        $("#cmbBrand").empty();
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "<?php echo site_url('admin/multi_select');?>?table=m_brand",
            success: function(data) {
                if (data == '') {
                    $("#cmbBrand").append('<option value="">-- No Result --</option>');
                } else {
                    $("#cmbBrand").append(
                        '<option value=""> -- Silahkan Pilih -- </option>');
                    for (var i = 0; i < data.length; i++) {
                        $("#cmbBrand").append("<option value='" + data[i].id + "'>" + data[
                            i].nama + "</option>");
                    }
                }
                $('#frm-add-ctgr').modal('show');
            }
        });
    });
    $('#add-data-ctgr').submit(function(e) {
        e.preventDefault();
        if ($('#add-data-ctgr').valid()) {
            $.ajax({
                type: "POST",
                dataType: 'json',
                url: "<?php echo site_url('admin/create/k_grup_inventory'); ?>",
                data: {
                    kode: $('#txtKode').val(),
                    nama: $("#txtNama").val(),
                    keterangan: $("#txtKeterangan").val(),
                    brand_id: $("#cmbBrand option:selected").val()
                },
                success: function(msg) {
                    if (msg.error == false) {
                        $.alert_swal('Tambah Data', msg.message, 'success');
                    } else {
                        $.alert_swal('Tambah Data', msg.message, 'warning');
                    }
                }
            });
        }
    });
    $("#btnReload").button().click(function() {
        $("#tblData").dataTable().fnDraw();
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
                $('#frm-add-ctgr').modal("hide");
                $("#tblData").dataTable().fnDraw();
            }
        })
    }
});
</script>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-pencil-alt"></i>
            Grup Items
        </h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                title="Collapse">
                <i class="fas fa-minus"></i></button>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table table id="tblData" class="table table-bordered table-striped"></table>
        </div>
    </div>
    <div class="card-footer">
        <button type="button" id="btnAdd" class="btn btn-app bg-brown btn-sm"><i class="fas fa-file-alt"></i>Tambah
            Data</button>
        <button type="button" id="btnReload" class="btn btn-app bg-brown btn-sm"><i
                class="fas fa-sync-alt"></i>Refresh</button>
    </div>
</div>
<div id="frm-add-ctgr" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" class="modal fade">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data</h4>
            </div>
            <div class="modal-body">
                <div class="card card-brown">
                    <div class="card-header">
                        <p>Grup Inventory</p>
                    </div>
                    <form id="add-data-ctgr">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="txtKode">Kode</label>
                                <input type="text" id="txtKode" class="form-control" disabled="disabled" required>
                            </div>
                            <div class="form-group">
                                <label for="txtNama">Grup</label>
                                <input type="text" id="txtNama" placeholder="ex : ATK" maxlength="100"
                                    class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="cmbBrand">Brand</label>
                                <select id="cmbBrand" class="form-control" required></select>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="float-right">
                                <button type="button" data-dismiss="modal" class="btn btn-brown">Close</button>
                                <button type="submit" class="btn btn-brown">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>