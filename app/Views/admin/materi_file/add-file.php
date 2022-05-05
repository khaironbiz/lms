<?php
use App\Models\Materi_file_model;
$m_materi_file      		= new Materi_file_model();
?>
<div class="row">
	<div class="col-md-6">
        <a href="<?= base_url('admin/file/add/'.$materi['has_materi'])?>" class="btn btn-sm btn-primary mb-2">File Baru</a>
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
				<?php 
				$no = 1;
				
				$id_materi = $materi['id_materi'];
				foreach ($file as $file) { 
					$id_file = $file['id_file'];
					$count_id_file_id_materi 	= $m_materi_file->count_id_file_id_materi($id_file, $id_materi);
				?>
				<tr>
					<td><?= $no ?></td>
					<td>
						<?php
							if($count_id_file_id_materi>0){
								echo $file['judul_file'];
							}else{
						?>
						<input type="radio" name="id_file" value="<?= $file['id_file']?>">
						<?= $file['judul_file'] ?>
						<?php
							}
						?>
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