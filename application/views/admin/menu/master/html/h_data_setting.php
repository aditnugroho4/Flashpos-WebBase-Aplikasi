<script>
$(document).ready(function() {
    $('.mn-5').addClass('bg-secondary');

    $("#tblData1").dataTable({
        "bJQueryUI": true,
        "bAutoWidth": true,
        "bProcessing": true,
        "iDisplayLength": 15,
        "aLengthMenu": [15, 50, 100, 200],
        "bServerSide": true,
        "sPaginationType": "full_numbers",
        "sAjaxSource": "<?php echo site_url('admin/get_data_table_source'); ?>?table=t_jenis_aduan&columns=,nama,m_unit.name&jwhere=unit_id&fildjoins=,m_unit.name&joins=m_unit&exports=m_unit",
        "aoColumns": [{
                "sTitle": "#",
                "mData": "no",
                "bSortable": false,
                "sClass": "center"
            },
            {
                "sTitle": "Jenis Aduan",
                "mData": "nama",
                "sClass": "center",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "unit_id-" + oData.id;
                    $(nTd).attr("id", id);
                    $(nTd).editable(
                        "<?php echo site_url('admin/update_grid/t_jenis_aduan '); ?>", {
                            "callback": function(sValue, y) {
                                /* Redraw the table from the new data on the server */
                                $("#tblData1").dataTable().fnDraw();
                            }
                        });
                }
            }, {
                "sTitle": "Bagian Terkait",
                "mData": "name",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "unit_id-" + oData.id;
                    $(nTd).attr("id", id);
                    $(nTd).editable(
                        "<?php echo site_url('admin/update_grid/t_jenis_aduan '); ?>?table=m_unit", {
                            loadurl: "<?php echo site_url('admin/get_editable_select'); ?>?table=m_unit&filds=name&select=" +
                                oData.unit_id,
                            type: "select",
                            submit: "OK",
                            "callback": function(sValue, y) {
                                /*Redraw the table from the new data on the server */
                                $("#tblData1").dataTable().fnDraw();
                            }
                        });
                }
            }
        ]
    });
    $("#tblData2").dataTable({
        "bJQueryUI": true,
        "bAutoWidth": true,
        "bProcessing": true,
        "iDisplayLength": 15,
        "aLengthMenu": [15, 50, 100, 200],
        "bServerSide": true,
        "sPaginationType": "full_numbers",
        "sAjaxSource": "<?php echo site_url('admin/get_data_table_source'); ?>?table=t_ctgr_aduan&columns=,nama,jenis_id&jwhere=jenis_id&fildjoins=,t_jenis_aduan.nama as namaJenis&joins=t_jenis_aduan&exports=t_jenis_aduan",
        "aoColumns": [{
                "sTitle": "#",
                "mData": "no",
                "bSortable": false,
                "sClass": "center"
            },
            {
                "sTitle": "Jenis Aduan",
                "mData": "namaJenis",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "jenis_id-" + oData.id;
                    $(nTd).attr("id", id);
                    $(nTd).editable(
                        "<?php echo site_url('admin/update_grid/t_ctgr_aduan'); ?>?table=t_jenis_aduan", {
                            loadurl: "<?php echo site_url('admin/get_editable_select'); ?>?table=t_jenis_aduan&filds=nama&select=" +
                                oData.unit_id,
                            type: "select",
                            submit: "OK",
                            "callback": function(sValue, y) {
                                /*Redraw the table from the new data on the server */
                                $("#tblData1").dataTable().fnDraw();
                            }
                        });
                }
            },
            {
                "sTitle": "Nama Katagori",
                "mData": "nama",
                "sClass": "center",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "nama-" + oData.id;
                    $(nTd).attr("id", id);
                    $(nTd).editable(
                        "<?php echo site_url('admin/update_grid/t_ctgr_aduan'); ?>", {
                            "callback": function(sValue, y) {
                                /* Redraw the table from the new data on the server */
                                $("#tblData1").dataTable().fnDraw();
                            }
                        });
                }
            },
        ]
    });
    $("#btnAdd").button().click(function() {
        $("#cmbUnit").empty();
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "<?php echo site_url('admin/multi_select');?>?table=m_role",
            success: function(data) {
                if (data == '') {
                    $("#cmbUnit").append('<option value="">-- No Result --</option>');
                } else {
                    $('#frm-add-jenis').modal('show');
                    $("#cmbUnit").append(
                        '<option value=""> -- Silahkan Pilih -- </option>');
                    for (var i = 0; i < data.length; i++) {
                        $("#cmbUnit").append("<option value='" + data[i].id + "'>" + data[i]
                            .name + "</option>");
                    }
                }
            }
        });
    });
    $('#add-data-jenis').submit(function(e) {
        e.preventDefault();
        if ($('#add-data-jenis').valid()) {
            $.ajax({
                type: "POST",
                dataType: 'json',
                url: "<?php echo site_url('admin/create/t_jenis_aduan'); ?>",
                data: {
                    nama: $("#txtJenis").val(),
                    unit_id: $("#cmbUnit option:selected").val()
                },
                success: function(data) {
                    if (data.error == false) {
                        $.swalDefaultAlert("error: " + data.error + "<br> Code: " + data
                            .code + " <br> message: " + data.message, 'success');
                        $("#tblData").dataTable().fnDraw();
                    } else {
                        $.swalDefaultAlert("error: " + data.error + "<br> Code: " + data
                            .code + " <br> message: " + data.message, 'success');
                        $("#tblData1").dataTable().fnDraw();
                    }
                    $('#frm-add-jenis').modal("hide");
                }
            });
        }
    });
    $("#btnAdd1").button().click(function() {
        $("#cmbJenis").empty();
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "<?php echo site_url('admin/multi_select');?>?table=t_jenis_aduan",
            success: function(data) {
                if (data == '') {
                    $("#cmbJenis").append('<option value="">-- No Result --</option>');
                } else {
                    $('#frm-add-ctgr').modal('show');
                    $("#cmbJenis").append(
                        '<option value=""> -- Silahkan Pilih -- </option>');
                    for (var i = 0; i < data.length; i++) {
                        $("#cmbJenis").append("<option value='" + data[i].id + "'>" + data[
                                i]
                            .nama + "</option>");
                    }
                }
            }
        });
    });
    $('#add-data-ctgr').submit(function(e) {
        e.preventDefault();
        if ($('#add-data-ctgr').valid()) {
            $.ajax({
                type: "POST",
                dataType: 'json',
                url: "<?php echo site_url('admin/create/t_ctgr_aduan'); ?>",
                data: {
                    nama: $("#txtCtgr").val(),
                    jenis_id: $("#cmbJenis option:selected").val()
                },
                success: function(data) {
                    if (data.error == false) {
                        $.swalDefaultAlert("error: " + data.error + "<br> Code: " + data
                            .code + " <br> message: " + data.message, 'success');
                        $("#tblData1").dataTable().fnDraw();
                    } else {
                        $.swalDefaultAlert("error: " + data.error + "<br> Code: " + data
                            .code + " <br> message: " + data.message, 'success');
                        $("#tblData2").dataTable().fnDraw();
                    }
                    $('#frm-add-ctgr').modal("hide");
                }
            });
        }
    });
});
</script>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-pencil-alt"></i>
            SETTING JENIS ADUAN
        </h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                title="Collapse">
                <i class="fas fa-minus"></i></button>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table table id="tblData1" class="table table-bordered table-striped"></table>
        </div>
    </div>
    <div class="card-footer">
        <button type="button" id="btnAdd" class="btn btn-app bg-green btn-sm"><i class="fas fa-file-alt"></i>Tambah
            Data</button>
        <button type="button" id="btnReload" class="btn btn-app bg-info btn-sm"><i
                class="fas fa-sync-alt"></i>Refresh</button>
    </div>
