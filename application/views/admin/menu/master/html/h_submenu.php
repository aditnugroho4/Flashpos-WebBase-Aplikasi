<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php $this->load->view('admin/menu/master/function/f_submenu'); ?>
<div class="col-md-12">
    <div class="card card-outline card-yellow">
        <div class=" card-header">
            <h3 class="card-title">Data SubMenu</h3>
            <div class=" card-tools">
                <div class="mailbox-controls">
                    <button type="button" id="btnAdd" class="btn btn-app bg-green btn-sm"><i
                            class="fas fa-file-alt"></i>Add Data</button>
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
<div id="frm-edit-submenu" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Setting Submenu</h4>
            </div>
            <div class="modal-body">
                <div class="card card-primary">
                    <div class="card-header">
                        <p>Pengaturan level posisi menu</p>
                    </div>
                    <form id="edit-data-submenu">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="txtNama_e">Nama Modul</label>
                                        <input id="txtNama_e" type="text" name="nama" placeholder="Nama Modul.."
                                            class="form-control" autofocus required>
                                    </div>
                                    <div class="form-group">
                                        <label for="cmbRole_e">Level / Role</label>
                                        <select id="cmbRole_e" class="form-control" required></select>
                                    </div>
                                    <div class="form-group">
                                        <label for="cmbNamaMenu_e">Grup Menu</label>
                                        <select id="cmbNamaMenu_e" class="form-control" required></select>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary float-right">Simpan</button>
                                <button type="button" data-dismiss="modal"
                                    class="btn btn-secondary float-right mr-2">Close</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div id="frm-add" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Modul Applikasi</h4>
            </div>
            <div class="modal-body">
                <div class="card card-primary">
                    <div class="card-header">
                        <p>Data Link Modul Applikasi</p>
                    </div>
                    <form id="add-data">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="txtContent">Nama Modul</label>
                                        <input id="txtContent" type="text" name="content" placeholder="Nama Modul.."
                                            class="form-control" autofocus required>
                                    </div>
                                    <div class="form-group">
                                        <label for="cmbUnit">Untuk Unit / Bagian</label>
                                        <select id="cmbUnit" class="form-control" required></select>
                                    </div>
                                    <div class="form-group">
                                        <label for="cmbRole">Level / Role</label>
                                        <select id="cmbRole" class="form-control" required></select>
                                    </div>
                                    <div class="form-group">
                                        <label for="cmbNamaMenu">Grup Menu</label>
                                        <select id="cmbNamaMenu" class="form-control" required></select>
                                    </div>
                                    <div class="form-group">
                                        <label for="txtUsername">Link Modul</label>
                                        <input id="txtFolder" type="text" name="Folder"
                                            placeholder="root/main/folder/html/" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary float-right">Simpan</button>
                                <button type="button" data-dismiss="modal"
                                    class="btn btn-secondary float-right mr-2">Close</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>