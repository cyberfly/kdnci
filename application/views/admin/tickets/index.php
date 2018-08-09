<div class="page-header">
              <h1 class="page-title">
                All Ticket List 
              </h1>
            </div>

            <!-- notification -->

            <?php $this->load->view('templates/notification'); ?>

            <!-- end of notification -->

            <!-- filter -->

            <div class="row">

              <div class="col-4">

              <div class="form-group">
                  <label class="form-label">Subject</label>

                  <!-- dropdown -->

                  <select name="status_id" class="form-control custom-select">

                    <option value="">Select Status</option>

                    <!-- start loop category -->

                          <?php foreach ($statuses as $status) {
                           
                           ?>

                          <option value="<?php echo $status->id; ?>" <?php echo set_select('status_id', $status->id); ?> ><?php echo $status->title; ?></option>


                          <?php } ?>
                    
                  </select>

                  <!-- end dropdown -->
              </div>
                
              </div>
              
            </div>

          
            <!-- filter -->

            <div class="row row-cards row-deck">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Tickets</h3>
                  </div>
                  <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap">
                      <thead>
                        <tr>
                          <th class="w-1">No.</th>
                          <th>Subject</th>
                          <th>Description</th>
                          <th>Submitted By</th>
                          <th>Category</th>
                          <th>Status</th>
                          <th>Created</th>
                          <th>Action</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>

                        <?php

                        if(isset($tickets) && !empty($tickets))
                        {
                          foreach ($tickets as $ticket) {
                          
                        ?>  

                        <tr>
                          <td><span class="text-muted"><?php echo $ticket->id; ?></span></td>
                          <td><a href="invoice.html" class="text-inherit"><?php echo $ticket->subject; ?></a></td>
                          <td>
                            <?php echo $ticket->description; ?>
                          </td>
                          <td>
                            <?php echo $ticket->email; ?>
                          </td>
                          <td>
                            <?php echo $ticket->category_title; ?>
                          </td>
                          <td>
                            <span class="status-icon bg-success"></span> <?php echo $ticket->status_title; ?>
                          </td>
                          <td>
                            <?php echo gov_datetime($ticket->created_at); ?>
                          </td>
                          <td>
                            <a class="btn btn-primary" href="javascript:void(0)">
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

