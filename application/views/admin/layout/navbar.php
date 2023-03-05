<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<script type="text/javascript">
var date = "<?php echo R::isoDateTime(); ?>";
$(document).ready(function() {
    var d = new Date();
    var days = ['MINGGU', 'SENIN', 'SELASA', 'RABU', 'KAMIS', 'JUMAT', 'SABTU'];
    var Month = ['JANUARI', 'FEBRUARI', 'MARET', 'APRIL', 'MEI', 'JUNI', 'JULI', 'AGUSTUS', 'SEPTEMBER',
        'OKTOBER',
        'NOVEMBER', 'DESEMBER'
    ];
    setInterval(function() {
        d = new Date();
        var x = d.getDay();
        var seconds = d.getSeconds();
        var hours = d.getHours();
        var mins = d.getMinutes();
        $("#Times").html(" JAM : " + hours + " : " + mins + " : " + seconds);

        $("#Days").html(days[x] + " - " + d.getDate() + ", " + Month[d.getMonth()] + " " + d
            .getFullYear());

    }, 1000);

    let sess_out = new Date();
    sess_out.setSeconds(sess_out.getSeconds() + 120);
    sess_out = new Date(sess_out);

    // let int_out = setInterval(function() {
    //             let timeNow = new Date();
    //             if (timeNow > sess_out ) {                    
    //                 // $.alert_swal('Login', "Session Login Berakhir..", 'warning');
    //                 window.location.assign("<?= site_url('login/logout?end='.base64_encode($user->id));?>");
    //                 clearInterval(int_out);
    //             } 
    //         },5000);
    // $('body').on('click',function(){
    //     sess_out = new Date();
    //     sess_out.setSeconds(sess_out.getSeconds()+120);
    //     sess_out = new Date(sess_out);
    //     console.log(sess_out);
    // });
    $.alert_swal = function($info, $message, $alert) {
        Swal.fire({
            icon: $alert,
            title: $info,
            text: $message,
            confirmButtonText: "OK",
            focusConfirm: true
        }).then((result) => {
            if (result.value) {
                window.location.assign(
                    "<?= site_url('login/logout?end='.base64_encode($user->id));?>");
                clearInterval(int_out);
            } else {
                sess_out = new Date();
                sess_out.setSeconds(sess_out.getSeconds() + 120);
                sess_out = new Date(sess_out);
            }
        })
    }

    get_json_notification();
    setInterval(function() {
        get_json_notification();
    }, 10000);
    // Notif
    function get_json_notification() {
        try {
            $.ajax({
                type: "POST",
                dataType: 'json',
                url: "<?php echo site_url('dashboard/json_chat_notif');?>",
                success: function(data) {
                    if (data.error == false) {
                        $(".list_user").html($.base64.decode(data.user_notif));
                        $(".list-notif").html($.base64.decode(data.client_notif));
                        if (data.notif == true) {
                            var audioElement = document.getElementById("audio");
                            audioElement.setAttribute('src',
                                "<?php echo base_url();?>vocal/clink-clink.mp3");
                            audioElement.volume = 0.8;
                            audioElement.autoplay = true;
                            audioElement.load();
                        }
                    }
                }
            });
        } catch (e) {
            console.log(e);
        }
        return;
    }

});
</script>

<nav class="main-header navbar navbar-expand navbar-dark">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="<?= base_url('admin');?>" class="nav-link">Home</a>
        </li>
        <!-- <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Contact</a>
        </li> -->
    </ul>

    <!-- Pencarian Menu..-->
    <!-- <form class="form-inline ml-3">
        <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </form>
    <ul class="navbar-nav ml-3">
        <li class="nav-item d-none d-sm-inline-block">
            <span class="nav-link" id="ex_time"></span>
        </li>
    </ul> -->

    <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown list_user">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-comments"></i>
                <span class="badge badge-danger navbar-badge">0</span>
            </a>
        </li>
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown list-notif">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span class="badge badge-warning navbar-badge">0</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header" id="notif_pesan">0 Notifications</span>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item">
                    <i class="fas fa-envelope mr-2"></i> 0 new messages
                    <span class="float-right text-muted text-sm">3 mins</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-users mr-2"></i> 0 client registrasi
                    <span class="float-right text-muted text-sm">12 hours</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-file mr-2"></i> 0 new reports
                    <span class="float-right text-muted text-sm">0 days</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo site_url('login/logout?end='.base64_encode($user->id));?>">
                <i class="nav-icon fas fa-power-off text-danger"></i>
            </a>
        </li>
    </ul>
</nav>