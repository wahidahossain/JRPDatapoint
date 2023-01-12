<section class="content">
      <div class="container-fluid">
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Warehouse Setup</h3>

            <div class="card-tools">              
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>            
   
      <div class="card-body">
      <form role="form" action="../model/filter_warehouse.php" method="GET">
      <div class="card-footer">
                  <button type="submit" value="load" name="load" class="btn btn-primary">Load</button>
      </div>
      <h3 class="card-title">Filtered Warehouse List</h3>                
      <table id="example1" class="table table-bordered ">
                <?php 
                include("../model/connect.php");                  
                
                $sql = "select * from warehouse";                                         
                               
                //SELECT CODE, ONHAND, INV_COMMITTED from "INVENTORY" where CODE = '03382410'
                //$sql = iconv('UTF-8','ISO-8859-1',$test_qry); 
                $result = mysqli_query($con, $sql);
                //$sql = iconv('UTF-8','ISO-8859-1',$sql);  
                // while (odbc_fetch_row($result)) {
                //     $brand = odbc_result($result, "brand");
                    
                
                $i = 0;
                    while ($row = mysqli_fetch_array($result)) {
                      $flag = $row['flag'];
                        $WHSE = $row['warehouse'];
                        $WHSE_DESCRIPTION = $row['description'];
                        if($i == 0) {
                          if($flag == '1') {                         
                            echo "<tr><td><input type='checkbox' class='color-check' checked name='warehouse[]' value=".$WHSE."> " . $WHSE  .": ". $WHSE_DESCRIPTION  . "<img src='dist/img/select.png' alt='AdminLTELogo' height='20' width='20'> </td>";
                          }
                          else{
                            echo "<tr><td><input type='checkbox' class='color-check' name='warehouse[]' value=".$WHSE."> " . $WHSE  .": ". $WHSE_DESCRIPTION  . "</td>";
                          }
                            $i++;
                        } elseif ($i == 1) {
                          if($flag == '1') {   
                            echo "<td><input type='checkbox' class='color-check' checked name='warehouse[]' value=".$WHSE."> " . $WHSE  .": ". $WHSE_DESCRIPTION  ."<img src='dist/img/select.png' alt='AdminLTELogo' height='20' width='20'></td>";
                          }
                          else{
                            echo "<td><input type='checkbox' class='color-check' name='warehouse[]' value=".$WHSE."> " . $WHSE  .": ". $WHSE_DESCRIPTION  ."</td>";
                          }
                            $i++;
                        } elseif($i == 2) {
                          if($flag == '1') {  
                            echo "<td><input type='checkbox' class='color-check' checked name='warehouse[]' value=".$WHSE."> ". $WHSE  .": ". $WHSE_DESCRIPTION  ."<img src='dist/img/select.png' alt='AdminLTELogo' height='20' width='20'></td></td>";
                          }
                          else{
                            echo "<td><input type='checkbox' class='color-check' name='warehouse[]' value=".$WHSE."> ". $WHSE  .": ". $WHSE_DESCRIPTION  ."</td></td>";
                          }
                            $i = 0;
                        }

                    }
                    ?>
                </table>
                <div class="card-footer">
                  <button type="submit" value="update" name="update" class="btn btn-primary">Update</button>
                </div>         
          </form>
                </div>        
    </section>
    <script type="text/javascript">
    $(".submit").click(function(){
         if($('.color-check').filter(':checked').length < 1){
                alert("Please Check at least one Color Box");
                 return false;
         }else{
             alert("Proceed");
         }
    });
</script>

    


