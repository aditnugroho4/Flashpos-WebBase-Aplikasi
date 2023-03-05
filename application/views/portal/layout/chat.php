<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<script>
var load;
var interval;
var onlineCheck = false;
var chatRoom = false;
jQuery.event.special.touchstart = {
    setup: function(_, ns, handle) {
        if (ns.includes("noPreventDefault")) {
            this.addEventListener("touchstart", handle, {
                passive: false
            });
        } else {
            this.addEventListener("touchstart", handle, {
                passive: true
            });
        }
    }
};
$(document).ready(function() {
    // Session 
    var session =
        "<?php if(isset($_SESSION['654321member__chat'])) echo ($_SESSION['654321member__chat']['id']);?>";
    var user =
        "<?php if(isset($_SESSION['654321member__chat'])) echo ($_SESSION['654321member__chat']['nama']);?>";
    var adminId = null;

    // elementasi form
    var chat = $('.chat');
    var elementLogin = $('#chat_login');
    var elementChat = $('#chat_converse');
    var control = $('.fab_field');
    var notif = $('.online');
    chat.hide();
    var messageSend = control.find('#chatSend');

    var myStorage = localStorage;

    $('#prime').click(function() {
        if (chatRoom == false) {
            chat.show();
            chatRoom = true;
        } else if (chatRoom == true) {
            chat.hide();
            chatRoom = false;
        }
        toggleFab();
        Notification(false);
    });
    //Toggle chat and links
    function toggleFab() {
        $('.prime').toggleClass('zmdi-comment-outline');
        $('.prime').toggleClass('zmdi-close');
        $('.prime').toggleClass('is-active');
        $('.prime').toggleClass('is-visible');
        $('#prime').toggleClass('is-float');
        $('.chat').toggleClass('is-visible');
        $('.fak').toggleClass('is-visible');
        hideChat(0);
    }

    $('#chat_first_screen').click(function(e) {
        if (session) {
            hideChat(2);
            loadChatHistory();
            messageSend.focus();
            onlineCheck = true;
        } else {
            hideChat(1);
            onlineCheck = false;
        }
    });

    $('#chat_second_screen').click(function(e) {
        hideChat(2);
    });

    $('#chat_third_screen').click(function(e) {
        hideChat(3);
    });

    $('#chat_fourth_screen').click(function(e) {
        hideChat(4);
    });

    $('#chat_fullscreen_loader').click(function(e) {
        $('.fullscreen').toggleClass('fa-window-maximize');
        $('.fullscreen').toggleClass('fa-window-restore');
        $('.chat').toggleClass('chat_fullscreen');
        $('.fak').toggleClass('is-hide');
        $('.header_img').toggleClass('change_img');
        $('.img_container').toggleClass('change_img');
        $('.chat_header').toggleClass('chat_header2');
        $('.fab_field').toggleClass('fab_field2');
        $('.chat_converse').toggleClass('chat_converse2');
    });

    function hideChat(hide) {
        switch (hide) {
            case 0:
                $('#chat_welcome').css('display', 'block');
                $('#chat_converse').css('display', 'none');
                $('#chat_login').css('display', 'none');
                $('#chat_body').css('display', 'none');
                // $('#chat_form').css('display', 'none');
                $('.fab_field').css('display', 'none');
                $('.chat_fullscreen_loader').css('display', 'none');
                $('#chat_fullscreen').css('display', 'none');
                $('.fab_field').find('#chatSend').off('keydown', onMetaAndEnter).prop("disabled", true).blur();
                break;
            case 1:
                $('#chat_login').css('display', 'block');
                $('#chat_converse').css('display', 'none');
                $('#chat_welcome').css('display', 'none');
                // $('#chat_body').css('display', 'none');
                // $('#chat_form').css('display', 'none');                
                $('.chat_fullscreen_loader').css('display', 'block');
                $('.fab_field').css('display', 'none');
                break;
            case 2:
                $('#chat_converse').css('display', 'block');
                $('#chat_login').css('display', 'none');
                $('#chat_welcome').css('display', 'none');
                // $('#chat_body').css('display', 'none');
                // $('#chat_form').css('display', 'none');
                $('.chat_fullscreen_loader').css('display', 'block');
                $('.fab_field').css('display', 'block');
                $('.fab_field').find('#chatSend').keydown(onMetaAndEnter).prop("disabled", false).focus();
                $('.fab_field').find('#fab_send').click(sendNewMessage);
                break;
            case 3:
                $('#chat_converse').css('display', 'none');
                $('#chat_body').css('display', 'none');
                // $('#chat_form').css('display', 'block');
                $('.chat_login').css('display', 'none');
                $('.chat_fullscreen_loader').css('display', 'block');
                break;
            case 4:
                $('#chat_converse').css('display', 'none');
                $('#chat_body').css('display', 'none');
                $('#chat_form').css('display', 'none');
                $('.chat_login').css('display', 'none');
                $('.chat_fullscreen_loader').css('display', 'block');
                $('#chat_fullscreen').css('display', 'block');
                break;
        }
    }

    // controler \\
    // Call Oprator
    $("#chat-form").submit(function(e) {
        e.preventDefault();
        if ($('#chat-form').valid()) {
            elementLogin.append(
                '<div class="loader" style="z-index:1040;"><span><i class="fa fa-spinner fa-spin"></i> connecting...</span></div>'
            );
            $('#btn-send').attr('disabled', 'disabled');
            $.ajax({
                type: "post",
                dataType: "json",
                url: "<?php echo site_url('Chatboot/chat_send_cookie'); ?>",
                data: {
                    nama: $("#txt_nama").val(),
                    email: $("#txt_email").val(),
                    telpon: $("#txt_tlp").val()
                },
                success: function(msg) {
                    if (msg.error == "false") {
                        session = msg.id;
                        loadChatHistory();
                        elementLogin.find('.loader').remove();
                        $("#chat-form")[0].reset();
                        hideChat(2);
                        messageSend.focus();
                        $('#btn-send').removeAttr('disabled');
                        //footer.show();
                        //alert(msg.message);
                    } else if (msg.error == "true") {
                        //element.find(idelement).show();
                        //messageSend.hide();
                        // footer.hide();
                        elementLogin.find('.loader').remove();
                        $("#chat-form")[0].reset();
                        $('#btn-send').removeAttr('disabled');
                        alert(msg.message);
                    }

                }
            });
        }
    });
    // Load history chat
    function loadChatHistory() {
        if (session) {
            elementChat.append(
                '<div class="loader" style="z-index:1040;"><span><i class="fa fa-spinner fa-spin"></i> connecting...</span></div>'
            );
            $.ajax({
                url: "<?php echo site_url('Chatboot/chat_load_message'); ?>",
                dataType: "json",
                type: "post",
                data: {
                    clientId: session,
                    adminId: adminId
                },
                success: function(msg) {
                    if (msg.error == false) {
                        elementChat.html("");
                        var welcome = "Hai.." + user + " Selamat Datang di RSUD LEUWILIANG..";
                        if (msg.data.newMessage) {
                            elementChat.append([
                                '<span class="chat_msg_item chat_msg_item_admin">',
                                '<span class="status__left">Information Center</span>',
                                '<div class="chat_avatar">',
                                '<img src="<?php echo base_url(); ?>asset/portal/img/logo.png" alt="Support RSUD-L"/>',
                                '</div>',
                                welcome.replace(/\<div\>|\<br.*?\>/ig, '\n').replace(
                                    /\<\/div\>/g, '').trim().replace(/\n/g, '<br>'),
                                '</span>'
                            ].join(''));
                            for (var i = 0; i < msg.data.newMessage.length; i++) {
                                if (msg.data.newMessage[i].clientId == session && msg.data
                                    .newMessage[i].adminId == null) {
                                    elementChat.append([
                                        '<span class="chat_msg_item chat_msg_item_user">',
                                        '<span class="status__right">Saya | (' +
                                        msg
                                        .data.newMessage[i].date +
                                        ')</span>',
                                        '<div class="chat_avatar">',
                                        '<i class="fas fa-user-tie fa-2x paddingtop-10"></i></div>',
                                        msg.data.newMessage[i].message.replace(
                                            /\<div\>|\<br.*?\>/ig, '\n').replace(
                                            /\<\/div\>/g, '').trim().replace(/\n/g, '<br>'),
                                        '</span>'
                                    ].join(''));
                                } else if (msg.data.newMessage[i].clientId == session && msg.data
                                    .newMessage[i].adminId != null) {
                                    if (msg.data.newMessage[i].status == null) {
                                        readChat(msg.data.newMessage[i].id);
                                    }
                                    elementChat.append([
                                        '<span class="chat_msg_item chat_msg_item_admin">',
                                        '<span class="status__left">' + msg.data
                                        .newMessage[i]
                                        .namaAdmin.nama + ' (' + msg.data.newMessage[i]
                                        .date +
                                        ')</span>',
                                        '<div class="chat_avatar">',
                                        '<img src="<?= base_url(); ?>asset/images/user/' +
                                        msg.data.newMessage[i].namaAdmin.foto +
                                        '" alt="Support ' +
                                        user + '"/>',
                                        '</div>',
                                        msg.data.newMessage[i].message.replace(
                                            /\<div\>|\<br.*?\>/ig, '\n').replace(
                                            /\<\/div\>/g, '').trim().replace(/\n/g, '<br>'),
                                        '</span>'

                                    ].join(''));
                                }
                            }
                            adminId = msg.data.newMessage[0].adminId;
                        }
                        if (msg.data.length == 0) {
                            var welcome = "Hai.." + user + " Selamat Datang di RSUD LEUWILIANG..";
                            elementChat.append([
                                '<span class="chat_msg_item chat_msg_item_admin">',
                                '<span class="status__left">Information Center</span>',
                                '<div class="chat_avatar">',
                                '<img src="<?php echo base_url(); ?>asset/portal/img/logo.png" alt="Support Information Center"/>',
                                '</div>',
                                welcome.replace(/\<div\>|\<br.*?\>/ig, '\n').replace(
                                    /\<\/div\>/g, '').trim().replace(/\n/g, '<br>'),
                                '</span>',
                            ].join(''));
                        }
                        elementChat.finish().animate({
                            scrollTop: elementChat.prop("scrollHeight")
                        }, 250);
                    }
                    Notification(true);
                    notif.find('.lampu').remove();
                    elementChat.find('.loader').remove();
                }
            });
        }
    }
    // Triger
    function onMetaAndEnter(event) {
        if ((event.metaKey || event.ctrlKey) && event.keyCode == 13) {
            sendNewMessage();
        }
    }
    $('#fab_send').click(function() {
        if (onlineCheck == true) {
            sendNewMessage();
        } else {
            messageSend.focus();
        }
    });

    function sendNewMessage() {
        Notification(false);
        //alert('Fuck Me..');   
        var newMessage = messageSend.val();
        newMessage.replace(/\<div\>|\<br.*?\>/ig, '\n').replace(/\<\/div\>/g, '').trim().replace(/\n/g, '<br>');

        if (!newMessage) return;

        elementChat.append([
            '<span class="chat_msg_item chat_msg_item_user">',
            '<span class="status__left">new</span>',
            '<div class="chat_avatar"><i class="fas fa-user-tie fa-2x paddingtop-10"></i></div>',
            newMessage,
            '</span>'
        ].join(''));
        messageSend.val('');
        messageSend.focus();
        elementChat.finish().animate({
            scrollTop: elementChat.prop("scrollHeight")
        }, 250);
        // Sending to Database 
        $.ajax({
            url: "<?php echo site_url('Chatboot/chat_send_message'); ?>",
            dataType: "json",
            type: "post",
            data: {
                adminId: adminId,
                clientId: session,
                message: newMessage
            },
            success: function(msg) {
                if (msg.error == false) {
                    Notification(true);
                }
            }
        });
    }
    // Load Replay Message
    function Notification(flag) {
        if (flag == true) {
            interval = setInterval(function() {
                loadReplayMessage();
            }, 5000);
        } else if (flag == false) {
            clearInterval(interval);
            notif.find('.lampu').remove();
        }
    }

    function loadReplayMessage() {
        $.ajax({
            url: "<?php echo site_url('Chatboot/chat_load_message'); ?>",
            dataType: "json",
            type: "post",
            data: {
                clientId: session,
                adminId: adminId
            },
            success: function(msg) {
                if (msg.error == false) {
                    if (msg.count) {
                        Notification(false);
                        for (var i = 0; i < msg.data.newMessage.length; i++) {
                            if (msg.data.newMessage[i].clientId == session || msg.data.newMessage[i]
                                .adminId == adminId) {
                                if (msg.data.newMessage[i].status == null) {
                                    elementChat.append([
                                        '<span class="chat_msg_item chat_msg_item_admin">',
                                        '<span class="status__left">' + msg.data
                                        .newMessage[i]
                                        .namaAdmin.nama + ' (' + msg.data.newMessage[i]
                                        .date +
                                        ')</span>',
                                        '<div class="chat_avatar">',
                                        '<img src="<?= base_url(); ?>asset/images/user/' +
                                        msg.data.newMessage[i].namaAdmin.foto +
                                        '" alt="Support Rsud Leuwiliang"/>',
                                        '</div>',
                                        msg.data.newMessage[i].message.replace(
                                            /\<div\>|\<br.*?\>/ig, '\n').replace(
                                            /\<\/div\>/g, '').trim().replace(/\n/g, '<br>'),
                                        '</span>'
                                    ].join(''));
                                    readChat(msg.data.newMessage[i].id);
                                    load = true;
                                }
                            }
                        }
                        if (load == true) {
                            load == false;
                            var audioElement = document.getElementById("audio");
                            audioElement.setAttribute('src',
                                "<?php echo base_url();?>vocal/clink-clink.mp3");
                            audioElement.volume = 0.8;
                            audioElement.autoplay = true;
                            audioElement.load();
                            elementChat.finish().animate({
                                scrollTop: elementChat.prop("scrollHeight")
                            }, 250);
                        }
                        Notification(true);
                    }
                } else {
                    Notification(true);
                }
            }
        });
        return;
    }

    function readChat(selectedId) {
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "<?php echo site_url('Chatboot/read_chat/m_user_chat_replay/status'); ?>/" +
                selectedId + "/R",
            success: function(data) {}
        });
    }
});
</script>
<div class="fabs">
    <div class="chat">
        <div class="chat_header">
            <div class="chat_option">
                <div class="header_img">
                    <img width="55" height="58" class="lazyload"
                        data-src="<?php echo base_url(); ?>asset/admin/plugins/chat-room/img/cs-ico.png"
                        alt="Live Chat RSUD LEUWILIANG" />
                </div>
                <span id="chat_head">RSUD LEUWILIANG</span> <br> <span class="agent">Support</span><span
                    class="online">(<i class="spinner-grow spinner-grow-sm text-danger lampu" role="status"></i>
                    Online)</span>
                <span id="chat_fullscreen_loader" class="chat_fullscreen_loader"><i
                        class="fullscreen fa fa-window-maximize"></i></span>
                <audio id="audio" autoplay style="display:none;"></audio>
            </div>
        </div>
        <div id="chat_welcome" class="chat_body">
            <div id="chat_first_screen" class="fak"><i class="fas fa-arrow-right"></i></div>
            <p>Hai.. Terima Kasih Telah Mengunjungi Kami Temukan kemudahan berkomunikasi dengan kami seputar informasi
                pelayanan rumah sakit </p>
        </div>
        <div id="chat_login" class="chat_conversion chat_converse">
            <div class="fak"><i class="fas fa-envelope-open-text"></i></div>
            <p class="text-center">Masukan Data untuk memulai percakapan dengan kami..</p>
            <form id="chat-form" class="chat_form">
                <div class="message_form">
                    <div class="col-md-12">
                        <label for="txt_nama"><i class="fas fa-user"></i> Isi Nama</label>
                        <input type="text" class="form-control mb-5" id="txt_nama" name="Nama" maxlength="50" required
                            autofocus>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="txt_email"><i class="fa fa-envelope"></i> Alamat Email</label>
                        <input type="email" class="form-control mb-5" id="txt_email" name="Email" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="txt_tlp"><i class="fab fa-whatsapp"></i> Nomor untuk kami
                            Hubungi</label>
                        <input type="number" class="form-control mb-5" id="txt_tlp" name="Telpon" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <input type="submit" id="btn-send" class="btn btn-primary btn-block" value="Mulai Percakapan" />
                    </div>
                </div>
            </form>
        </div>
        <div id="chat_converse" class="chat_conversion chat_converse">
        </div>
        <div class="fab_field">
            <div id="fab_camera" class="fak"><i class="fa fa-camera"></i></div>
            <div id="fab_send" class="fak send-chat"><i class="fa fa-paper-plane"></i></div>
            <textarea id="chatSend" name="chat_message" placeholder="Send a message"
                class="chat_field chat_message"></textarea>
        </div>
    </div>
    <div id="prime" class="fak"><i class="far fa-comments prime"></i></div>
</div>