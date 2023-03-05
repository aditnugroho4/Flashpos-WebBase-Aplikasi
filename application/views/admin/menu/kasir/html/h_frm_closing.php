<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); $date = R::isoDateTime();?>
<?php $this->load->view('admin/menu/kasir/function/f_kasir_initial'); ?>
<section class="hold-transition lockscreen">
    <div class="lockscreen-wrapper" id="initialscreen">
        <div class="card card-outline card-gray  p-1 load-initial ">
            <div class="lockscreen-logo">
                <b>Closing </b>Kasir
            </div>
            <div class="card-footer bg-brown rounded ">
                <div class="pass-closing">
                    <div class="lockscreen-name">Hai.. <?php echo $user->nama; ?></div>
                    <div class="lockscreen-item text-dark">
                        <div class="lockscreen-image bg-dark">
                            <i class="fas fa-2x fa-key bg-grey"></i>
                        </div>
                        <div class="lockscreen-credentials">
                            <div class="input-group">
                                <input type="password" id="txtPinClosing" maxlength="6" class="form-control"
                                    placeholder="Masukan Pin Kasir">
                                <div class="input-group-append">
                                    <button type="button" id="btn-cek-initial" class="btn bg-navy col-12">Cek <i
                                            class="fas fa-arrow-right"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <form id="post_closing_kasir" style="display:none;">
                    <table class="table">
                        <tr>
                            <td>Oprator</td>
                            <td>:</td>
                            <td id="lbl-oop"></td>
                        </tr>
                        <tr>
                            <td>Sihft</td>
                            <td>:</td>
                            <td id="lbl-shift"></td>
                        </tr>
                        <tr>
                            <td>Jam Initial</td>
                            <td>:</td>
                            <td id="lbl-jam-in"></td>
                        </tr>
                    </table>
                    <div class="lockscreen-name">Masukan Jumlah Uang Cash</div>
                    <div class="lockscreen-item text-dark">
                        <div class="lockscreen-image bg-dark">
                            <i class="fas fa-2x fa-dollar-sign bg-grey"></i>
                        </div>
                        <div class="lockscreen-credentials">
                            <div class="input-group">
                                <input type="text" id="txtCashDrawer" class="form-control"
                                    placeholder="Jumlah Uang Cash" onfocus="$.format_text(this);" required>
                                <div class="input-group-append">
                                    <button type="submit" class="btn bg-navy">Posting <i
                                            class="fas fa-arrow-right ml-1 mt-1 float-right"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="lockscreen-item">
                        <button type="button" id="btn-clear-closing" class="btn bg-navy col-12">Cancel <i
                                class="fa fa-close"></i></button>
                    </div>
                </form>
            </div>
            <div class="help-block text-center">
                <marquee bgcolor="#111f29">
                    <h5 class="text-white">Hitung Uang Dengan Benar dan teliti</h5>
                </marquee>
                Untuk Menutup Penjualan
            </div>
            <div class="text-center">
                Masukan pin dan Masukan Seluruh Jumlah Pendapatan
            </div>
        </div>
    </div>
</section>