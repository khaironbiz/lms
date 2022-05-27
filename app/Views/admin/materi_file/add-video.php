<?php
use App\Models\Materi_file_model;
$m_materi_file      		= new Materi_file_model();
?>
<div class="row">
    <div class="col-md-6">
        <a href="<?= base_url('admin/video/add/'.$materi['has_materi'])?>" class="btn btn-sm btn-primary mb-2">Video Baru</a>
        <?= form_open(base_url('admin/materi_file/addvideo/'.$materi['has_materi']));
        echo csrf_field();
        ?>
        <table class="table table-bordered table-sm" id="example4">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul Video</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $x= 1;

                foreach ($video as $video):
                    $id_materi                  = $materi['id_materi'];
                    $id_video                   = $video['id_video'];
                    $count_id_video_id_materi 	= $m_materi_file->count_id_video_id_materi($id_video, $id_materi);
            ?>
                <tr>
                    <td><?= $x++; ?></td>
                    <td>

                        <?php
                        if($count_id_video_id_materi>0){
                            echo $video['judul'];
                        }else{
                            ?>
                            <input type="radio" name="id_video" value="<?= $video['id_video']?>">
                            <?= $video['judul'] ?>
                            <?php
                        }
                        ?>
                    </td>
                </tr>
            <?php
            endforeach;
            ?>
            </tbody>

        </table>

        <a href="<?= base_url('admin/materi/detail/'.$materi['has_materi'])?>" class="btn btn-sm btn-danger">Back</a>
        <button type="submit" class="btn btn-sm btn-primary">Save</button>
        <?= form_close(); ?>
    </div>

</div>