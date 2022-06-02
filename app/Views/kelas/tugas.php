<?php
use App\Models\Soal_jawaban_model;
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

    <!-- ======= Doctors Section ======= -->
    <section id="doctors" class="doctors section-bg">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
                <h2><?= $title ?></h2>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <b><?= $kelas->nama_kelas?></b><br>
                            <small>
                                <?= $kelas->nama_kategori_kelas?> :
                                <?php
                                if($kelas->tanggal_mulai == $kelas->tanggal_selesai){
                                    ?>
                                    <b class="text-primary"><?= $kelas->tanggal_mulai?></b>
                                    <?php
                                }else{
                                    ?>
                                    <b class="text-primary"><?= $kelas->tanggal_mulai?> sd <?= $kelas->tanggal_selesai?></b>
                                    <?php
                                }
                                ?><br>
                                <b class="text-primary"><small><?= $kelas->nama_client?></small></b>

                            </small>
                        </div>
                        <div class="card-body">
                            <b><?= $tugas_kelas_detail['nama_tugas']?> : <?= $count_soal; ?> Soal</b>
                            <?php
                            foreach ($soal as $soal){
                                $id_soal = $soal['id_soal'];
                                $m_soal_jawaban = new Soal_jawaban_model();
                                $soal_jawaban   = $m_soal_jawaban->list_id_soal($id_soal);

                                ?>


                            <div class="card mb-1">
                                <div class="card-header"><b><?= $soal['soal'];?></b></div>
                                <div class="card-body">
                                    <?php
                                    foreach ($soal_jawaban as $jawaban):
                                    ?>
                                    <input type="radio" value="<?= $jawaban['id_soal_jawaban']?>" name="jawaban[]"><?= $jawaban['jawaban']?><br>
                                        <?php
                                    endforeach;
                                        ?>
                                </div>
                            </div>
                            <?php
                            }

                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <img src="<?= base_url('assets/upload/image/'.$kelas->poster)?>" class="w-100">

                    <?php
                    include('sub-menu.php')
                    ?>
                </div>

            </div>

        </div>
    </section><!-- End Doctors Section -->


</main><!-- End #main -->