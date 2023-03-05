<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    $this->load->view('admin/menu/website/function/f_ctgr_elibrary'); 
?>
<div class="col-md-12">
    <div class="card card-outline">
        <div class=" card-header">
            <h3 class="card-title">Katagori E-Library</h3>
            <div class=" card-tools">
                <div class="mailbox-controls">
                    <button type="button" id="btnAdd" class="btn btn-default bg-green btn-sm"><i
                            class="fas fa-file-alt"></i></button>
                    <button type="button" id="btnSetting" class="btn btn-default bg-warning btn-sm"><i
                            class="fas fa-wrench"></i></button>
                    <button type="button" id="btnLink" class="btn btn-default bg-pink btn-sm"><i
                            class="fas fa-link"></i></button>
                    <button type="button" id="btnDell" class="btn btn-default bg-danger btn-sm"><i
                            class="fas fa-eraser"></i></button>
                    <button type="button" id="btnReload" class="btn btn-default bg-info btn-sm"><i
                            class="fas fa-sync-alt"></i></button>
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
<div id="frm-add" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade ">
    <div role="document" class="modal-dialog">
        <div class="modal-content modal-col-light-blue load-ding-add">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data</h4>
            </div>
            <div class="modal-body">
                <div class="card card-primary">
                    <div class="card-header">
                        <p>Data Kategory / Untuk Filter Product</p>
                    </div>
                    <form id="add-data">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="txtName">Nama Kategory</label>
                                <input type="text" id="txtName" placeholder="ex.: Product katagory" class="form-control"
                                    required>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
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