<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sikontras extends CI_Controller {
	public function __construct(){
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->library(array('Layout','rb','session'));
		$this->load->helper(array('form', 'url','html','file','cookie'));
		$this->load->database();		
		}
        public function p_laporan_aduan($id){
            $arr=array();
            try{
                if($id){
                $user = R::load('t_data_pengaduan',$id);
                $arr['use_nomor']=$user->noaduan;
                $arr['use_jenis']=$user->jenis;
                $arr['use_perbaikan']=$user->perbaikan;
                $arr['use_deskripsi']=$user->deskripsi;
                $arr['use_date']=$user->date_in;
                $arr['use_lokasi']=$user->lokasi;
                $arr['use_foto']=$user->foto;
                $arr['use_status']=$user->status;
                $arr['user_id']=R::load("m_user",$user->user_id)->export();
                $tindak = R::findOne("t_data_prosess","aduan_id=?",array($id));
                if($tindak){
                $arr['tin_instruksi']=$tindak->instruksi;
                $arr['tin_diteruskan']=$tindak->diteruskan;
                $arr['tin_catatan']=$tindak->catatan;
                $arr['tin_date']=$tindak->date;
                $arr['tin_status']=$tindak->status;
                $arr['tin_id']=$tindak->id;
                $arr['tin_user']=R::load("m_user",$tindak->user_id)->export();

                $action = R::findOne("t_data_perbaikan","prosess_id=?",array($tindak->id));
                if($action){
                $arr['don_spk']=$action->nospk;
                $arr['don_regu']=$action->timregu;
                $arr['don_material']=$action->kelengkapan;
                $arr['don_keterangan']=$action->perbaikan;
                $arr['don_date_start']=$action->tglperbaikan;
                $arr['don_date_end']=$action->tglselesai;
                $arr['don_time']=$action->waktu;
                $arr['don_status']=$action->status;
                $arr['don_foto']=$action->foto;
                $arr['don_id']=$action->id;
                $arr['don_user']=R::load("m_user",$action->user_id)->export();
                }
                }
                }
            }catch(Exception $e){
                $arr =$e->getMessage();
            }
            // echo json_encode($arr);
            $this->load->view('admin/print/p_laporan_aduan',array($arr));
        }
}
?>