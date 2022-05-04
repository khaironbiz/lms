<?php $session = \Config\Services::session();
use App\Models\Dasbor_model;

$m_dasbor = new Dasbor_model();
?>
<div class="alert alert-info">
	<h4>Hai <em class="text-warning"><?= $session->get('nama') ?></em></h4>
	<hr>
	<p>Selamat datang di website <strong><?= namaweb() ?></strong>. Website ini adalah sample hasil belajar di Java Web Media <a href="https://javawebmedia.com">www.javawebmedia.com</a>. Semoga bermanfaat yah.</p>
</div>




 <!-- Info boxes -->
<div class="row">
  <div class="col-6 col-md-4 col-xl-3 col-xxl-2">
    <div class="info-box">
      <span class="info-box-icon bg-info elevation-1"><a href="<?= base_url('admin/berita')?>"><i class="fas fa-newspaper"></i></a></span>
      <div class="info-box-content">
        <span class="info-box-text">Berita</span>
        <span class="info-box-number">
          <?= angka($m_dasbor->berita()) ?>
          <small>Konten</small>
        </span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  
  <!-- /.col -->
  <div class="col-6 col-md-4 col-xl-3 col-xxl-2">
    <div class="info-box mb-3">
      <span class="info-box-icon bg-success elevation-1"><a href="<?= base_url('admin/event')?>"><i class="fas fa-book"></i></a></span>
      <div class="info-box-content">
        <span class="info-box-text">Event</span>
        <span class="info-box-number"><?= angka($m_dasbor->event()) ?> <small>Kegiatan</small></span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
  <!-- /.col -->
  <div class="col-6 col-md-4 col-xl-3 col-xxl-2">
    <div class="info-box mb-3">
      <span class="info-box-icon bg-success elevation-1"><a href="<?= base_url('admin/kelas')?>"><i class="fas fa-laptop-house"></i></a></span>
      <div class="info-box-content">
        <span class="info-box-text">Kelas</span>
        <span class="info-box-number"><?= angka($m_dasbor->event()) ?> <small>Acara</small></span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
  <!-- /.col -->
  <div class="col-6 col-md-4 col-xl-3 col-xxl-2">
    <div class="info-box mb-3">
      <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-address-card"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Clients <i class="fas fa-acorn"></i></span>
        <span class="info-box-number"><?= angka($m_dasbor->client()) ?></span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->

  <!-- fix for small devices only -->
  <div class="clearfix hidden-md-up"></div>

  <div class="col-6 col-md-4 col-xl-3 col-xxl-2">
    <div class="info-box mb-3">
      <span class="info-box-icon bg-success elevation-1"><a href="<?= base_url('admin/user')?>"><i class="fas fa-users"></i></a></span>

      <div class="info-box-content">
        <span class="info-box-text">Users</span>
        <span class="info-box-number"><?= angka($m_dasbor->staff()) ?></span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  
  <!-- /.col -->
  <div class="col-6 col-md-4 col-xl-3 col-xxl-2">
    <div class="info-box mb-3">
      <span class="info-box-icon bg-warning elevation-1"><a href="<?= base_url('admin/url')?>"><i class="fas fa-globe"></i></a></span>
      <div class="info-box-content">
        <span class="info-box-text">Short Url</span>
        <span class="info-box-number"><?= angka($m_dasbor->url()) ?></span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
  <!-- /.col -->
  <div class="col-6 col-md-4 col-xl-3 col-xxl-2">
    <div class="info-box mb-3">
      <span class="info-box-icon bg-info elevation-1"><a href="<?= base_url('admin/url')?>"><i class="fas fa-graduation-cap"></i></a></span>
      <div class="info-box-content">
        <span class="info-box-text">Organisasi</span>
        <span class="info-box-number"><?= angka($m_dasbor->op()) ?></span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->

<!-- /.col -->
  <div class="col-6 col-md-4 col-xl-3 col-xxl-2">
    <div class="info-box mb-3">
      <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-download"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">File Download</span>
        <span class="info-box-number"><?= angka($m_dasbor->download()) ?></span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
  <div class="col-6 col-md-4 col-xl-3 col-xxl-2">
    <div class="info-box">
      <span class="info-box-icon bg-info elevation-1"><i class="fas fa-images"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Galeri &amp; Banner</span>
        <span class="info-box-number">
          <?= angka($m_dasbor->galeri()) ?>
          <small>Konten</small>
        </span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
  <div class="col-6 col-md-4 col-xl-3 col-xxl-2">
    <div class="info-box mb-3">
      <span class="info-box-icon bg-danger elevation-1"><i class="fab fa-youtube"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Video Youtube</span>
        <span class="info-box-number"><?= angka($m_dasbor->video()) ?></span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->

  <!-- fix for small devices only -->
  <div class="clearfix hidden-md-up"></div>

  <div class="col-6 col-md-4 col-xl-3 col-xxl-2">
    <div class="info-box mb-3">
      <span class="info-box-icon bg-success elevation-1"><i class="fas fa-tags"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Kategori Berita</span>
        <span class="info-box-number"><?= angka($m_dasbor->kategori()) ?></span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
  <div class="col-6 col-md-4 col-xl-3 col-xxl-2">
    <div class="info-box mb-3">
      <span class="info-box-icon bg-warning elevation-1"><a href="<?= base_url('admin/url')?>"><i class="fab fa-whmcs"></i></i></a></span>
      <div class="info-box-content">
        <span class="info-box-text">Web Settings</span>
        <span class="info-box-number"><?= angka($m_dasbor->url()) ?></span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
  <div class="col-6 col-md-4 col-xl-3 col-xxl-2">
    <div class="info-box mb-3">
      <span class="info-box-icon bg-warning elevation-1"><a href="<?= base_url('admin/url')?>"><i class="fab fa-whmcs"></i></i></a></span>
      <div class="info-box-content">
        <span class="info-box-text">User Log</span>
        <span class="info-box-number"><?= angka($m_dasbor->hits()) ?></span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->

</div>
<!-- /.row -->