<?php include 'tambah.php'; ?>
<table class="table table-bordered table-sm" id="example1">
	<thead>
		<tr>
			<th width="5%">No</th>
			<th width="25%">Nama</th>
			<th width="25%">Slug</th>
			<th width="25%">Urutan</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php $no = 1;

foreach ($kategori_kelas as $kategori_kelas) { ?>
		<tr>
			<td><?= $no ?></td>
			<td><?= $kategori_kelas['kategori_kelas'] ?></td>
			<td><?= $kategori_kelas['slug_kategori_kelas'] ?></td>
			<td><?= $kategori_kelas['urutan'] ?></td>
			<td>
				<a href="<?= base_url('admin/kategori_kelas/edit/' . $kategori_kelas['has_kategori_kelas']) ?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
				<a href="<?= base_url('admin/kategori_kelas/delete/' . $kategori_kelas['id_kategori_kelas']) ?>" class="btn btn-dark btn-sm" onclick="confirmation(event)"><i class="fa fa-trash"></i></a>
			</td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>