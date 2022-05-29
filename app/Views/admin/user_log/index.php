<table class="table table-sm table-striped" id="example1">
    <thead>
        <tr>
            <th>#</th>
            <th>IP</th>
            <th>URL</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $x=1;
        foreach ($user_log as $ul):
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
            </tr>
        <?php
        endforeach;
        ?>
    </tbody>


</table>