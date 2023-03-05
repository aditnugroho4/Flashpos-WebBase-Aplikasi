<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<script type="text/javascript">
var fildeselect;
var active;
var eleFocus = '';
var divisiID;
var objItems = {
    id: null,
    kode: null,
    nama: null,
    deskripsi: null,
    satuan: null,
    harga: 0,
    diskon: 0,
    idJenis: null,
    qty: 0,
    foto: null,
    tanggal: null,
    batch: null,
    idUser: null,
    dataTable: null
};
$(document).ready(function() {
    Globalize.culture("id-ID");
    $('.mn-1').addClass('bg-brown');

    $.alert_swal = function($info, $message, $alert) {
        Swal.fire({
            icon: $alert,
            title: $info,
            text: $message,
            confirmButtonText: "OK",
            focusConfirm: true
        }).then((result) => {
            if (result.value) {
                $('#tab-stock a[href="#DataStock"]').trigger('click');
                $("#tblData").dataTable().fnDraw();
            }
        })
    }

});
</script>
<div class="col-md-12">
    <div class="card card-outline card-yellow load-Barang">
        <div class="card-header">
            <h3 class="card-title col-lg-4 col-sm-12 mb-2">Stock Awal</h3>
        </div>
        <div class="card-body">
            <ul class="nav nav-pills" id="tab-stock">
                <li class="nav-item" id="Data-Stock"><a class="nav-link active border-left" href="#DataStock"
                        data-toggle="tab"><i class="fas fa-clipboard-check"></i> Pembelian</a>
                </li>
                <li class="nav-item" id="Add-Stock"><a class="nav-link border-left" href="#AddStock"
                        data-toggle="tab"><i class="fas fa-truck"></i> Prosess Stock</a>
                </li>
                <li class="nav-item" id="Rincian-Stock"><a class="nav-link border-left" href="#RincianStock"
                        data-toggle="tab"><i class="fas fa-clipboard-list"></i> Rincian Stock</a>
                </li>
            </ul>
            <hr>
            <div class="tab-content">
                <div class="active tab-pane" id="DataStock">
                    <div class="callout callout-info">
                        <div class="table-responsive">
                            <table table id="tblData" class="table table-bordered table-striped"></table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="AddStock">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="callout callout-info">
                                        <div class="form-group">
                                            <label for="txtTglStock" class="col-form-label">Tanggal
                                                PB</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="txtTglStock">
                                                <div class="input-group-append">
                                                    <span class="input-group-text btn stock"><i
                                                            class="fa fa-calendar"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="callout callout-info">
                                        <label>List Stock</label>
                                        <div class="table-responsive scroll-bar" style="max-height:450px;">
                                            <table table id="tblDataStock" class="table table-bordered table-striped">
                                            </table>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <button type="button" id="submit_prosses"
                                            class="btn btn-danger float-right">Prosses</button>
                                        <button type="button" id="submit_print" class="btn btn-info float-right mr-1"><i
                                                class="fas fa-print"></i> Print</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="RincianStock">
                    <div class="callout callout-info">
                        <div class="table-responsive">
                            <table table id="tblDataRincian" class="table table-bordered table-striped"></table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>