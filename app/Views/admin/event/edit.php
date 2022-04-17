<form action="<?= base_url('admin/event/update/' . $berita['id_berita']) ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
<?= csrf_field();
?>

<div class="form-group row">
	<label class="col-md-2">Nama Event</label>
	<div class="col-md-10">
		<input type="text" name="judul_berita" class="form-control" value="<?= $berita['judul_berita'] ?>" required>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-2">Banner</label>
	<div class="col-md-10">
		<input type="file" name="gambar" class="form-control" value="<?= $berita['gambar'] ?>">
	</div>
</div>

<div class="form-group row">
	<label class="col-md-2">Kategori</label>
	
	<div class="col-md-2">
		<select name="jenis_berita" class="form-control">
			<option value="Event">Event</option>
		</select>
		<small class="text-secondary">Jenis konten</small>
	</div>
	<div class="col-md-2">
		<select name="status_berita" class="form-control">
			<option value="Publish">Publish</option>
			<option value="Draft" <?php if ($berita['status_berita'] === 'Draft') {
    echo 'selected';
} ?>>Draft</option>
		</select>
		<small class="text-secondary">Status publikasi</small>
	</div>
	<div class="col-md-2">
		<input type="text" name="icon" class="form-control" value="<?= $berita['icon'] ?>">
		<small class="text-secondary">Icon <a href="https://fontawesome.com/icons" target="_blank">Fontawsome</a></small>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-2">Waktu Publikasi</label>
	<div class="col-md-4">
		<input type="text" name="tanggal_publish" class="form-control tanggal" value="<?php if (isset($_POST['tanggal_publis'])) {
    echo set_value('tanggal_publish');
} else {
    echo tanggal_id($berita['tanggal_publish']);
} ?>">
		<small class="text-secondary">Format <strong>dd-mm-yyyy</strong>. Misal: <?= date('d-m-Y') ?></small>
	</div>
	<div class="col-md-2">
		<input type="text" name="jam" class="form-control jam" value="<?php if (isset($_POST['jam'])) {
    echo set_value('jam');
} else {
    echo date('H:i:s', strtotime($berita['tanggal_publish']));
} ?>">
		<small class="text-secondary">Format <strong>HH:MM:SS</strong>. Misal: <?= date('H:i:s') ?></small>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-2">Ringkasan</label>
	<div class="col-md-10">
		<textarea name="ringkasan" class="form-control"><?= $berita['ringkasan'] ?></textarea>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-2">Deskripsi</label>
	<div class="col-md-10">
		<textarea name="isi" class="form-control konten"><?= $berita['isi'] ?></textarea>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-2">Keyword</label>
	<div class="col-md-10">
		<textarea name="keywords" class="form-control"><?= $berita['keywords'] ?></textarea>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-2"></label>
	<div class="col-md-10">
		<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
	</div>
</div>

<?= form_close(); ?>