<?php
include ("../../model/connect.php");
?>
<!DOCTYPE html>
<html>
    <head>
    <script type="text/javascript">
    var created = 0;

        function displayAccordingly() {

            if (created == 1) {
                removeDrop();
            }

            //Call mainMenu the main dropdown menu
            var mainMenu = document.getElementById('mainMenu');

            //Create the new dropdown menu
            var whereToPut = document.getElementById('myDiv');
            var newDropdown = document.createElement('select');
            newDropdown.setAttribute('id',"newDropdownMenu");
            whereToPut.appendChild(newDropdown);
            var value = <?php echo $category_code; ?>
            if (mainMenu.value == "value") { //The person chose fruit


                <?php
                    //include ("../model/connect.php");
                    $result = mysqli_query($con, "SELECT brands FROM `inventory` WHERE brands != '' AND brands IS NOT NULL group by (brands); ");                
                    while ($row = mysqli_fetch_array($result))
                {                    
                    $brands = $row['brands'];
                    ?> 
                    // <option value="<?php echo $brands;?>"><?php echo $brands;?></option>
                    <?php
                }
                    ?>

                //Add an option called "Apple"
                var optionApple=document.createElement("option");
                optionApple.text=<?php echo $brands;?>;
                newDropdown.add(optionApple,newDropdown.options[null]);


                    
                   







                // //Add an option called "Banana"
                // var optionBanana=document.createElement("option");
                // optionBanana.text="Banana";
                // newDropdown.add(optionBanana,newDropdown.options[null]);

            } else if (mainMenu.value == "vegetable") { //The person chose vegetabes

                //Add an option called "Spinach"
                var optionSpinach=document.createElement("option");
                optionSpinach.text="Spinach";
                newDropdown.add(optionSpinach,newDropdown.options[null]);

                // //Add an option called "Zucchini"
                // var optionZucchini=document.createElement("option");
                // optionZucchini.text="Zucchini";
                // newDropdown.add(optionZucchini,newDropdown.options[null]);

            }

            created = 1

        }

        function removeDrop() {
            var d = document.getElementById('myDiv');

            var oldmenu = document.getElementById('newDropdownMenu');

            d.removeChild(oldmenu);
        }
    </script>
    </head>
    <body>

    <select id="mainMenu" onchange="displayAccordingly()">
        <option value="">--</option>
        <option value="fruit">Fruit</option>
        <option value="vegetable">Vegetable</option>
        </select>
        <div id="myDiv"></div>

        <select id="mainMenu" onchange="displayAccordingly()">
   <option value="0">- Select -</option>
   <?php 
   // Fetch Department
   $sql_department = "SELECT * FROM `product_code` WHERE `category_code` != ''; ";
   $department_data = mysqli_query($con,$sql_department);
   while($row = mysqli_fetch_assoc($department_data) ){
      $category_code = $row['category_code'];
      $product_desc = $row['product_desc'];      
      // Option
      echo "<option value='".$category_code."' >".$product_desc."</option>";
   }
   ?>
</select>
<div id="myDiv"></div>

        <!-- <select id="mainMenu" onchange="displayAccordingly()">
        <option value="">--</option>
        <option value="fruit">Fruit</option>
        <option value="vegetable">Vegetable</option>
        </select>
        <div id="myDiv"></div> -->
    </body>

</html>
