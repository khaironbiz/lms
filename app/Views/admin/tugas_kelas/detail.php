<?php
echo view('admin/sub_menu/tugas');
?>
    <div class="row mt-3">
        <div class="col-md-5">
            <div class="row">
                <label class="col-md-3">Kelas</label>
                <div class="col-md-9"><?= $tugas_kelas['nama_kelas']?></div>
            </div>
            <div class="row">
                <label class="col-md-3">Jenis Tugas</label>
                <div class="col-md-9"><?= $tugas_kelas['nama_tugas']?></div>
            </div>
            <div class="row">
                <label class="col-md-3">Metode</label>
                <div class="col-md-9"><?= $tugas_kelas['nama_metode']?></div>
            </div>
            <div class="row">
                <label class="col-md-3">Waktu Mulai</label>
                <div class="col-md-9"><?= date('d-m-Y', $tugas_kelas['time_start'])?> <?= date('H:i:s', $tugas_kelas['time_start'])?></div>
            </div>
            <div class="row">
                <label class="col-md-3">Waktu Selesai</label>
                <div class="col-md-9"><?= date('d-m-Y', $tugas_kelas['time_finish'])?> <?= date('H:i:s', $tugas_kelas['time_finish'])?></div>
            </div>

            <div class="row form-group">
                <label class="col-md-3">Keterangan</label>
                <div class="col-md-9"><?= $tugas_kelas['keterangan']?></div>

            </div>
            <div class="form-group row">
                <label class="col-md-3"><a href="<?= base_url('/admin/tugas_kelas')?>" class="btn btn-danger">Back</a></label>
            </div>
        </div>
        <div class="col-md-7">
            <div class="card">
                <div class="card-header"><b>Soal</b></div>
                <div class="card-body">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default">
                        <i class="fa fa-plus"></i> Tambah Baru <?= $tugas_kelas['id_tugas_kelas']?>
                    </button>
                    <?= form_open(base_url('admin/soal/create_soal/'.$tugas_kelas['has_tugas_kelas']));
                    echo csrf_field();
                    ?>
                    <div class="modal fade" id="modal-default">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Tambah Baru</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <div class="row">
                                        <label class="col-md-2">Soal</label>
                                        <div class="col-md-12">
                                            <textarea class="form-control" name="soal" required></textarea>
                                        </div>
                                    </div>


                                    <div class="row mt-1">
                                        <label class="col-md-3">Jawaban</label>
                                    </div>
                                    <div class="row mt-1">
                                        <label class="col-1 text-right">a</label>
                                        <div class="col-md-11">
                                            <input type="text" name="a" class="form-control" placeholder="Jawaban A" value="<?= set_value('a') ?>" required>
                                        </div>
                                    </div>
                                    <div class="row mt-1">
                                        <label class="col-1 text-right">b</label>
                                        <div class="col-md-11">
                                            <input type="text" name="b" class="form-control" placeholder="Jawaban B" value="<?= set_value('b') ?>" required>
                                        </div>
                                    </div>
                                    <div class="row mt-1">
                                        <label class="col-1 text-right">c</label>
                                        <div class="col-md-11">
                                            <input type="text" name="c" class="form-control" placeholder="Jawaban C" value="<?= set_value('c') ?>" required>
                                        </div>
                                    </div>
                                    <div class="row mt-1">
                                        <label class="col-1 text-right">d</label>
                                        <div class="col-md-11">
                                            <input type="text" name="d" class="form-control" placeholder="Jawaban D" value="<?= set_value('d') ?>" required>
                                        </div>
                                    </div>
                                    <div class="row mt-1">
                                        <label class="col-1 text-right">e</label>
                                        <div class="col-md-11">
                                            <input type="text" name="e" class="form-control" placeholder="Jawaban E" value="<?= set_value('e') ?>" required>
                                        </div>
                                    </div>


                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <!-- /.modal -->
                    <?= form_close(); ?>
                </div>
                <div class="card-footer"></div>
            </div>
        </div>
    </div>