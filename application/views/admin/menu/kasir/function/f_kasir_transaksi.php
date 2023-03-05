<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<script type="text/javascript">
String.prototype.replaceAll = function(str1, str2, ignore) {
    return this.replace(new RegExp(str1.replace(/([\/\,\!\\\^\$\{\}\[\]\(\)\.\*\+\?\|\<\>\-\&])/g, "\\$&"), (
        ignore ? "gi" : "g")), (typeof(str2) == "string") ? str2.replace(/\$/g, "$$$$") : str2);
};
var htmlx = '';
var selectedId;
var eleFocus;
var $date = "<?= R::isoDateTime(); ?>";
var $User = "<?= $user->id;?>";
var $Role = "<?= $role->id;?>";
var Kasir = "<?= $this->input->cookie('Kasir'); ?>";
var Shift = "<?= $shift['shift'];?>";
var jenisSrc = false;
var objItems = {
    id: null,
    kode: null,
    nama: null,
    deskripsi: null,
    satuan: null,
    harga: 0,
    diskon: 0,
    diskon1: 0,
    jumlah: 0,
    bruto: 0,
    total: 0,
    idJenis: null,
    qty: 0,
    foto: null,
    idUser: null,
    dataTable: null
};
var objBayar = {
    id: null,
    tanggal: null,
    shift: null,
    idUser: null,
    qty: 0,
    bruto: 0,
    netto: 0,
    diskon: 0,
    cash: null,
    cashout: null,
    debetNo: null,
    debetBank: null,
    debet: null,
    epaytrx: null,
    epayJs: null,
    epayFee: null,
    epay: null,
    keterangan: null,
    type: null,
    meja: null,
    dataTable: null
};
$(document).ready(function() {
    Globalize.culture("id-ID");
    $('.sidebar-mini').addClass('sidebar-collapse');

    function openWin(elem) {
        // ## The below if statement seems to work better ## if ((document.fullScreenElement && document.fullScreenElement !== null) || (document.msfullscreenElement && document.msfullscreenElement !== null) || (!document.mozFullScreen && !document.webkitIsFullScreen)) {
        if ((document.fullScreenElement !== undefined && document.fullScreenElement === null) || (document
                .msFullscreenElement !== undefined && document.msFullscreenElement === null) || (document
                .mozFullScreen !== undefined && !document.mozFullScreen) || (document.webkitIsFullScreen !==
                undefined && !document.webkitIsFullScreen)) {
            if (elem.requestFullScreen) {
                elem.requestFullScreen();
            } else if (elem.mozRequestFullScreen) {
                elem.mozRequestFullScreen();
            } else if (elem.webkitRequestFullScreen) {
                elem.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);
            } else if (elem.msRequestFullscreen) {
                elem.msRequestFullscreen();
            }
        } else {
            if (document.cancelFullScreen) {
                document.cancelFullScreen();
            } else if (document.mozCancelFullScreen) {
                document.mozCancelFullScreen();
            } else if (document.webkitCancelFullScreen) {
                document.webkitCancelFullScreen();
            } else if (document.msExitFullscreen) {
                document.msExitFullscreen();
            }
        }
    }
    if ($Role == 1) {
        $('[data-toggle="#Bilingkasir"]').addClass('menu-open');
    } else {
        $('[data-toggle="#Applikasi"]').addClass('menu-open');
    }

    $('a[href="' + location + '"]').addClass('active');

    $('#txtSearch').focus();

    $('#btn-maximize').button().click(function() {
        openWin(document.body);
        if ($(this).find('span').text() == "Maximize") {
            $(this).find('span').text('Minimize');
        } else if ($(this).find('span').text() == "Minimize") {
            $(this).find('span').text('Maximize');
        }
    });
    get_items_barang("All");
    $.get_items_by_jenis = function($tag) {
        jenisSrc = true;
        get_items_barang($tag);
    }

    function get_items_barang($tag) {
        $('.data__list__Menu').empty();
        $url = "";
        if ($tag == "All") {
            jenisSrc == false;
            $url = "<?php echo site_url('kasir/get_data_penjualan');?>?table=k_penjualan";
        } else if (jenisSrc == true) {
            $url = "<?php echo site_url('kasir/get_data_penjualan');?>?table=k_penjualan&Jns=" + $tag;
        } else if (jenisSrc == false) {
            $url =
                "<?php echo site_url('kasir/get_data_penjualan');?>?table=k_penjualan&columns=,nama,kode,jenis_id&aSearch=" +
                $tag;
        }
        $('.load-data-items').append(
            '<div class="overlay"><i class="fas fa-2x fa-sync-alt fa-spin"></i></div>');
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: $url,
            success: function(data) {
                for (var i = 0; i < data.length; i++) {
                    let images = "";
                    if (data[i].foto == null) {
                        images =
                            "<img style='height:80px;' class='img-thumbnail' src='<?= base_url('asset/images/product/no-img.png'); ?>'>";
                    } else {
                        images =
                            "<img style='height:80px;' class='img-thumbnail' src='<?= base_url('asset/images/product/kuliner'); ?>/" +
                            data[i].foto + "' alt='' >";
                    }
                    $('.data__list__Menu').append('<div class="col-lg-6">' +
                        '<div class="info-box btn btn-outline-brown text-left" onclick="$.pilih_menu(' +
                        data[i].id + ',1);" > ' + images +
                        '<div class="info-box-content text-md">' +
                        '<span class="info-box-text">' + data[i].kode + '</span>' +
                        '<span class="info-box-text">' + data[i].nama + '</span>' +
                        '<span class="info-box-number">' + Globalize.format(Globalize.parseInt(
                            data[i].harga), "c") + ' (' + data[i]
                        .satuan + ')</span>' +
                        '</div></div>');
                }
                $('.load-data-items').find('.overlay').remove();
                jenisSrc = false;
                return;
            }
        });
    }
    $.pilih_menu = function($tag, $count) {
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "<?php echo site_url('admin/multi_select');?>?table=k_penjualan&select=id&id=" +
                $tag,
            success: function(data) {
                if (data.error == true) {
                    $.alert_swal_info('Data Pembelian', data.message, 'warning');
                } else {
                    let bruto = 0;
                    let qty = 0;
                    let netto = 0;
                    let diskon = 0;
                    let harga = 0;
                    let kode = "";
                    let desc = "";
                    let foto = "";
                    let images = "";
                    let satuan = "";
                    let jenis_id = "";
                    let tanggal = "";
                    let iD = "";
                    for (var i = 0; i < data.length; i++) {
                        if (data[i].foto == null) {
                            images =
                                "<img class='img-thumbnail' src='<?= base_url('asset/images/product/no-img.png'); ?>'>";
                        } else {
                            images =
                                "<img class='img-thumbnail' src='<?= base_url('asset/images/product/kuliner'); ?>/" +
                                data[i].foto + "' alt='' >";
                        }
                        diskon = data[i].diskon;
                        harga = data[i].harga;
                        kode = data[i].kode;
                        desc = data[i].deskripsi;
                        foto = data[i].foto;
                        satuan = data[i].satuan;
                        jenis_id = data[i].jenis_id;
                        tanggal = data[i].tanggal;
                        iD = data[i].id;

                    }
                    Swal.fire({
                        title: '<b>INPUT QTY</b>',
                        html: '<div class="col-lg-12">' +
                            '<div class="row">' + images +
                            '<div class="col-lg-6 text-left">' +
                            '<label class="col-12">' + kode +
                            '</label>' +
                            '<span class="col-12">' + desc +
                            '</span>' +
                            '<label class="col-12">' + Globalize.format(Globalize
                                .parseInt(harga), "c") +
                            '</label>' +
                            '</div>' +
                            '<div class="col-lg-12">' +
                            '<div class="mt-3">' +
                            '<div class="input-group input-group-lg"><div class="input-group-append">' +
                            '<button class="input-group-text btn bg-info" onclick="$.bnt_min(' +
                            $tag + ')">' +
                            '<i class="fas fa-minus"></i></button>' +
                            '</div><input type="numeric" value="' + $count +
                            '" disabled="disabled" id="txtQty' + $tag +
                            '" class="form-control text-center">' +
                            '<div class="input-group-append">' +
                            '<button class="input-group-text btn bg-info" onclick="$.bnt_max(' +
                            $tag +
                            ')"><i class="fas fa-plus"></i></button>' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '</div>',
                        showCancelButton: true,
                        confirmButtonText: "SIMPAN",
                        cancelButtonText: 'CANCEL..!',
                        allowOutsideClick: false,
                        reverseButtons: true,
                        focusConfirm: true,
                        allowEscapeKey: false
                    }).then((result) => {
                        if ($("#txtQty" + $tag).val() > 0) {
                            if (!isNaN(Globalize.parseInt($('#txtQty' + $tag).val())) &&
                                $.isNumeric($('#txtQty' + $tag).val())) {
                                if (result.value) {
                                    qty = Globalize.parseInt($("#txtQty" + $tag).val());
                                    bruto = Math.round(Globalize.parseInt(harga) * qty);
                                    netto = Math.round((Globalize.parseInt(harga) -
                                        Globalize.parseInt(diskon)) * qty);
                                    $("#tblChart").dataTable().fnAddData(
                                        [
                                            $("#tblChart").dataTable()
                                            .fnGetData()
                                            .length + 1,
                                            desc,
                                            harga,
                                            qty,
                                            bruto,
                                            netto,
                                            kode,
                                            diskon,
                                            satuan,
                                            jenis_id,
                                            $User,
                                            foto,
                                            tanggal,
                                            iD
                                        ]
                                    );
                                    objItems.jumlah += qty;
                                    objItems.bruto += bruto;
                                    objItems.diskon += Globalize.parseInt(diskon);
                                    objItems.total += netto;
                                    $("#lbl-Total").html(Globalize.format(objItems
                                        .total, "c"));
                                    $("#lbl-Subtotal").html(Globalize.format(
                                        objItems
                                        .bruto, "c"));
                                    $("#lbl-Diskon").html(Globalize.format(objItems
                                        .diskon, "c"));
                                    $("#lbl-TotBayar").html(Globalize.format(
                                        objItems
                                        .total, "c"));
                                    $("#txtQty" + $tag).val(0);
                                    $("#txtSearch").val('');
                                }
                            }
                        } else {
                            $.alert_swal_info("Pilih Item's",
                                "Masukan Jumlah Item's..", 'warning');
                        }
                    })
                }
            }
        });
    }
    $("#txtSearch").keypress(function(event) {
        if (event.keyCode == 13) {
            jenisSrc = false;
            if ($("#txtSearch").val().length > 0) {
                get_items_barang($("#txtSearch").val());
            }
            event.preventDefault();
        }
    });
    $("#txtSearch").keyup(function(event) {
        if (event.keyCode == 13) {
            jenisSrc = false;
            if ($("#txtSearch").val().length > 0) {
                get_items_barang($("#txtSearch").val());
            }
            event.preventDefault();
        } else if (event.keyCode == 8) {
            jenisSrc = false;
            get_items_barang("All");
            event.preventDefault();
        }
    });
    $("#btn_refresh").button().click(function() {
        get_items_barang("All");
        $(this).val('');
    });
    $.bnt_min = function($tag) {
        if ($('#txtQty' + $tag).val().length > 0) {
            if (Globalize.parseInt($("#txtQty" + $tag).val()) == 0) {
                $("#txtQty" + $tag).val(0);
            } else {
                var count = Globalize.parseInt($("#txtQty" + $tag).val()) - 1;
                $("#txtQty" + $tag).val(count);
            }
        }
    }
    $.bnt_max = function($tag) {
        if ($('#txtQty' + $tag).val().length > 0) {
            var count = Globalize.parseInt($("#txtQty" + $tag).val()) + 1;
            $("#txtQty" + $tag).val(count);
        } else if (!$('#txtQty' + $tag).val().length > 0) {
            $("#txtQty" + $tag).val(0);
        }
    }
    $("#tblChart").DataTable({
        "responsive": false,
        "bJQueryUI": false,
        "bPaginate": false,
        "bAutoWidth": false,
        "bLengthChange": false,
        "bFilter": false,
        "bSort": false,
        "bInfo": false,
        "bRetrieve": true,
        "aoColumns": [{
                "sTitle": "#"
            },
            {
                "sTitle": "Nama"
            },
            {
                "sTitle": "Harga",
                "mRender": function(data, type, full) {
                    return Globalize.format(Globalize.parseInt(data), "c");
                }
            },
            {
                "sTitle": "Qty",
                "sClass": "text-center"
            },
            {
                "sTitle": "Jumlah",
                "sClass": "text-right",
                "mRender": function(data, type, full) {
                    return Globalize.format(data, "c");
                }
            },
            {
                "sTitle": "Action",
                "sClass": "text-center",
                "fnCreatedCell": function(nTd, sData, oData, data, iRow, iCol) {
                    $(nTd).html(
                        "<div class='btn-group'><button type='button' class='btn btn-xs bg-red'><i class='fas fa-trash'></i></button><button type='button' class='btn btn-xs bg-green ml-1'>Edit</button></div>",
                    );
                    $($(nTd).find('.btn-group').children()[0]).button().click(function() {
                        var idx = $($(this).parent().parent().siblings()[0]).html() - 1;
                        var row = $("#tblChart").dataTable().fnGetData()[idx];
                        $("#tblChart").dataTable().fnDeleteRow(idx);
                        if ($("#tblChart").dataTable().fnGetData().length > 0) {
                            $("#tblChart tbody tr").each(function(index) {
                                $($(this).children()[0]).html(index + 1);
                            });
                        }
                        objItems.jumlah -= row[3];
                        objItems.diskon -= row[7];
                        objItems.bruto -= row[4];
                        objItems.total -= row[5];
                        $("#lbl-Total").html(Globalize.format(objItems.total, "c"));
                        $("#lbl-Subtotal").html(Globalize.format(objItems.bruto, "c"));
                        $("#lbl-Diskon").html(Globalize.format(objItems.diskon, "c"));
                        $("#lbl-TotBayar").html(Globalize.format(objItems.total, "c"));
                    });
                    $($(nTd).find('.btn-group').children()[1]).button().click(function() {
                        var idx = $($(this).parent().parent().siblings()[0]).html() - 1;
                        var row = $("#tblChart").dataTable().fnGetData()[idx];
                        $.pilih_menu(row[13], row[3]);
                        $("#tblChart").dataTable().fnDeleteRow(idx);
                        if ($("#tblChart").dataTable().fnGetData().length > 0) {
                            $("#tblChart tbody tr").each(function(index) {
                                $($(this).children()[0]).html(index + 1);
                            });
                        }
                        objItems.jumlah -= row[3];
                        objItems.diskon -= row[7];
                        objItems.bruto -= row[4];
                        objItems.total -= row[5];
                        $("#lbl-Total").html(Globalize.format(objItems.total, "c"));
                        $("#lbl-Subtotal").html(Globalize.format(objItems.bruto, "c"));
                        $("#lbl-Diskon").html(Globalize.format(objItems.diskon, "c"));
                        $("#lbl-TotBayar").html(Globalize.format(objItems.total, "c"));
                    });
                }
            }
        ]
    });

    /* Tombol Pembayaran*/
    $("#btn-bayar").button().click(function() {
        if ($("#tblChart").dataTable().fnGetData().length > 0) {
            $('#txtSubtotal').val(Globalize.format(objItems.bruto, "c"));
            $('#txtDiskon').val(Globalize.format(objItems.diskon, "c"));
            $('#txtTotalbayar').val(Globalize.format(objItems.total, "c"));
            $('#txtTotalItems').val(objItems.jumlah);
            objBayar.qty = objItems.jumlah;
            objBayar.bruto = objItems.bruto;
            objBayar.diskon = objItems.diskon;
            objBayar.netto = objItems.total;
            get_no_meja();
            $('#dlg-frm-bayar').modal('show');
        } else {
            $.alert_swal_info('Pembayaran', "Tidak ada transaksi..", 'warning');
        }
    });
    $('#btn-cancel-bayar').button().click(function() {
        $('#tblChart').dataTable().fnClearTable();
        objItems.jumlah = 0;
        objItems.bruto = 0;
        objItems.diskon = 0;
        objItems.total = 0;
        objBayar.qty = 0;
        objBayar.bruto = 0;
        objBayar.diskon = 0;
        objBayar.netto = 0;
        objBayar.cash = null;
        objBayar.cashout = null;
        objBayar.debetNo = null;
        objBayar.debetBank = null;
        objBayar.debet = null;
        objBayar.epaytrx = null;
        objBayar.epayJs = null;
        objBayar.epay = null;
        $("#lbl-Total").html(Globalize.format(objItems.total, "c"));
        $("#lbl-Subtotal").html(Globalize.format(objItems.bruto, "c"));
        $("#lbl-Diskon").html(Globalize.format(objItems.diskon, "c"));
        $("#lbl-TotBayar").html(Globalize.format(objItems.total, "c"));
        $('.data__list__Menu').each(function() {
            $(this).find('button').removeAttr('disabled');
        });
    });
    $('#btn-clear').button().click(function() {
        $("#dlg-frm-bayar input[type=checkbox]").each(function() {
            $(this).prop("checked", false);
            $('.txtCash').hide();
            $('.txtDebet').hide();
            $('.txtEpay').hide();
            $('.txtCash').find('input').attr('disabled', 'disabled');
            $('.txtDebet').find('input').attr('disabled', 'disabled');
            $('.txtEpay').find('input').attr('disabled', 'disabled');
        });
        $('#dlg-frm-bayar').modal('hide');
        $('#tblChart').dataTable().fnClearTable();
        objItems.jumlah = 0;
        objItems.bruto = 0;
        objItems.diskon = 0;
        objItems.total = 0;
        objBayar.qty = 0;
        objBayar.bruto = 0;
        objBayar.diskon = 0;
        objBayar.netto = 0;
        objBayar.cash = null;
        objBayar.cashout = null;
        objBayar.debetNo = null;
        objBayar.debetBank = null;
        objBayar.debet = null;
        objBayar.epaytrx = null;
        objBayar.epayJs = null;
        objBayar.epay = null;
        $("#lbl-Total").html(Globalize.format(objItems.total, "c"));
        $("#lbl-Subtotal").html(Globalize.format(objItems.bruto, "c"));
        $("#lbl-Diskon").html(Globalize.format(objItems.diskon, "c"));
        $("#lbl-TotBayar").html(Globalize.format(objItems.total, "c"));
        $("#dlg-frm-bayar input").each(function() {
            $(this).val("");
        });
        $('.data__list__Menu').each(function() {
            $(this).find('button').removeAttr('disabled');
        });
    });

    $('.txtCash').hide();
    $('.txtDebet').hide();
    $('.txtEpay').hide();
    $('.txtCash').find('input').attr('disabled', 'disabled');
    $('.txtDebet').find('input').attr('disabled', 'disabled');
    $('.txtEpay').find('input').attr('disabled', 'disabled');

    $('#rbayar input').on('change', function() {

        if ($('input[name=C-bayar]:checked').val() == "cash") {
            $('#txtTotalbayar').val(Globalize.format(objItems.total, "c"));
            objBayar.type = "Cash";
            objBayar.debetNo = null;
            objBayar.debetBank = null;
            objBayar.debet = null;
            objBayar.epaytrx = null;
            objBayar.epayJs = null;
            objBayar.epay = null;
            $('.txtCash').show();
            $('#txtCash').removeAttr('disabled');
            $('.txtCash').find('input').attr('required', true);
            $('#txtCash').focus();
            /* Mandatori */
            $('#txtKartu').val('');
            $('#txtDebet').val('');
            $('.txtDebet').find('input').attr('disabled', 'disabled');
            $('.txtDebet').find('input').attr('required', false);
            $('.txtDebet').hide();
            $('.txtEpay').find('input').attr('disabled', 'disabled');
            $('.txtEpay').find('input').attr('required', false);
            $('.txtEpay').find('input').empty();
            $('#cmbJenisEpay').attr('required', false);
            $('.txtEpay').hide();
        } else if ($('input[name=C-bayar]:checked').val() == "debet") {
            $('#txtTotalbayar').val(Globalize.format(objItems.total, "c"));
            objBayar.type = "Debet";
            objBayar.cash = null;
            objBayar.cashout = null;
            objBayar.epaytrx = null;
            objBayar.epayJs = null;
            objBayar.epay = null;
            $('.txtDebet').show();
            $('#txtKartu').removeAttr('disabled');
            $('.txtDebet').find('input').attr('required', true);
            $('#txtKartu').focus();
            /* Mandatori */
            $('#txtCash').val('');
            $('#txtKembali').val('');
            $('.txtCash').find('input').attr('disabled', 'disabled');
            $('.txtCash').find('input').attr('required', false);
            $('.txtCash').find('input').empty();
            $('.txtCash').hide();
            $('.txtEpay').find('input').attr('disabled', 'disabled');
            $('.txtEpay').find('input').attr('required', false);
            $('.txtEpay').find('input').empty();
            $('#cmbJenisEpay').attr('required', false);
            $('.txtEpay').hide();
        } else if ($('input[name=C-bayar]:checked').val() == "epay") {
            objBayar.type = "E-payment";
            objBayar.cash = null;
            objBayar.cashout = null;
            objBayar.debetNo = null;
            objBayar.debetBank = null;
            objBayar.debet = null;
            $('#txtKartu').val('');
            $('#txtDebet').val('');
            $('.txtDebet').find('input').attr('disabled', 'disabled');
            $('.txtDebet').find('input').attr('required', false);
            $('.txtDebet').find('input').empty();
            $('.txtDebet').hide();
            $('#txtCash').val('');
            $('#txtKembali').val('');
            $('.txtCash').find('input').attr('disabled', 'disabled');
            $('.txtCash').find('input').attr('required', false);
            $('.txtCash').find('input').empty();
            $('.txtCash').hide();
        }
    });
    $("#txtCash").keypress(function(event) {
        //tombol ENTER
        if (event.which == 13) {
            var bayar = $(this);
            var total = Globalize.parseInt($('#txtTotalbayar').val());
            if (bayar.length > 0) {
                if (total < Globalize.parseInt(bayar.val()) || total == Globalize.parseInt(bayar
                        .val())) {
                    let cash = Globalize.parseInt(bayar.val()) - Globalize.parseInt($('#txtTotalbayar')
                        .val());
                    $('#txtKembali').val(Globalize.format(cash, "c"));
                    $('#txtKembali').attr('disabled', 'disabled');
                    objBayar.cash = Math.round(Globalize.parseInt(bayar.val())); /* Uang Masuk */
                    objBayar.cashout = Math.round(Globalize.parseInt($('#txtKembali')
                        .val())); /* Kembalian */
                    $("#btn-finish").removeAttr('disabled');
                    $("#btn-finish").focus();
                } else {
                    $.alert_swal_info('Pembayaran Kasir', 'Jumlah Pembayaran Kurang Dari Pembelian ',
                        'error');
                    bayar.val("");
                    bayar.focus();
                }
            } else {
                bayar.val(0);
            }
            event.preventDefault();
        }
    });

    // Event bayar Debet
    $("#txtKartu").keypress(function(event) {
        //tombol ENTER
        if (event.which == 13) {
            var text = $('#txtDebet');
            if (text.length > 0) {
                objBayar.debetNo = $(this).val();
                $(this).attr('disabled', 'disabled');
                text.removeAttr('disabled');
                text.focus();
            }
            event.preventDefault();
        }
    });
    $("#txtDebet").keypress(function(event) {
        //tombol ENTER
        if (event.which == 13) {
            let text = $('#txtDebet');
            if (text.length > 0) {
                objBayar.debet = Math.round(Globalize.parseInt(text.val()));
                text.attr('disabled', 'disabled');
                $("#btn-finish").focus();
            }
            event.preventDefault();
        }
    });

    // Event bayar e-pay
    $('#btn-epay').click(function() {
        if ($(this).prop("checked") == true) {
            $('#txtTotalbayar').val(Globalize.format(objItems.total, "c"));
            $("#cmbJenisEpay").empty();
            $('#txtEpay').val('');
            $.ajax({
                type: "POST",
                dataType: 'json',
                url: "<?php echo site_url('admin/multi_select');?>?table=m_payment",
                success: function(data) {
                    if (data == '') {
                        $("#cmbJenisEpay").append(
                            "<option value=''> -- No Result -- </option>");
                    } else {
                        $("#cmbJenisEpay").append(
                            "<option value=''> -- Pilih -- </option>");
                        for (var i = 0; i < data.length; i++) {
                            $("#cmbJenisEpay").append("<option value='" + data[i]
                                .id + "' name='" + data[i].payment_fee + "'>" + data[i]
                                .name + "</option>");
                        }
                        $('#cmbJenisEpay').attr('required', true);
                        $('.txtEpay').show();
                        $('.txtEpay').find('input').attr('required', true);
                    }
                }
            });
        }
    });
    $("#cmbJenisEpay").change(function() {
        if ($('#cmbJenisEpay option:selected').val().length > 0) {
            objBayar.epayJs = $('#cmbJenisEpay option:selected').val();
            let text = $('#txtTotalbayar');
            if (text.length > 0) {
                let fee = $('#cmbJenisEpay option:selected').attr("name"); /* Nilai Fee Merchant*/
                let subtotal = Globalize.parseInt(text.val());
                let payfee = (subtotal * fee) / 100; /* Jumlah fee dari total belanja */
                let total = (subtotal + payfee);
                // alert(fee);
                $("#txtEpay").val(Globalize.format(payfee, "c"));
                text.val(Globalize.format(total, "c"));
                objBayar.epayFee = payfee;
                objBayar.epay = total;
                $("#txtEpay").attr('disabled', 'disabled');
                $("#txtTrxidEpay").removeAttr('disabled');
                $("#txtTrxidEpay").focus();
            }
        }
    });
    $("#txtTrxidEpay").keypress(function(event) {
        //tombol ENTER
        if (event.which == 13) {
            let text = $('#txtEpay');
            if (text.length > 0) {
                objBayar.epaytrx = $(this).val();
                $(this).attr('disabled', 'disabled');
                $("#btn-finish").removeAttr('disabled');
                $("#btn-finish").focus();
            }
            event.preventDefault();
        }
    });

    $.pilih_meja = function($tag) {
        objBayar.meja = $tag;
        // alert($tag);
    }
    $("#btn-finish").button().click(function() {
        if ($('#txtTotalbayar').val().length > 0 && $("#tblChart").dataTable().fnGetData().length >
            0) {
            $('.loading-pembayaran').append(
                '<div class="overlay"><i class="fas fa-2x fa-sync-alt fa-spin"></i></div>');
            objBayar.id = Kasir;
            objBayar.tanggal = $date.substr(0, 10);
            objBayar.shift = Shift;
            objBayar.idUser = $User;
            objBayar.dataTable = $("#tblChart").dataTable().fnGetData();
            var data = $.base64.encode(JSON.stringify(objBayar));
            data = data.replaceAll(".", "^");
            data = data.replaceAll("+", "-");
            data = data.replaceAll("/", "_");
            $.ajax({
                type: "POST",
                data: "data=" + data,
                dataType: 'json',
                url: "<?php echo site_url('kasir/pembayaran_kasir'); ?>",
                success: function(msg) {
                    if (msg.error == false) {
                        $('.loading-pembayaran').find('.overlay').remove();
                        window.open("<?= site_url('Kasir/print_struk'); ?>?id=" + msg.id +
                            "&fak=1", 'Struk Pembelian', 'width=390,height=670');
                        $.alert_swal_print_bayar('Pembayaran Berhasil', msg.message,
                            'success', msg.id);
                        for (var i = 0; i < msg.Order.length; i++) {
                            $('#btn-print').append(
                                '<button class="btn bg-brown btn-app mr-2" onclick="$.print_optional(' +
                                msg.id + ',' + msg.Order[i].id +
                                ')"><i class="fas fa-print"></i> ' + msg.Order[i].nama +
                                '</button>');
                        }

                    } else {
                        $('.loading-pembayaran').find('.overlay').remove();
                        $.alert_swal_info('Pembayaran Gagal', msg.message, 'error');
                    }
                }
            });
        } else {
            $.alert_swal_info("Kesalahan Pembayaran", "Mohon Cek Kembali Transaksi Yang di Lakukan",
                "warning");
            $("#txtTglStock").focus();
        }
    });
    $.print_optional = function($id, $Order) {
        window.open("<?= site_url('Kasir/print_struk'); ?>?id=" + $id + "&fak=2&gId=" + $Order,
            'List Order', 'width=390,height=670');
    }
    $.alert_swal_print_bayar = function($info, $message, $alert, $id) {
        Swal.fire({
            icon: $alert,
            title: $info,
            text: $message,
            html: '<div class="row">' +
                '<div class="col-lg-12">' +
                '<div class="text-center ">UANG KEMBALI' +
                '<div class="mt-4 p-1" style="background-color:#111f29;">' +
                '<h4 class="text-yellow text-center">' + Globalize.format(Math.round(objBayar
                    .cashout), "c") + '</h4>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '<div class="col-lg-12 mt-2">' +
                '<div class="text-center"><b>PRINT SESUAI ORDER</b>' +
                '<div id="btn-print" class="mt-2 mb-2"></div></div>' +
                '<div class="mt-4 p-1" style="background-color:#111f29;">' +
                '<p class="text-yellow text-center">Tombol Sesuai Katagori Jika Muncul Maka Semua di Print</p>' +
                '</div>' +
                '</div>' +
                '</div>',
            confirmButtonText: "Close",
            allowOutsideClick: false,
            focusConfirm: true,
            allowEscapeKey: false,
        }).then((result) => {
            if (result.value) {
                $('#btn-clear').button().click();
                $('#tblChart').dataTable().fnClearTable();
                objBayar.id = null;
                objBayar.tanggal = null;
                objBayar.shift = null;
                objBayar.idUser = null;
                objBayar.qty = 0;
                objBayar.bruto = 0;
                objBayar.netto = 0;
                objBayar.diskon = 0;
                objBayar.cash = null;
                objBayar.cashout = null;
                objBayar.debetNo = null;
                objBayar.debetBank = null;
                objBayar.debet = null;
                objBayar.epaytrx = null;
                objBayar.epayJs = null;
                objBayar.epay = null;
                objBayar.keterangan = null;
                objBayar.type = null;
                objBayar.meja = null;
                objBayar.dataTable = null;
                $("#lbl-Total").html(0);
                $("#lbl-Subtotal").html(0);
                $("#lbl-Diskon").html(0);
                $("#lbl-TotBayar").html(0);
                window.location.reload();
            }
        })
    }
    $("#btn-frm-reprint").button().click(function() {
        $('#dlg-frm-reprint').modal('show');
        $('#txtReNota').val("");
        $('#txtReNota').focus();
    });
    $("#btn-rePrint").button().click(function() {
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "<?php echo site_url('admin/multi_select');?>?table=k_transaksi&select=nota&id=" +
                $('#txtReNota').val(),
            success: function(msg) {
                if (msg.error == true) {
                    $.alert_swal_info('Data Pembelian', msg.message, 'warning');
                } else {
                    $('#txtReNota').val("");
                    $('#dlg-frm-reprint').modal('hide');
                    for (var i = 0; i < msg.length; i++) {
                        window.open(
                            "<?= site_url('Kasir/print_struk'); ?>?id=" + msg[i].id +
                            "&fak=1", 'Struk Pembelian', 'width=390,height=670');
                    }
                }
            }
        });
    });
    $.format_text = function(element) {
        $(element).keyup(function(event) {
            if ($(this).val().length > 0) {
                if (!isNaN(Globalize.parseInt($(element).val()))) {
                    $(this).val(Globalize.format(Math.round(Globalize.parseInt($(this).val())),
                        "c"));
                } else {
                    $(this).val('');
                    $(this).focus();
                }
            }
            return false;
        });
        $(element).click(function(event) {
            if ($(this).val().length > 0) {
                if (!isNaN(Globalize.parseInt($(element).val()))) {
                    $(this).val(Globalize.format(Math.round(Globalize.parseInt($(this).val())),
                        "c"));
                } else {
                    $(this).val('');
                    $(this).focus();
                }
            }
            return false;
        });
    }
    $.alert_swal_info = function($info, $message, $alert) {
        Swal.fire({
            icon: $alert,
            title: $info,
            text: $message,
            confirmButtonText: "OK",
            focusConfirm: true
        });
    }
    get_jenis_items();

    function get_no_meja() {
        $(".btn-meja").empty();
        var $data = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23,
            24,
            25, 26, 27, 28, 29, 30
        ];
        for (var i = 0; i < $data.length; i++) {
            $(".btn-meja").append(
                "<button type='button' id='btn-meja" + $data[i] +
                "' class='btn btn-app bg-info mr-1' onclick='$.pilih_meja(" + $data[i] + ")'><h3>" +
                $data[i] +
                "</h3></button>"
            );
        }
    }

    function get_jenis_items() {
        $(".jenis-list").empty();
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "<?php echo site_url('admin/multi_select');?>?table=k_jenis_barang",
            success: function(data) {
                var html = "";
                for (var i = 0; i < data.length; i++) {
                    let images = "";
                    if (data[i].foto == null) {
                        images =
                            "<img style='height:70px;' class='img-thumbnail ml-2' src='<?= base_url('asset/images/product/no-img.png'); ?>' alt='Jenis Menu'>";
                    } else {
                        images =
                            "<img  style='height:70px;' class='img-thumbnail ml-2' src='<?= base_url('asset/images/product/kuliner'); ?>/" +
                            data[i].foto + "' alt='Jenis Menu' >";
                    }
                    $(".jenis-list").append(
                        '<div class="col-lg-3 col-md-6 col-sm-6" onclick="$.get_items_by_jenis(' +
                        data[
                            i]
                        .id + ')">' +
                        '<div class="info-box btn btn-outline-brown text-left col-lg-12">' +
                        '<span class="info-box-icon">' + images + '</span>' +
                        '<div class="info-box-content">' +
                        '<span class="info-box-number text-xs">' + data[i].nama + '</span>' +
                        '</div>' +
                        '</div>');
                }
            }
        });
    }

});
</script>