<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php $this->load->view('admin/menu/master/function/f_menu'); ?>
<div class="col-md-12">
    <div class="card card-outline card-yellow">
        <div class=" card-header">
            <h3 class="card-title">Data Menu Utama</h3>
            <div class=" card-tools">
                <div class="mailbox-controls">
                    <button type="button" id="btnAdd" class="btn btn-app bg-green btn-sm"><i
                            class="fas fa-file-alt"></i>Tambah Data</button>
                    <!-- <button type="button" id="btnEdit" class="btn btn-app bg-yellow btn-sm"><i
                            class="fas fa-edit"></i>Edit</button>
                    <button type="button" id="btnDell" class="btn btn-app bg-danger btn-sm"><i
                            class="fas fa-eraser"></i>Hapus</button> -->
                    <button type="button" id="btnReload" class="btn btn-app bg-info btn-sm"><i
                            class="fas fa-sync-alt"></i>Refresh</button>
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
<!-- Dialog Form -->
<div id="frm-add" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Data</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Tambah Menu Utama</h3>
                    </div>
                    <form role="form" id="add-data">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="cmbUnit">Unit Bagian</label>
                                <div class="form-group">
                                    <select id="cmbUnit" name="unit" class="form-control" required></select>
                                </div>
                            </div>
                        </div>
                        <div class=" card-footer">
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