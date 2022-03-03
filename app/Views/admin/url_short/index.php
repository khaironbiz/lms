<?php 
// echo view($sub_menu);
use App\Models\Kategori_kelas_model;
include 'tambah.php'; 
?>
<?= '<span class="text-danger">' . \Config\Services::validation()->listErrors() . '</span>'; ?>

<table class="table table-bordered table-sm" id="example1">
	<thead>
		<tr>
			<th>No</th>
			<th>URL Asli</th>
			<th>URL Short</th>
			<th>Created By</th>
			<th>Expired</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php $no = 1;
		$m_kategori_kelas   = new Kategori_kelas_model();
		foreach ($url as $url) { 
			
		?>
		<tr>
			<td><?= $no ?></td>
			<td><?= $url['url_asli'] ?></td>
			<td><?= $url['short'] ?></td>
			<td><?= $url['nama'] ?></td>
			<td><?= $url['exp_date']?></td>
			<td>
				<a href="<?= base_url('s/'.$url['short'])?>" class="btn btn-sm btn-info" target=_blank>Visit</a>
				<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-url-<?= $url['has_url'] ?>">
					<i class="fa fa-edit"></i> Edit
				</button>
				<?= form_open(base_url('admin/url/pengkinian/'.$url['has_url']));
				echo csrf_field();
				?>
				<div class="modal fade" id="modal-url-<?= $url['has_url'] ?>">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title">Update Short URL</h4>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<div class="form-group row">
									<label class="col-3">URL Asli</label>
									<div class="col-9 row">
										<input type="text" name="url_asli" class="form-control form-control-sm" placeholder="Url Asli" value="<?= $url['url_asli'] ?>" required>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-3">URL Short</label>
									<div class="col-md-9 row">
										<input type="text" class="form-control form-control-sm col-6 text-right" value="https://hpii.or.id/s/" readonly>
										<input type="text" name="short" class="form-control form-control-sm col-6" placeholder="Perpendek" value="<?= $url['short'] ?>" required>
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