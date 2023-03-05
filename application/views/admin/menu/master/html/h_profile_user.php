<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php $id=$this->input->get('role'); $date = R::isoDateTime();
$this->load->view('admin/menu/master/function/f_profile_user');
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <!-- Breadcrumb -->
        <div class="row mb-2">
            <div class="col-sm-4">
                <h1>Profile Setting</h1>
            </div>
            <div class="col-sm-8">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">User Profile</li>
                </ol>
            </div>
        </div>
        <!-- End -->
        <!-- Info Pannel -->
        <div class="row">
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Messages</span>
                        <span class="info-box-number">0</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-success"><i class="far fa-flag"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Bookmarks</span>
                        <span class="info-box-number">0</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="far fa-copy"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Uploads</span>
                        <span class="info-box-number">0</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-danger"><i class="far fa-star"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Likes</span>
                        <span class="info-box-number">0</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>
    </div>
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle"
                                src="<?php if(!$user->foto){echo (base_url('asset/images/user/avatar5.png'));}else {echo  (base_url('asset/images/user/'.$user->foto));}  ?>"
                                alt="User profile picture">
                        </div>

                        <h3 class="profile-username text-center"><?php echo $user->nama; ?></h3>

                        <p class="text-muted text-center"><?php echo $role->name; ?></p>

                        <button type="button" class="btn btn-primary btn-block edit-foto-profile"><b>Edit
                                Foto</b></button>
                    </div>
                </div>
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Data Sosial</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <strong><i class="fab fa-whatsapp mr-1"></i> WhatsApp</strong>

                        <p class="text-muted">
                            <?php echo $user->whatsapp;?>
                        </p>

                        <hr>

                        <strong><i class="fas fa-map-marker-alt mr-1"></i> Alamat</strong>

                        <p class="text-muted"><?php echo $user->alamat;?></p>

                        <hr>

                        <strong><i class="fas fa-pencil-alt mr-1"></i> Sosial Media</strong>

                        <p class="text-muted">
                            <span class="tag tag-danger"><?php echo $user->email;?></span>
                            <span class="tag tag-success"><?php echo $user->facebook;?></span>
                            <span class="tag tag-info"><?php echo $user->instagram;?></span>
                            <span class="tag tag-warning"><?php echo $user->youtube;?></span>
                            <span class="tag tag-primary"><?php echo $user->twitter;?></span>
                        </p>

                        <hr>

                        <strong><i class="far fa-file-alt mr-1"></i> Experience</strong>

                        <p class="text-muted"><?php echo $user->pengalaman;?></p>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <div class="col-md-9">
                <div class="card load-prof">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab">Data Pegawai</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Status
                                    Account</a>
                            </li>
                            <li class="nav-item"><a class="nav-link active" href="#settings"
                                    data-toggle="tab">Settings</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane" id="activity">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <?php if($employ!= null){?>
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
                                                            value="<?= $employ['nama'];?>" class="form-control"
                                                            required>
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
                                                        <select type="text" id="cmbStatus" class="form-control"
                                                            required>
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
                                                        <select type="text" id="cmbProfesi" class="form-control"
                                                            required>
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
                                                        <select type="text" id="cmbPosisi" class="form-control"
                                                            required>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Jabatan</label>
                                                        <input type="text" id="txtJabatan"
                                                            value="<?= $employ['jabatan'];?>" maxlength="20"
                                                            class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <button type="submit"
                                                        class="btn btn-primary float-right">Simpan</button>
                                                </div>
                                            </div>
                                        </form>
                                        <?php }else {?>
                                        <div class="col-lg-12">
                                            <div class="text-center">
                                                <h3>Verifikasi Data Pegawai Gagal Mohon Verifikasi Ulang Via Email</h3>
                                                <button type="button" id="btn_send_ulang" onclick="$.send_ulang();"
                                                    class="btn btn-info btn-sm">Kirim Ulang</button>
                                            </div>
                                        </div>
                                        <?php }?>
                                    </div>
                                </div>
                            </div>
                            <?php $this->load->view('admin/menu/dashboard/function/f_dashboard_guest');?>
                            <div class="tab-pane" id="timeline">
                                <div class="timeline"></div>
                            </div>
                            <div class="active tab-pane" id="settings">
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
                                                <input type="password" maxlength="8" class="form-control"
                                                    id="inputPassword" placeholder="Password" required>
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
</section>

<!-- Dialog Model -->
<div id="frm-edit-foto" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content modal-col-light-blue">
            <div class="modal-header">
                <h4 id="frm-edit-foto-Label" class="modal-title">Form Edit</h4>
            </div>
            <div class="modal-body load-ding">
                <div class="card card-primary">
                    <div class="card-header">
                        <p>Edit Foto Profile</p>
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
<div class="modal fade show" id="SendMail" aria-modal="true" backdrop-static="true">
    <div class="modal-dialog loading">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Kirim Email</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Mengirim Ulang Verifikasi Ke Email ( <?= $user->email?> )</p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" id="btn-send-o" class="btn btn-primary "><i class="fas fa-paper-plane"></i>
                    Kirim</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>