<?php
echo view('admin/sub_menu/tugas')
?>
<?= form_open(base_url('admin/soal/update/' . $soal['has_soal']));
echo csrf_field();
?>
    <div class="row form-group mt-5">
        <label class="col-md-3">SOAL</label>
        <div class="col-md-9">
            <textarea name="soal" class="form-control"><?= $soal['soal'] ?></textarea>
        </div>
    </div>
    <div class="row form-group">
        <label class="col-md-3">Jawaban</label>
        <div class="col-md-9">
            <?php
            foreach ($soal_jawaban as $jawaban):
            ?>
            <input type="radio" name="id_jawaban" value="<?= $jawaban['id_soal_jawaban']?>" <?php if($jawaban['id_soal_jawaban'] == $soal['id_jawaban']){ echo "checked";}?>> <?= $jawaban['jawaban']?>
                <button class="btn btn-sm btn-success mt-1">Edit</button>
                <br>
                <?php
            endforeach;
                ?>
        </div>
    </div>


    <div class="form-group row">
        <label class="col-md-3"></label>
        <div class="col-md-9">
            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
        </div>
    </div>

<?= form_close(); ?>