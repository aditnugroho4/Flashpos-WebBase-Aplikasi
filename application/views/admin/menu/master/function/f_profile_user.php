<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<script type="text/javascript">
String.prototype.replaceAll = function(str1, str2, ignore) {
    return this.replace(new RegExp(str1.replace(/([\/\,\!\\\^\$\{\}\[\]\(\)\.\*\+\?\|\<\>\-\&])/g, "\\$&"), (
        ignore ? "gi" : "g")), (typeof(str2) == "string") ? str2.replace(/\$/g, "$$$$") : str2);
};
var selectedId;
var idUser = "<?php echo $_GET['role']?>";
$(document).ready(function() {
    Globalize.culture("id-ID");
    selectedId = "<?php echo $user->employ_id;?>";
    $('.dropify').dropify({
        messages: {
            default: 'Kembali Ke asal..',
            replace: 'Ganti file Atau Gambar',
            remove: 'Hapus',
            error: 'Ada Kesalahan Saat Upload File atau gambar..!'
        }
    });
    $("#txtTglLahir,#txtTglMasuk").datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        yearRange: '1920:2050'
    });
    $('.edit-foto-profile').button().click(function() {
        $("#frm-edit-foto").modal("show");
    });
    $('#edit-foto-prof').submit(function(e) {
        e.preventDefault();
        if ($('#edit-foto-prof').valid()) {
            $('.load-ding').append(
                '<div class="overlay"><i class="fas fa-2x fa-sync-alt fa-spin"></i></div>');
            var confiq = {
                id: idUser,
                sizeH: 215,
                sizeW: 215,
                tbL: "m_user",
                path: "asset-images-user"
            };
            var fd = new FormData(document.getElementById("edit-foto-prof"));
            var parsing = $.base64.encode(JSON.stringify(confiq));
            parsing = parsing.replaceAll(".", "^");
            parsing = parsing.replaceAll("+", "-");
            parsing = parsing.replaceAll("/", "_");
            $.ajax({
                url: "<?php echo site_url('admin/edit_upload_foto');?>?data=" + parsing,
                type: "post",
                data: fd,
                dataType: 'json',
                processData: false,
                contentType: false,
                cache: false,
                async: false,
                success: function(data) {
                    if (data.error == false) {
                        $('.dropify-clear').click();
                        $("#edit-foto-prof")[0].reset();
                    } else {
                        $('.dropify-clear').click();
                        $("#edit-foto-prof")[0].reset();
                    }
                    $('.load-ding').find('.overlay').remove();
                }
            });
        }
    });
    $('#edit-data-prof').submit(function(e) {
        e.preventDefault();
        if ($('#edit-data-prof').valid()) {
            $('.load-prof').append(
                '<div class="overlay"><i class="fas fa-2x fa-sync-alt fa-spin"></i></div>');
            $.ajax({
                url: "<?php echo site_url('admin/update_user_profile');?>?id=" + idUser,
                type: "post",
                dataType: "JSON",
                data: {
                    username: $("#inputUserName").val(),
                    nama: $("#inputName").val(),
                    email: $("#inputEmail").val(),
                    whatsapp: $("#inputWhatsapp").val(),
                    alamat: $("#inputAlamat").val(),
                    pengalaman: $("#inputPengalaman").val(),
                    instagram: $("#inputInstagram").val(),
                    facebook: $("#inputFacebook").val(),
                    youtube: $("#inputYoutube").val(),
                    twitter: $("#inputTwitter").val(),
                    oldpassword: $("#inputPassword").val(),
                    newpassword: $("#inputNewPassword").val()
                },
                success: function(data) {
                    if (data.error == false) {
                        $('.load-prof').find('.overlay').remove();
                        location.reload();
                    } else {
                        $('.load-prof').find('.overlay').remove();
                    }
                }
            });
        }
    });
    $('#upd_data_pegawai').submit(function(e) {
        e.preventDefault();
        if ($('#upd_data_pegawai').valid()) {
            $('.load-prof').append(
                '<div class="overlay"><i class="fas fa-2x fa-sync-alt fa-spin"></i></div>');
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('admin/update/m_datapegawai'); ?>",
                data: {
                    id: selectedId,
                    nip: $("#txtNik").val(),
                    nama: $("#txtNama").val(),
                    kelamin: $("#cmbKelamin option:selected").val(),
                    tmptlahir: $("#txtTmptLahir").val(),
                    tgllahir: $("#txtTglLahir").val(),
                    pendidikan: $('#txtPendidikan').val(),
                    tmtdinas: $('#txtTglMasuk').val(),
                    golongan: $("#txtPangkat").val(),
                    jabatan: $('#txtJabatan').val(),
                    status: $('#cmbStatus option:selected').val(),
                    profesi: $('#cmbProfesi option:selected').val()
                },
                success: function(msg) {
                    if (data.error == false) {
                        $('.load-prof').find('.overlay').remove();
                        location.reload();
                    } else {
                        $('.load-prof').find('.overlay').remove();
                    }
                }
            });
        }
    });
    $("#cmbProfesi").change(function() {
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "<?php echo site_url('admin/multi_select');?>?table=m_unit",
            success: function(data) {
                if (data == '') {
                    var options = "<option value=''> -- No Result -- </option>";
                } else {
                    var options = "<option value=''> -- Silahkan Pilih -- </option>";
                    for (var i = 1; i < data.length; i++) {

                        options += "<option value='" + data[i].id + "'>" + data[i].name +
                            "</option>";
                    }
                }
                $("#cmbPosisi").html(options);

            }
        });
    });
    // control action button
    $(".btn-views1").button().click(function() {
        var isInput = $("#inputPassword").prop('type');
        if (isInput == 'text') {
            $("#inputPassword").attr('type', 'password');
        }
        if (isInput == 'password') {
            $("#inputPassword").attr('type', 'text');
        }

    });
    $(".btn-views2").button().click(function() {
        var isInput = $("#inputNewPassword").prop('type');
        if (isInput == 'text') {
            $("#inputNewPassword").attr('type', 'password');
        }
        if (isInput == 'password') {
            $("#inputNewPassword").attr('type', 'text');
        }
    });
});
</script>