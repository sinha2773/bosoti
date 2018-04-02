<!DOCTYPE html>
<html lang="en-us" id="extr-page">
<head>
	<meta charset="utf-8">
	<title><?php echo $title;?></title>
	<meta name="description" content="Admin Panel">
	<meta name="author" content="Bakul Sinha">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

	<?php $base_url = base_url()."assets/_back/";?>
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo $base_url;?>css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo $base_url;?>css/font-awesome.min.css">


	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo $base_url;?>css/smartadmin-production.min.css">
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo $base_url;?>css/smartadmin-skins.min.css">


	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo $base_url;?>css/demo.min.css">

	<!-- #FAVICONS -->
	<link rel="shortcut icon" href="img/favicon/favicon.ico" type="image/x-icon">
	<link rel="icon" href="img/favicon/favicon.ico" type="image/x-icon">

	<!-- #GOOGLE FONT -->
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">



</head>

<body class="animated fadeInDown">

	

	<div id="main" role="main">

		<!-- MAIN CONTENT -->
		<div id="content" class="container">

			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-4 col-md-offset-4">
					<div class="well no-padding">
						<?php
						    // Custom form submission message will be populated here
						if ($this->session->flashdata('flashMessage') == TRUE):
							$msgArray = $this->session->flashdata('flashMessage');
							?>
							<div class="alert alert-<?php echo $msgArray[0]; ?>">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<?php echo $msgArray[1]; ?>
							</div>
							<?php
						endif;
						?>
						<form action="<?php echo base_url();?>login/do_login" method="post" id="login-form" novalidate="novalidate" class="smart-form client-form">
							<header>
								Sign In
							</header>

							<fieldset>

								<section>
									<label class="label">E-mail / Member ID</label>
									<label class="input"> <i class="icon-append fa fa-user"></i>
										<input type="text" name="email">
										<b class="tooltip tooltip-top-right"><i class="fa fa-user txt-color-teal"></i> Please enter email address/username</b></label>
									</section>

									<section>
										<label class="label">Password</label>
										<label class="input"> <i class="icon-append fa fa-lock"></i>
											<input type="password" name="password">
											<b class="tooltip tooltip-top-right"><i class="fa fa-lock txt-color-teal"></i> Enter your password</b> </label>
											<div class="note">
												<a href="">Forgot password?</a>
											</div>
										</section>

										<section>
											<label class="checkbox">
												<input type="checkbox" name="remember" checked="">
												<i></i>Stay signed in</label>
											</section>
										</fieldset>
										<footer>
											<button type="submit" class="btn btn-primary">
												Sign in
											</button>
										</footer>
									</form>

								</div>



							</div>
						</div>
					</div>

				</div>

				<!--================================================== -->	

				<script src="<?php echo $base_url;?>js/plugin/pace/pace.min.js"></script>

				<!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->
				<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
				<script> if (!window.jQuery) { document.write('<script src="<?php echo $base_url;?>js/libs/jquery-2.0.2.min.js"><\/script>');} </script>

				<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
				<script> if (!window.jQuery.ui) { document.write('<script src="<?php echo $base_url;?>js/libs/jquery-ui-1.10.3.min.js"><\/script>');} </script>

		<!-- JS TOUCH : include this plugin for mobile drag / drop touch events 		
			<script src="js/plugin/jquery-touch/jquery.ui.touch-punch.min.js"></script> -->

			<!-- BOOTSTRAP JS -->		
			<script src="<?php echo $base_url;?>js/bootstrap/bootstrap.min.js"></script>

			<!-- JQUERY VALIDATE -->
			<script src="<?php echo $base_url;?>js/plugin/jquery-validate/jquery.validate.min.js"></script>

			<!-- JQUERY MASKED INPUT -->
			<script src="<?php //echo $base_url;?>js/plugin/masked-input/jquery.maskedinput.min.js"></script>

		<!--[if IE 8]>
			
			<h1>Your browser is out of date, please update your browser by going to www.microsoft.com/download</h1>
			
		<![endif]-->

		<!-- MAIN APP JS FILE -->
		<script src="<?php //echo $base_url;?>js/app.min.js"></script>

		<script type="text/javascript">
			//runAllForms();

			$(function() {
				// Validation
				$("#login-form").validate({
					// Rules for form validation
					rules : {
						email : {
							required : true,
							email : false
						},
						password : {
							required : true,
							minlength : 3,
							maxlength : 20
						}
					},

					// Messages for form validation
					messages : {
						email : {
							required : 'Please enter your email address',
							email : 'Please enter a VALID email address'
						},
						password : {
							required : 'Please enter your password'
						}
					},

					// Do not change code below
					errorPlacement : function(error, element) {
						error.insertAfter(element.parent());
					}
				});
			});
		</script>

	</body>
	</html>