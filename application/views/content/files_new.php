<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js" type="text/javascript" language="javascript"></script>

<script src="<?= base_url() ?>global/Multifile/js/jQuery.MultiFile.js"></script>

<div class="row">
    <div class="col-sm-3 col-md-2 sidebar">
        <ul class="nav nav-sidebar">
            <li class="active"><a class="btn btn-primary" href="<?= base_url() ?>files/create">Add Files/File</a></li>
            <li><a class="btn btn-success" href="<?= base_url() ?>files">File lists</a></li>
        </ul>
    </div>
    <div class="col-sm-9 col-sm-offset-3 col-md-6 col-md-offset-2 main">
        <h1 class="page-header">Add File</h1>

        <form enctype="multipart/form-data" method="post" action="<?= current_url() ?>">

            <div class="form-group">
                <label class="form-control-label" for="FileDesc"><?= lang('FileDesc'); ?></label>
                 <textarea  name="FileDesc" class="form-control" id="new_desc"><?= set_value('FileDesc') ?> </textarea>
                <p class="text-red"><?= form_error('FileDesc'); ?></p>
            </div>

            <div class="form-group">
                <input id="file" multiple="multiple" class="form-control multi with-preview" type="file" name="files[]" maxlength="2"/>
                <p class="text-red"><?= form_error('files'); ?></p>
            </div>

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">save</button>
            </div>


        </form>
    </div>
</div>


