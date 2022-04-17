<?php 

use App\Models\Organisasi_profesi_model;
include 'tambah.php'; 
?>

<table class="table table-bordered table-sm" id="example1">
	<thead>
		<tr>
			<th>No</th>
			<th>Nama Profesi</th>
			<th>Nama Organisasi</th>
			<th>Alamat</th>
			<th>Kontak</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php $no = 1;
		
		foreach ($profesi as $profesi) { 
			
		?>
		<tr>
			<td><?= $no ?></td>
			<td><?= $profesi['nama_profesi'] ?></td>
			<?php
			$id_profesi = $profesi['id_profesi'];
			$m_op       = new Organisasi_profesi_model();
			$count_op   = $m_op->count_by_id_profesi($id_profesi);
			?>
			<td><?php if($count_op>0){}else{echo "-";}; ?></td>
			<td></td>
			<td></td>
			<td>
				<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-default<?= $profesi['has_profesi'] ?>">
						<i class="fa fa-edit"></i> Edit
				</button>
				<?= form_open(base_url('admin/profesi'));
				echo csrf_field();
				?>
				<div class="modal fade" id="modal-default<?= $profesi['has_profesi'] ?>">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title">Edit Profesi</h4>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<div class="row mt-2">
									<label class="col-md-3">Nama Profesi</label>
									<div class="col-md-9 row">
										<input type="text" name="nama_profesi" class="form-control form-control-sm" value="<?= $profesi['nama_profesi'] ?>" required>
										<input type="text" name="has_profesi" class="form-control form-control-sm" value="<?= $profesi['has_profesi'] ?>" required>
										<input type="hidden" name="aksi" class="form-control form-control-sm" value="edit_profesi" required>
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
		<?php $no++; } ?>
	</tbody>
</table>