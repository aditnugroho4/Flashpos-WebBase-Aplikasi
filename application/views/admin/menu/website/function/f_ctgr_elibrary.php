<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<script type="text/javascript">
String.prototype.replaceAll = function(str1, str2, ignore) {
    return this.replace(new RegExp(str1.replace(/([\/\,\!\\\^\$\{\}\[\]\(\)\.\*\+\?\|\<\>\-\&])/g, "\\$&"), (
        ignore ? "gi" : "g")), (typeof(str2) == "string") ? str2.replace(/\$/g, "$$$$") : str2);
};
var selectedId;
var fildeselect;
var active;
var tables;
$(document).ready(function() {
    $('.flex-column').find('.bg-yellow').removeClass('bg-yellow');
    $('.mn-2').addClass('bg-yellow');

    $("#tblData").dataTable({
        "bJQueryUI": true,
        "bAutoWidth": true,
        // "bProcessing": true,
        "iDisplayLength": 15,
        "aLengthMenu": [15, 50, 100, 200],
        "bServerSide": true,
        "sPaginationType": "full_numbers",
        "sAjaxSource": "<?php echo site_url('admin/get_data_table_source'); ?>?table=w_post_ctgr_lib&columns=,name",
        "aoColumns": [{
                "sTitle": "#",
                "mData": "no",
                "bSortable": false,
                "sClass": "center"
            },
            {
                "sTitle": "Nama",
                "mData": "nama",
                "sClass": "center",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "nama-" + oData.id;
                    $(nTd).attr("id", id);
                    $(nTd).editable(
                        "<?php echo site_url('admin/update_grid/w_post_ctgr_lib'); ?>", {
                            "callback": function(sValue, y) {
                                /* Redraw the table from the new data on the server */
                                $("#tblData").dataTable().fnDraw();
                            }
                        });
                }
            }, {
                "sTitle": "Folder Direktori",
                "mData": "folder",
                "sClass": "center",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "label-" + oData.id;
                    $(nTd).attr("id", id);
                    $(nTd).editable(
                        "<?php echo site_url('admin/update_grid/w_post_ctgr_lib'); ?>", {
                            "callback": function(sValue, y) {
                                /* Redraw the table from the new data on the server */
                                $("#tblData").dataTable().fnDraw();
                            }
                        });
                }
            }, {
                "sTitle": "Status",
                "sClass": "text-center",
                "mData": "status",
                "bSortable": false,
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    if (oData.status == 'Y') {
                        htmlx =
                            "<button class='btn btn-xs bg-green'><i class='fas fa-check'></i></button>";
                        $(nTd).html(htmlx);
                        $($(nTd).children()[0]).button().click(function() {
                            var id = "status-" + oData.id;
                            $(nTd).attr("id", id);
                            selectedId = oData.id;
                            fildeselect = "status";
                            active = null;
                            tables = "w_post_ctgr_lib";
                            $("#txtDecision").html(
                                "Status akan di Ubah Menjadi Non aktif..?");
                            $("#dlgDecision").modal("show");
                        });
                        $($(nTd).children()[0]).find("span").css("padding", "2px 2px");
                    } else if (oData.status == null) {
                        htmlx =
                            "<button class='btn btn-xs bg-danger'><i class='fa fa-ban'></i></button>";
                        $(nTd).html(htmlx);
                        $($(nTd).children()[0]).button().click(function() {
                            var id = "status-" + oData.id;
                            $(nTd).attr("id", id);
                            fildeselect = "status";
                            selectedId = oData.id;
                            active = 'Y';
                            tables = "w_post_ctgr_lib";
                            $("#txtDecision").html(
                                "Status akan di Ubah Menjadi aktif..?");
                            $("#dlgDecision").modal("show");
                        });
                    }
                }
            },
        ]
    });
    $("#add-data").submit(function(e) {
        e.preventDefault();
        if ($('#add-data').valid()) {
            $('.load-ding-add').append(
                '<div class="overlay"><i class="fas fa-2x fa-sync-alt fa-spin"></i></div>');
            $.ajax({
                type: "POST",
                dataType: 'json',
                url: "<?php echo site_url('admin/create/w_post_ctgr_lib'); ?>",
                data: {
                    name: $("#txtName").val()
                },
                success: function(ret) {
                    var title = "Info";
                    var label = "Menyimpan Data";
                    var message = " Data Table berhasil di Simpan.";
                    $('#add-data')[0].reset();
                    alert_info(title, label, message);
                    $("#tblData").dataTable().fnDraw();
                    $('.load-ding-add').find('.overlay').remove();
                    $("#frm-add").modal("hide");

                }
            });
        }
    });
    $("#btnAdd").button().click(function() {
        $('#add-data')[0].reset();
        $("#frm-add").modal("show");
    });
    $("#btnReload").button().click(function() {
        $("#tblData").dataTable().fnDraw();
        var title = "Reload..";
        var label = "Data Table..";
        var message = " Data Table berhasil di Refresh..";
        alert_info(title, label, message);
    });
    $("#btnLink").button().click(function() {
        $("#dlg-add_permalink").modal("show");
    });
    $("#btnSetting").button().click(function() {
        $("#dlg-setting_permalink").modal("show");
    });
    $('#btn-prosess').button().click(function() {
        $.ajax({
            url: "<?php echo site_url('admin/aktive'); ?>/" + tables + "/" + fildeselect + "/" +
                selectedId + "/" + active,
            success: function(data) {
                $("#tblData").dataTable().fnDraw();
                $("#dlgDecision").modal("hide");
            }
        });
    });
});
</script>