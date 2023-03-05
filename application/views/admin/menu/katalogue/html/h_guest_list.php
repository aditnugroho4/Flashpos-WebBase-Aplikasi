<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<script src="<?= base_url(); ?>asset/admin/plugins/globalize/cultures/globalize.culture.id-ID.js"></script>
<script type="text/javascript">
String.prototype.replaceAll = function(str1, str2, ignore) {
    return this.replace(new RegExp(str1.replace(/([\/\,\!\\\^\$\{\}\[\]\(\)\.\*\+\?\|\<\>\-\&])/g, "\\$&"), (
        ignore ? "gi" : "g")), (typeof(str2) == "string") ? str2.replace(/\$/g, "$$$$") : str2);
};
var htmlx = '';
var selectedId;
var eleFocus;
var $date = "<?php echo R::isoDateTime(); ?>";
var $User = "<?php echo $user->id;?>";
var $Role = "<?php echo $role->id;?>";
var idSelected = false;
var idProvinsi = false;
var idKota = false;
var idKecamatan = false;
var idKelurahan = false;
$(document).ready(function() {
    Globalize.culture("id-ID");
    if ($Role == 1) {
        $('[data-toggle="#Katalogue"]').addClass('menu-open');
    } else if ($Role == 2) {
        $('[data-toggle="#Applikasi"]').addClass('menu-open');
    } else {
        $('[data-toggle="#Applikasi"]').addClass('menu-open');
    }
    $('a[href="' + location + '"]').addClass('active');

    $('#add_data_sosial')[0].reset();
    get_data_provinsi("#cmbProvinsi");
    $("#txtNik").focus();
    selectedId = false;
    $auto_number('b_customer_list', 4, '#txtKode');
    $("#txtTglLahir,#txtTglAcara").datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        yearRange: '1920:2050'
    });
    $("#txtNik").keypress(function(event) {
        if (event.which == 13) {
            if ($(this).val().length > 0) {

                $("#txtNPWP").focus();
            } else {
                $(this).focus();
            }
        }
    });
    $("#txtNPWP").keypress(function(event) {
        if (event.which == 13) {
            if ($(this).val().length > 0) {

                $("#txtNama").focus();
            } else {
                $(this).focus();
            }
        }
    });
    $("#txtNama").keypress(function(event) {
        if (event.which == 13) {
            if ($(this).val().length > 0) {

                $("#cmbKelamin").focus();
            } else {
                $(this).focus();
            }
        }
    });
    $("#cmbKelamin").change(function() {
        $("#txtTmptLahir").focus();
    });
    $("#txtTmptLahir").keypress(function(event) {
        if (event.which == 13) {
            if ($(this).val().length > 0) {

                $("#txtTglLahir").focus();
            } else {
                $(this).focus();
            }
        }
    });
    $("#cmbProvinsi").change(function() {
        $("#cmbKota").empty();
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "<?php echo site_url('admin/multi_select');?>?table=m_kota&select=idprovinsi&id=" +
                $(this).val(),
            success: function(data) {
                if (data == '') {
                    $("#cmbKota").append("<option value=''>-- No Data --</option>");
                } else {
                    $("#cmbKota").append("<option value=''>-- Pilih --</option>");
                    for (var i = 0; i < data.length; i++) {

                        $("#cmbKota").append("<option value='" + data[i].id + "'>" + data[i]
                            .name + "</option>");
                    }
                }
                $("#cmbKota").focus();

            }
        });
    });
    $("#cmbKota").change(function() {
        $("#cmbKecamatan").empty();
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "<?php echo site_url('admin/multi_select');?>?table=m_kecamatan&select=idkota&id=" +
                $(this).val(),
            success: function(data) {
                if (data == '') {
                    $("#cmbKecamatan").append("<option value=''>-- No Data --</option>");
                } else {
                    $("#cmbKecamatan").append("<option value=''>-- Pilih --</option>");
                    for (var i = 0; i < data.length; i++) {

                        $("#cmbKecamatan").append("<option value='" + data[i].id + "'>" +
                            data[i]
                            .name + "</option>");
                    }
                }
                $("#cmbKecamatan").focus();

            }
        });
    });
    $("#cmbKecamatan").change(function() {
        $("#cmbKelurahan").empty();
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "<?php echo site_url('admin/multi_select');?>?table=m_kelurahan&select=idkecamatan&id=" +
                $(this).val(),
            success: function(data) {
                if (data == '') {
                    $("#cmbKelurahan").append("<option value=''>-- No Data --</option>");
                } else {
                    $("#cmbKelurahan").append("<option value=''>-- Pilih --</option>");
                    for (var i = 0; i < data.length; i++) {

                        $("#cmbKelurahan").append("<option value='" + data[i].id + "'>" +
                            data[i].name + "</option>");
                    }
                }
                $("#cmbKelurahan").focus();

            }
        });
    });
    $("#cmbKelurahan").change(function() {
        $('#txtEmail').focus();
    });
    $("#txtEmail").keypress(function(event) {
        if (event.which == 13) {
            if ($(this).val().length > 0) {

                $("#txtContact").focus();
            } else {
                $(this).focus();
            }
        }
    });
    $("#add_data_sosial").submit(function(e) {
        e.preventDefault();
        if ($('#add_data_sosial').valid()) {
            $('.loadding').append(
                '<div class="overlay"><i class="fas fa-2x fa-sync-alt fa-spin"></i></div>');
            $auto_number('b_customer_list', 4, '#txtKode');
            $.ajax({
                type: "POST",
                dataType: 'json',
                url: "<?php echo site_url('admin/create/b_customer_list'); ?>",
                data: {
                    kode: $("#txtKode").val(),
                    nik: $("#txtNik").val(),
                    name: $("#txtNama").val(),
                    alamat: $("#txtAlamat").val(),
                    jnsklmn: $("#cmbKelamin option:selected").val(),
                    tmptlahir: $("#txtTmptLahir").val(),
                    tgllahir: $("#txtTglLahir").val(),
                    event_date: $("#txtTglAcara").val(),
                    provinsi_id: $("#cmbProvinsi option:selected").val(),
                    kota_id: $("#cmbKota option:selected").val(),
                    kecamatan_id: $("#cmbKecamatan option:selected").val(),
                    kelurahan_id: $("#cmbKelurahan option:selected").val(),
                    email: $("#txtEmail").val(),
                    instagram: $("#txtInstagram").val(),
                    contact: $("#txtContact").val(),
                    date: $date
                },
                success: function(msg) {
                    if (msg.error == false) {
                        $('.loadding').find('.overlay').remove();
                        $('#add_data_sosial')[0].reset();
                        $.alert_swal('Data Sosial', msg
                            .message, 'success');
                    } else {
                        $('.loadding').find('.overlay').remove();
                        $.alert_swal_info('Data Sosial', msg
                            .message, 'warning');
                    }
                }
            });
        }
    });
    $("#btn-batal-simpan").button().click(function() {
        $('#add_data_sosial')[0].reset();
        get_data_provinsi("#cmbProvinsi");
        $auto_number('b_customer_list', 4, '#txtKode');
        $("#txtNik").focus();
        selectedId = false;
    });

    function get_data_provinsi(tag) {
        $(tag).empty();
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "<?php echo site_url('admin/multi_select');?>?table=m_provinsi",
            success: function(data) {
                if (data == '') {
                    $(tag).append("<option value=''> -- No Result -- </option>");
                } else {
                    $(tag).append(
                        "<option value=''> -- Silahkan Pilih -- </option>");
                    for (var i = 0; i < data.length; i++) {
                        $(tag).append("<option value='" + data[i].id + "'>" +
                            data[i].name + "</option>");
                    }
                    if (idSelected != false) {
                        $(tag).val(idSelected);
                        $(tag).change();
                    }
                }
            }
        });
    }
    $.get_data_mix = function(tag, table, selectd, id) {
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "<?php echo site_url('admin/multi_select');?>?table=" + table + "&select=" +
                selectd + "&id=" + id,
            success: function(data) {
                $(tag).empty();
                if (data == '') {
                    $(tag).append("<option value=''> -- No Result -- </option>");
                } else {
                    $(tag).append(
                        "<option value=''> -- Silahkan Pilih -- </option>");
                    for (var i = 0; i < data.length; i++) {
                        $(tag).append("<option value='" + data[i].id + "'>" +
                            data[i].name + "</option>");
                    }
                    if (idSelected != false) {
                        $(tag).val(idSelected);
                        $(tag).change();
                    }
                }
            }
        });
        return id;
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

    function $auto_number($tables, $length, $tag) {
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "<?php echo site_url('admin/autonumber');?>",
            data: {
                tables: $tables,
                length: $length
            },
            success: function(msg) {
                $($tag).val(msg);
            }
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
});
</script>
<section class="content-header">
    <div class="container-fluid">
        <!-- Breadcrumb -->
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>GUSET LIST</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url();?>">Home</a></li>
                    <li class="breadcrumb-item">Guset List</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-brown"><i class="fas fa-warehouse"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Customer Baru</span>
                        <span class="info-box-number"><?= R::count('k_items_inventory')?></span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-brown"><i class="fas fa-shipping-fast"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Customer Booking</span>
                        <span class="info-box-number"><?= R::count('k_items_inventory')?></span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-brown"><i class="fas fa-dolly"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Event</span>
                        <span class="info-box-number"><?= R::count('k_items_inventory')?></span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-brown"><i class="fas fa-hard-hat"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Selesai</span>
                        <span class="info-box-number"><?= R::count('k_items_inventory')?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="container">
        <div class="card card-outline card-brown">
            <div class="card-header">
                <h3 class="card-title col-lg-4 col-sm-12 mb-2">DATA CUSTOMER</h3>
            </div>
            <div class="card-body">
                <form id="add_data_sosial">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label class="col-form-label">Id Customer</label>
                                            <div class="input-group">
                                                <input type="text" id="txtKode" disabled="disabled" class="form-control"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="col-form-label">Tgl Acara</label>
                                            <div class="input-group">
                                                <input type="text" id="txtTglAcara" Placeholder="contoh : 1989-25-09"
                                                    maxlength="10" class="form-control" required>
                                                <span class="input-group-append">
                                                    <button type="button" class="btn btn-dark btn-flat btn-views2"><i
                                                            class="fas fa-calendar"></i></button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>No. KTP</label>
                                    <input type="text" id="txtNik" maxlength="16" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" id="txtNama" maxlength="30" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Jenis Kelamin</label>
                                    <select id="cmbKelamin" class="form-control" required>
                                        <option value="">-- Pilih --</option>
                                        <option value="L">Laki - Laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label class="col-form-label">Tempat Lahir</label>
                                            <div class="input-group">
                                                <input type="text" id="txtTmptLahir" maxlength="30" class="form-control"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="col-form-label">Tgl Lahir</label>
                                            <div class="input-group">
                                                <input type="text" id="txtTglLahir" Placeholder="contoh : 1989-25-09"
                                                    maxlength="10" class="form-control" required>
                                                <span class="input-group-append">
                                                    <button type="button" class="btn btn-dark btn-flat btn-views2"><i
                                                            class="fas fa-calendar"></i></button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <textarea type="text" id="txtAlamat" class="form-control" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Provinsi</label>
                                    <select id="cmbProvinsi" class="form-control" required></select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Kabupaten / Kota</label>
                                    <select id="cmbKota" class="form-control" required></select>
                                </div>
                                <div class="form-group">
                                    <label>Kecamatan</label>
                                    <select id="cmbKecamatan" class="form-control" required></select>
                                </div>
                                <div class="form-group">
                                    <label>Kelurahan</label>
                                    <select id="cmbKelurahan" class="form-control" required></select>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" id="txtEmail" maxlength="100" class="form-control" >
                                </div>
                                <div class="form-group">
                                    <label>Instagram</label>
                                    <input type="text" id="txtInstagram" maxlength="100" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>No. Contact</label>
                                    <input type="text" id="txtContact" maxlength="16" class="form-control" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="col-lg-12 ">
                            <button type="submit" class="btn btn-brown float-right">Simpan</button>
                            <button type="button" id="btn-batal-simpan"
                                class="btn btn-brown mr-1 float-right">Batal</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>