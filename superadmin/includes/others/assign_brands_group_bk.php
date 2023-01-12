<section class="content">
      <div class="container-fluid">
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Add new brands</h3>

            <div class="card-tools">              
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>            
    <form role="form" action="../model/assign_brands_group.php" >
        <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group"> 
                  

                <label>Select Client</label>
                  <div class="select2-purple">
                    <select class="form-control select2bs4 select2-hidden-accessible" name="user_id" data-placeholder="Select a client" style="width: 100%;" data-select2-id="21" tabindex="-1" aria-hidden="true">
                    <?php
                    include ("../model/connect.php");
                    $result = mysqli_query($con, "SELECT user_id, user_excol2 FROM `user` WHERE account_type != 'superadmin' AND user_excol2!='';");                
                    while ($row_user = mysqli_fetch_array($result))
                {                    
                    $user_excol2 = $row_user['user_excol2'];
                    $user_id1 = $row_user['user_id'];
                    ?> 
                    <option value="<?php echo $user_id1;?>"><?php echo $user_excol2;?></option>
                    <?php
                }
                    ?>
                    </select>
                  </div>
                </div>                            
                  
            
<script>
function toggle(source) {
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i] != source)
            checkboxes[i].checked = source.checked;
    }
}
                </script>
            <hr/>                     
              <div class="row rowauto">
                    <div class="col-sm-12">
                        <div class="content">
                        <div class="col-sm-4">
                        <input type="checkbox" onclick="toggle(this);" />Check all?<br />  
                            <?php
                                include ("../model/connect.php");
                                $result = mysqli_query($con, "SELECT brands FROM `inventory` WHERE brands != '' AND brands IS NOT NULL group by (brands); ");  
                                $count_name1 = 0;              
                                while ($row = mysqli_fetch_array($result))
                               { 
                                $count_name1 = $count_name1+1;                  
                                $brands = $row['brands'];
                                $check_name = "check_".$count_name1;
                                ?>                                 
                                    <input type="checkbox" name="brands[]" value="<?php echo $brands;?>"> <?php echo $brands;?> <br>                                                                                            
                                <?php
                               }
                                ?>                                
                               </div>                             
                          </div>                  
                      </div>
                  </div>
            <!-- <div class="row rowauto">
                <div class="col-sm-1">
                    <div class="content" data-toggle="buttons">
                        <label class="btn active checkboxkox">
                            <input type="checkbox" id="check_2" name="check_2" autocomplete="off" checked>
                            <span class="glyphicon glyphicon-ok"></span>
                        </label>
                    </div>                  
                </div>
            </div> -->
        
        <hr/>


                </div>
              </div>
            </div>
          </div> 
          <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>         
          </form>
      </div>
    </section>
