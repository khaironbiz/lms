<?php
use App\Models\Kelas_model;
echo view($sub_menu)
?>
<p>
	<a href="<?= base_url('admin/event/tambah_kelas') ?>" class="btn btn-success mt-2">
		<i class="fa fa-plus"></i> Tambah Baru
	</a>
</p>
<div class="table-responsive">

<table class="table table-bordered" id="example1">
	<thead>
		<tr>
			<th>No</th>
			<th>Gambar</th>
			<th>Judul</th>
			<th>Kelas</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		$no 		= 1;
		$m_kelas    = new Kelas_model();
		foreach ($berita as $berita) { 
			$id_event   = $berita['id_berita'];
			$kelas      = $m_kelas->event($id_event);
		?>
		<tr>
			<td><?= $no ?></td>
			<td>
				<?php 
				if ($berita['gambar'] === ''){
					echo '-';
					}else{ ?>
					<img src="<?= base_url('assets/upload/image/thumbs/' . $berita['gambar']) ?>" class="img img-thumbnail">
				<?php 
				} 
				?>
			</td>
			<td>
				<?= $berita['judul_berita'] ?>
				<small>
					<br><i class="fa fa-eye"></i> Hits: <?= $berita['hits'] ?>
					<br><i class="fa fa-calendar-check"></i> Publish: <?= tanggal_bulan_menit($berita['tanggal_publish']) ?>
					<br><i class="fa fa-calendar"></i> Updated: <?= tanggal_bulan_menit($berita['tanggal']) ?>
					<br><i class="fa fa-user"></i> <a href="<?= base_url('admin/berita/author/' . $berita['id_user']) ?>"><?= $berita['nama'] ?></a>
				</small>
			</td>
			<td>
				<small>
					<?php
						foreach($kelas as $kelas){
					?>
					<?= $kelas['nama_kelas'];?> => <?= $kelas['kuota'];?> => <?= number_format($kelas['harga_jual']);?><br>
					<?php
					}
					
					?>
					<p>
						<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-default<?= $berita['id_berita'] ?>">
							<i class="fa fa-plus"></i> Add Kelas
						</button>
					</p>
					<?= form_open(base_url('admin/event/add_kelas'));
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
											<input type="text" name="nama_kelas" class="form-control" placeholder="Nama Kegiatan" value="<?= set_value('nama_kelas') ?>" required>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-md-2">Tanggal Mulai</label>
										<div class="col-md-4">
											<input type="date" name="tanggal_mulai" class="form-control" value="<?= set_value('tanggal_mulai') ?>" required>
										</div>
										<label class="col-2">Tanggal Selesai</label>
										<div class="col-md-4">
											<input type="date" name="tanggal_selesai" class="form-control" value="<?= set_value('tanggal_selesai') ?>" required>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-md-2">Harga Dasar</label>
										<div class="col-md-4">
											<input type="number" name="harga_dasar" class="form-control" placeholder="Harga Dasar" value="<?= set_value('harga_dasar') ?>" required>
										</div>
										<label class="col-2">Harga Jual</label>
										<div class="col-md-4">
											<input type="number" name="harga_jual" class="form-control" placeholder="Harga Jual" value="<?= set_value('harga_jual') ?>" required>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-md-2">Kategori</label>
										<div class="col-md-4">
											<select class="form-control" name="kategori_kelas" riquired>
												<option value=''>Pilih</option>
												<?php
												foreach($kategori_kelas as $k){
												?>
												<option value='<?= $k['id_kategori_kelas']?>'><?= $k['kategori_kelas']?></option>
												<?php
												}
												?>
											</select>
										</div>
										<label class="col-md-2">Status</label>
										<div class="col-md-4">
											<select class="form-control" required name="status">
												<option value="1">Publish</option>
												<option value="0">Draft</option>
											</select>
										</div>
										
									</div>
									<div class="form-group row">
										<label class="col-md-2">Kuota</label>
										<div class="col-md-4">
											<input type="number" name="kuota" class="form-control" placeholder="Kuota" value="<?= set_value('kuota') ?>" required>
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
				</small>
			</td>
			<td>
				<a href="<?= base_url('berita/read/' . $berita['slug_berita']) ?>" class="btn btn-info btn-sm" target="_blank"><i class="fa fa-eye"></i> Baca</a>
				<a href="<?= base_url('admin/event/edit/' . $berita['id_berita']) ?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
				<a href="<?= base_url('admin/event/delete/' . $berita['id_berita']) ?>" class="btn btn-dark btn-sm" onclick="confirmation(event)"><i class="fa fa-trash"></i></a>
			</td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>
</div>