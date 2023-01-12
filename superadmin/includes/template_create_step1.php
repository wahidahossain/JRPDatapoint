<section class="content">
      <div class="container-fluid">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Create New Static Template (Product Category)</h3>

            <div class="card-tools">              
              <!-- <button type="button" class="btn btn-tool" data-card-widget="remove"> -->
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>            
    <form role="form" action="../model/template_create_step1.php" method="POST">
    <div class="card-body">
                  <div class="row">
                    <div class="col-sm-4">
                      <div class="position-relative p-3 bg-gray-dark" >
                      <div class="form-group">
                        <label for="exampleInputEmail1">Template Name</label>
                        <input type="text" name="index_name" class="form-control" placeholder="Enter template name" required>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-4">
                      <div class="position-relative p-3 bg-gray-dark" >
                      <div class="form-group">
                        <label for="exampleInputEmail1">Existing Templates</label>
                        <?php
                        include ("../model/connect.php");
                        $result2 = mysqli_query($con, "SELECT `index_name`,`report_indexes_id` FROM `report_indexes` WHERE `flag`='1'");                
                        while($row1 = mysqli_fetch_array($result2)){
                         $index_name = $row1['index_name'];
                         $report_indexes_id = $row1['report_indexes_id'];
                        echo "<div class='text-warning'><a href='template_create_step_edit.php?index_name=".$index_name."&report_indexes_id=".$report_indexes_id."'><i class='nav-icon fas fa-edit'></i> ".$index_name. "</a></div>";
                        }
                        ?>
                      </div>
                    </div>
                </div>
              </div>
            </div>
          <div class="card-footer">
            <button type="submit" name="add" value="add" class="btn btn-primary">Add New</button>
              <!-- <a href="new_assignment_clients_e.php?user_excol2=<?php //echo $user_excol2;?>" name="edit" class="btn btn-primary">Edit</a>  -->
                  <!-- <button type="submit" name="edit" value="edit" class="btn btn-primary">Edit</button>  -->
                  </form>

                </div>         
          
          <div class="card-footer">
                  
                </div>
      </div>
    </section>


