<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Portal extends CI_Controller {
	private $Auth;
	function __construct(){
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->library(array('form_validation','session','layout','rb'));
		
		$this->load->database();
		$this->load->helper(array('form', 'url','html','file','cookie'));

		if($this->session->userdata('654321member'))
				{
				$session_data = $this->session->userdata('654321member');
				$this->Auth['user'] = $session_data['id'];
				$this->Auth['nama'] = $session_data['nama'];
				$this->Auth['email'] = $session_data['email'];
				$this->Auth['telpon'] = $session_data['telpon'];
				}else{
					$this->Auth['user'] = 0;
				}
			}
	public function index($url=null){
		if($url==null){
			$data=array('user'=>R::load('m_user_member',$this->Auth['user']),
			'Menu'=> array('data'=>0),
			'Apps'=>$this->get_data_apps(),
			'content'=>str_replace('-','/','portal-menu-content-html-h_Index'),	
			'Seo'=>$this->get_data_seo(null),
			'Popup'=>$this->get_data_popup());
			$this->layout->portal('portal/layout/container',$data);	
			}
		}
    public function about($url=null){
            if($url==null){
                $data=array('user'=>R::load('m_user_member',$this->Auth['user']),
                'Menu'=> array('data'=>0),
                'content'=>str_replace('-','/','portal-menu-product-html-h_About'),	
                'Seo'=>$this->get_data_seo(null));
                $this->layout->portal('portal/layout/container',$data);	
                }
            }
	function log_url($id){
		$arr= array();
			try {
				$data = R::load('m_seo',$id);
				if($data->id){
					$data->url = strtolower($this->uri->uri_string());
					$data->date = R::isoDateTime();
					$data->view += 1;
					$arr['error'] =false;
					$arr['code'] =200;
					$arr['id']=$id;
					$id= R::store($data);
					}
				} catch(Exception $e) {
				$arr['error'] =true;
				$arr['code'] =201;
				$arr['message'] =$e->getMessage();
				}
		}	

	
	public function get_data_menu(){
		$arr = array();
		try{
			$data =R::getAll('SELECT * FROM m_menu WHERE status="Y"');
			foreach($data as $value){
				$sql = R::getAll('SELECT * FROM m_submenu WHERE menu_id=? AND status="Y"',array($value['id']));
				$sub = array();
				if($sql){
					foreach($sql as $val){
						$sub[]=array($val);
					}
				}
				
				$arr['data'][]=array('menu'=>$value,'submenu'=>$sub);
			}
		}catch (Exception $e) {
			$arr['error'] =true;
			$arr['code'] =201;
			$arr['message'] =$e->getMessage();
			}
		return($arr);
		// var_dump($arr);
		}
	public function get_data_apps(){
			$arr = array();
			try{
				$data =R::getAll('SELECT * FROM w_post_apps WHERE status="Y"');
				foreach($data as $value){
					
					$arr['data'][]=$value;
				}
			}catch (Exception $e) {
				$arr['error'] =true;
				$arr['code'] =201;
				$arr['message'] =$e->getMessage();
				}
			return($arr);
			// var_dump($arr);
			}
	public function get_data_banner(){
		$arr = array();
		try{
			$data =R::getAll('SELECT * FROM w_post_banner WHERE status="Y" ORDER BY id ASC limit 0,5; ');
			foreach($data as $key=>$value){
				$arr['data'][]=array('Ctgr'=>$value['text_kategory'],
									'Judul'=>$value['text_judul'],
									'Desc'=>$value['text_deskripsi'],
									'Img'=>$value['foto'],
									'Link'=>R::load('w_post_link_button',$value['link_id'])->export()
								);
			}
		}catch (Exception $e) {
			$arr['error'] =true;
			$arr['code'] =201;
			$arr['message'] =$e->getMessage();
			}
		return($arr);
		// var_dump($arr);
		}	
	public function get_data_popup(){
		$arr= array();
		try {
			$popup_blog = R::getAll("SELECT * FROM w_post_artikel WHERE popup='Y' ORDER BY id DESC Limit 0,5");
				foreach($popup_blog as $val){
					$arr[]=array($val,'seo'=>R::load('m_seo',$val['link_id'])->export());
				}
		}catch (Exception $e) {
			$arr['error'] =true;
			$arr['code'] =201;
			$arr['message'] =$e->getMessage();
			}
		return($arr);
		 //var_dump($arr);
		}		
	public function get_data_seo($slug=null){
		$arr= array();
		$data=null;
		try {
			if($slug==null){
				$id = R::findOne('m_menu','url=?',array($this->uri->uri_string()));
				if($id !=null){
					$data = R::load('m_seo',$id->link_id);
				}
				
			}else{
				$data = R::load('m_seo',$slug);
			}
				if($data){
					$arr['data'] = array('title'=>$data->title,
										'deskripsi'=> $data->deskripsi,
										'keyword'=> $data->keyword,
										'img'=> str_replace('/','-',$data->icon),
										'link'=>strtolower($this->uri->uri_string()),
										'view'=>$data->view,
										'author'=> $data->author,
										'short_link'=> strtolower($data->short_link)
							);
							$this->log_url($data->id);
						}else{
							$confiq = R::getAll('SELECT * FROM m_confiq');
								$title; $logo; $icon; $desc; $vendor; $keyword; $url;
							foreach($confiq as $i){
								if($i['name']=='Title')
									$title = $i['variabel'];
								if($i['name']=='Logo')
									$logo = $i['variabel'];
								if($i['name']=='Fav Icon') 
									$icon = $i['variabel'];
								if($i['name']=='Deskripsi')
									$desc = $i['variabel'];
								if($i['name']=='Vendor')
									$vendor = $i['variabel'];
								if($i['name']=='Keyword')
									$keyword = $i['variabel'];
								if($i['name']=='Url')
									$url = $i['variabel'];						
							}
							$arr['data']= array('title'=>$title,
								'deskripsi'=>$desc,
								'keyword'=> $keyword,
								'img'=>str_replace('/','-',$logo),
								'link'=>strtolower($this->uri->uri_string()),
								'author'=>$vendor,
								'short_link'=>'wedding-organizer-bogor-akbargrup');
						}
				} catch(Exception $e) {
				$arr['error'] =true;
				$arr['code'] =201;
				$arr['message'] =$e->getMessage();
				}
			return($arr);
			// var_dump($id);
		}
	
	public function sys_user_monitoring($table){
		R::setStrictTyping(false);
		$data = array();
		$bean = R::dispense($table);
		
		$MAC = exec('getmac'); 
		$MAC = strtok($MAC, ' '); 
		
		$host = exec('hostname');
		$ips = trim($host); //remove any spaces before and after
		
		$command="/sbin/ifconfig eth0 | grep 'inet addr:' | cut -d: -f2 | awk '{ print $1}'";
		$localIP = exec ($command);	
		
		$hasil ='';
		if($this->win_os()){
			$hasil = $this->win_os();
		}else {
			$hasil=$this->unix_os();
		}
		$data['Mac'] = $MAC;
		$data['host'] = $host;
		$data['ipAddress'] = $hasil;
		$data['sysinfo'] = $this->sys_get_info();
		if($this->input->post())
		{
			$cek = R::findOne('n_web_monitoring','macaddress =?',array($MAC));
			if(!$cek){
			foreach ($this->input->post() as $column => $value) {
					$bean->$column = $value;
					}
					$bean->ipaddress =$hasil;
					$bean->devices =$host;
					$bean->macaddress =$MAC;
					$bean->sysinfo =$this->sys_get_info();
					$id = R::store($bean);
			}else{
				foreach ($this->input->post() as $column => $value) {
					$cek->$column = $value;
					}
					$cek->ipaddress =$hasil;
					$cek->devices =$host;
					$cek->macaddress =$MAC;
					$cek->sysinfo =$this->sys_get_info();
					$id = R::store($cek);
			}
		}
		echo json_encode($data);		
		}	
	private function GetClientMac(){
		$macAddr=false;
		$arp=`arp -n`;
		$lines=explode("\n", $arp);

		foreach($lines as $line){
			$cols=preg_split('/\s+/', trim($line));

			if ($cols[0]==$_SERVER['REMOTE_ADDR']){
				$macAddr=$cols[2];
			}
		}

		return $macAddr;
		}
	private function ipCheck() {
		$ip='';
		if (getenv('HTTP_CLIENT_IP')) {
			$ip= getenv('HTTP_CLIENT_IP');
		}
		elseif (getenv('HTTP_X_FORWARDED_FOR')) {
			$ip .= getenv('HTTP_X_FORWARDED_FOR');
		}
		elseif (getenv('HTTP_X_FORWARDED')) {
			$ip = getenv('HTTP_X_FORWARDED');
		}
		elseif (getenv('HTTP_FORWARDED_FOR')) {
			$ip = getenv('HTTP_FORWARDED_FOR');
		}
		elseif (getenv('HTTP_FORWARDED')) {
			$ip = getenv('HTTP_FORWARDED');
		}
		else {
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		return $ip;
		}
	private function win_os(){ 
		ob_start();
		system('ipconfig | findstr /C:Address');
		$mycom=ob_get_contents(); // Capture the output into a variable
		ob_clean(); // Clean (erase) the output buffer
		$findme = "Physical";
		$pmac = strpos($mycom, $findme); // Find the position of Physical text
		$mac=substr($mycom,($pmac+39),16); // Get Physical Address

		return $mac;
		}
	
	private function unix_os(){
		ob_start();
		system('ifconfig -a');
		$mycom = ob_get_contents(); // Capture the output into a variable
		ob_clean(); // Clean (erase) the output buffer
		$findme = "Physical";
		//Find the position of Physical text 
		$pmac = strpos($mycom, $findme); 
		$mac = substr($mycom, ($pmac + 37), 18);
		
		return $mac;
    	}	
	private function sys_get_info(){
		$names = php_uname();
		$names .= PHP_OS;
		return $names;
		}
	public function sitemaps(){
		$data=array();
		try{
				$q=R::getALL('SELECT a.id,a.date,s.short_link,s.url FROM w_post_artikel a inner join m_seo s ON s.id=a.link_id');
					foreach($q as $h){$data['blog'][]=$h;}

				$s=R::getALL('SELECT a.id,s.url FROM w_post_product a inner join m_seo s ON s.id=a.link_id WHERE a.product="Y"');
						foreach($s as $h){$data['services'][]=$h;}	

				$s=R::getALL('SELECT mn.id,se.url FROM m_menu mn INNER JOIN m_seo se ON se.id=mn.link_id');
						foreach($s as $h){
							$data['menu'][]=$h;
							$s=R::getALL('SELECT ms.id,se.url FROM m_submenu ms INNER JOIN m_seo se ON se.id=ms.link_id WHERE ms.menu_id=?',array($h['id']));
								foreach($s as $hh){
									$data['submenu'][]=$hh;
								}	
						}	

				$data['date']=R::isoDateTime();
				}catch (Exception $e)
					{
						$data['error'] = $e->getMessage();
					}
				//var_dump($data);
				$this->load->view('sitemap',$data);
				
		}
}
?>