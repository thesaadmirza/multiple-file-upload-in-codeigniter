
<div class="row">
    <div class="col-sm-3 col-md-2 sidebar">
        <ul class="nav nav-sidebar">
            <li class="active"><a class="btn btn-primary" href="<?= base_url() ?>files/create">Add Files/File</a></li>
            <li><a class="btn btn-success" href="<?= base_url() ?>files">File lists</a></li>
        </ul>
    </div>
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h1 class="page-header">Dashboard</h1>


        <div class="table-responsive table-bordered" >
            <!-- Notification boxes -->
            <?php if($this->session->flashdata('success_msg')){ ?>
                <p class="alert alert-info">
                    <?php echo $this->session->flashdata('success_msg'); ?>
                </p>
            <?php } ?>
            <?php if ($files == FALSE) : ?>
                <p class="alert alert-danger"><a href="javascript:void(0)" class="close"></a><b>Alert!</b > no Files available<p>
            <?php else : ?>
                <form method="post" action="<?= base_url() ?>files/operation/">
                    <!-- Example table -->
                    <table class="table table-striped" cellspacing="0" cellpadding="0" border="0">
                        <thead>
                        <tr>
                            <th class="center-block">
                                <input type="checkbox" onclick="$('input[name*=\'checkAll\']').prop('checked', this.checked);">
                            </th>
                            <th>#</th>
                            <th><?= lang('FileDesc'); ?></th>
                            <th><?= lang('image'); ?></th>
                            <th><?= lang('CreatedAt'); ?></th>
                            <th><?= lang('options'); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $x = 1;
                        foreach ($files as $ph) : ?>
                            <tr>
                                <td class="text-center"><input type="checkbox" name="checkAll[]" value="<?= $ph['FileId']; ?>"></td>
                                <td><?= $x; ?></td>
                                <td>
                                    <?php if ($ph['FileName'] != "" && file_exists(PUBPATH . "global/uploads/" . $ph['FileName'])) { ?>
                                        <img src="<?= base_url(); ?>global/uploads/<?= $ph['FileName']; ?>" width="80" height="50" />
                                    <?php } else { ?>
                                        <img src="<?= base_url(); ?>global/admin/images/noImage.jpg" width="80" height="50" />
                                    <?php } ?>
                                </td>
                                <td><?= $ph['FileDesc'] ?></td>
                                <td><?= date('d-m-Y', $ph['CreatedAt']); ?></td>
                                <td class="text-center">
                                    <a href="<?= base_url() ?>files/edit/<?= $ph['FileId']; ?>"
                                       data-toggle="tooltip" class="btn btn-primary" data-original-title="edit ">
                                        <i class="fa fa-edit fa-o"></i>
                                    </a>

                                    <a href="<?= base_url() ?>files/remove/<?= $ph['FileId']; ?>"
                                       data-toggle="tooltip" title="" class="btn btn-danger"
                                       onclick="return confirm('Do you want Delete?');"
                                       data-original-title="remove"> <i class="fa fa-trash fa-o"></i>
                                    </a>

                                </td>

                            </tr>
                            <?php $x++; endforeach; ?>
                        </tbody>
                    </table>


                </form>
            <?php endif; ?>
        </div>
    </div>
</div>
