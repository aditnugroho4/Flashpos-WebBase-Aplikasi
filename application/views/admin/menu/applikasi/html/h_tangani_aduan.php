<script>
$(document).ready(function() {
    $('.mn-1').addClass('bg-secondary');

    if ($roleName == "Admin" || $roleName == "Administrator") {
        $_pagination_get(0);
    } else {
        $_pagination_get($idUnit);
    }

    var timeline = $(".timeline");
    var status__aduan = $("#status__aduan");
    var history__aduan = $("#history__aduan");
    status__aduan.find('[data-card-widget="collapse"]').click();
    $("#lblUser_foto").attr("src", $foto);
    $("#lblUser_aduan").text($userName);
    $("#lblNomor").text("Nomor Aduan - : Kosong");
    $("#lblDate_in").text("Tanggal Aduan - : Kosong ");

    $.view_status = function(id) {
        $idAduan = id;
        timeline.empty();
        status__aduan.find('.card-title .fa-bell').attr('class', 'fas fa-spinner fa-spin');
        try {
            $.ajax({
                type: "POST",
                dataType: 'json',
                url: "<?= site_url('admin/get_json_data_aduan');?>",
                data: {
                    id: $idAduan
                },
                success: function(data) {
                    timeline.append('<div class="time-label">' +
                        ' <span class="bg-red" >' + data
                        .use_date.substr(0, 10) +
                        '</span></div>' +
                        ' <div><i class="fas fa-file-prescription bg-green"> </i>' +
                        '<div class="timeline-item">' +
                        '<span class="time"> <i class="fas fa-clock">' +
                        '</i> 5 mins ago</span>' +
                        '<h3 class="timeline-header no-border"><a href="#">' + data
                        .user_id.nama +
                        '</a>' +
                        ' MEMBUAT PENGADUAN BARU </h3></div></div>');
                    if (data.use_status == "K") {
                        timeline.append('<div class="time-label">' +
                            ' <span class="bg-blue" >' + data.use_date.substr(0,
                                10) +
                            '</span></div>' +
                            '<div>' +
                            '<i class="fas fa-envelope bg-info"></i>' +
                            '<div class="timeline-item">' +
                            '<span class="time"><i class="fas fa-clock"></i> ' + data
                            .tin_date.substr(11,
                                14) + '</span>' +
                            '<h3 class="timeline-header"><a href="#">(ADMIN) ' +
                            data.tin_user.nama +
                            '</a> ADUAN SUDAH DI KONFIRMASI</h3>' +
                            '<div class="timeline-body">' +
                            'Mohon diterima dan Di teruskan Untuk Penugasan Regu..' +
                            '<p>Instruksi : ' + data.tin_instruksi + '</br>' +
                            'Diteruskan : ' + data.tin_diteruskan + '</br>' +
                            'Catatan : ' + data.tin_catatan + '</br>' +
                            '</p>' +
                            '</div>' +
                            '<div class="timeline-footer">' +
                            '<button type="button" class="btn btn-info btn-sm">Print</button>' +
                            '</div>' +
                            '</div>' +
                            '</div>');
                    }
                    if ($roleName == "Support" || $roleName == "Administrator" ||
                        $roleName ==
                        "Admin") {
                        if (data.tin_status == null) {
                            timeline.append('<div>' +
                                '<i class="fas fa-user-shield bg-yellow"></i>' +
                                '<div class="timeline-item">' +
                                '<h3 class="timeline-header"><a href="#">(SISTEM OTOMATIS) ' +
                                'TIM SUPPORT </a> SEGERA TERIMA ADUAN</h3>' +
                                '<div class="timeline-body">' +
                                'Lengkapi data Penugasan Regu untuk selesaikan pengaduan..' +
                                '</div>' +
                                '<div class="timeline-footer">' +
                                '<button type="button" onclick="$.update_tindakan(\'' +
                                data
                                .tin_id +
                                '\')" class="btn btn-warning btn-sm">Action</button>' +
                                '</div>' +
                                '</div>' +
                                '</div>');
                        }
                        if (data.tin_status == "P") {
                            timeline.append('<div>' +
                                '<i class="fas fa-hammer bg-yellow"></i>' +
                                '<div class="timeline-item">' +
                                '<h3 class="timeline-header"><a href="#">(' +
                                $roleName +
                                ') ' +
                                $userName + '</a> PROSESS PEKERJAAN</h3>' +
                                '<div class="timeline-body">' +
                                'Rincian Pekerjaan' +
                                '<p>NOSPK : ' + data.don_spk + '</br>' +
                                'TIM REGU : ' + data.don_regu + '</br>' +
                                'PERLENGKAPAN : ' + data.don_material + '</br>' +
                                '</p>' +
                                '</div>' +
                                '<div class="timeline-footer">' +
                                '<button type="button" class="btn btn-info btn-sm">Print</button>' +
                                '</div>' +
                                '</div>' +
                                '</div>');
                        }
                    } else {
                        timeline.append('<div class="time-label">' +
                            '<span class = "bg-blue" >' + data.use_date.substr(0, 10) +
                            '</span>' +
                            '</div>' +
                            '<div>' +
                            '<i class="fas fa-user bg-yellow"></i>' +
                            '<div class="timeline-item">' +
                            '<span class="time"><i class="fas fa-clock"></i> 5 mins ago</span>' +
                            '<h3 class="timeline-header no-border"><a href="#">' + data
                            .use_nama +
                            '</a> Sedang Menunggu Konfirmasi </h3>' +
                            '</div>' +
                            '</div>');
                    }
                    $noAduan = data.use_nomor;
                    $("#lblUser_aduan").text(data.user_id.nama);
                    $("#lblNomor").text("Nomor Aduan - " + data.use_nomor);
                    $("#lblDate_in").text("Tanggal Aduan - " + data.use_date);
                    $("#lblLokasi").text(data.use_lokasi);
                    $("#lblPengaduan").text(data.use_jenis);
                    $("#lblPerbaikan").text(data.use_perbaikan);
                    $("#lblDeskripsi").text(data.use_deskripsi);
                    if (data.user_id.foto) {
                        $foto = "<?= base_url("asset/images/user")?>/" + data.user_id.foto;
                    } else {
                        $foto = "<?= base_url('asset/images/user/avatar5.png')?>";
                    }
                    $("#lblUser_foto").attr("src", $foto);
                    $("#lblFoto").attr("src", "<?= base_url()?>" + data.use_foto);
                    history__aduan.find('[data-card-widget="collapse"]').click();
                    status__aduan.find('[data-card-widget="collapse"]').click();
                    status__aduan.find('.fa-spin').attr('class', 'far fa-bell');
                }
            });
        } catch (ex) {
            alert(ex);
        }
    }
    $.update_tindakan = function($nomor) {
        $idAdmin = $nomor;
        $('#dlg-ambil-penugasan').modal('show');
    };
    $('#ambil_penugasan').submit(function(e) {
        e.preventDefault();
        if ($('#ambil_penugasan').valid()) {
            $('.loading').append(
                '<div class="overlay text-center"><i class="fas fa-2x fa-sync-alt fa-spin"></i></div>'
            );
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "<?php echo site_url('admin/create/t_data_perbaikan'); ?>",
                data: {
                    nospk: $noAduan + $date.substr(0, 7),
                    timregu: $("#txtAct_Regu").val(),
                    kelengkapan: $("#txtAct_Perlengkapan").val(),
                    tglperbaikan: $date,
                    prosess_id: $idAdmin,
                    waktu: $("#txtMulai").val() + " - " + $("#txtSelesai").val(),
                    unit_id: $idUnit,
                    user_id: $user,
                },
                success: function(data) {
                    if (data.error == false) {
                        $('.loading').find('.overlay').remove();
                        $('#ambil_penugasan')[0].reset();
                        alert(data.message);
                        $('#dlg-ambil-penugasan').modal('hide');
                        $.view_status($idAduan);
                        $.update_status('t_data_pengaduan', 'status', $idAduan, 'P');
                        $.update_status('t_data_prosess', 'status', $idAdmin, 'P');
                        window.location.reload();
                    } else {
                        $alert(data.message);
                        $('.loading').find('.overlay').remove();
                        $('#ambil_penugasan')[0].reset();
                        $('#dlg-ambil-penugasan').modal('hide');
                    }
                }
            });
        }
    });
    $.update_status = function($tables, $filds, $selectedId, $values) {
        $.ajax({
            url: "<?php echo site_url('admin/aktive'); ?>/" + $tables + "/" + $filds +
                "/" +
                $selectedId + "/" + $values,
            success: function(data) {
                $("#tblData").dataTable().fnDraw();
                $("#dlgDecision").modal("hide");
            }
        });
    }
});

