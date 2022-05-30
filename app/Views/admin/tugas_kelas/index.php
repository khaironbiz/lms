<?php include 'tambah.php'; ?>
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
                    <td><?= $tk['id_metode'] ?></td>
                    <td><?= date('Y-m-d H:i:s',$tk['time_start']) ?></td>
                    <td><?= date('Y-m-d H:i:s',$tk['time_finish']) ?></td>
                    <td>
                        <a href="<?= base_url('admin/tugas/edit/' . $tk['has_tugas_kelas']) ?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                        <a href="<?= base_url('admin/tugas/delete/' . $tk['has_tugas_kelas']) ?>" class="btn btn-dark btn-sm" onclick="confirmation(event)"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
                <?php $no++; } ?>
            </tbody>
        </table>

    </div>

</div>
