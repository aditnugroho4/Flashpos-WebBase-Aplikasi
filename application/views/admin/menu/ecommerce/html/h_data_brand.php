<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<script type="text/javascript">
var fildeselect;
var active;
var eleFocus = '';
var divisiID;
$(document).ready(function() {
    $('.mn-1').addClass('bg-yellow');
    $('.sidebar-mini').addClass('sidebar-collapse');
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
        // "bProcessing": true,
        "iDisplayLength": 15,
        "aLengthMenu": [15, 30, 50, 100],
        "bServerSide": true,
        "sPaginationType": "full_numbers",
        "sAjaxSource": "<?php echo site_url('admin/get_data_table_source'); ?>?table=m_brand&columns=,kode,nama,alamat,name,struktur_id&jwhere=struktur_id&fildjoins=,m_struktur.name&joins=m_struktur&exports=m_struktur",
        "aoColumns": [{
                "sTitle": "#",
                "mData": "no",
                "bSortable": false,
                "sClass": "center"
            },
            {
                "sTitle": "Kode Brand",
                "mData": "kode",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "kode-" + oData.id;
                    $(nTd).attr("id", id);
                    $(nTd).editable("<?php echo site_url('admin/update_grid/m_brand'); ?>", {
                        "callback": function(sValue, y) {
                            /* Redraw the table from the new data on the server */
                            $("#tblData").dataTable().fnDraw();
                        }
                    });
                }
            },
            {
                "sTitle": "Nama Brand",
                "mData": "nama",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "nama-" + oData.id;
                    $(nTd).attr("id", id);
                    $(nTd).editable("<?php echo site_url('admin/update_grid/m_brand'); ?>", {
                        "callback": function(sValue, y) {
                            /* Redraw the table from the new data on the server */
                            $("#tblData").dataTable().fnDraw();
                        }
                    });
                }
            },
            {
                "sTitle": "Alamat",
                "mData": "alamat",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "alamat-" + oData.id;
                    $(nTd).attr("id", id);
                    $(nTd).editable("<?php echo site_url('admin/update_grid/m_brand'); ?>", {
                        "callback": function(sValue, y) {
                            /* Redraw the table from the new data on the server */
                            $("#tblData").dataTable().fnDraw();
                        }
                    });
                }
            },
            {
                "sTitle": "No Kontak",
                "mData": "phone",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "phone-" + oData.id;
                    $(nTd).attr("id", id);
                    $(nTd).editable("<?php echo site_url('admin/update_grid/m_brand'); ?>", {
                        "callback": function(sValue, y) {
                            /* Redraw the table from the new data on the server */
                            $("#tblData").dataTable().fnDraw();
                        }
                    });
                }
            },
            {
                "sTitle": "Divisi",
                "mData": "name",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "struktur_id-" + oData.id;
                    $(nTd).attr("id", id);
                    $(nTd).editable(
                        "<?php echo site_url('admin/update_grid/m_brand'); ?>?table=m_struktur", {
                            loadurl: "<?php echo site_url('admin/get_editable_select'); ?>?table=m_struktur&filds=name&select=" +
                                oData.struktur_id,
                            type: "select",
                            submit: "OK",
                            "callback": function(sValue, y) {
                                /* Redraw the table from the new data on the server */
                                $("#tblData").dataTable().fnDraw();
                            }
                        });
                }
            },
            {
                "sTitle": "Logo",
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
                            "<div class='from-group thumbnail'><img class='img-thumbnail'width='65' height='65' src='<?= base_url('asset/admin/images/ico'); ?>/" +
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
                        "<div class='btn-group'><button type='button' class='btn btn-xs bg-yellow mr-1'>Edit</button><button type='button' class='btn btn-xs bg-info'>Logo</button></div>"
                    );
                    $($(nTd).find('.btn-group').children()[0]).button().click(function() {
                        selectedId = oData.id;
                        $('#txtKdBrandE').val(oData.kode);
                        $('#txtPemilikBrandE').val(oData.owner);
                        $('#txtNpwpBrandE').val(oData.npwp);
                        $('#txtNamaBrandE').val(oData.nama);
                        $('#txtAlamatBrandE').val(oData.alamat);
                        $('#txtPhoneBrandE').val(oData.phone);
                        $('#txtEmailBrandE').val(oData.email);
                        $('#txtInstagramBrandE').val(oData.instagram);
                        $('#txtFacebookBrandE').val(oData.facebook);
                        $('#txtYoutubeBrandE').val(oData.youtube);
                        $('#txtTwitterBrandE').val(oData.twitter);
                        $('#tab-brand a[href="#EditBrand"]').trigger('click');
                        divisiID = oData.struktur_id;
                        $.get_data_divisi("#cmbDivisiE");

                    });
                    $($(nTd).find('.btn-group').children()[1]).button().click(function() {
                        selectedId = oData.id;
                        $('#dlg-edit-foto').modal('show');
                    });
                }
            }
        ]
    });
    $('#Add-Brand').click(function() {
        let kode = '<?= $query=R::count("m_brand")+1;?>';
        $("#txtKdBrand").val(kode.padStart(2, '0'));
        $.get_data_divisi("#cmbDivisi");
    });
    $("#add_data_brand").submit(function(e) {
        e.preventDefault();
        if ($('#add_data_brand').valid()) {
            $('.load-brand').append(
                '<div class="overlay"><i class="fas fa-2x fa-sync-alt fa-spin"></i></div>');
            $.ajax({
                type: "POST",
                dataType: 'json',
                url: "<?php echo site_url('admin/create/m_brand'); ?>",
                data: {
                    kode: $("#txtKdBrand").val(),
                    nama: $("#txtNamaBrand").val(),
                    alamat: $("#txtAlamatBrand").val(),
                    phone: $("#txtPhoneBrand").val(),
                    email: $("#txtEmailBrand").val(),
                    instagram: $("#txtInstagramBrand").val(),
                    youtube: $("#txtYoutubeBrand").val(),
                    facebook: $("#txtFacebookBrand").val(),
                    twitter: $("#txtTwitterBrand").val(),
                    npwp: $("#txtNpwpBrand").val(),
                    owner: $("#txtPemilikBrand").val(),
                    struktur_id: $("#cmbDivisi option:selected").val(),
                },
                success: function(msg) {
                    if (msg.error == false) {
                        $.alert_swal('Data Brand', msg
                            .message, 'info');
                        $('.load-brand').find('.overlay').remove();
                        $('#add_data_brand')[0].reset();
                        $("#tblData").dataTable().fnDraw();
                        $('#Data-Brand').trigger('click');
                    } else {
                        $.alert_swal('Data Brand', msg
                            .message, 'warning');
                        $('.load-brand').find('.overlay').remove();
                        $("#tblData").dataTable().fnDraw();
                    }
                }
            });
        }
    });
    $('#Edit-Brand').click(function() {
        if (!selectedId) {
            $.alert_swal('Edit Data Brand', 'Pilih Data Yang Akan di Edit', 'info');
        } else {
            $("#submit_edit").show();
        }
    });
    $.get_data_divisi = function(tag) {
        $(tag).empty();
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "<?php echo site_url('admin/multi_select');?>?table=m_struktur",
            success: function(data) {
                if (data == '') {
                    $(tag).append("<option value=''> -- No Result -- </option>");
                } else {
                    $(tag).append(
                        "<option value=''> -- Silahkan Pilih -- </option>");
                    for (var i = 0; i < data.length; i++) {
                        $(tag).append("<option value='" + data[i].id + "'>" +
                            data[i].name + "</option>");
                    }
                    if (divisiID != false) {
                        $(tag).val(divisiID);
                    }
                }
            }
        });
    }
    $("#submit_edit").hide();
    $('#edit_data_brand').submit(function(e) {
        e.preventDefault();
        if ($('#edit_data_brand').valid()) {
            $('.load-brand').append(
                '<div class="overlay"><i class="fas fa-2x fa-sync-alt fa-spin"></i></div>');
            $.ajax({
                url: "<?php echo site_url('admin/update/m_brand');?>",
                type: "post",
                dataType: "JSON",
                data: {
                    id: selectedId,
                    nama: $("#txtNamaBrandE").val(),
                    alamat: $("#txtAlamatBrandE").val(),
                    phone: $("#txtPhoneBrandE").val(),
                    email: $("#txtEmailBrandE").val(),
                    instagram: $("#txtInstagramBrandE").val(),
                    youtube: $("#txtYoutubeBrandE").val(),
                    facebook: $("#txtFacebookBrandE").val(),
                    twitter: $("#txtTwitterBrandE").val(),
                    npwp: $("#txtNpwpBrandE").val(),
                    owner: $("#txtPemilikBrandE").val(),
                    struktur_id: $("#cmbDivisiE option:selected").val(),
                },
                success: function(msg) {
                    if (msg.error == false) {
                        $.alert_swal('Upload Images', msg
                            .message, 'warning');
                        $('.load-brand').find('.overlay').remove();
                        $('#edit_data_brand')[0].reset();
                    } else {
                        $('#edit_data_brand')[0].reset();
                        $('.load-brand').find('.overlay').remove();
                    }
                }
            });
        }
    });
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
                        tbL: "m_brand",
                        path: "asset-admin-images-ico"
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
                        success: function(data) {
                            if (data.error == false) {
                                $('.dropify-clear').click();
                                $("#edit-foto-prof")[0].reset();
                                $("#tblData").dataTable().fnDraw();
                                $('.loading').find('.overlay').remove();
                                $("#dlg-edit-foto").modal("hide");
                            } else {
                                $('.dropify-clear').click();
                                $("#edit-foto-prof")[0].reset();
                                $("#tblData").dataTable().fnDraw();
                                $('.loading').find('.overlay').remove();
                                $("#dlg-edit-foto").modal("hide");
                            }
                        }
                    });
                }
            } catch (e) {

            }
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
                $('#tab-brand a[href="#DataBrand"]').trigger('click');
                $("#tblData").dataTable().fnDraw();
            }
        })
    }
});
</script>
<div class="col-md-12">
    <div class="card card-outline card-yellow  load-brand">
        <div class="card-header">
            <h3 class="card-title col-lg-4 col-sm-12 mb-2">Data Brand</h3>
        </div>
        <div class="card-body">
            <ul class="nav nav-pills" id="tab-brand">
                <li class="nav-item" id="Data-Brand"><a class="nav-link active border-left" href="#DataBrand"
                        data-toggle="tab">Data
                        Brand</a>
                </li>
                <li class="nav-item" id="Add-Brand"><a class="nav-link border-left" href="#AddBrand"
                        data-toggle="tab">Tambah Brand</a>
                </li>
                <li class="nav-item" id="Edit-Brand"><a class="nav-link border-left" href="#EditBrand"
                        data-toggle="tab">Edit Brand</a>
                </li>
            </ul>
            <hr>
            <div class="tab-content">
                <div class="active tab-pane" id="DataBrand">
                    <div class="callout callout-info">
                        <div class="table-responsive">
                            <table table id="tblData" class="table table-bordered table-striped"></table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="AddBrand">
                    <!-- Tambah Brand -->
                    <div class="callout callout-info">
                        <div class="row">
                            <div class="col-lg-12">
                                <form id="add_data_brand">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Kode Brand</label>
                                                <input type="text" id="txtKdBrand" disabled="disabled" maxlength="3"
                                                    class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Nama Pemilik</label>
                                                <input type="text" id="txtPemilikBrand" maxlength="45"
                                                    class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label>NPWP</label>
                                                <input type="text" id="txtNpwpBrand" maxlength="20" class="form-control"
                                                    required>
                                            </div>
                                            <div class="form-group">
                                                <label>Nama Brand</label>
                                                <input type="text" id="txtNamaBrand" maxlength="100"
                                                    class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Divisi</label>
                                                <select id="cmbDivisi" class="form-control" required></select>
                                            </div>
                                            <div class="form-group">
                                                <label>Alamat</label>
                                                <textarea type="text" id="txtAlamatBrand" class="form-control" required>
                                            </textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>No Telpon</label>
                                                <input type="text" id="txtPhoneBrand"
                                                    Placeholder="contoh : 085685550001" maxlength="16"
                                                    class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="txtEmailBrand">Email</label>
                                                <input type="email" class="form-control" id="txtEmailBrand"
                                                    placeholder="toko@flashpos" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="txtInstagramBrand" class="col-form-label">Instagram</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" maxlength="100"
                                                        id="txtInstagramBrand" placeholder="intagram@flashpos" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="txtFacebookBrand" class="col-form-label">Facebook</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" maxlength="100"
                                                        id="txtFacebookBrand" placeholder="facebook@flashpos" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="txtYoutubeBrand" class="col-form-label">Youtube</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" maxlength="35"
                                                        id="txtYoutubeBrand" placeholder="toko@flashpos" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="txtTwitterBrand" class="col-form-label">Twitter</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" maxlength="55"
                                                        id="txtTwitterBrand" placeholder="@flashpos" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <hr>
                                                <button type="submit"
                                                    class="btn btn-primary float-right">Simpan</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="EditBrand">
                    <!-- Edit Brand -->
                    <div class="callout callout-info">
                        <form class="form-horizontal" id="edit_data_brand">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Kode Brand</label>
                                        <input type="text" id="txtKdBrandE" disabled="disabled" maxlength="3"
                                            class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Pemilik</label>
                                        <input type="text" id="txtPemilikBrandE" maxlength="45" class="form-control"
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <label>NPWP</label>
                                        <input type="text" id="txtNpwpBrandE" maxlength="20" class="form-control"
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Brand</label>
                                        <input type="text" id="txtNamaBrandE" maxlength="100" class="form-control"
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <label>Divisi</label>
                                        <select id="cmbDivisiE" class="form-control" required></select>
                                    </div>
                                    <div class="form-group">
                                        <label>Alamat</label>
                                        <textarea type="text" id="txtAlamatBrandE" class="form-control" required>
                                            </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>No Telpon</label>
                                        <input type="text" id="txtPhoneBrandE" Placeholder="contoh : 085685550001"
                                            maxlength="16" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="txtEmailBrandE" class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-12">
                                            <input type="email" class="form-control" id="txtEmailBrandE"
                                                placeholder="toko@flashpos" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="txtInstagramBrandE"
                                            class="col-sm-2 col-form-label">Instagram</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" maxlength="100"
                                                id="txtInstagramBrandE" placeholder="intagram@flashpos" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="txtFacebookBrandE" class="col-sm-2 col-form-label">Facebook</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" maxlength="100"
                                                id="txtFacebookBrandE" placeholder="facebook@flashpos" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="txtYoutubeBrandE" class="col-sm-2 col-form-label">Youtube</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" maxlength="35" id="txtYoutubeBrandE"
                                                placeholder="toko@flashpos" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="txtTwitterBrandE" class="col-sm-2 col-form-label">Twitter</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" maxlength="55" id="txtTwitterBrandE"
                                                placeholder="@flashpos" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <hr>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" required> I agree to the <a href="#">terms
                                                        and
                                                        conditions</a>
                                                </label>
                                                <button type="submit" id="submit_edit"
                                                    class="btn btn-danger float-right">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="dlg-edit-foto" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog loading">
        <div class="modal-content modal-col-light-blue ">
            <div class="modal-header">
                <h4 id="dlg-edit-foto-Label" class="modal-title">Form Edit</h4>
            </div>
            <div class="modal-body ">
                <div class="card card-primary">
                    <div class="card-header">
                        <p>Edit Foto Profile</p>
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