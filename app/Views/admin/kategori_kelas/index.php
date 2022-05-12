<?php 
echo view($sub_menu);
use App\Models\Kategori_kelas_model;
include 'tambah.php'; 
?>
<table class="table table-bordered table-sm" id="example1">
	<thead>
		<tr>
			<th>No</th>
			<th>Nama</th>
			<th>Slug</th>
			<th>Urutan</th>
			<th>Count</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php $no = 1;
		$m_kategori_kelas   = new Kategori_kelas_model();
		foreach ($kategori_kelas as $kategori_kelas) { 
			$count	= $m_kategori_kelas->count($kategori_kelas['nama_kategori_kelas']);
		?>
		<tr>
			<td><?= $no ?></td>
			<td><?= $kategori_kelas['nama_kategori_kelas'] ?></td>
			<td><?= $kategori_kelas['slug_kategori_kelas'] ?></td>
			<td><?= $kategori_kelas['urutan'] ?></td>
			<td><?= $count['count']?></td>
			<td>
				<a href="<?= base_url('admin/kategori_kelas/edit/' . $kategori_kelas['has_kategori_kelas']) ?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
				<a href="<?= base_url('admin/kategori_kelas/delete/' . $kategori_kelas['has_kategori_kelas']) ?>" class="btn btn-dark btn-sm" onclick="confirmation(event)"><i class="fa fa-trash"></i></a>
			</td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>