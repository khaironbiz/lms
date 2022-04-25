<?php
use App\Models\Materi_model;
$m_materi           = new Materi_model();
echo view($sub_menu)

?>

<div class="card ">
    <div class="card-header">
        <b><?= $berita['judul_berita']?></b>
    </div>
    <div class="card-body row">
        
        
        <div class="col-xl-8">
            
            <?= $berita['isi']?>
        </div>

        <div class="col-xl-4 table-responsive">
            <img src="http://localhost/lms/assets/upload/image/<?= $berita['gambar']?>" class="img-fluid">
            <hr>
            
            <button type="button" class="btn btn-success btn-sm mb-2" data-toggle="modal" data-target="#modal-default<?= $berita['id_berita'] ?>">
			<i class="fa fa-plus"></i> Add Kelas
            </button>
            <?= form_open(base_url('admin/kelas/add_kelas/'.$berita['has_berita']));
                echo csrf_field();
            ?>
                <div class="modal fade" id="modal-default<?= $berita['id_berita'] ?>">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Tambah Kelas</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group row">
                                    <label class="col-2">Event</label>
                                    <div class="col-10">
                                        <input type="text" name="judul_berita" class="form-control" value="<?= $berita['judul_berita'] ?>" readonly>
                                        <input type="hidden" name="id_event" class="form-control" value="<?= $berita['id_berita'] ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-2">Kelas</label>
                                    <div class="col-10">
                                        <input type="text" name="nama_kelas" class="form-control form-control-sm" placeholder="Nama Kegiatan" value="<?= set_value('nama_kelas') ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2">Tanggal Mulai</label>
                                    <div class="col-md-4">
                                        <input type="text" name="tanggal_mulai" class="form-control form-control-sm tanggal" value="<?= set_value('tanggal_mulai') ?>" required>
                                    </div>
                                    <label class="col-2">Tanggal Selesai</label>
                                    <div class="col-md-4">
                                        <input type="text" name="tanggal_selesai" class="form-control form-control-sm tanggal" value="<?= set_value('tanggal_selesai') ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2">Harga Dasar</label>
                                    <div class="col-md-4">
                                        <input type="number" name="harga_dasar" class="form-control form-control-sm" placeholder="Harga Dasar" value="<?= set_value('harga_dasar') ?>" required>
                                    </div>
                                    <label class="col-2">Harga Jual</label>
                                    <div class="col-md-4">
                                        <input type="number" name="harga_jual" class="form-control form-control-sm" placeholder="Harga Jual" value="<?= set_value('harga_jual') ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2">Kategori</label>
                                    <div class="col-md-4">
                                        <select class="form-control form-control-sm" name="kategori_kelas" riquired>
                                            <option value=''>Pilih</option>
                                            <?php foreach($kategori_kelas as $k){?>
                                            <option value='<?= $k['id_kategori_kelas']?>'><?= $k['kategori_kelas']?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <label class="col-md-2">Status</label>
                                    <div class="col-md-4">
                                        <select class="form-control form-control-sm" required name="status">
                                            <option value="1">Publish</option>
                                            <option value="0">Draft</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2">Kuota</label>
                                    <div class="col-md-4">
                                        <input type="number" name="kuota" class="form-control form-control-sm" placeholder="Kuota" value="<?= set_value('kuota') ?>" required>
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
            <b>Kelas</b>
            <table class="table table-sm table-striped">
                <tr>
                    <th>No</th>
                    <th>Nama Kelas</th>
                    <th>Harga Jual</th>
                    <th>Aksi</th>
                </tr>
                <?php
                $no = 1;
                foreach($kelas as $k){
                ?>
                <tr>
                    <td><?= $no++?></td>
                    <td><?= $k['nama_kelas'];?><br><?= $k['tanggal_mulai'];?></td>
                    <td>
                        H. Dasar : <?= number_format($k['harga_dasar'],0,",",".");?><br>
                        H. Jual : <?= number_format($k['harga_jual'],0,",",".");?>
                    </td>
                    
                    <td>
                        
                        <a href="<?= base_url()?>/admin/kelas/detail/<?= $k['has_kelas']?>" class="btn btn-sm btn-primary">Detail</a>
                        
                    </td>
                </tr>
                <?php
                }
                ?>
            </table>
        </div>
    
    </div>
    
    <div class="card-header">
        <b>Materi Kelas</b>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-sm table-striped">
            <tr>
                <th>No</th>
                <th>Jam</th>
                <th>Tema</th>
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
                <td colspan="2" class="text-primary"><b><?= $kelas['nama_kelas']?></b></td>
                <td>
                    
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
                <td>
                    <?= $m['materi']?><br>
                    Oleh : <b><?= $m['nama']?></b><br>
                </td>
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
    <div class="card-footer row">
        <div class="col-6">
            <a href="<?= base_url('admin/event/delete/' . $berita['id_berita']) ?>" class="btn btn-danger btn-sm mt-1" onclick="confirmation(event)"><i class="fa fa-trash"></i></a>
		
        </div>
        <div class="col-6 text-right">
            <a href="<?= base_url('admin/event/edit/' . $berita['id_berita']) ?>" class="btn btn-success btn-sm mt-1"><i class="fa fa-edit"></i></a>
        
        </div>
        	
    </div>
</div>