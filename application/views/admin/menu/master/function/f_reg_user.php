<script type="text/javascript">
String.prototype.replaceAll = function(str1, str2, ignore) {
    return this.replace(new RegExp(str1.replace(/([\/\,\!\\\^\$\{\}\[\]\(\)\.\*\+\?\|\<\>\-\&])/g, "\\$&"), (
        ignore ? "gi" : "g")), (typeof(str2) == "string") ? str2.replace(/\$/g, "$$$$") : str2);
};
var selectedId;
var fildeselect;
var active;
var eleFocus = '';
$(document).ready(function() {
    $('.mn-5').addClass('bg-yellow');
    $('.sidebar-mini').addClass('sidebar-collapse');

    $("#tblData").dataTable({
        "bJQueryUI": true,
        "bAutoWidth": false,
        // "bProcessing": true,
        "iDisplayLength": 15,
        "aLengthMenu": [15, 30, 50, 100],
        "bServerSide": true,
        "sPaginationType": "full_numbers",
        "sAjaxSource": "<?php echo site_url('admin/get_data_table_source'); ?>?table=m_user&columns=,nama,username,status,role_id,auth,ipaddress,m_role.name&jwhere=role_id&fildjoins=,m_role.name&joins=m_role&exports=m_role&cVoid= AND m_user.verifikasi IS NULL",
        "aoColumns": [{
                "sTitle": "#",
                "mData": "no",
                "bSortable": false,
                "sClass": "center"
            },
            {
                "sTitle": "Nama",
                "mData": "nama",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "nama-" + oData.id;
                    $(nTd).attr("id", id);

                }
            },
            {
                "sTitle": "Username",
                "mData": "username",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "username-" + oData.id;
                    $(nTd).attr("id", id);
                }
            },
            {
                "sTitle": "Email",
                "mData": "email",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "email-" + oData.id;
                    $(nTd).attr("id", id);
                    $(nTd).editable("<?php echo site_url('admin/update_grid/m_user'); ?>", {
                        "callback": function(sValue, y) {
                            /* Redraw the table from the new data on the server */
                            $("#tblData").dataTable().fnDraw();
                        }
                    });
                }
            },
            {
                "sTitle": "Role",
                "mData": "name",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "role_id-" + oData.id;
                    $(nTd).attr("id", id);
                    $(nTd).editable(
                        "<?php echo site_url('admin/update_grid/m_user'); ?>?table=m_role", {
                            loadurl: "<?php echo site_url('admin/get_editable_select'); ?>?table=m_role&filds=name&select=" +
                                oData.role_id,
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
                "sTitle": "Verifikasi",
                "sClass": "text-center",
                "mData": "employ_id",
                "bSortable": false,
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    if (oData.employ_id != null) {
                        htmlx =
                            "<button class='btn btn-xs bg-green'><i class='fas fa-check'></i></button>";
                        $(nTd).html(htmlx);
                    } else if (oData.employ_id == null) {
                        htmlx =
                            "<button class='btn btn-xs bg-danger'><i class='fa fa-ban'></i></button>";
                        $(nTd).html(htmlx);
                    }
                }
            },
            {
                "sTitle": "Action",
                "sClass": "center",
                "mData": "verifikasi",
                "bSortable": false,
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    if (oData.verifikasi == 'Y') {
                        htmlx =
                            "<button class='btn btn-xs bg-green waves-effect'><span>Valid</span></button>";
                        $(nTd).html(htmlx);
                    } else if (oData.verifikasi == 'N' || oData.verifikasi == null) {
                        htmlx =
                            "<button class='btn btn-xs bg-red waves-effect'><span>Not Valid</span></button>";
                        $(nTd).html(htmlx);
                        $($(nTd).children()[0]).button().click(function() {
                            var id = "verifikasi-" + oData.id;
                            $(nTd).attr("id", id);
                            if (oData.employ_id == null) {
                                var title = "Action";
                                var label = "Data Table..";
                                var message =
                                    " Data Tidak dapat di rubah Karna User Belum verifikasi email";
                                alert_warning(title, label, message);
                            } else {
                                fildeselect = "verifikasi";
                                selectedId = oData.id;
                                active = 'Y';
                                $("#txtDecision").html("Username akan di aktivkan..?");
                                $("#dlgDecision").modal("show");
                            }
                        });
                    }
                }
            }
        ]
    });
    $('#btn-prosess').button().click(function() {
        $.ajax({
            url: "<?php echo site_url('admin/aktive/m_user'); ?>/" + fildeselect + "/" +
                selectedId + "/" + active,
            success: function(data) {
                $("#tblData").dataTable().fnDraw();
                $("#dlgDecision").modal("hide");
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