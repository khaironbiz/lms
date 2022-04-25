<?php
    use App\Models\Materi_file_model;
?>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
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
            <img src="<?= base_url()?>/assets/upload/image/4_1.jpg">
            <div class="card-body">
                
            </div>
        </div>
    </div>
    
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
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
                    <tr>
                        <td><?= $num++; ?></td>
                        <td>
                            <?= $tgl_mulai ?><br>
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
                        <td><?= $nomor++; ?></td>
                        <td><?= $mf['id_materi_file']?><br></td>
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
</div>
<div class="row">
    <div class="col-4">
        <a href="<?= base_url()?>/admin/kelas/edit/<?= $kelas->has_kelas;?>" class="btn btn-sm btn-primary">Back</a>
    </div>
    <div class="col-4 text-center">
        
    </div>
    <div class="col-4 text-right">
        
    </div>
    
    
</div>
