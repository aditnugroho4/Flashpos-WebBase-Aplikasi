<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<script>
$(document).ready(function() {
    $('.flex-column').find('.bg-green').removeClass('bg-green');
    $('.mn-2').addClass('bg-green');

    $("#tblData").dataTable({
        "bJQueryUI": true,
        "bAutoWidth": true,
        // "bProcessing": true,
        "bServerSide": true,
        "sPaginationType": "full_numbers",
        "sAjaxSource": "<?php echo site_url('admin/get_data_table_source'); ?>?table=n_web_monitoring&columns=,m_user.nama,lokasi,ipaddress,macaddress,browser",
        "aoColumns": [{
                "sTitle": "#",
                "mData": "no",
                "bSortable": false,
                "sClass": "center"
            },
            {
                "sTitle": "Lokasi",
                "mData": "lokasi"
            },
            {
                "sTitle": "Ipaddress",
                "mData": "ipaddress"
            },
            {
                "sTitle": "Mac Address",
                "mData": "macaddress"
            },
            {
                "sTitle": "Device",
                "mData": "browser"
            },
            {
                "sTitle": "Waktu",
                "mData": "tanggal"
            }
        ]
    });
});
</script>
<div class="col-md-12">
    <div class="card card-outline card-success">
        <div class=" card-header">
            <h3 class="card-title">Traffic Administrator</h3>
            <div class=" card-tools">
                <div class="mailbox-controls">
                    <button type="button" id="btnAdd" class="btn btn-default bg-green btn-sm" data-toggle="tooltip"
                        data-placement="top" title="Tambah Menu"><i class="fas fa-file-alt"></i></button>
                    <button type="button" id="btnEdit" class="btn btn-default bg-yellow btn-sm" data-toggle="tooltip"
                        data-placement="top" title="Edit Data"><i class="fas fa-edit"></i></button>
                    <button type="button" id="btnDell" class="btn btn-default bg-danger btn-sm" data-toggle="tooltip"
                        data-placement="top" title="Hapus Data"><i class="fas fa-eraser"></i></button>
                    <button type="button" id="btnAddSub" class="btn btn-default bg-pink btn-sm" data-toggle="tooltip"
                        data-placement="top" title="Tambah Sub Menu"><i class="fas fa-sitemap"></i></button>
                    <button type="button" id="btnReload" class="btn btn-default bg-info btn-sm" data-toggle="tooltip"
                        data-placement="top" title="Refresh"><i class="fas fa-sync-alt"></i></button>
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