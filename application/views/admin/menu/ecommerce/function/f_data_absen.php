<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<script type="text/javascript">
String.prototype.replaceAll = function(str1, str2, ignore) {
    return this.replace(new RegExp(str1.replace(/([\/\,\!\\\^\$\{\}\[\]\(\)\.\*\+\?\|\<\>\-\&])/g, "\\$&"), (
        ignore ? "gi" : "g")), (typeof(str2) == "string") ? str2.replace(/\$/g, "$$$$") : str2);
};
var selectedId;
$(document).ready(function() {
    Globalize.culture("id-ID");
    $('.mn-3').addClass('bg-brown');
    $("#tblData").dataTable({
        "bJQueryUI": true,
        "bAutoWidth": false,
        // "bProcessing": true,
        "iDisplayLength": 10,
        "aLengthMenu": [10, 20, 50, 100],
        "bServerSide": true,
        "sPaginationType": "full_numbers",
        "sAjaxSource": "<?php echo site_url('admin/get_data_table_source'); ?>?table=m_absen&columns=,m_absen.id,nip,nama,jabatan,&jwhere=m_datapegawai.unit_id,employ_id&fildjoins=,m_unit.name,m_datapegawai.nama,m_datapegawai.nip,m_datapegawai.jabatan&joins=m_unit,m_datapegawai&exports=m_unit,m_datapegawai",
        "aoColumns": [{
                "sTitle": "#",
                "mData": "no",
                "bSortable": false,
                "sClass": "center"
            },
            {
                "sTitle": "NIP",
                "mData": "nip",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "nip-" + oData.id;
                    $(nTd).attr("id", id);
                    $(nTd).editable(
                        "<?php echo site_url('admin/update_grid/m_absen'); ?>", {
                            "callback": function(sValue, y) {
                                /* Redraw the table from the new data on the server */
                                $("#tblData").dataTable().fnDraw();
                            }
                        });
                }
            },
            {
                "sTitle": "NAMA",
                "mData": "nama",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "nama-" + oData.id;
                    $(nTd).attr("id", id);
                    $(nTd).editable(
                        "<?php echo site_url('admin/update_grid/m_absen'); ?>", {
                            "callback": function(sValue, y) {
                                /* Redraw the table from the new data on the server */
                                $("#tblData").dataTable().fnDraw();
                            }
                        });
                }
            },
            {
                "sTitle": "JABATAN",
                "mData": "jabatan",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "jabatan-" + oData.id;
                    $(nTd).attr("id", id);
                    $(nTd).editable(
                        "<?php echo site_url('admin/update_grid/m_absen'); ?>", {
                            "callback": function(sValue, y) {
                                /* Redraw the table from the new data on the server */
                                $("#tblData").dataTable().fnDraw();
                            }
                        });
                }
            },
            {
                "sTitle": "PENEMPATAN",
                "mData": "name",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "unit_id-" + oData.id;
                    $(nTd).attr("id", id);
                    $(nTd).editable(
                        "<?php echo site_url('admin/update_grid/m_datapegawai'); ?>?table=m_unit", {
                            loadurl: "<?php echo site_url('admin/get_editable_select'); ?>?table=m_unit&filds=name&select=" +
                                oData.unit_id,
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
                "sTitle": "SIFT KERJA",
                "mData": "sift",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "sift-" + oData.id;
                    $(nTd).attr("id", id);
                    $(nTd).editable(
                        "<?php echo site_url('admin/update_grid/m_absen'); ?>", {
                            type: "select",
                            data: "{'P':'PAGI','S':'SIANG','M':'MALAM','C':'CUTI'}",
                            submit: "OK",
                            "callback": function(sValue, y) {
                                /* Redraw the table from the new data on the server*/
                                $("#tblData").dataTable().fnDraw();
                            }
                        });
                }
            },
            {
                "sTitle": "JAM KERJA",
                "mData": null,
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "jam_masuk-" + oData.id;
                    $(nTd).attr("id", id);
                    $(nTd).html("<label>" + oData.jam_masuk + " - " + oData.jam_pulang +
                        " </label>");
                }
            },
            {
                "sTitle": "Edit",
                "mData": null,
                "sClass": "center",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    $(nTd).html(
                        "<div class='btn-group'><button type='button' class='btn btn-xs bg-yellow'>Edit</button></div>"
                    );
                    $($(nTd).children()[0]).button().click(function() {
                        selectedId = oData.id;
                        $("#txtNama_E").val(oData.nama);
                        $("#txtNip_E").val(oData.nip);
                        $("#txtJabatan_E").val(oData.jabatan);
                        $("#txtPenempatan_E").val(oData.name);
                        $("#cmbSift_E").val(oData.sift);
                        $("#txtMulai_E").val(oData.jam_masuk);
                        $("#txtSelesai_E").val(oData.jam_pulang);
                        $("#txtKoordinat_E").val(oData.lokasi);
                        $("#frm-edit-data").modal("show");
                    });
                }
            }
        ]
    });
    $("#btnAdd").button().click(function() {
        $_search_pegawai();
    });
    $("#btnReload").button().click(function() {
        $("#tblData").dataTable().fnDraw();
    });
    $("#txttgl_lahir,#txtTglMasuk").datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        yearRange: '1920:2050'
    });
    $('.clockpicker').clockpicker({
        placement: 'bottom',
        align: 'right',
        autoclose: true,
        'default': 'now'
    });

    /* Fungsi Pilih Data Pegawai */
    function $_search_pegawai() {
        $("#frm-add").modal('show');
        $("#add-data")[0].reset();
        $("#cmbSearch").empty();
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "<?php echo site_url('admin/multi_select');?>?table=m_datapegawai",
            success: function(data) {
                if (data == '') {
                    $("#cmbSearch").append("<option value=''> -- No Result -- </option>");
                } else {
                    for (var i = 0; i < data.length; i++) {
                        $("#cmbSearch").append("<option value='" + data[i].id + "' name='" +
                            data[i].nip + "'>" + data[i].nama + "</option>");
                    }
                }
            }
        });
    }
    $('#cmbSearch').select2();
    $('.select2').css({
        'width': '100%',
    });
    $('.select2-container--default .select2-selection--single').css({
        'height': '65px'
    });
    $("#cmbSearch").change(function() {
        $("#add-data")[0].reset();
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "<?php echo site_url('admin/multi_select');?>?table=m_datapegawai&select=id&id=" +
                $("#cmbSearch option:selected").val(),
            success: function(data) {
                if (data) {
                    selectedId = data[0].id;
                    $("#txtNip").val(data[0].nip);
                    $("#txtNama").val(data[0].nama);
                    $("#txtJabatan").val(data[0].jabatan);
                    $("#txtPenempatan").val(data[0].unit_id);
                }
            }
        });
    });
    $("#btn-Gps").button().click(function() {
        $("#frm-find-gps").modal('show');
        initMap();
    });
    // Initialize and add the map
    function initMap() {
        var map = new google.maps.Map(document.getElementById('googleMap'), {
            center: {
                lat: 34.397,
                lng: 150.644
            },
            scrollwheel: false,
            zoom: 2
        });
    }
    // fungsi menyimpan data master absensi
    $("#add-data").submit(function(e) {
        e.preventDefault();
        if ($('#add-data').valid()) {
            $.ajax({
                type: "POST",
                dataType: 'json',
                url: "<?php echo site_url('admin/add_master_absen/m_absen'); ?>?id=" +
                    selectedId,
                data: {
                    sift: $("#cmbSift option:selected").val(),
                    jam_masuk: $("#txtMulai").val(),
                    jam_pulang: $("#txtSelesai").val(),
                    lokasi: $("#txtKoordinat").val(),
                    date: $date,
                    employ_id: selectedId
                },
                success: function(msg) {
                    if (msg.error == false) {
                        $("#tblData").dataTable().fnDraw();
                        var title = "Add Form";
                        var label = "Tambah Data Absen";
                        var message = msg.message;
                        alert(title, label, message);
                        $("#add-data")[0].reset();
                        $("#frm-add").modal("hide");
                    } else {
                        $("#frm-add").modal("hide");
                        $("#tblData").dataTable().fnDraw();
                        var title = "Add Form";
                        var label = "Tambah Data Absen";
                        var message = msg.message;
                        alert(title, label, message);
                        $("#add-data")[0].reset();
                    }
                }
            });
        }
    });
    $("#upd-data").submit(function(e) {
        e.preventDefault();
        if ($('#upd-data').valid()) {
            $.ajax({
                type: "POST",
                dataType: 'json',
                url: "<?php echo site_url('admin/update/m_absen'); ?>",
                data: {
                    id: selectedId,
                    sift: $("#cmbSift_E option:selected").val(),
                    jam_masuk: $("#txtMulai_E").val(),
                    jam_pulang: $("#txtSelesai_E").val(),
                    lokasi: $("#txtKoordinat_E").val(),
                    date: $date,
                    employ_id: selectedId
                },
                success: function(msg) {
                    if (msg.error == false) {
                        $("#tblData").dataTable().fnDraw();
                        var title = "Add Form";
                        var label = "Tambah Data Absen";
                        var message = msg.message;
                        alert(title, label, message);
                        $("#upd-data")[0].reset();
                        $("#frm-edit-data").modal("hide");
                    } else {
                        $("#frm-edit-data").modal("hide");
                        $("#tblData").dataTable().fnDraw();
                        var title = "Add Form";
                        var label = "Tambah Data Absen";
                        var message = msg.message;
                        alert(title, label, message);
                        $("#upd-data")[0].reset();
                    }
                }
            });
        }
    });


});
</script>