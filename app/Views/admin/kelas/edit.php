<form action="<?= base_url('admin/kelas/update/' . $kelas['id_kelas']) ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
<?= csrf_field();
?>
<div class="row">
	<div class="col-md-6">
	<div class="form-group row">
			<label class="col-md-3">Event</label>
			<div class="col-md-9">
				<input type="text" name="event" class="form-control form-control-sm" value="<?= $kelas['judul_berita'] ?>" readonly>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-md-3">Nama Kegiatan</label>
			<div class="col-md-9">
				<input type="text" name="nama_kelas" class="form-control form-control-sm" value="<?= $kelas['nama_kelas'] ?>" required>
			</div>
		</div>

	</div>
</div>

<?= form_close(); ?>