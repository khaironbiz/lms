<div class="row">
    <div class="col-md-12">
        <table class="table table-sm table-striped" id="example3">
            <thead>
            <tr>
                <th>#</th>
                <th>Identitas</th>
                <th>Kontak</th>
                <th>Organisasi</th>
                <th>Aksi</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $x=1;
            foreach ($registrasi as $registrasi):
                ?>
                <tr>
                    <td><?= $x++; ?></td>
                    <td>
                        <?= $registrasi['nama']; ?><br>
                        <?= $registrasi['nik']; ?><br>
                        <?= $registrasi['jenis_kelamin']; ?>
                    </td>
                    <td>
                        <?= $registrasi['email']; ?><br>
                        <?= $registrasi['hp']; ?>
                    </td>
                    <td>
                        <?= $registrasi['nira']; ?> <br>
                        <?= $registrasi['nama_prov']; ?>
                    </td>
                    <td>
                        <a href="<?= base_url('admin/registrasi/detail/'.$registrasi['has_registrasi'])?>" class="btn btn-sm btn-success">Detail</a><br>
                        <?= $registrasi['updated_at']?>
                    </td>
                </tr>
            <?php
            endforeach;
            ?>
            </tbody>
        </table>
    </div>

</div>