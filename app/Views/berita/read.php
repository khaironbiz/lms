<?php 
$session = \Config\Services::session();
?>
<main id="main">
  <!-- ======= Breadcrumbs Section ======= -->
  <section class="breadcrumbs">
    <div class="container">
      <div class="d-flex justify-content-between align-items-center">
        <h2><?= $title ?></h2>
      </div>
    </div>
  </section><!-- End Breadcrumbs Section -->

  <!-- ======= Contact Section ======= -->
  <section id="contact" class="contact">
    <div class="container">
      <div class="row">
        <div class="col-md-8">
          <div class="card">
            <img src="<?= base_url('assets/upload/image/' . $berita['gambar']) ?>">
            <div class="card-body">
              <h3><?= $berita['judul_berita'] ?></h3>
                <?= $berita['isi'] ?>
            </div>
          </div>
          <?php
          if($berita['jenis_berita']=="Event"){
          ?>
          <div class="card mt-3">
            <div class="card-header"><b>Kelas</b></div>
            <div class="card-body">
              <table class="table table-sm">
                <tr>
                  <th>No</th>
                  <th>Kegiatan</th>
                  <th>SKP</th>
                  <th>Harga</th>
                  <th>Aksi</th>
                </tr>
                <?php
                $no = 1;
                foreach($kelas as $k){
                  //$lama_kegiatan  = $k['tanggal_selesai']-$k['tanggal_mulai']
                ?>
                <?php
                    $birthDate  = new DateTime($k['tanggal_mulai']);
                    $today      = new DateTime($k['tanggal_selesai']);
                    if ($birthDate > $today) { 
                        exit("0 tahun 0 bulan 0 hari");
                    }
                    $y = $today->diff($birthDate)->y;
                    $m = $today->diff($birthDate)->m;
                    $d = $today->diff($birthDate)->d;
                    //return $y." tahun ".$m." bulan ".$d." hari";
                    $lama = $d+1;
                  
                ?>
                <tr>
                  <td><?= $no++; ?></td>
                  <td><?= $k['nama_kelas']?></td>
                  <td></td>
                  <td><?= number_format($k['harga_jual'])?></td>
                  <td>
                    <button class="btn btn-success btn-sm">Daftar</button>
                    <button class="btn btn-primary btn-sm">Detail</button>
                  </td>
                </tr>
              <?php
              }
              ?>
                
              </table>
              
            </div>
            <div class="card-header"><b>Materi Kegiatan</b></div>
            <div class="card-body">
              <table class="table">
                <tr>
                  <th>No</th>
                  <th>Uraian</th>
                  <th>Pembicara</th>
                  <th>Bobot</th>
                </tr>
                <?php
                
                ?>
                <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
              </table>
            </div>
            <div class="card-footer">
              <button>Daftar</button><br>
            </div>
          </div>
          <?php
          }
          ?>
          
        </div>
        <div class="col-md-4">
          <div class="card">
            <div class="card-header">
              <h3>Berita Lainnya</h3>
            </div>
            <div class="card-body">
              <?php foreach ($sidebar as $sidebar) { ?>
              <div class="row">
                <div class="col-3">
                  <?php if ($sidebar['gambar'] === '') { ?>
                    <img src="<?= icon() ?>" class="img img-thumbnail">
                  <?php 
                    }else{ 
                  ?>
                    <img src="<?= base_url('assets/upload/image/thumbs/' . $sidebar['gambar']) ?>" class="img img-thumbnail">
                  <?php 
                  } 
                  ?>
                </div>
                <div class="col-9"><h4 style="font-size: 18px;"><a href="<?= base_url('berita/read/' . $sidebar['slug_berita']) ?>"></a></h4>
                    <small class="text-gray-dark"><i class="fa fa-eye"></i> <?= $sidebar['hits'] ?> views</small>
                </div>
                <div class="clearfix"><br></div><hr>
                <?php 
                } 
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section><!-- End Contact Section -->
</main><!-- End #main -->