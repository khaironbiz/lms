<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-2">
    <a class="navbar-brand" href="<?= base_url('admin/event')?>">Event</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
        <li class="nav-item active">
            <a class="nav-link" href="<?= base_url('admin/kelas')?>">Kelas<span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="<?= base_url('admin/kategori_kelas')?>">Kategori Kelas<span class="sr-only">(current)</span></a>
        </li>
            <li class="nav-item active">
                <a class="nav-link" href="<?= base_url('admin/metode_belajar')?>">Metode Belajar<span class="sr-only">(current)</span></a>
            </li>

        </ul>
    </div>
</nav>