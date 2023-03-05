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
var Closing;
$(document).ready(function() {
    Globalize.culture("id-ID");
    if ($Role == 1) {
        $('[data-toggle="#Bilingkasir"]').addClass('menu-open');
    } else {
        $('[data-toggle="#Applikasi"]').addClass('menu-open');
    }
    $('a[href="' + location + '"]').addClass('active');

    if (!Kasir) {
        $('#txtNewPin').focus();
    } else {
        $('#txtPin').focus();
    }

    $('#post_initial_kasir').submit(function(e) {
        e.preventDefault();
        if ($('#txtNewPin').val().length < 3) {
            $.alert_swal_info('Initial Kasir', "Pin Jangan Kurang 3 Digit", 'warning');
        } else {
            if ($('#post_initial_kasir').valid()) {
                $('.load-initial').append(
                    '<div class="overlay"><i class="fas fa-2x fa-sync-alt fa-spin"></i></div>');
                $.ajax({
                    url: "<?php echo site_url('kasir/initial/k_initial_kasir');?>",
                    type: "post",
                    dataType: "JSON",
                    data: {
                        id: selectedId,
                        tanggal: $date.substr(0, 10),
                        shift: $("#cmbShift option:selected").val(),
                        user_id: $User,
                        jam_start: $date.substr(10, 15),
                        pin: $.md5($("#txtNewPin").val()),
                        modal: Globalize.parseInt($("#txtModal").val())
                    },
                    success: function(msg) {
                        if (msg.error == false) {
                            $('.load-initial').find('.overlay').remove();
                            $('#post_initial_kasir')[0].reset();
                            window.location.reload('Kasir');
                        } else {
                            $.alert_swal_info('Initial Kasir', msg.message, 'warning');
                            $('#post_initial_kasir')[0].reset();
                            $('.load-initial').find('.overlay').remove();
                            $("#txtNewPin").focus();
                        }
                    }
                });
            }
        }
    });
    $('#post_cekin_kasir').submit(function(e) {
        e.preventDefault();
        if ($('#txtPin').val().length < 3) {
            $.alert_swal_info('Initial Kasir', "Pin Jangan Kurang 3 Digit", 'warning');
        } else {
            if ($('#post_cekin_kasir').valid()) {
                $('.load-initial').append(
                    '<div class="overlay"><i class="fas fa-2x fa-sync-alt fa-spin"></i></div>');
                $.ajax({
                    url: "<?php echo site_url('kasir/cek_initial/k_initial_kasir');?>",
                    type: "post",
                    dataType: "JSON",
                    data: {
                        id: Kasir,
                        user_id: $User,
                        tanggal: $date.substr(0, 10),
                        pin: $.md5($("#txtPin").val())
                    },
                    success: function(msg) {
                        if (msg.error == false) {
                            $('#post_cekin_kasir')[0].reset();
                            window.location.href =
                                "<?= site_url('kasir/page/user?mod='.base64_encode("admin-menu-kasir-html-h_kasir_transaksi").'&initial=')?>" +
                                $.base64.encode(msg.id);
                        } else {
                            if (msg.code == 100) {
                                $.alert_swal('Initial Kasir', msg.message, 'warning');
                            } else if (msg.code == 101) {
                                $.alert_swal_info('Initial Kasir', msg.message, 'warning');
                                $('.load-initial').find('.overlay').remove();
                            } else {
                                $.alert_swal_info('Initial Kasir', msg.message, 'warning');
                                $('.load-initial').find('.overlay').remove();
                            }

                        }
                    }
                });
            }
        }
    });

    $("#btn-clear-closing").button().click(function() {
        $('.pass-closing').show();
        $('#post_closing_kasir').hide();
        $('#lbl-oop').html("");
        $('#lbl-shift').html("");
        $('#lbl-jam-in').html("");
        $('#txtPinClosing').val("");
        $('#txtPinClosing').focus();
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
                    id: Kasir,
                    user_id: $User,
                    tanggal: $date.substr(0, 10),
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
                    tanggal: $date.substr(0, 10),
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
            allowOutsideClick: false,
            allowEscapeKey: false,
        }).then((result) => {
            if (result.value) {
                $('#post_closing_kasir')[0].reset();
                $('.load-initial').find('.overlay').remove();
                $("#btn-clear-closing").button().click();
                window.open(
                    "<?= site_url('Kasir/print_closing'); ?>?id=" + $id, 'Struk Closing',
                    'width=390,height=670');
            }
        })
    }

    $.format_text = function(element) {
        $(element).keyup(function(event) {
            if ($(this).val().length > 0) {
                if (!isNaN(Globalize.parseInt($(element).val()))) {
                    $(this).val(Globalize.format(Math.abs(Globalize.parseInt($(this).val())),
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
                    $(this).val(Globalize.format(Math.abs(Globalize.parseInt($(this).val())),
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
                window.location.reload();
            }
        })
    }
});
</script>