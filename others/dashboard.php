<?php
session_start();
if(!isset($_SESSION['IS_LOGIN'])){
	?>
	<script>
		window.location.href='index.php';
	</script>
	<?php
}else{
	?>
	<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="robots" content="noindex, nofollow">
		<title>Login Form</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
	</head>
	<body>
		<div class="container">
			<div>&nbsp;</div>
			<div class="  d-flex flex-row align-items-center justify-content-between">
				<div class="">
					<a href="logout.php"><button type="button" class="btn btn-sm btn-primary"  ><i class="fas fa-plus" ></i> Logout
					</button></a>
				</div>
			</div>
			<div>&nbsp;</div>
			<div class="row ">
				<table id="" class="table table-bordered">
					<thead>
						<tr>
							<th class="text-center">No</th>
							<th>Username</th>
							<th>Password</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="text-center">1</td>
							<td>admin</td>
							<td class="text-center">1234</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div> 
	</body>
	<?php
}
?> 
