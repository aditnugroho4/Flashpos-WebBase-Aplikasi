<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<script type="text/javascript">
var fildeselect;
var active;
var eleFocus = '';
var divisiID;
$(document).ready(function() {
    Globalize.culture("id-ID");
    $('.mn-1').addClass('bg-yellow');
    $('.sidebar-mini').addClass('sidebar-collapse');
    $("#txt_start,#txt_end").datepicker({
        changeMonth: true,
        changeYear: false,
        showButtonPanel: true,
        // maxDate: '2018',
        // minDate: '@minDate',
        dateFormat: "yy-mm-dd"
        // onSelect: function(date) {}
    });
    $("#tblPrint").dataTable({});
    $get_data_jenis("#cmbJenis");
    $('#Lap-Transaksi').click(function() {
        $get_data_jenis("#cmbJenis");
    });
    $('#Lap-Bahanbaku').click(function() {
        if (!selectedId) {
            $.alert_swal('Edit Data Brand', 'Pilih Data Yang Akan di Edit', 'info');
        } else {
            $("#submit_edit").show();
        }
    });

    function $get_data_jenis(tag) {
        $(tag).empty();
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "<?php echo site_url('admin/multi_select');?>?table=k_jenis_barang",
            success: function(data) {
                if (data == '') {
                    $(tag).append("<option value=''> -- No Result -- </option>");
                } else {
                    $(tag).append("<option value=''> -- Silahkan Pilih -- </option>");
                    $(tag).append("<option value='All'>All Product</option>");
                    for (var i = 0; i < data.length; i++) {
                        $(tag).append("<option value='" + data[i].id + "'>" +
                            data[i].nama + "</option>");
                    }
                }
            }
        });
    }

    $("#btn-import").button().click(function() {
        if ($("#txt_start").val().length > 0 && $("#txt_end").val().length > 0) {
            $("#btn-import").attr('disabled', 'disabled');
            $('.load-Barang').append('<div class="overlay"><i class="fas fa-2x fa-sync-alt fa-spin"></i></div>');
            $.ajax({
                type: "POST",
                dataType: 'json',
                url: "<?php echo site_url('chartreport/get_lap_penjualan');?>",
                data:{
                    id:$('cmbJenis option:selected').val(),
                    exe:'show',
                    startDate:$("#txt_start").val(),
                    endDate:$("#txt_end").val()
                },
                success: function(msg) {
                    $("#tblPrint").dataTable().fnClearTable();
                    let modal =0;    
                    let totalKotor =0;    
                    let totalDiskon =0;    
                    let totalBersih =0; 
                    if (msg.error==false) {
                        for (var i = 0; i < msg.data.length; i++) {
                            $("#tblPrint").dataTable().fnAddData(
                                [
                                    $("#tblPrint").dataTable().fnGetData().length + 1,
                                    msg.data[i].kode,
                                    msg.data[i].katagori,
                                    msg.data[i].nama,
                                    Globalize.format(Globalize.parseInt(msg.data[i].harga_dasar), "c"),
                                    Globalize.format(Globalize.parseInt(msg.data[i].diskon), "c"),
                                    Globalize.format(Globalize.parseInt(msg.data[i].harga), "c"),
                                    msg.data[i].terjual,
                                    Globalize.format(Globalize.parseInt(msg.data[i].total), "c"),
                                ]
                            );
                        modal += parseInt(msg.data[i].harga_dasar)*msg.data[i].terjual;    
                        totalKotor += parseInt(msg.data[i].total);    
                        totalDiskon += parseInt(msg.data[i].diskon);    
                        totalBersih =totalKotor-modal;    
                        }
                        $('.tot-modal').html(Globalize.format(modal, "c"));    
                        $('.tot-diskon').html(Globalize.format(totalDiskon, "c"));    
                        $('.tot-kotor').html(Globalize.format(totalKotor, "c"));    
                        $('.tot-bersih').html(Globalize.format(totalBersih, "c"));  
                        $('.load-Barang').find('.overlay').remove();
                        $("#btn-import").removeAttr('disabled');
                        $.alert_swal_info('Form Laporan', msg.message, 'success');
                    } else if (msg.error==true) {
                        $('.load-Barang').find('.overlay').remove();
                        $.alert_swal_info('Form Laporan', msg.message, 'warning');
                    }
                }
            });
        } else {
            $.alert_swal_info("Prosess Laporan", " Tentukan Tanggal atau Data masih Kosing", "warning");
            $("#txt_start").focus();
        }
    });
    $("#btn-Print").button().click(function() {
        if ($("#tblPrint").dataTable().fnGetData().length > 0) {
            window.open("<?php echo site_url('chartreport/get_lap_penjualan');?>?startDate="+$("#txt_start").val()+"&endDate="+$("#txt_end").val()+"&id="+$('cmbJenis option:selected').val()+"&exe=print");
        }
    });
    $.alert_swal = function($info, $message, $alert) {
        Swal.fire({
            icon: $alert,
            title: $info,
            text: $message,
            confirmButtonText: "OK",
            focusConfirm: true
        }).then((result) => {
            if (result.value) {
                $('#tab-brand a[href="#Pendapatan"]').trigger('click');
                $("#tblData").dataTable().fnDraw();
            }
        })
    }
});
</script>
<div class="col-md-12">
    <div class="card card-outline card-yellow load-Barang">
        <div class="card-header">
            <h3 class="card-title col-lg-4 col-sm-12 mb-2">Laporan Pendapatan</h3>
        </div>
        <div class="card-body">
            <ul class="nav nav-pills" id="tab-brand">
                <li class="nav-item" id="Lap-Pendapatan"><a class="nav-link active border-left" href="#Pendapatan"
                        data-toggle="tab">Pendapatan</a>
                </li>
                <li class="nav-item" id="Lap-Transaksi"><a class="nav-link border-left" href="#Transaksi"
                        data-toggle="tab">Transaksi</a>
                </li>
                <li class="nav-item" id="Lap-Bahanbaku"><a class="nav-link border-left" href="#BahanBaku"
                        data-toggle="tab">Bahan Baku</a>
                </li>
            </ul>
            <hr>
            <div class="tab-content">
                <div class="active tab-pane" id="Pendapatan">
                    <div class="callout callout-info">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="cmbJenis" class="col-form-label">Berdasarkan Jenis Menu</label>
                                            <div class="input-group">
                                                <select id="cmbJenis" class="form-control"></select>
                                                <div class="input-group-append">
                                                    <span class="input-group-text btn"><i class="fas fa-folder"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Import Data Berdasarkan Tanggal</label>
                                            <div class="input-group">
                                                <input type="text" id="txt_start" maxlength="10" class="form-control"
                                                    required>
                                                <span class="form-text ml-1 mr-1"> s/d </span>
                                                <input type="text" id="txt_end" maxlength="10" class="form-control"
                                                    required>
                                                <div class="input-group-append">
                                                    <span class="input-group-text btn stock"><i
                                                            class="fa fa-calendar"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="card-footer">
                                            <button type="button" id="btn-import"
                                                class="btn btn-info float-right ml-2">Import</button>
                                            <button type="button" id="btn-Print"
                                                class="btn btn-warning ml-1 float-right">Print</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="card-content">
                                <div class="table-responsive">
                                    <table id="tblPrint" class="table table-striped table-bordered table-hover ">
                                        <thead>
                                            <tr>
                                                <th rowspan="2">NO</th>
                                                <th rowspan="2" class="text-center"><i class="fas fa-box"></i> Kode</th>
                                                <th colspan="5" class="text-center"><i class="fas fa-clipboard-check"></i> Item Product</th>
                                                <th colspan="2" class="text-center"><iclass="fas fa-boxes"></iclass=> JUMLAH</th>
                                            </tr>
                                            <tr>
                                                <th>Katagori</th>
                                                <th>Item</th>
                                                <th>Harga Pokok</th>
                                                <th>Diskon</th>
                                                <th>Harga Jual</th>
                                                <th>Terjual</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="mt-2">
                                    <table style="width:100%">
                                        <tr colspan="2" style="border-top:2px solid black;">
                                            <td class="text-right" style="width:50%;">TOTAL MODAL</td>
                                            <td class="text-right tot-modal">Rp.</td>
                                        </tr>
                                        <tr colspan="2">
                                            <td class="text-right" style="width:50%;">DISKON</td>
                                            <td class="text-right tot-diskon">Rp.</td>
                                        </tr>
                                    <tr colspan="2">
                                        <td class="text-right" style="width:50%;">PENJUALAN KOTOR</td>
                                        <td class="text-right tot-kotor">Rp.</td>
                                    </tr>
                                    <tr colspan="2">
                                        <td class="text-right" style="width:50%;">LABA BERSIH</td>
                                        <td class="text-right tot-bersih">Rp.</td>
                                    </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="Transaksi">
                    <!-- Tambah Brand -->
                    <div class="callout callout-info">
                    </div>
                </div>
                <div class="tab-pane" id="BahanBaku">
                    <!-- Edit Brand -->
                    <div class="callout callout-info">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>