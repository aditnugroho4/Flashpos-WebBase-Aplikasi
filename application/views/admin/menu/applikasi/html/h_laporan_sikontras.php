<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<script>
$(document).ready(function() {
    $("#tblData").DataTable({
        "responsive": true,
        "bJQueryUI": false,
        "bPaginate": true,
        "bAutoWidth": false,
        "bLengthChange": false,
        "bFilter": true,
        "bSort": false,
        "bInfo": false,
        "bRetrieve": true,
        "iDisplayLength": 10,
        "sPaginationType": "full_numbers",
        "aoColumns": [{
                "sTitle": "#"
            },
            {
                "sTitle": "No.Aduan"
            },
            {
                "sTitle": "Tanggal"
            },
            {
                "sTitle": "Nama"
            },
            {
                "sTitle": "Nip"
            },
            {
                "sTitle": "Unit / Bagian"
            },
            {
                "sTitle": "Katagori"
            },
            {
                "sTitle": "Lokasi",
            },
            {
                "sTitle": "Jenis"
            },
            {
                "sTitle": "Deskripsi"
            },
            {
                "sTitle": "Status"
            },
            {
                "sTitle": "Tim Support"
            },
            {
                "sTitle": "Waktu"
            },
            {
                "sTitle": "Action",
                "sClass": "center",
                "mData": null,
                "fnCreatedCell": function(nTd, sData, oData, data, iRow, iCol) {
                    $(nTd).html("<button>Pilih</button>");
                    $($(nTd).children()[0]).button().click(function() {
                        idx = $($(this).parent().siblings()[0]).html() - 1;
                        row = $("#tblData").dataTable().fnGetData()[idx];
                        if ($("#tblData").dataTable().fnGetData().length > 0) {
                            $("#tblData tbody tr").each(function(index) {
                                $('#txtCari').val(row[1]);
                                $("#btnCari").click();
                                $("a[href='#daftar-pasien']").click();
                            });
                        }
                    });
                    $($(nTd).children()[0]).find("span").css("padding", "2px 7px");
                }
            }
        ]
    });
    $("#txtMulai,#txtSelesai").datepicker({
        dateFormat: "yy-mm-dd"
    });
});
</script>
<div class="col-md-12">
    <div class="card card-outline card-info load-ding">
        <div class=" card-header">
            <h3 class="card-title">Tentukan Tanggal</h3>
            <div class=" card-tools">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="input-group clockpicker pull-center" data-placement="left" data-align="top"
                            data-autoclose="true">
                            <div class="input-group-append input-group-addon">
                                <div data-placement="top" data-toggle="tooltip" title="Tanggal Mulai"
                                    class="btn btn-primary"><span class="icon-clock"> Start</span></div>
                            </div>
                            <input type="time" id="txtMulai" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="input-group clockpicker pull-center" data-placement="left" data-align="top"
                            data-autoclose="true">
                            <div class="input-group-append input-group-addon">
                                <div data-placement="top" data-toggle="tooltip" title="Tanggal Selesai"
                                    class="btn btn-primary"><span class="icon-clock"></span> End</div>
                            </div>
                            <input type="time" id="txtSelesai" class="form-control" required>
                            <button type="button" id="btnLoadData" class="btn btn-default bg-info btn-md form-control"
                                data-toggle="tooltip" data-placement="top" title="Load Data"><i
                                    class="fas fa-download"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card card-outline card-success load-ding">
        <div class=" card-header">
            <h3 class="card-title">Laporan Sikontras</h3>
            <div class=" card-tools">
                <div class="mailbox-controls">
                    <button type="button" id="btnPrint" class="btn btn-default bg-green btn-sm" data-toggle="tooltip"
                        data-placement="top" title="Edit Content Profil"><i class=" fas fa-print"></i></button>
                    <button type="button" id="btnExportCSV" class="btn btn-default bg-yellow btn-sm"
                        data-toggle="tooltip" data-placement="top" title="Export CSV"><i
                            class="fas fa-file-csv"></i></button>
                    <button type="button" id="btnExportPDF" class="btn btn-default bg-danger btn-sm"
                        data-toggle="tooltip" data-placement="top" title="Export PDF"><i
                            class="fas fa-file-pdf"></i></button>
                    <button type="button" id="btnExportEXL" class="btn btn-default bg-pink btn-sm" data-toggle="tooltip"
                        data-placement="top" title="Export Exel"><i class="fas fa-file-excel"></i></button>
                    <button type="button" id="btnReload" class="btn btn-default bg-info btn-sm" data-toggle="tooltip"
                        data-placement="top" title="Refresh"><i class="fas fa-sync-alt"></i></button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table table id="tblData" class="table table-bordered table-striped">
                    <thead>
                        <tr class="text-center">
                            <th rowspan="2">#</th>
                            <th colspan="5">ASAL ADUAN</th>
                            <th colspan="4">PRIHAL ADUAN</th>
                            <th colspan="4">TINDAK LANJUT</th>
                        </tr>
                        <tr>
                            <th>No.Aduan</th>
                            <th>Tanggal</th>
                            <th>Nama</th>
                            <th>Nip</th>
                            <th>Unit / Bagian</th>
                            <th>Katagori</th>
                            <th>Lokasi</th>
                            <th>Jenis</th>
                            <th>Deskripsi</th>
                            <th>Status</th>
                            <th>Tim Support</th>
                            <th>Waktu</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->