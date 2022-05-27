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
                            <b>Materi</b>
                            <table class="table table-sm table-striped">
                                <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Time</th>
                                    <th class="w-75">Materi</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $x    = 1;
                                foreach ($materi as $materi):
                                    $detik_mulai = strtotime($materi['waktu_mulai']);
                                    $detik_selesai = strtotime($materi['waktu_selesai']);
                                    ?>
                                    <tr>
                                        <td class="text-center"><?= $x++?></td>
                                        <td class="text-center"><?= date('H:i', $detik_mulai)?> - <?= date('H:i', $detik_selesai)?></td>
                                        <td>
                                            <a href="<?= base_url('kelas/materi/'.$materi['has_materi'])?>" >
                                                <?= $materi['materi']?><br><b><?= $materi['nama']?></b>
                                            </a>

                                        </td>
                                    </tr>
                                <?php
                                endforeach;
                                ?>
                                </tbody>
                            </table>

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