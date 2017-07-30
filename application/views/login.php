<!doctype html>
<html lang="en">
<head>
    <base href="<?=base_url()?>">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Christian Rosandhy">
	<title><?=get_setting("webname")?> - Backend Login</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/alertify.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	 <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body id="login">

	<form action="home/login" class="login-form" method="post">
		<h1>
			<span class="fa fa-user"></span>
		</h1>
		<h2>Aplikasi Monitoring Inventory</h2>
		<p>Please sign in to get access</p>

		<fieldset>
			<div class="padd">
				<input type="text" name="username" id="usrnm" placeholder="Username" class="form-control">
			</div>
			<div class="padd">
				<input type="password" name="password" id="pswd" class="form-control" placeholder="Password">
			</div>
			<div class="padd">
				<button class="btn btn-block btn-lg btn-info">
					<span class="fa fa-sign-in"></span> Sign In
				</button>				
			</div>
		</fieldset>
	</form>

    <script src="js/jquery.js"></script>
    <script src="js/alertify.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <script>
    	$(function(){
    		<?=$this->cms->show_alert()?>
    	});
    </script>
</body>
</html>