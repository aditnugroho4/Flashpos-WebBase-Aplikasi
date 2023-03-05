<script>
$(document).ready(function() {
    $('.mn-2').addClass('bg-secondary');
    if ($roleName == "Admin" || $roleName == "Administrator") {
        $_pagination_get(0);
    } else {
        $_pagination_get($idUnit);
    }

    var timeline = $(".timeline");
    var history__aduan = $("#history__aduan");
    var status__aduan = $("#status__aduan");
    $('.dropify').dropify({
        messages: {
            default: 'Kembali Ke asal..',
            replace: 'Ganti file Atau Gambar',
            remove: 'Hapus',
            error: 'Ada Kesalahan Saat Upload File atau gambar..!'
        }
    });
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
                        ' YANG MEMBUAT PENGADUAN</h3></div></div>');
                    if (data.use_status == "P" || data.use_status == "S" || data.use_status ==
                        "Y") {
                        timeline.append('<div class="time-label">' +
                            ' <span class = "bg-info" >' + data
                            .use_date.substr(0, 10) +
                            '</span></div>' +
                            '<div>' +
                            '<i class="fas fa-shield-alt bg-green"></i>' +
                            '<div class="timeline-item">' +
                            '<span class="time"><i class="fas fa-clock"></i> 12:05</span>' +
                            '<h3 class="timeline-header"><a href="#">(SISTEM OTOMATIS)</a> KONFIRMASI</h3>' +
                            '<div class="timeline-body">' +
                            'Pengaduan Terkonfirmasi..</div>' +
                            '</div>' +
                            '</div>');
                    }
                    if (data.tin_id) {
                        if (data.tin_status == null || data.tin_status == 'P') {
                            timeline.append('<div class="time-label">' +
                                ' <span class = "bg-green" >' + data
                                .tin_date.substr(0, 10) +
                                '</span></div>' +
                                '<div><i class="fas fa-envelope bg-info"></i>' +
                                '<div class="timeline-item">' +
                                '<span class="time"><i class="fas fa-clock"></i> 12:05</span>' +
                                '<h3 class="timeline-header"><a href="#">(ADMIN) ' + data
                                .tin_user.nama + '</a> PENUGASAN ADUAN</h3>' +
                                '<div class="timeline-body">' +
                                'Aduan sudah Di teruskan Untuk penugasan Tim Regu..' +
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
                        if (data.don_status == null) {
                            timeline.append('<div class="time-label">' +
                                ' <span class="bg-yellow" >' + data.don_date_start
                                .substr(0,
                                    10) +
                                '</span></div>' + '<div>' +
                                '<i class="fas fa-hammer bg-yellow"></i>' +
                                '<div class="timeline-item">' +
                                '<h3 class="timeline-header"><a href="#">(' +
                                $roleName +
                                ') ' +
                                $userName + '</a> SUDAH DALAM PENANGANAN</h3>' +
                                '<div class="timeline-body">' +
                                'Pengaduan Sudah Dalam Penanganan </br> Tim Regu  (' +
                                data
                                .don_regu +
                                ')</div>' +
                                '<div class="timeline-footer">' +
                                '<p>NOSPK : ' + data.don_spk + '</br>' +
                                'Tgl Perbaikan : ' + data.don_date_start +
                                ' Estimasi ' +
                                data.don_time + '</br>' +
                                'Tim Regu : ' + data.don_regu + '</br>' +
                                'Keterangan : ' + data.don_material +
                                '</p>' +
                                '</div>' +
                                '<div class="timeline-footer">' +
                                '<button type="button" class="btn btn-warning btn-sm" onclick="$.selesai_tindakan(' +
                                data.don_id +
                                ')"> Prosess Selesai</button>' +
                                '</div>' +
                                '</div>');
                        }
                        if (data.don_status == 'Y') {
                            timeline.append('<div class="time-label">' +
                                ' <span class="bg-blue" >' + data.don_date_end.substr(
                                    0,
                                    10) +
                                '</span></div>' +
                                '<div>' +
                                '<i class="far fa-calendar-check bg-green"></i>' +
                                '<div class="timeline-item">' +
                                '<h3 class="timeline-header"><a href="#">(' +
                                $roleName +
                                ') ' +
                                $userName + '</a> ADUAN SELESAI</h3>' +
                                '<div class="timeline-body">' +
                                'Pekerjaan Sudah Selesai Dengan Rincian' +
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
                                '<button type="button" class="btn btn-primary btn-sm mr-2">Print</button>' +
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
    $.selesai_tindakan = function($nomor) {
        selectedId = $nomor;
        $('#dlg-selesai-aduan').modal('show');
    };
    $('#selesai_penugasan').submit(function(e) {
        e.preventDefault();
        if ($('#selesai_penugasan').valid()) {
            $('.loading').append(
                '<div class="overlay text-center"><i class="fas fa-2x fa-sync-alt fa-spin"></i></div>'
            );
            var confiq = {
                id: $.base64.encode(selectedId),
                sizeH: 250,
                sizeW: 215,
                tbL: "t_data_perbaikan",
                path: "asset-images-pengaduan"
            };
            var fd = new FormData(document.getElementById("selesai_penugasan"));
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
                        $.ajax({
                            type: "POST",
                            dataType: "json",
                            url: "<?php echo site_url('admin/update/t_data_perbaikan'); ?>",
                            data: {
                                id: selectedId,
                                perbaikan: $("#txtAct_Catatan_Pekerjaan").val(),
                                tglselesai: $date,
                                status: "Y",
                            },
                            success: function(data) {
                                if (data.error == false) {
                                    $('.dropify-clear').click();
                                    $('.loading').find('.overlay').remove();
                                    $('#selesai_penugasan')[0].reset();
                                    alert(data.message);
                                    $('#dlg-selesai-aduan').modal('hide');
                                    $.view_status($idAduan);
                                    $.update_status('t_data_prosess', 'status',
                                        $idAduan, 'Y');
                                    window.location.reload();
                                } else {
                                    $alert(data.message);
                                    $('.loading').find('.overlay').remove();
                                    $('#selesai_penugasan')[0].reset();
                                    $('#dlg-selesai-aduan').modal('hide');
                                }
                            }
                        });
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

function $_pagination_get(id) {
    $url = "";
    if (id == 0) {
        $url = '<?= site_url('admin/json_load_data'); ?>?table=t_data_perbaikan';
    } else {
        $url = '<?= site_url('admin/json_load_data'); ?>?table=t_data_perbaikan&ctgr=unit_id' + '&id=' + id;
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
        if (data[i].items.status == null) {
            var time = '00:00:00';
            if (data[i].items.waktu != null) {
                time = data[i].items.tglperbaikan + " Estimasi Waktu : " + data[i].items.waktu;
            }
            if (data[i].items.status == null) {
                status =
                    '<small>Prosess tindak lanjut <span class="btn btn-xs bg-green bg-gradient"><i class="fas fa-hard-hat"></i> Lihat</span></small>';
            }
            $html += '<li>' +
                '<div class="row">' +
                '<div class="col-xs-12 col-md-6">' +
                '<i class="fas fa-ellipsis-v"></i>' +
                '<i class="fas fa-ellipsis-v"></i>' +
                '<span class="text">' +
                time + ' (' + data[i].items.nospk + ') </span>' +
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
            DATA PEKERJAAN
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
                        <span class="text">BELUM ADA YANG DI KERJAKAN</span>
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <span class="float-right" onclick="">
                            <small class="btn btn-sm bg-green bg-gradient"><i class="far fa-clock"></i>
                                Data Masih kosong</small>
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
<div class="modal fade show" id="dlg-selesai-aduan" aria-modal="true" backdrop-static="true">
    <div class="modal-dialog loading">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Lengkapi Data</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="selesai_penugasan">
                <div class="modal-body">
                    <p><i class="fas fa-exclamation-triangle"></i> Lengkapi dengan benar Keterangan Pekerjaan..</p>
                    <div class="form-group">
                        <label for="txtAct_Catatan_Pekerjaan">Catatan Pekerjaan</label>
                        <textarea type="text" id="txtAct_Catatan_Pekerjaan" onfocus="$.queryLength(this,'#act-ct');"
                            rows="4" cols="50" maxlength="1000" class="form-control" required></textarea>
                        <span class="float-right"><i id="act-ct">0</i> : 1000 characters</span>
                    </div>
                    <div class="form-group">
                        <label for="Foto_lokasi">Foto Pekerjaan</label>
                        <input type="file" id="Foto_lokasi" data-allowed-file-extensions="png jpg jpeg" name="file"
                            class="dropify" data-max-file-size="2M" required>
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