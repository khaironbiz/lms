<?php 

$session = \Config\Services::session();
?>
<main id="main">
  <!-- ======= Breadcrumbs Section ======= -->
  <section class="breadcrumbs">
    <div class="container">
      <div class="d-flex justify-content-between align-items-center">
        <h2><?= $title ?></h2>
      </div>
    </div>
  </section><!-- End Breadcrumbs Section -->

  <!-- ======= Contact Section ======= -->
  <section id="contact" class="contact">
    <div class="container">
      <div class="row">
        <div class="col-md-8">
          <div class="card">
            <img src="<?= base_url('assets/upload/image/' . $berita['gambar']) ?>">
            <div class="card-body">
              <h4><?= $berita['judul_berita'] ?></h4>
                <?= $berita['isi'] ?>
            </div>
          </div>
          <?php
          if($berita['jenis_berita']=="Event"){
          ?>
          <!-- kelas --->
          <div class="card mt-3">
            <div class="card-header"><b>Kelas</b> <?= $id_user; ?></div>
            <div class="card-body">
              <table class="table table-sm">
                <tr>
                  <th>No</th>
                  <th>Kegiatan</th>
                  <th>Harga</th>
                  <th>Aksi</th>
                </tr>
                <?php
                $no = 1;
                foreach($kelas as $k){
                  
                ?>
                
                <tr>
                  <td><?= $no++; ?></td>
                  <td><?= $k['nama_kelas']?></td>
                  <td><?= number_format($k['harga_jual'])?></td>
                  <td>
                    <a href="<?= base_url('berita/kelas/'.$k['has_kelas'])?>" class="btn btn-sm btn-success">Detail</a>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary btn-sm " data-bs-toggle="modal" data-bs-target="#daftar<?= $k['has_kelas']?>">
                      Daftar
                    </button>
                    <!-- Modal -->
                    <?php
                      if($id_user>0){
                        echo form_open(base_url('admin/kelas_peserta/create/'.$k['has_kelas']));
                        echo csrf_field();
                      }else{
                    ?>
                    <?= form_open(base_url('admin/kelas_peserta/daftar_tamu/'.$k['has_kelas']));
                    echo csrf_field();
                      }
                    ?>
                    <div class="modal fade" id="daftar<?= $k['has_kelas']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Pendaftaran Kegiatan <?= $berita['id_berita']?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <div class="row mb-1">
                                <label for="staticEmail" class="col-md-3">Kelas</label>
                                <div class="col-md-9">
                                  <select class="form-control form-control-sm" name="id_kelas">
                                    <option value="<?= $k['id_kelas']?>"><?= $k['nama_kelas']?></option>
                                  </select>
                                </div>
                              </div>
                              <div class="row mb-1">
                                <label for="staticEmail" class="col-md-3">Email</label>
                                <div class="col-md-9">
                                  <input type="text" class="form-control form-control-sm" name="email_peserta">
                                </div>
                              </div>
                              <div class="row mb-1">
                                <label for="inputPassword" class="col-md-3">No HP</label>
                                <div class="col-md-9">
                                  <input type="telp" class="form-control form-control-sm" name="hp_peserta">
                                </div>
                              </div>
                              <div class="row mb-1">
                                <label for="inputPassword" class="col-md-3">Nama di Sertifikat</label>
                                <div class="col-md-9">
                                  <input type="telp" class="form-control form-control-sm" name="nama_sertifikat">
                                </div>
                              </div>
                              <?php
                                if($id_user>0){
                              ?>
                              <div class="row mb-1">
                                <label for="inputPassword" class="col-md-3">Harga Member</label>
                                <div class="col-md-9">
                                  <input type="number" class="form-control form-control-sm" name="harga" value="<?= $k['harga_jual']; ?>">
                                </div>
                              </div>
                              <?php
                                }else{
                              ?>
                              <div class="row mb-1">
                                <label for="inputPassword" class="col-md-3">Harga Non Member</label>
                                <div class="col-md-9">
                                  <input type="number" class="form-control form-control-sm" name="harga" value="<?php if($k['harga_jual']<1){echo "10000";}else{ echo ($k['harga_jual']*1.1); } ?>">
                                </div>
                              </div>
                              <?php
                                }
                              ?>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-default btn-sm">Save</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?= form_close(); ?>
                    
                  </td>
                  
                </tr>
              <?php
              }
              ?>
              </table>
            </div>
          </div>
          
          <?php
          }
          ?>
          
        </div>
        <div class="col-md-4">
          <div class="card">
            <div class="card-header bg-white">
              <h4>Berita Lainnya</h4>
            </div>
            <div class="card-body">
              <?php foreach ($sidebar as $sidebar) { ?>
                <div class="row">
                  <label class="col-10"><?= $sidebar['judul_berita']?></label>
                  <div class="col-2">
                  <?= $sidebar['hits']?>
                  </div>
                </div>
              <?php
              }
              ?>
              
            </div>
          </div>
        </div>
      </div>
    </div>
  </section><!-- End Contact Section -->
</main><!-- End #main -->




  
  