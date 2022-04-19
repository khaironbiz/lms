<p>
	<button type="button" class="btn btn-success mt-2" data-toggle="modal" data-target="#modal-default">
		<i class="fa fa-plus"></i> Tambah
	</button>
</p>
<?= form_open(base_url('admin/organisasi_profesi_provinsi/create'));
echo csrf_field();
?>
<div class="modal fade" id="modal-default">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Tambah Organisasi Profesi Provinsi</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<label class="col-md-3">Organisasi Profesi</label>
					<div class="col-md-9">
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
				<div class="row mt-2">
					<label class="col-md-3">Provinsi</label>
					<div class="col-md-9">
						<select class="form-control form-control-sm" name="id_provinsi">
							<option value="">---pilih---</option>
							<?php
								foreach($provinsi as $p):
							?>
							<option value="<?= $p['id_prov']?>"><?= $p['nama_prov']?></option>
							<?php
							endforeach
							?>
						</select>
					</div>
				</div>
				<div class="row mt-2">
					<label class="col-md-3">Pimpinan Organisasi</label>
					<div class="col-md-9">
						<input type="text" name="pimpinan_op_provinsi" class="form-control form-control-sm" required>
					</div>
				</div>
				<div class="row mt-2">
					<label class="col-md-3">Alamat</label>
					<div class="col-md-9">
						<textarea row="2" class="form-control" name="alamat_op_provinsi"></textarea>
					</div>
				</div>
				<div class="row mt-2">
					<label class="col-md-3">Website</label>
					<div class="col-md-3">
						<input type="text" name="web_op_provinsi" class="form-control form-control-sm" required>
					</div>
					<label class="col-md-2">Email</label>
					<div class="col-md-4">
						<input type="email" name="email_op_provinsi" class="form-control form-control-sm" required>
					</div>
				</div>
				<div class="row mt-2">
					
				</div>
				<div class="row mt-2">
					<label class="col-md-3">Telp</label>
					<div class="col-md-3">
						<input type="telp" name="telp_op_provinsi" class="form-control form-control-sm" required>
					</div>
					<label class="col-md-2">HP</label>
					<div class="col-md-4">
						<input type="telp" name="hp_op_provinsi" class="form-control form-control-sm" required>
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
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php $no = 1;
		
		foreach ($op_provinsi as $opp) { 
			$data_telah_dihapus = strtotime($opp['deleted_at']);
		?>
		<tr <?php if($data_telah_dihapus >1){echo "class='bg-danger'"; } ?>>
			<td><?= $no ?></td>
			<td>
				<?= $opp['nama_op']?><br>
				<?= $opp['nama_prov']?><br>
				<?= $opp['pimpinan_op_provinsi']?>
			</td>
			<td>
				<?= $opp['alamat_op_provinsi']?><br>
				<?= $opp['web_op_provinsi']?>, 
				<?= $opp['email_op_provinsi']?>,
				<?= $opp['hp_op_provinsi']?>,
				<?= $opp['telp_op_provinsi']?>
			</td>
			<td>
				<a href="<?= base_url('admin/organisasi_profesi_provinsi/detail/'.$opp['has_op_provinsi'])?>" class="btn btn-sm btn-success">Detail</a>
			</td>
			
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>
<a href="<?= base_url()?>/admin/profesi" class="btn btn-sm btn-primary">Master Profesi</a>