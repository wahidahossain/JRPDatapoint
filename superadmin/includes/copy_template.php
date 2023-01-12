<section class="content">
      <div class="container-fluid">
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Static Templates (Brands)</h3>
            <div class="card-tools">
              <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <form role="form" action="../model/copy_template.php?cd=1" method="POST">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-4">
                      <div class="position-relative p-3 bg-gray-dark">
                        <div class="form-group">
                            <label for="exampleInputEmail1">New Template Name</label>
                            <?php
                            
                            $report_indexes_id = $_REQUEST['report_indexes_id'];
                            ?>
                            <input type="text" name="index_name" class="form-control" placeholder="Enter template name" required>
                            <input type="hidden" value="<?php echo $report_indexes_id;?>" name="report_indexes_id" >
                            
                        </div>
                    </div>
                  </div>                                   
                </div>
              </div>
            </div>
          <div class="card-footer">
            <button type="submit" name="add" value="add" class="btn btn-primary">Add New</button>
          </form>
        </div>  
      </div>
    </section>


