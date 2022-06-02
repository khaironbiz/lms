<?php
use App\Models\Soal_jawaban_model;
echo view('admin/sub_menu/tugas');
?>
    <div class="row mt-3">
        <div class="col-md-7">
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
                <div class="col-md-9"><?= $tugas_kelas['nama_metode']?> <?= $tugas_kelas['id_metode']?></div>
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

        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6"><b>Soal</b></div>
                        <div class="col-6 text-right">
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-default">
                                <i class="fa fa-plus"></i> Tambah Soal
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">

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
                                            <input type="text" name="jawaban[]" class="form-control" placeholder="Jawaban A" value="<?= set_value('a') ?>" required>
                                        </div>
                                    </div>
                                    <div class="row mt-1">
                                        <label class="col-1 text-right">b</label>
                                        <div class="col-md-11">
                                            <input type="text" name="jawaban[]" class="form-control" placeholder="Jawaban B" value="<?= set_value('b') ?>" required>
                                        </div>
                                    </div>
                                    <div class="row mt-1">
                                        <label class="col-1 text-right">c</label>
                                        <div class="col-md-11">
                                            <input type="text" name="jawaban[]" class="form-control" placeholder="Jawaban C" value="<?= set_value('c') ?>" required>
                                        </div>
                                    </div>
                                    <div class="row mt-1">
                                        <label class="col-1 text-right">d</label>
                                        <div class="col-md-11">
                                            <input type="text" name="jawaban[]" class="form-control" placeholder="Jawaban D" value="<?= set_value('d') ?>" required>
                                        </div>
                                    </div>
                                    <div class="row mt-1">
                                        <label class="col-1 text-right">e</label>
                                        <div class="col-md-11">
                                            <input type="text" name="jawaban[]" class="form-control" placeholder="Jawaban E" value="<?= set_value('e') ?>" required>
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
                        <?php
                        foreach ($soal as $soal){
                            $id_soal = $soal['id_soal'];
                            ?>
                            <div class="card mt-2">
                                <div class="card-header"><?= "<b>".$soal['soal']."</b><br>";?></div>
                                <div class="card-body">
                                    <?php
                                    $m_soal_jawaban = new Soal_jawaban_model();
                                    $soal_jawaban   = $m_soal_jawaban->list_id_soal($id_soal);
                                    $count_jawaban  = $m_soal_jawaban->count_id_soal($id_soal);
                                    if($count_jawaban>0){
                                        foreach ($soal_jawaban as $jawaban ){ ?>
                                            <a href="<?= base_url('admin/soal_jawaban/edit/'.$jawaban['has_soal_jawaban'])?>" class="btn btn-sm <?php if($jawaban['id_soal_jawaban'] == $soal['id_jawaban']){ echo "btn-warning";}else{echo "btn-secondary";}?>"><?= $jawaban['jawaban']?></a>
                                    <?php
                                        }
                                    }
                                    ?>
                                </div>
                                <?php if($soal['id_jawaban']<1){?>
                                <div class="card-footer"><a href="<?= base_url('admin/soal/edit/'.$soal['has_soal'])?>" class="btn btn-sm btn-danger"> Tentukan Jawaban</a></div>
                                <?php
                                }else{
                                ?>
                                    <div class="card-footer"><a href="<?= base_url('admin/soal/edit/'.$soal['has_soal'])?>" class="btn btn-sm btn-success"> Edit Jawaban</a></div>
                                <?php
                                }
                                ?>

                            </div>
                    <?php


                        }
                        ?>
                </div>

            </div>
        </div>
    </div>