<?php
echo view('admin/sub_menu/tugas');
?>
<?= form_open(base_url('admin/tugas_metode/update/' . $tugas_metode['has_tugas_metode']));
echo csrf_field();
?>
    <div class="row form-group mt-3">
        <label class="col-md-3">Metode Penugasan</label>
        <div class="col-md-9">
            <input type="text" name="nama_metode" class="form-control" placeholder="Nama Tugas" value="<?= $tugas_metode['nama_metode'] ?>" required title="Metode Penugasan">
        </div>
    </div>


    <div class="form-group row">
        <label class="col-md-3"></label>
        <div class="col-md-9">
            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
        </div>
    </div>

<?= form_close(); ?>