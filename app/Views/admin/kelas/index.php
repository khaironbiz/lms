<?php
use App\Models\Kelas_model;
echo view($sub_menu);
?>
<div class="table-responsive">

<table class="table table-bordered" id="example1">
	<thead>
		<tr>
			<th>No</th>
			<th>Kelas</th>
			<th>Materi</th>
			<th>SKP</th>
			<th>Harga</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		$no 		= 1;
		foreach ($kelas as $kelas) { 
			
		?>
		<tr>
			<td><?= $no ?></td>
			<td><?= $kelas['nama_kelas']?></td>
			<td>
				<small>
					
				</small>
			</td>
			<td></td>
			<td><?= $kelas['harga_jual']?></td>
			<td>
				<?php 
				include 'tambah.php';  
				?>
			</td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>
</div>