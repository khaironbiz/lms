
<form action="<?= base_url('admin/video/create/'.$materi['has_materi']) ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
<?php
	echo csrf_field();
?>
<div class="row justify-content-center">
	<div class="col-md-6">
			<div class="card">
				<div class="card-header text-center bg-danger">
					<b>Menambahkan Video Dari Youtube</b>
				</div>
				<div class="card-body">
					<div class="row mt-2">
						<label class="col-md-3">Judul Video</label>
						<div class="col-md-9 row">
							<input type="text" name="judul" class="form-control form-control-sm" placeholder="Judul file" value="<?= set_value('judul_file') ?>" required>
							
						</div>
					</div>
                    <div class="row mt-2">
                        <label class="col-md-3">Video</label>
                        <div class="col-md-9 row">
                            <input type="text" name="video" class="form-control form-control-sm" placeholder="Id video youtube" value="<?= set_value('video') ?>" required>

                        </div>
                    </div>
                    <div class="row mt-2">
                        <label class="col-md-3">Keterangan</label>
                        <div class="col-md-9 row">
                            <input type="text" name="keterangan" class="form-control form-control-sm" placeholder="Keterangan" value="<?= set_value('keterangan') ?>" required>

                        </div>
                    </div>

				</div>
				<div class="card-footer text-center">
					
					<button type="submit" class="btn btn-danger"><i class="fa fa-save"></i> Simpan</button>
				</div>
			</div>
	</div>
</div>
<?= form_close(); ?>

			