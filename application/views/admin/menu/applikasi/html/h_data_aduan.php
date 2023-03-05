<script>
$(document).ready(function() {
    $('.mn-1').addClass('bg-secondary');
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
                        '</i> 5 mins ago</span>' +
                        '<h3 class="timeline-header no-border"><a href="#">' + data
                        .user_id.nama +
                        '</a>' +
                        ' MEMBUAT PENGADUAN BARU </h3></div></div>');
                    if (data.use_status == null) {
                        timeline.append('<div>' +
                            '<i class="fas fa-envelope bg-yellow"></i>' +
                            '<div class="timeline-item">' +
                            '<span class="time"><i class="fas fa-clock"></i> 12:05</span>' +
                            '<h3 class="timeline-header"><a href="#">(ADMIN) ' +
                            $userName + '</a> KONFIRMASI ADUAN</h3>' +
                            '<div class="timeline-body">' +
                            'Mohon Atasan Yang Lakukan Konfirmasi Aduan Untuk Menindak Lajut.. </div>' +
                            '<div class="timeline-footer">' +
                            '<button type="button" onclick="$.send_tindakan(\'' + data
                            .use_nomor +
                            '\')" class="btn btn-info btn-sm ">Konfirmasi</button>' +
                            '<button type="button" oonclick="$.update_status(\'t_data_pengaduan\',\'status\',\'' +
                            $idAduan +
                            '\',\'C\')" class="btn bg-red btn-sm float-right">Cancel</button>' +
                            '</div>' +
                            '</div>' +
                            '</div>');
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
    $.send_tindakan = function($nomor) {
        $noAduan = $nomor;
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "<?php echo site_url('admin/multi_select');?>?table=m_unit",
            success: function(data) {
                $("#cmbAct_Unit").empty();
                if (data == '') {
                    $("#cmbAct_Unit").append("<option value=''> -- No Result -- </option>");
                } else {
                    $('#dlg-tindak-lanjut').modal('show');
                    $("#cmbAct_Unit").append(
                        "<option value=''> -- Silahkan Pilih -- </option>");
                    for (var i = 0; i < data.length; i++) {
                        $("#cmbAct_Unit").append('<option value="' + data[i].id + '">' +
                            data[i].name + '</option>');
                    }
                }
            }
        });

    };
    $('#konfirmasi_aduan').submit(function(e) {
        e.preventDefault();
        if ($('#konfirmasi_aduan').valid()) {
            $('.loading').append(
                '<div class="overlay text-center"><i class="fas fa-2x fa-sync-alt fa-spin"></i></div>'
            );
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "<?php echo site_url('admin/create/t_data_prosess'); ?>",
                data: {
                    aduan_id: $idAduan,
                    user_id: $user,
                    instruksi: $("#txtAct_Instruksi").val(),
                    diteruskan: $("#txtAct_Diteruskan").val(),
                    unit_id: $("#cmbAct_Unit option:selected").val(),
                    catatan: $("#txtAct_Catatan").val(),
                    date: $date
                },
                success: function(data) {
                    if (data.error == false) {
                        alert(data.message);
                        $('.loading').find('.overlay').remove();
                        $('#dlg-tindak-lanjut').modal('hide');
                        $.view_status($idAduan);
                        $.update_status('t_data_pengaduan', 'status', $idAduan, 'K');
                    } else {
                        $alert(data.message);
                        $('.loading').find('.overlay').remove();
                        $('#dlg-tindak-lanjut').modal('hide');
                        $('#mn-1').click();
                    }
                }
            });
        }
    });
    // Update Status
    $.update_status = function($tables, $filds, $selectedId, $values) {
        $.ajax({
            dataType: 'json',
            url: "<?php echo site_url('admin/aktive'); ?>/" + $tables + "/" + $filds +
                "/" +
                $selectedId + "/" + $values,
            success: function(data) {
                alert("Update Status " + data.message);
                $.view_status($idAduan);
                $('#mn-1').click();
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
        if (data[i].items.status == null) {
            var time = '00:00:00';
            if (data[i].items.date_in != null) {
                time = data[i].items.date_in.substr(0, 10);
            }
            if (data[i].items.status == null) {
                status =
                    '<small>(Data Baru Untuk di Konfirmasi) <span class="btn btn-xs bg-info bg-gradient"><i class="far fa-clock"></i> Pilih</span></small>';
            }
            if (data[i].items.status == 'C') {
                status =
                    '<small>(Pengaduan Di Tolak) <span class="btn btn-xs bg-red bg-gradient"><i class="far fa-calendar-times"></i> Pilih</span></small>';
            }
            $html += '<li>' +
                '<div class="row">' +
                '<div class="col-xs-12 col-md-6">' +
                '<i class="fas fa-ellipsis-v"></i>' +
                '<i class="fas fa-ellipsis-v"></i>' +
                '<span class="text">' +
                time + ' ' + data[i].items.deskripsi + " (" + data[i].items.lokasi + ')</span>' +
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
            DATA PENGADUAN MASUK
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
                        <span class="text">Data Aduan Kosong</span>
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
            STATUS ADUAN
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
                                    <div class="list-images row p-0">
                                        <div class="filtr-item">
                                            <a id="lblFoto_a" href="<?= base_url('asset/admin/dist/img')?>/noimages.png"
                                                data-toggle="lightbox" data-title="lblFoto" data-gallery="gallery">
                                                <img id="lblFoto" class="img-fluid lazyload img-thumbnail"
                                                    src="<?= base_url('asset/admin/dist/img')?>/noimages.png"
                                                    alt="Photo Aduan">
                                            </a>
                                        </div>
                                    </div>

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

<div class="modal fade show" id="dlg-tindak-lanjut" aria-modal="true" backdrop-static="true">
    <div class="modal-dialog loading">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Lengkapi Data</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="konfirmasi_aduan">
                <div class="modal-body">
                    <p><i class="fas fa-exclamation-triangle"></i> Lengkapi dengan benar Tindak Lanjut Pengaduan..</p>
                    <div class="form-group">
                        <label for="txtAct_Instruksi">Instruksi/Informasi</label>
                        <textarea type="text" id="txtAct_Instruksi" onfocus="$.queryLength(this,'#cnt-mn');" rows="2"
                            cols="50" maxlength="500" class="form-control" required></textarea>
                        <span class="float-right"><i id="cnt-mn">0</i> : 500 characters</span>
                    </div>
                    <div class="form-group">
                        <label for="txtAct_Diteruskan">Diteruskan</label>
                        <textarea type="text" id="txtAct_Diteruskan" onfocus="$.queryLength(this,'#cnt-dt');" rows="2"
                            cols="50" maxlength="500" class="form-control" required></textarea>
                        <span class="float-right"><i id="cnt-dt">0</i> : 500 characters</span>
                    </div>
                    <div class="form-group">
                        <label for="cmbAct_Unit">Kepada Unit/Bagian</label>
                        <select name="txtActUnit" id="cmbAct_Unit" class="form-control"></select>
                    </div>
                    <div class="form-group">
                        <label for="txtAct_Catatan">Catatan</label>
                        <textarea type="text" id="txtAct_Catatan" onfocus="$.queryLength(this,'#cnt-ct');" rows="4"
                            cols="50" maxlength="155" class="form-control" required></textarea>
                        <span class="float-right"><i id="cnt-ct">0</i> : 1000 characters</span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary float-right"><i class="fas fa-paper-plane"></i> Kirim
                        Penugasan</button>
                </div>
            </form>
        </div>
    </div>
</div>