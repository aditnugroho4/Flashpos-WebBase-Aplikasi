<?php
Class Sendemail extends CI_Model
    {
        function send($to,$name,$judul){
            $arr =array();
            try {
                $txt='';
                $to = $to;
                $subject = $judul;
                $txt .= "<div class='text-center row'><img width='68' height='70' src='".base_url("asset/portal/img/icon/akbar-group.png")."'>";
                $txt .=	"<h5>HALO : ".$name."<h5>";
                $txt .= "<p>Terima Kasih Telah Menghubungi Kami, Tetap Berlanggangan Dengan kami Rekomendasikan kepada Teman Dan Kerabat untuk mendapatkan Harga dan pelayanan Terbaik dari kami</p></div>";
                $config = Array(
                        $config['protocol'] = 'smtp',
                        $config['smtp_host'] = 'ssl://smtp.hostinger.co.id',
                        $config['smtp_port'] = 587,
                        'smtp_user' => 'info@akbargrup.id', // change it to yours
                        'smtp_pass' => 'infoAkbargrup1234', // change it to yours
                        'mailtype' => 'html',
                        'newline'  => "\r\n",
                        'charset' => 'iso-8859-1',
                        'wordwrap' => TRUE
                        );
                $txt.="<div class='col-12 mt-5'><h4> Ada Paket A RUMAH Hanya 25 Juta </h4><div class='row'><img class='col-6' src='".base_url("asset/images/blog/27396288de21b895e4e8122d0c351045.png")."'><p class='col-6'>Nikah dapat iPhone 12 Pro Max?\n";
                $txt.="Gimana tuh caranya ?! \n Caranya mudah kok, kalian cukup pilih 'Paket Rumah A' yang didalamnya terdapat item super komplitt, ditambah lagi anda berhak mendapatkan \n Dekorasi (bebas request), \n Gown (bebas pilih), \n Peralatan Catering (full + siap pakai), \n serta MUA Profesioanl (dengan produk high-end)\n";
                $txt.="So tunggu apalagi, langsung aja hubungi kami di nomor 085780555092 atau kalian juga bisa mampir ke gallery kami yang beralamat di \n Jl. Karadenan No.30 (depan alfamart karadenan 4).</p></div></div>";
                $message = $txt;
                $this->load->library('email',$config);
                $this->email->from('info@akbargrup.id'); // change it to yours
                $this->email->to($to);// change it to yours
                $this->email->subject('Info Akbar Grup ');
                $this->email->message($message);
                if($this->email->send())
                    {
                        $arr['error']=true;
                        $arr['code']='101';
                        $arr['message']="email Send Success...";
                    }
                else
                    {
                        $arr['error']=true;
                        $arr['code']='101';
                        $arr['message']=show_error($this->email->print_debugger());
                    }
                }catch (Exception $e) {
                    $arr['error']=true;
                    $arr['code']='102';
                    $arr['message']='Gagal System ..'.$e->getMessage();
                }
            }
        function email_notif($to,$name,$judul){
            $arr =array();
                try {
                    $txt='';
                    $to = $to;
                    $subject = $judul;
                    $txt .= "<div class='text-center row'><img width='68' height='70' src='".base_url("asset/portal/img/icon/akbar-group.png")."'>";
                    $txt .=	"<h5>HALO : ".$name."<h5>";
                    $txt .= "<p>Ada Pengunjung Website Menghubungi Akbargrup Mohon Segera Di respond ..!</p></div>";
                    $config = Array(
                            $config['protocol'] = 'smtp',
                            $config['smtp_host'] = 'ssl://smtp.hostinger.co.id',
                            $config['smtp_port'] = 587,
                            'smtp_user' => 'info@akbargrup.id', // change it to yours
                            'smtp_pass' => 'infoAkbargrup1234', // change it to yours
                            'mailtype' => 'html',
                            'newline'  => "\r\n",
                            'charset' => 'iso-8859-1',
                            'wordwrap' => TRUE
                            );
                    $txt .= '<div class="btn btn-primary"><a href="https://akbargrup.id/Admin"> Buka Chatroom..</a></div>';
                    $message = $txt;
                    $this->load->library('email',$config);
                    $this->email->from('info@akbargrup.id'); // change it to yours
                    $this->email->to($to);// change it to yours
                    $this->email->subject('Info Akbar Grup ');
                    $this->email->message($message);
                    if($this->email->send())
                        {
                            $arr['error']=true;
                            $arr['code']='101';
                            $arr['message']="email Send Success...";
                        }
                    else
                        {
                            $arr['error']=true;
                            $arr['code']='101';
                            $arr['message']=show_error($this->email->print_debugger());
                        }
                    }catch (Exception $e) {
                        $arr['error']=true;
                        $arr['code']='102';
                        $arr['message']='Gagal System ..'.$e->getMessage();
                    }
            }
    
        function email_verifikasi($to,$name,$judul,$link){
            $arr =array();
                try {
                    $txt='';
                    $to = $to;
                    $subject = $judul;
                    $txt='<div style="margin:0 auto;max-width:620px">
                    <table align="center" border="0" cellpadding="0" cellspacing="0"
                        style="border-spacing:0;font-family:Arial,sans-serif;margin:0 auto;width:100%;max-width:600px;padding:0;table-layout:fixed;background-color:#f08b17"
                        width="100%">
                        <tbody>
                            <tr>
                                <td align="center" height="100%" style="padding:10px 0 0" valign="top" width="100%">
                                    <table align="center" bgcolor="#e8f3f1" border="0" cellpadding="0" cellspacing="0"
                                        style="max-width:600px" width="100%">
                                        <tbody>
                                            <tr>
                                                <td align="center">
                                                    <div style="color:inherit;font-size:inherit;line-height:inherit">
                                                        <table border="0" cellspacing="0" cellpadding="0" width="100%">
                                                            <tbody>
                                                                <tr>
                                                                    <td align="center" width="100%" style="padding:32px 24px">
                                                                        <a href="#" style="outline:none;text-decoration:none"
                                                                            target="_blank">
                
                                                                            <img src="'.base_url("asset/portal/img/dummy/rsud-new.png").'" height="40" width="227"
                                                                                style="display:block;border:none;width:125px;height:165px"
                                                                                alt="RSUD LEUWILIANG" class="CToWUd">
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="center">
                                                    <div style="color:inherit;font-size:inherit;line-height:inherit">
                                                        <table border="0" cellspacing="0" cellpadding="0" width="100%">
                                                            <tbody>
                                                                <tr>
                                                                    <td align="center" width="100%" style="padding:32px 24px">
                                                                    <h3>HAI.. '.$name.'</h3>
                                                                    <h4>Silahkan Verifikasi Account Anda Di sini</h4>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div
                                                        style="color:inherit;font-size:inherit;line-height:inherit; margin-bottom:20px">
                
                                                        <table class="m_3710274538006271759flexible" align="center" border="0"
                                                            cellspacing="0" cellpadding="0">
                                                            <tbody>
                                                                <tr>
                                                                    <td dir="ltr" align="center"
                                                                        style="padding:12px 18px;background:#0094ff;border-radius:4px"
                                                                        bgcolor="#0094FF">
                                                                        <table border="0" cellspacing="0" cellpadding="0">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td valign="middle">
                                                                                        <a href="'.base_url('login/signup?').'token='.$link.'"
                                                                                            style="font:bold 16px/24px arial,sans-serif;color:#ffffff;text-decoration:none"
                                                                                            target="_blank">
                                                                                            Verifikasi Account
                                                                                        </a>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table align="center" border="0" cellpadding="0" cellspacing="0"
                        style="border-spacing:0;font-family:Arial,sans-serif;margin:0 auto;width:100%;max-width:600px;padding:0;table-layout:fixed;background-color:#f08b17"
                        width="100%">
                        <tbody>
                            <tr>
                                <td align="center" height="100%" style="padding:10px 0 0" valign="top" width="100%">
                                    <table align="center" bgcolor="#e8f3f1" border="0" cellpadding="0" cellspacing="0"
                                        style="max-width:600px" width="100%">
                                        <tbody>
                                            <tr>
                                                <td align="center">
                                                    <div style="color:inherit;font-size:inherit;line-height:inherit">
                                                        <table border="0" cellspacing="0" cellpadding="0" width="100%">
                                                            <tbody>
                                                                <tr>
                                                                    <td align="center" width="100%" style="padding:32px 24px">
                                                                        <a href="'.base_url().'" style="outline:none;text-decoration:none"
                                                                            target="_blank">Email : support@rsudleuwiliang.id
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="center" width="100%" style="padding:5px;">
                                                                        <p>Jl. Raya Leuwiliang - Bogor, Cibeber I,
                                                                            Leuwiliang, Bogor, Jawa Barat 16640</p>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="center" width="100%" style="padding:5px 0 20px;">
                                                                        <p>(0251) 8643290</p>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>';
                    $config = Array(
                        $config['protocol'] = 'smtp',
                        $config['smtp_host'] = 'ssl://smtp.hostinger.co.id',
                        $config['smtp_port'] = 587,
                            'smtp_user' => 'support@rsudleuwiliang.id', // change it to yours
                            'smtp_pass' => 'supportRsudL4321', // change it to yours
                            'mailtype' => 'html',
                            'newline'  => "\r\n",
                            'charset' => 'iso-8859-1',
                            'wordwrap' => TRUE
                                    );
                        $message = $txt;
                        $this->load->library('email',$config);
                        $this->email->from('support@rsudleuwiliang.id'); // change it to yours
                        $this->email->to($to);// change it to yours
                        $this->email->subject('Verifikasi Email RSUD LEUWILIANG ');
                        $this->email->message($message);
                        if($this->email->send())
                            {
                            $arr['error']=false;
                            $arr['code']='100';
                            $arr['message']="Mengirim Email Berhasil..";
                            }
                            else{
                                $arr['error']=true;
                                $arr['code']='200';
                                $arr['message']=show_error($this->email->print_debugger());
                            }
                    }catch (Exception $e) {
                        $arr['error']=true;
                        $arr['code']='102';
                        $arr['message']='Gagal System ..'.$e->getMessage();
                    }
                    return ($arr);
            }
        function email_verifikasi_success($to,$name,$judul,$link){
                $arr =array();
                    try {
                        $txt='';
                        $to = $to;
                        $subject = $judul;
                        $txt='<div style="margin:0 auto;max-width:620px">
                        <table align="center" border="0" cellpadding="0" cellspacing="0"
                            style="border-spacing:0;font-family:Arial,sans-serif;margin:0 auto;width:100%;max-width:600px;padding:0;table-layout:fixed;background-color:#f08b17"
                            width="100%">
                            <tbody>
                                <tr>
                                    <td align="center" height="100%" style="padding:10px 0 0" valign="top" width="100%">
                                        <table align="center" bgcolor="#e8f3f1" border="0" cellpadding="0" cellspacing="0"
                                            style="max-width:600px" width="100%">
                                            <tbody>
                                                <tr>
                                                    <td align="center">
                                                        <div style="color:inherit;font-size:inherit;line-height:inherit">
                                                            <table border="0" cellspacing="0" cellpadding="0" width="100%">
                                                                <tbody>
                                                                    <tr>
                                                                        <td align="center" width="100%" style="padding:32px 24px">
                                                                            <a href="#" style="outline:none;text-decoration:none"
                                                                                target="_blank">
                    
                                                                                <img src="'.base_url("asset/portal/img/dummy/rsud-new.png").'" height="40" width="227"
                                                                                    style="display:block;border:none;width:125px;height:165px"
                                                                                    alt="RSUD LEUWILIANG" class="CToWUd">
                                                                            </a>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td align="center">
                                                        <div style="color:inherit;font-size:inherit;line-height:inherit">
                                                            <table border="0" cellspacing="0" cellpadding="0" width="100%">
                                                                <tbody>
                                                                    <tr>
                                                                        <td align="center" width="100%" style="padding:32px 24px">
                                                                        <h3>HAI.. '.$name.'</h3>
                                                                        <h4>Verifikasi Data Anda Selesai.</h4>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div
                                                            style="color:inherit;font-size:inherit;line-height:inherit; margin-bottom:20px">
                    
                                                            <table class="m_3710274538006271759flexible" align="center" border="0"
                                                                cellspacing="0" cellpadding="0">
                                                                <tbody>
                                                                    <tr>
                                                                        <td dir="ltr" align="center"
                                                                            style="padding:12px 18px;background:#0094ff;border-radius:4px"
                                                                            bgcolor="#0094FF">
                                                                            <table border="0" cellspacing="0" cellpadding="0">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td valign="middle">
                                                                                            <a href="'.base_url('admin').'"
                                                                                                style="font:bold 16px/24px arial,sans-serif;color:#ffffff;text-decoration:none"
                                                                                                target="_blank">
                                                                                                Verifikasi Account
                                                                                            </a>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table align="center" border="0" cellpadding="0" cellspacing="0"
                            style="border-spacing:0;font-family:Arial,sans-serif;margin:0 auto;width:100%;max-width:600px;padding:0;table-layout:fixed;background-color:#f08b17"
                            width="100%">
                            <tbody>
                                <tr>
                                    <td align="center" height="100%" style="padding:10px 0 0" valign="top" width="100%">
                                        <table align="center" bgcolor="#e8f3f1" border="0" cellpadding="0" cellspacing="0"
                                            style="max-width:600px" width="100%">
                                            <tbody>
                                                <tr>
                                                    <td align="center">
                                                        <div style="color:inherit;font-size:inherit;line-height:inherit">
                                                            <table border="0" cellspacing="0" cellpadding="0" width="100%">
                                                                <tbody>
                                                                    <tr>
                                                                        <td align="center" width="100%" style="padding:32px 24px">
                                                                            <a href="'.base_url().'" style="outline:none;text-decoration:none"
                                                                                target="_blank">Email : support@rsudleuwiliang.id
                                                                            </a>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td align="center" width="100%" style="padding:5px;">
                                                                            <p>Jl. Raya Leuwiliang - Bogor, Cibeber I,
                                                                                Leuwiliang, Bogor, Jawa Barat 16640</p>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td align="center" width="100%" style="padding:5px 0 20px;">
                                                                            <p>(0251) 8643290</p>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>';
                        $config = Array(
                            $config['protocol'] = 'smtp',
                            $config['smtp_host'] = 'ssl://smtp.hostinger.co.id',
                            $config['smtp_port'] = 587,
                                'smtp_user' => 'support@rsudleuwiliang.id', // change it to yours
                                'smtp_pass' => 'supportRsudL4321', // change it to yours
                                'mailtype' => 'html',
                                'newline'  => "\r\n",
                                'charset' => 'iso-8859-1',
                                'wordwrap' => TRUE
                                        );
                            $message = $txt;
                            $this->load->library('email',$config);
                            $this->email->from('support@rsudleuwiliang.id'); // change it to yours
                            $this->email->to($to);// change it to yours
                            $this->email->subject('Verifikasi Email RSUD LEUWILIANG ');
                            $this->email->message($message);
                            if($this->email->send())
                                {
                                $arr['error']=false;
                                $arr['code']='100';
                                $arr['message']="Mengirim Email Berhasil..";
                                }
                                else{
                                    $arr['error']=true;
                                    $arr['code']='200';
                                    $arr['message']=show_error($this->email->print_debugger());
                                }
                        }catch (Exception $e) {
                            $arr['error']=true;
                            $arr['code']='102';
                            $arr['message']='Gagal System ..'.$e->getMessage();
                        }
                        return ($arr);
                }
    }
?>