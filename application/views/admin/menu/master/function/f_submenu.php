<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<script type="text/javascript">
String.prototype.replaceAll = function(str1, str2, ignore) {
    return this.replace(new RegExp(str1.replace(/([\/\,\!\\\^\$\{\}\[\]\(\)\.\*\+\?\|\<\>\-\&])/g, "\\$&"), (
        ignore ? "gi" : "g")), (typeof(str2) == "string") ? str2.replace(/\$/g, "$$$$") : str2);
};
var cookie;
var idval;
$(document).ready(function() {
    $('.mn-2').addClass('bg-yellow');
    $("#tblData").dataTable({
        "bJQueryUI": true,
        "bAutoWidth": true,
        // "bProcessing": true,
        "bServerSide": true,
        "sPaginationType": "full_numbers",
        "sAjaxSource": "<?php echo site_url('admin/get_data_table_source'); ?>?table=m_submenu&columns=,nama_submenu,m_menu.nama_menu,m_role.name,m_unit.name&jwhere=menu_id,m_menu.role_id,unit_id&fildjoins=,m_menu.nama_menu,m_role.name,m_role.id as roles,m_unit.name as nama&joins=m_menu,m_role,m_unit&exports=m_menu,m_role,m_unit",
        "aoColumns": [{
                "sTitle": "#",
                "mData": "no",
                "bSortable": false,
                "sClass": "center"
            },
            {
                "sTitle": "Nama Submenu",
                "mData": "nama_submenu",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "nama_submenu-" + oData.id;
                    $(nTd).attr("id", id);
                    $(nTd).editable("<?php echo site_url('admin/update_grid/m_submenu'); ?>", {
                        "callback": function(sValue, y) {
                            /* Redraw the table from the new data on the server */
                            $("#tblData").dataTable().fnDraw();
                        }
                    });
                }
            },
            {
                "sTitle": "Posisi Menu",
                "mData": "nama_menu",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "menu_id-" + oData.id;
                    $(nTd).attr("id", id);
                }
            },
            {
                "sTitle": "Level User",
                "mData": "name",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "menu_id-" + oData.id;
                    $(nTd).attr("id", id);
                }
            },
            {
                "sTitle": "Unit / Bagian",
                "mData": "nama",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "unit_id-" + oData.id;
                    $(nTd).attr("id", id);
                    $(nTd).editable(
                        "<?php echo site_url('admin/update_grid/m_submenu'); ?>?table=m_unit", {
                            loadurl: "<?php echo site_url('admin/get_editable_select'); ?>?table=m_unit&filds=name&select=" +
                                oData.unit_id,
                            type: "select",
                            submit: "OK",
                            "callback": function(sValue, y) {
                                /* Redraw the table from the new data on the server*/
                                $("#tblData").dataTable().fnDraw();
                            }
                        });
                }
            },
            {
                "sTitle": "Link Module",
                "mData": "link_submenu",
                "bSortable": false,
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "link_submenu-" + oData.id;
                    $(nTd).attr("id", id);
                    $(nTd).editable("<?php echo site_url('admin/update_grid/m_submenu'); ?>", {
                        "callback": function(sValue, y) {
                            /* Redraw the table from the new data on the server */
                            $("#tblData").dataTable().fnDraw();
                        }
                    });
                }
            },
            {
                "sTitle": "Urut Togle",
                "mData": "urutan",
                "bSortable": false,
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "urutan-" + oData.id;
                    $(nTd).attr("id", id);
                    $(nTd).editable("<?php echo site_url('admin/update_grid/m_submenu'); ?>", {
                        type: "select",
                        data: "{'1':'1','2':'2','3':'3','4':'4','5':'5','6':'6','7':'7','8':'8','9':'9','10':'10'}",
                        submit: "OK",
                        "callback": function(sValue, y) {
                            /* Redraw the table from the new data on the server*/
                            $("#tblData").dataTable().fnDraw();
                        }
                    });
                }
            },
            {
                "sTitle": "Action",
                "mData": "active",
                "sClass": "center",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "active-" + oData.id;
                    $(nTd).attr("id", id);

                    tbls = "m_submenu";
                    filds = "active";
                    if (oData.active == 'Y') {
                        $(nTd).html(
                            "<div class='btn-group'><button type='button' class='btn btn-xs bg-green mr-2'>Status <i class='fas fa-check'></i></button><button type='button' class='btn btn-xs bg-yellow'>Edit</button></div>"
                        );
                        $($(nTd).find('div').children()[0]).button().click(function() {
                            active = 'N';
                            selectedId = oData.id;
                            $("#txtAlert").html("Menu ini akan di non aktive..?");
                            $("#dlgAlert").modal("show");
                        });
                        $($(nTd).find('div').children()[1]).button().click(function() {
                            selectedId = oData.id;
                            $("#txtNama_e").val(oData.nama_submenu);
                            get_role();
                        });
                    } else if (oData.active == 'N') {
                        $(nTd).html(
                            "<div class='btn-group'><button type='button' class='btn btn-xs bg-danger mr-2'>Status <i class='fa fa-ban'></i></button><button type='button' class='btn btn-xs bg-yellow'>Edit</button></div>"
                        );
                        $($(nTd).find('div').children()[0]).button().click(function() {
                            active = 'Y';

                            $("#txtAlert").html("Menu ini akan di aktive kan..?");
                            $("#dlgAlert").modal("show");
                        });
                        $($(nTd).find('div').children()[1]).button().click(function() {
                            selectedId = oData.id;
                            $("#txtNama_e").val(oData.nama_submenu);
                            get_role();
                        });
                    }
                }
            }
        ]
    });

    function get_role() {
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "<?php echo site_url('admin/multi_select');?>?table=m_role",
            success: function(data) {
                $("#cmbRole_e").empty();
                if (data == '') {
                    $("#cmbRole_e").append("<option value=''> -- No Result -- </option>");
                } else {
                    $("#frm-edit-submenu").modal("show");
                    $("#cmbRole_e").append(
                        "<option value=''> -- Silahkan Pilih -- </option>");
                    for (var i = 0; i < data.length; i++) {
                        $("#cmbRole_e").append('<option value="' + data[i].id + '">' +
                            data[i].name + '</option>');
                    }

                }
            }
        });
    }
    $("#cmbRole_e").change(function() {
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "<?php echo site_url('admin/multi_select');?>?table=m_menu&select=role_id&id=" +
                $("#cmbRole_e option:selected").val(),
            success: function(data) {
                $("#cmbNamaMenu_e").empty();
                if (data == '') {
                    $("#cmbNamaMenu_e").append(
                        "<option value=''> -- No Result -- </option>");
                } else {
                    $("#cmbNamaMenu_e").append(
                        "<option value=''> -- Silahkan Pilih -- </option>");
                    for (var i = 0; i < data.length; i++) {
                        $("#cmbNamaMenu_e").append('<option value="' + data[i].id + '">' +
                            data[i].nama_menu + '</option>');
                    }
                }
            }
        });
    });

    $("#btnReload").button().click(function() {
        $("#tblData").dataTable().fnDraw();
        var title = "Reload..";
        var label = "Data Table..";
        var message = " Data Table berhasil di Refresh..";
        $.swalDefaultAlert(title + "<br> " + label + " <br> message: " + message, 'info');
    });

    $('#add-data').submit(function(e) {
        e.preventDefault();
        if ($('#add-data').valid()) {
            $.ajax({
                type: "POST",
                dataType: 'json',
                url: "<?php echo site_url('admin/create/m_submenu'); ?>",
                data: {
                    nama_submenu: $("#txtContent").val(),
                    link_submenu: $("#txtFolder").val(),
                    menu_id: $("#cmbNamaMenu option:selected").val(),
                    unit_id: $("#cmbUnit option:selected").val(),
                    active: 'Y'
                },
                success: function(msg) {
                    if (msg.error == false) {
                        $.swalDefaultAlert("error: " + msg.error + "<br> Code: " + msg
                            .code + " <br> message: " + msg.message, 'success');
                        $('#add-data')[0].reset();
                    } else {
                        $.swalDefaultAlert("error: " + msg.error + "<br> Code: " + msg
                            .code + " <br> message: " + msg.message, 'warning');
                    }
                    $("#tblData").dataTable().fnDraw();
                    $('#frm-add').modal('hide');
                },
                cache: false
            });
            return false;
        }
    });
    $("#btnAdd").button().click(function() {
        $('#add-data')[0].reset();
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "<?php echo site_url('admin/multi_select');?>?table=m_unit",
            success: function(data) {
                $("#cmbUnit").empty();
                if (data == '') {
                    $("#cmbUnit").append("<option value=''> -- No Result -- </option>");
                } else {
                    $('#frm-add').modal('show');
                    $("#cmbUnit").append(
                        "<option value=''> -- Silahkan Pilih -- </option>");
                    for (var i = 0; i < data.length; i++) {
                        $("#cmbUnit").append('<option value="' + data[i].id + '">' +
                            data[i].name + '</option>');
                    }
                }
            }
        });
    });
    $("#cmbUnit").change(function() {
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "<?php echo site_url('admin/multi_select');?>?table=m_role",
            success: function(data) {
                $("#cmbRole").empty();
                if (data == '') {
                    $("#cmbRole").append("<option value=''> -- No Result -- </option>");
                } else {
                    $("#cmbRole").append(
                        "<option value=''> -- Silahkan Pilih -- </option>");
                    for (var i = 0; i < data.length; i++) {
                        $("#cmbRole").append('<option value="' + data[i].id + '">' +
                            data[i].name + '</option>');
                    }
                }
            }
        });
    });
    $("#cmbRole").change(function() {
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "<?php echo site_url('admin/multi_select');?>?table=m_menu&select=role_id&id=" +
                $("#cmbRole option:selected").val(),
            success: function(data) {
                $("#cmbNamaMenu").empty();
                if (data == '') {
                    $("#cmbNamaMenu").append("<option value=''> -- No Result -- </option>");
                } else {
                    $("#cmbNamaMenu").append(
                        "<option value=''> -- Silahkan Pilih -- </option>");
                    for (var i = 0; i < data.length; i++) {
                        $("#cmbNamaMenu").append('<option value="' + data[i].id + '">' +
                            data[i].nama_menu + '</option>');
                    }
                }
                $("#txtFolder").focus();
            }
        });
    });
    $('#edit-data-submenu').submit(function(e) {
        e.preventDefault();
        if ($('#edit-data-submenu').valid()) {
            $.ajax({
                type: "POST",
                dataType: 'json',
                url: "<?php echo site_url('admin/update/m_submenu'); ?>",
                data: {
                    id: selectedId,
                    menu_id: $("#cmbNamaMenu_e option:selected").val(),
                    unit_id: $("#cmbUnit_e option:selected").val()
                },
                success: function(msg) {
                    if (msg.error == false) {
                        $.swalDefaultAlert("error: " + msg.error + "<br> Code: " + msg
                            .code + " <br> message: " + msg.message, 'success');
                        $('#edit-data-submenu')[0].reset();
                    } else {
                        $.swalDefaultAlert("error: " + msg.error + "<br> Code: " + msg
                            .code + " <br> message: " + msg.message, 'warning');
                    }
                    $("#tblData").dataTable().fnDraw();
                    $('#frm-edit-submenu').modal('hide');
                },
                cache: false
            });
            return false;
        }
    });

});
</script>