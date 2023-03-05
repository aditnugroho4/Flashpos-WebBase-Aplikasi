<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php $this->load->view('admin/menu/sdm/function/f_data_pegawai');?>
<div class="col-md-12">
    <div class="card card-outline card-yellow">
        <div class="card-header">
            <h3 class="card-title col-lg-4 col-sm-12 mb-2">DATA PEGAWAI</h3>
        </div>
        <div class="card-body">
            <div class="card loadding">
                <div class="card-header p-2">
                    <ul class="nav nav-pills" id="tab-data">
                        <li class="nav-item" id="ListData"><a class="nav-link active" href="#Data-List"
                                data-toggle="tab">Data Sdm</a>
                        </li>
                        <li class="nav-item" id="AddData"><a class="nav-link" href="#Add-Data" data-toggle="tab">Tambah
                                Sdm</a>
                        </li>
                        <li class="nav-item" id="EditData"><a class="nav-link" href="#Edit-Data" data-toggle="tab">Edit
                                Sdm</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="Data-List">
                            <div class="table-responsive">
                                <table table id="tblData" class="table table-bordered table-striped"></table>
                            </div>
                        </div>
                        <div class="tab-pane" id="Add-Data">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form id="add_data_pegawai">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Cari Data Calon Pegawai</label>
                                                    <div class="input-group">
                                                        <input id="txtSearch" class="form-control" type="text"
                                                            maxlength="100" placeholder="Search">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text btn search"><i
                                                                    class="fas fa-search"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>NIK</label>
                                                    <input type="text" id="txtNik" maxlength="20" class="form-control"
                                                        disabled="disabled">
                                                </div>
                                                <div class="form-group">
                                                    <label>NIP</label>
                                                    <input type="text" id="txtNip" maxlength="20" class="form-control"
                                                        disabled="disabled">
                                                </div>
                                                <div class="form-group">
                                                    <label>Nama</label>
                                                    <input type="text" id="txtNama" maxlength="20" class="form-control"
                                                        required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Pendidikan Terkahir</label>
                                                    <select type="text" id="cmbPendidikan" class="form-control"
                                                        required>
                                                        <option value="">-- Pilih --</option>
                                                        <option value="SD">SD</option>
                                                        <option value="SMP">SMP</option>
                                                        <option value="SMA">SMA</option>
                                                        <option value="SMK">SMK</option>
                                                        <option value="D3">DIPLOMA</option>
                                                        <option value="S1">S1</option>
                                                        <option value="S2">S2</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Tanggal Lulus</label>
                                                    <input type="text" id="txtTglLulus"
                                                        Placeholder="contoh : 1989-25-09" maxlength="10"
                                                        class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Divis</label>
                                                    <select type="text" id="cmbDivisi" class="form-control"
                                                        required></select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Unit / Bagian</label>
                                                    <select type="text" id="cmbUnit" class="form-control"
                                                        required></select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Profesi / Keahlian</label>
                                                    <select type="text" id="cmbProfesi" class="form-control" required>
                                                        <option value="">-- Pilih --</option>
                                                        <option value="IT">IT</option>
                                                        <option value="Acounting">Acounting</option>
                                                        <option value="Administrasi">Administrasi</option>
                                                        <option value="Marketing">Marketing</option>
                                                        <option value="Kasir">Kasir</option>
                                                        <option value="Waiters">Waiters</option>
                                                        <option value="Kitchen">Kitchen</option>
                                                        <option value="Bartenter">Bartenter</option>
                                                        <option value="Dekorasi">Dekorasi</option>
                                                        <option value="Tata Rias">Tata Rias</option>
                                                        <option value="Engginering">Engginering</option>
                                                        <option value="Security">Security</option>
                                                        <option value="Cleaning Services">Cleaning Services</option>
                                                        <option value="OB">OB</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Tanggal Masuk Bekerja (TMT)</label>
                                                    <input type="text" id="txtTglMasuk"
                                                        Placeholder="contoh : 1989-25-09" maxlength="10"
                                                        class="form-control" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Status Pegawai</label>
                                                    <select type="text" id="cmbStatus" class="form-control" required>
                                                        <option value="">-- Pilih --</option>
                                                        <option value="Karyawan">Karyawan</option>
                                                        <option value="Kontrak">Kontrak</option>
                                                        <option value="Harian">Harian</option>
                                                        <option value="Part Time">Part Time</option>
                                                        <option value="Magang">Magang</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Posisi Jabatan</label>
                                                    <select type="text" id="cmbPosisi" class="form-control" required>
                                                        <option value="">-- Pilih --</option>
                                                        <option value="Komisaris">Komisaris</option>
                                                        <option value="Direktur">Direktur</option>
                                                        <option value="Manager">Manager</option>
                                                        <option value="Supervisor">Supervisor</option>
                                                        <option value="Admin">Admin</option>
                                                        <option value="Staf">Staf</option>
                                                        <option value="Leader">Leader</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <button type="submit"
                                                    class="btn btn-primary float-right">Simpan</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="Edit-Data">
                            <div class="col-lg-12">
                                <form id="edit-data-pegawai">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>NIK</label>
                                                <input type="text" id="txtNikE" maxlength="20" class="form-control"
                                                    disabled="disabled">
                                            </div>
                                            <div class="form-group">
                                                <label>NIP</label>
                                                <input type="text" id="txtNipE" maxlength="20" class="form-control"
                                                    disabled="disabled">
                                            </div>
                                            <div class="form-group">
                                                <label>Nama</label>
                                                <input type="text" id="txtNamaE" maxlength="20" class="form-control"
                                                    required>
                                            </div>
                                            <div class="form-group">
                                                <label>Pendidikan Terkahir</label>
                                                <select type="text" id="cmbPendidikanE" class="form-control" required>
                                                    <option value="">-- Pilih --</option>
                                                    <option value="SD">SD</option>
                                                    <option value="SMP">SMP</option>
                                                    <option value="SMA">SMA</option>
                                                    <option value="SMK">SMK</option>
                                                    <option value="D3">DIPLOMA</option>
                                                    <option value="S1">S1</option>
                                                    <option value="S2">S2</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Tanggal Lulus</label>
                                                <input type="text" id="txtTglLulusE" Placeholder="contoh : 1989-25-09"
                                                    maxlength="10" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Divis</label>
                                                <select type="text" id="cmbDivisiE" class="form-control"
                                                    required></select>
                                            </div>
                                            <div class="form-group">
                                                <label>Unit / Bagian</label>
                                                <select type="text" id="cmbUnitE" class="form-control"
                                                    required></select>
                                            </div>
                                            <div class="form-group">
                                                <label>Profesi / Keahlian</label>
                                                <select type="text" id="cmbProfesiE" class="form-control" required>
                                                    <option value="">-- Pilih --</option>
                                                    <option value="IT">IT</option>
                                                    <option value="Acounting">Acounting</option>
                                                    <option value="Administrasi">Administrasi</option>
                                                    <option value="Marketing">Marketing</option>
                                                    <option value="Kasir">Kasir</option>
                                                    <option value="Waiters">Waiters</option>
                                                    <option value="Kitchen">Kitchen</option>
                                                    <option value="Bartenter">Bartenter</option>
                                                    <option value="Dekorasi">Dekorasi</option>
                                                    <option value="Tata Rias">Tata Rias</option>
                                                    <option value="Engginering">Engginering</option>
                                                    <option value="Security">Security</option>
                                                    <option value="Cleaning Services">Cleaning Services</option>
                                                    <option value="OB">OB</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Tanggal Masuk Bekerja (TMT)</label>
                                                <input type="text" id="txtTglMasukE" Placeholder="contoh : 1989-25-09"
                                                    maxlength="10" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Status Pegawai</label>
                                                <select type="text" id="cmbStatusE" class="form-control" required>
                                                    <option value="">-- Pilih --</option>
                                                    <option value="Karyawan">Karyawan</option>
                                                    <option value="Kontrak">Kontrak</option>
                                                    <option value="Harian">Harian</option>
                                                    <option value="Part Time">Part Time</option>
                                                    <option value="Magang">Magang</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Posisi Jabatan</label>
                                                <select type="text" id="cmbPosisiE" class="form-control" required>
                                                    <option value="">-- Pilih --</option>
                                                    <option value="Komisaris">Komisaris</option>
                                                    <option value="Direktur">Direktur</option>
                                                    <option value="Manager">Manager</option>
                                                    <option value="Supervisor">Supervisor</option>
                                                    <option value="Admin">Admin</option>
                                                    <option value="Staf">Staf</option>
                                                    <option value="Leader">Leader</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <button type="submit" class="btn btn-primary float-right">Simpan</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="dlg-edit-foto" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content modal-col-light-blue loading">
            <div class="modal-header">
                <h4 id="dlg-edit-foto-Label" class="modal-title">Form Edit</h4>
            </div>
            <div class="modal-body ">
                <div class="card card-primary">
                    <div class="card-header">
                        <p>Edit Gambar</p>
                    </div>
                    <form id="edit-foto-prof">
                        <div class="card-body">
                            <div class="form-group">
                                <input type="file" id="upl-upd-foto-prof" data-allowed-file-extensions="png jpg jpeg"
                                    name="file" class="dropify" data-max-file-size="2M" required>
                            </div>
                            <div class="input-group">
                                <div class="input-group-append ">
                                    <button type="submit" class="input-group-text bg-gradient btn-info">Upload</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-secondary ">Close</button>
            </div>
        </div>
    </div>
</div>