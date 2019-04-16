<div class="page-header">
              <h1 class="page-title">
                Ticket List

                <a class="btn btn-primary" href="<?php echo site_url('ticket/create'); ?>">Create Ticket</a>
              </h1>
            </div>

            <!-- notification -->

            <?php $this->load->view('templates/notification'); ?>

            <!-- end of notification -->

            <div class="row row-cards row-deck">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Tickets</h3>
                  </div>
                  <div class="">
                    <table id="datatable" class="table card-table table-vcenter text-nowrap">
                      <thead>
                        <tr>
                          <th class="w-1">Id</th>
                          <th>Subject</th>
                          <th>Description</th>
                          <th>Category</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      
                    </table>
                  </div>
                </div>
              </div>
            </div>

