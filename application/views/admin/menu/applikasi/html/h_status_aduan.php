<script>
$(document).ready(function() {
    $('.mn-2').addClass('bg-secondary');
    if ($roleName == "Admin" || $roleName == "Administrator") {
        $_pagination_get(0);
    } else {
        $_pagination_get($user);
    }

    var timeline = $(".timeline");
    var history__aduan = $("#history__aduan");
    var status__aduan = $("#status__aduan");


    status__aduan.find('[data-card-widget="collapse"]').click();

    $("#lblUser_foto").attr("src", $foto);
    $("#lblUser_aduan").text($userName);
    $("#lblNomor").text("Nomor Aduan - : Kosong");
    $("#lblDate_in").text("Tanggal Aduan - : Kosong ");

    $.view_status = function(id) {
        $idAduan = id;
        timeline.empty();
        status__aduan.find('.card-title .fa-bell').attr('class', 'fas fa-spinner fa-spin');
        // status__aduan.find('[data-card-widget="collapse"]').click();
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
                        ' <span class = "bg-red" >' + data
                        .use_date.substr(0, 10) +
                        '</span></div>' +
                        ' <div><i class="fas fa-file-prescription bg-green"> </i>' +
                        '<div class="timeline-item">' +
                        '<span class="time"> <i class="fas fa-clock">' +
                        '</i>' + data.use_date.substr(11, 5) + '</span>' +
                        '<h3 class="timeline-header no-border"><a href="#">(USER) ' + data
                        .user_id.nama +
                        '</a>' +
                        ' YANG MEMBUAT PENGADUAN</h3></div></div>');
                    if (data.use_status == null) {
                        timeline.append('<div>' +
                            '<i class="fas fa-envelope bg-yellow"></i>' +
                            '<div class="timeline-item">' +
                            '<span class="time"><i class="fas fa-clock"></i> ' +
                            data.use_date.substr(11, 5) + '</span>' +
                            '<h3 class="timeline-header"><a href="#">(SISTEM OTOMATIS)</a> KONFIRMASI</h3>' +
                            '<div class="timeline-body">' +
                            'Sedang Menunggu Konfirmasi.. </div>' +
                            '</div>' +
                            '</div>');
                    }
                    if (data.use_status == "K" || data.use_status == "P" || data.use_status ==
                        "S" || data.use_status ==
                        "Y") {
                        timeline.append('<div class="time-label">' +
                            ' <span class = "bg-info" >' + data
                            .use_date.substr(0, 10) +
                            '</span></div>' +
                            '<div>' +
                            '<i class="fas fa-user-shield bg-yellow"></i>' +
                            '<div class="timeline-item">' +
                            '<span class="time"><i class="fas fa-clock"></i> ' +
                            data.use_date.substr(11, 5) + '</span>' +
                            '<h3 class="timeline-header"><a href="#">(SISTEM OTOMATIS)</a> KONFIRMASI</h3>' +
                            '<div class="timeline-body">' +
                            'Pengaduan Telah Di Konfirmasi dan Diterima Oleh Admin..</div>' +
                            '</div>' +
                            '</div>');
                    }
                    if (data.tin_id) {
                        if (data.tin_status == null || data.tin_status == "Y") {
                            timeline.append('<div>' +
                                '<i class="far fa-paper-plane bg-info"></i>' +
                                '<div class="timeline-item">' +
                                '<span class="time"><i class="fas fa-clock"></i> ' +
                                data.tin_date.substr(11, 5) + '</span>' +
                                '<h3 class="timeline-header"><a href="#">(ADMIN) ' +
                                data
                                .tin_user.nama + '</a> PROSESS</h3>' +
                                '<div class="timeline-body">' +
                                'Aduan sedang di prosess dan akan di teruskan Untuk Penugasan Regu..' +
                                '<p>Instruksi : ' + data.tin_instruksi + '</br>' +
                                'Diteruskan : ' + data.tin_diteruskan + '</br>' +
                                'Catatan : ' + data.tin_catatan + '</br>' +
                                '</p>' +
                                '</div>' +
                                '</div>' +
                                '</div>');
                        }
                        if (data.tin_status == 'P') {
                            timeline.append('<div>' +
                                '<i class="fas fa-envelope bg-info"></i>' +
                                '<div class="timeline-item">' +
                                '<span class="time"><i class="fas fa-clock"></i> ' +
                                data.tin_date.substr(11, 5) + '</span>' +
                                '<h3 class="timeline-header"><a href="#">(ADMIN) ' + data
                                .tin_user.nama + '</a> PROSESS</h3>' +
                                '<div class="timeline-body">' +
                                'Aduan sedang di prosess dan akan di teruskan Untuk Penugasan Regu..' +
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
                    }
                    if (data.don_id) {
                        if (data.don_status == null) {
                            timeline.append('<div class="time-label">' +
                                ' <span class="bg-yellow" >' + data.don_date_start.substr(0,
                                    10) +
                                '</span></div>' + '<div>' +
                                '<i class="fas fa-user-shield bg-yellow"></i>' +
                                '<div class="timeline-item">' +
                                '<span class="time"><i class="fas fa-clock"></i> ' +
                                data.don_date_start.substr(11, 5) + '</span>' +
                                '<h3 class="timeline-header"><a href="#">(TIM SUPPORT) ' +
                                data.don_user['nama'] + '</a> TINDAK LANJUT</h3>' +
                                '<div class="timeline-body">' +
                                'Sudah dalam tindak lanjut Tim Regu </br> (' +
                                data
                                .don_regu +
                                ')</div>' +
                                '<div class="timeline-footer">' +
                                '</div>' +
                                '</div>' +
                                '</div>');
                        }
                        if (data.don_status == "Y") {
                            timeline.append('<div class="time-label">' +
                                ' <span class="bg-blue" >' + data.don_date_end.substr(
                                    0,
                                    10) +
                                '</span></div>' +
                                '<div>' +
                                '<i class="far fa-calendar-check bg-green"></i>' +
                                '<div class="timeline-item">' +
                                '<span class="time"><i class="fas fa-clock"></i> ' +
                                data.don_date_end.substr(11, 5) + '</span>' +
                                '<h3 class="timeline-header"><a href="#">(TIM SUPPORT) ' +
                                data.don_user.nama + '</a> TINDAK LANJUT</h3> ' +
                                '<div class="timeline-body">' +
                                'Tindak Lanjut Sudah Selesai Dengan Rincian' +
                                '</div>' +
                                '<div class="timeline-footer">' +
                                '<p>NOSPK : ' + data.don_spk + '</br>' +
                                'Tgl Perbaikan : ' + data.don_date_start + '</br>' +
                                'Tgl Selesai : ' + data.don_date_end + '</br>' +
                                'Tim Regu : ' + data.don_regu + '</br>' +
                                'Keterangan : ' + data.don_material + ' (' + data
                                .don_keterangan + ')</br>' +
                                '</p>' +
                                '<div class="row">' +
                                '<div class="col-lg-6">' +
                                '<label>Before Foto</label>' +
                                '<div class="col-lg-12">' +
                                '<img width="100%" height="250" src="<?= base_url()?>' +
                                data
                                .use_foto + '">' +
                                '</div>' +
                                '</div>' +
                                '<div class="col-lg-6">' +
                                '<label>After Foto</label>' +
                                '<div class="col-lg-12">' +
                                '<img width="100%" height="250" src="<?= base_url('asset/images/pengaduan')?>/' +
                                data
                                .don_foto + '">' +
                                '</div>' +
                                '</div>' +
                                '</div>' +
                                '</div>' +
                                '<div class="timeline-footer">' +
                                '<button type="button" class="btn btn-primary btn-sm" onclick="$.print_report(' +
                                $idAduan + ')">Print</button>' +
                                '</div>' +
                                '</div>');
                        }
                    }
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
                    $("#lblFoto_a").attr("href", "<?= base_url()?>" + data.use_foto);
                    history__aduan.find('[data-card-widget="collapse"]').click();
                    status__aduan.find('[data-card-widget="collapse"]').click();
                    status__aduan.find('.fa-spin').attr('class', 'far fa-bell');
                }
            });
        } catch (ex) {
            alert(ex);
        }
    }
    $.print_report = function(selectedId) {
        window.open("<?php echo site_url('sikontras/p_laporan_aduan'); ?>/" + selectedId, 'Print Status',
            'width=750,height=750');
        return false;
    }
});

