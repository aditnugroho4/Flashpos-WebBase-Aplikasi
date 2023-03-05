<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php $this->load->view('admin/menu/sdm/function/f_data_absen');?>
<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAjlx4zvb-LDxdKflkjEvIujgZDOVRLxwE&libraries=localContext&v=beta"
    async defer>
</script>
<div class="col-md-12">
    <div class="card card-outline card-yellow">
        <div class="card-header row">
            <h3 class="card-title col-lg-4 col-sm-12 mb-2">DATA ABSENSI</h3>
            <div class=" card-tools col-lg-8 col-sm-12">
                <div class="mailbox-controls float-right">
                    <button type="button" id="btnAdd" class="btn btn-app bg-green btn-sm"><i
                            class="fas fa-file-alt"></i>Add Data</button>
                    <button type="button" id="btnImport" class="btn btn-app bg-yellow btn-sm"><i
                            class="fas fa-file-import"></i>Import</button>
                    <button type="button" id="btnReload" class="btn btn-app bg-info btn-sm"><i
                            class="fas fa-sync-alt"></i>Refresh</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table table id="tblData" class="table table-bordered table-striped"></table>
            </div>
        </div>
    </div>
</div>
<!-- Dialog Form -->
<div id="frm-add" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Data</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Tambah Data Absen</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="cmbCari">Cari Pegawai</label>
                            <div class="input-group mb-3">
                                <select id="cmbSearch" class="form-control" required></select>
                            </div>
                        </div>
                        <form role="form" id="add-data">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>NIP</label>
                                            <input type="text" id="txtNip" maxlength="20" class="form-control"
                                                disabled="disabled" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Nama</label>
                                            <input type="text" id="txtNama" maxlength="30" class="form-control"
                                                disabled="disabled" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Jabatan</label>
                                            <textarea type="text" id="txtJabatan" class="form-control"
                                                disabled="disabled" rows="2" cols="50" required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Penempatan</label>
                                            <input type="text" id="txtPenempatan" class="form-control"
                                                disabled="disabled" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>SIFT</label>
                                            <select type="text" id="cmbSift" class="form-control" required>
                                                <option value="P">PAGI</option>
                                                <option value="S">SIANG</option>
                                                <option value="M">MALAM</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <label for="txtMulai">JAM MASUK</label>
                                                    <div class="input-group clockpicker pull-center"
                                                        data-placement="left" data-align="top" data-autoclose="true">
                                                        <div class="input-group-append input-group-addon">
                                                            <div data-placement="top" data-toggle="tooltip"
                                                                title="Jam Praktek" class="btn btn-primary"><span
                                                                    class="icon-clock"></span></div>
                                                        </div>
                                                        <input type="time" id="txtMulai" placeholder="Jam Mulai Praktek"
                                                            class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label for="txtSelesai">JAM PULANG</label>
                                                    <div class="input-group clockpicker pull-center"
                                                        data-placement="left" data-align="top" data-autoclose="true">
                                                        <div class="input-group-append input-group-addon">
                                                            <div data-placement="top" data-toggle="tooltip"
                                                                title="Jam Praktek" class="btn btn-primary"><span
                                                                    class="icon-clock"></span></div>
                                                        </div>
                                                        <input type="time" id="txtSelesai"
                                                            placeholder="Jam Selesai Praktek" class="form-control"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Lokasi / Koordinat</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" id="txtKoordinat"
                                                    maxlength="255" aria-label="+0212454844.232235"
                                                    aria-describedby="btn-Gps">
                                                <button class="btn btn-secondary" type="button" id="btn-Gps"><i
                                                        class="fa fa-map-pin"></i> GPS</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary float-right">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-secondary">Close</button>
            </div>
        </div>
    </div>
</div>
<div id="frm-find-gps" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false"
    class="modal fade ">
    <div role="document" class="modal-dialog">
        <div class="modal-content modal-col-light-blue ">
            <div class="modal-body">
                <div class="card card-primary">
                    <div class="card-header">
                        <p>Tentukan Koordinat Absensi</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div id="googleMap" style="width:100%;height:380px;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-secondary">Close</button>
            </div>
        </div>
    </div>
</div>
<div id="frm-edit-data" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Data</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Tambah Data Absen</h3>
                    </div>
                    <div class="card-body">
                        <form role="form" id="upd-data">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>NIP</label>
                                            <input type="text" id="txtNip_E" maxlength="20" class="form-control"
                                                disabled="disabled" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Nama</label>
                                            <input type="text" id="txtNama_E" maxlength="30" class="form-control"
                                                disabled="disabled" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Jabatan</label>
                                            <textarea type="text" id="txtJabatan_E" class="form-control"
                                                disabled="disabled" rows="2" cols="50" required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Penempatan</label>
                                            <input type="text" id="txtPenempatan_E" class="form-control"
                                                disabled="disabled" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>SIFT</label>
                                            <select type="text" id="cmbSift_E" class="form-control" required>
                                                <option value="P">PAGI</option>
                                                <option value="S">SIANG</option>
                                                <option value="M">MALAM</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <label for="txtMulai_E">JAM MASUK</label>
                                                    <div class="input-group clockpicker pull-center"
                                                        data-placement="left" data-align="top" data-autoclose="true">
                                                        <div class="input-group-append input-group-addon">
                                                            <div data-placement="top" data-toggle="tooltip"
                                                                title="Jam Praktek" class="btn btn-primary"><span
                                                                    class="icon-clock"></span></div>
                                                        </div>
                                                        <input type="time" id="txtMulai_E"
                                                            placeholder="Jam Mulai Praktek" class="form-control"
                                                            required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label for="txtSelesai_E">JAM PULANG</label>
                                                    <div class="input-group clockpicker pull-center"
                                                        data-placement="left" data-align="top" data-autoclose="true">
                                                        <div class="input-group-append input-group-addon">
                                                            <div data-placement="top" data-toggle="tooltip"
                                                                title="Jam Praktek" class="btn btn-primary"><span
                                                                    class="icon-clock"></span></div>
                                                        </div>
                                                        <input type="time" id="txtSelesai_E"
                                                            placeholder="Jam Selesai Praktek" class="form-control"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Lokasi / Koordinat</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" id="txtKoordinat_E"
                                                    maxlength="255" aria-label="+0212454844.232235"
                                                    aria-describedby="btn-Gps">
                                                <button class="btn btn-secondary" type="button" id="btn-Gps_E"><i
                                                        class="fa fa-map-pin"></i> GPS</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary float-right">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-secondary">Close</button>
            </div>
        </div>
    </div>
</div>