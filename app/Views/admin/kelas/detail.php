<?php
    use App\Models\Materi_file_model;
    $tanggal_mulai      = $kelas->tanggal_mulai;
    $tanggal_selesai    = $kelas->tanggal_selesai;
?>

<div class="row">
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
            <div class="card-header bg-dark">
                <div class="row">
                    <div class="col-6">
                        <b>Materi</b>
                    </div>
                    <div class="col-6 text-right">
                        <button type="button" class="btn btn-sm btn-primary mb-2" data-toggle="modal" data-target="#modal-kelas-<?= $kelas->has_kelas; ?>">
                            <i class="fa fa-plus"> Materi</i>
                        </button>
                        <?= form_open(base_url('admin/materi/add'));
                            echo csrf_field();
                        ?>
                        <div class="modal fade text-dark text-left" id="modal-kelas-<?= $kelas->has_kelas; ?>">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title"><?= $kelas->nama_kelas?></h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                    <div class="form-group row">
                                            <label class="col-3">Kelas</label>
                                            <div class="col-9 row">
                                            <select class="form-control form-control-sm" name="kelas">
                                                <option value="<?= $kelas->has_kelas?>"><?= $kelas->nama_kelas?></option>
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
                                                <input type="text" class="form-control form-control-sm tanggal col-md-3 col-6" name="tanggal_mulai" >
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
                    </div>
                </div>
                        
            </div>
            <div class="card-body">
                <table class="table table-sm table-striped">
                    <tr>
                        <th>#</th>
                        <th>Jam</th>
                        <th>Materi</th>
                        <th>Aksi</th>
                    </tr>
                    <?php
                    $num = 1; 
                    foreach($materi as $materi) : 
                        $waktu_mulai    = $materi['waktu_mulai'];
                        $waktu_selesai  = $materi['waktu_selesai'];
                        $detik_mulai    = strtotime($waktu_mulai);
                        $detik_selesai  = strtotime($waktu_selesai);
                        $tgl_mulai      = date('Y-m-d', $detik_mulai);
                        $jam_mulai      = date('H:i', $detik_mulai);
                        $tgl_selesai    = date('Y-m-d', $detik_selesai);
                        $jam_selesai    = date('H:i', $detik_selesai);
                        $durasi         = $detik_selesai-$detik_mulai;
                        $detik_hari     = 60*60*24;
                        //materi file
                        $id_materi      = $materi['id_materi'];
                        $m_materi_file  = new Materi_file_model();
                        $materi_file    = $m_materi_file->list_by_id_materi($id_materi);
                    ?>
                    <tr <?php if( $materi['blokir'] ==1){echo "class='bg-danger'";}?>>
                        <td><?= $num++; ?></td>
                        <td class="w-25">
                            <?= date('F, d', $detik_mulai) ?><br>
                            <?= $jam_mulai; ?> - <?= $jam_selesai?><br>
                        </td>
                        <td>
                            <?= $materi['materi']?><br>
                            <b><?= $materi['nama']?></b>
                        </td>
                        <td>
                            <a href="<?= base_url()?>/admin/materi/detail/<?= $materi['has_materi']?>" class="btn btn-sm btn-info">Detail</a>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <div class="row">
                                <div class="col-6">
                                    <b>Bahan Ajar</b>
                                </div>
                                <div class="col-6 text-right">
                                </div>
                            </div>
                        </td>
                        
                    </tr>
                    <?php
                    $nomor = 1;
                    foreach($materi_file as $mf) :
                    ?>
                    
                    <tr>
                        <td></td>
                        <td colspan="3"><?= $mf['judul_file']?><br></td>
                    </tr>
                    
                    <?php
                    endforeach
                    ?>
                    <?php
                    endforeach
                    ?>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <b>Akreditasi Profesi</b>
            </div>
            <img src="<?= base_url()?>/assets/upload/image/<?= $kelas->poster?>">
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
            <?php
            if($count_tugas>0){
            ?>
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
                <table class="table table-sm">
                    <tr>
                        <th>#</th>
                        <th>Tugas</th>
                        <th>Aksi</th>
                    </tr>
                    <?php
                    $b=1;
                    foreach ($tugas_kelas as $tk):
                    ?>
                    <tr>
                        <td><?= $b++; ?></td>
                        <td><?= $tk['nama_tugas']?></td>
                        <td><a href="#" class="btn btn-sm btn-info">Detail</a></td>
                    </tr>
                    <?php
                    endforeach;
                    ?>

                </table>
            </div>
            <?php
            }
            ?>
            <div class="card-footer">
                <b>Peserta : <?= $count_peserta?></b>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-sm table-bordered" id="example3">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $number = 1;
                            foreach($kelas_peserta as $peserta):
                        ?>
                        <tr>
                            <td><?= $number++?></td>
                            <td>
                                <?= $peserta['nama_sertifikat']?><br>
                                <?= $peserta['hp_peserta']?>
                            </td>
                            
                        </tr>
                        <?php
                            endforeach
                        ?>
                    </tbody>
                </table>
            </div>
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
