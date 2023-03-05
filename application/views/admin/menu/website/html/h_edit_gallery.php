<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php $this->load->view('admin/menu/website/function/f_edit_gallery'); ?>
<div class="col-12">
    <div class="card card-outline card-success">
        <div class=" card-header">
            <h3 class="card-title">Data Gallery</h3>
            <div class=" card-tools">
                <div class="mailbox-controls">
                    <button type="button" id="btnUpload" class="btn btn-app bg-pink btn-sm" data-toggle="tooltip"
                        data-placement="top" title="Upload Gambar"><i class="fas fa-upload"></i>Upload</button>
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
<div class="col-12">
    <div class="card card-outline card-primary">
        <div class="card-header">
            <div class="card-title">
                Images Album
            </div>
        </div>
        <div class="card-body">
            <div>
                <div class="btn-group w-100 mb-2 ctgr-label row">
                </div>
                <div class="mb-2">
                    <div class="row">
                        <div class="col-xs-12 col-4">
                            <a class="btn btn-secondary mb-1" href="javascript:void(0)" data-shuffle="">
                                Shuffle items</a>
                        </div>
                        <div class="col-xs-12 col-8 float-right">
                            <select class="custom-select" style="width: auto;" data-sortorder="">
                                <option value="index"> Sort by Position </option>
                                <option value="sortData"> Sort by Custom Data </option>
                            </select>
                            <div class="btn-group">
                                <a class="btn btn-app" href="javascript:void(0)" data-sortasc="">
                                    Ascending</a>
                                <a class="btn btn-app" href="javascript:void(0)" data-sortdesc="">
                                    Descending </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="filter-container">
                <div class="list-images row p-0">

                </div>
            </div>
        </div>
    </div>
</div>

<div id="dlg-resize-images" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true"
    class="modal fade text-left">
    <div role="document" class="modal-dialog modal-lg">
        <div class="modal-content modal-col-light-blue">
            <div class="modal-header">
                <h4 class="modal-title">From Setting</h4>
            </div>
            <div class="modal-body">
                <div class="card card-primary">
                    <div class="card-header">
                        <p>Resize Gambar</p>
                    </div>
                    <div class="card-body load-ding-resize">
                        <div class="col-lg-12 text-center">
                            <img width="500" height="100%" id="resize-show" class="mb-5" src="" alt="Resize">
                        </div>
                        <div class="col-lg-12 mt-5">
                            <label for="resize-show">Ukuran Gambar</label>
                            <p id="uk-width"></p>
                            <p id="uk-height"></p>
                            <p id="uk-size"></p>
                            <button type="button" id="resize-img" class="btn btn-circle float-right bg-fuchsia"><i
                                    class="fas fa-file-image"></i> Resize</button>
                            <button type="button" id="load-size" class="btn btn-circle float-right bg-cyan"><i
                                    class="fas fa-refresh"></i> Refresh</button>
                        </div>
                    </div>
                    <div class="card-footer">
                        <p>Setting Rasio Gambar Minimum 50%</p>
                    </div>
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
                                        <label for="txtNameModel">Nama Foto</label>
                                        <input type="text" id="txtNameModel" maxlength="60"
                                            placeholder="ex.: Ariel Tatum" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="txtKeter">Keterangan</label>
                                        <input type="text" id="txtKeter" maxlength="150" placeholder="ex.: Foto Gembira"
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