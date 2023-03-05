<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php $this->load->view('admin/menu/website/function/f_edit_header'); ?>
<div class="col-md-12">
    <div class="card card-outline card-success">
        <div class=" card-header">
            <h3 class="card-title">Data Header</h3>
            <div class=" card-tools">
                <div class="mailbox-controls">
                    <button type="button" id="btnAdd" class="btn btn-app bg-green btn-sm" data-toggle="tooltip"
                        data-placement="top" title="Tambah Data"><i class="fas fa-file-alt"></i>Add Data</button>
                    <button type="button" id="btnSetting" class="btn btn-app bg-yellow btn-sm" data-toggle="tooltip"
                        data-placement="top" title="Setting Link"><i class="fas fa-wrench"></i>Setting</button>
                    <button type="button" id="btnReload" class="btn btn-app bg-info btn-sm" data-toggle="tooltip"
                        data-placement="top" title="Refresh"><i class="fas fa-sync-alt"></i>Refresh</button>
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
<div id="dlg-add_upload" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true"
    class="modal fade text-left">
    <div role="document" class="modal-dialog modal-lg">
        <div class="modal-content modal-col-light-blue">
            <div class="modal-header">
                <h4 class="modal-title">Form Add</h4>
            </div>
            <div class="modal-body">
                <div class="card card-primary">
                    <div class="card-header">
                        <p>Upload Gambar</p>
                    </div>
                    <form id="add-data-upload" method="POST">
                        <div class="card-body load-ding-upload">
                            <div class="row">
                                <div class="col-lg-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="logo-img">Images</label>
                                        <div id="myDropzone" class="dropzone"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="txtNameModel">Nama Model</label>
                                        <input type="text" id="txtNameModel" placeholder="ex.: Ariel Tatum"
                                            class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="txtLokasi">Lokasi</label>
                                        <input type="text" id="txtLokasi" placeholder="ex.: Braja Mustika"
                                            class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="cmbKategory-upd">Kategory</label>
                                        <select id="cmbKategory-upd" class="form-control" required></select>
                                    </div>
                                    <div class="form-group">
                                        <label for="cmbLink-upd">Permalink Button</label>
                                        <select id="cmbLink-upd" multiple class="form-control selectpicker"
                                            required></select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="form-group text-right">
                                <button type="button" data-dismiss="modal" class="btn btn-secondary">Close</button>
                                <button type="submit" class="btn btn-primary ">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="dlg-add_slider" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true"
    class="modal fade text-left">
    <div role="document" class="modal-dialog modal-lg">
        <div class="modal-content modal-col-light-blue">
            <div class="modal-header">
                <h4 id="frm-edit-foto-Label" class="modal-title">Form Add</h4>
            </div>
            <div class="modal-body">
                <div class="card card-primary">
                    <div class="card-header">
                        <p>Add Data Slider</p>
                    </div>
                    <form id="add-data-slider">
                        <div class="card-body load-ding">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="logo-img">Logo images</label>
                                        <input type="file" id="logo-img" data-allowed-file-extensions="png jpg jpeg"
                                            name="file" class="dropify" data-max-file-size="1M" required>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="txtTitle">Title</label>
                                        <input class="form-control" id="txtTitle" placeholder="ex : Selamat Datang"
                                            onfocus="$.queryLength(this,'#cnt-Tl');" maxlength="60" required>
                                        <span class="float-right"><i id="cnt-Tl">0</i> : 60 characters</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="txtJudul">Judul</label>
                                        <textarea class="form-control" id="txtJudul"
                                            placeholder="ex : Di Rumah Sakit Umum Leuwiliang"
                                            onfocus="$.queryLength(this,'#cnt-Jd');" maxlength="100"
                                            required></textarea>
                                        <span class="float-right"><i id="cnt-Jd">0</i> : 150 characters</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="txtDeskripsi">Deskripsi</label>
                                        <textarea class="form-control" id="txtDeskripsi"
                                            onfocus="$.queryLength(this,'#cnt-Ds');"
                                            placeholder="ex : Info Terbaru Kami " maxlength="500" required></textarea>
                                        <span class="float-right"><i id="cnt-Ds">0</i> : 150 characters</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="cmbKategory">Katagori</label>
                                        <select id="cmbKategory" class="form-control" required></select>
                                    </div>
                                    <div class="form-group">
                                        <label for="cmbLink">Link Buttons</label>
                                        <select id="cmbLink" multiple class="custom-select " required></select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="form-group text-right">
                                <button type="button" id="btnECancelPost" class="btn btn-warning">Cancel</button>
                                <button type="submit" id="btnESavePost" class="btn btn-primary ">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-secondary">Close</button>
            </div>
        </div>
    </div>
</div>
<div id="dlg-edit-foto" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true"
    class="modal fade text-left">
    <div role="document" class="modal-dialog loading">
        <div class="modal-content modal-col-light-blue">
            <div class="modal-header">
                <h4 id="frm-edit-foto-Label" class="modal-title">Form Edit</h4>
            </div>
            <div class="modal-body">
                <div class="card card-primary">
                    <div class="card-header">
                        <p>Edit Gamabar</p>
                    </div>
                    <form id="edit-foto-prof">
                        <div class="card-body">
                            <div class="form-group">
                                <input type="file" id="upl-upd-foto-prof" data-allowed-file-extensions="png jpg jpeg"
                                    name="file" class="dropify" data-max-file-size="1M" required>
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
<?php $this->load->view('admin/menu/website/html/h_edit_permalink');?>