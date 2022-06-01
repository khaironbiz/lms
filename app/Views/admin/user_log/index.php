
<table class="table table-sm table-striped" id="example1">
    <thead>
        <tr>
            <th>#</th>
            <th>IP</th>
            <th>URL</th>
            <th>Bulan</th>
            <th>Tahun</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $x=1;
        foreach ($user_log as $ul):
            $bulan  = date('m',strtotime($ul['tanggal_updates']));
            $tahun  = date('Y',strtotime($ul['tanggal_updates']));
            ?>
            <tr>
                <td><?= $x++?></td>
                <td>
                    <?= $ul['ip_address']?><br>
                    <?= $ul['tanggal_updates']?>
                </td>
                <td>
                    <?= $ul['username']?><br>
                    <?= $ul['url']?>
                </td>
                <td><?= $bulan?></td>
                <td><?= $tahun?></td>
            </tr>
        <?php
        endforeach;
        ?>
    </tbody>


</table>