</div>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-pencil-alt"></i>
            SETTING KATEGORI ADUAN
        </h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                title="Collapse">
                <i class="fas fa-minus"></i></button>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table table id="tblData2" class="table table-bordered table-striped"></table>
        </div>
    </div>
    <div class="card-footer">
        <button type="button" id="btnAdd1" class="btn btn-app bg-green btn-sm"><i class="fas fa-file-alt"></i>Tambah
            Data</button>
        <button type="button" id="btnReload1" class="btn btn-app bg-info btn-sm"><i
                class="fas fa-sync-alt"></i>Refresh</button>
    </div>
</div>
<div id="frm-add-jenis" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
    <div role="document" class="modal-dialog">
        <div class="modal-content modal-col-light-blue">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data</h4>
            </div>
            <div class="modal-body">
                <div class="card card-primary">
                    <div class="card-header">
                        <p>Jenis Aduan</p>
                    </div>
                    <form id="add-data-jenis">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="txtJenis">Jenis</label>
                                <input type="text" id="txtJenis" placeholder="BOCOR" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="cmbUnit">Divisi Terkait</label>
                                <select id="cmbUnit" class="form-control" required></select>
                            </div>

                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-secondary">Close</button>
            </div>
        </div>
    </div>
</div>
<div id="frm-add-ctgr" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
    <div role="document" class="modal-dialog">
        <div class="modal-content modal-col-light-blue">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data</h4>
            </div>
            <div class="modal-body">
                <div class="card card-primary">
                    <div class="card-header">
                        <p>Katagori Aduan</p>
                    </div>
                    <form id="add-data-ctgr">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="cmbJenis">Jenis Aduan</label>
                                <select id="cmbJenis" class="form-control" required></select>
                            </div>
                            <div class="form-group">
                                <label for="txtCtgr">Nama Katagori</label>
                                <input type="text" id="txtCtgr" placeholder="BOCOR" class="form-control" required>
                            </div>


                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-secondary">Close</button>
            </div>
        </div>
    </div>
</div>