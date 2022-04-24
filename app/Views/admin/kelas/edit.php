<form action="<?= base_url('admin/kelas/update/' . $kelas['has_kelas']) ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
<?= csrf_field();
?>

<div class="row">
	<?php
	if($kelas['poster'] !=''):
	?>
	<img src="<?= base_url()?>/assets/upload/image/<?= $kelas['poster']?>" class="img-fluid" alt="...">
	<?php
	endif
	?>
</div>

<div class="row mt-3">
	<div class="col-md-12">
		<div class="row">
			<label class="col-md-2 mt-1">Event</label>
			<div class="col-md-10">
				<input type="text" name="event" class="form-control form-control-sm" value="<?= $kelas['judul_berita'] ?>" readonly>
			</div>
		</div>
		<div class="row">
			<label class="col-md-2 mt-1">Nama Kegiatan</label>
			<div class="col-md-10">
				<input type="text" name="nama_kelas" class="form-control form-control-sm" value="<?= $kelas['nama_kelas'] ?>" required>
			</div>
		</div>
		<div class="row">
			<label class="col-md-2 mt-1">Tanggal Mulai</label>
			<div class="col-md-4">
				<input type="text" name="tanggal_mulai" class="form-control form-control-sm tanggal" value="<?= date('d-m-Y',strtotime($kelas['tanggal_mulai'])) ?>" required>
			</div>
			<label class="col-2 mt-1">Tanggal Selesai</label>
			<div class="col-md-4">
				<input type="text" name="tanggal_selesai" class="form-control form-control-sm tanggal" value="<?= date('d-m-Y',strtotime($kelas['tanggal_selesai'])) ?>" required>
			</div>
		</div>
		<div class="row">
			<label class="col-md-2 mt-1">Harga Dasar</label>
			<div class="col-md-4">
				<input type="number" name="harga_dasar" class="form-control form-control-sm" placeholder="Harga Dasar" value="<?= $kelas['harga_dasar'] ?>" required>
			</div>
			<label class="col-2 mt-1">Harga Jual</label>
			<div class="col-md-4">
				<input type="number" name="harga_jual" class="form-control form-control-sm" placeholder="Harga Jual" value="<?= $kelas['harga_jual'] ?>" required>
			</div>
		</div>
		<div class="row">
			<label class="col-md-2 mt-1">Kategori</label>
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
			<label class="col-md-2 mt-1">Status</label>
			<div class="col-md-4">
				<select class="form-control form-control-sm" required name="status">
					<option value="1">Publish</option>
					<option value="0">Draft</option>
				</select>
			</div>					
		</div>
		<div class="row">
			<label class="col-md-2 mt-1">Kuota</label>
			<div class="col-md-4">
				<input type="number" name="kuota" class="form-control form-control-sm" placeholder="Kuota" value="<?= $kelas['kuota'] ?>" required>
			</div>
			<label class="col-md-2 mt-1">Metode</label>
			<div class="col-md-4">
				<select name="metode_pembelajaran" class="form-control form-control-sm" required>
					<option value=""></option>
					<option value="0">Daring</option>
					<option value="1">Luring</option>					
					<option value="2">Gabungan Daring dan Luring</option>
				</select>
			</div>
		</div>
		<div class="row">
			<label class="col-md-2 mt-1">PIC</label>
			<div class="col-md-4">
				<select name="pic" class="form-control form-control-sm" required>
					<option value="<?= $kelas['pic_kelas']?>"><?= nama_user($kelas['pic_kelas'])?></option>
					<?php
						foreach($user as $u):
					?>
					<option><?= $u['nama']?></option>
					<?php
					endforeach
					?>
				</select>
			</div>
			<label class="col-md-2 mt-1">poster</label>
			<div class="col-md-4">
				<input type="file" name="gambar" class="form-control form-control-sm" placeholder="poster">
			</div>
		</div>
		<div class="modal-footer justify-content-between">
			<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
		</div>
	</div>
	
</div>
	

<?= form_close(); ?>