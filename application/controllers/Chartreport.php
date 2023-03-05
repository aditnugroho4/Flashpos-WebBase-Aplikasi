<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Chartreport extends CI_Controller {
private $data;
	public function __construct()
		{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->library(array('Layout','rb','session'));
		$this->load->helper(array('form', 'url','html','file','cookie'));
		$this->load->model(array('user','sendemail'));
			if(!$this->session->userdata('654321_cbn'))
				{
				//Jika tidak ada session di kembalikan ke halaman login
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
				}
		}
	public function get_data_10_product(){
		$data = array();
		$date = R::isoDateTime();
		R::setStrictTyping(false);
		try {
			$transaksi = R::getAll('SELECT sum(qty) as jumlah ,nama,harga FROM k_transaksidetail WHERE tanggal like ? GROUP BY kode ORDER BY sum(qty) DESC Limit 0,10;',array(substr($date, 0, 7).'%'));
			foreach($transaksi as $value){
				$data['detail'][]=$value;
			}	
		}
		catch(Exception $e) 
			{
				$data['error']=true;
				$data['message']=$e->getMessage();
			}
		echo json_encode($data);
	}
	public function get_data_min10_product(){
		$data = array();
		$date = R::isoDateTime();
		R::setStrictTyping(false);
		try {
			$transaksi = R::getAll('SELECT sum(qty) as jumlah ,nama,harga FROM k_transaksidetail WHERE tanggal like ? GROUP BY kode ORDER BY sum(qty) ASC Limit 0,10;',array(substr($date, 0, 7).'%'));
			foreach($transaksi as $value){
				$data['detail'][]=$value;
			}	
		}
		catch(Exception $e) 
			{
				$data['error']=true;
				$data['message']=$e->getMessage();
			}
		echo json_encode($data);
	}
	public function get_data_chart_customer(){
		R::setStrictTyping(false);
		$data = array();
		$date = R::isoDateTime();
		$labels = array();
		$datasets = array();
		$qty = array();
		$count = 0;
		$total = 0;
		$totalBefor = 0;
		$countAfter = 0;
		
		$dayCount = array("MINGGU","SENIN","SELASA","RABU","KAMIS","JUMAT","SABTU");
		$hari_indonesia = array('Sunday' => 'MINGGU','Monday'  => 'SENIN','Tuesday'  => 'SELASA','Wednesday' => 'RABU','Thursday' => 'KAMIS','Friday' => 'JUMAT','Saturday' => 'SABTU');
		$Daybefore = date('Y-m-d', strtotime("-6 day", strtotime(date("Y-m-d"))));
		try {
				$transaksi = R::getAll('SELECT id,sum(netto) as total,tanggal,count(*) as jumlah FROM k_transaksi WHERE tanggal BETWEEN ? AND ? GROUP BY tanggal ASC;',array($Daybefore,substr($date, 0, 10)));
				foreach($transaksi as $value){
					$namahari = date('l', strtotime($value['tanggal']));
					foreach($dayCount as $hari){	
						if($transaksi){
							if($hari_indonesia[$namahari] == $hari){
								$datasets['now'][] = $value['total'];
								$qty['now'][] = $value['jumlah'];
								$labels[]=$hari_indonesia[$namahari];
								}
							}
						}
						$count +=$value['jumlah'];
						$total +=$value['total'];
					}	
					$kemarin = date('Y-m-d', strtotime("-13 day", strtotime(date("Y-m-d"))));
					$day7= date('Y-m-d', strtotime("-7 day", strtotime(date("Y-m-d"))));
					$before = R::getAll('SELECT id,sum(netto) as total,tanggal,count(*) as jumlah FROM k_transaksi WHERE tanggal BETWEEN ? AND ? GROUP BY tanggal ASC;',array($kemarin,$day7));
					foreach($before as $k=> $value){	
					$namahari= date('l', strtotime($value['tanggal']));
					foreach($dayCount as $hari){
						if($transaksi){
							if($hari_indonesia[$namahari]== $hari){
								$datasets['before'][]= $value['total'];
								$qty['before'][]= $value['jumlah'];
								}
							}
						}
						$totalBefor += $value['total'];
						$countAfter += $value['jumlah'];
					}
			$data['labels']=$labels;
			$data['qty']=$qty;		
			$data['datasets']=$datasets;
			$data['transaksi'] =$count;
			$data['total'] =$total;
			$percent = ($countAfter - $count )/1000;
			$data['persentotal'] = round($count/100 * 100);
			$data['persencount'] =$countAfter.' '. number_format( $percent * 100, 0 ) . '%'; 
		}
		catch(Exception $e) 
			{
				$data['error']=true;
				$data['message']=$e->getMessage();
			}
		echo json_encode($data);
	}
	public function get_lap_penjualan(){
		R::setStrictTyping(false);
		$date = R::isoDateTime();
		$arr = array();
		$startDate="";$endDate="";$id="";$exe="";
		try{
			if($this->input->post()){
				$startDate =$this->input->post('startDate');
				$endDate =$this->input->post('endDate');
				$id = $this->input->post('id');
				$exe = $this->input->post('exe');
			}else if($this->input->get()){
				$startDate =$this->input->get('startDate');
				$endDate =$this->input->get('endDate');
				$id = $this->input->get('id');
				$exe = $this->input->get('exe');
			}
			$query = R::getAll("SELECT dt.kode,jb.nama as katagori,dt.nama,ib.harga_dasar,dt.diskon,dt.harga,sum(dt.qty) as terjual,sum(dt.total)as total,dt.tanggal FROM k_transaksidetail dt INNER JOIN k_jenis_barang jb
			INNER JOIN k_item_barang ib ON jb.id=dt.jenis_id AND ib.kode=dt.kode WHERE dt.tanggal BETWEEN ? AND ? GROUP BY dt.kode asc;",array($startDate,$endDate));
			if($query){
				foreach($query as $val){
					$arr['data'][]=$val;
					if($exe == "print"){
						$arr['dateStart'] = $startDate;
						$arr['dateEnd'] = $endDate;
						$arr['user'] = R::load('m_user',$this->Auth['user'])->nama;
					}
				}
				$arr['error']=false;	
				$arr['code']=200;
				$arr['message']= "Data Available..";
			}else{
				$arr['error']=true;	
				$arr['code']=100;
				$arr['message']= "Data Not Available..";
			}			
		}
		catch(Exception $e) 
				{
					$arr['error']=true;	
					$arr['code']=101;
					$arr['message']= $e->getMessage();
				}
		if($exe == "show"){
			echo json_encode($arr);
		}else if($exe == "print"){
			$this->load->view('admin/menu/reporting/print/p_penjualan',$arr);
		}
	}
}