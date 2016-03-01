<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home</title>
	<?php echo'<link href="'.__SITE_PATH.'public/css/main.css" rel="stylesheet">' ?>

	<?php echo'<link href="'.__SITE_PATH.'public/css/bootstrap.min.css" rel="stylesheet">' ?>
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
  
</head><!--/head-->

<body>
	<div class="container text-center">
		<div class="logo-404">
		<?php	echo '<a href="'.__SITE_PATH.'index/index"><img src="images/home/logo.png" alt="" /></a>'; ?>
		</div>
		<div class="content-404">
			<?php echo'<img src="'.__SITE_PATH.'public/images/404/404.png" class="img-responsive" alt="" />'?>
			<h1><b>OPPS!</b> We Couldn’t Find this Page</h1>
			<p>Uh... So it looks like you brock something. The page you are looking for has up and Vanished.</p>
		<?php	echo '<h2><a href="'.__SITE_PATH.'index/index">Bring me back Home</a></h2>' ?>
		</div>
	</div>

  

</body>
</html>