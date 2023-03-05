<script>
$(document).ready(function() {
    $('.mn-2').addClass('bg-brown');
    $("#tblData").dataTable({
        "bJQueryUI": true,
        "bAutoWidth": true,
        "bProcessing": true,
        "iDisplayLength": 15,
        "aLengthMenu": [15, 50, 100, 200],
        "bServerSide": true,
        "sPaginationType": "full_numbers",
        "sAjaxSource": "<?php echo site_url('admin/get_data_table_source'); ?>?table=b_product_ctgr&columns=,id,nama",
        "aoColumns": [{
                "sTitle": "#",
                "mData": "no",
                "bSortable": false,
                "sClass": "center"
            },
            {
                "sTitle": "Nama",
                "mData": "nama",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "nama-" + oData.id;
                    $(nTd).attr("id", id);
                    $(nTd).editable(
                        "<?php echo site_url('admin/update_grid/b_product_ctgr'); ?>", {
                            "callback": function(sValue, y) {
                                /* Redraw the table from the new data on the server */
                                $("#tblData").dataTable().fnDraw();
                            }
                        });
                }
            }
        ]
    });
    $("#btnAdd").button().click(function() {
        $('#add-data-ctgr')[0].reset();
        $('#frm-add-ctgr').modal('show');
    });
    $('#add-data-ctgr').submit(function(e) {
        e.preventDefault();
        if ($('#add-data-ctgr').valid()) {
            $.ajax({
                type: "POST",
                dataType: 'json',
                url: "<?php echo site_url('admin/create/b_product_ctgr'); ?>",
                data: {
                    nama: $("#txtNama").val()
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
            Data Katagori
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
                        <p>Katagori Product</p>
                    </div>
                    <form id="add-data-ctgr">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="txtNama">Katagori</label>
                                <input type="text" id="txtNama" placeholder="ex : ATK" maxlength="20"
                                    class="form-control" required>
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