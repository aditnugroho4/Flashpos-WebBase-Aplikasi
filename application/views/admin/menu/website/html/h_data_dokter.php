<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    $this->load->view('admin/menu/website/function/f_data_dokter');
?>
<div class="col-md-12">
    <div class="card card-outline card-success">
        <div class=" card-header">
            <h3 class="card-title">Data Dokter</h3>
            <div class=" card-tools">
                <div class="mailbox-controls">
                    <button type="button" id="btnAdd" class="btn btn-app bg-green btn-sm" data-toggle="tooltip"
                        data-placement="top" title="Tambah Data"><i class="fas fa-file-alt"></i>Add Data</button>
                    <button type="button" id="btnUpload" class="btn btn-app bg-pink btn-sm" data-toggle="tooltip"
                        data-placement="top" title="Upload Data"><i class="fas fa-upload"></i>Upload</button>
                    <button type="button" id="btnSetting" class="btn btn-app bg-yellow btn-sm" data-toggle="tooltip"
                        data-placement="top" title="Setting Link"><i class="fas fa-wrench"></i>Setting</button>
                    <button type="button" id="btnReload" class="btn btn-app bg-info btn-sm" data-toggle="tooltip"
                        data-placement="top" title="Refresh"><i class="fas fa-sync-alt"></i>Refresh</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="card card-solid load__overlay" id="data_profile">
                <div class="card-body pb-0">
                    <div class="row d-flex align-items-stretch list__dokter">

                    </div>
                </div>
                <div class="card-footer">
                    <nav aria-label="Contacts Page Navigation">
                        <div id="pagination"></div>
                    </nav>
                </div>
            </div>
            <div class="row" id="detail_profile" style="display:none;">
                <div class="col-md-3">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle profile-dr-img"
                                    src="<?= base_url('asset/images/dokter/preview.png');?>" alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center profile-dr-name">..</h3>

                            <p class="text-muted text-center profile-dr-sts">..</p>

                            <button type="button" class="btn btn-primary btn-block edit-foto-profile"><b>Edit
                                    Foto</b></button>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Profile Singkat</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <strong><i class="fas fa-user-md mr-1"></i> <span class="prof1">Dokter
                                    Spesialis</span></strong>

                            <hr>

                            <strong><i class="fas fa-stethoscope mr-1"></i><span
                                    class="prof2">Spesifikasi</span></strong>

                            <hr>

                            <strong><i class="fas fa-hospital mr-1"></i><span class="prof3">Alamat</span> </strong>

                            <p class="text-muted"></p>

                            <hr>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card load-prof">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#profile" data-toggle="tab">Bio
                                        Data</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="#content__dokter"
                                        data-toggle="tab">Content
                                        Dokter</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body ">
                            <div class="tab-content">
                                <div class="active tab-pane" id="profile">
                                    <form class="form-horizontal" id="edit-data-prof">
                                        <div class="form-group row">
                                            <label for="txtNipDr" class="col-sm-2 col-form-label">NIP</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="txtNipDr" maxlength="18"
                                                    placeholder="ex:196611182002122004" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="txtNama" class="col-sm-2 col-form-label">Nama</label>
                                            <div class="col-sm-10">
                                                <input type="text" maxlength="20" class="form-control" id="txtNama"
                                                    placeholder="ex:dr.Sutomo" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="cmbCtgr" class="col-sm-2 col-form-label">Kategory</label>
                                            <div class="col-sm-10">
                                                <select type="text" class="form-control" id="cmbCtgr" required>
                                                    <option value="">-- Silahkan Pilih --</option>
                                                    <option value="DOKTER UMUM">DOKTER UMUM</option>
                                                    <option value="DOKTER GIGI">DOKTER GIGI</option>
                                                    <option value="DOKTER SPESIALIS">DOKTER SPESIALIS</option>
                                                    <option value="DOKTER SUB SPESIALIS">DOKTER SUB SPESIALIS</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="cmbPoli" class="col-sm-2 col-form-label">Poli Klinik</label>
                                            <div class="col-sm-10">
                                                <select type="text" class="form-control" id="cmbPoli" required></select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="txtKeterangan"
                                                class="col-sm-2 col-form-label">Keterangan</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="txtKeterangan"
                                                    placeholder="ex: Spesialis Jantung" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="txtSIP" class="col-sm-2 col-form-label">NO SIP</label>
                                            <div class="col-sm-4">
                                                <div class="input-group">
                                                    <input type="text" maxlength="45" class="form-control" id="txtSIP"
                                                        placeholder="No SIP" required>
                                                    <span class="input-group-append">
                                                        <button type="button"
                                                            class="btn btn-dark btn-flat btn-views1"><i
                                                                class="fas fa-user-circle"></i></button>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="txtDateSIP"
                                                        placeholder="Berlaku SIP">
                                                    <span class="input-group-append">
                                                        <button type="button" onclick="$('#txtDateSIP').click()"
                                                            class="btn btn-dark btn-flat btn-views2"><i
                                                                class="fas fa-calendar-check"></i></button>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <input type="checkbox" id="Switch__Status" data-bootstrap-switch
                                                    data-off-color="danger" data-on-color="success">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="txtAlamat" class="col-sm-2 col-form-label">Alamat</label>
                                            <div class="col-sm-10">
                                                <textarea type="text" col="5" row="5" class="form-control"
                                                    id="txtAlamat" required></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="txtTelpon" class="col-sm-2 col-form-label">Telpon</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" maxlength="16" id="txtTelpon"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="txtEmail" class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-10">
                                                <input type="email" class="form-control" maxlength="45" id="txtEmail"
                                                    placeholder="ex: example@example.com" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" required> Saya Setuju <a href="#">Untuk
                                                            melakukan perubahan data</a>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" class="btn btn-success">Simpan</button>
                                                <button id="btn-Edit-batal" type="button"
                                                    class="btn btn-danger">Batal</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane" id="content__dokter">
                                    <div class="col-md-12">
                                        <div class="card card-primary card-outline load-edit">
                                            <div class="card-header">
                                                <h3 class="card-title">Content Dokter</h3>
                                            </div>
                                            <!-- /.card-header -->
                                            <form id="edit-Content-dokter" action="POST">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="card card-primary">
                                                                <div class="card-header">
                                                                    <p>Buat Conten Terkait <span
                                                                            class="lbl-edit-header"></span></p>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-lg-8 col-md-12">
                                                                            <div class="form-group">
                                                                                <label for="txtContent">Content</label>
                                                                                <textarea id="txtContent"
                                                                                    class="form-control"
                                                                                    style="min-height: 300px;"> </textarea>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-4 col-md-12">
                                                                            <div class="card card-pink">
                                                                                <div class="card-header">
                                                                                    <p>Optimasi Pencarian</p>
                                                                                </div>
                                                                                <div class="card-body">
                                                                                    <div class="form-group">
                                                                                        <label
                                                                                            for="txtTitle_e">Title</label>
                                                                                        <input id="txtTitle_e"
                                                                                            class="form-control"
                                                                                            placeholder="ex : Wedding Organizer"
                                                                                            onfocus="$.queryLength(this,'#cnt-tl_e');"
                                                                                            maxlength="60">
                                                                                        <span class="float-right"><i
                                                                                                id="cnt-tl_e">0</i> : 60
                                                                                            characters</span>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label
                                                                                            for="txtDeskripsi_e">Deskripsi</label>
                                                                                        <textarea id="txtDeskripsi_e"
                                                                                            class="form-control" col="5"
                                                                                            row="4"
                                                                                            placeholder="ex : Wedding Organizer"
                                                                                            onfocus="$.queryLength(this,'#cnt-des_e');"
                                                                                            maxlength="155"></textarea>
                                                                                        <span class="float-right"><i
                                                                                                id="cnt-des_e">0</i> :
                                                                                            155
                                                                                            characters</span>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label
                                                                                            for="txtImg_e">Image</label>
                                                                                        <div class="input-group">
                                                                                            <input type="text"
                                                                                                id="txtImg_e"
                                                                                                class="form-control"
                                                                                                required>
                                                                                            <div class="input-group-append"
                                                                                                onclick="$.search_img();">
                                                                                                <div
                                                                                                    class="input-group-text">
                                                                                                    <i
                                                                                                        class="fa fa-images"></i>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group ">
                                                                                        <label
                                                                                            for="txtAuthor_e">Author</label>
                                                                                        <div class="input-group">
                                                                                            <input type="text"
                                                                                                id="txtAuthor_e"
                                                                                                onfocus="$.queryLength(this,'#cnt-au_e');"
                                                                                                maxlength="60"
                                                                                                placeholder="akbargrup wedding planner"
                                                                                                class="form-control "
                                                                                                required>
                                                                                        </div>
                                                                                        <span class="float-right"><i
                                                                                                id="cnt-au_e">0</i> : 60
                                                                                            characters</span>
                                                                                    </div>
                                                                                    <div class="form-group ">
                                                                                        <label
                                                                                            for="txtKeyword_e">Keyword</label>
                                                                                        <div class="input-group">
                                                                                            <input type="text"
                                                                                                id="txtKeyword_e"
                                                                                                onfocus="$.queryLength(this,'#cnt-ky_e');"
                                                                                                maxlength="500"
                                                                                                value="akbargrup,wedding bogor"
                                                                                                class="form-control"
                                                                                                required>
                                                                                        </div>
                                                                                        <span class="float-right"><i
                                                                                                id="cnt-ky_e">0</i> :
                                                                                            500
                                                                                            characters</span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /.card-body -->
                                                <div class="card-footer">
                                                    <div class="float-right">
                                                        <button type="submit" id="btn-simpan-content"
                                                            class="btn btn-primary"><i class="far fa-envelope"></i>
                                                            Simpan</button>
                                                        <button type="button" id="btn-edit-content"
                                                            class="btn btn-warning"><i class="far fa-envelope"></i>
                                                            Edit</button>
                                                    </div>
                                                    <button type="button" id="btn-reset" class="btn btn-default"><i
                                                            class="fas fa-times"></i>
                                                        Discard</button>
                                                </div>
                                                <!-- /.card-footer -->
                                            </form>
                                        </div>
                                        <!-- /.card -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="frm-add" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog modal-lg">
        <div class="modal-content modal-col-light-blue">
            <div class="modal-header">
                <h4 id="exampleModalLabel" class="modal-title">Tambah Data</h4>
            </div>
            <div class="modal-body">
                <form id="add-data-dokter">
                    <div class="card card-primary load-add-prof">
                        <div class="card-header">
                            <p>Data Profile Dokter</p>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label for="txtAddNama">Nama Lengkap</label>
                                        <input id="txtAddNama" type="text" name="nama" placeholder="Nama Lengkap"
                                            class="form-control" autofocus required>
                                    </div>
                                    <div class="form-group">
                                        <label for="cmbAddCtgr">Kategory</label>
                                        <select type="text" class="form-control" id="cmbAddCtgr" required>
                                            <option value="">-- Silahkan Pilih --</option>
                                            <option value="DOKTER UMUM">DOKTER UMUM</option>
                                            <option value="DOKTER GIGI">DOKTER GIGI</option>
                                            <option value="DOKTER SPESIALIS">DOKTER SPESIALIS</option>
                                            <option value="DOKTER SUB SPESIALIS">DOKTER SUB SPESIALIS</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="txtAddKeterangan">Keterangan</label>
                                        <input type="text" class="form-control" id="txtAddKeterangan"
                                            placeholder="ex: Spesialis Jantung" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="txtAddSIP">NO SIP</label>
                                        <input type="number" maxlength="16" class="form-control" id="txtAddSIP"
                                            placeholder="No SIP" required>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="text" maxlength="8" class="form-control" id="txtAddDateSIP"
                                                placeholder="Berlaku SIP">
                                            <span class="input-group-append">
                                                <button type="button" onclick="$('#txtAddDateSIP').click()"
                                                    class="btn btn-dark btn-flat btn-datesip"><i
                                                        class="fas fa-calendar-day"></i></button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label for="txtAddAlamat">Alamat</label>
                                        <textarea type="text" col="5" row="5" class="form-control" maxlength="16"
                                            id="txtAddAlamat" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="txtAddTelpon">Telpon</label>
                                        <input type="number" class="form-control" maxlength="16" id="txtAddTelpon"
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <label for="txtAddEmail">Email</label>
                                        <input type="email" class="form-control" maxlength="16" id="txtAddEmail"
                                            placeholder="ex: example@example.com" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-warning">Batal</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-secondary waves-effect">Close</button>
            </div>
        </div>
    </div>
