<?php
echo view('admin/sub_menu/tugas');
?>
<?php include 'tambah.php'; ?>
<div class="row">
    <div class="col-md-8">
        <table class="table table-sm table-striped" id="example3">
            <thead>
            <tr>
                <th>No</th>
                <th>Tugas</th>
                <th>Count Kelas</th>
                <th>Count Peserta</th>
                <th>Aksi</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $no = 1;
            foreach ($tugas as $tugas) {?>
                <tr>
                    <td><?= $no ?></td>
                    <td><?= $tugas['nama_tugas'] ?></td>
                    <td></td>
                    <td></td>
                    <td>
                        <a href="<?= base_url('admin/tugas/edit/' . $tugas['has_tugas']) ?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                        <a href="<?= base_url('admin/tugas/delete/' . $tugas['has_tugas']) ?>" class="btn btn-dark btn-sm" onclick="confirmation(event)"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
                <?php $no++; } ?>
            </tbody>
        </table>

    </div>

</div>
