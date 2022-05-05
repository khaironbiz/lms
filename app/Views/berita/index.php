<main id="main">
  <!-- ======= Breadcrumbs Section ======= -->
  <section class="breadcrumbs">
    <div class="container">
      <div class="d-flex justify-content-between align-items-center">
        <h5><?= $title ?></h5>
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
      <div class="section-title">
          <h2><?= $title ?></h2>
      </div>
      <div class="row">
        <?php foreach ($berita as $berita) { ?>
         <div class="col-lg-4 col-md-6 d-flex ">
           <div class="card mb-2">
            <img src="<?= base_url('assets/upload/image/' . $berita['gambar']) ?>" class="w-100">
            <div class="card-body">
              <h5><?= $berita['judul_berita'] ?></h5>
              <p class="card-text">
                <?= $berita['ringkasan'] ?>
              </p>
              <p>
                
              </p>
            </div>
            <div class="card-footer">
              <a href="<?= base_url('berita/read/' . $berita['slug_berita']) ?>" class="btn btn-default">
                  <i class="fa fa-chevron-right"></i>  Baca...
                </a>
            </div>
          </div>
         </div>
       <?php } ?>
      </div>
    </div>
  </section><!-- End Contact Section -->
</main><!-- End #main -->