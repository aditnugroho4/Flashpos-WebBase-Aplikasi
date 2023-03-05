<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php $this->load->view('admin/menu/master/function/f_user');?>
<style>
.ui-autocomplete {

    position: absolute;
    top: 0;
    left: 0;

    cursor: default;
    z-index: 9050 !important;
}
</style>
<div class="col-md-12">
    <div class="card card-outline card-yellow">
        <div class="card-header row">
            <h3 class="card-title col-lg-4 col-sm-12 mb-2">Data Username</h3>
            <div class=" card-tools col-lg-8 col-sm-12">
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
<div id="frm-add" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" class="modal fade text-left">
    <div role="document" class="modal-dialog modal-lg">
        <div class="modal-content modal-col-light-blue">
            <div class="modal-header">
                <h4 id="exampleModalLabel" class="modal-title">Tambah Data</h4>
            </div>
            <div class="modal-body">
                <div class="card card-primary">
                    <div class="card-header">
                        <p>Data Username Backend Dashboard</p>
                    </div>
                    <form id="add-data">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Cari Data Pegawai</label>
                                        <div class="input-group">
                                            <input id="txtSearch" class="form-control" type="text" maxlength="100"
                                                placeholder="Search">
                                            <div class="input-group-append">
                                                <span class="input-group-text btn search"><i class="fas fa-search"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="txtNama">Nama Lengkap</label>
                                        <input id="txtNama" type="text" placeholder="Nama Lengkap" class="form-control"
                                            required disabled="disabled">
                                    </div>
                                    <div class="form-group">
                                        <label for="txtNip">No NIP</label>
                                        <input id="txtNip" type="text" placeholder="Nip Pegawai" class="form-control"
                                            required disabled="disabled">
                                    </div>
                                    <div class="form-group">
                                        <label for="txtEmail">Email</label>
                                        <input id="txtEmail" type="email" placeholder="exsample@nugroho.co.id"
                                            class="form-control" disabled="disabled" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="cmbRole">Role</label>
                                        <select id="cmbRole" class="form-control" required></select>
                                    </div>
                                    <div class="form-group">
                                        <label for="txtUsername">Username</label>
                                        <input id="txtUsername" type="text" placeholder="Username login."
                                            class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="txtPassword">New Password</label>
                                        <input id="txtPassword" type="password" placeholder="Password login."
                                            class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="txtRepassword">Re Password</label>
                                        <input type="password" id="txtRepassword" placeholder="Username login."
                                            class="form-control" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-secondary waves-effect">Close</button>
            </div>
        </div>
    </div>
</div>
<div id="dlgEditPassword" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true"
    class="modal fade text-left">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ganti Password</h5>
            </div>
            <div class="modal-body">
                <div class="card card-primary">
                    <div class="card-header">
                        <p>Edit Password</p>
                    </div>
                    <form id="editPassword">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="txtNamas">Nama Lengkap</label>
                                <input id="txtNamas" type="text" placeholder="Nama Lengkap" class="form-control"
                                    autofocus required>
                            </div>
                            <div class="form-group">
                                <label for="txtUsernames">Username</label>
                                <input id="txtUsernames" type="text" placeholder="Username login." class="form-control"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="txtPasswordBaru">New Password</label>
                                <input id="txtPasswordBaru" type="password" placeholder="Password Baru"
                                    class="form-control" required>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                        </from>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>