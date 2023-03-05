<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Chatboot extends CI_Controller {
	private $Auth;
	function __construct(){
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->library(array('form_validation','session','layout','rb'));
		$this->load->database();
		$this->load->helper(array('form', 'url','html','file','cookie'));
		$this->load->model('sendemail');
		if($this->session->userdata('654321member__chat'))
				{
					$session_data = $this->session->userdata('654321member__chat');
					$this->Auth['user'] = $session_data['id'];
					$this->Auth['nama'] = $session_data['nama'];
					$this->Auth['email'] = $session_data['email'];
					$this->Auth['telpon'] = $session_data['telpon'];
				}else{
					$this->Auth['user'] = 0;
				}
		}
// Function Chat Boot 
	public function chat_send_cookie(){
		R::setStrictTyping(false);
		$date = R::isoDateTime();
		$arr =array();
		$cookie=array();
		$id=0;
		try{
			if($this->input->post()){
				// cek email 
				$sql = R::findOne('m_user_member','email=?',array($this->input->post('email')));
					if(!$sql){
						$dump = R::dispense("m_user_member");
						$dump->first_name = $this->input->post('nama');
						$dump->email =$this->input->post('email');
						$dump->telpon =$this->input->post('telpon');
						$dump->date = $date;
						$id=R::store($dump);

						$cookie = array(
							'id'=>$id,
							'nama'=>$this->input->post('nama'),
							'email'=> $this->input->post('email'),
							'telpon'=> (string)$this->input->post('telpon')
						);
					}else {
						$id = $sql->id;
					}
				// create session chat
					$cookie = array(
						'id'=>$id,
						'nama'=>$this->input->post('nama'),
						'email'=> $this->input->post('email'),
						'telpon'=> (string)$this->input->post('telpon')
					);
				$this->sendemail->send($this->input->post('email'),$this->input->post('nama'),"Layanan Information Center RSUD Leuwiliang");
				//$this->chat_send_marketing($id,$date);
				$this->session->set_userdata('654321member__chat', $cookie);	
				$arr['nama']=$this->input->post('nama');
				$arr['id']=$id;
				$arr['code']=200;
				$arr['error']='false';
				$arr['message']="System Success...";				
				
			}else{
				$arr['code']=100;
				$arr['error']='true';
				$arr['message']="System failed...";
			}
		}catch (Exception $e) {
			$arr['code']=101;
			$arr['error']='true';
			$arr['message']=$e->getMessage();
		}
		echo json_encode($arr);
		}
	public function chat_send_message(){
		R::setStrictTyping(false);
		$date = R::isoDateTime();
		$arr =array();
		$id=0;
		try{
			if($this->input->post()){
				// cek email 
				$dump = R::dispense("m_user_chat_replay");
				$dump->message = $this->input->post('message');
				$dump->member_id =$this->input->post('clientId');
				$dump->date =$date;
				$id = R::store($dump);

				$status = R::getAll('SELECT * FROM m_user_chat_replay WHERE member_id= ? AND replay_id=? AND activ IS NULL',array($this->input->post('clientId'),$this->input->post('adminId')));
						if($status){
							foreach ($status as $key => $value) {
								$read = R::load('m_user_chat_replay',$value['id']);
								$read->status ='R';
								R::store($read);
							}
						}
				if($id){
					$arr['code']=200;
					$arr['error']=false;
					$arr['id']=$this->input->post('clientId');
					$arr['message']="New Message..";
				}else{
					$arr['code']=100;
					$arr['error']=true;
					$arr['message']="System failed...";
				}
			}else{
				$arr['code']=101;
				$arr['error']=true;
				$arr['message']="System failed...";
			}
		}catch (Exception $e) {
			$arr['code']=102;
			$arr['error']=true;
			$arr['message']=$e->getMessage();
		}
		echo json_encode($arr);
		}
	public function chat_load_message(){
		R::setStrictTyping(false);
		$date = R::isoDateTime();
		$arr =array();
		$id=0;
		try{
			if($this->input->post()){
				// cek Pesan 
				$message=array();
					$sqlClient = R::getAll('SELECT * FROM m_user_chat_replay WHERE member_id=? AND activ IS NULL',array($this->input->post('clientId')));
					if($sqlClient){
						foreach($sqlClient as $key=>$v){
							$message['newMessage'][]=array('id'=>$v['id'],
												'message'=>$v['message'],
												'adminId'=>$v['replay_id'],
												'clientId'=>$v['member_id'],
												'status'=>$v['status'],
												'date'=>$v['date'],
												'nama'=>R::load('m_user_member',$v['member_id'])->first_name,
												'namaAdmin'=>R::load('m_user',$v['replay_id'])->export()
											);
							if($v['member_id']== $this->input->post('clientId') && $v['replay_id'] != null && $v['status'] == null ){
								$i =1;
								$arr['count']= $i++;
							}
						}	
					}
				$arr['data']=$message;		
				$arr['code']=200;
				$arr['error']=false;
				$arr['message']="Success..";		
			}else{
				$arr['code']=100;
				$arr['error']='true';
				$arr['message']="System failed...";
			}
		}catch (Exception $e) {
			$arr['code']=101;
			$arr['error']='true';
			$arr['message']=$e->getMessage();
		}
		echo json_encode($arr);
		}
	public function read_chat($table,$fild,$id,$value){
		R::setStrictTyping(false);
		$arr = array();	
		try {
				$sql=R::load($table,$id);
				if($sql){
					$sql->$fild= $value;
					$tes = R::store($sql);
					if($tes){
						$arr['error']=false;
						$arr['code']='200';
						$arr['message']='Merubah Data Berhasil...';
					}else{
						$arr['error']=true;
						$arr['code']='100';
						$arr['message']='Gagal Merubah Data..';
					}
				}else{
					$arr['error']=true;
					$arr['code']='101';
					$arr['message']='Data Tidak Di Temukan..';
				}				
			}catch (Exception $e) {
				$arr['error']=true;
				$arr['code']='102';
				$arr['message']='Gaga System ..'.$e->getMessage();
			}
			echo json_encode($arr);
			// $this->add_log('ACTION USER ' . $table . ' ID ' . $id .' '.$fild.' '.$value);
		}
	public function chat_send_marketing($id,$date){
		$arr = array();
		try{
			$user=R::getAll("SELECT * FROM m_user WHERE role_id=?",array(2));
			if($user){
				foreach($user as $value){
					$this->sendemail->email_notif($value['email'],$value['nama'],'Chat Dari Pelanggan');
				}
				// First Chat email 
				$dump = R::dispense("m_user_chat_replay");
				$dump->message = "Hai.. Bisa bantu saya untuk menanyakan beberapa pertanyaan..?";
				$dump->member_id =$id;
				$dump->date =$date;
				R::store($dump);
			}else{
				$arr['error'] =true;
			}
		}catch (Exception $e){
			$arr['error'] =false;
			$arr['message'] =$e->getMessage();
		}
		return;
	}
	public function clear_session_chat(){
		$id=$this->input->get('end');
		$user = R::load('m_user_member',base64_decode($id));
		$user->auth ='N';
		$user->ipaddress = null;
		$user->date = date("Y-m-d H:i:s");
		R::store($user);
		$this->session->unset_userdata('654321member__chat',FALSE);
		$this->session->sess_destroy();
		redirect('home');
	}
	public function chat_cek_oprator(){
		$ret = array();
		$date = R::isoDateTime();
		try{
			$oprator = R::getAll("SELECT * FROM m_user where auth='Y' AND role_id=1");
			if($oprator){
				$ret['status']=false;
			}else{
				$ret['status']=true;
			}
			
		}catch (Exception $e){
			$ret['error'] =false;
			$ret['message'] =$e->getMessage();
		}
		echo json_encode($ret);
	}
}
?>