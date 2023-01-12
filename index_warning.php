<!DOCTYPE html>
<html lang="en"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>JRP Datapoint</title>
    <link rel="stylesheet" href="index/unplug-ui-kit.css">
    <link rel="stylesheet" href="index/unplug-ui-kit-demo.css">
    <link rel="stylesheet" href="index/materialdesignicons.css">
</head>


<body>
    <main class="auth">
        <div class="container-fluid">
            <div class="row vh-100">
                <div class="col-md-6 text-center d-flex flex-column justify-content-center auth-bg-section text-white" style="background-image: url(index/register-bg.jpg)">
                    <h1 class="text-reset">Welcome to <br> JRP Datapoint</h1>
                    <p class="font-weight-bold text-reset">Please enter login information</p>
                </div>
                <div class="col-md-6 text-center d-flex flex-column justify-content-center">
                    <div class="auth-form-section">
                        <div class="logo"><img src="index/logo.png" class="img-fluid" alt="Unplug UI" width="200"></div>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        Please login first!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <h2>Login In</h2>
                        
                                                
                        <form id="login-form" class="form" method="post" action="model/login.php">
								<div class="form-group">
									<input type="text" name="username" placeholder="Username" id="username" class="form-control" required>
								</div>
								<div class="form-group">
									<input  type="password" name="password" placeholder="Password" id="password" class="form-control" required>
								</div>
								<div class="form-group">
									<input type="submit" name="submit" class="btn btn-info btn-md" value="Submit">
								</div>
								
							</form>
                        <p class="text-left mb-0">Forgot your password? <a href="#">Reset It</a> </p>
                    </div>
                </div>
            </div>
        </div>
    </main>
   

</body></html>