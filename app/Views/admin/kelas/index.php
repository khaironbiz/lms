<?php
use App\Models\Kelas_model;
echo view($sub_menu);
?>
<div class="table-responsive">
	<table class="table table-sm table-bordered" id="example1">
		<thead>
			<tr>
				<th>No</th>
				<th>Kelas</th>
				<th>Topik</th>
				<th>Akreditasi</th>
				<th>Harga Dasar</th>
				<th>Harga Jual</th>
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
				<td></td>
				<td class="text-right"><?= number_format($kelas['harga_jual'])?></td>
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