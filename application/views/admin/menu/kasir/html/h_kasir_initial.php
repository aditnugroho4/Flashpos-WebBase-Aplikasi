<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); $date = R::isoDateTime();?>
<?php $this->load->view('admin/menu/kasir/function/f_kasir_initial'); ?>
<section class="hold-transition lockscreen">
    <div class="lockscreen-wrapper" id="initialscreen">
        <div class="card card-outline card-gray  p-1 load-initial ">
            <div class="lockscreen-logo">
                <b>Initial-</b>Kasir
            </div>
            <div class="card-footer bg-brown rounded ">
                <form id="post_initial_kasir">
                    <div class="lockscreen-name">Hai.. <?php echo $user->nama; ?></div>
                    <div class="lockscreen-item text-dark">
                        <div class="lockscreen-image bg-dark">
                            <i class="fas fa-2x fa-key bg-grey"></i>
                        </div>
                        <div class="lockscreen-credentials">
                            <div class="input-group">
                                <input type="password" id="txtNewPin" maxlength="6" class="form-control"
                                    placeholder="Buat Pin Baru Max 6 Digit" required>
                            </div>
                        </div>
                    </div>
                    <div class="lockscreen-name">Tentukan Shift Kasir</div>
                    <div class="lockscreen-item text-dark">
                        <div class="lockscreen-image bg-dark">
                            <i class="fas fa-2x fa-calendar-day bg-grey"></i>
                        </div>
                        <div class="lockscreen-credentials">
                            <div class="form-group">
                                <select name="shift" id="cmbShift" class="form-control" required>
                                    <option value="">Pilih Shift</option>
                                    <option value="1">Shift 1</option>
                                    <option value="2">Shift 2</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="lockscreen-name">Masukan Uang Modal</div>
                    <div class="lockscreen-item text-dark">
                        <div class="lockscreen-image bg-dark">
                            <i class="fas fa-2x fa-dollar-sign bg-grey"></i>
                        </div>
                        <div class="lockscreen-credentials">
                            <div class="input-group">
                                <input type="text" id="txtModal" class="form-control"
                                    placeholder="Uang Modal Cash Drawer" onfocus="$.format_text(this);" required>
                            </div>
                        </div>
                    </div>
                    <div class="lockscreen-item">
                        <button type="submit" class="btn btn-info col-12">Initial Kasir <i
                                class="fas fa-arrow-right mt-1 float-right"></i></button>
                    </div>
                </form>
            </div>
            <div class="help-block text-center">
                <marquee bgcolor="#111f29">
                    <h5 class="text-white">Anda Belum Melakuan Initial</h5>
                </marquee>
                Untuk Memulai Transaksi
            </div>
            <div class="text-center">
                Buat pin dan tentukan shift Transaksi
            </div>
        </div>
    </div>
</section>