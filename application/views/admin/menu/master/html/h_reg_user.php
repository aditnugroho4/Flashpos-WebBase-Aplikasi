<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php $this->load->view('admin/menu/master/function/f_reg_user');?>
<div class="col-md-12">
    <div class="card card-outline card-yellow">
        <div class="card-header row">
            <h3 class="card-title col-lg-4 col-sm-12 mb-2">Data Registrasi</h3>
            <div class=" card-tools col-lg-8 col-sm-12">
                <div class="mailbox-controls float-right">
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
<div id="dlgDecision" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade text-left">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pilihan Lanjutan</h5>
            </div>
            <div class="modal-body">
                <p id="txtDecision"></p>
            </div>
            <div class="modal-footer">
                <button type="button" id="btn-prosess" class="btn bg-green waves-effect">Prosess</button>
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div id="dlgAlert" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade text-left">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Aktive Content</h5>
            </div>
            <div class="modal-body">
                <p id="lblText"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-yellow waves-effect" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>