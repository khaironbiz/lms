<?php 
// echo view($sub_menu);
use App\Models\Kategori_kelas_model;
include 'tambah.php'; 
?>
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
			<td></td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>