<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php $this->load->view('admin/menu/master/function/f_struktur');?>
<div class="col-md-12">
    <div class="card card-outline card-yellow">
        <div class=" card-header row">
            <h3 class="card-title col-lg-4 col-sm-12 mb-2">Data Divisi</h3>
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
<!-- Modal -->
<div id="frm-add" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content modal-col-light-blue">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data</h4>
            </div>
            <div class="modal-body">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Divisi</h3>
                    </div>
                    <form role="form" id="add-data">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="txtCode">Kode</label>
                                <?php
                    $query=R::count("m_struktur")+1;
                    $angka= str_pad($query,3,"0",STR_PAD_LEFT);
                    echo "<input type='text' id='txtCode' disabled='disabled' value='".$angka."' class='form-control' required>";
                    ?>
                            </div>
                            <div class="form-group">
                                <label for="txtStruktural">Divisi</label>
                                <input type="text" class="form-control" id="txtStruktural" placeholder="Direktur..exc"
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