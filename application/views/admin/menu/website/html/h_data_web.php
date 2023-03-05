<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); $this->load->view('admin/menu/website/function/f_data_web'); ?>
<div class="col-md-12">
    <div class="card card-outline card-success load-ding">
        <div class=" card-header">
            <h3 class="card-title">Data Webiste</h3>
            <div class=" card-tools">
                <div class="mailbox-controls">
                    <button type="button" id="btnEditProf" class="btn btn-default bg-green btn-sm" data-toggle="tooltip"
                        data-placement="top" title="Edit Content Profil"><i class="fas fa-pencil-alt"></i></button>
                    <button type="button" id="btnEdit" class="btn btn-default bg-yellow btn-sm" data-toggle="tooltip"
                        data-placement="top" title="Edit Data"><i class="fas fa-edit"></i></button>
                    <button type="button" id="btnDell" class="btn btn-default bg-danger btn-sm" data-toggle="tooltip"
                        data-placement="top" title="Hapus Data"><i class="fas fa-eraser"></i></button>
                    <button type="button" id="btnGallery" class="btn btn-default bg-pink btn-sm" data-toggle="tooltip"
                        data-placement="top" title="Album Gallery"><i class="fas fa-images"></i></button>
                    <button type="button" id="btnReload" class="btn btn-default bg-info btn-sm" data-toggle="tooltip"
                        data-placement="top" title="Refresh"><i class="fas fa-sync-alt"></i></button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive data__tables">
                <table table id="tblData" class="table table-bordered table-striped"></table>
            </div>
            <div class="card card-primary card-outline edit__profil" style="display:none;">
                <div class="card-header">
                    <h3 class="card-title">Edit Profil Webiste</h3>
                </div>
                <form id="edit-post-profil" action="POST">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="txtContent">Content Profil</label>
                                            <textarea id="txtContent" class="form-control" style="min-height: 300px;"
                                                required> </textarea>
                                        </div>
                                        <div class="form-group">
                                            <button type="button" class="btn btn-warning btn-load">load</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="float-right">
                            <button type="button" id="btn-batal" class="btn btn-app"><i class="fas fa-times"></i>
                                Draft</button>
                            <button type="submit" id="btn-simpan" class="btn btn-primary"><i
                                    class="far fa-envelope"></i>
                                Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="frm-edit-confiq" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" class="modal fade ">
    <div role="document" class="modal-dialog">
        <div class="modal-content modal-col-light-blue">
            <div class="modal-body">
                <div class="card card-primary">
                    <div class="card-header">
                        <p>Edit Data Website</p>
                    </div>
                    <form id="save-data">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="txtTitle">Title</label>
                                        <textarea type="text" id="txtTitle" onfocus="$.queryLength(this,'#cnt-tl');"
                                            rows="2" cols="50" maxlength="60"
                                            placeholder="Wedding Planner terbaik di Bogor" class="form-control"
                                            required></textarea>
                                        <span class="float-right"><i id="cnt-tl">0</i> : 60 characters</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="txtDeskripsi">Deskripsi</label>
                                        <textarea type="text" id="txtDeskripsi" onfocus="$.queryLength(this,'#cnt-dk');"
                                            rows="4" cols="50" maxlength="155"
                                            placeholder="cari wedding planner terbaik di bogor" class="form-control"
                                            required></textarea>
                                        <span class="float-right"><i id="cnt-dk">0</i> : 155 characters</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="txtImg">Image</label>
                                        <div class="input-group">
                                            <input type="text" id="txtImg" class="form-control" required>
                                            <div class="input-group-append" onclick="$.search_img();">
                                                <div class="input-group-text"><i class="fa fa-images"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="txtAuthor">Author</label>
                                        <div class="input-group">
                                            <input type="text" id="txtAuthor" onfocus="$.queryLength(this,'#cnt-au');"
                                                maxlength="60" placeholder="akbargrup wedding planner"
                                                class="form-control " required>
                                        </div>
                                        <span class="float-right"><i id="cnt-au">0</i> : 60 characters</span>
                                    </div>
                                    <div class="form-group ">
                                        <label for="txtKeyword">Keyword</label>
                                        <div class="input-group">
                                            <input type="text" id="txtKeyword" onfocus="$.queryLength(this,'#cnt-ky');"
                                                maxlength="500" value="akbargrup,wedding bogor" class="form-control "
                                                required>
                                        </div>
                                        <span class="float-right"><i id="cnt-ky">0</i> : 500 characters</span>
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
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-secondary">Close</button>
            </div>
        </div>
    </div>
</div>
<div id="frm-find-img" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade ">
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
                                <div class="form-group">
                                    <label for="txtCopy">Copy Link Gambar</label>
                                    <div class="input-group">
                                        <input type="text" id="txtCopy" class="form-control" required>
                                        <div class="input-group-append" id="click-copy">
                                            <div class="btn bg-purple input-group-text"><i class="fa fa-copy"></i></div>
                                        </div>
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
<!-- End Modal -->