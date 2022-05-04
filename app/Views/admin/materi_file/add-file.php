
<div class="row">
	<div class="col-md-6">
        <a href="" class="btn btn-sm btn-primary mb-2">File Baru</a>
		<?= form_open(base_url('admin/materi_file/addfile/'.$materi['has_materi']));
		echo csrf_field();
		?>
		<table class="table table-bordered table-sm" id="example4">
			<thead>
				<tr>
					<th>No</th>
					<th>Nama File</th>
				</tr>
			</thead>
			<tbody>
				<?php $no = 1;
				
				foreach ($file as $file) { 
					
				?>
				<tr>
					<td><?= $no ?></td>
					<td>
						<input type="radio" name="id_file" value="<?= $file['id_file']?>">
						 <?= $file['judul_file'] ?>
					</td>
				</tr>
				<?php $no++; } ?>
			</tbody>
		</table>
		
		<a href="<?= base_url('admin/materi/detail/'.$materi['has_materi'])?>" class="btn btn-sm btn-danger">Back</a>
		<button type="submit" class="btn btn-sm btn-primary">Save</button>
		<?= form_close(); ?>
	</div>
	
</div>