</div>
<div id="frm-edit-foto" tabindex="-1" data-backdrop="static" role="dialog" aria-hidden="true"
    class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content modal-col-light-blue loading-foto">
            <div class="modal-header">
                <h4 id="frm-edit-foto-Label" class="modal-title">Form Edit</h4>
            </div>
            <div class="modal-body">
                <div class="card card-primary loading-foto">
                    <div class="card-header">
                        <p>Edit Foto Profile</p>
                    </div>
                    <form id="edit-foto-prof">
                        <div class="card-body">
                            <div class="form-group">
                                <input type="file" id="upl-upd-foto-prof" data-allowed-file-extensions="png jpg jpeg"
                                    name="file" class="dropify" data-max-file-size="2M" required>
                            </div>
                            <div class="input-group">
                                <div class="input-group-append ">
                                    <button type="submit" class="input-group-text bg-gradient btn-info">Upload</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-secondary ">Close</button>
            </div>
        </div>
    </div>
</div>
<div id="frm-find-img" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false"
    class="modal fade ">
    <div role="document" class="modal-dialog">
        <div class="modal-content modal-col-light-blue ">
            <div class="modal-body">
                <div class="card card-primary">
                    <div class="card-header">
                        <p>Pilih Gambar Untuk Gambar Utama</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="txtName">Data Gambar</label>
                                    <div class="input-group">
                                        <select id="cmbImg" class="form-control" required></select>
                                    </div>
                                </div>
                            </div>
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