function $_pagination_get(id = null) {
    $url = "";
    if (id == 0) {
        $url = '<?= site_url('admin/json_load_data'); ?>?table=t_data_prosess';
    } else {
        $url = '<?= site_url('admin/json_load_data'); ?>?table=t_data_prosess&ctgr=unit_id' + '&id=' + id;
    }
    $('#pagination').pagination({
        dataSource: $url,
        locator: 'data',
        pageSize: 10,
        pageRange: null,
        showPageNumbers: true,
        totalNumberLocator: function(response) {
            // you can return totalNumber by analyzing response content
            if (response) {
                return Math.floor(response.total);
            }
        },
        ajax: {
            beforeSend: function(data) {
                $('.load__overlay').append(
                    '<div class="overlay"><i class="fas fa-2x fa-sync-alt fa-spin"></i></div>'
                );
            }
        },
        callback: function(data, pagination) {
            var html = Templating(data);
            $('#todo-list_1').html(html);
            var pagebar = $('#pagination');
            pagebar.find('.paginationjs-pages').attr('class', 'card-tools float-right');
            pagebar.find('ul').addClass('pagination pagination-sm');
            pagebar.find('li').addClass('page-item');
            pagebar.find('a').addClass('page-link');
            $('.load__overlay').find('.overlay').remove();
        }
    });
};