function $_pagination_get(id) {
    $url = "";
    if (id == 0) {
        $url = '<?= site_url('admin/json_load_data'); ?>?table=t_data_pengaduan';
    } else {
        $url = '<?= site_url('admin/json_load_data'); ?>?table=t_data_pengaduan&ctgr=user_id' + '&id=' + id;
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
                $('.todo-list_1').empty();
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
        if (data[i].items.id) {
            var time = '00:00:00';
            if (data[i].items.date_in != null) {
                time = data[i].items.date_in.substr(0, 10);
            }
            if (data[i].items.status == null) {
                status =
                    '<small> Menunggu Konfirmasi <span class="btn btn-xs bg-green bg-gradient"><i class="fas fa-clock"></i> Lihat</span></small>';
            }
            if (data[i].items.status == 'K') {
                status =
                    '<small> Pengaduan Telah Di Konfirmasi <span class="btn btn-xs bg-yellow bg-gradient"><i class="fas fa-bell"></i> Lihat</span></small>';
            }
            if (data[i].items.status == 'P') {
                status =
                    '<small> Diteruskan Ke Bagian Support <span class="btn btn-xs bg-red bg-gradient"><i class="fas fa-hard-hat"></i> Lihat</span></small>';
            }
            if (data[i].items.status == 'S') {
                status =
                    '<small> Sedang di Prosess <span class="btn btn-xs bg-green bg-gradient"><i class="fas fa-hard-hat"></i> Lihat</span></small>';
            }
            if (data[i].items.status == 'Y') {
                status =
                    '<small> Pengaduan Selesai <span class="btn btn-xs bg-info bg-gradient"><i class="fas fa-check-circle"></i> Lihat</span></small>';
            }
            $html += '<li>' +
                '<div class="row">' +
                '<div class="col-xs-12 col-md-6">' +
                '<i class="fas fa-ellipsis-v"></i>' +
                '<i class="fas fa-ellipsis-v"></i>' +
                '<span class="text">' +
                time + ' ' + data[i].items.deskripsi + '</span>' +
                '</div>' +
                '<div class="col-xs-12 col-md-6">' +
                '<span class="float-right" onclick="$.view_status(' +
                data[i].items.id +
                ');">' + status +
                '</span></div></div>' +
                '</li>';
        }
    }
    return $html;
};
</script>
<div id="history__aduan" class="card load__overlay">
    <div class="card-header">
        <h3 class="card-title">
            <i class="far fa-clock"></i>
            DATA PENGADUAN
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
                        <span class="text">BELUM ADA PENGADUAN</span>
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <span class="float-right" onclick="">
                            <small class="btn btn-sm bg-green bg-gradient"><i class="far fa-clock"></i>
                                Kosong</small>
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
                                    <a id="lblFoto_a" href="<?= base_url('asset/admin/dist/img')?>/noimages.png"
                                        data-toggle="lightbox" data-title="lblFoto" data-gallery="gallery">
                                        <img id="lblFoto" class="img-fluid lazyload img-thumbnail"
                                            src="<?= base_url('asset/admin/dist/img')?>/noimages.png" alt="Photo Aduan">
                                    </a>
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