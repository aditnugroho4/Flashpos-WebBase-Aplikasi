<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); $this->load->view('admin/menu/website/function/f_menu_portal'); ?>
<div class="col-md-12">
    <div class="card card-outline card-success">
        <div class=" card-header">
            <h3 class="card-title">Menu Portal</h3>
            <div class=" card-tools">
                <div class="mailbox-controls">
                    <button type="button" id="btnAdd" class="btn btn-default bg-green btn-sm" data-toggle="tooltip"
                        data-placement="top" title="Tambah Menu"><i class="fas fa-file-alt"></i></button>
                    <button type="button" id="btnEdit" class="btn btn-default bg-yellow btn-sm" data-toggle="tooltip"
                        data-placement="top" title="Edit Data"><i class="fas fa-edit"></i></button>
                    <button type="button" id="btnDell" class="btn btn-default bg-danger btn-sm" data-toggle="tooltip"
                        data-placement="top" title="Hapus Data"><i class="fas fa-eraser"></i></button>
                    <button type="button" id="btnAddSub" class="btn btn-default bg-pink btn-sm" data-toggle="tooltip"
                        data-placement="top" title="Tambah Sub Menu"><i class="fas fa-sitemap"></i></button>
                    <button type="button" id="btnReload" class="btn btn-default bg-info btn-sm" data-toggle="tooltip"
                        data-placement="top" title="Refresh"><i class="fas fa-sync-alt"></i></button>
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
<div id="frm-add-menu" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" class="modal fade ">
    <div role="document" class="modal-dialog">
        <div class="modal-content modal-col-light-blue load-ding-add">
            <div class="modal-body ">
                <div class="card card-primary">
                    <div class="card-header">
                        <p>Tambah Menu Portal</p>
                    </div>
                    <form id="save-data">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="txtMenu">Nama Menu / Aplikasi</label>
                                        <input type="text" id="txtMenu" onfocus="$.queryLength(this,'#cnt-mn');"
                                            maxlength="20" placeholder="Home" class="form-control" placeholder="SIKOMO"
                                            required>
                                        <span class="float-right"><i id="cnt-mn">0</i> : 20 characters</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="txtIcons">icon</label>
                                        <textarea type="text" id="txtIcons" onfocus="$.queryLength(this,'#cnt-tl');"
                                            rows="2" cols="50" maxlength="60" placeholder="Icons Menu"
                                            class="form-control" required></textarea>
                                        <span class="float-right"><i id="cnt-tl">0</i> : 60 characters</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="txtDeskripsi">Deskripsi</label>
                                        <textarea type="text" id="txtDeskripsi" onfocus="$.queryLength(this,'#cnt-dk');"
                                            rows="4" cols="50" maxlength="155" placeholder="Ini Adalah..."
                                            class="form-control" required></textarea>
                                        <span class="float-right"><i id="cnt-dk">0</i> : 155 characters</span>
                                    </div>
                                    <div class="form-group ">
                                        <label for="txtURL">Url</label>
                                        <div class="input-group">
                                            <input type="url" id="txtURL" onfocus="$.queryLength(this,'#cnt-au');"
                                                maxlength="60" placeholder="https?" class="form-control " required>
                                        </div>
                                        <span class="float-right"><i id="cnt-au">0</i> : 60 characters</span>
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
<div id="frm-edit-menu" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" class="modal fade ">
    <div role="document" class="modal-dialog modal-lg">
        <div class="modal-content modal-col-light-blue load-ding-edit">
            <div class="modal-body ">
                <div class="card card-primary">
                    <div class="card-header">
                        <p>Edit Menu</p>
                    </div>
                    <form id="edit-data">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-xs-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="txtMenu_e">Nama Menu / Aplikasi</label>
                                        <input type="text" id="txtMenu_e" onfocus="$.queryLength(this,'#cnt-mn_e');"
                                            maxlength="20" placeholder="ex.: SIKOMO" class="form-control" required>
                                        <span class="float-right"><i id="cnt-mn_e">0</i> : 20 characters</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="txtTitle_e">Title</label>
                                        <textarea type="text" id="txtTitle_e" onfocus="$.queryLength(this,'#cnt-tl_e');"
                                            rows="2" cols="50" maxlength="60" placeholder="ex.: Home | Rsud Leuwiliang"
                                            class="form-control" required></textarea>
                                        <span class="float-right"><i id="cnt-tl_e">0</i> : 60 characters</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="txtDeskripsi_e">Deskripsi</label>
                                        <textarea type="text" id="txtDeskripsi_e"
                                            onfocus="$.queryLength(this,'#cnt-dk_e');" rows="4" cols="50"
                                            maxlength="155" placeholder="ex.: Ini adalah.." class="form-control"
                                            required></textarea>
                                        <span class="float-right"><i id="cnt-dk_e">0</i> : 155 characters</span>
                                    </div>
                                </div>
                                <div class="col-12 col-xs-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="txtImg_e">Image</label>
                                        <div class="input-group">
                                            <input type="text" id="txtImg_e" class="form-control" required>
                                            <div class="input-group-append" onclick="$.search_img();">
                                                <div class="input-group-text"><i class="fa fa-images"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="txtAuthor_e">Author</label>
                                        <div class="input-group">
                                            <input type="text" id="txtAuthor_e"
                                                onfocus="$.queryLength(this,'#cnt-au_e');" maxlength="60"
                                                placeholder="TIM KAMI" class="form-control " required>
                                        </div>
                                        <span class="float-right"><i id="cnt-au_e">0</i> : 60 characters</span>
                                    </div>
                                    <div class="form-group ">
                                        <label for="txtKeyword_e">Keyword</label>
                                        <div class="input-group">
                                            <input type="text" id="txtKeyword_e"
                                                onfocus="$.queryLength(this,'#cnt-ky_e');" maxlength="500"
                                                value="rsud,leuwiliang" class="form-control" required>
                                        </div>
                                        <span class="float-right"><i id="cnt-ky_e">0</i> : 500 characters</span>
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