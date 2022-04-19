<p>
	<button type="button" class="btn btn-success mt-2" data-toggle="modal" data-target="#modal-default">
		<i class="fa fa-plus"></i> Tambah
	</button>
</p>
<?= form_open(base_url('admin/organisasi_profesi/create'));
echo csrf_field();
?>
<div class="modal fade" id="modal-default">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Tambah Organisasi Profesi</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<label class="col-md-3">Nama Profesi</label>
					<div class="col-md-9 row">
						<select class="form-control form-control-sm" name="id_profesi">
							<option value="">---pilih---</option>
							<?php
								foreach($profesi as $profesi):
							?>
							<option value="<?= $profesi['id_profesi']?>"><?= $profesi['nama_profesi']?></option>
							<?php
							endforeach
							?>
						</select>
					</div>
				</div>
				<div class="row mt-2">
					<label class="col-md-3">Nama Organisasi</label>
					<div class="col-md-9 row">
						<input type="text" name="nama_op" class="form-control form-control-sm" required>
						<input type="hidden" name="aksi" class="form-control form-control-sm" value="reate_op" required>
					</div>
				</div>
				<div class="row mt-2">
					<label class="col-md-3">Singkatan</label>
					<div class="col-md-9 row">
						<input type="text" name="singkatan_op" class="form-control form-control-sm" required>
					</div>
				</div>
				<div class="row mt-2">
					<label class="col-md-3">Pimpinan Organisasi</label>
					<div class="col-md-9 row">
						<input type="text" name="pimpinan_op" class="form-control form-control-sm" required>
					</div>
				</div>
				<div class="row mt-2">
					<label class="col-md-3">Alamat</label>
					<div class="col-md-9 row">
						<textarea row="2" class="form-control" name="alamat_op"></textarea>
					</div>
				</div>
				<div class="row mt-2">
					<label class="col-md-3">Website</label>
					<div class="col-md-9 row">
						<input type="text" name="web_op" class="form-control form-control-sm" required>
					</div>
				</div>
				<div class="row mt-2">
					<label class="col-md-3">Email</label>
					<div class="col-md-9 row">
						<input type="email" name="email_op" class="form-control form-control-sm" required>
					</div>
				</div>
				<div class="row mt-2">
					<label class="col-md-3">HP</label>
					<div class="col-md-9 row">
						<input type="telp" name="hp_op" class="form-control form-control-sm" required>
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

<table class="table table-bordered table-sm" id="example1">
	<thead>
		<tr>
			<th>No</th>
			<th>Nama Profesi</th>
			<th>Nama Organisasi</th>
			<th>Alamat</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php $no = 1;
		
		foreach ($op as $op) { 
			$data_telah_dihapus = strtotime($op['deleted_at']);
		?>
		<tr <?php if($data_telah_dihapus >1){echo "class='bg-danger'"; } ?>>
			<td><?= $no ?></td>
			<td><?= $op['nama_profesi']?></td>
			<td>
				<?= $op['nama_op']." (".$op['singkatan_op'].")"?><br>
				<b><?= $op['pimpinan_op'] ?></b>
			</td>
			<td>
				<?= $op['alamat_op'] ?><br>
				<?= $op['web_op'].", ".$op['email_op'].", ".$op['hp_op'] ?>
			</td>
			<td>
				<a href="<?= base_url('admin/organisasi_profesi/detail/'.$op['has_op'])?>" class="btn btn-sm btn-success">Detail</a>
			</td>
			
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>
<a href="<?= base_url()?>/admin/profesi" class="btn btn-sm btn-primary">Master Profesi</a>