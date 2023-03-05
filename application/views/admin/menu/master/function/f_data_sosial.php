<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<script type="text/javascript">
String.prototype.replaceAll = function(str1, str2, ignore) {
    return this.replace(new RegExp(str1.replace(/([\/\,\!\\\^\$\{\}\[\]\(\)\.\*\+\?\|\<\>\-\&])/g, "\\$&"), (
        ignore ? "gi" : "g")), (typeof(str2) == "string") ? str2.replace(/\$/g, "$$$$") : str2);
};
var selectedId;
var eleFocus;
$(document).ready(function() {
    $('.flex-column').find('.bg-brown').removeClass('bg-brown');
    $('.mn-1').addClass('bg-brown');
    $('.sidebar-mini').addClass('sidebar-collapse');

    $("#tblData").dataTable({
        "bJQueryUI": true,
        "bAutoWidth": false,
        // "bProcessing": true,
        "iDisplayLength": 10,
        "aLengthMenu": [10, 20, 50, 100],
        "bServerSide": true,
        "sPaginationType": "full_numbers",
        "sAjaxSource": "<?php echo site_url('admin/get_data_table_source'); ?>?table=m_datasosial&columns=,nik,nama&jwhere=unit_id&fildjoins=,m_unit.name&joins=m_unit&exports=m_unit",
        "aoColumns": [{
                "sTitle": "#",
                "mData": "no",
                "bSortable": false,
                "sClass": "center"
            },
            {
                "sTitle": "NIK",
                "mData": "nip",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "nip-" + oData.id;
                    $(nTd).attr("id", id);
                    $(nTd).editable(
                        "<?php echo site_url('admin/update_grid/m_datasosial'); ?>", {
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
                        "<?php echo site_url('admin/update_grid/m_datasosial'); ?>", {
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
                        "<?php echo site_url('admin/update_grid/m_datasosial'); ?>?table=m_struktur", {
                            loadurl: "<?php echo site_url('admin/get_editable_select'); ?>?table=m_struktur&filds=name&select=" +
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
                "sTitle": "Bagian / Unit",
                "mData": "name",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "unit_id-" + oData.id;
                    $(nTd).attr("id", id);
                    $(nTd).editable(
                        "<?php echo site_url('admin/update_grid/m_datasosial'); ?>?table=m_unit", {
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
                "sTitle": "Status",
                "mData": "status",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "status-" + oData.id;
                    $(nTd).attr("id", id);
                    $(nTd).editable(
                        "<?php echo site_url('admin/update_grid/m_datasosial'); ?>", {
                            type: "select",
                            data: "{'PNS':'PNS','PTT':'PTT','BLUD':'BLUD','MAGANG':'MAGANG'}",
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
                "mData": "foto",
                "sClass": "center",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    $(nTd).html(
                        "<div class='btn-group'><button type='button' class='btn btn-xs bg-blue'>Foto</button><button type='button' class='btn btn-xs bg-yellow'>Edit</button></div>"
                    );
                    $($(nTd).children()[0]).button().click(function() {
                        selectedId = oData.id;
                        if (oData.foto == null) {
                            $('#lihat').attr('src',
                                "<?php echo base_url('asset/images/dokter'); ?>/preview.png"
                            );
                            $("#btnUpload").show();
                        } else {
                            $('#lihat').attr('src',
                                "<?php echo base_url('asset/images/user'); ?>/" +
                                oData.foto);
                        }
                        $("#dlg-upload").dialog("open");
                        $("#btnUpload").hide();

                    });
                    $($(nTd).children()[1]).button().click(function() {
                        selectedId = oData.id;
                        $.getProcess(selectedId);
                    });
                }
            }

        ]
    });
    $("#btnAdd").button().click(function() {
        $('#frm-add').modal('show');
    });
    $("#btnReload").button().click(function() {
        $("#tblData").dataTable().fnDraw();
    });
    $("#txtTglLahir,#txtTglMasuk").datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        yearRange: '1920:2050'
    });
    $("#cmbDivisi").change(function() {
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "<?php echo site_url('admin/multi_select');?>?table=m_unit",
            success: function(data) {
                if (data == '') {
                    var options = "<option value=''> -- No Result -- </option>";
                } else {
                    var options = "<option value=''> -- Silahkan Pilih -- </option>";
                    for (var i = 0; i < data.length; i++) {

                        options += "<option value='" + data[i].id + "'>" + data[i].name +
                            "</option>";
                    }
                }
                $("#cmbBidang").html(options);

            }
        });
    });
    $("#cmbUnit").change(function() {
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "<?php echo site_url('admin/multi_select');?>?table=m_unit",
            success: function(data) {
                if (data == '') {
                    var options = "<option value=''> -- No Result -- </option>";
                } else {
                    var options = "<option value=''> -- Silahkan Pilih -- </option>";
                    for (var i = 0; i < data.length; i++) {

                        options += "<option value='" + data[i].id + "'>" + data[i].name +
                            "</option>";
                    }
                }
                $("#cmbBidang").html(options);

            }
        });
    });
});
</script>