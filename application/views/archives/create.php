<div class="row">
    <div class="col-lg-12">
        <form class="card" action="<?php echo site_url('archive/create'); ?>" method="POST">
            <div class="card-body">
                <h3 class="card-title">Backup Database</h3>
                <div class="row">

                    <!-- backup_filename field -->

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Backup name</label>
                            <input type="text" name="backup_filename"
                                   class="form-control <?php if (form_error('backup_filename')) {
                                       echo 'is-invalid';
                                   } ?>" placeholder="" value="<?php echo set_value('backup_filename'); ?>">
                            <?php echo form_error('backup_filename', '<div class="invalid-feedback">', '</div>'); ?>
                        </div>
                    </div>

                    <!-- category field -->


                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Include Tables</label>

                            <ul>

                            <?php foreach ($table_list as $table) {

                                ?>

                            <li>

                                <input type="checkbox" name="include_tables[]" checked="checked" value="<?php echo $table; ?>" > <?php echo $table; ?>

                            </li>
                            <?php } ?>

                            </ul>

                            <?php echo form_error('include_tables', '<div class="invalid-feedback">', '</div>'); ?>
                        </div>
                    </div>


                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Ignore Tables</label>
                            <ul>
                            <?php foreach ($table_list as $table) {

                                ?>
                                <li>
                                    <input type="checkbox" name="ignore_tables[]" value="<?php echo $table; ?>" > <?php echo $table; ?>

                                </li>
                            <?php } ?>
                            </ul>
                            <?php echo form_error('ignore_tables', '<div class="invalid-feedback">', '</div>'); ?>
                        </div>
                    </div>

                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary">Backup Now</button>
                </div>
        </form>
    </div>
</div>
