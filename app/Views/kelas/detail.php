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
                        <?php
                        if($kelas->poster){
                        ?>
                        <img src="<?= base_url('assets/upload/image/' . $kelas->poster) ?>">
                        <?php
                        }
                        ?>
                        <div class="card-body">
                            <h3><?= $kelas->nama_kelas ?></h3>
                            <?= $kelas->nama_kelas ?>
                            <?php
                                $waktu_awal = strtotime($kelas->tanggal_mulai);
                                $waktu_ahir = strtotime($kelas->tanggal_selesai);
                                if($waktu_awal == $waktu_ahir){
                                    echo "Satu Hari";
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                </div>
            </div>
        </div>
    </section><!-- End Contact Section -->
</main><!-- End #main -->