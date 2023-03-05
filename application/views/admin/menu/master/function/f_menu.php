<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<script type="text/javascript">
String.prototype.replaceAll = function(str1, str2, ignore) {
    return this.replace(new RegExp(str1.replace(/([\/\,\!\\\^\$\{\}\[\]\(\)\.\*\+\?\|\<\>\-\&])/g, "\\$&"), (
        ignore ? "gi" : "g")), (typeof(str2) == "string") ? str2.replace(/\$/g, "$$$$") : str2);
};
var cookie;
var idval;
$(document).ready(function() {
    $('.mn-1').addClass('bg-yellow');
    $("#tblData").dataTable({
        "bJQueryUI": true,
        "bAutoWidth": true,
        // "bProcessing": true,
        "iDisplayLength": 20,
        "aLengthMenu": [20, 50, 100, 200],
        "bServerSide": true,
        "sPaginationType": "full_numbers",
        "sAjaxSource": "<?php echo site_url('admin/get_data_table_source'); ?>?table=m_menu&columns=,nama_menu,role_id,name,status,material_icon,fonts_icon,class1,class2&jwhere=role_id&fildjoins=,m_role.name&joins=m_role&exports=m_role",
        "aoColumns": [{
                "sTitle": "#",
                "mData": "no",
                "bSortable": false,
                "sClass": "center"
            },
            {
                "sTitle": "Nama Manu",
                "mData": "nama_menu",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "nama_menu-" + oData.id;
                    $(nTd).attr("id", id);
                    $(nTd).editable("<?php echo site_url('admin/update_grid/m_menu'); ?>", {
                        "callback": function(sValue, y) {
                            /* Redraw the table from the new data on the server */
                            $("#tblData").dataTable().fnDraw();
                        }
                    });
                }
            },
            {
                "sTitle": "Level User",
                "mData": "name",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "role_id-" + oData.id;
                    $(nTd).attr("id", id);
                    $(nTd).editable(
                        "<?php echo site_url('admin/update_grid/m_menu/'); ?>?table=m_role", {
                            loadurl: "<?php echo site_url('admin/get_editable_select'); ?>?table=m_role&filds=name&select=" +
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
                "sTitle": "Material Icons",
                "mData": "material_icon",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "class-" + oData.id;
                    $(nTd).attr("id", id);
                    $(nTd).editable("<?php echo site_url('admin/update_grid/m_menu'); ?>", {
                        "callback": function(sValue, y) {
                            /* Redraw the table from the new data on the server */
                            $("#tblData").dataTable().fnDraw();
                        }
                    });
                }
            },
            {
                "sTitle": "font awesome Icon",
                "mData": "fonts_icon",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "fonts_icon-" + oData.id;
                    $(nTd).attr("id", id);
                    $(nTd).editable("<?php echo site_url('admin/update_grid/m_menu'); ?>", {
                        "callback": function(sValue, y) {
                            /* Redraw the table from the new data on the server */
                            $("#tblData").dataTable().fnDraw();
                        }
                    });
                }
            },
            {
                "sTitle": "Action",
                "sClass": "text-center",
                "mData": null,
                "bSortable": false,
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "status-" + oData.id;
                    $(nTd).attr("id", id);
                    selectedId = oData.id;
                    tbls = "m_menu";
                    filds = "status";
                    if (oData.status == 'Y') {
                        htmlx =
                            "<button class='btn btn-xs bg-green'><i class='fas fa-check'></i></button>";
                        $(nTd).html(htmlx);
                        $($(nTd).children()[0]).button().click(function() {
                            active = 'N';
                            $("#txtAlert").html("Menu ini akan di non aktive..?");
                            $("#dlgAlert").modal("show")
                        });
                    } else if (oData.status == 'N' || oData.status == null) {
                        htmlx =
                            "<button class='btn btn-xs bg-danger'><i class='fa fa-ban'></i></button>";
                        $(nTd).html(htmlx);
                        $($(nTd).children()[0]).button().click(function() {
                            active = 'Y';
                            $("#txtAlert").html("Menu ini akan di aktive kan..?");
                            $("#dlgAlert").modal("show");
                        });
                    }
                }
            }
        ]
    });
    $("#btnReload").button().click(function() {
        $("#tblData").dataTable().fnDraw();
        var title = "Reload..";
        var label = "Data Table..";
        var message = " Data Table berhasil di Refresh..";
        alert_info(title, label, message);
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
                    $('#frm-add').modal('show');
                    $("#cmbUnit").append(
                        '<option value=""> -- Silahkan Pilih -- </option>');
                    for (var i = 1; i < data.length; i++) {
                        $("#cmbUnit").append("<option value='" + data[i].id + "'>" + data[i]
                            .name + "</option>");
                    }
                }
            }
        });
    });

    $('#add-data').submit(function(e) {
        e.preventDefault();
        if ($('#add-data').valid()) {
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "<?php echo site_url('admin/create_menu'); ?>/" + $(
                    '#cmbUnit option:selected').val(),
                data: $('#add-data').serialize(),

                success: function(data) {
                    if (data.error == false) {
                        $('#frm-add').modal("hide");
                        $.swalDefaultAlert("error: " + data.error + "<br> Code: " + data
                            .code + " <br> message: " + data.message, 'success');
                        $("#tblData").dataTable().fnDraw();
                    } else {
                        $('#frm-add').modal("hide");
                        $.swalDefaultAlert("error: " + data.error + "<br> Code: " + data
                            .code + " <br> message: " + data.message, 'success');
                        $("#tblData").dataTable().fnDraw();
                    }
                }
            });
        }
    });
});
</script>