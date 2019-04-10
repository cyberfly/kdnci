<div class="row">
  <div class="col-lg-12">
              <form class="card" action="<?php echo site_url('scanocr/create'); ?>" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                  <h3 class="card-title">Scan Ocr</h3>
                  <div class="row">
                    
                  <!-- subject field -->

                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="form-label">Subject</label>
                        <input type="text" name="subject" class="form-control <?php if(form_error('subject')){ echo 'is-invalid'; } ?>" placeholder="" value="<?php echo set_value('subject'); ?>">
                        <?php echo form_error('subject', '<div class="invalid-feedback">', '</div>'); ?>
                      </div>
                    </div>

                    <!-- attachment field -->

                    <div class="col-md-4">

                      <div class="form-group">
                        <div class="form-label">File to Scan</div>
                        <div class="custom-file">
                          <input name="scan_file" type="file" class="custom-file-input" >
                          <label class="custom-file-label">Choose file</label>
                        </div>
                          <?php echo form_error('scan_file', '<div class="invalid-feedback">', '</div>'); ?>
                      </div>

                    </div>

                      <div class="col-md-12">
                          <div class="form-group">
                              <div class="card-footer text-right">
                                  <button type="submit" class="btn btn-primary">Preview</button>
                              </div>
                          </div>
                      </div>

                    <!-- description field -->


                    <div class="col-md-12">
                      <div class="form-group mb-0">
                        <label class="form-label">Scan Text</label>
                        <textarea name="description" rows="5" class="form-control <?php if(form_error('description')){ echo 'is-invalid'; } ?>" placeholder="Preview of scan text"><?php echo $scan_text; ?></textarea>
                        <?php echo form_error('description', '<div class="invalid-feedback">', '</div>'); ?>
                      </div>
                    </div>

                    <!--  -->

                  </div>
                </div>
                <div class="card-footer text-right">
                  
                </div>
              </form>
            </div>
</div>
