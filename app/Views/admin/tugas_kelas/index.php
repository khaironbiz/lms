<?php
echo view('admin/sub_menu/tugas');
?>
<a href="<?=base_url()?>/admin/tugas_kelas/tambah" class="btn btn-primary mt-3">Tambah Tugas</a>
<div class="row">
    <div class="col-md-12">
        <table class="table table-sm table-striped" id="example3">
            <thead>
            <tr>
                <th>No</th>
                <th>Kelas</th>
                <th>Tugas</th>
                <th>Metode</th>
                <th>Mulai</th>
                <th>Selesai</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $no = 1;
            foreach ($tugas_kelas as $tk) {?>
                <tr>
                    <td><?= $no ?></td>
                    <td><?= $tk['nama_kelas'] ?></td>
                    <td><?= $tk['nama_tugas'] ?></td>
                    <td><?= $tk['nama_metode'] ?></td>
                    <td><?= date('Y-m-d H:i:s',$tk['time_start']) ?></td>
                    <td><?= date('Y-m-d H:i:s',$tk['time_finish']) ?></td>
                    <td><?= $tk['keterangan']?></td>
                    <td>
                        <a href="<?= base_url('admin/tugas_kelas/detail/' . $tk['has_tugas_kelas']) ?>" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
                        <a href="<?= base_url('admin/tugas_kelas/edit/' . $tk['has_tugas_kelas']) ?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                        <a href="<?= base_url('admin/tugas_kelas/delete/' . $tk['has_tugas_kelas']) ?>" class="btn btn-dark btn-sm" onclick="confirmation(event)"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
                <?php $no++; } ?>
            </tbody>
        </table>

    </div>

</div>
