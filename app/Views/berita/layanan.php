<?php
use App\Models\Menu_model;
$menu         = new Menu_model();
$menu_layanan = $menu->layanan();
?>
<main id="main">
  <!-- ======= Breadcrumbs Section ======= -->
  <section class="breadcrumbs">
    <div class="container">
      <div class="d-flex justify-content-between align-items-center">
        <h2><?= $title ?></h2>
        <ol>
          <li><a href="<?= base_url() ?>">Home</a></li>
          <li><?= $title ?></li>
        </ol>
      </div>
    </div>
  </section><!-- End Breadcrumbs Section -->

  <!-- ======= Contact Section ======= -->
  <section id="contact" class="contact">
    <div class="container">
      <div class="row mt-2">

         <div class="col-md-4">
            <img src="<?= base_url('assets/upload/image/' . $berita['gambar']) ?>" class="img img-thumbnail">
            <h4>Layanan Kami :</h4>
            <ul>
              <?php foreach ($menu_layanan as $menu_layanan) { ?>
                <li><i class="bx bx-chevron-right"></i> <a href="<?= base_url('berita/layanan/' . $menu_layanan['slug_berita']) ?>"><?= $menu_layanan['judul_berita'] ?></a></li>
                <?php } ?>
            </ul>
         </div>
         <div class="col-md-8">
          <div class="card">
            <div class="card-header">
              <h4><?= $title ?></h4>
            </div>
            <div class="card-body text-justify">
               <?= $berita['isi'] ?>
            </div>
            <div class="card-footer">
              Updated by: <?= $berita['nama'] ?> | Tanggal: <?= tanggal_bulan_menit($berita['tanggal']) ?>
            </div>
          </div>

         </div>

      </div>
    </div>
  </section><!-- End Contact Section -->
</main><!-- End #main -->