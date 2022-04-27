
<table class="table table-bordered table-sm" id="example1">
	<thead>
		<tr>
			<th>No</th>
			<th>Nama Kelas</th>
			<th>Nama Peserta</th>
			<th>Email</th>
			<th>HP</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php $no = 1;
		
		foreach ($kelas_peserta as $peserta) { 
			
		?>
		<tr>
			<td><?= $no ?></td>
			<td><?= $peserta['nama_kelas'] ?></td>
			<td><?= $peserta['nama'] ?></td>
			<td><?= $peserta['email_peserta'] ?></td>
			<td><?= $peserta['hp_peserta']?></td>
			<td></td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>