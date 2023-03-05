<script>
$(document).ready(function() {
    $('.mn-2').addClass('bg-brown');
    $('.dropify').dropify({
        messages: {
            default: 'Kembali Ke asal..',
            replace: 'Ganti file Atau Gambar',
            remove: 'Hapus',
            error: 'Ada Kesalahan Saat Upload File atau gambar..!'
        }
    });
    $("#tblData").dataTable({
        "bJQueryUI": true,
        "bAutoWidth": false,
        "bProcessing": true,
        "iDisplayLength": 15,
        "aLengthMenu": [15, 50, 100, 200],
        "bServerSide": true,
        "sPaginationType": "full_numbers",
        "sAjaxSource": "<?php echo site_url('admin/get_data_table_source'); ?>?table=k_jenis_barang&columns=,kode,nama,grup_id&jwhere=grup_id&fildjoins=,k_grup_barang.nama as Grup&joins=k_grup_barang&exports=k_grup_barang",
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
                "sTitle": "Jenis",
                "mData": "nama",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "nama-" + oData.id;
                    $(nTd).attr("id", id);
                    $(nTd).editable(
                        "<?php echo site_url('admin/update_grid/k_jenis_barang'); ?>", {
                            "callback": function(sValue, y) {
                                /* Redraw the table from the new data on the server */
                                $("#tblData").dataTable().fnDraw();
                            }
                        });
                }
            },
            {
                "sTitle": "Keterangan",
                "mData": "keterangan",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "keterangan-" + oData.id;
                    $(nTd).attr("id", id);
                    $(nTd).editable(
                        "<?php echo site_url('admin/update_grid/k_jenis_barang'); ?>", {
                            "callback": function(sValue, y) {
                                /* Redraw the table from the new data on the server */
                                $("#tblData").dataTable().fnDraw();
                            }
                        });
                }
            },
            {
                "sTitle": "Grup",
                "mData": "Grup",
                "sClass": "center",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "grup_id-" + oData.id;
                    $(nTd).attr("id", id);
                    $(nTd).editable(
                        "<?php echo site_url('admin/update_grid/k_jenis_barang'); ?>?table=k_grup_barang", {
                            loadurl: "<?php echo site_url('admin/get_editable_select'); ?>?table=k_grup_barang&filds=nama&select=" +
                                oData.unit_id,
                            type: "select",
                            submit: "OK",
                            "callback": function(sValue, y) {
                                /*Redraw the table from the new data on the server */
                                $("#tblData").dataTable().fnDraw();
                            }
                        });
                }
            },{
                "sTitle": "Foto",
                "mData": "foto",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "foto-" + oData.id;
                    $(nTd).attr("id", id);
                    if (oData.foto == null) {
                        htmlx =
                            "<div class='from-group'><img class='img-thumbnail' width='65' height='65' src='<?= base_url('asset/images/product/no-img.png'); ?>'></div>";
                        $(nTd).html(htmlx);
                    } else {
                        htmlx =
                            "<div class='from-group thumbnail'><img class='img-thumbnail'width='65' height='65' src='<?= base_url('asset/images/product/kuliner'); ?>/" +
                            oData.foto + "' alt='' ></div>";
                        $(nTd).html(htmlx);
                    }
                }
            },
            {
                "sTitle": "Edit",
                "mData": "id",
                "sClass": "center",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    $(nTd).html(
                        "<div class='btn-group'><button type='button' class='btn btn-xs bg-info'>Logo</button></div>"
                    );
                    $($(nTd).find('.btn-group').children()[0]).button().click(function() {
                        selectedId = oData.id;
                        $('#dlg-edit-foto').modal('show');
                    });
                }
            }
        ]
    });
    $("#btnAdd").button().click(function() {
        $('#add-data-ctgr')[0].reset();
        $.auto_number("k_jenis_barang", "2", "#txtKode");
        $("#cmbGrup").empty();
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "<?php echo site_url('admin/multi_select');?>?table=k_grup_barang",
            success: function(data) {
                if (data == '') {
                    $("#cmbGrup").append('<option value="">-- No Result --</option>');
                } else {
                    $("#cmbGrup").append(
                        '<option value=""> -- Silahkan Pilih -- </option>');
                    for (var i = 0; i < data.length; i++) {
                        $("#cmbGrup").append("<option value='" + data[i].id + "'>" + data[
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
                url: "<?php echo site_url('admin/create/k_jenis_barang'); ?>",
                data: {
                    kode: $('#txtKode').val(),
                    nama: $("#txtNama").val(),
                    keterangan: $("#txtKeterangan").val(),
                    grup_id: $("#cmbGrup option:selected").val()
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
    $('#edit-foto-prof').submit(function(e) {
        e.preventDefault();
        if ($('#edit-foto-prof').valid()) {
            $('.loading').append(
                '<div class="overlay text-center"><i class="fas fa-2x fa-sync-alt fa-spin"></i></div>'
            );
            try {
                if (selectedId) {
                    var confiq = {
                        id: $.base64.encode(selectedId),
                        sizeH: 100,
                        sizeW: 100,
                        tbL: "k_jenis_barang",
                        path: "asset-images-product-kuliner"
                    };
                    var fd = new FormData(document.getElementById("edit-foto-prof"));
                    var parsing = $.base64.encode(JSON.stringify(confiq));
                    parsing = parsing.replaceAll(".", "^");
                    parsing = parsing.replaceAll("+", "-");
                    parsing = parsing.replaceAll("/", "_");
                    $.ajax({
                        url: "<?php echo site_url('admin/edit_upload_foto');?>?data=" + parsing,
                        type: "post",
                        data: fd,
                        dataType: 'json',
                        processData: false,
                        contentType: false,
                        cache: false,
                        async: false,
                        success: function(msg) {
                            if (msg.error == false) {
                                $('.dropify-clear').click();
                                $("#edit-foto-prof")[0].reset();
                                $("#tblData").dataTable().fnDraw();
                                $('.loading').find('.overlay').remove();
                                $("#dlg-edit-foto").modal("hide");
                                $.alert_swal_info('Upload Images', msg.message, 'success');
                            } else {
                                $('.dropify-clear').click();
                                $("#edit-foto-prof")[0].reset();
                                $("#tblData").dataTable().fnDraw();
                                $('.loading').find('.overlay').remove();
                                $("#dlg-edit-foto").modal("hide");
                                $.alert_swal_info('Upload Images', msg.message, 'warning');
                            }
                        }
                    });
                }
            } catch (e) {

            }
        }
    });
});
</script>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-pencil-alt"></i>
            Jenis Item Barang
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
        <button type="button" id="btnAdd" class="btn btn-app bg-green btn-sm"><i class="fas fa-file-alt"></i>Tambah
            Data</button>
        <button type="button" id="btnReload" class="btn btn-app bg-info btn-sm"><i
                class="fas fa-sync-alt"></i>Refresh</button>
    </div>
</div>
<div id="frm-add-ctgr" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" class="modal fade">
    <div role="document" class="modal-dialog">
        <div class="modal-content modal-col-light-blue">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data</h4>
            </div>
            <div class="modal-body">
                <div class="card card-primary">
                    <div class="card-header">
                        <p>Jenis Barang</p>
                    </div>
                    <form id="add-data-ctgr">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="txtKode">Kode</label>
                                <input type="text" id="txtKode" class="form-control" disabled="disabled" required>
                            </div>
                            <div class="form-group">
                                <label for="txtNama">Jenis</label>
                                <input type="text" id="txtNama" placeholder="ex : ATK" maxlength="20"
                                    class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="txtKeterangan">Keterangan</label>
                                <textarea type="text" id="txtKeterangan" maxlength="255" col="4" row="2"
                                    class="form-control" required>
                                </textarea>
                            </div>
                            <div class="form-group">
                                <label for="cmbGrup">Grup Items</label>
                                <select id="cmbGrup" class="form-control" required></select>
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

<div id="dlg-edit-foto" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content modal-col-light-blue loading">
            <div class="modal-header">
                <h4 id="dlg-edit-foto-Label" class="modal-title">Form Edit</h4>
            </div>
            <div class="modal-body ">
                <div class="card card-primary">
                    <div class="card-header">
                        <p>Edit Gambar</p>
                    </div>
                    <form id="edit-foto-prof">
                        <div class="card-body">
                            <div class="form-group">
                                <input type="file" id="upl-upd-foto-prof" data-allowed-file-extensions="png jpg jpeg"
                                    name="file" class="dropify" data-max-file-size="2M" required>
                            </div>
                            <div class="input-group">
                                <div class="input-group-append ">
                                    <button type="submit" class="input-group-text bg-gradient btn-info">Upload</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-secondary ">Close</button>
            </div>
        </div>
    </div>
</div>