<?php
use App\Models\Akreditasi_profesi_model;
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
				<th>Kuota</th>
				<th>Pendaftar</th>
				<th>Sisa</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			$no 		= 1;
			foreach ($kelas as $kelas) { 
				$id_kelas 					= $kelas['id_kelas'];
				$m_akreditasi_profesi 		= new Akreditasi_profesi_model();
				$count_akreditasi_profesi 	= $m_akreditasi_profesi->count_id_kelas($id_kelas);
			?>
			<tr>
				<td><?= $no ?></td>
				<td>
					<?= $kelas['nama_kelas']?><br>
					<small>
						<?= $kelas['judul_berita']?>
					</small>
				</td>
				<td>
					
				</td>
				<td><?= $count_akreditasi_profesi ?> Profesi</td>
				<td class="text-right"><?= number_format($kelas['harga_dasar'])?></td>
				<td class="text-right"><?= number_format($kelas['harga_jual'])?></td>
				<td class="text-right"><?= number_format($kelas['kuota'])?></td>
				<td class="text-right"></td>
				<td class="text-right"></td>
				<td>
					<a href="<?= base_url()?>/admin/kelas/detail/<?= $kelas['has_kelas']?>" class="btn btn-sm btn-info">Detail</a>
				</td>
			</tr>
			<?php $no++; } ?>
		</tbody>
	</table>
</div>