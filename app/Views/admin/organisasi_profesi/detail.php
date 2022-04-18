<div class="card">
	<div class="card-body">
		<div class="row">
			<label class="col-sm-2 col-form-label">Nama Profesi</label>
			<div class="col-sm-10"><?= $op->nama_profesi?></div>
		</div>
		<div class="row">
			<label class="col-sm-2 col-form-label">Organisasi Profesi</label>
			<div class="col-sm-10"><?= $op->nama_op." (".$op->singkatan_op.")"?></div>
		</div>
		<div class="row">
			<label class="col-sm-2 col-form-label">Pimpinan Organisasi</label>
			<div class="col-sm-10"><?= $op->pimpinan_op?></div>
		</div>
		<div class="row">
			<label class="col-sm-2 col-form-label">Alamat</label>
			<div class="col-sm-10"><?= $op->alamat_op?></div>
		</div>
	</div>
	<?php
	$data_didelete = strtotime($op->deleted_at);
	if($data_didelete >1){
		echo "<div class='card-footer'>DATA Telah Dihapus</div>";
	}else{
	?>
	<div class="card-footer row">
		<div class="col-6 text-left">
			<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete<?= $op->has_op ?>">
			<i class="fa fa-trash"></i> DELETE
		</button>
		<?= form_open(base_url('admin/organisasi_profesi/delete/'.$op->has_op));
			echo csrf_field();
		?>
				<div class="modal fade" id="delete<?= $op->has_op ?>">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title">Hapus Organisasi Profesi</h4>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<div class="row mt-2">
									<label class="col-md-3">Nama Profesi</label>
									<div class="col-md-9">
										<input type="text" name="nama_profesi" class="form-control form-control-sm" value="<?= $op->nama_profesi ?>" required readonly>
										<input type="hidden" name="has_op" class="form-control form-control-sm" value="<?= $op->has_op ?>" required>
										<input type="hidden" name="aksi" class="form-control form-control-sm" value="edit_op" required>
									</div>
								</div>
								<div class="row mt-2">
									<label class="col-md-3">Organisasi Profesi</label>
									<div class="col-md-9">
										<input type="text" name="nama_op" class="form-control form-control-sm" value="<?= $op->nama_op ?>" required>
									</div>
								</div>
								<div class="row mt-2">
									<label class="col-md-3">Singkatan</label>
									<div class="col-md-9">
										<input type="text" name="singkatan_op" class="form-control form-control-sm" value="<?= $op->singkatan_op ?>" required>
									</div>
								</div>
								<div class="row mt-2">
									<label class="col-md-3">Pimpinan</label>
									<div class="col-md-9">
										<input type="text" name="pimpinan_op" class="form-control form-control-sm" value="<?= $op->pimpinan_op ?>">
									</div>
								</div>
								<div class="row mt-2">
									<label class="col-md-3">Alamat</label>
									<div class="col-md-9">
										<textarea class="form-control form-control-sm" name="alamat_op"><?= $op->alamat_op ?></textarea>
									</div>
								</div>
								<div class="row mt-2">
									<label class="col-md-3">Website</label>
									<div class="col-md-3">
										<input type="text" name="web_op" class="form-control form-control-sm" value="<?= $op->web_op ?>">
										
									</div>
									<label class="col-md-3">Email</label>
									<div class="col-md-3">
										<input type="text" name="email_op" class="form-control form-control-sm" value="<?= $op->email_op ?>">
									</div>
								</div>
								<div class="row mt-2">
									<label class="col-md-3">Phone</label>
									<div class="col-md-3">
										<input type="text" name="telp_op" class="form-control form-control-sm" value="<?= $op->telp_op ?>">
										
									</div>
									<label class="col-md-3">HP</label>
									<div class="col-md-3">
										<input type="text" name="hp_op" class="form-control form-control-sm" value="<?= $op->hp_op ?>">
									</div>
								</div>
							</div>
							<div class="modal-footer justify-content-between">
								<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
								<button type="submit" class="btn btn-danger"><i class="fa fa-trush"></i> Remove</button>
							</div>
						</div>
						<!-- /.modal-content -->
					</div>
					<!-- /.modal-dialog -->
				</div>
		<!-- /.modal -->
		<?= form_close(); ?>
		</div>
		<div class="col-6 text-right">
			<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-default<?= $op->has_op ?>">
			<i class="fa fa-edit"></i> Edit
		</button>
		<?= form_open(base_url('admin/organisasi_profesi/update/'.$op->has_op));
			echo csrf_field();
		?>
				<div class="modal fade" id="modal-default<?= $op->has_op ?>">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title">Edit Organisasi Profesi</h4>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<div class="row mt-2">
									<label class="col-md-3">Nama Profesi</label>
									<div class="col-md-9">
										<input type="text" name="nama_profesi" class="form-control form-control-sm" value="<?= $op->nama_profesi ?>" required readonly>
										<input type="hidden" name="has_op" class="form-control form-control-sm" value="<?= $op->has_op ?>" required>
										<input type="hidden" name="aksi" class="form-control form-control-sm" value="edit_op" required>
									</div>
								</div>
								<div class="row mt-2">
									<label class="col-md-3">Organisasi Profesi</label>
									<div class="col-md-9">
										<input type="text" name="nama_op" class="form-control form-control-sm" value="<?= $op->nama_op ?>" required>
									</div>
								</div>
								<div class="row mt-2">
									<label class="col-md-3">Singkatan</label>
									<div class="col-md-9">
										<input type="text" name="singkatan_op" class="form-control form-control-sm" value="<?= $op->singkatan_op ?>" required>
									</div>
								</div>
								<div class="row mt-2">
									<label class="col-md-3">Pimpinan</label>
									<div class="col-md-9">
										<input type="text" name="pimpinan_op" class="form-control form-control-sm" value="<?= $op->pimpinan_op ?>">
									</div>
								</div>
								<div class="row mt-2">
									<label class="col-md-3">Alamat</label>
									<div class="col-md-9">
										<textarea class="form-control form-control-sm" name="alamat_op"><?= $op->alamat_op ?></textarea>
									</div>
								</div>
								<div class="row mt-2">
									<label class="col-md-3">Website</label>
									<div class="col-md-3">
										<input type="text" name="web_op" class="form-control form-control-sm" value="<?= $op->web_op ?>">
										
									</div>
									<label class="col-md-3">Email</label>
									<div class="col-md-3">
										<input type="text" name="email_op" class="form-control form-control-sm" value="<?= $op->email_op ?>">
									</div>
								</div>
								<div class="row mt-2">
									<label class="col-md-3">Phone</label>
									<div class="col-md-3">
										<input type="text" name="telp_op" class="form-control form-control-sm" value="<?= $op->telp_op ?>">
										
									</div>
									<label class="col-md-3">HP</label>
									<div class="col-md-3">
										<input type="text" name="hp_op" class="form-control form-control-sm" value="<?= $op->hp_op ?>">
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
		</div>
		
	</div>
	<?php
	}
	?>
</div>