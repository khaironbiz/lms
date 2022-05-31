<?php
echo view('admin/sub_menu/tugas');
?>

<?= form_open(base_url('admin/tugas_kelas/update/'.$tugas_kelas['has_tugas_kelas']));
echo csrf_field();
?>
    <div class="row mt-3">
        <div class="col-md-6">
            <div class="row form-group">
                <label class="col-md-3">Kelas</label>
                <div class="col-md-9">
                    <select class="form-control form-control-sm" name="id_kelas" required>

                        <?php
                        foreach ($kelas as $kelas) :
                            ?>
                            <option value="<?= $kelas['id_kelas']?>"
                                <?php
                                if($kelas['id_kelas'] === $tugas_kelas['id_kelas']){echo "selected";}
                                ?>
                            ><?= $kelas['nama_kelas']?></option>
                        <?php
                        endforeach;
                        ?>
                    </select>
                </div>
            </div>
            <div class="row form-group">
                <label class="col-md-3">Jenis Tugas</label>
                <div class="col-md-9">
                    <select class="form-control form-control-sm" name="id_tugas" required>

                        <?php
                        foreach ($tugas as $tugas):
                            ?>
                            <option value="<?= $tugas['id_tugas']?>"
                                <?php
                                if($tugas['id_tugas'] === $tugas_kelas['id_tugas']){echo "selected";}
                                ?>
                            ><?= $tugas['nama_tugas']?></option>
                        <?php
                        endforeach;
                        ?>
                    </select>
                </div>
            </div>
            <div class="row form-group">
                <label class="col-md-3">Metode</label>
                <div class="col-md-9">
                    <select class="form-control form-control-sm" name="id_metode" required>

                        <?php
                        foreach ($tugas_metode as $tm):
                        ?>
                            <option value="<?= $tm['id_tugas_metode']?>"
                                <?php
                                if($tm['id_tugas_metode'] === $tugas_kelas['id_metode']){echo "selected";}
                                ?>
                            ><?= $tm['nama_metode']?></option>
                            <?php
                        endforeach;
                            ?>
                    </select>
                </div>
            </div>
            <div class="row form-group">
                <label class="col-md-3">Waktu Mulai</label>
                <div class="col-md-5">
                    <input type="text" class="form-control form-control-sm tanggal" name="tgl_start" value="<?= date('d-m-Y', $tugas_kelas['time_start'])?>">
                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control form-control-sm jam" name="jam_start" placeholder="JJ:MM:DD" value="<?= date('H:i:s', $tugas_kelas['time_start'])?>">
                </div>
            </div>
            <div class="row form-group">
                <label class="col-md-3">Waktu Selesai</label>
                <div class="col-md-5">
                    <input type="text" class="form-control form-control-sm tanggal" name="tgl_finish" value="<?= date('d-m-Y', $tugas_kelas['time_finish'])?>">
                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control form-control-sm jam" name="jam_finish" placeholder="JJ:MM:DD" value="<?= date('H:i:s', $tugas_kelas['time_finish'])?>">
                </div>
            </div>
            <div class="row form-group">
                <label class="col-md-3">Keterangan</label>
                <div class="col-md-9">
                    <textarea name="keterangan" class="form-control"><?= $tugas_kelas['keterangan']?></textarea>

                </div>

            </div>
            <div class="form-group row">
                <label class="col-md-3"><a href="<?= base_url('/admin/tugas_kelas')?>" class="btn btn-danger">Back</a></label>
                <div class="col-md-9 text-right">
                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
                </div>
            </div>
        </div>
    </div>
<?= form_close(); ?>