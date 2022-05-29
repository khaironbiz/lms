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
      <div class="row">
        <?php foreach ($video as $video) { ?>
          <div class="col-md-4 d-flex">
            <div class="card w-100 mt-2">
              <div class="embed-responsive embed-responsive-16by9">
                <iframe  class="embed-responsive-item" src="https://www.youtube.com/embed/<?= $video['video'] ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style="min-height: 300px;"></iframe>
              </div>
              <div class="card-body">
                <h6><?= $video['judul'] ?></h6>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>
  </section><!-- End Contact Section -->
</main><!-- End #main -->