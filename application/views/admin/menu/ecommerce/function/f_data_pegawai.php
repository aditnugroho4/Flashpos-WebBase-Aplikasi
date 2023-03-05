<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<script type="text/javascript">
var idSelected;
var sosialId = false;
$(document).ready(function() {
    var idSelected = false;
    var idUnit = false;
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
        // "bProcessing": true,
        "iDisplayLength": 10,
        "aLengthMenu": [10, 20, 50, 100],
        "bServerSide": true,
        "sPaginationType": "full_numbers",
        "sAjaxSource": "<?php echo site_url('admin/get_data_table_source'); ?>?table=m_datapegawai&columns=,nip,nama,pendidikan,jabatan,profesi,unit_id,divisi_id&jwhere=divisi_id,unit_id,sosial_id&fildjoins=,m_struktur.name as Divisi,m_unit.name as Unit,m_datasosial.nik&joins=m_struktur,m_unit,m_datasosial&exports=m_struktur,m_unit,m_datasosial",
        "aoColumns": [{
                "sTitle": "#",
                "mData": "no",
                "bSortable": false,
                "sClass": "center"
            },
            {
                "sTitle": "Foto",
                "mData": "foto",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "foto-" + oData.id;
                    $(nTd).attr("id", id);
                    if (oData.foto == null) {
                        htmlx =
                            "<div class='from-group'><img class='img-thumbnail' width='45' height='45' src='<?= base_url('asset/images/product/no-img.png'); ?>'></div>";
                        $(nTd).html(htmlx);
                    } else {
                        htmlx =
                            "<div class='from-group thumbnail'><img class='img-thumbnail'width='45' height='45' src='<?= base_url('asset/images/user'); ?>/" +
                            oData.foto + "' alt='' ></div>";
                        $(nTd).html(htmlx);
                    }
                }
            },
            {
                "sTitle": "Nip",
                "mData": "nip",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "nip-" + oData.id;
                    $(nTd).attr("id", id);
                    $(nTd).editable(
                        "<?php echo site_url('admin/update_grid/m_datapegawai'); ?>", {
                            "callback": function(sValue, y) {
                                /* Redraw the table from the new data on the server */
                                $("#tblData").dataTable().fnDraw();
                            }
                        });
                }
            },
            {
                "sTitle": "Nama",
                "mData": "nama",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "nama-" + oData.id;
                    $(nTd).attr("id", id);
                    $(nTd).editable(
                        "<?php echo site_url('admin/update_grid/m_datapegawai'); ?>", {
                            "callback": function(sValue, y) {
                                /* Redraw the table from the new data on the server */
                                $("#tblData").dataTable().fnDraw();
                            }
                        });
                }
            },
            {
                "sTitle": "Divisi",
                "mData": "Divisi",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "divisi_id-" + oData.id;
                    $(nTd).attr("id", id);
                }
            },
            {
                "sTitle": "Unit / Bagian",
                "mData": "Unit",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "unit_id-" + oData.id;
                    $(nTd).attr("id", id);
                }
            },
            {
                "sTitle": "Status Kerja",
                "mData": "status",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "status-" + oData.id;
                    $(nTd).attr("id", id);
                    $(nTd).editable(
                        "<?php echo site_url('admin/update_grid/m_datapegawai'); ?>", {
                            type: "select",
                            data: "{'Karyawan':'Karyawan','Kontrak':'Kontrak','Harian Lepas':'Harian Lepas','Magang':'Magang','Part Time':'Part Time'}",
                            submit: "OK",
                            "callback": function(sValue, y) {
                                /* Redraw the table from the new data on the server */
                                $("#tblData").dataTable().fnDraw();
                            }
                        });
                }
            },
            {
                "sTitle": "Edit",
                "mData": "id",
                "sClass": "center",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    $(nTd).html(
                        "<div class='btn-group'><button type='button' class='btn btn-xs bg-blue mr-1'>Foto</button><button type='button' class='btn btn-xs bg-yellow'>Edit</button></div>"
                    );
                    $($(nTd).find('.btn-group').children()[0]).button().click(function() {
                        selectedId = oData.id;
                        $('#dlg-edit-foto').modal('show');
                    });
                    $($(nTd).find('.btn-group').children()[1]).button().click(function() {
                        selectedId = oData.id;
                        $.get_data_divisi("#cmbDivisiE");
                        $('#tab-data a[href="#Edit-Data"]').trigger('click');
                        $("#txtNikE").val(oData.nik);
                        $("#txtNipE").val(oData.nip);
                        $("#txtNamaE").val(oData.nama);

                        $("#txtTglLulusE").val(oData.tgllulus);

                        $("#cmbUnitE").val(oData.unit_id);
                        $
                        $("#txtTglMasukE").val(oData.tmtdinas);
                        $("#cmbStatusE").val(oData.status);
                        $("#cmbPosisiE").val(oData.jabatan);

                        idSelected = oData.divisi_id;
                        idUnit = oData.unit_id;

                        if (oData.pendidikan != false) {
                            $("#cmbPendidikanE").val(oData.pendidikan);
                        }
                        if (oData.profesi != false) {
                            $("#cmbProfesiE").val(oData.profesi);
                        }
                        if (oData.status != false) {
                            $("#cmbStatusE").val(oData.status);
                        }
                        if (oData.jabatan != false) {
                            $("#cmbPosisiE").val(oData.jabatan);
                        }
                    });
                }
            }

        ]
    });
    $('#AddData').click(function() {
        $('#add_data_pegawai')[0].reset();
        $("#txtNama").focus();
        selectedId = false;
        $("#txtNama").removeAttr('disabled');
        $("#txtNip").removeAttr('disabled');
        $("#txtTglLulus,#txtTglMasuk").removeAttr('disabled');
        $("#txtNip").removeAttr('disabled');

        $.auto_number('m_datapegawai', 4, '#txtNip');
        $.get_data_divisi("#cmbDivisi");
    });
    $("#txtSearch").autocomplete({
        source: function(query, response) {
            $.ajax({
                type: "POST",
                dataType: 'json',
                url: "<?= site_url('admin/json_search_data');?>?table=m_datasosial&columns=,nama,nik,npwp,alamat&aSearch=" +
                    query.term,
                success: function(data) {
                    response($.map(data, function(value, key) {
                        console.log(value);
                        return {
                            label: value.nama + " (" + value.nik + " )",
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
            sosialId = ui.item.value.id;
            $("#txtNik").val(ui.item.value.nik);
            $("#txtNama").val(ui.item.value.nama);
            $("#txtNama").attr('disabled', 'disabled');
            return false;
        }
    });
    $("#txtTglLulusE,#txtTglMasukE").datepicker({
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        yearRange: '1990:2030',
        dateFormat: "yy-mm-dd",
    });
    $("#txtTglLulus").datepicker({
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        yearRange: '1990:2030',
        dateFormat: "yy-mm-dd",
        onSelect: function(date) {
            $(this).attr('disabled', 'disabled');
        }
    });
    $("#txtTglMasuk").datepicker({
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        yearRange: '2005:2030',
        maxDate: '2005',
        dateFormat: "yy-mm-dd",
        onSelect: function(date) {
            let Nik = $(this).val().substr(2, 10);
            $("#txtNip").val(Nik.replaceAll("-", "") + $("#txtNip").val());
            $(this).attr('disabled', 'disabled');
            $("#txtNip").attr('disabled', 'disabled');
        }
    });
    $("#cmbDivisi").change(function() {
        $.get_data_mix("#cmbUnit", "m_unit", "struktur_id", $(this).val());
        $("#cmbUnit").focus();
    });
    $("#cmbUnit").change(function() {
        $("#cmbProfesi").focus();
    });
    $("#add_data_pegawai").submit(function(e) {
        e.preventDefault();
        if (sosialId != false) {
            if ($('#add_data_pegawai').valid()) {
                $('.loadding').append(
                    '<div class="overlay"><i class="fas fa-2x fa-sync-alt fa-spin"></i></div>');
                $.ajax({
                    type: "POST",
                    dataType: 'json',
                    url: "<?php echo site_url('admin/create_data_pegawai/m_datapegawai'); ?>",
                    data: {
                        nip: $("#txtNik").val(),
                        nama: $("#txtNama").val(),
                        pendidikan: $("#cmbPendidikan").val(),
                        tgllulus: $("#txtTglLulus").val(),
                        profesi: $("#cmbProfesi option:selected").val(),
                        divisi_id: $("#cmbDivisi option:selected").val(),
                        unit_id: $("#cmbUnit option:selected").val(),
                        tmtdinas: $("#txtTglMasuk").val(),
                        status: $("#cmbStatus option:selected").val(),
                        jabatan: $("#cmbPosisi option:selected").val(),
                        keterangan: $("#txtKeterangan").val(),
                        sosial_id: sosialId
                    },
                    success: function(msg) {
                        if (msg.error == false) {
                            $('.loadding').find('.overlay').remove();
                            $('#add_data_pegawai')[0].reset();
                            $.alert_swal('Data Pegawai', msg
                                .message, 'success');
                        } else {
                            $('.loadding').find('.overlay').remove();
                            $.alert_swal_info('Data Pegawai', msg
                                .message, 'warning');
                        }
                    }
                });
            }
        } else {
            $('#txtSearch').focus();
            $.alert_swal('Data Pegawi', 'Import Dulu Data Calon Pegawai', 'success');

        }
    });
    $('#EditData').click(function() {
        if (!selectedId) {
            $.alert_swal('Edit Data Pegawai', 'Pilih Data Yang Akan di Edit', 'warning');
        } else {
            $("#submit_edit").show();
        }
    });
    $("#cmbDivisiE").change(function() {
        $.get_data_mix("#cmbUnitE", "m_unit", "struktur_id", $(this).val());
        idSelected = idUnit;
    });
    $("#edit-data-pegawai").submit(function(e) {
        e.preventDefault();
        if (selectedId) {
            if ($('#edit-data-pegawai').valid()) {
                $('.loadding').append(
                    '<div class="overlay"><i class="fas fa-2x fa-sync-alt fa-spin"></i></div>');
                $.ajax({
                    type: "POST",
                    dataType: 'json',
                    url: "<?php echo site_url('admin/update/m_datapegawai'); ?>",
                    data: {
                        id: selectedId,
                        nama: $("#txtNamaE").val(),
                        pendidikan: $("#cmbPendidikanE option:selected").val(),
                        tgllulus: $("#txtTglLulusE").val(),
                        profesi: $("#cmbProfesiE option:selected").val(),
                        divisi_id: $("#cmbDivisiE option:selected").val(),
                        unit_id: $("#cmbUnitE option:selected").val(),
                        tmtdinas: $("#txtTglMasukE").val(),
                        status: $("#cmbStatusE option:selected").val(),
                        jabatan: $("#cmbPosisiE option:selected").val(),
                        keterangan: $("#txtKeteranganE").val()
                    },
                    success: function(msg) {
                        if (msg.error == false) {
                            $('.loadding').find('.overlay').remove();
                            $('#edit-data-pegawai')[0].reset();
                            $.alert_swal('Data Pegawai', msg
                                .message, 'success');
                        } else {
                            $('.loadding').find('.overlay').remove();
                            $.alert_swal_info('Data Pegawai', msg
                                .message, 'warning');
                        }
                    }
                });
            }
        } else {
            $.alert_swal('Data Pegawi', 'Import Dulu Data Calon Pegawai', 'danger');

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
                    if (idSelected != false) {
                        $(tag).val(idSelected);
                        $(tag).change();
                    }
                }
            }
        });
    }
    $.get_data_mix = function(tag, table, selectd, id) {
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "<?php echo site_url('admin/multi_select');?>?table=" + table + "&select=" +
                selectd + "&id=" + id,
            success: function(data) {
                $(tag).empty();
                if (data == '') {
                    $(tag).append("<option value=''> -- No Result -- </option>");
                } else {
                    $(tag).append(
                        "<option value=''> -- Silahkan Pilih -- </option>");
                    for (var i = 0; i < data.length; i++) {
                        $(tag).append("<option value='" + data[i].id + "'>" +
                            data[i].name + "</option>");
                    }
                    if (idSelected != false) {
                        $(tag).val(idSelected);
                        $(tag).change();
                    }
                }
            }
        });
        return id;
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
                $('#tab-data a[href="#Data-List"]').trigger('click');
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
                        tbL: "m_datapegawai",
                        path: "asset-images-user"
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
                                $('.loading').find('.overlay').remove();
                                $("#dlg-edit-foto").modal("hide");
                                $.alert_swal('Data Pegawai', msg
                                    .message, 'success');
                            } else {
                                $('.dropify-clear').click();
                                $("#edit-foto-prof")[0].reset();
                                $('.loading').find('.overlay').remove();
                                $("#dlg-edit-foto").modal("hide");
                                $.alert_swal('Data Pegawai', msg
                                    .message, 'warning');
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