function Templating(data) {
    var $html = '';
    var status = '';
    for (var i = 0, len = data.length; i < len; i++) {
        var time = '00:00:00';
        if (data[i].items.date != null) {
            time = data[i].items.date.substr(0, 10);
        }
        if (data[i].items.status == null) {
            status =
                '<small class="btn btn-xs bg-info bg-gradient"><i class="far fa-clock"></i> Ambil Penugasan </small>';
            $html += '<li>' +
                '<div class="row">' +
                '<div class="col-xs-12 col-md-6">' +
                '<i class="fas fa-ellipsis-v"></i>' +
                '<i class="fas fa-ellipsis-v"></i>' +
                '<span class="text">' +
                time + ' ' + data[i].items.diteruskan + '</span>' +
                '</div>' +
                '<div class="col-xs-12 col-md-6">' +
                '<span class="float-right" onclick="$.view_status(' +
                data[i].items.aduan_id +
                ');">' + status +
                '</span></div></div>' +
                '</li>';
        }

    }
    return $html;
};
</script>
<div id="history__aduan" class="card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="far fa-clock"></i>
            DATA PENUGASAN
        </h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                title="Collapse">
                <i class="fas fa-minus"></i></button>
        </div>
    </div>
    <div class="card-body">
        <ul class="todo-list" id="todo-list_1" data-widget="todo-list">
            <li>
                <div class="row">
                    <div class="col-xs-12 col-md-6">
                        <i class="fas fa-ellipsis-v"></i>
                        <i class="fas fa-ellipsis-v"></i>
                        <span class="text">Belum Ada Penugasan..</span>
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <span class="float-right" onclick="">
                            <small class="btn btn-sm bg-green bg-gradient"><i class="far fa-clock"></i> Kosong</small>
                        </span>
                    </div>
                </div>
            </li>
        </ul>
    </div>
    <div class="card-footer">
        <div id="pagination"></div>
    </div>
</div>

