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
                    id: id
                },
                success: function(data) {
                    timeline.append('<div class="time-label">' +
                        ' <span class = "bg-red" >' + data
                        .use_date.substr(0, 10) +
                        '</span></div>' +
                        ' <div><i class="fas fa-file-prescription bg-green"> </i>' +
                        '<div class="timeline-item">' +
                        '<span class="time"> <i class="fas fa-clock">' +
                        '</i> ' + data
                        .use_date.substr(11, 5) +
                        '</span>' +
                        '<h3 class="timeline-header no-border"><a href="#">' + data
                        .user_id.nama +
                        '</a>' +
                        ' TELAH MEMBUAT PENGADUAN</h3></div></div>');
                    if (data.use_status == "K") {
                        timeline.append('<div class="time-label">' +
                            ' <span class = "bg-blue" >' + data
                            .use_date.substr(0, 10) +
                            '</span></div>' +
                            '<div><i class="fas fa-envelope bg-yellow"></i>' +
                            '<div class="timeline-item">' +
                            '<span class="time"><i class="fas fa-clock"></i> ' + data
                            .use_date.substr(11, 5) +
                            '</span>' +
                            '<h3 class="timeline-header"><a href="#">(ADMIN)</a> ADUAN DI KONFIRMASI </h3>' +
                            '<div class="timeline-body">' +
                            'Sudah Di Konfirmasi untuk menindak lanjuti pengaduan ini.. </div>' +
                            '</div>' +
                            '</div>');
                    }
                    if (data.tin_status == null || data.tin_status == 'Y') {
                        timeline.append('<div><i class="fas fa-paper-plane bg-info"></i>' +
                            '<div class="timeline-item">' +
                            '<span class="time"><i class="fas fa-clock"></i> ' + data
                            .tin_date.substr(11, 5) +
                            '</span>' +
                            '<h3 class="timeline-header"><a href="#">(ADMIN) ' + data
                            .tin_user.nama + '</a> PENUGASAN TIM SUPPORT</h3>' +
                            '<div class="timeline-body">' +
                            'Aduan sudah Di Teruskan Untuk penugasan Tim Regu..' +
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
                    if (data.use_status == "P") {
                        timeline.append('<div class="time-label">' +
                            ' <span class = "bg-blue" >' + data
                            .use_date.substr(0, 10) +
                            '</span></div>' +
                            '<div><i class="fas fa-clock bg-yellow"></i>' +
                            '<div class="timeline-item">' +
                            '<span class="time"><i class="fas fa-clock"></i> ' + data
                            .use_date.substr(11, 5) +
                            '</span>' +
                            '<h3 class="timeline-header"><a href="#">(SISTEM OTOMATIS)</a> ADUAN DI TERIMA  </h3>' +
                            '<div class="timeline-body">' +
                            'Tim Support menerima aduan untuk di selesaikan. </div>' +
                            '</div>' +
                            '</div>');
                        if (data.don_id) {
                            timeline.append('<div><i class="fas fa-paper-plane bg-info"></i>' +
                                '<div class="timeline-item">' +
                                '<span class="time"><i class="fas fa-clock"></i> ' + data
                                .don_date_start +
                                '</span>' +
                                '<h3 class="timeline-header"><a href="#">(TIM SUPPORT) ' +
                                data
                                .don_user.nama + '</a> ADUAN DI PROSESS </h3>' +
                                '<div class="timeline-body">' +
                                'Aduan sedang di Tangani Tim Support..' +
                                '<p>NO SPK : ' + data.don_spk + '</br>' +
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
    $.update_status = function($tables, $filds, $selectedId, $values) {
        $.ajax({
            dataType: 'json',
            url: "<?php echo site_url('admin/aktive'); ?>/" + $tables + "/" + $filds +
                "/" +
                $selectedId + "/" + $values,
            success: function(data) {
                alert("Update Status " + data.message);
                $.view_status($idAduan);
            }
        });
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
                $('.load__overlay').append(
                    '<div class="overlay"><i class="fas fa-2x fa-sync-alt fa-spin"></i></div>'
                );
            }
        },
        callback: function(data, pagination) {
            $('.load__overlay').find('.overlay').remove();
            var html = Templating(data);
            $('#todo-list_1').html(html);
            var pagebar = $('#pagination');
            pagebar.find('.paginationjs-pages').attr('class', 'card-tools float-right');
            pagebar.find('ul').addClass('pagination pagination-sm');
            pagebar.find('li').addClass('page-item');
            pagebar.find('a').addClass('page-link');

        }
    });
};

function Templating(data) {
    var $html = '';
    var status = '';
    for (var i = 0, len = data.length; i < len; i++) {
        if (data[i].items.status == 'K' || data[i].items.status == 'P') {
            var time = '00:00:00';
            if (data[i].items.date_in != null) {
                time = data[i].items.date_in.substr(0, 10);
            }
            if (data[i].items.status == 'K') {
                status =
                    '<small>Terkonfirmasi dan di teruskan <span class="btn btn-xs bg-green bg-gradient"><i class="fas fa-bell"></i> Lihat</span></small>';
            }
            if (data[i].items.status == 'P') {
                status =
                    '<small>Aduan di terima dan di Prosess <span class="btn btn-xs bg-yellow bg-gradient"><i class="fas fa-hammer"></i> Lihat</span> </small>';
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
<div id="history__aduan" class="card">
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
                        <span class="text">Atap Bocor ( Ruangan Tulip)</span>
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <span class="float-right" onclick="">
                            <small class="btn btn-sm bg-green bg-gradient"><i class="far fa-clock"></i>
                                Menunggu
                                Konfirmasi</small>
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