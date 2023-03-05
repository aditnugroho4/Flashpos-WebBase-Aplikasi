<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php $this->load->view('admin/menu/master/function/f_unit')?>
<div class="col-md-12">
    <div class="card card-outline card-yellow">
        <div class="card-header row">
            <h3 class="card-title col-lg-4 col-sm-12 mb-2">Data Unit / Bagian</h3>
            <div class="card-tools col-lg-8 col-sm-12">
                <div class="mailbox-controls float-right">
                    <button type="button" id="btnAdd" class="btn btn-app bg-green btn-sm"><i
                            class="fas fa-file-alt"></i>Tambah Data</button>
                    <!-- <button type="button" id="btnEdit" class="btn btn-app bg-yellow btn-sm"><i
                            class="fas fa-edit"></i>Edit</button>
                    <button type="button" id="btnDell" class="btn btn-app bg-danger btn-sm"><i
                            class="fas fa-eraser"></i>Delete</button> -->
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
<div id="frm-add" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
    <div role="document" class="modal-dialog">
        <div class="modal-content modal-col-light-blue">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data</h4>
            </div>
            <div class="modal-body">
                <div class="card card-primary">
                    <div class="card-header">
                        <p>Data Unit / Bagian di Bawah Divisi</p>
                    </div>
                    <form id="add-data">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="cmbStruktur">Divisi</label>
                                <select id="cmbStruktur" name="Struktur" class="form-control" required></select>
                            </div>
                            <div class="form-group">
                                <label for="txtName">Unit / Bagian</label>
                                <input type="text" id="txtName" name="Unit" placeholder="ex.: Divisi Oprasional"
                                    class="form-control" required>
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