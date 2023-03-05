<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('admin/menu/website/function/f_edit_elibrary'); 
?>

<div class="col-md-12">
    <div class="card card-outline card-success">
        <div class=" card-header">
            <h3 class="card-title">Data Perpustakaan</h3>
            <div class=" card-tools">
                <div class="mailbox-controls">
                    <!-- <button type="button" id="btnAdd" class="btn btn-app bg-green btn-sm" data-toggle="tooltip"
                        data-placement="top" title="Tambah Data"><i class="fas fa-file-alt"></i>Add Data</button> -->
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
            <div class="table-responsive">
                <table table id="tblData" class="table table-bordered table-striped"></table>
            </div>
        </div>
    </div>
</div>

<div id="dlg-post-library" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true" class="modal fade">
    <div role="document" class="modal-dialog">
        <div class="modal-content modal-col-light-blue load-publis">
            <div class="modal-header">
                <h4 class="modal-title">From Setting Seo</h4>
            </div>
            <div class="modal-body">
                <div class="card card-primary">
                    <div class="card-header">
                        <p>Optimisasi Data</p>
                    </div>
                    <form id="publikasi_perpus" method="POST">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="txtTitle">Title</label>
                                <input type="text" id="txtTitle_e" onfocus="$.queryLength(this,'#cnt-tl_e');"
                                    maxlength="60" placeholder="ex.: Artikel Kesehatan" class="form-control" required>
                                <span class="float-right"><i id="cnt-tl_e">0</i> : 60 characters</span>
                            </div>
                            <div class="form-group">
                                <label for="txtDeskripsi_e">Deskripsi</label>
                                <textarea type="text" id="txtDeskripsi_e" col="4" row="5"
                                    onfocus="$.queryLength(this,'#cnt-des_e');" maxlength="150"
                                    placeholder="ex.: Menjaga Kesehatan Sangat Penting" class="form-control"
                                    required></textarea>
                                <span class="float-right"><i id="cnt-des_e">0</i> : 150
                                    characters</span>
                            </div>
                            <div class="form-group ">
                                <label for="txtKeyword_e">Keyword</label>
                                <div class="input-group">
                                    <input type="text" id="txtKeyword_e" onfocus="$.queryLength(this,'#cnt-key_e');"
                                        value="elibrary,rsudleuwiliang,rsud leuwiliang" class="form-control " required>
                                    <span class="float-right"><i id="cnt-key_e">0</i> : 500
                                        characters</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="txtImg_e">Image ALt</label>
                                <div class="input-group">
                                    <input type="text" id="txtImg_e" class="form-control" disabled="disabled" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="txtAuthor_e">Author</label>
                                <input type="text" id="txtAuthor_e" onfocus="$.queryLength(this,'#cnt-aut_e');"
                                    placeholder="ex.: PKRS RSUD Leuwiliang" class="form-control" required>
                                <span class="float-right"><i id="cnt-aut_e">0</i> : 60 characters</span>
                            </div>
                            <div class="form-group">
                                <label for="txtShortLink_e">Slug</label>
                                <input type="text" id="txtShortLink_e" onfocus="$.queryLength(this,'#cnt-Sho_e');"
                                    maxlength="70" placeholder="ex.: info-penting-kesehatan" class="form-control"
                                    required>
                                <span class="float-right"><i id="cnt-Sho_e">0</i> : 70 characters</span>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="float-right">
                                <button type="button" id="btn-batal-edit" class="btn btn-warning"><i
                                        class="far fa-close"></i> Batal</button>
                                <button type="submit" class="btn btn-primary"><i class="far fa-envelope"></i>
                                    Simpan</button>
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
<div id="dlg-add_upload" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true"
    class="modal fade text-left">
    <div role="document" class="modal-dialog modal-lg">
        <div class="modal-content modal-col-light-blue">
            <div class="modal-header">
                <h4 class="modal-title">Form Upload</h4>
            </div>
            <div class="modal-body">
                <div class="card card-primary load-ding-upload">
                    <div class="card-header">
                        <p>Upload Ke Library</p>
                    </div>
                    <form id="add-data-upload" method="POST">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="logo-img">Cover Buku</label>
                                        <input type="file" id="logo-img" data-allowed-file-extensions="png jpg jpeg"
                                            name="file" class="dropify" data-max-file-size="1M" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="logo-img">Upload File (pdf,xls,doc)</label>
                                        <div id="myDropzone" class="dropzone"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="txtNamaBuku">Nama Buku</label>
                                        <input type="text" id="txtNamaBuku" maxlength="60"
                                            placeholder="ex.: MAKANAN SEHAT" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="txtJudul">Judul</label>
                                        <input type="text" id="txtJudul" maxlength="60" placeholder="ex.: MAKANAN DIET"
                                            class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="txtSinopsis">Sinopsis</label>
                                        <textarea type="text" row="15" id="txtSinopsis" maxlength="250"
                                            class="form-control" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="txtSumber">Sumber / Reverensi</label>
                                        <input type="text" id="txtSumber" value="kemenkes,who" class="form-control"
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <label for="cmbKategory-upd">Kategory</label>
                                        <select id="cmbKategory-upd" class="form-control" required></select>
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
<div id="dlg-edit-status" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true"
    class="modal fade text-left">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pilihan Lanjutan</h5>
            </div>
            <div class="modal-body">
                <p id="txt-status"></p>
            </div>
            <div class="modal-footer">
                <button type="button" id="btn-prosess" class="btn bg-green waves-effect">Prosess</button>
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>