<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="<?= base_url('/admin/tugas_kelas') ?>">List Kelas</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('admin/kelas/skp/'.$kelas->has_kelas)?>" target="_blank">SKP</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('admin/tugas')?>">Jadwal</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('admin/tugas_metode')?>">Materi</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('admin/tugas_metode')?>">Tugas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('admin/tugas_metode')?>">Converence</a>
            </li>
        </ul>
    </div>
</nav>