<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$date = R::isoDateTime();
$id=$this->input->get('initial');
$shift = array('shift'=>R::load('k_initial_kasir',base64_decode($id)));
$this->load->view('admin/menu/kasir/function/f_kasir_transaksi',$shift);
?>
<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8 col-md-6 col-sm-4 text-sm">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="callout callout-brown">
                            <div class="row">
                                <div class="col-lg-12" id="jenis-list">
                                    <div class="card card-outline card-brown">
                                        <div class="card-header">
                                            <h3 class="card-title mb-3">Jenis Menu</h3>
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                                    data-toggle="tooltip" title="Collapse">
                                                    <i class="fas fa-minus"></i></button>
                                            </div>
                                        </div>
                                        <div class="card-body overflow-auto " style="max-height:130px;">
                                            <div class="col-lg-12">
                                                <div class="jenis-list row">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="card card-outline card-brown load__overlay">
                                        <div class="card-header">
                                            <h3 class="card-title mb-3">Daftar Item's</h3>
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                                    data-toggle="tooltip" title="Collapse">
                                                    <i class="fas fa-minus"></i></button>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="input-group input-group-lg">
                                                <input type="text" id="txtSearch" placeholder="Cari Item's"
                                                    class="form-control">
                                                <div class="input-group-append">
                                                    <button id="btn_refresh" class="input-group-text btn bg-brown"><i
                                                            class="fas fa-search"></i> Refesh</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-12 overflow-auto load-data-items"
                                                    style="min-height:460px;max-height:460px;">
                                                    <div class="data__list__Menu row clearfix">
                                                        <div class="col-lg-4">
                                                            <div class="info-box btn btn-outline-info text-left">
                                                                <span class="info-box-icon bg-info">
                                                                    <img src="<?= base_url('asset/kasir/img/restaurant/007-lunch.png')?>"
                                                                        alt="Menu Utama">
                                                                </span>
                                                                <div class="info-box-content">
                                                                    <span class="info-box-text">Sate Usus
                                                                        (PCS)</span>
                                                                    <span class="info-box-number">Rp.1500,00</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 text-sm">
                <div class="card card-outline card-brown">
                    <div class=" card-header">
                        <h3 class="card-title">Chart</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                                title="Collapse">
                                <i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="callout callout-brown text-right">
                            <h1 id="lbl-Total">Rp.0</h1>
                        </div>
                        <div class="table-responsive scroll-bar rounded" style="max-height:400px;min-height:400px;">
                            <table id="tblChart" class="table"></table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <th style="width:50%" class="text-right">Subtotal</th>
                                            <td>:</td>
                                            <td class="text-right" id="lbl-Subtotal">Rp.0</td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <th class="text-right">Discount</th>
                                            <td>:</td>
                                            <td class="text-right" id="lbl-Diskon">Rp.0</td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <th class="text-right">Total Bayar:</th>
                                            <td>:</td>
                                            <td class="text-right" id="lbl-TotBayar">Rp.0</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="row">
                                <div class=" col-xs-12 col-lg-8">
                                    <button type="button" id="btn-bayar" class="btn btn-success mb-2 col-12 btn-lg"><i
                                            class="far fa-credit-card"></i>
                                        BAYAR
                                    </button>
                                </div>
                                <div class="col-lg-4">
                                    <button type="button" id="btn-pending-bayar" class="btn btn-brown mb-2 col-12">
                                        <i class="fas fa-clock"></i> PENDING
                                    </button>
                                    <button type="button" id="btn-cancel-bayar" class="btn btn-brown  col-12">
                                        <i class="fas fa-download"></i> CANCEL
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card card-outline card-brown">
                            <div class="card-header">
                                <h3 class="card-title mb-3">Tools</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                        data-toggle="tooltip" title="Collapse">
                                        <i class="fas fa-minus"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="input-group input-group-lg">
                                    <button id="btn-maximize" class="btn btn-app bg-brown"><i
                                            class="fas fa-window-maximize"></i>
                                        <span>Maximize</span> </button>
                                    <button id="btn-frm-reprint" class="btn btn-app bg-brown"><i
                                            class="fas fa-print"></i>
                                        Reprint</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div id="dlg-frm-bayar" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content loading-pembayaran">
            <div class="modal-header">
                <h5 class="modal-title">Pembayaran</h5>
            </div>
            <div class="modal-body">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label for="txtSubtotal">Sub Total</label>
                                <input id="txtSubtotal" type="text" disabled="disabled" onfocus="$.format_text(this);"
                                    class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="txtDiskon">Diskon</label>
                                <input id="txtDiskon" type="text" disabled="disabled" onfocus="$.format_text(this);"
                                    class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="txtTotalItems">Qty Item's</label>
                                <input id="txtTotalItems" type="text" disabled="disabled" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="txtTotalbayar">Total Bayar</label>
                                <input id="txtTotalbayar" type="text" onfocus="$.format_text(this);"
                                    class="form-control form-control-lg bg-black" required>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label for="txtCarabayar">Nomor Meja</label>
                                <div class="btn-group btn-group-lg ">
                                    <div class="btn-group">
                                        <div class="btn-meja overflow-auto " style="max-height:130px;"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="txtCarabayar">Pilih Cara Bayar</label>
                                <div class="btn-group btn-group-lg text-center" id="rbayar">
                                    <label class="btn btn-app mr-2 bg-info">
                                        <i class='fas fa-mobile-alt'></i>
                                        <input type="radio" name="C-bayar" id="btn-cash" value="cash" required>
                                        <span>Cash</span>
                                    </label>
                                    <label class="btn btn-app mr-2 bg-info">
                                        <i class='far fa-credit-card'></i>
                                        <input type="radio" name="C-bayar" value="debet"
                                            id="btn-debet"><span>Debet</span>
                                    </label>
                                    <label class="btn btn-app mr-2 bg-info">
                                        <i class='far fa-money-bill-alt'></i>
                                        <input type="radio" name="C-bayar" value="epay" id="btn-epay"><span>E-Pay</span>
                                    </label>
                                </div>
                            </div>
                            <div class="txtCash">
                                <div class="form-group ">
                                    <label for="txtCash">Jumlah Cash</label>
                                    <input type="text" id="txtCash" onfocus="$.format_text(this);" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="txtKembali">Uang Kembali</label>
                                    <input type="text" id="txtKembali" onfocus="$.format_text(this);"
                                        disabled="disabled" class="form-control">
                                </div>
                            </div>
                            <div class="txtDebet">
                                <div class="form-group ">
                                    <label for="txtKartu">Nomor Kartu</label>
                                    <input type="text" id="txtKartu" class="form-control">
                                </div>
                                <div class="form-group ">
                                    <label for="txtBank">Nama Bank</label>
                                    <input type="text" id="txtBank" class="form-control" disabled="disabled">
                                </div>
                                <div class="form-group">
                                    <label for="txtDebet">Jumlah Bayar</label>
                                    <input type="text" id="txtDebet" onfocus="$.format_text(this);"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="txtEpay">
                                <div class="form-group">
                                    <label for="cmbJenisEpay">Jenis E-Pay</label>
                                    <select name="cmbJenisEpay" id="cmbJenisEpay" class="form-control"></select>
                                </div>
                                <div class="form-group">
                                    <label for="txtEpay">Fee Merchant</label>
                                    <input type="text" id="txtEpay" onfocus="$.format_text(this);" class="form-control">
                                </div>
                                <div class="form-group ">
                                    <label for="txtTrxidEpay">Id Transaksi</label>
                                    <input type="text" id="txtTrxidEpay" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 border-top p-2">
                            <button type="button" class="btn btn-app bg-warning float-left" id="btn-clear"><i
                                    class="fas fa-exclamation-circle"></i> Cancel</button>
                            <button type="button" disabled="disabled" class="btn btn-app bg-info float-right"
                                id="btn-finish"><i class="fas fa-hand-holding-usd"></i> Bayar</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <marquee bgcolor="#111f29">
                    <h5 class="text-white text-center">Hati-Hati Dengan Uang Palsu - Cek Kembali Item's Yang Terjual
                    </h5>
                </marquee>
            </div>
        </div>
    </div>
</div>
<div id="dlg-frm-reprint" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content loading-pembayaran">
            <div class="modal-header">
                <h5 class="modal-title">Reprint</h5>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <div class="form-group">
                        <label for="txtReNota"><i class="fas fa-receipt"></i> Input No Receipt</label>
                        <input id="txtReNota" type="text" class="form-control" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-app bg-info" id="btn-rePrint"><i class="fas fa-print"></i> PRINT
                </button>
                <button type="button" data-dismiss="modal" class="btn btn-app bg-warning " id="btn-clear"><i
                        class="fas fa-exclamation-circle"></i> Cancel</button>
            </div>
        </div>
    </div>
</div>