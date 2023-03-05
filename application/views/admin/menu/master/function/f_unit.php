<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<script type="text/javascript">
String.prototype.replaceAll = function(str1, str2, ignore) {
    return this.replace(new RegExp(str1.replace(/([\/\,\!\\\^\$\{\}\[\]\(\)\.\*\+\?\|\<\>\-\&])/g, "\\$&"), (
        ignore ? "gi" : "g")), (typeof(str2) == "string") ? str2.replace(/\$/g, "$$$$") : str2);
};
var htmlx = '';
var selectedId;
var menu = {
    codeunit: '',
    namaunit: ''
};
$(document).ready(function() {
    $('.mn-2').addClass('bg-yellow');

    $("#tblData").dataTable({
        "bJQueryUI": true,
        "bAutoWidth": true,
        "bProcessing": true,
        "iDisplayLength": 15,
        "aLengthMenu": [15, 50, 100, 200],
        "bServerSide": true,
        "sPaginationType": "full_numbers",
        "sAjaxSource": "<?php echo site_url('admin/get_data_table_source'); ?>?table=m_unit&columns=,m_unit.name,m_struktur.name&jwhere=struktur_id,app_id&fildjoins=,m_struktur.name as nama,m_submenu.nama_submenu&joins=m_struktur,m_submenu&exports=m_struktur,m_submenu",
        "aoColumns": [{
                "sTitle": "#",
                "mData": "no",
                "bSortable": false,
                "sClass": "center"
            },
            {
                "sTitle": "Kode",
                "mData": "code",
                "sClass": "center",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "code-" + oData.id;
                    $(nTd).attr("id", id);
                    $(nTd).editable("<?php echo site_url('admin/update_grid/m_unit'); ?>", {
                        "callback": function(sValue, y) {
                            /* Redraw the table from the new data on the server */
                            $("#tblData").dataTable().fnDraw();
                        }
                    });
                }
            },
            {
                "sTitle": "Divisi",
                "mData": "nama",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "struktur_id-" + oData.id;
                    $(nTd).attr("id", id);
                    $(nTd).editable(
                        "<?php echo site_url('admin/update_grid/m_unit'); ?>?table=m_struktur", {
                            loadurl: "<?php echo site_url('admin/get_editable_select'); ?>?table=m_struktur&filds=name&select=" +
                                oData.struktur_id,
                            type: "select",
                            submit: "OK",
                            "callback": function(sValue, y) {
                                /*Redraw the table from the new data on the server */
                                $("#tblData").dataTable().fnDraw();
                            }
                        });
                }
            },
            {
                "sTitle": "Unit / Bagian",
                "mData": "name",
                "sClass": "center",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "name-" + oData.id;
                    $(nTd).attr("id", id);
                    $(nTd).editable("<?php echo site_url('admin/update_grid/m_unit'); ?>", {
                        "callback": function(sValue, y) {
                            /* Redraw the table from the new data on the server */
                            $("#tblData").dataTable().fnDraw();
                        }
                    });
                }
            }, {
                "sTitle": "Applikasi",
                "mData": "nama_submenu",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "app_id-" + oData.id;
                    $(nTd).attr("id", id);
                    $(nTd).editable(
                        "<?php echo site_url('admin/update_grid/m_unit'); ?>?table=m_submenu", {
                            loadurl: "<?php echo site_url('admin/get_editable_select'); ?>?table=m_submenu&filds=nama_submenu&select=" +
                                oData.app_id,
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

    $("#add-data").submit(function(e) {
        e.preventDefault();
        if ($('#add-data').valid()) {
            $.ajax({
                type: "POST",
                dataType: 'json',
                url: "<?php echo site_url('admin/create/m_unit'); ?>",
                data: {
                    name: $("#txtName").val(),
                    struktur_id: $("#cmbStruktur option:selected").val(),
                    app_id: 1
                },
                success: function(ret) {
                    $("#frm-add").modal("hide");
                    var title = "Info";
                    var label = "Menyimpan Data";
                    var message = " Data Table berhasil di Simpan.";
                    $('#add-data')[0].reset();
                    alert_info(title, label, message);
                    $("#tblData").dataTable().fnDraw();
                }
            });
        }
    });

    $("#btnAdd").button().click(function() {
        $('#add-data')[0].reset();
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "<?php echo site_url('admin/multi_select');?>?table=m_struktur",
            success: function(data) {
                $("#cmbStruktur").empty();
                if (data == '') {
                    $("#cmbStruktur").append("<option value=''> -- No Result -- </option>");
                } else {
                    $("#cmbStruktur").append(
                        "<option value=''> -- Silahkan Pilih -- </option>");
                    for (var i = 0; i < data.length; i++) {
                        $("#cmbStruktur").append('<option value="' + data[i].id + '">' +
                            data[i].name + '</option>');
                    }
                    $("#frm-add").modal("show");
                }
            }
        });
    });
    $("#btnReload").button().click(function() {
        $("#tblData").dataTable().fnDraw();
        var title = "Reload..";
        var label = "Data Table..";
        var message = " Data Table berhasil di Refresh..";
        alert_info(title, label, message);
    });

});
</script>