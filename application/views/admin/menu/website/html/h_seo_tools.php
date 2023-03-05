<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); $this->load->view('admin/menu/website/function/f_seo_tools'); ?>
<div class="col-md-12">
    <div class="card card-outline card-success load-ding">
        <div class=" card-header">
            <h3 class="card-title">Data Blog / Artikel</h3>
            <div class=" card-tools">
                <div class="mailbox-controls">
                    <button class="btn btn-app bg-green btn-sm" id="btnAdd">
                        <i class="fas fa-file-alt"></i> Add
                    </button>
                    <button class="btn btn-app bg-pink btn-sm" id="btnLink">
                        <i class="fas fa-link"></i> Permalink
                    </button>
                    <button class="btn btn-app bg-warning btn-sm" id="btnSetting">
                        <i class="fas fa-wrench"></i> Setting
                    </button>
                    <button class="btn btn-app bg-maroon btn-sm" id="btnSitemaps">
                        <i class="fas fa-rss"></i> Sitemaps
                    </button>
                    <button class="btn btn-app bg-info btn-sm" id="btnReload">
                        <i class="fas fa-sync"></i> Reload
                    </button>
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
<div id="frm-add" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade" data-backdrop="static">
    <div role="document" class="modal-dialog modal-lg">
        <div class="modal-content modal-col-light-blue load-ding-add">
            <div class="modal-body">
                <div class="card card-primary">
                    <div class="card-header">
                        <p>Tag Optemaizer</p>
                    </div>
                    <form id="add-data">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-xs-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="txtTitle">Title</label>
                                        <input type="text" id="txtTitle" maxlength="60"
                                            onfocus="$.queryLength(this,'#cnt-Tl');"
                                            placeholder="ex.: Home | Akbar Grup Paket Wedding" class="form-control"
                                            required>
                                        <span class="float-right"><i id="cnt-Tl">0</i> : 60 characters</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="txtDeskripsi">Deskripsi</label>
                                        <textarea type="text" id="txtDeskripsi" rows="4" cols="50" maxlength="155"
                                            onfocus="$.queryLength(this,'#cnt-Ds');"
                                            placeholder="ex.: Promo tahun ini dari akbar" class="form-control"
                                            required></textarea>
                                        <span class="float-right"><i id="cnt-Ds">0</i> : 155 characters</span>
                                    </div>
                                    <div class="form-group ">
                                        <label for="txtKeyword">Keyword</label>
                                        <div class="input-group">
                                            <input type="text" id="txtKeyword" maxlength="500"
                                                onfocus="$.queryLength(this,'#cnt-Ky');" value="akbargrup,wedding bogor"
                                                class="form-control " required>
                                            <span class="float-right"><i id="cnt-Ky">0</i> : 500 characters</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-xs-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="txtIcon">Image Shared</label>
                                        <div class="input-group">
                                            <input type="text" id="txtIcon" class="form-control" required>
                                            <div class="input-group-append" onclick="$.search_img();">
                                                <div class="input-group-text"><i class="fa fa-images"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="txtAuthor">Author</label>
                                        <input type="text" id="txtAuthor" placeholder="ex.: Akbar Grup" maxlength="60"
                                            onfocus="$.queryLength(this,'#cnt-Aut');" class="form-control" required>
                                        <span class="float-right"><i id="cnt-Aut">0</i> : 60 characters</span>
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
<?php $this->load->view('admin/menu/website/html/h_edit_permalink'); ?>
<div id="frm-find-img" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true" class="modal fade">
    <div role="document" class="modal-dialog">
        <div class="modal-content modal-col-light-blue ">
            <div class="modal-body">
                <div class="card card-primary">
                    <div class="card-header">
                        <p>Pilih Gambar Untuk Image Shared</p>
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
<div id="frm-edit" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade" data-backdrop="static">
    <div role="document" class="modal-dialog modal-lg">
        <div class="modal-content modal-col-light-blue load-ding-edit">
            <div class="modal-body">
                <div class="card card-primary">
                    <div class="card-header">
                        <p>Edit Tag Optemaizer</p>
                    </div>
                    <form id="edit-data">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-xs-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="txtTitle_e">Title</label>
                                        <input type="text" id="txtTitle_e" maxlength="60"
                                            onfocus="$.queryLength(this,'#cnt-Te');"
                                            placeholder="ex.: Home | Akbar Grup Paket Wedding" class="form-control"
                                            required>
                                        <span class="float-right"><i id="cnt-Te">0</i> : 60 characters</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="txtDeskripsi_e">Deskripsi</label>
                                        <textarea type="text" id="txtDeskripsi_e" rows="4" cols="50" maxlength="150"
                                            onfocus="$.queryLength(this,'#cnt-De');"
                                            placeholder="ex.: Promo tahun ini dari akbar" class="form-control"
                                            required></textarea>
                                        <span class="float-right"><i id="cnt-De">0</i> : 150 characters</span>
                                    </div>
                                    <div class="form-group ">
                                        <label for="txtKeyword_e">Keyword</label>
                                        <div class="input-group">
                                            <input type="text" id="txtKeyword_e" maxlength="500"
                                                onfocus="$.queryLength(this,'#cnt-Ke');" value="akbargrup,wedding bogor"
                                                class="form-control " required>
                                        </div>
                                        <span class="float-right"><i id="cnt-Ke">0</i> : 500 characters</span>
                                    </div>
                                </div>
                                <div class="col-12 col-xs-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="txtIcon_e">Image Shared</label>
                                        <div class="input-group">
                                            <input type="text" id="txtIcon_e" class="form-control" required>
                                            <div class="input-group-append" onclick="$.search_img();">
                                                <div class="input-group-text"><i class="fa fa-images"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="_e">Author</label>
                                        <input type="text" id="txtAuthor_e" maxlength="60"
                                            onfocus="$.queryLength(this,'#cnt-Ae');" placeholder="ex.: Akbar Grup"
                                            class="form-control" required>
                                        <span class="float-right"><i id="cnt-Ae">0</i> : 60 characters</span>
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
<div id="frm-create-sitemaps" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true" class="modal fade ">
    <div role="document" class="modal-dialog modal-lg">
        <div class="modal-content modal-col-orange ">
            <div class="modal-body">
                <div class="card card-primary">
                    <div class="card-header">
                        <p>Sitemaps XML</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="xmlSitemaps">Sitemaps.xml</label>
                                <textarea id="xmlSitemaps" class="form-control" style="min-height: 450px;"> </textarea>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="button" id="btn-simpan-sitempas"
                            class="btn btn-primary float-right">Simpan</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-secondary">Close</button>
            </div>
        </div>
    </div>
</div>