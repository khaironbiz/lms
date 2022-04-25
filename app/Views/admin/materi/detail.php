<div class="row">
    <div class="col-md-6">
        
        <div class="card">
            <div class="card-header">
                <b>Detail Kegiatan</b>
            </div>
            <div class="card-body">
                <div class="row">
                    <label class="col-sm-2">Acara</label>
                    <div class="col-sm-10">
                        <?= $materi['judul_berita']?>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-2">Topik</label>
                    <div class="col-sm-10">
                        <?= $materi['materi']?>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-2">Pemateri</label>
                    <div class="col-sm-10">
                        <?= $materi['nama']?>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-2">Waktu Mulai</label>
                    <div class="col-sm-10">
                        <?= $materi['waktu_mulai']?>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-2">Waktu Selesai</label>
                    <div class="col-sm-10">
                        <?= $materi['waktu_selesai']?>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <b>Bahan Ajar</b>
            </div>
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-6">
                        <a href="#" class="btn btn-sm btn-primary">Tambah Media File</a>
                    </div>
                    <div class="col-6 text-right">
                        <a href="#" class="btn btn-sm btn-danger">Tambah Media Video</a>
                    </div>
                </div>
                <table class="table table-sm table-striped">
                    <tr>
                        <th>#</th>
                        <th>Nama File</th>
                        <th>Jenis File</th>
                        <th>Hit</th>
                    </tr>
                </table>
            </div>
        </div>
        
    </div>
</div>