<?php
use App\Models\Materi_model;
$m_materi           = new Materi_model();
?>
<div class="card">
    <img src="http://localhost/lms/assets/upload/image/<?= $berita['gambar']?>">
    <div class="card-header">
        <h4><?= $berita['judul_berita']?></h4>
        
    </div>
    <div class="card-body">
        <?= $berita['isi']?>
    </div>
    <div class="card-header">
        <b>Kegiatan</b>
    </div>
    <div class="card-body">
        <table class="table table-sm table-striped">
            <tr>
                <th>No</th>
                <th>Nama Kegiatan</th>
                <th>Tanggal</th>
                <th>SKP</th>
                <th>Harga Dasar</th>
                <th>Harga Jual</th>
                <th>Aksi</th>
            </tr>
            <?php
            $no = 1;
            foreach($kelas as $k){
            ?>
            <tr>
                <td><?= $no++?></td>
                <td><?= $k['nama_kelas'];?></td>
                <td><?= $k['tanggal_mulai'];?></td>
                <td><?= $k['nama_kelas'];?></td>
                <td><?= $k['harga_dasar'];?></td>
                <td><?= $k['harga_jual'];?></td>
                <td>
                    <a href="#" class="btn btn-sm btn-success">Edit</a>
                    <a href="#" class="btn btn-sm btn-danger">Delete</a>
                </td>
            </tr>
            <?php
            }
            ?>
        </table>
    </div>
    <div class="card-header">
        <b>Materi Kelas</b>
    </div>
    <div class="card-body">
        <table class="table table-sm table-striped">
            <tr>
                <th>No</th>
                <th>Jam</th>
                <th>Tema Pembelajaran</th>
                <th>Pemateri</th>
                <th>Bahan Pembelajaran</th>
                <th>Aksi</th>
            </tr>
            <?php
            $nomor=1;
            foreach($kelas as $kelas){
                $id_kelas   = $kelas['id_kelas'];
                $materi     = $m_materi->kelas($id_kelas);
            ?>
            <tr>
                <td><?= $nomor++?></td>
                <td colspan="4" class="text-primary"><b><?= $kelas['nama_kelas']?></b></td>
                <td>
                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-kelas-<?= $kelas['has_kelas']?>">
                        <i class="fa fa-plus"></i>
                    </button>
                    <?= form_open(base_url('admin/materi/add'));
                    echo csrf_field();
                    ?>
                    <div class="modal fade" id="modal-kelas-<?= $kelas['has_kelas']?>">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title"><?= $kelas['nama_kelas']?></h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                <div class="form-group row">
                                        <label class="col-3">Kelas</label>
                                        <div class="col-9 row">
                                        <select class="form-control form-control-sm" name="kelas">
                                            <option value="<?= $kelas['has_kelas']?>"><?= $kelas['nama_kelas']?></option>
                                        </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-3">Materi</label>
                                        <div class="col-9 row">
                                            <input type="text" name="materi" class="form-control form-control-sm" placeholder="Materi Pembelajaran"  required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-3">Pemateri</label>
                                        <div class="col-9 row">
                                        <select class="form-control form-control-sm" name="pemateri">
                                            <option>Pilih</option>
                                            <?php
                                            foreach($user as $u){
                                            ?>
                                            <option value="<?= $u['id_user']?>"><?= $u['nama']?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-3">Waktu</label>
                                        <div class="col-9 row">
                                            <input type="text" class="form-control form-control-sm tanggal col-sm-3 col-6" name="tanggal_mulai" >
                                            <input type="text" class="form-control form-control-sm jam col-sm-2 col-6" name="jam_mulai">
                                            <label class="col-sm-2">SD</label>
                                            <input type="text" class="form-control form-control-sm tanggal col-sm-3 col-6" name="tanggal_selesai">
                                            <input type="text" class="form-control form-control-sm jam col-sm-2 col-6" name="jam_selesai">
                                        </div>
                                    </div>
                                    <!-- <div class="form-group row">
                                        <label class="col-3">Harga Dasar</label>
                                        <div class="col-9 row">
                                            <input type="text" class="form-control form-control-sm col-sm-5 col-4" >
                                            <label class="col-sm-2 col-4">Harga Jual</label>
                                            <input type="text" class="form-control form-control-sm col-sm-5 col-4">
                                        </div>
                                    </div> -->
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
                    
                </td>
            </tr>
            <?php
            foreach($materi as $m){
                $mulai = strtotime($m['waktu_mulai']);
                $selesai = strtotime($m['waktu_selesai']);
            ?>
            <tr>
                <td></td>
                <td><?= date('H:i',$mulai)?> - <?= date('H:i',$selesai)?></td>
                <td><?= $m['materi']?></td>
                <td><?= $m['nama']?></td>
                <td></td>
                <td>
                    <button type="button" class="btn btn-sm btn-success mt-2" data-toggle="modal" data-target="#modal-<?= $m['has_materi']?>">
                        <i class="fa fa-edit"></i>
                    </button>
                    <?= form_open(base_url('admin/materi/update/'."/".$m['has_materi']));
                    echo csrf_field();
                    ?>
                    <div class="modal fade" id="modal-<?= $m['has_materi']?>">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Update Materi</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group row">
                                        <label class="col-3">Materi</label>
                                        <div class="col-9 row">
                                            <input type="text" class="form-control form-control-sm" value="<?= $m['materi']?>" required name="materi">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-3">Pemateri</label>
                                        <div class="col-9 row">
                                            <select class="form-control form-control-sm" name="pemateri">
                                                <option value="<?= $m['pemateri']?>"><?= $m['nama']?></option>
                                                <?php
                                                foreach($user as $u){
                                                ?>
                                                <option value="<?= $u['id_user']?>"><?= $u['nama']?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3">Waktu</label>
                                        <div class="col-md-9 row">
                                            <input type="text" class="form-control form-control-sm tanggal col-sm-3" value="<?= date('d-m-Y', $mulai)?>" name="tanggal_mulai">
                                            <input type="text" class="form-control form-control-sm jam col-sm-2" value="<?= date('H:i', $mulai)?>" name="jam_mulai">
                                            <label class="col-sm-2">SD</label>
                                            <input type="text" class="form-control form-control-sm tanggal col-sm-3" value="<?= date('d-m-Y', $selesai)?>" name="tanggal_selesai">
                                            <input type="text" class="form-control form-control-sm jam col-sm-2" value="<?= date('H:i', $selesai)?>" name="jam_selesai">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3">Blokir</label>
                                        <div class="col-md-9 row">
                                            <select class="form-control form-control-sm" name="blokir">
                                                <option value="0">Tidak</option>
                                                <option value="1">Ya</option>
                                            </select>
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
                    
                </td>
            </tr>
            <?php
            }
            ?>
            <?php
            }
            ?>
        </table>
    </div>
</div>