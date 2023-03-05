<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('admin/menu/website/function/f_edit_blog'); ?>
<div class="col-md-12">
    <div class="card card-outline card-success load-ding">
        <div class=" card-header">
            <h3 class="card-title">Data Blog / Artikel</h3>
            <div class=" card-tools">
                <div class="mailbox-controls">
                    <button type="button" id="btnAdd" class="btn btn-app bg-green btn-sm" data-toggle="tooltip"
                        data-placement="top" title="Tambah Data"><i class="fas fa-file-alt"></i>Add Data</button>
                    <button type="button" id="btnUpload" class="btn btn-app bg-pink btn-sm" data-toggle="tooltip"
                        data-placement="top" title="Upload Data"><i class="fas fa-upload"></i>Upload</button>
                    <button type="button" id="btnSetting" class="btn btn-app bg-yellow btn-sm" data-toggle="tooltip"
                        data-placement="top" title="Setting Link"><i class="fas fa-wrench"></i>Setting</button>
                    <button type="button" id="btnLink" class="btn btn-app bg-warning btn-sm" data-toggle="tooltip"
                        data-placement="top" title="Setting Permalink"><i class="fas fa-link"></i>PErmalink</button>
                    <button type="button" id="btnReload" class="btn btn-app bg-info btn-sm" data-toggle="tooltip"
                        data-placement="top" title="Refresh"><i class="fas fa-sync-alt"></i>Refresh</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 list-artikel">
                    <div class="card card-outline  card-primary">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="ion ion-clipboard mr-1"></i>
                                List Blog
                            </h3>
                            <div id="pagination"></div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <ul class="todo-list" data-widget="todo-list">
                                <li>
                                    <span class="handle">
                                        <i class="fas fa-ellipsis-v"></i>
                                        <i class="fas fa-ellipsis-v"></i>
                                    </span>
                                    <div class="icheck-primary d-inline ml-2">
                                        <input type="checkbox" value="" name="todo1" id="todoCheck1">
                                        <label for="todoCheck1"></label>
                                    </div>
                                    <span class="text">Design a nice theme</span>
                                    <small class="badge badge-danger"><i class="far fa-clock"></i> 2 mins</small>
                                    <div class="tools">
                                        <i class="fas fa-edit"></i>
                                        <i class="fas fa-trash-o"></i>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            <i class="fas fa-plus">Add Blog</i>
                        </div>
                    </div>
                </div>
                <div class="col-12 post-add-artikel " style="display:none;">
                    <form id="add-Artikel" action="POST">
                        <div class="row load-ding-add">
                            <div class="col-sm-12 col-md-8 col-lg-8">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <p>Buat Data Content</p>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="imgAdd">Gambar Utama</label>
                                            <div class="col-lg-12">
                                                <img id="imgAdd"
                                                    src="<?= base_url('asset/admin/images/alert/cns-1.jpg')?>"
                                                    alt="gambar utama" height="250"
                                                    class="col-sm-12 col-lg-8 offset-sm-0 offset-lg-2">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="txtJudul">Judul</label>
                                            <input id="txtJudul" class="form-control" placeholder="Judul:"
                                                onfocus="$.queryLength(this,'#cnt-Jd');" maxlength="150">
                                            <span class="float-right"><i id="cnt-Jd">0</i> : 150
                                                characters</span>
                                        </div>
                                        <div class="form-group">
                                            <label for="txtQuote">Tambahkan Quote</label>
                                            <textarea id="txtQuote" class="form-control" placeholder="Judul:" col="4"
                                                row="10" onfocus="$.queryLength(this,'#cnt-Quo');"
                                                maxlength="255"></textarea>
                                            <span class="float-right"><i id="cnt-Quo">0</i> : 255
                                                characters</span>
                                        </div>
                                        <div class="form-group">
                                            <label for="txtArtikel">Artikel</label>
                                            <textarea id="txtArtikel" class="form-control"
                                                style="min-height:650px;"> </textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4">
                                <div class="card card-green">
                                    <div class="card-header">
                                        <p>Content Optemaizer</p>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="txtTitle">Title</label>
                                            <input type="text" id="txtTitle" onfocus="$.queryLength(this,'#cnt-Tl');"
                                                maxlength="60" placeholder="ex.: Home | Judul Artikel"
                                                class="form-control" required>
                                            <span class="float-right"><i id="cnt-Tl">0</i> : 60
                                                characters</span>
                                        </div>
                                        <div class="form-group">
                                            <label for="txtDeskripsi">Deskripsi</label>
                                            <textarea type="text" id="txtDeskripsi" col="4" row="5"
                                                onfocus="$.queryLength(this,'#cnt-Des');" maxlength="150"
                                                placeholder="ex.: Deskripsi singkat artikel" class="form-control"
                                                required></textarea>
                                            <span class="float-right"><i id="cnt-Des">0</i> : 150
                                                characters</span>
                                        </div>
                                        <div class="form-group ">
                                            <label for="txtKeyword">Keyword</label>
                                            <div class="input-group">
                                                <input type="text" id="txtKeyword" maxlength="500"
                                                    value="berita,viral,hotnews" class="form-control " required>
                                                <span class="float-right"><i id="cnt-Key">0</i> : 500
                                                    characters</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="txtImg">Gambar Utama</label>
                                            <div class="input-group">
                                                <input type="text" id="txtImg" class="form-control" required>
                                                <div class="input-group-append" onclick="$.search_img();">
                                                    <div class="btn bg-purple input-group-text"><i
                                                            class="fa fa-images"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="txtAuthor">Author</label>
                                            <input type="text" id="txtAuthor" onfocus="$.queryLength(this,'#cnt-Aut');"
                                                maxllength="60" placeholder="ex.: Si Penulis" class="form-control"
                                                required>
                                            <span class="float-right"><i id="cnt-Aut">0</i> : 60
                                                characters</span>
                                        </div>
                                        <div class="form-group">
                                            <label for="txtShortLink">Slug</label>
                                            <input type="text" id="txtShortLink"
                                                onfocus="$.queryLength(this,'#cnt-Shor');" maxlength="70"
                                                class="form-control" disabled="true" required>
                                            <span class="float-right"><i id="cnt-Shor">0</i> : 70
                                                characters</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="card card-cyan">
                                    <div class="card-header">
                                        <p>Keterangan Content</p>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="cmbCtgr">Kategory</label>
                                            <select id="cmbCtgr" class="form-control" required></select>
                                        </div>
                                        <div class="form-group">
                                            <label for="txtSumber">Sumber</label>
                                            <div class="input-group">
                                                <input type="text" id="txtSumber" value="humas,situs resmi,"
                                                    class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="txtReviewed">Di Reviewd</label>
                                            <input type="text" id="txtReviewed" maxlength="150"
                                                placeholder="ex : Di koreksi oleh" class="form-control" required />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="float-right">
                                <button type="submit" class="btn btn-app bg-blue"><i class="far fa-envelope"></i>
                                    Simpan</button>
                            </div>
                            <button type="reset" id="btn-reset" class="btn btn-app bg-yellow"><i
                                    class="fas fa-times"></i>
                                Batal</button>
                        </div>
                    </form>
                </div>
                <div class="col-12 post-edit-artikel" style="display:none;">
                    <form id="edit-Artikel" action="POST">
                        <div class="row">
                            <div class="col-sm-12 col-md-8 col-lg-8">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <p>Data Content</p>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="e_img">Gambar Utama</label>
                                            <div class="col-lg-12">
                                                <img id="e_img" src="" alt="gambar utama" height="250"
                                                    class="col-sm-12 col-lg-8 offset-sm-0 offset-lg-2">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="txtJudul_e">Judul</label>
                                            <input id="txtJudul_e" class="form-control"
                                                onfocus="$.queryLength(this,'#cnt-jd_e');" placeholder="Judul:"
                                                maxlength="150">
                                            <span class="float-right"><i id="cnt-jd_e">0</i> : 150
                                                characters</span>
                                        </div>
                                        <div class="form-group">
                                            <label for="txtQuote_e">Tambahkan Quote</label>
                                            <textarea id="txtQuote_e" class="form-control" placeholder="Judul:" col="4"
                                                row="10" onfocus="$.queryLength(this,'#cnt-Quo_e');"
                                                maxlength="255"></textarea>
                                            <span class="float-right"><i id="cnt-Quo_e">0</i> : 255
                                                characters</span>
                                        </div>
                                        <div class="form-group">
                                            <label for="txtArtikel_e">Artikel</label>
                                            <textarea id="txtArtikel_e" class="form-control"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <button type="button" class="btn btn-warning btn-load">load</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4">
                                <div class="card card-green">
                                    <div class="card-header">
                                        <p>Content Optemaizer</p>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="txtTitle">Title</label>
                                            <input type="text" id="txtTitle_e"
                                                onfocus="$.queryLength(this,'#cnt-tl_e');" maxlength="60"
                                                placeholder="ex.: Home | Judul artikel " class="form-control" required>
                                            <span class="float-right"><i id="cnt-tl_e">0</i> : 60
                                                characters</span>
                                        </div>
                                        <div class="form-group">
                                            <label for="txtDeskripsi_e">Deskripsi</label>
                                            <textarea type="text" id="txtDeskripsi_e" col="4" row="5"
                                                onfocus="$.queryLength(this,'#cnt-des_e');" maxlength="150"
                                                placeholder="ex.: Deskripsi singkat artikel" class="form-control"
                                                required></textarea>
                                            <span class="float-right"><i id="cnt-des_e">0</i> : 150
                                                characters</span>
                                        </div>
                                        <div class="form-group ">
                                            <label for="txtKeyword_e">Keyword</label>
                                            <div class="input-group">
                                                <input type="text" id="txtKeyword_e"
                                                    onfocus="$.queryLength(this,'#cnt-key_e');"
                                                    value="berita,viral,jawa barat" class="form-control " required>
                                                <span class="float-right"><i id="cnt-key_e">0</i> : 500
                                                    characters</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="txtImg_e">Gambar Utama</label>
                                            <div class="input-group">
                                                <input type="text" id="txtImg_e" class="form-control" required>
                                                <div class="input-group-append" onclick="$.search_img();">
                                                    <div class="btn bg-purple input-group-text"><i
                                                            class="fa fa-images"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="txtAuthor_e">Author</label>
                                            <input type="text" id="txtAuthor_e"
                                                onfocus="$.queryLength(this,'#cnt-aut_e');"
                                                placeholder="ex.: Akbar Grup" class="form-control" required>
                                            <span class="float-right"><i id="cnt-aut_e">0</i> : 60
                                                characters</span>
                                        </div>
                                        <div class="form-group">
                                            <label for="txtShortLink_e">Slug</label>
                                            <input type="text" id="txtShortLink_e"
                                                onfocus="$.queryLength(this,'#cnt-Sho_e');" maxlength="70"
                                                class="form-control" disabled="true" required>
                                            <span class="float-right"><i id="cnt-Sho_e">0</i> : 70
                                                characters</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="card card-cyan">
                                    <div class="card-header">
                                        <p>Keterangan Content</p>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="cmbCtgr_e">Kategory</label>
                                            <select id="cmbCtgr_e" class="form-control" required></select>
                                        </div>
                                        <div class="form-group">
                                            <label for="txtSumber_e">Sumber</label>
                                            <div class="input-group">
                                                <input type="text" id="txtSumber_e" value="google.com"
                                                    class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="txtReviewed_e">Di Reviewd</label>
                                            <input type="text" id="txtReviewed_e" maxlength="200"
                                                placeholder="ex : Di Koreksi " class="form-control" required />
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="float-right">
                                            <button type="button" id="btn-batal-edit" class="btn btn-app bg-yellow"><i
                                                    class="fas fa-times"></i> Batal</button>
                                            <button type="submit" class="btn btn-app bg-blue"><i
                                                    class="far fa-envelope"></i>
                                                Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
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
<div id="dlg-edit-status" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade text-left">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pilihan Lanjutan</h5>
            </div>
            <div class="modal-body">
                <p id="txt-status"></p>
            </div>
            <div class="modal-footer">
                <button type="button" id="btn-status" class="btn bg-green waves-effect">Prosess</button>
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->
<?php $this->load->view('admin/menu/website/html/h_web_upload');?>
<?php $this->load->view('admin/menu/website/html/h_edit_permalink');?>