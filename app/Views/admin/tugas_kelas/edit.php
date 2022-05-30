<?= form_open(base_url('admin/tugas/update/' . $tugas['has_tugas']));
echo csrf_field();
?>
    <div class="row form-group">
        <label class="col-md-3">NIK</label>
        <div class="col-md-9">
            <input type="text" name="nama_tugas" class="form-control" placeholder="Nama Tugas" value="<?= $tugas['nama_tugas'] ?>" required title="Nama Tugas">
        </div>
    </div>


    <div class="form-group row">
        <label class="col-md-3"></label>
        <div class="col-md-9">
            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
        </div>
    </div>

<?= form_close(); ?>