<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<script type="text/javascript">
var fildeselect;
var active;
var eleFocus = '';
var idKasir;
var Closing;
var Tanggal;
$(document).ready(function() {
    Globalize.culture("id-ID");
    $('.mn-3').addClass('bg-brown');
    let Url = "";
    if ($role == 1) {
        Url =
            "<?php echo site_url('admin/get_data_table_source'); ?>?table=k_initial_kasir&columns=,tanggal,shift,user_id&jwhere=user_id&fildjoins=,m_user.nama&joins=m_user&exports=m_user";
    } else {
        Url =
            "<?php echo site_url('admin/get_data_table_source'); ?>?table=k_initial_kasir&columns=,tanggal,shift,user_id&jwhere=user_id&fildjoins=,m_user.nama&joins=m_user&exports=m_user&filds=k_initial_kasir.user_id&var=" +
            $User;
    }
    $("#tblData").dataTable({
        "bJQueryUI": true,
        "bAutoWidth": false,
        // "bProcessing": true,
        "iDisplayLength": 5,
        "aLengthMenu": [10, 20, 50],
        "bServerSide": true,
        "sPaginationType": "full_numbers",
        "sAjaxSource": Url,
        "aoColumns": [{
                "sTitle": "#",
                "mData": "no",
                "bSortable": false,
                "sClass": "center"
            },
            {
                "sTitle": "Kasir",
                "mData": "nama",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "user_id-" + oData.id;
                    $(nTd).attr("id", id);
                }
            },
            {
                "sTitle": "Tanggal",
                "mData": "tanggal",
                "sClass": "text-center",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "tanggal-" + oData.id;
                    $(nTd).attr("id", id);
                }
            },
            {
                "sTitle": "Shift",
                "mData": "shift",
                "sClass": "text-center",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "shift-" + oData.id;
                    $(nTd).attr("id", id);
                }
            },
            {
                "sTitle": "Transaksi",
                "mData": "transaksi",
                "sClass": "text-center",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "transaksi-" + oData.id;
                    $(nTd).attr("id", id);
                }
            },
            {
                "sTitle": "Total",
                "mData": "total",
                "sClass": "text-right",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "qty-" + oData.id;
                    $(nTd).attr("id", id);
                },
                "mRender": function(data, type, full) {
                    if (data != null) {
                        return Globalize.format(Globalize.parseInt(data), "c");
                    } else {
                        return 0;
                    }

                }
            },
            {
                "sTitle": "Status",
                "mData": "status",
                "sClass": "text-center",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    var id = "status-" + oData.id;
                    $(nTd).html(
                        "<div class='btn-group'><div class='btn btn-sm btn-info'><i id='i-color-" +
                        oData.id +
                        "' class='fas fa-bell'></i> <span></span></div></div>"
                    );
                    if (oData.status == null) {
                        $($(nTd).children()[0]).find("span").html("&nbsp;Belum Closing");
                    } else if (oData.status == 'Y') {
                        $($(nTd).children()[0]).find("div").attr("class",
                            "btn btn-sm btn-success");
                        $($(nTd).children()[0]).find("i").html("&nbsp;Valid");
                    }
                }
            },
            {
                "sTitle": "Action",
                "mData": "id",
                "sClass": "text-center",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    $(nTd).html(
                        "<div class='btn-group'><button type='button' class='btn btn-xs bg-blue mr-1'><i class='fas fa-print'></i> Re-Print</button></div>"
                    );
                    $($(nTd).find('.btn-group').children()[0]).button().click(function() {
                        if (oData.status == null) {
                            selectedId = oData.id;
                            idKasir = oData.user_id;
                            Tanggal = oData.tanggal;
                            $('#dlg-frm-closing').modal('show');
                            $('#post_closing_kasir').hide();
                            $('#initial-name').html(oData.nama);
                        } else if (oData.status == 'Y') {
                            window.open(
                                "<?= site_url('Kasir/print_closing'); ?>?id=" +
                                oData.id,
                                'Struk Closing',
                                'width=390,height=670');
                        }
                    });
                }
            }
        ]
    });
    $("#btn-cek-initial").button().click(function() {
        if ($('#txtPinClosing').val().length < 3) {
            $.alert_swal_info('Initial Kasir', "Pin Jangan Kurang 3 Digit", 'warning');
        } else {
            $('.load-initial').append(
                '<div class="overlay"><i class="fas fa-2x fa-sync-alt fa-spin"></i></div>');
            $.ajax({
                url: "<?php echo site_url('kasir/cek_initial/k_initial_kasir');?>",
                type: "post",
                dataType: "JSON",
                data: {
                    id: selectedId,
                    user_id: idKasir,
                    tanggal: Tanggal,
                    pin: $.md5($("#txtPinClosing").val())
                },
                success: function(msg) {
                    if (msg.error == false) {
                        if (msg.data['status'] == 'Y') {
                            $.alert_swal('Closing Kasir', 'Kasir Sudah Closing',
                                'warning');
                        } else {
                            $('#txtPinClosing').val("");
                            $('.pass-closing').hide();
                            $('#post_closing_kasir').show();
                            $('#lbl-oop').html(msg.data['Oprator']);
                            $('#lbl-date').html(msg.data['tanggal']);
                            $('#lbl-shift').html('<b>' + msg.data['shift'] + '</b>');
                            $('#lbl-jam-in').html(msg.data['jam']);
                            $('.load-initial').find('.overlay').remove();
                            Closing = msg.id;
                            $('#txtCashDrawer').focus();
                        }
                    } else {
                        if (msg.code == 100) {
                            $.alert_swal('Closing Kasir', msg.message, 'warning');
                        } else if (msg.code == 101) {
                            $.alert_swal_info('Closing Kasir', msg.message, 'warning');
                            $('.load-initial').find('.overlay').remove();
                        } else {
                            $.alert_swal_info('Closing Kasir', msg.message, 'warning');
                            $('.load-initial').find('.overlay').remove();
                        }

                    }
                }
            });
        }
    });
    $('#post_closing_kasir').submit(function(e) {
        e.preventDefault();
        if ($('#post_closing_kasir').valid()) {
            $('.load-initial').append(
                '<div class="overlay"><i class="fas fa-2x fa-sync-alt fa-spin"></i></div>');
            $.ajax({
                url: "<?php echo site_url('kasir/prosess_closing/k_initial_kasir');?>",
                type: "post",
                dataType: "JSON",
                data: {
                    id: Closing,
                    user_id: $User,
                    tanggal: Tanggal,
                    uang: Globalize.parseInt($("#txtCashDrawer").val())
                },
                success: function(msg) {
                    if (msg.error == false) {
                        $.alert_swal_print_closing('Form Tutup Kasir', msg.message,
                            'success', msg.id);
                    } else {
                        if (msg.code == 100) {
                            $.alert_swal('Tutup Kasir', msg.message, 'warning');
                        } else if (msg.code == 101) {
                            $.alert_swal_info('Tutup Kasir', msg.message, 'warning');
                            $('.load-initial').find('.overlay').remove();
                        } else {
                            $.alert_swal_info('Tutup Kasir', msg.message, 'warning');
                            $('.load-initial').find('.overlay').remove();
                        }

                    }
                }
            });
        }
    });
    $.alert_swal_print_closing = function($info, $message, $alert, $id) {
        Swal.fire({
            icon: $alert,
            title: $info,
            text: $message,
            confirmButtonText: "PRINT CLOSING",
            focusConfirm: false,
            allowOutsideClick: false,
            allowEscapeKey: false,
        }).then((result) => {
            if (result.value) {
                $('#post_closing_kasir')[0].reset();
                $('.load-initial').find('.overlay').remove();
                $("#btn-clear-closing").button().click();
                $('#dlg-frm-closing').modal('hide');
                $("#tblData").dataTable().fnDraw();
                window.open(
                    "<?= site_url('Kasir/print_closing'); ?>?id=" + $id, 'Struk Closing',
                    'width=390,height=670');
            }
        })
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
                // $('#tab-stock a[href="#DataStock"]').trigger('click');
                $("#tblData").dataTable().fnDraw();
            }
        })
    }
});
</script>
<div class="col-md-12">
    <div class="card card-outline card-yellow load-Barang">
        <div class="card-header">
            <h3 class="card-title col-lg-4 col-sm-12 mb-2">Data Transakasi </h3>
        </div>
        <div class="card-body">
            <div class="callout callout-info">
                <div class="table-responsive ">
                    <table id="tblData" class="table table-bordered table-striped" width="100%"></table>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="dlg-frm-closing" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content load-initial">
            <div class="modal-header">
                <h5 class="modal-title">Closing</h5>
            </div>
            <div class="modal-body">
                <div class="lockscreen">
                    <div class="card bg-brown rounded">
                        <div class="pass-closing">
                            <div class="lockscreen-name" id="initial-name"></div>
                            <div class="lockscreen-item text-dark">
                                <div class="lockscreen-image bg-dark">
                                    <i class="fas fa-2x fa-key bg-grey"></i>
                                </div>
                                <div class="lockscreen-credentials">
                                    <div class="input-group">
                                        <input type="password" id="txtPinClosing" maxlength="6" class="form-control"
                                            placeholder="Masukan Pin Kasir">
                                        <div class="input-group-append">
                                            <button type="button" id="btn-cek-initial" class="btn bg-navy col-12">Cek <i
                                                    class="fas fa-arrow-right"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form id="post_closing_kasir" style="display:none;">
                            <table class="table">
                                <tr>
                                    <td>Oprator</td>
                                    <td>:</td>
                                    <td id="lbl-oop"></td>
                                </tr>
                                <tr>
                                    <td>Tanggal</td>
                                    <td>:</td>
                                    <td id="lbl-date"></td>
                                </tr>
                                <tr>
                                    <td>Sihft</td>
                                    <td>:</td>
                                    <td id="lbl-shift"></td>
                                </tr>
                                <tr>
                                    <td>Jam Initial</td>
                                    <td>:</td>
                                    <td id="lbl-jam-in"></td>
                                </tr>
                            </table>
                            <div class="lockscreen-name">Masukan Jumlah Uang Cash</div>
                            <div class="lockscreen-item text-dark">
                                <div class="lockscreen-image bg-dark">
                                    <i class="fas fa-2x fa-dollar-sign bg-grey"></i>
                                </div>
                                <div class="lockscreen-credentials">
                                    <div class="input-group">
                                        <input type="text" id="txtCashDrawer" class="form-control"
                                            placeholder="Jumlah Uang Cash" onfocus="$.format_text(this);" required>
                                        <div class="input-group-append">
                                            <button type="submit" class="btn bg-navy">Posting <i
                                                    class="fas fa-arrow-right ml-1 mt-1 float-right"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="lockscreen-item">
                                <button type="button" id="btn-clear-closing" class="btn bg-navy col-12">Cancel <i
                                        class="fa fa-close"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-app bg-warning " id="btn-clear"><i
                            class="fas fa-exclamation-circle"></i> Cancel</button>
                </div>
            </div>
        </div>
    </div>