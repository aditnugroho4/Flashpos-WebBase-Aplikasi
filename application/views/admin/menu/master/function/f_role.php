<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<script type="text/javascript">
String.prototype.replaceAll = function(str1, str2, ignore) {
    return this.replace(new RegExp(str1.replace(/([\/\,\!\\\^\$\{\}\[\]\(\)\.\*\+\?\|\<\>\-\&])/g, "\\$&"), (
        ignore ? "gi" : "g")), (typeof(str2) == "string") ? str2.replace(/\$/g, "$$$$") : str2);
};
var htmlx = '';
var selectedId;
$(document).ready(function() {
    $('.mn-3').addClass('bg-yellow');

    $("#tblData").dataTable({
        "bJQueryUI": true,
        "bAutoWidth": true,
        // "bProcessing": true,
        "iDisplayLength": 15,
        "aLengthMenu": [15, 50, 100, 200],
        "bServerSide": true,
        "sPaginationType": "full_numbers",
        "sAjaxSource": "<?php echo site_url('admin/get_data_table_source'); ?>?table=m_role&columns=,name",
        "aoColumns": [{
                "sTitle": "#",
                "mData": "no",
                "bSortable": false,
                "sClass": "center"
            },
            {
                "sTitle": "Level / Role",
                "mData": "name",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "name-" + oData.id;
                    $(nTd).attr("id", id);
                    $(nTd).editable("<?php echo site_url('admin/update_grid/m_role'); ?>", {
                        "callback": function(sValue, y) {
                            /* Redraw the table from the new data on the server */
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
                url: "<?php echo site_url('admin/create/m_role'); ?>",
                data: {
                    name: $("#txtRole").val()
                },
                success: function(msg) {
                    $("#frm-add").modal("hide");
                    console.log(msg);
                    $("#tblData").dataTable().fnDraw();
                    var title = "Info";
                    var label = "Menyimpan Data";
                    var message = " Data Table berhasil di Simpan.";
                    $('#add-data')[0].reset();
                    alert_info(title, label, message);
                },
                cache: false
            });
            return false;
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
});
</script>