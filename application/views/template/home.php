<?php $this->load->view('template/header'); ?>

<?php if($this->session->userdata('level') == "1"){ ?>
<!-- cek plagiasi judul -->
<div class="col-lg-4 col-xs-12">
    <!-- small box -->
    <div class="small-box bg-green">
        <div class="inner">
            <h4>Cek Plagiasi Judul</h4><br>
        </div>
        <a href="<?= base_url('superadmin/cek_plagiasi/input') ?>">
        <div class="icon">
            <i class="fa fa-check-square-o"></i>
        </div>
        </a>
        <a href="<?= base_url('superadmin/cek_plagiasi/input') ?>" class="small-box-footer">Cek Plagiasi <i class="fa fa-arrow-circle-right"></i></a>
    </div>
</div>

<div class="col-lg-4 col-xs-12">
    <!-- small box -->
    <div class="small-box bg-primary">
        <div class="inner">
            <h4>Lihat Judul Skripsi</h4><br>
        </div>
        <a href="<?= base_url('superadmin/judul_skripsi/lihat') ?>">
        <div class="icon">
            <i class="fa fa-book"></i>
        </div>
        </a>
        <a href="<?= base_url('superadmin/judul_skripsi/lihat') ?>" class="small-box-footer">Lihat Judul <i class="fa fa-arrow-circle-right"></i></a>
    </div>
</div>


<div class="col-lg-4 col-xs-12">
    <!-- small box -->
    <div class="small-box bg-yellow">
        <div class="inner">
            <h4>Input Judul Skripsi</h4><br>
        </div>
        <a href="<?= base_url('superadmin/judul_skripsi/lihat') ?>">
        <div class="icon">
            <i class="fa fa-edit"></i>
        </div>
        </a>
        <a href="<?= base_url('superadmin/judul_skripsi/lihat') ?>" class="small-box-footer">Input Judul <i class="fa fa-arrow-circle-right"></i></a>
    </div>
</div>

<?php }elseif($this->session->userdata('level') == "2"){ ?>
   <!-- cek plagiasi judul -->
<div class="col-lg-4 col-xs-12">
    <!-- small box -->
    <div class="small-box bg-green">
        <div class="inner">
            <h4>Cek Plagiasi Judul</h4><br>
        </div>
        <a href="<?= base_url('admin/cek_plagiasi/input') ?>">
        <div class="icon">
            <i class="fa fa-check-square-o"></i>
        </div>
        </a>
        <a href="<?= base_url('admin/cek_plagiasi/input') ?>" class="small-box-footer">Cek Plagiasi <i class="fa fa-arrow-circle-right"></i></a>
    </div>
</div>

<div class="col-lg-4 col-xs-12">
    <!-- small box -->
    <div class="small-box bg-primary">
        <div class="inner">
            <h4>Lihat Judul Skripsi</h4><br>
        </div>
        <a href="<?= base_url('admin/judul_skripsi/lihat') ?>">
        <div class="icon">
            <i class="fa fa-book"></i>
        </div>
        </a>
        <a href="<?= base_url('admin/judul_skripsi/lihat') ?>" class="small-box-footer">Lihat Judul <i class="fa fa-arrow-circle-right"></i></a>
    </div>
</div>


<div class="col-lg-4 col-xs-12">
    <!-- small box -->
    <div class="small-box bg-yellow">
        <div class="inner">
            <h4>Input Judul Skripsi</h4><br>
        </div>
        <a href="<?= base_url('admin/judul_skripsi/lihat') ?>">
        <div class="icon">
            <i class="fa fa-edit"></i>
        </div>
        </a>
        <a href="<?= base_url('admin/judul_skripsi/lihat') ?>" class="small-box-footer">Input Judul <i class="fa fa-arrow-circle-right"></i></a>
    </div>
</div>

<?php }elseif($this->session->userdata('level') == "3"){ ?>

    <!-- cek plagiasi judul -->
<div class="col-lg-4 col-xs-12">
    <!-- small box -->
    <div class="small-box bg-green">
        <div class="inner">
            <h4>Cek Plagiasi Judul</h4><br>
        </div>
        <a href="<?= base_url('dosen/cek_plagiasi/input') ?>">
        <div class="icon">
            <i class="fa fa-check-square-o"></i>
        </div>
        </a>
        <a href="<?= base_url('dosen/cek_plagiasi/input') ?>" class="small-box-footer">Cek Plagiasi <i class="fa fa-arrow-circle-right"></i></a>
    </div>
</div>

<?php } ?>

<?php $this->load->view('template/footer'); ?>