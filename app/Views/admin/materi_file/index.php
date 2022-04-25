
<div class="row">
	<div class="col-md-6">
		<table class="table table-bordered table-sm" id="example1">
			<thead>
				<tr>
					<th>No</th>
					<th>Nama Profesi</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php $no = 1;
				
				foreach ($materi_file as $mf) { 
					
				?>
				<tr>
					<td><?= $no ?></td>
					<td><?= $mf['judul_file'] ?></td>
					<td></td>
				</tr>
				<?php $no++; } ?>
			</tbody>
		</table>
	</div>
	
</div>