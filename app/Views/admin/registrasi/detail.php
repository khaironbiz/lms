<div class="row">
    <div class="col-md-12">
        <table class="table table-sm table-striped">
            <tr>
                <th >Nama</th>
                <td>:</td>
                <td class="w-75"><?= $registrasi['nama']?></td>
            </tr>
            <tr>
                <th >NIK</th>
                <td>:</td>
                <td class="w-75"><?= $registrasi['nik']?></td>
            </tr>
            <tr>
                <th >Jenis Kelamin</th>
                <td>:</td>
                <td class="w-75"><?= $registrasi['jenis_kelamin']?></td>
            </tr>
            <tr>
                <th >Email</th>
                <td>:</td>
                <td class="w-75"><?= $registrasi['email']?></td>
            </tr>
            <tr>
                <th >HP</th>
                <td>:</td>
                <td class="w-75"><?= $registrasi['hp']?></td>
            </tr>
            <tr>
                <th >NIRA</th>
                <td>:</td>
                <td class="w-75"><?= $registrasi['nira']?></td>
            </tr>
            <tr>
                <th >DPW</th>
                <td>:</td>
                <td class="w-75"><?= $registrasi['nama_prov']?></td>
            </tr>
            <tr>
                <th >Time</th>
                <td>:</td>
                <td class="w-75">
                    <?= $registrasi['created_at']?>/<?= $registrasi['updated_at']?>
                </td>
            </tr>
            <tr>
                <th >Aksi</th>
                <td>:</td>
                <td class="w-75">
                    <a href="<?= base_url('admin/registrasi/edit/'.$registrasi['has_registrasi'])?>" class="btn btn-sm btn-success">Edit</a>
                    <a href="<?= base_url('admin/registrasi/delete/'.$registrasi['has_registrasi'])?>" class="btn btn-sm btn-danger">Delete</a>
                    <a href="<?= base_url('admin/registrasi/approve/'.$registrasi['has_registrasi'])?>" class="btn btn-sm btn-primary">Approve</a>
                </td>
            </tr>
        </table>
        <a href="<?= base_url('admin/registrasi/')?>" class="btn btn-sm btn-danger">Back</a>
    </div>

</div>