<?php
use App\Models\Materi_file_model;
$tanggal_mulai      = $kelas->tanggal_mulai;
$tanggal_selesai    = $kelas->tanggal_selesai;
echo view('admin/sub_menu/kelas');
?>

<div class="row mt-2">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-dark">
                <div class="row">
                    <div class="col-md-9">
                        <b><?= $kelas->nama_kelas;?></b>
                    </div>
                    <div class="col-md-3 text-right">
                        <a href="<?= base_url()?>/admin/kelas/edit/<?= $kelas->has_kelas;?>" class="btn btn-sm btn-success">Edit</a>
                        <a href="#" class="btn btn-sm btn-danger">Delete</a>
                    </div>
                </div>

            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <label class="col-md-5">Tanggal Kegiatan</label>
                            <div class="col-md-7"> :
                                <?php if($tanggal_mulai == $tanggal_selesai){ echo $tanggal_mulai; }else{ echo $tanggal_mulai." sd ". $tanggal_selesai;} ;?>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-md-5">Harga Dasar</label>
                            <div class="col-md-7"> :
                                <?= number_format($kelas->harga_dasar);?>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-md-5">Harga Jual</label>
                            <div class="col-md-7"> :
                                <?= number_format($kelas->harga_jual);?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <label class="col-md-5">Kuota</label>
                            <div class="col-md-7"> :
                                <?= number_format($kelas->kuota);?>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-md-5">Pendaftar</label>
                            <div class="col-md-7"> :
                                <?= number_format($count_peserta);?>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-md-5">Sisa</label>
                            <div class="col-md-7"> :
                                <?= number_format(($kelas->kuota)-$count_peserta);?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <b>Tugas </b>
            </div>
            <div class="card-body">
                <button type="button" class="btn btn-sm btn-primary mb-2" data-toggle="modal" data-target="#add-tugas">
                    <i class="fa fa-plus"> Tugas</i>
                </button>
                <?= form_open(base_url('admin/tugas_kelas/create_tugas_kelas/'.$kelas->has_kelas));
                echo csrf_field();
                ?>
                <div class="modal fade text-dark text-left" id="add-tugas">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Tambah Tugas</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <label class="col-3">Kelas</label>
                                    <div class="col-9">
                                        <select class="form-control form-control-sm" name="kelas">
                                            <option value=""><?= $kelas->nama_kelas; ?></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-3">Jenis Tugas</label>
                                    <div class="col-9">
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
                                <div class="row">
                                    <label class="col-3">Metode</label>
                                    <div class="col-9">
                                        <select class="form-control form-control-sm" name="id_metode">
                                            <?php
                                            foreach ($tugas_metode as $tm):
                                                ?>
                                                <option value="<?= $tm['id_tugas_metode']?>"><?= $tm['nama_metode']?></option>
                                            <?php
                                            endforeach;
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-3">Waktu Mulai</label>
                                    <div class="col-5">
                                        <input type="text" class="form-control form-control-sm tanggal" name="tgl_start" placeholder="tanggal mulai">
                                    </div>
                                    <div class="col-4">
                                        <input type="text" class="form-control form-control-sm jam" name="jam_start" placeholder="jam mulai">
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-3">Waktu Selesai</label>
                                    <div class="col-5">
                                        <input type="text" class="form-control form-control-sm tanggal" name="tgl_finish" placeholder="tanggal selesai">
                                    </div>
                                    <div class="col-4">
                                        <input type="text" class="form-control form-control-sm jam" name="jam_finish" placeholder="jam selesai">
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-3">Keterangangan</label>
                                    <div class="col-9">
                                        <textarea class="form-control" name="keterangan"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
                            </div>
                        </div>

                    </div>

                </div>
                <?= form_close(); ?>
                <div class="row">
                    <?php
                    $b=1;
                    foreach ($tugas_kelas as $tk):
                        ?>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header"><?= $tk['nama_tugas']?></div>
                            <div class="card-body">
                                <div class="row">
                                    <label class="col-sm-4">Jam Mulai</label>
                                    <div class="col-sm-8"><?= date('Y-m-d H:i:s', $tk['time_start'])?></div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-4">Jam Selesai</label>
                                    <div class="col-sm-8"><?= date('Y-m-d H:i:s', $tk['time_finish'])?></div>
                                </div>

                            </div>
                            <div class="card-footer"><a href="<?= base_url('admin/tugas_kelas/detail/'.$tk['has_tugas_kelas'])?>" class="btn btn-sm btn-info" target="_blank">Detail</a></div>

                        </div>
                    </div>

                    <?php
                    endforeach;
                    ?>

                </div>
            </div>


        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <img src="<?= base_url()?>/assets/upload/image/<?= $kelas->poster?>">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-4">
        <a href="<?= base_url()?>/admin/event/detail/<?= $berita['has_berita'];?>" class="btn btn-sm btn-primary">Back</a>
    </div>

</div>
