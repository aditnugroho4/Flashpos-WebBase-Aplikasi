<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<script type="text/javascript">
String.prototype.replaceAll = function(str1, str2, ignore) {
    return this.replace(new RegExp(str1.replace(/([\/\,\!\\\^\$\{\}\[\]\(\)\.\*\+\?\|\<\>\-\&])/g, "\\$&"), (
        ignore ? "gi" : "g")), (typeof(str2) == "string") ? str2.replace(/\$/g, "$$$$") : str2);
};
var selectedId;
var active;
var $date = "<?php echo R::isoDateTime(); ?>";
var $User = "<?php echo $user->id;?>";
var $Role = "<?php echo $role->id;?>";
$(document).ready(function() {
    if ($Role == 1) {
        $('[data-toggle="#Katalogue"]').addClass('menu-open');
    } else if ($Role == 2) {
        $('[data-toggle="#DataMaster"]').addClass('menu-open');
    } else {
        $('[data-toggle="#MainMenu"]').addClass('menu-open');
    }
    $('a[href="' + location + '"]').addClass('active');

    var timeline = $(".timeline");
    user_verif();

    function user_verif() {
        timeline.empty();
        try {
            $.ajax({
                type: "POST",
                dataType: 'json',
                url: "<?= site_url('admin/user_verifikasi');?>",
                data: {
                    id: "<?= $user->id;?>"
                },
                success: function(data) {
                    timeline.append('<div class="time-label">' +
                        ' <span class = "bg-red" >' + data
                        .use_date.substr(0, 10) +
                        '</span></div>' +
                        ' <div><i class="fas fa-file-contract bg-green"> </i>' +
                        '<div class="timeline-item">' +
                        '<span class="time"> <i class="fas fa-clock">' +
                        '</i> 5 mins ago</span>' +
                        '<h3 class="timeline-header no-border"><a href="#">' + data
                        .use_nama +
                        '</a>' +
                        ' Berhasil Melakukan Registrasi </h3></div></div>');
                    if (data.val_status == false) {
                        timeline.append('<div>' +
                            '<i class="fas fa-envelope bg-yellow"></i>' +
                            '<div class="timeline-item">' +
                            '<span class="time"><i class="fas fa-clock"></i> 12:05</span>' +
                            '<h3 class="timeline-header"><a href="#">Support Team</a> Gagal Mengirim Email</h3>' +
                            '<div class="timeline-body">' +
                            'Support Team Flashpos Gagal mengirim Email Verifikasi ke alamat email (' +
                            data.use_email.substr(0, 10) +
                            ') untuk mengecek status kepegawain' +
                            '</div>' +
                            '<div class="timeline-footer">' +
                            '<button type="button" id="btn_send_ulang" onclick="$.send_ulang();" class="btn btn-info btn-sm">Kirim Ulang</button>' +
                            '</div>' +
                            '</div>' +
                            '</div>');
                    } else {
                        timeline.append('<div class="time-label">' +
                            '<span class="bg-blue">' + data.val_date.substr(0, 10) + '</span>' +
                            '</div><div>' +
                            '<i class="fas fa-envelope bg-blue"></i>' +
                            '<div class="timeline-item">' +
                            '<span class="time"><i class="fas fa-clock"></i> 12:05</span>' +
                            '<h3 class="timeline-header"><a href="#">Support Team</a> Telah Mengirim Pesan</h3>' +

                            '<div class="timeline-body">' +
                            'Support Team Flashpos Telah mengirim Email Verifikasi ke alamat email (' +
                            data.val_email + ') untuk mengecek status kepegawain ' +
                            '</div>' +
                            '</div>' +
                            '</div>');
                        if (data.val_status == null) {
                            timeline.append('<div class="time-label">' +
                                '<span class = "bg-blue" >' + data.val_date.substr(0, 10) +
                                '</span>' +
                                '</div>' +
                                '<div>' +
                                '<i class="fas fa-user bg-yellow"></i>' +
                                '<div class="timeline-item">' +
                                '<span class="time"><i class="fas fa-clock"></i> 5 mins ago</span>' +
                                '<h3 class="timeline-header no-border"><a href="#">' + data
                                .use_nama +
                                '</a> Belum Melakukan Verifikasi Email </h3>' +
                                '</div>' +
                                '</div>');
                        } else {
                            timeline.append('<div class="time-label">' +
                                '<span class = "bg-green" >' + data.val_updtime.substr(0, 10) +
                                '</span>' +
                                '</div>' +
                                '<div>' +
                                '<i class="fas fa-user bg-green"></i>' +
                                '<div class="timeline-item">' +
                                '<span class="time"><i class="fas fa-clock"></i> 5 mins ago</span>' +
                                '<h3 class="timeline-header no-border"><a href="#">' + data
                                .use_nama +
                                '</a> Telah Melakukan Verifikasi Email </h3>' +
                                '</div>' +
                                '</div>');
                            if (data.use_ver == null || data.use_employ == null) {
                                timeline.append('<div class="time-label">' +
                                    '<span class="bg-yellow">' + data.use_updtime.substr(0,
                                        10) +
                                    '</span>' +
                                    '</div>' +
                                    '<div>' +
                                    '<i class="fas fa-user-lock bg-yellow"></i>' +
                                    '<div class="timeline-item">' +
                                    '<span class="time"><i class="fas fa-clock"></i> 27 mins ago</span>' +
                                    '<h3 class="timeline-header"><a href="#">Admin </a> Sedang Mevalidasi Kelengkapan Data Anda </h3>' +
                                    '<div class="timeline-body"> Bantu Kami Untuk Melakukan Validasi data dengan melengkapi data sosial anda tekan tombol berikut.' +
                                    '</div>' +
                                    '<div class="timeline-footer">' +
                                    '<a href="<?= site_url('admin/page/user?mod='.base64_encode('admin-menu-master-html-h_profile_user').'&role='.base64_encode($role->id));?>" class="btn btn-info btn-sm">Lengkapi Data</a>' +
                                    '</div>' +
                                    '</div>' +
                                    '</div>');
                            } else {
                                timeline.append('<div class="time-label">' +
                                    '<span class="bg-blue">' + data.use_updtime.substr(0,
                                        10) +
                                    '</span>' +
                                    '</div>' +
                                    '<div>' +
                                    '<i class="fas fa-user-shield bg-blue"></i>' +
                                    '<div class="timeline-item">' +
                                    '<span class="time"><i class="fas fa-clock"></i> 27 mins ago</span>' +
                                    '<h3 class="timeline-header"><a href="#">Admin </a> Account Anda sudah Lulus Verifikasi </h3>' +
                                    '<div class="timeline-body"> Terima Kasih Telah mengunakan Aksess Sistem informasi ini Semoga bermanfaat dan Gunakan Dengan Bijak.' +
                                    '</div>' +
                                    '</div>' +
                                    '</div>');

                            }
                        }
                    }
                }
            });
        } catch (ex) {
            alert(ex);
        }
    }

    $.send_ulang = function() {
        $('#SendMail').modal('show');
    };
    $("#btn-send-o").button().click(function() {
        $('.loading').append(
            '<div class="overlay text-center"><i class="fas fa-2x fa-sync-alt fa-spin"></i></div>'
        );
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "<?php echo site_url('admin/send_verifikasi'); ?>",
            data: {
                id: "<?= $user->id ?>",
                email: "<?= $user->email ?>",
                nama: "<?= $user->nama ?>",
                date: $date
            },
            success: function(data) {
                if (data.error == false) {
                    alert(data.message);
                    $('.loading').find('.overlay').remove();
                    $('#SendMail').modal('hide');
                    logout("<?= $user->id ?>");
                } else {
                    $alert(data.message);
                    $('.loading').find('.overlay').remove();
                    $('#SendMail').modal('hide');
                }
            }
        });
    });

    $("#btn-lengkap-posisi").button().click(function() {
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
                $("#cmbUnit").html(options);
                $("#dlg-posisi").modal("show");
            }
        });

    });
    $("#Send-lengkapi").button().click(function() {
        selectedId = "<?= $user->employ_id ?>";
        active = $("#cmbUnit option:selected").val();
        if (active) {
            $('.loading').append(
                '<div class="overlay text-center"><i class="fas fa-2x fa-sync-alt fa-spin"></i></div>'
            );
            $.ajax({
                type: "POST",
                dataType: 'json',
                url: "<?php echo site_url('admin/aktive/m_datapegawai/unit_id'); ?>/" +
                    selectedId +
                    "/" +
                    active,
                success: function(data) {
                    if (data.error == false) {
                        $.swalDefaultAlert("error: " + data.error + "<br> Code: " + data
                            .code +
                            " <br> message: " + data.message, 'success');
                        $('.loading').find('.overlay').remove();
                        $("#dlg-posisi").modal("hide");
                        location.reload();
                    } else {
                        $.swalDefaultAlert("error: " + data.error + "<br> Code: " + data
                            .code +
                            " <br> message: " + data.message, 'success');
                    }

                }
            });
        }
    });

    function logout($id) {
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "<?php echo site_url('login/logout?'); ?>end" + $.base64.encode(JSON.stringify(
                $id)),
            success: function(data) {
                if (data.error == false) {
                    location.reload('login');
                }
            }
        });
    }
    // alert //
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });

    $.swalDefaultAlert = function(label, icons) {
        Toast.fire({
            icon: icons,
            title: label
        })
    }
});
</script>