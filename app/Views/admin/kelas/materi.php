<?php
use App\Models\Materi_file_model;
$tanggal_mulai      = $kelas->tanggal_mulai;
$tanggal_selesai    = $kelas->tanggal_selesai;
echo view('admin/sub_menu/kelas');
?>

<div class="row mt-2">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-dark">
                <div class="row">
                    <div class="col-md-9">
                        <b><?= $kelas->nama_kelas;?></b>
                    </div>
                    <div class="col-md-3 text-right">
                        <a href="<?= base_url()?>/admin/kelas/edit/<?= $kelas->has_kelas;?>" class="btn btn-sm btn-success">Edit</a>
                        <a href="#" class="btn btn-sm btn-danger">Delete</a>
                    </div>
                </div>

            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <label class="col-md-5">Tanggal Kegiatan</label>
                            <div class="col-md-7"> :
                                <?php if($tanggal_mulai == $tanggal_selesai){ echo $tanggal_mulai; }else{ echo $tanggal_mulai." sd ". $tanggal_selesai;} ;?>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-md-5">Harga Dasar</label>
                            <div class="col-md-7"> :
                                <?= number_format($kelas->harga_dasar);?>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-md-5">Harga Jual</label>
                            <div class="col-md-7"> :
                                <?= number_format($kelas->harga_jual);?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <label class="col-md-5">Kuota</label>
                            <div class="col-md-7"> :
                                <?= number_format($kelas->kuota);?>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-md-5">Pendaftar</label>
                            <div class="col-md-7"> :
                                <?= number_format($count_peserta);?>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-md-5">Sisa</label>
                            <div class="col-md-7"> :
                                <?= number_format(($kelas->kuota)-$count_peserta);?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-header">
                <b>Materi</b>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php
                    foreach ($materi as $materi):
                        $id_materi = $materi['id_materi'];
                    $m_materi_file = new Materi_file_model();
                    $count_file = $m_materi_file->count_id_materi($id_materi);
                    ?>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <b><?= $materi['materi']?></b><br>
                                <small><?= $materi['nama']?></small>
                            </div>
                            <div class="card-body">
                                <b>Bahan Ajar : <?= $count_file?></b>
                            </div>
                            <div class="card-footer"><a href="#" class="btn btn-sm btn-info">Detail</a></div>
                        </div>
                    </div>
                    <?php
                    endforeach;
                    ?>
                </div>
            </div>

        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <img src="<?= base_url()?>/assets/upload/image/<?= $kelas->poster?>">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-4">
        <a href="<?= base_url()?>/admin/event/detail/<?= $berita['has_berita'];?>" class="btn btn-sm btn-primary">Back</a>
    </div>
    <div class="col-4 text-center">

    </div>
    <div class="col-4 text-right">

    </div>


</div>
