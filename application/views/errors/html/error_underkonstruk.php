<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php $id=$this->input->get('route'); ?>

<section class="hold-transition lockscreen">
    <div class="lockscreen-wrapper">
        <div class="card card-outline card-gray load-initial">
            <div class="card card-outline card-gray load-initial">
                <div class="lockscreen-logo">
                    <p>Mohon Maaf</p>
                </div>
                <div class="card-footer card-gray">
                    <img src="<?= base_url('asset/admin/images/alert/cns-1.jpg')?>" alt="Menu Sedang dalam Pengerjaan">
                </div>
                <div class="lockscreen-footer text-center">
                    <marquee bgcolor="#111f29">
                        <h5 class="text-white">Menu ini belum dapat di gunakan masih dalam persiapan
                            Developer
                        </h5>
                    </marquee>
                </div>
            </div>
        </div>
    </div>
</section>