<script>
    // Mengatur waktu akhir perhitungan mundur
    var countDownDate = new Date("<?= $kelas->tanggal_mulai?>").getTime();

    // Memperbarui hitungan mundur setiap 1 detik
    var x = setInterval(function() {

        // Untuk mendapatkan tanggal dan waktu hari ini
        var now = new Date().getTime();

        // Temukan jarak antara sekarang dan tanggal hitung mundur
        var distance = countDownDate - now;

        // Perhitungan waktu untuk hari, jam, menit dan detik
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Keluarkan hasil dalam elemen dengan id = "demo"
        if(days>0){
            document.getElementById("demo").innerHTML = days + "d " + hours + "h "
                + minutes + "m " + seconds + "s ";
        }else if(hours >0){
            document.getElementById("demo").innerHTML = hours + "h "
                + minutes + "m " + seconds + "s ";
        }else if(minutes>0){
            document.getElementById("demo").innerHTML = minutes + "m " + seconds + "s ";
        }else{
            document.getElementById("demo").innerHTML = seconds + "s ";
        }



        // Jika hitungan mundur selesai, tulis beberapa teks
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("demo").innerHTML = "<a href='<?= base_url('kelas/conference/'.$kelas->has_kelas)?>'>View <?= $kelas->tanggal_mulai?></a>";
        }
    }, 1000);
</script>

<table class="table table-sm table-striped mt-3">
    <tr>
        <th>Pretest</th>
        <th class="text-center">
            <a href="<?= base_url(); ?>" class="btn btn-sm btn-warning">Kerjakan</a>
        </th>
    </tr>
    <tr>
        <th>Materi</th>
        <th class="text-center">
            <a href="<?= base_url('kelas/materi/'.$kelas->has_kelas)?>" class="btn btn-sm btn-primary">Detail</a>
        </th>
    </tr>
    <tr>
        <th>Penugasan</th>
        <th class="text-center">
            <a href="<?= base_url()?>" class="btn btn-sm btn-primary">Detail</a>
        </th>
    </tr>
    <tr>
        <th>Posttest</th>
        <th class="text-center">
            <a href="<?= base_url()?>" class="btn btn-sm btn-warning">Kerjakan</a>
        </th>
    </tr>
    <tr>
        <th>Video Conference</th>
        <th><p id="demo" class="text-center text-success text-bold"></p></th>
    </tr>
    <tr>
        <th>Peserta</th>
        <th class="text-center">
            <a href="<?= base_url('/kelas/peserta/'.$kelas->has_kelas)?>" class="btn btn-sm btn-success">Detail</a>
        </th>
    </tr>
</table>