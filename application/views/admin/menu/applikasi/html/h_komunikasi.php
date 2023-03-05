<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); $date = R::isoDateTime();?>
<?php $this->load->view('admin/menu/applikasi/function/f_komunikasi'); ?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Layanan Komunikasi</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url();?>">Home</a></li>
                    <li class="breadcrumb-item active">Layanan Komunikasi</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>0</h3>
                        <p>Pengunjung</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3 id="new_chat"></h3>
                        <p>Pesan Baru</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3 id="replay_chat">0<sup style="font-size: 20px"></sup></h3>
                        <p>Pesan Terbalas</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>0</h3>
                        <p>Komentar</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-7">
                <div class="card direct-chat direct-chat-primary">
                    <div class="card-header">
                        <h3 class="card-title">Direct Chat</h3>

                        <div class="card-tools">
                            <span class="notif-alert"></span>
                            <span data-toggle="tooltip" title="New Messages" class="badge badge-info total-chat"><i
                                    class="fas fa-comment"></i> 0</span>
                            <span data-toggle="tooltip" title="New Messages" class="badge badge-primary total-msg"><i
                                    class="fas fa-envelope"></i> 0</span>
                            <span data-toggle="tooltip" title="Chat Replay" class="badge badge-success total-replay"><i
                                    class="fas fa-reply"></i> 0</span>
                            <span data-toggle="tooltip" title="Client Respound"
                                class="badge badge-warning total-client"><i class="fas fa-user-circle"></i> 0</span>
                            <button type="button" class="btn btn-tool list-user" data-toggle="tooltip" title="Contacts"
                                data-widget="chat-pane-toggle">
                                <i class="fas fa-comments"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <!-- <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                    class="fas fa-times"></i>
                            </button> -->
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <!-- Conversations are loaded here -->
                        <div class="direct-chat-messages">
                            <!-- Message. Default to the left -->
                            <div class="direct-chat-msg container">

                            </div>
                            <!-- /.direct-chat-msg -->
                        </div>
                        <!--/.direct-chat-messages-->

                        <!-- Contacts are loaded here -->
                        <div class="direct-chat-contacts">
                            <ul class="contacts-list">

                            </ul>
                            <!-- /.contacts-list -->
                        </div>
                        <!-- /.direct-chat-pane -->
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <div class="input-group">
                            <input type="text" id="text-box" contenteditable="true" disabled="true"
                                placeholder="Type Message ..." class="form-control" maxlength="1000">
                            <span class="input-group-append">
                                <input id="btnSend" type="button" class="btn btn-primary" value="Send" />
                            </span>
                        </div>
                    </div>
                    <!-- /.card-footer-->
                </div>
            </div>
            <div class="col-lg-5">
                <!-- USERS LIST -->
                <div class="card member_list">
                    <div class="card-header">
                        <h3 class="card-title">DAFTAR TAMU</h3>
                        <div class="card-tools">
                            <span class="badge badge-info">0 Online Members</span>
                            <span class="badge badge-primary">8 Members</span>
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                            <!-- <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                    class="fas fa-times"></i>
                            </button> -->
                        </div>
                    </div>
                    <div class="card-body p-2">
                        <ul class="users-list clearfix row">
                            <li class="img-thumbnail">
                                <img src="<?= base_url('asset/admin/')?>dist/img/noimages.png" alt="User Image">
                                <a class="users-list-name" href="#">Alexander Pierce</a>
                                <span class="users-list-date">Today</span>
                            </li>
                        </ul>
                    </div>
                    <div class="card-footer text-center load__more">
                        <a href="javascript::">View All Users</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>