<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<aside class="main-sidebar sidebar-dark-white elevation-4">
    <a href="<?= site_url('admin');?>" class="brand-link">
        <img src="<?= base_url('asset/admin/'); ?>dist/img/AdminLTELogo.png" alt="Akbar Grup"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light"> FLASHPOS</span>
    </a>
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?php if(!$user->foto){echo (base_url('asset/images/user/avatar5.png'));}else {echo  (base_url('asset/images/user/'.$user->foto));}  ?>"
                    class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="<?php echo site_url('admin/page/user?mod='.base64_encode("admin-menu-dashboard-html-h_dashboard_guest").'&role='.base64_encode($role->id));?>"
                    class="d-block"><?php echo $user->nama; ?></a>
                <span><small class="text-light">( <?= $role->name;?> ) </br>
                        <?php if($user->email !='' && $user->email !='-'){echo($user->email);}else{echo('Belum Punya Email..');} ?></small></span>

            </div>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- <li class="nav-item has-treeview ">
                    <a href="<?php echo site_url('admin');?>" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Chart</p>
                            </a>
                        </li>
                    </ul>
                </li> -->
                <?php if($sidebar){?>
                <li class="nav-header text-white"><i class="nav-icon fas fa-tachometer-alt"></i> Work List</li>
                <?php  foreach($sidebar['menu'] as $i=> $key){?>
                <li class="nav-item has-treeview " data-toggle="<?= $key['tag'];?>">
                    <a href="#" class="nav-link">
                        <i class="nav-icon <?php echo $key['icon2'];?>"></i>
                        <p>
                            <?php echo $key['label'];?>
                            <i class="fas fa-angle-left right"></i>
                            <?php if($key['lbl_count']==0){?>
                            <span class="badge badge-warning right"><?php echo $key['lbl_count'];?></span>
                            <?php }else {?>
                            <span class="badge badge-success right"><?php echo $key['lbl_count'];?></span>
                            <?php }?>
                        </p>
                    </a>
                    <?php  if($user->verifikasi=='Y'){foreach($key['submenu'] as $a=> $val){?>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo $val['link'];?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p><?php echo $val['label'];?></p>
                            </a>
                        </li>
                    </ul>
                    <?php } }?>
                </li>
                <?php } } ?>
                <li class="nav-header ">Account</li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>
                            Profile
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo site_url('admin/page/user?mod='.base64_encode("admin-menu-master-html-h_profile_user").'&role='.base64_encode($role->id));?>"
                                class="nav-link">
                                <i class="nav-icon far fa-grin-alt text-success"></i>
                                <p class="text">User</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo site_url('login/logout?end='.base64_encode($user->id));?>"
                                class="nav-link">
                                <i class="nav-icon fas fa-power-off text-danger"></i>
                                <p>Log Out</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</aside>