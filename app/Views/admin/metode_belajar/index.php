<?php 
 echo view($sub_menu);
use App\Models\Kategori_kelas_model;
include 'tambah.php'; 
?>
<div class="row">
    <div class="col-md-8">
        <table class="table table-bordered table-sm" id="example1">
            <thead>
            <tr>
                <th>No</th>
                <th>Metode_belajar</th>
                <th>Count</th>
                <th>Aksi</th>
            </tr>
            </thead>
            <tbody>
            <?php $no = 1;
            foreach ($metode_belajar as $mb) {
                ?>
                <tr>
                    <td><?= $no++;?></td>
                    <td><?= $mb['metode_belajar']?></td>
                    <td></td>
                    <td></td>
                </tr>

                <?php $no++; } ?>
            </tbody>
        </table>
    </div>

</div>