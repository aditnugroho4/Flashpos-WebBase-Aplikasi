<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php $this->load->view('admin/menu/website/function/f_edit_services'); ?>
<div class="col-12">
    <div class="card card-outline card-success load-ding">
        <div class=" card-header">
            <h3 class="card-title">Data Gallery</h3>
            <div class=" card-tools">
                <div class="mailbox-controls">
                    <button type="button" id="btnUpload" class="btn btn-app bg-pink btn-sm" data-toggle="tooltip"
                        data-placement="top" title="Upload Gambar"><i class="fas fa-upload"></i>Upload</button>
                    <button type="button" id="btnSetting" class="btn btn-app bg-yellow btn-sm" data-toggle="tooltip"
                        data-placement="top" title="Setting"><i class="fas fa-wrench"></i>Setting</button>
                    <button type="button" id="btnLink" class="btn btn-app bg-green btn-sm" data-toggle="tooltip"
                        data-placement="top" title="Permalink"><i class="fas fa-link"></i>Permalink</button>
                    <button type="button" id="btnReload" class="btn btn-app bg-info btn-sm" data-toggle="tooltip"
                        data-placement="top" title="Refresh"><i class="fas fa-sync-alt"></i>Refresh</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="card card-primary list-product card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="ion ion-clipboard mr-1"></i>
                        List Product & Services
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
                <!-- <div class="card-footer clearfix">
                        <button type="button" id="new-artikel" class="btn btn-info float-right"><i class="fas fa-plus"></i> Add Blog</button>
                    </div> -->
            </div>
            <div class="card card-primary card-outline edit-product" style="display:none;">
                <div class="card-header">
                    <h3 class="card-title">Edit Data Product</h3>
                </div>
                <form id="edit-Product" action="POST">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-lg-8 col-md-12">
                                        <div class="form-group">
                                            <label for="e_img">Gambar Utama</label>
                                            <div class="col-lg-12">
                                                <img id="e_img"
                                                    src="<?= base_url('asset/admin/images/alert/cns-1.jpg')?>"
                                                    alt="gambar utama" height="250"
                                                    class="col-sm-12 col-lg-8 offset-sm-0 offset-lg-2">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="txtNama">Nama Layanan</label>
                                            <input id="txtNama" class="form-control" placeholder="ex : Ruang Khusus"
                                                onfocus="$.queryLength(this,'#cnt-lbnma_e');" maxlength="50">
                                            <span class="float-right"><i id="cnt-lbnma_e">0</i> : 50
                                                characters</span>
                                        </div>
                                        <div class="form-group">
                                            <label for="txtLabel">Label</label>
                                            <input id="txtLabel" class="form-control"
                                                placeholder="ex : Melayanani Dengan Hati.."
                                                onfocus="$.queryLength(this,'#cnt-jdl_e');" maxlength="100">
                                            <span class="float-right"><i id="cnt-jdl_e">0</i> : 100
                                                characters</span>
                                        </div>
                                        <div class="form-group">
                                            <label for="txtDescproduk">Deskripsi Layanan</label>
                                            <textarea id="txtDescproduk" class="form-control" col="5" row="4"
                                                placeholder="ex : Layanan Prima kami.."
                                                onfocus="$.queryLength(this,'#cnt-des');" maxlength="500"></textarea>
                                            <span class="float-right"><i id="cnt-des">0</i> : 500
                                                characters</span>
                                        </div>
                                        <div class="form-group">
                                            <label for="txtContent">Content</label>
                                            <textarea id="txtContent" class="form-control"
                                                style="min-height: 300px;"> </textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <div class="card card-pink card-outline">
                                            <div class="card-header">
                                                <p>Optimasi Pencarian</p>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="txtTitle">Title</label>
                                                    <input id="txtTitle" class="form-control"
                                                        placeholder="ex : Layanan | Tentang Produk"
                                                        onfocus="$.queryLength(this,'#cnt-tl_e');" maxlength="60">
                                                    <span class="float-right"><i id="cnt-tl_e">0</i> : 60
                                                        characters</span>
                                                </div>
                                                <div class="form-group">
                                                    <label for="txtDeskripsi">Deskripsi</label>
                                                    <textarea id="txtDeskripsi" class="form-control" col="5" row="4"
                                                        placeholder="ex : Wedding Organizer"
                                                        onfocus="$.queryLength(this,'#cnt-des_e');"
                                                        maxlength="155"></textarea>
                                                    <span class="float-right"><i id="cnt-des_e">0</i> : 155
                                                        characters</span>
                                                </div>
                                                <div class="form-group">
                                                    <label for="txtImg_e">Image</label>
                                                    <div class="input-group">
                                                        <input type="text" id="txtImg_e" class="form-control" required>
                                                        <div class="input-group-append" onclick="$.search_img();">
                                                            <div class="input-group-text"><i class="fa fa-images"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label for="txtAuthor_e">Author</label>
                                                    <div class="input-group">
                                                        <input type="text" id="txtAuthor_e"
                                                            onfocus="$.queryLength(this,'#cnt-au_e');" maxlength="60"
                                                            placeholder="akbargrup wedding planner"
                                                            class="form-control " required>
                                                    </div>
                                                    <span class="float-right"><i id="cnt-au_e">0</i> : 60
                                                        characters</span>
                                                </div>
                                                <div class="form-group ">
                                                    <label for="txtKeyword_e">Keyword</label>
                                                    <div class="input-group">
                                                        <input type="text" id="txtKeyword_e"
                                                            onfocus="$.queryLength(this,'#cnt-ky_e');" maxlength="500"
                                                            value="artikel,sedang,viral" class="form-control" required>
                                                    </div>
                                                    <span class="float-right"><i id="cnt-ky_e">0</i> : 500
                                                        characters</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="float-right">
                            <button type="button" id="btn-draft" class="btn btn-app bg-yellow"><i
                                    class="fas fa-pencil-alt"></i>
                                Draft</button>
                            <button type="submit" id="btn-simpan" class="btn btn-app bg-blue"><i
                                    class="far fa-envelope"></i>
                                Simpan</button>
                        </div>
                        <button type="button" id="btn-reset" class="btn btn-app bg-yellow"><i class="fas fa-times"></i>
                            Discard</button>
                    </div>
                </form>
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
<?php $this->load->view('admin/menu/website/html/h_web_upload');?>
<?php $this->load->view('admin/menu/website/html/h_edit_permalink');?>