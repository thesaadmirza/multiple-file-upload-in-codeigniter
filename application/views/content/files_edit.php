<script src="<?= base_url() ?>global/Multifile/js/jQuery.MultiFile.js"></script>

<div class="row">
    <div class="col-sm-3 col-md-2 sidebar">
        <ul class="nav nav-sidebar">
            <li class="active"><a class="btn btn-primary" href="<?= base_url() ?>files/create">Add Files/File</a></li>
            <li><a class="btn btn-success" href="<?= base_url() ?>files">Files lists</a></li>
        </ul>
    </div>
    <div class="col-sm-9 col-sm-offset-3 col-md-6 col-md-offset-2 main">
        <h1 class="page-header">Edit Files</h1>

        <form enctype="multipart/form-data" method="post" action="<?= current_url() ?>">

            <div class="form-group">
                <label for="FileDesc"><?= lang('FileDesc'); ?></label>
                 <textarea type="text" name="FileDesc" class="form-control" id="new_desc"
                    placeholder="Add Desc"><?= set_value('FileDesc', $files->FileDesc) ?></textarea>
                <p class="text-red"><?= form_error('FileDesc'); ?></p>
            </div>

            <div class="form-group">
                <input  id="file" class="form-control" type="file" name="files"  />
                <p class="text-red"><?= form_error('files'); ?></p>
            </div>

            <p>
                <?php if ($files->FileName != "" && file_exists(PUBPATH . "global/uploads/" . $files->FileName)) { ?>
                    <img src="<?= base_url(); ?>global/uploads/<?= $files->FileName; ?>" width="160" height="130" />
                <?php } else { ?>
                    <img src="<?= base_url(); ?>global/admin/images/noImage.jpg" width="160" height="130" />
                <?php } ?>
            </p>

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">save</button>
            </div>


        </form>
    </div>
</div>

