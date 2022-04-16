<?php
use App\Models\Kelas_model;
echo view($sub_menu)
?>
<p>
	<a href="<?= base_url('admin/event/tambah') ?>" class="btn btn-success mt-2">
		<i class="fa fa-plus"></i> Tambah Baru
	</a>
</p>
<div class="table-responsive">

<table class="table table-bordered" id="example1">
	<thead>
		<tr>
			<th>No</th>
			<th>Gambar</th>
			<th class="w-50">Judul</th>
			<th>Kelas</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		$no 		= 1;
		$m_kelas    = new Kelas_model();
		foreach ($berita as $berita) { 
			$id_event   = $berita['id_berita'];
			$kelas      = $m_kelas->event($id_event);
		?>
		<tr>
			<td><?= $no ?></td>
			<td>
				<?php 
				if ($berita['gambar'] === ''){
					echo '-';
					}else{ ?>
					<img src="<?= base_url('assets/upload/image/thumbs/' . $berita['gambar']) ?>" class="rounded w-100">
				<?php 
				} 
				?>
			</td>
			<td>
				<a href="<?= base_url('berita/read/' . $berita['slug_berita']) ?>" target="_blank"><?= $berita['judul_berita'] ?></a>
				<small>
					<br><i class="fa fa-eye"></i> Hits: <?= $berita['hits'] ?>
					<br><i class="fa fa-calendar-check"></i> Publish: <?= tanggal_bulan_menit($berita['tanggal_publish']) ?>
					<br><i class="fa fa-calendar"></i> Updated: <?= tanggal_bulan_menit($berita['tanggal']) ?>
					<br><i class="fa fa-user"></i> <a href="<?= base_url('admin/berita/author/' . $berita['id_user']) ?>"><?= $berita['nama'] ?></a>
				</small>
			</td>
			<td>
				<small>
					<?php
						foreach($kelas as $kelas){
					?>
					<?= $kelas['nama_kelas'];?> => <?= number_format($kelas['kuota']);?> => <?= number_format($kelas['harga_jual']);?><br>
					<?php
					}
					
					?>
					
					
				</small>
			</td>
			<td>
				<a href="<?= base_url('admin/event/detail/' . $berita['has_berita']) ?>" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a>
				<a href="<?= base_url('admin/event/edit/' . $berita['id_berita']) ?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
				<a href="<?= base_url('admin/event/delete/' . $berita['id_berita']) ?>" class="btn btn-dark btn-sm" onclick="confirmation(event)"><i class="fa fa-trash"></i></a>
			</td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>
</div>