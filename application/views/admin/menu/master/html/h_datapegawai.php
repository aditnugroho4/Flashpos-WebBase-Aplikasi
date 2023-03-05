<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php $this->load->view('admin/menu/master/function/f_datapegawai');?>
<div class="col-md-12">
    <div class="card card-outline card-yellow">
        <div class="card-header">
            <h3 class="card-title col-lg-4 col-sm-12 mb-2">DATA PEGAWAI</h3>
        </div>
        <div class="card-body">
            <div class="card load-prof">
                <div class="card-header p-2">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active" href="#Data-List" data-toggle="tab">Data Sdm</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="#Add-Data" data-toggle="tab">Tambah Sdm</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="#Edit-Data" data-toggle="tab">Edit Sdm</a>
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
                                    <form id="upd_data_pegawai">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>NIP/NIRPTT/NIK</label>
                                                    <input type="text" id="txtNik" maxlength="20"
                                                        value="<?= $employ['nip'];?>" class="form-control" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Nama</label>
                                                    <input type="text" id="txtNama" maxlength="30"
                                                        value="<?= $employ['nama'];?>" class="form-control" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Jenis Kelamin</label>
                                                    <select id="cmbKelamin" class="form-control" required>
                                                        <option value="L">Laki - Laki</option>
                                                        <option value="P">Perempuan</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Tempat Lahir</label>
                                                    <input type="text" id="txtTmptLahir" maxlength="30"
                                                        class="form-control" value="<?= $employ['tmptlahir'];?>"
                                                        required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Tanggal Lahir</label>
                                                    <input type="text" id="txtTglLahir"
                                                        Placeholder="contoh : 1989-25-09"
                                                        value="<?= $employ['tgllahir'];?>" maxlength="10"
                                                        class="form-control" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Pendidikan Terkahir</label>
                                                    <input type="text" id="txtPendidikan"
                                                        value="<?= $employ['pendidikan'];?>" maxlength="50"
                                                        class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Tanggal Masuk Bekerja (TMT)</label>
                                                    <input type="text" id="txtTglMasuk"
                                                        Placeholder="contoh : 1989-25-09"
                                                        value="<?= $employ['tmtdinas'];?>" maxlength="10"
                                                        class="form-control" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Status Pegawai</label>
                                                    <select type="text" id="cmbStatus" class="form-control" required>
                                                        <option value="PNS">PNS</option>
                                                        <option value="PTT">PTT</option>
                                                        <option value="BLUD<">BLUD</option>
                                                        <option value="MAGANG<">MAGANG</option>
                                                        <option value="KSO">KSO</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Pangkat / Golongan</label>
                                                    <input type="text" id="txtPangkat"
                                                        value="<?= $employ['golongan'];?>" maxlength="10"
                                                        class="form-control" required>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Profesi</label>
                                                    <select type="text" id="cmbProfesi" class="form-control" required>
                                                        <option value="Dokter">Dokter</option>
                                                        <option value="Bidan">Bidan</option>
                                                        <option value="Perawat">Perawat</option>
                                                        <option value="Staff">Staff</option>
                                                        <option value="Engginering">Engginering</option>
                                                        <option value="Cleaning Services">Cleaning Services</option>
                                                        <option value="OB">OB</option>
                                                        <option value="Security">Security</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Posisi Penempatan</label>
                                                    <select type="text" id="cmbPosisi" class="form-control" required>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Jabatan</label>
                                                    <input type="text" id="txtJabatan" value="<?= $employ['jabatan'];?>"
                                                        maxlength="20" class="form-control" required>
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
                            <form class="form-horizontal" id="edit-data-prof">
                                <div class="form-group row">
                                    <label for="UserName" class="col-sm-2 col-form-label">Username</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputUserName"
                                            value="<?= $user->username; ?>" disabled="true" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="Password" class="col-sm-2 col-form-label">Password</label>
                                    <div class="col-sm-4">
                                        <div class="input-group">
                                            <input type="password" maxlength="8" class="form-control" id="inputPassword"
                                                placeholder="Password" required>
                                            <span class="input-group-append">
                                                <button type="button" class="btn btn-dark btn-flat btn-views1"><i
                                                        class="fas fa-eye"></i></button>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="input-group">
                                            <input type="password" maxlength="8" class="form-control"
                                                id="inputNewPassword" placeholder="New Password">
                                            <span class="input-group-append">
                                                <button type="button" class="btn btn-dark btn-flat btn-views2"><i
                                                        class="fas fa-eye"></i></button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputName" class="col-sm-2 col-form-label">Nama</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" value="<?= $user->nama; ?>"
                                            id="inputName" placeholder="Name" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" value="<?= $user->email; ?>"
                                            id="inputEmail" placeholder="Email" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputWhatsapp" class="col-sm-2 col-form-label">WhatsApp</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" value="<?= $user->whatsapp; ?>"
                                            maxlength="16" id="inputWhatsapp" placeholder="WhatsApp" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputAlamat" class="col-sm-2 col-form-label">Alamat</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="inputAlamat" placeholder="Alamat"
                                            maxlength="1000" required><?= $user->alamat; ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPengalaman" class="col-sm-2 col-form-label">Pengalaman</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="inputPengalaman" placeholder="Pengalaman"
                                            maxlength="2000" required><?= $user->pengalaman; ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputInstagram" class="col-sm-2 col-form-label">Instagram</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" value="<?= $user->instagram; ?>"
                                            id="inputInstagram" placeholder="ex : @akbargrup" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputFacebook" class="col-sm-2 col-form-label">Facebook</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" value="<?= $user->facebook; ?>"
                                            id="inputFacebook" placeholder="Facebook" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputTwitter" class="col-sm-2 col-form-label">Twitter</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" value="<?= $user->twitter; ?>"
                                            id="inputTwitter" placeholder="ex : @Twitter" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputYoutube" class="col-sm-2 col-form-label">Youtube
                                        Chanel</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" value="<?= $user->youtube; ?>"
                                            id="inputYoutube" placeholder="Youtube Chanel" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" required> I agree to the <a href="#">terms
                                                    and
                                                    conditions</a>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                        <button type="submit" class="btn btn-danger">Submit</button>
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