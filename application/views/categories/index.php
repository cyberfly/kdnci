<div class="page-header">
              <h1 class="page-title">
                Category List

                <a class="btn btn-primary" href="<?php echo site_url('ticket/create'); ?>">Create Ticket</a>
              </h1>
            </div>

            <!-- notification -->

            <?php $this->load->view('templates/notification'); ?>

            <!-- end of notification -->

            <!--search form-->

            <form action="<?php echo site_url('category/index'); ?>" method="GET" >
                <div class="form-row">

                    <div class="form-group col-md-4">
                        <label>Kata Kunci</label>

                        <div class="input-group">
                            <input type="text" value="<?php echo $this->input->get('search'); ?>" name="search" class="form-control">
                        </div>

                    </div>

                    <div class="form-group col-md-2">

                    </div>

                    <div class="form-group col-md-3">

                    </div>

                    <div class="form-group col-md-2">

                        <label>Tindakan</label>

                        <div class="input-group">
                            <button type="submit" class="btn btn-primary">Cari</button>
                            <input type="reset" class="btn btn-warning" />
                        </div>

                    </div>

                </div>

            </form>

            <!--end of search form-->

            <div class="row row-cards row-deck">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Categories</h3>
                  </div>
                  <div class="table-responsive">
                    <table id="datatable" class="table card-table table-vcenter text-nowrap">
                      <thead>
                        <tr>
                          <th class="w-1">Id.</th>
                          <th>Title</th>
                          <th>Description</th>
                          <th>Action</th>
                      
                        </tr>
                      </thead>
                      <tbody>

                        <?php

                        if(isset($categories) && !empty($categories))
                        {
                          foreach ($categories as $category) {
                          
                        ?>  

                        <tr>
                          <td>
                            <?php echo $category->id; ?>
                          </td>
                          <td>
                            <?php echo $category->title; ?>
                          </td>
                          <td>
                              <?php echo $category->description; ?>
                          </td>
                          <td>
                            <a class="btn btn-primary" href="<?php echo site_url('category/edit/' . $category->id . '?' . http_build_query($this->input->get())) ?>">
                              <i class="fe fe-edit"></i> Edit
                            </a>
                          </td>
                        </tr>

                        <?php } } ?>

                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

