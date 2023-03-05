<script>
$(document).ready(function() {
    $('.mn-1').addClass('bg-secondary');
    $('.dropify').dropify({
        messages: {
            default: 'Kembali Ke asal..',
            replace: 'Ganti file Atau Gambar',
            remove: 'Hapus',
            error: 'Ada Kesalahan Saat Upload File atau gambar..!'
        }
    });
    jenis_aduan();

    function jenis_aduan() {
        $('#buat_pengaduan')[0].reset();
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "<?php echo site_url('admin/multi_select');?>?table=t_jenis_aduan",
            success: function(data) {
                if (data == '') {
                    $("#cmbJenis").append("<option value=''> -- No Result -- </option>");
                } else {
                    $("#cmbJenis").append(
                        "<option value=''> -- Silahkan Pilih -- </option>");
                    for (var i = 0; i < data.length; i++) {
                        $("#cmbJenis").append('<option value="' + data[i].id + '">' +
                            data[i].nama + '</option>');
                    }
                }
            }
        });
    }
    $("#cmbJenis").change(function() {
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "<?php echo site_url('admin/multi_select');?>?table=t_ctgr_aduan&select=jenis_id&id=" +
                $(this).val(),
            success: function(data) {
                $("#cmbPerbaikan").empty();
                if (data == '') {
                    $("#cmbPerbaikan").append(
                        "<option value=''> -- No Result -- </option>");
                } else {
                    $("#cmbRole").append(
                        "<option value=''> -- Silahkan Pilih -- </option>");
                    for (var i = 0; i < data.length; i++) {
                        $("#cmbPerbaikan").append("<option value='" + data[i].id + "'>" +
                            data[i]
                            .nama + "</option>");
                    }
                }
            }
        });
    });
    $('#buat_pengaduan').submit(function(e) {
        e.preventDefault();
        if ($('#buat_pengaduan').valid()) {
            var confiq = {
                id: $user,
                sizeH: 500,
                sizeW: 215,
                noaduan: $("#txtNoAduan").val(),
                jenis: $("#cmbJenis option:selected").text(),
                perbaikan: $("#cmbPerbaikan option:selected").text(),
                deskripsi: $("#txtDeskripsi").val(),
                lokasi: $("#txtLokasi").val(),
                tbL: "t_data_pengaduan",
                path: "asset-images-pengaduan"
            };
            var fd = new FormData(document.getElementById("buat_pengaduan"));
            var parsing = $.base64.encode(JSON.stringify(confiq));
            parsing = parsing.replaceAll(".", "^");
            parsing = parsing.replaceAll("+", "-");
            parsing = parsing.replaceAll("/", "_");
            $('.card-loading-input').append(
                '<div class="overlay"><i class="fas fa-2x fa-sync-alt fa-spin"></i></div>');
            $.ajax({
                url: "<?php echo site_url('admin/send_data_pengaduan');?>?data=" + parsing,
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
                        $("#buat_pengaduan")[0].reset();
                        $('.card-loading-input').find('.overlay').remove();
                        location.reload();
                    } else {
                        $('.dropify-clear').click();
                        $("#buat_pengaduan")[0].reset();
                        $('.card-loading-input').find('.overlay').remove();
                    }

                }
            });
        }
    });
    $("#btn-batal").button().click(function() {
        $('.card-loading-input').append(
            '<div class="overlay"><i class="fas fa-2x fa-sync-alt fa-spin"></i></div>');
        $('#buat_pengaduan')[0].reset();
        $('.card-loading-input').find('.overlay').remove();
    });
});
</script>
<div class="col-sm-12 offset-sm-0 col-lg-8 offset-lg-2">
    <div class="card card-loading-input">
        <form id="buat_pengaduan" action="POST">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="far fa-file"></i>
                    Buat Pengaduan Baru
                </h3>
            </div>
            <div class="card-body ">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="txtNoAduan">No Aduan</label>
                            <?php
                    $query=R::count("t_data_pengaduan")+1;
                    $angka= "SI".str_pad($query,4,"0",STR_PAD_LEFT);
                    echo "<input type='text' id='txtNoAduan' disabled='disabled' value='".$angka."' class='form-control' required>";
                    ?>
                        </div>
                        <div class="form-group">
                            <label for="txtLokasi">Lokasi</label>
                            <textarea class="form-control" id="txtLokasi" maxlength="100" row="10" col="10"
                                required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="cmbJenis">Jenis Pengaduan</label>
                            <select name="cmbJenis" id="cmbJenis" class="form-control" required></select>
                        </div>
                        <div class="form-group">
                            <label for="cmbPerbaikan">Nama Perbaikan</label>
                            <select name="cmbPerbaikan" id="cmbPerbaikan" class="form-control" required></select>
                        </div>
                        <div class="form-group">
                            <label for="txtDeskripsi">Deskripsi</label>
                            <textarea class="form-control" id="txtDeskripsi" maxlength="500" row="10" col="10"
                                required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="Foto_lokasi">Upload Foto</label>
                            <input type="file" id="Foto_lokasi" data-allowed-file-extensions="png jpg jpeg" name="file"
                                class="dropify" data-max-file-size="2M" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="float-right">
                    <button type="button" id="btn-batal" class="btn bg-green ">Batal</button>
                    <button type="submit" class="btn btn-primary">Prosess</button>
                </div>
            </div>
        </form>
    </div>
</div>