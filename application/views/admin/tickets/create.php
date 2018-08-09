<div class="row">
  <div class="col-lg-12">
              <form class="card" action="<?php echo site_url('ticket/create'); ?>" method="POST">
                <div class="card-body">
                  <h3 class="card-title">Create Ticket</h3>
                  <div class="row">
                    
                  <!-- subject field -->

                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="form-label">Subject</label>
                        <input type="text" name="subject" class="form-control <?php if(form_error('subject')){ echo 'is-invalid'; } ?>" placeholder="" value="<?php echo set_value('subject'); ?>">
                        <?php echo form_error('subject', '<div class="invalid-feedback">', '</div>'); ?>
                      </div>
                    </div>

                    <!-- category field -->
                    
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="form-label">Category</label>
                        <select name="category_id" class="form-control custom-select <?php if(form_error('category_id')){ echo 'is-invalid'; } ?>">
                          
                          <option value="">Select Category</option>

                          <!-- start loop category -->

                          <?php foreach ($categories as $category) {
                           
                           ?>

                          <option value="<?php echo $category->id; ?>" <?php echo set_select('category_id', $category->id); ?> ><?php echo $category->title; ?></option>


                          <?php } ?>

                          <!-- end loop category -->


                        </select>
                        <?php echo form_error('category_id', '<div class="invalid-feedback">', '</div>'); ?>
                      </div>
                    </div>

                    <!-- attachment field -->

                    <div class="col-md-4">

                      <div class="form-group">
                        <div class="form-label">Attachment</div>
                        <div class="custom-file">
                          <input name="attachment" type="file" class="custom-file-input" >
                          <label class="custom-file-label">Choose file</label>
                        </div>
                      </div>

                    </div>

                    <!-- description field -->


                    <div class="col-md-12">
                      <div class="form-group mb-0">
                        <label class="form-label">Description</label>
                        <textarea name="description" rows="5" class="form-control <?php if(form_error('description')){ echo 'is-invalid'; } ?>" placeholder="Here can be your description"><?php echo set_value('description'); ?></textarea>
                        <?php echo form_error('description', '<div class="invalid-feedback">', '</div>'); ?>
                      </div>
                    </div>

                    <!--  -->

                  </div>
                </div>
                <div class="card-footer text-right">
                  <button type="submit" class="btn btn-primary">Submit Ticket</button>
                </div>
              </form>
            </div>
</div>
