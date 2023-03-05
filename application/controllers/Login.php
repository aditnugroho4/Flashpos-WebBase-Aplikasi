<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

function __construct(){
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->library(array('form_validation','session','layout','rb'));
		$this->load->database();
		$this->load->model(array('user','sendemail'));
		
		$this->load->helper(array('form','url'));
	}
	function index($link=null){
			if($this->session->userdata('654321_cbn')){
				redirect('Admin', 'refresh');
				$this->session->unset_userdata('654321_cbn',FALSE);
				}
			else if($this->session->userdata('654321_cbn')){
				redirect('Home', 'refresh');
				$this->session->unset_userdata('654321_cbn',FALSE);
			}else{
				if($link==null) {
					$link = 'admin-menu-login-html-h_signin';
					}
				$this->signin($link);
			}
		}
	public function signin($content=null){
			$data=array('title'=>'FLASH POS | ENTERPRISE',
						'captcha'=>str_replace('-','/',$this->get_captcha()),
						'content'=>str_replace('-','/',$content));
			$this->layout->login('admin/menu/login/html/container',$data);
		}

	public function signup($link=null){
		if($link==null){
			if($this->input->get('token')){
				$cek = R::findOne('t_verifikasi_user','token=? AND status IS NULL',array($_GET['token']));
				if($cek){
					$this->view_verifikasi($cek->email);
				}else {
					$data=array('title'=>'Autentikasi',
							'content'=>str_replace('-','/','portal-menu-product-html-h_notfound'));
					$this->layout->login('admin/menu/login/html/container',$data);
				}
			}else{
				$data=array('title'=>'Autentikasi',
				'content'=>str_replace('-','/','admin-menu-login-html-h_signup'));
				$this->layout->login('admin/menu/login/html/container',$data);
			}
		}else{
			$data=array('title'=>'Autentikasi',
							'content'=>str_replace('-','/','portal-menu-product-html-h_notfound'));
				$this->layout->login('admin/menu/login/html/container',$data);
			}
		}
	private	function view_verifikasi($user){
		$user =R::findOne('m_user','email=?',array($user));
		
		$data=array('title'=>'Autentikasi',
						'user'=>$user,
						'content'=>str_replace('-','/','admin-menu-login-html-h_verifikasi'));
			$this->layout->login('admin/menu/login/html/container',$data);
		}	
	public function forgot(){
			$data=array('title'=>'Autentikasi',
						'captcha'=>$this->get_captcha(),
						'content'=>str_replace('-','/','admin-menu-login-html-h_forgot'));
			$this->layout->login('admin/menu/login/html/container',$data);		
		}
		
	function auth(){
			$arr = array();
			if (!$this->session->userdata('654321_cbn') && $this->input->post('username')){
						$username = $this->input->post('username');
						$password = $this->input->post('password');
						$login = $this->user->login($username,base64_decode($password));
							if($login){
									$sess_array = array();
									foreach($login as $row)
												{
													if($row->verifikasi =='Y'){	
														$sess_array = array(
															'user' => $row->id,
															'role'=> $row->role_id,
															'employ'=> $row->employ_id,
															'unit'=> R::load("m_datapegawai",$row->employ_id)->unit_id,
															'ipaddress'=> $this->input->post('ipaddress'),
															'timeLogin'=> time() 
														);
														$this->session->set_userdata('654321_cbn', $sess_array);
														$arr['auth'] = false ;
														$arr['id'] = $row->id ;
														$arr['code'] = "100" ;
														$arr['message'] = "Login Berhasil..." ;
														$this->ceksession($row->id);
													}else {
														$arr['auth'] = true ;
														$arr['id'] = $row->id ;
														$arr['code'] = "200" ;
														$arr['message'] = "User Belum Melakukan Verifikasi" ;
													}
												}
							}else {
								$arr['auth'] = true ;
								$arr['code'] = "103" ;
								$arr['message'] = "Login Gagal Username atau password Salah" ;
							}
					echo json_encode($arr);		
				}else{
					redirect('login','refresh');
				}	
		}	
	private function ceksession($id){
			$user = R::load('m_user',$id);
			$user->auth ='Y';
			$user->ipaddress = $this->input->post('ipaddress');
			$user->date = date("Y-m-d H:i:s");
			R::store($user);
		}		
	function logout(){
			$id=$this->input->get('end');
			$user = R::load('m_user',base64_decode($id));
			$user->auth ='N';
			$user->ipaddress = null;
			$user->date = date("Y-m-d H:i:s");
			R::store($user);
			$this->session->unset_userdata('654321_cbn',FALSE);
			$this->session->sess_destroy();
			redirect('login');
		}
	function signup_to(){
		R::setStrictTyping(false);
		$ret = array();
		try
			{
			if($this->input->post()){
				$cek = R::findOne('m_user','email=?',array($this->input->post('Email')));
					if (!$cek){
						$bean = R::dispense('m_user');
						$count=R::count('m_user');
						$bean->nama = $this->input->post('Nama');
						$bean->username = str_replace(" ","",substr($this->input->post('Nama'),0,8)).str_pad($count,3,"0",STR_PAD_LEFT);
						$bean->email = $this->input->post('Email');
						$bean->password = md5($this->input->post('Password'));
						$bean->role_id = 5;
						$bean->date = date("Y-m-d H:i:s");
						
						// mengirim email verifikasi 
						$valid = $this->send_verifikasi($this->input->post('Email'),$this->input->post('Nama'),date("Y-m-d H:i:s"));
						
						if($valid){
							$id = R::store($bean);
							if($id){
								$ret['error'] =false;
								$ret['code'] =200;
								$ret['message'] ="Membuat User Berhasil Silahkan </b> Cek Email (".$this->input->post('Email').") Anda Untuk Verifikasi Email";
							}else{
								$ret['error'] =true;
								$ret['code'] =100;
								$ret['message'] ="Gagal Registrasi </b> Silahkan Hubungi Support IT Kami";
							}
						}else {
							$ret['error'] =true;
							$ret['code'] =101;
							$ret['message'] ="Mohon Maaf Saat ini Sistem Verifikasi Sedang Offline.. </b> Tidak dapat melanjut Registrasi";
						}
					}else{
						$ret['error'] =true;
						$ret['code'] =201;
						$ret['message'] ="Mohon cek kembali user EMAIL yang anda Masukan (".$this->input->post('Email').") sudah pernah di gunakan";
					}
					
				}
		}
		catch (Exception $e)
			{
				$ret['error'] =true;
				$ret['code'] =101;
				$ret['message'] =$e->getMessage();
			}
		echo json_encode($ret);
	}

	private function send_verifikasi($email,$nama,$date){
		$arr = array();
		$link = md5($nama.$date);
		try{
			if($email){
				$sending = $this->sendemail->email_verifikasi($email,$nama,'Verifikasi Email',$link);
				if($sending){
					$dump = R::dispense("t_verifikasi_user");
					$dump->email = $email;
					$dump->token = $link;
					$dump->date =$date;
					R::store($dump);
					$arr['error'] =false;
				}
			}else{
				$arr['error'] =true;
			}
		}catch (Exception $e){
			$arr['error'] =false;
			$arr['message'] =$e->getMessage();
		}
		return ($arr);
	}
	private function verif_to(){
		R::setStrictTyping(false);
		$ret = array();
		$date = R::isoDateTime();
		try
			{
				$nip = base64_decode($this->input->post('nip'));
				$id	= $this->input->post('id');
				$token=$this->input->post('token');
			if($this->input->post()){
				$cek = R::findOne('m_datapegawai','nip=? AND flag IS NULL',array($nip));
					if ($cek){
						$link= base_url('admin');
						$user = R::load("m_user",$id);
						$user->role_id =$cek->role_id;
						$user->status ="Y";
						$user->employ_id =$cek->id;
						$user->updtime=$date;
						$valid = $this->sendemail->email_verifikasi_success($user->email,$user->nama,'Verifikasi Pegawai',$link);
						if($valid){
							$id = R::store($user);
							if($id){
								$verif = R::findOne('t_verifikasi_user','token=?',array($token));
								$verif->token=NULL;
								$verif->status="Y";
								$verif->updtime=$date;
								R::store($verif);
								$cek->flag="Y";
								R::store($cek);
								$ret['error'] =false;
								$ret['code'] =200;
								$ret['message'] ="Identifikasi Data Pegawai Berhasil \n Cek Email Untuk Login..";
							}else{
								$ret['error'] =true;
								$ret['code'] =100;
								$ret['message'] ="Data Tidak Valid \n Silahkan Hubungi Support Kami";
							}
						}else {
							$ret['error'] =true;
							$ret['code'] =101;
							$ret['message'] ="Mohon Maaf Saat Ini System Verifikasi Sedang Dalam Perbaikan..";
						}
					}else{
						$verif = R::findOne('t_verifikasi_user','token=?',array($token));
						$verif->status="Y";
						//R::store($verif);
						$ret['error'] =true;
						$ret['code'] =201;
						$ret['message'] ="NIP/NIK/NRPTT (".$nip.") Yang anda Masukan \n Tidak Terdaftar Atau Sudah Pernah Registrasi \n Tidak Hubungi Admin Sistem ini..";
					}
					
				}
		}
		catch (Exception $e)
			{
				$ret['error'] =true;
				$ret['code'] =101;
				$ret['message'] =$e->getMessage();
			}
		echo json_encode($ret);
	}
	private function cek_captcha(){
			R::setStrictTyping(false);
				try{
						$word =$this->input->get('id');
						$expiration = time()-70;
						$arr=array();
						$sql = R::findOne("tb_captcha","word=?",array($word));
								if($sql){
									$arr['error']=false;
									$arr['code']='100';
									$arr['message']='Kode Captcha Benar..';
								}else{
									$arr['error']=true;
									$arr['code']='200';
									$arr['message']='Kode Captcha Salah..';
								}
						$this->db->query("DELETE FROM tb_captcha WHERE captcha_time < ".$expiration);					
					}catch(Exception $e){
						$arr['error']=true;
						$arr['code']='201';
						$arr['message']=$e->getMessage();
							}
				echo json_encode($arr);
			}
			
	private function get_captcha(){	/* Function untuk membuat gambar captcha yang berisi numerik atau angka */
				$CI =& get_instance();
				$this->load->helper(array('captcha')); /* library captcha dari Codeigniter  */
				$captcha = create_captcha(array(
					'word'=> strtoupper(substr(md5(time()), 0, 6)),
					'img_path'=> './asset/admin/images/captcha/',
					'img_url'=> './asset/admin/images/captcha/', /* ini Untuk Menyimpan Temporarry Gambar capcha yang di buat */
					'img_height'=> 50,
					'font_size' => 50,
					'expiration'=>50,
					'pool'          => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
					'colors'        => array(
						'background' => array(255, 255, 255),
						'border' => array(255, 255, 255),
						'text' => array(0, 0, 0),
						'grid' => array(255, 95, 98,1)
				)
				));
				if($captcha){ /* Kondisi dimana angka pada captcha digunakan ketika login */
					$data=array(
								'captcha_time'=>$captcha['time'],
								'ip_address'=>$this->input->ip_address(),
								'word'=>$captcha['word'],);
								$expiration = time()-50; /* Akan di Hapus dari Database */
								$this->db->query("DELETE FROM tb_captcha WHERE captcha_time < ".$expiration);
								$query=$this->db->insert_string('tb_captcha',$data);
								$this->db->query($query);
				}
				else{
					return"captcha not work"; /* Kondisi Pada fuction Ketika Tidak bekerja atau error */
				}
				$CI->session->set_userdata(array('captchasecurity'  => strtoupper(substr(md5(time()), 0, 6))));
				return $captcha['image']; 
			}
			
	private function delete_captcha(){ /* Function ini untuk menghapus file image Captcha pada direktory asset */
				$filename= array();
				if ($handle = opendir('./asset/admin/images/captcha/')) {
				while (false !== ($entry = readdir($handle))) {
					if ($entry != "." && $entry != ".."){
						unlink('./asset/admin/images/captcha/'.$entry);  
						}
					}
					closedir($handle);
				}
			}

	// Login user Member 
	public function member_auth(){
		R::setStrictTyping(false);
		$arr = array();
		try{
			if (!$this->session->userdata('654321member') && $this->input->post('username')){
				$username = $this->input->post('username');
				$password = $this->input->post('password');
				$login = $this->user->login_member($username,$password);
					if($login)
					{
						$sess_array = array();
						foreach($login as $row){
							$sess_array = array(
								'id'=>$row->id,
								'nama'=>$row->first_name,
								'email'=> $row->email,
								'telpon'=> $row->telpon
							);
								$this->session->set_userdata('654321member', $sess_array);
						}
						$arr['auth'] = false ;
						$arr['id'] = $row->id ;
						$arr['code'] = "000" ;
						$arr['message'] = "Login Berhasil..." ;
					}else {
						$arr['auth'] = true ;
						$arr['code'] = "101" ;
						$arr['message'] = "Login Gagal Username atau password Salah" ;
					}
			}else{
				redirect('home','refresh');
			}		
		}catch(Exception $e){
						$arr['error']=true;
						$arr['code']='102';
						$arr['error']=$e->getMessage();
							}
		echo json_encode($arr);
		}
	public function member_singup (){
		R::setStrictTyping(false);
		$arr =array();
			try{
				$sql= R::findOne('m_user_member','email=?',array($this->input->post('email')));
				if ($sql)
					{
						$arr['error'] = true;
						$arr['code']='101';
						$arr['message']='Email Anda sudah terdaftar..!';
					}else {
					if($this->input->post())
						{
						$bean = R::dispense("m_user_member");
						foreach ($this->input->post() as $column => $value)
							{
								$bean->$column = $value;
							}
								$id = R::store($bean);
							}
							$arr['error'] = false;
							$arr['code']='100';
							$arr['message']='Selamat Anda Berhasil Mendaftar..!</br> Silahkan Verifikasi Email Anda..';
						}
				}catch(Exception $e){
					$arr['error']=true;
					$arr['code']='102';
					$arr['message']=$e->getMessage();
						}
		echo json_encode($arr);
		}
	public function member_logout(){
		$id=$this->input->get('end');
		$user = R::load('m_user_member',base64_decode($id));
		$user->auth ='N';
		$user->ipaddress = null;
		$user->date = date("Y-m-d H:i:s");
		R::store($user);
		$this->session->unset_userdata('654321member',FALSE);
		$this->session->sess_destroy();
		redirect('home');
		}	
	
	
}
?>