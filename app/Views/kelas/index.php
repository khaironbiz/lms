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

  <!-- ======= Doctors Section ======= -->
    <section id="doctors" class="doctors section-bg">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
            <h2><?= $title ?></h2>
            </div>
            <div class="row">
            <?php foreach ($kelas as $kelas) { ?>
            <div class="col-lg-4 col-md-6">
                <div class="member" data-aos="fade-up" data-aos-delay="100">
                <div class="member-img">
                    <a href="<?= base_url('kelas/room/'.$kelas['has_kelas'])?>">
                        <img src="<?= base_url('assets/upload/image/'.$kelas['poster'])?>" class="">
                    </a>
                    
                </div>
                <div class="member-info">
                    <a href="<?= base_url('kelas/room/'.$kelas['has_kelas'])?>">
                        <b><?= $kelas['nama_kelas'] ?></b>
                        <span><?php if($kelas['tanggal_mulai'] == $kelas['tanggal_selesai']){ echo $kelas['tanggal_mulai']; }else{ echo $kelas['tanggal_mulai'] . " sd ".$kelas['tanggal_selesai']; }  ?></span>
                    </a>
                </div>
                </div>
            </div>
            <?php } ?>


            </div>

        </div>
    </section><!-- End Doctors Section -->


</main><!-- End #main -->