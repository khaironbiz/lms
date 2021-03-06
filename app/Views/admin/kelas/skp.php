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
            <div class="card-header">
                <b>Akreditasi Profesi</b>
            </div>
            <div class="card-body table-responsive">
                <button type="button" class="btn btn-sm btn-primary mb-2" data-toggle="modal" data-target="#add-akreditasi">
                    <i class="fa fa-plus"> SKP</i>
                </button>
                <?= form_open(base_url('admin/akreditasi_profesi/create/'.$kelas->has_kelas));
                echo csrf_field();
                ?>
                <div class="modal fade text-dark text-left" id="add-akreditasi">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Akreditasi Kegiatan : <?= $kelas->nama_kelas?></h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <label class="col-3">Organisasi Profesi</label>
                                    <div class="col-9 row">
                                        <select class="form-control form-control-sm" name="id_op">
                                            <option value="">---pilih---</option>
                                            <?php
                                            foreach($op as $op):
                                                ?>
                                                <option value="<?= $op['id_op']?>"><?= $op['nama_op']?></option>
                                            <?php
                                            endforeach
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-3">Level Organisasi</label>
                                    <div class="col-9 row">
                                        <select class="form-control form-control-sm" name="level_op">
                                            <option value="">---pilih---</option>
                                            <option value="1">Pusat</option>
                                            <option value="2">Provinsi</option>
                                            <option value="3">Kota</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-3">Besaran SKP</label>
                                    <div class="col-9 row">
                                        <input type="number" class="form-control form-control-sm" name="nominal_skp">
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-3">Nomor SKP</label>
                                    <div class="col-9 row">
                                        <input type="text" class="form-control form-control-sm" name="nomor_skp">
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-3">Tanggal SKP</label>
                                    <div class="col-9 row">
                                        <input type="date" class="form-control form-control-sm" name="tanggal_skp">
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-3">Keterangangan</label>
                                    <div class="col-9 row">
                                        <input type="text" class="form-control form-control-sm" name="keterangan">
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
                <table class="table table-sm table-stiped">
                    <tr>
                        <th>#</th>
                        <th>Organisasi</th>
                        <th>SKP</th>
                        <th>Keterangan</th>
                    </tr>
                    <?php
                    $num = 1;
                    foreach($ap as $ap):
                        ?>
                        <tr>
                            <td><?= $num++;?></td>
                            <td><?= $ap['singkatan_op']; if($ap['level_op']==1){echo " - Pusat";}elseif($ap['level_op']==2){echo " - Provinsi";}elseif($ap['level_op']==3){echo " - Kota";} ?></td>
                            <td><?= $ap['nominal_skp']?></td>
                            <td><?= $ap['keterangan']?></td>
                        </tr>
                    <?php
                    endforeach
                    ?>
                </table>
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
    <div class="col-4 text-center">

    </div>
    <div class="col-4 text-right">

    </div>


</div>
