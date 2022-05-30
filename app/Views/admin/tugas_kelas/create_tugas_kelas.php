<?= form_open(base_url('admin/tugas_kelas/create_tugas_kelas/'.$kelas['has_kelas']));
echo csrf_field();
?>
<div class="row">
    <div class="col-md-6">
        <div class="row form-group">
            <label class="col-md-3">Kelas</label>
            <div class="col-md-9">
                <select class="form-control form-control-sm" name="id_kelas">
                    <option value=""><?= $kelas['nama_kelas']?></option>
                </select>
            </div>
        </div>
        <div class="row form-group">
            <label class="col-md-3">Jenis Tugas</label>
            <div class="col-md-9">
                <select class="form-control form-control-sm" name="id_tugas">
                    <?php
                    foreach ($tugas as $tugas):
                        ?>
                        <option value="<?= $tugas['id_tugas']?>"><?= $tugas['nama_tugas']?></option>
                    <?php
                    endforeach;
                    ?>
                </select>
            </div>
        </div>
        <div class="row form-group">
            <label class="col-md-3">Metode</label>
            <div class="col-md-9">
                <select class="form-control form-control-sm" name="id_metode">
                    <option value="1">Pilihan Ganda</option>
                    <option value="2">Essay</option>
                    <option value="3">Makalah</option>
                    <option value="4">Project</option>
                </select>
            </div>
        </div>
        <div class="row form-group">
            <label class="col-md-3">Waktu Mulai</label>
            <div class="col-md-5">
               <input type="date" class="form-control form-control-sm tanggal" name="tgl_start">
            </div>
            <div class="col-md-4">
                <input type="text" class="form-control form-control-sm jam" name="jam_start" placeholder="JJ:MM:DD">
            </div>
        </div>
        <div class="row form-group">
            <label class="col-md-3">Waktu Selesai</label>
            <div class="col-md-5">
                <input type="date" class="form-control form-control-sm tanggal" name="tgl_finish">
            </div>
            <div class="col-md-4">
                <input type="text" class="form-control form-control-sm jam" name="jam_finish" placeholder="JJ:MM:DD">
            </div>
        </div>
        <div class="row form-group">
            <label class="col-md-3">Keterangan</label>
            <div class="col-md-9">
                <textarea name="keterangan" class="form-control"></textarea>

            </div>

        </div>
        <div class="form-group row">
            <label class="col-md-3"></label>
            <div class="col-md-9">
                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
            </div>
        </div>
    </div>
</div>
<?= form_close(); ?>