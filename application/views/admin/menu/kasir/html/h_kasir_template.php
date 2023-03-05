<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php $id=$this->input->get('route'); $date = R::isoDateTime();?>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <?php
                $arr=array();
                $initial = R::findOne('k_initial_kasir','user_id= ? AND tanggal =? AND status is null',array($user->id,substr($date,0,10)));
                if($initial){
                    if($initial->id == $this->input->cookie('Kasir')){
                        $arr['initial']=$initial;
                        $this->load->view("admin/menu/kasir/html/h_kasir_cekin",$arr);
                    }else if($initial->id <> $this->input->cookie('Kasir')){
                        $arr['initial']=false;
                        $this->load->view("admin/menu/kasir/html/h_kasir_warning",$arr);
                    }else if(!$this->input->cookie('Kasir')){
                        $arr['initial']=$initial->export();
                        $this->input->set_cookie('Kasir', $initial->id, '2592000');
                        $this->load->view("admin/menu/kasir/html/h_kasir_cekin",$arr);
                    }else if($initial->id || !$this->input->cookie('Kasir')){
                        $arr['initial']=$initial->export();
                        $this->input->set_cookie('Kasir', $initial->id, '2592000');
                        $this->load->view("admin/menu/kasir/html/h_kasir_cekin",$arr);
                    }
                }else{
                    $arr['initial']=false;
                    delete_cookie('Kasir');
                    $this->load->view("admin/menu/kasir/html/h_kasir_initial",$arr);
                }
                
                ?>
            </div>
        </div>
    </div>
</section>