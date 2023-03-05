<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php if($error == false){?>
<div class="cbp-l-member-img">
	<img class="img-thumbnail" src="<?php if($data['foto']== null){echo ('http://ristek-it.com/asset/foto/preview.png');}else{ echo ('http://ristek-it.com/asset/foto/pegawai/'.$data['foto']);} ?>" alt="" style="height:220px;">
</div>
<div class="cbp-l-member-info">
	<div class="cbp-l-member-name"><?php echo $data['nama'];?></div>
	<div class="cbp-l-member-position"><?php echo $data['keterangan'];?></div>
	<div class="cbp-l-member-desc">
		<?php echo $data['deskripsi'];?>
	</div>
</div>
<div class="col-lg-12 col-xs-12 text-center">
	<h3 class="mt-5">JADWAL DOKTER</h3>		
		<div class="col-lg-12">
			<img width="80%" class="img-thumbnail" src="<?php if($data['foto']== null){echo ('http://ristek-it.com/asset/foto/jadwal_dokter.png');}else{ echo ('http://ristek-it.com/asset/foto/publikasi/'.$data['jadwal']);} ?>" alt="">
		</div>
</div>

<?php }else{?>
	<div class="cbp-l-member-img">
	<img src="<?php echo ('http://ristek-it.com/asset/foto/preview.png'); ?>" alt="">
</div>
<div class="cbp-l-member-info">
	<div class="cbp-l-member-name">My Dokter</div>
	<div class="cbp-l-member-position">Keterangan</div>
	<div class="cbp-l-member-desc">
		Belum ada Data Profile.
	</div>
</div>
<?php }?>