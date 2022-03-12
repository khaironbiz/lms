<form action="<?= base_url('admin/kelas/update/' . $kelas['id_kelas']) ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
<?= csrf_field();
?>
<div class="row">
	<div class="col-md-6">
		<div class="form-group row">
			<label class="col-md-2">Event</label>
			<div class="col-md-10">
				<input type="text" name="event" class="form-control form-control-sm" value="<?= $kelas['judul_berita'] ?>" readonly>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-md-2">Nama Kegiatan</label>
			<div class="col-md-10">
				<input type="text" name="nama_kelas" class="form-control form-control-sm" value="<?= $kelas['nama_kelas'] ?>" required>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-md-2">Tanggal Mulai</label>
			<div class="col-md-4">
				<input type="text" name="tanggal_mulai" class="form-control form-control-sm tanggal" value="<?= $kelas['tanggal_mulai'] ?>" required>
			</div>
			<label class="col-2">Tanggal Selesai</label>
			<div class="col-md-4">
				<input type="text" name="tanggal_selesai" class="form-control form-control-sm tanggal" value="<?= $kelas['tanggal_selesai'] ?>" required>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-md-2">Harga Dasar</label>
			<div class="col-md-4">
				<input type="number" name="harga_dasar" class="form-control form-control-sm" placeholder="Harga Dasar" value="<?= $kelas['harga_dasar'] ?>" required>
			</div>
			<label class="col-2">Harga Jual</label>
			<div class="col-md-4">
				<input type="number" name="harga_jual" class="form-control form-control-sm" placeholder="Harga Jual" value="<?= $kelas['harga_jual'] ?>" required>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-md-2">Kategori</label>
			<div class="col-md-4">
				<select class="form-control form-control-sm" name="kategori_kelas" riquired>
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
		<div class="modal-footer justify-content-between">
			<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
		</div>
	</div>
	
</div>
	

<?= form_close(); ?>