<div id="status__aduan" class="card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="far fa-bell"></i>
            STATUS PEKERJAAN
        </h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                title="Collapse">
                <i class="fas fa-minus"></i></button>
        </div>
    </div>
    <div class="card-body">
        <div id="rincian__aduan" class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-list"></i>
                    RINCIAN ADUAN
                </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                        <i class="fas fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="active tab-pane">
                        <div class="post">
                            <div class="user-block">
                                <img id="lblUser_foto" class="img-circle img-bordered-sm" src="" alt="user image">
                                <span class="username">
                                    <a id="lblUser_aduan" href="#">NAN</a>
                                </span>
                                <span id="lblNomor" class="description">NAN</span>
                                <span id="lblDate_in" class="description">NAN</span>
                            </div>
                            <div class="form-group">
                                <label fot="lblLokasi">LOKASI</label>
                            </div>
                            <p id="lblLokasi">
                            </p>
                        </div>
                        <div class="post">
                            <div class="form-group">
                                <label for="lblPengaduan">PENGADUAN</label>
                            </div>
                            <p id="lblPengaduan">
                            </p>
                        </div>
                        <div class="post">
                            <div class="form-group">
                                <label for="lblPerbaikan">PERBAIKAN</label>
                            </div>
                            <p id="lblPerbaikan">
                            </p>
                        </div>
                        <div class="post">
                            <div class="form-group">
                                <label for="lblDeskripsi">DESKRIPSI</label>
                            </div>
                            <p id="lblDeskripsi">
                            </p>
                        </div>
                        <div class="post">
                            <div class="form-group">
                                <label for="lblFoto">FOTO</label>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <img id="lblFoto" class="img-fluid"
                                        src="<?= base_url('asset/admin/dist/img')?>/noimages.png" alt="Photo">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="timeline"></div>
        </div>
    </div>
</div>

<div class="modal fade show" id="dlg-ambil-penugasan" aria-modal="true" backdrop-static="true">
    <div class="modal-dialog loading">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Lengkapi Data</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="ambil_penugasan">
                <div class="modal-body">
                    <p><i class="fas fa-exclamation-triangle"></i> Lengkapi dengan benar Tindak Lanjut Pengaduan..</p>
                    <div class="form-group">
                        <label for="txtAct_UP">UP</label>
                        <input type="text" id="txtAct_UP" name="UP" placeholder="ex.: Divisi Oprasional"
                            class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="txtAct_Regu">Regu Yang Bertugas</label>
                        <textarea type="text" id="txtAct_Regu" onfocus="$.queryLength(this,'#cnt-dt');" rows="2"
                            cols="50" maxlength="500" class="form-control" required></textarea>
                        <span class="float-right"><i id="cnt-dt">0</i> : 500 characters</span>
                    </div>
                    <div class="form-group">
                        <label for="txtAct_Perlengkapan">Perlengkapan</label>
                        <textarea type="text" id="txtAct_Perlengkapan" onfocus="$.queryLength(this,'#cnt-ct');" rows="4"
                            cols="50" maxlength="155" class="form-control" required></textarea>
                        <span class="float-right"><i id="cnt-ct">0</i> : 1000 characters</span>
                    </div>
                    <div class="form-group">
                        <label for="txtAct_Mulai">"Untuk Tanggal Mengikuti Saat Pengambilan Penugasan"</label>
                        <div class="row">
                            <div class="col-lg-6">
                                <label for="txtAct_Mulai">JAM MULAI</label>
                                <div class="input-group clockpicker pull-center" data-placement="left" data-align="top"
                                    data-autoclose="true">
                                    <div class="input-group-append input-group-addon">
                                        <div data-placement="top" data-toggle="tooltip" title="Jam Pekerjaan"
                                            class="btn btn-primary"><span class="icon-clock"></span></div>
                                    </div>
                                    <input type="time" id="txtMulai" placeholder="Jam Mulai Pekerjaan"
                                        class="form-control" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label for="txtAct_Selesai">JAM SELESAI</label>
                                <div class="input-group clockpicker pull-center" data-placement="left" data-align="top"
                                    data-autoclose="true">
                                    <div class="input-group-append input-group-addon">
                                        <div data-placement="top" data-toggle="tooltip" title="Jam Pekerjaan"
                                            class="btn btn-primary"><span class="icon-clock"></span></div>
                                    </div>
                                    <input type="time" id="txtSelesai" placeholder="Jam Selesai Pekerjaan"
                                        class="form-control" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="submit" class="btn btn-primary "><i class="fas fa-paper-plane"></i>
                        Update</button>
                </div>
            </form>
        </div>
    </div>
</div>