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

            </div>

        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <img src="<?= base_url()?>/assets/upload/image/<?= $kelas->poster?>">
        </div>
    </div>
</div>


