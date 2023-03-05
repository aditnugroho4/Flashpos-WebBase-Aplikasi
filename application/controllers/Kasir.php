<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Kasir extends CI_Controller {
	private $Auth;
		public function __construct(){
			parent::__construct();
			date_default_timezone_set('Asia/Jakarta');
			$this->load->library(array('Layout','rb','session'));
			$this->load->helper(array('form', 'url','html','file','cookie'));
			$this->load->model(array('user','sendemail'));
			$this->load->database();		
				if(!$this->session->userdata('654321_cbn'))
					{
					$this->session->sess_destroy();
					redirect('login','refresh');
					}
				else
					{
					$session_data = $this->session->userdata('654321_cbn');
					$this->Auth['user'] = $session_data['user'];
					$this->Auth['role'] = $session_data['role'];
					$this->Auth['employ'] = $session_data['employ'];
					$this->Auth['ipaddress'] = $session_data['ipaddress'];
					$this->Auth['unit'] = $session_data['unit'];
					if($this->Auth['employ'] !=null){
						$this->Auth['employ'] =R::load('m_datapegawai',$this->Auth['employ']);
							if($this->Auth['employ']['unit_id'] !=null){
								$unit = R::load('m_unit',$this->Auth['unit']);
								$this->Auth['apps'] = R::load('m_submenu',$unit['app_id']);
							}else{
								$this->Auth['unit'] = null;
								$this->Auth['apps'] = null;
							}
						}else{
							$this->Auth['employ']=null;
						}
				}
			}
		public function index($link=null){
					$role = R::load('m_role',$this->Auth['role']);
					if($role->name == "Kasir"){
						if($link==null) {
							$user = R::load('m_user', $this->Auth['user']);
								if($user->verifikasi == null){
									$link = 'admin-menu-dashboard-html-h_dashboard_guest';
									}else{
										if($this->Auth['unit'] != null){
											$link = str_replace('/','-',$this->Auth['apps']['link_submenu']);					
											}else{
												$link = 'admin-menu-dashboard-html-h_dashboard_guest';
											}
									}
							}
					$this->ceksession($this->Auth['user']);
					$this->page($link);
				}else{
					$this->session->unset_userdata('654321_cbn',FALSE);
					$this->session->sess_destroy();
					redirect('Login', 'refresh');
				}
			}
		public function ceksession($id){
			$user = R::load('m_user',$id);
			$user->auth ='Y';
			$user->ipaddress = $this->Auth['ipaddress'];
			$user->date = date("Y-m-d H:i:s");
			R::store($user);
			}	
		public function page($content=null){
				if($content==null){
						$content = R::load('m_submenu',base64_decode($this->input->get('mod')))->link_submenu;
					}else if($this->input->get('mod')) {
						$content = base64_decode($this->input->get('mod'));
					}
				$data=array('title'=>'FLASH POS',
								'content'=>str_replace('-','/',$content),
								'sidebar' => $this->get_json_sidebar($this->Auth['role']),
								'user'=>R::load('m_user',$this->Auth['user']),
								'role'=>R::load('m_role',$this->Auth['role']),
								'unit'=>R::load('m_unit',$this->Auth['unit']),
								'employ'=>$this->Auth['employ']
							);
				$this->layout->admin('admin/layout/content',$data);		
				}
		private function get_json_sidebar($parent){
			$arr = array();
				try{
					$sql =R::getAll("SELECT * FROM m_menu WHERE role_id='".$parent."' AND status='Y' ORDER BY urut ASC;");
					foreach($sql as $key=>$value){
					$query ="SELECT * FROM m_submenu WHERE menu_id='".$value['id']."' AND unit_id='".$this->Auth['unit']."' AND
					active='Y' ORDER BY urutan";
					$sql2 =R::getAll($query);
					$sub = array();
					foreach($sql2 as $i=>$val){
					$sub[]=array('id'=>$val['id'],
					'label'=>$val['nama_submenu'],
					'link'=>site_url('admin/page')."?mod=".base64_encode($val['id'])."&route=".base64_encode($val['menu_id']));
					}
					$arr['menu'][]=array('id'=>$value['id'],
					'label'=>$value['nama_menu'],
					'tag'=>$value['tag_link'],
					'icon1'=>$value['material_icon'],
					'icon2'=>$value['fonts_icon'],'submenu'=>$sub,
					'lbl_count'=>R::count("m_submenu","menu_id= ? AND unit_id='".$this->Auth['unit']."' AND
					active=?",array($value['id'],'Y')));
					}
					}catch (Exception $e) {
						$arr['error'] =true;
						$arr['code'] =201;
						$arr['message'] =$e->getMessage();
					}
					return($arr);
			}
		public function json_search_data(){
				R::setStrictTyping(false);
				$arr=array();
				try{
					$table = $this->input->get('table');
						$aColumns = explode(',', $this->input->get('columns'));
						$sWhere = "";
						$sQuery = "";
						$MySql = "";
							if ($this->input->get('aSearch') != false && $this->input->get('aSearch') != "" )
								{
								$sWhere = "(";
								for ( $i=0 ; $i<count($aColumns) ; $i++ )
									{
										if ($aColumns[$i] != "") {
											$sWhere .= "".$aColumns[$i]." LIKE '%".R::$adapter->escape( $this->input->get('aSearch') )."%' OR ";
										}
									}
									$sWhere = substr_replace( $sWhere, "", -3 );
									$sWhere .= ') ORDER BY id DESC LIMIT 0,20';
									$MySql= R::getALL('SELECT * FROM '.$table.' WHERE '.$sWhere.';');
								}else if($this->input->get('aSearch') == false && $this->input->get('Sts') != false )
								{
									$MySql= R::getALL('SELECT * FROM '.$table.' WHERE status=?',array($this->input->get('Sts')));
								}else {
									$MySql= R::getALL('SELECT * FROM '.$table.';');
								}
								
							foreach($MySql as $value)
									{
									array_push($arr,$value);
									}
								
				}catch (Exception $e)
					{
						$arr['message']= $e->getMessage();
						$arr['code']= '201';
						$arr['error']= true;
					}
				echo json_encode($arr);	
			}	
		public function autonumber(){
			$angka = null;
			if($this->input->post()){
				$tabel = $this->input->post('tables');
				$lebar = $this->input->post('length');
				$query=R::count($tabel)+1;
				$angka=str_pad($query,$lebar,"0",STR_PAD_LEFT); 
			}else
			{
				$angka = null;
			}
			echo json_encode($angka);
			}	
		public function prosess_stock_permintaan(){
				$ret = array();
				$date = R::isoDateTime();
				$id = 0;
				R::begin();
					try {
					R::setStrictTyping(false);
					$data = $this->input->post('data');
					$data = str_replace("^",".",$data);
					$data = str_replace("-","+",$data);
					$data = str_replace("_","/",$data);
					$hasil = json_decode(base64_decode($data));
					$akun = R::load('m_akun',$hasil->idAkun);
					$faktur = $akun->noakun+1;
					$count = $akun->kode.str_replace('-','',substr($date, 4, 6)).str_pad($faktur,3,"0",STR_PAD_LEFT);
						$addFaktur = R::dispense('k_faktur');
						$addFaktur->kode =$akun->kode;
						$addFaktur->tanggal =$hasil->tanggal;
						$addFaktur->faktur =$count;
						$addFaktur->user_id =$hasil->idUser;
						$addFaktur->akun_id =$akun->id;
						$id = R::store($addFaktur);
						if($id){
							$updFak = R::load('k_faktur',$id);
							$qty =0;
							foreach ($hasil->dataTable as $key => $value) 
									{
									$qty +=$value[3];
									$stock = R::findOne('k_permintaan','kode= ? AND faktur_id=?', array($value[1],$id));
									if($stock){
										$stock->qty += $value[3];
										R::store($stock);
									}else{
										$detail = R::dispense('k_permintaan');
										$detail->kode = $value[1];
										$detail->nama = $value[2];
										$detail->qty = $value[3];
										$detail->tanggal = $value[4];
										$detail->foto = $value[5];
										$detail->satuan = $value[6];
										$detail->jenis_id = $value[7];
										$detail->faktur_id = $id;										
										R::store($detail);
									}
								}	
							
							$updFak->qty =	$qty;
							$akun->noakun =+1;	
							R::store($akun);	
							R::store($updFak);	
							}
							$ret['message']= "Data Stock Berhasil di prosess..";
							$ret['code']= '100';
							$ret['error']= false;
						R::commit();
					}catch (Exception $e)
					{
						$ret['message']= $e->getMessage();
						$ret['code']= '201';
						$ret['error']= true;
						R::rollback();
					}
				echo json_encode($ret);
			}
		
		public function prosess_stock_penerimaan(){
				$ret = array();
				$id = 0;
				R::begin();
					try {
					R::setStrictTyping(false);
					$data = $this->input->post('data');
					$data = str_replace("^",".",$data);
					$data = str_replace("-","+",$data);
					$data = str_replace("_","/",$data);
					$hasil = json_decode(base64_decode($data));
					$date = R::isoDateTime();
						if($hasil->dataTable){
							$update_faktur =  R::load('k_faktur',$hasil->idAkun);
							foreach ($hasil->dataTable as $key => $value) 
								{
								$detail = R::dispense('k_penerimaan');
								$detail->kode = $value[1];
								$detail->nama = $value[2];
								$detail->satuan = $value[3];
								$detail->qty = $value[4];
								$detail->tanggal = substr($date, 0, 10);
								$detail->foto = $value[7];
								$detail->jenis_id = $value[8];
								$detail->faktur_id = $hasil->idAkun;
								$detail->user_id = $this->Auth['user'];
								R::store($detail);
								$update_faktur->total +=$value[4];
								$minta = R::load('k_permintaan',$value[9]);
								$minta->status ="Y";
								// echo($value[4]);
								R::store($minta);
								}
								$update_faktur->tgl_terima = substr($date, 0, 10);
								$update_faktur->status = "Y";
								R::store($update_faktur);
								$ret['message']= "Data Stock Berhasil di prosess..";
								$ret['code']= '100';
								$ret['error']= false;
							}
						R::commit();
					}catch (Exception $e)
						{
						$ret['message']= $e->getMessage();
						$ret['code']= '201';
						$ret['error']= true;
						R::rollback();
						}
				echo json_encode($ret);
			}
		public function prosess_stock_penjualan(){
				$ret = array();
				$id = 0;
				R::begin();
					try {
					R::setStrictTyping(false);
					$data = $this->input->post('data');
					$data = str_replace("^",".",$data);
					$data = str_replace("-","+",$data);
					$data = str_replace("_","/",$data);
					$hasil = json_decode(base64_decode($data));
					$date = R::isoDateTime();
						if($hasil->TableJual){
							$update_faktur =  R::load('k_faktur',$hasil->idAkun);
							foreach ($hasil->TableJual as $key => $value) 
								{
								$barang = R::findOne('k_item_barang','kode= ?',array($value[1]));							
								$update = R::findOne('k_penjualan','kode= ? AND tanggal like ?',array($value[1],substr($date, 0, 7).'%'));
								if($update){
									$update->deskripsi = $value[2];
									$update->stock_awal += $value[4];
									$update->harga = $barang->harga_jual;
									$update->diskon = $barang->harga_diskon;
									$update->foto = $barang->foto;
									$update->tanggal =substr($date, 0, 10);
									R::store($update);
								}else{
									$detail = R::dispense('k_penjualan');
									$detail->akun = $update_faktur->kode;
									$detail->kode = $value[1];
									$detail->nama =  $barang->nama;
									$detail->satuan = $value[3];
									$detail->stock_awal = $value[4];
									$detail->deskripsi = $value[2];
									$detail->harga = $barang->harga_jual;
									$detail->diskon = $barang->harga_diskon;
									$detail->jenis_id = $barang->jenis_id;
									$detail->foto = $barang->foto;
									$detail->tanggal = substr($date, 0, 10);
									R::store($detail);
								}
								$terima = R::load('k_penerimaan',$value[8]);
								$terima->status ="Y";
								R::store($terima);
								}
								$update_faktur->status = "P";
								R::store($update_faktur);
								$ret['message']= "Data Stock Berhasil di prosess Kepenjualan..";
								$ret['code']= '100';
								$ret['error']= false;
							}
						R::commit();
					}catch (Exception $e)
						{
						$ret['message']= $e->getMessage();
						$ret['code']= '201';
						$ret['error']= true;
						R::rollback();
						}
				echo json_encode($ret);
			}		
		public function print_penerimaan() {
				$id = $this->input->get('id');
				$arr = array();
				$detail = R::getAll("SELECT * FROM k_penerimaan WHERE faktur_id=?",array(base64_decode($id)));
					$faktur = R::load('k_faktur',base64_decode($id));
					$arr['user']=R::load('m_user',$faktur->user_id)->nama;
					$arr['faktur']=$faktur->faktur;
					$arr['tanggal']=$faktur->tanggal;
					$arr['akun']=R::load('m_akun',$faktur->akun_id)->nama;
					$arr['divisi']=R::load('m_unit',$this->Auth['unit'])->name;
					foreach($detail as $key=> $value ){
						$arr['detail'][]=$value;
					}
				$this->load->view('admin/menu/logistik/print/p_penerimaan',$arr);
			}	
		public function print_permintaan() {
				$id = $this->input->get('id');
				$arr = array();
				$detail = R::getAll("SELECT * FROM k_permintaan WHERE faktur_id=?",array(base64_decode($id)));
					$faktur = R::load('k_faktur',base64_decode($id));
					$arr['user']=R::load('m_user',$faktur->user_id)->nama;
					$arr['faktur']=$faktur->faktur;
					$arr['tanggal']=$faktur->tanggal;
					$arr['akun']=R::load('m_akun',$faktur->akun_id)->nama;
					$arr['divisi']=R::load('m_unit',$this->Auth['unit'])->name;
					foreach($detail as $key=> $value ){
						$arr['detail'][]=$value;
					}
				$this->load->view('admin/menu/logistik/print/p_permintaan',$arr);
			}

		public function print_stock_awal() {
				$id = $this->input->get('id');
				$arr = array();
				$data = $id;
				$data = str_replace("^",".",$data);
				$data = str_replace("-","+",$data);
				$data = str_replace("_","/",$data);
				$hasil = json_decode(base64_decode($data));
				$arr['tanggal']= date("Y-m-d H:i:s");
					foreach($hasil->dataTable as $key=> $value ){
						$arr['detail'][]=$value;
						$arr['user']=R::load('m_user',$this->Auth['user'])->nama;
					}
				$this->load->view('admin/menu/inventory/print/p_saldoawal',$arr);

			}

			/* Fungsi Transaksi */
		
		public function get_data_penjualan(){
			try{
				$arr= array();
				$table = $this->input->get('table');
					$aColumns = explode(',', $this->input->get('columns'));
					$sWhere = "";
					$sQuery = "";
					$MySql = "";
						if ($this->input->get('aSearch') != false && $this->input->get('aSearch') != "" )
							{
							$sWhere = "(";
							for ( $i=0 ; $i<count($aColumns) ; $i++ )
								{
									if ($aColumns[$i] != "") {
										$sWhere .= "".$aColumns[$i]." LIKE '%".R::$adapter->escape( $this->input->get('aSearch') )."%' OR ";
									}
								}
								$sWhere = substr_replace( $sWhere, "", -3 );
								$sWhere .= ') ORDER BY id DESC LIMIT 0,20';
								$MySql= R::getALL('SELECT * FROM '.$table.' WHERE '.$sWhere.';');
							}else if($this->input->get('aSearch') == false && $this->input->get('Jns') != false )
							{
								$MySql= R::getALL('SELECT * FROM '.$table.' WHERE jenis_id=?',array($this->input->get('Jns')));
							}else {
								$MySql= R::getALL('SELECT * FROM '.$table.';');
							}
							
						foreach($MySql as $value)
								{
								array_push($arr,$value);
								}
							
			}catch (Exception $e)
				{
					$arr['message']= $e->getMessage();
					$arr['code']= '201';
					$arr['error']= true;
				}
			echo json_encode($arr);
			}
		
		public function initial($table){
			R::setStrictTyping(false);
			$date = R::isoDateTime();
			$arr = array();
			try{
				$bean = R::dispense($table);
				if($this->input->post())
					{
						$shift = $this->input->post('shift');
						$user = $this->input->post('user_id');
						$tanggal = $this->input->post('tanggal');
						$initial = R::findOne($table,'tanggal=? AND shift=? AND user_id=? AND status IS null',array($tanggal,$shift,$user));
						if($initial){
							$arr['code']=100;
							$arr['error']=true;
							$arr['message']='Tidak Dapat Melakukan Initial di Shift Yang Sama Atau sedang digunakan di tempat lain';
							$arr['id']=$initial->id;
						}else{
							foreach ($this->input->post() as $column => $value) {
								$bean->$column = $value;
								}
								$id = R::store($bean);
								if($id){
									if ($this->input->cookie('Kasir') != "null") {
										delete_cookie('Kasir');
										$this->input->set_cookie('Kasir', $id, '2592000');
									}else{
										delete_cookie('Kasir');
									}
									$arr['code']=200;
									$arr['error']=false;
									$arr['message']='berhasil..';
									$arr['id']=$id;
								}else{
									$arr['code']=102;
									$arr['error']=true;
									$arr['message']='System faild...';
									$arr['id']=$id;
								}
						}
					}else{
						$arr['code']=103;
						$arr['error']=true;
						$arr['message']='System faild...';
						$arr['id']=0;
					}		
			}
			catch (Exception $e) {
				$arr['code']=104;
				$arr['error']=true;
				$arr['message']=$e->getMessage();
				$arr['id']=0;
			}
			echo json_encode($arr);
			}
		public function cek_initial($table){
			$arr= array();
				try{
					$initial= R::findOne($table,'id=? AND user_id=? AND status IS NULL',array($this->input->post('id'),$this->input->post('user_id')));
					if($initial){
						if($initial->pin == $this->input->post('pin') && $initial->user_id == $this->input->post('user_id')){
							$arr['id']= $initial->id;
							$arr['data']= array('jam'=>$initial->jam_start,'shift'=>$initial->shift,'Oprator'=>R::load('m_user',$initial->user_id)->nama,'status'=>$initial->status,'tanggal'=>$initial->tanggal);
							$arr['error']= false;
							$arr['code']= 200;
							$arr['message']= 'Nomor Pin cocok';
						}else if($initial->pin == $this->input->post('pin') && $initial->user_id != $this->input->post('user_id')){
							$arr['error']= true;
							$arr['code']= 100;
							$arr['message']= 'Initial Expierd..';
							delete_cookie('Kasir');
						}else if($initial->pin != $this->input->post('pin')){
							$arr['error']= true;
							$arr['code']= 102;
							$arr['message']= 'Nomor Pin Tidak cocok';
						}				
					}else{
						$arr['error']=true;
						$arr['code']= 103;
						$arr['message']= 'Initial Tidak di temukan';
					}
				}catch (Exception $e)
				{
					$arr['message']= $e->getMessage();
					$arr['code']= 104;
					$arr['error']= true;
				}
				echo json_encode($arr);
			}
		public function pembayaran_kasir(){
			$ret = array();
				$id = 0;
				R::begin();
					try {
					R::setStrictTyping(false);
					$data = $this->input->post('data');
					$data = str_replace("^",".",$data);
					$data = str_replace("-","+",$data);
					$data = str_replace("_","/",$data);
					$hasil = json_decode(base64_decode($data));
					$date = R::isoDateTime();
					$nota = R::count('k_transaksi','tanggal = ? ORDER BY nota DESC', array(substr($date, 0, 10)))+1;
					$count = str_replace('-','',substr($date, 4, 6)).str_pad($nota,4,"0",STR_PAD_LEFT);
					$cektable = R::findOne('k_penjualan','tanggal like ?',array(substr($date, 0, 7).'%')); /*Cek Table Stock Penjualan*/
					if($cektable){
					/* bikin Nota Transaksi */
						$nota = R::dispense('k_transaksi');
								$nota->nota = $count;
								$nota->tanggal = $hasil->tanggal;
								$nota->shift = $hasil->shift;
								$nota->qty = $hasil->qty;
								$nota->netto = $hasil->netto;
								$nota->bruto = $hasil->bruto;
								$nota->diskon = $hasil->diskon;
								
								$nota->meja = $hasil->meja;
								$nota->jenis = $hasil->type; /* Jenis Pembayaran */
								$nota->initial_id = $hasil->id;
								$nota->user_id = $hasil->idUser;
								$nota->jam = substr($date,10, 15);
								$nota->keterangan = $hasil->keterangan;

								$nota->cashin = $hasil->cash;
								$nota->cashout = $hasil->cashout;
								$nota->debet = $hasil->debet;
								$nota->e_payment = $hasil->epay;

								$id = R::store($nota);
						/* Insert Detail Nota Transaksi */
						if($id){
							if($hasil->type =="Debet" || $hasil->type =="E-payment"){
								$epay = R::dispense('k_transaksipayment');
								$epay->trxid = $hasil->epaytrx;
								$epay->nota_id =$id;
								$epay->epay_id =$hasil->epayJs;
								$epay->jumlah = $hasil->netto;
								$epay->fee = $hasil->epayFee;
								$epay->total = $hasil->epay;
								$epay->pay_date =$date;
								R::store($epay);
							}
							foreach ($hasil->dataTable as $key => $value) 
							{
								$sumQty = R::findOne('k_transaksidetail','kode= ? AND nota_id=?', array($value[6],$id));
								if($sumQty){
									$sumQty->qty += $value[3];
									R::store($sumQty);
								}else{
									$detail = R::dispense('k_transaksidetail');
									$detail->kode = $value[6];
									$detail->nama = $value[1];
									$detail->harga = $value[2];
									$detail->diskon = $value[7];
									$detail->qty = $value[3];
									$detail->total = ($value[2] - $value[7]) * $value[3];
									$detail->jenis_id = $value[9];
									$detail->nota_id = $id;
									$detail->tanggal = substr($date,0, 10);
									R::store($detail);
								}
								$stock = R::findOne('k_penjualan','kode = ? AND tanggal like ?',array($value[6],substr($date, 0, 7).'%')); /* Update Table Stock Penjualan*/
								if($stock){
									$stock->qty += intval($value[3]);
									$stock->stock_akhir =(intval($stock->stock_awal) - intval($stock->qty));
									R::store($stock);
								}
							}		
							$ret['Order']= R::getAll('SELECT gb.nama,gb.id FROM k_transaksidetail dt INNER JOIN k_jenis_barang jb INNER JOIN k_grup_barang gb ON gb.id=jb.grup_id AND jb.id=dt.jenis_id where dt.nota_id= ? GROUP BY gb.id',array($id));
							$ret['message']= "Transakasi Berhasil ";
							$ret['code']= '100';
							$ret['error']= false;
							$ret['id']= $id;
						}
					}else{
						$ret['message']= "Tabel Penjualan Belum yang terbaru.. Tidak dapat melanjutkan Transaksi ";
						$ret['code']= '200';
						$ret['error']= true;
					}
					R::commit();
					}catch (Exception $e)
						{
						$ret['message']= $e->getMessage();
						$ret['code']= '201';
						$ret['error']= true;
						R::rollback();
						}
				echo json_encode($ret);
			}
		public function print_struk() {
				$id = $this->input->get('id');
				$fuk = $this->input->get('fak');
				$grupID = $this->input->get('gId');
				$arr = array();
				$nota = R::load('k_transaksi',$id);
				if($nota){
					$arr['user']=R::load('m_user',$nota->user_id)->nama;
					$arr['nota']=$nota->nota;
					$arr['tanggal']=$nota->tanggal.' '.$nota->jam;
					$arr['meja']=$nota->meja;
					$arr['type']=$nota->jenis;
					$arr['subtotal']=$nota->bruto;
					$arr['diskon']=$nota->diskon;
					
					if($nota->jenis =="Debet" || $nota->jenis=="E-payment"){
						$pay = R::findOne('k_transaksipayment','nota_id=?',array($nota->id));
						$arr['fee']=$pay->fee;
						$arr['total']=$pay->total;
						$arr['cashin']=0;
						$arr['cashout']=0;
					}else{
						$arr['total']=$nota->netto;
						$arr['cashin']=$nota->cashin;
						$arr['cashout']=$nota->cashout;
					}
					$detail = R::getAll("SELECT dt.*,jb.nama as Jenis,gb.nama as Grup FROM k_transaksidetail dt INNER JOIN k_jenis_barang jb INNER JOIN k_grup_barang gb ON gb.id=jb.grup_id AND jb.id=dt.jenis_id  WHERE dt.nota_id=? ORDER BY dt.jenis_id ASC",array($nota->id));
					foreach($detail as $key=> $value ){
						$arr['detail'][]=$value;
					}
				}
				
				if($fuk==1){
					$this->load->view('admin/menu/kasir/print/p_struk',$arr);
				}else if($fuk==2){
					$arr['detailOrder']= R::getAll("SELECT dt.*,jb.nama as Jenis,gb.nama as Grup FROM k_transaksidetail dt INNER JOIN k_jenis_barang jb INNER JOIN k_grup_barang gb ON gb.id=jb.grup_id AND jb.id=dt.jenis_id  WHERE dt.nota_id=? AND gb.id=?",array($value['nota_id'],$grupID));
					$this->load->view('admin/menu/kasir/print/p_order',$arr);
				}
				// var_dump($arr);
			}
		public function prosess_closing($table){
				$arr= array();
					try{
						$date = R::isoDateTime();
						$initial= R::load($table,$this->input->post('id'));
						if($initial){
							$transaksi = R::getAll('SELECT count(*)AS Trx,sum(qty) AS Qty,sum(netto) AS Netto,sum(bruto) AS Bruto,sum(diskon) AS Diskon,sum(cashin) AS Cash,sum(cashout) AS Kembali,sum(debet) AS Debet,sum(e_payment) AS Epay FROM k_transaksi where initial_id=?',array($initial->id));				
							foreach($transaksi as $key=> $value ){
								$initial->qty =$value['Qty'];
								$initial->netto =$value['Netto'];
								$initial->bruto =$value['Bruto'];
								$initial->diskon =$value['Diskon'];
								$initial->cash = ($value['Cash'] - $value['Kembali']);  /* Jumlah Diterima - Jumlah Kembalian */
								if($value['Debet'] !=null){$initial->debet =$value['Debet'];}else{$initial->debet =0;}
								if($value['Epay'] !=null){$initial->e_payment =$value['Epay'];}else{$initial->e_payment =0;}
								$initial->transaksi = $value['Trx'];
								$initial->total = ($value['Cash'] - $value['Kembali']) + ($value['Debet'] + $value['Epay']);
							}
							$initial->cash_drawer = ($this->input->post('uang') - $initial->modal); /* Jumlah Uang - Modal */
							$initial->jam_end = substr($date,10, 15);
							$initial->status='Y';
							$id = R::store($initial);
							if($id){
								$arr['id']=$id;
								$arr['error']=false;
								$arr['code']= 200;
								$arr['message']= 'Tutup Kasir Penjualan Berhasil';
							}
						}else{
							$arr['error']=true;
							$arr['code']= 103;
							$arr['message']= 'Initial Tidak di temukan';
						}
					}catch (Exception $e)
					{
						$arr['message']= $e->getMessage();
						$arr['code']= 104;
						$arr['error']= true;
					}
					echo json_encode($arr);
				}
		public function print_closing() {
				$id = $this->input->get('id');
					$arr = array();
					$initial = R::load('k_initial_kasir',$id);
					if($initial){
						$arr['user']=R::load('m_user',$initial->user_id)->nama;
						$arr['shift']=$initial->shift;
						$arr['tanggal']=$initial->tanggal;
						$arr['start']=$initial->jam_start;
						$arr['end']=$initial->jam_end;
						$arr['netto']=$initial->netto;
						$arr['cash']=$initial->cash;
						$arr['debet']=$initial->debet;
						$arr['epayment']=$initial->e_payment;
						$arr['modal']=$initial->modal;
						$arr['cashDrawer']=$initial->cash_drawer;
						$arr['total']=$initial->total;
						$detail = R::getAll("SELECT * FROM k_transaksi WHERE initial_id=? ORDER by jam ASC",array($initial->id));
						if($detail){
							foreach($detail as $key=> $value ){
								$arr['detail'][]=$value;
							}
						}else{
							$arr['detail'][]=0;
						}
						
					}
					$this->load->view('admin/menu/kasir/print/p_closing',$arr);
				}
			}
?>