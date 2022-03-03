<?php
use App\Models\Materi_model;
$m_materi           = new Materi_model();
?>
<div class="card">
    <img src="http://localhost/lms/assets/upload/image/<?= $berita['gambar']?>">
    <div class="card-header">
        <h4><?= $berita['judul_berita']?></h4>
        
    </div>
    <div class="card-body">
        <?= $berita['isi']?>
    </div>
    <div class="card-header">
        <b>Kegiatan</b>
    </div>
    <div class="card-body">
        <table class="table table-sm table-striped">
            <tr>
                <th>No</th>
                <th>Nama Kegiatan</th>
                <th>Tanggal</th>
                <th>SKP</th>
                <th>Harga Dasar</th>
                <th>Harga Jual</th>
                <th>Aksi</th>
            </tr>
            <?php
            $no = 1;
            foreach($kelas as $k){
            ?>
            <tr>
                <td><?= $no++?></td>
                <td><?= $k['nama_kelas'];?></td>
                <td><?= $k['tanggal_mulai'];?></td>
                <td><?= $k['nama_kelas'];?></td>
                <td><?= $k['harga_dasar'];?></td>
                <td><?= $k['harga_jual'];?></td>
                <td>
                    <a href="#" class="btn btn-sm btn-success">Edit</a>
                    <a href="#" class="btn btn-sm btn-danger">Delete</a>
                </td>
            </tr>
            <?php
            }
            ?>
        </table>
    </div>
    <div class="card-header">
        <b>Materi Kegatan</b>
    </div>
    <div class="card-body">
        <table class="table table-sm table-striped">
            <tr>
                <th>No</th>
                <th>Jam</th>
                <th>Tema Pembelajaran</th>
                <th>Pemateri</th>
                <th>Bahan Pembelajaran</th>
                <th>Aksi</th>
            </tr>
            <?php
            $nomor=1;
            foreach($kelas as $kelas){
                $id_kelas   = $kelas['id_kelas'];
                $materi     = $m_materi->kelas($id_kelas);
            ?>
            <tr>
                <td><?= $nomor++?></td>
                <td colspan="4" class="text-center text-primary"><b><?= $kelas['nama_kelas']?></b></td>
                <td>
                    
                </td>
            </tr>
            <?php
            foreach($materi as $m){
                $mulai = strtotime($m['waktu_mulai'])
            ?>
            <tr>
                <td></td>
                <td><?= date('H:i',$mulai)?></td>
                <td><?= $m['materi']?></td>
                <td></td>
                <td></td>
                <td>
                    <a href="#" class="btn btn-sm btn-success">Edit</a>
                    <a href="#" class="btn btn-sm btn-danger">Delete</a>
                </td>
            </tr>
            <?php
            }
            ?>
            <?php
            }
            ?>
        </table>
    </div>
</div>