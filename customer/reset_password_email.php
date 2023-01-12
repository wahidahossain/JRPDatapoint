
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>JRP Datapoint | Password</title>

  <?php
  include("includes/css.php");
  ?>
<style>
html,body { height: 100%; }

body{
	display: -ms-flexbox;
	display: -webkit-box;
	display: flex;
	-ms-flex-align: center;
	-ms-flex-pack: center;
	-webkit-box-align: center;
	align-items: center;
	-webkit-box-pack: center;
	justify-content: center;
	background-color: #f5f5f5;
}

form{
	padding-top: 10px;
	font-size: 14px;
	margin-top: 30px;
}

.card-title{ font-weight:300; }

.btn{
	font-size: 18px;
	margin-top:20px;
}

.login-form{ 
	width:620px;
	margin:50px;
}

.sign-up{
	text-align:center;
	padding:20px 0 0;
}

span{
	font-size:14px;
}

</style>


</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="card login-form">
	<div class="card-body">
		<h3 class="card-title text-center">Reset password</h3>
		<form role="form" action="../model/reset_password_email.php" method="post">
		<div class="form-group">
            <?php
            //$user_excol2 = $_REQUEST['user_excol2'];
            ?>
                  <label for="exampleInputPassword1">E-mail Address</label>
                    <input type="email" name="email" class="form-control" id="pwdId" placeholder="e.g. abc@abc.com" required>                  
                  </div>
                  <div class="form-group">
                  <label for="exampleInputPassword1">JRP Account No.</label>
                    <input type="text" name="user_excol2" class="form-control" placeholder="e.g. ABC00123" required>
                    
                  </div>
                </div>
                <div class="card-footer">
                <button type="submit" class="btn btn-primary">Send</button>
                </div>
	</div>
    </form>
</div>



<!-- password_validator -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>  
<script src="dist/js/password_validator.js"></script>


</body>



</html>


