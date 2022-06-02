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
                <b>Akreditasi</b>
            </div>
            <div class="card-body">
                <table class="table table-sm">
                    <tr>
                        <th></th>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                </table>
            </div>

        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <b>Akreditasi Profesi</b>
            </div>
            <img src="<?= base_url()?>/assets/upload/image/<?= $kelas->poster?>">
        </div>
    </div>
</div>
