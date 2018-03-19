<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en-us">
	<head>
		<meta charset="utf-8">
		<title><?php echo $title;?></title>
		<meta name="description" content="Opensource eBiliing, Client Management, Employee Management Software, Customer Management, Office Staff and House Rent Management Software.">
		<meta name="keywords" content="cable newwork application, ebilling software, client management software, customer management software.">
		<meta name="author" content="Bakul Sinha">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		
		<script type="text/javascript">var base_url = "<?php echo base_url();?>"; </script>
		<?php $base_url = base_url()."assets/_back/";?>
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo $base_url;?>css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo $base_url;?>css/font-awesome.min.css">


		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo $base_url;?>css/smartadmin-production.min.css">
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo $base_url;?>css/smartadmin-skins.min.css">


		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo $base_url;?>css/demo.min.css">

		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo $base_url;?>css/my_style.css">
		<!-- #FAVICONS -->
		<link rel="shortcut icon" href="img/favicon/favicon.ico" type="image/x-icon">
		<link rel="icon" href="img/favicon/favicon.ico" type="image/x-icon">

		<!-- #GOOGLE FONT -->
		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">

		<!-- PACE LOADER - turn this on if you want ajax loading to show (caution: uses lots of memory on iDevices)-->
		<script data-pace-options='{ "restartOnRequestAfter": true }' src="<?php echo $base_url;?>js/plugin/pace/pace.min.js"></script>

		<!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script>
			if (!window.jQuery) {
				document.write('<script src="<?php echo $base_url;?>js/libs/jquery-2.0.2.min.js"><\/script>');
			}
		</script>

		<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
		<script>
			if (!window.jQuery.ui) {
				document.write('<script src="<?php echo $base_url;?>js/libs/jquery-ui-1.10.3.min.js"><\/script>');
			}
		</script>

		<!-- plugin-->
		<script src="<?php echo $base_url;?>/js/plugin/tags/tagmanager.js"></script>
		<link rel="stylesheet" type="text/css" href="<?php echo $base_url;?>/js/plugin/tags/tagmanager.css">

		<!-- EDITOR -->
		<script src="<?php echo $base_url;?>js/plugin/ckeditor/ckeditor.js"></script>
		<!-- COLOR PICKER PLUGIN-->
		<script src="<?php echo $base_url;?>js/plugin/colorpicker/bootstrap-colorpicker.min.js"></script>
		<link rel="stylesheet" type="text/css" href="<?php echo $base_url;?>js/plugin/colorpicker/css/bootstrap-colorpicker.min.css">

		<!--datatable-->
		<script src="<?php echo $base_url;?>/js/plugin/datatables/jquery.dataTables.min.js"></script>
		<script src="<?php echo $base_url;?>/js/plugin/datatables/dataTables.bootstrap.min.js"></script>
		<script src="<?php echo $base_url;?>/js/plugin/datatables/dataTables.tableTools.min.js"></script>

		<!-- by template -->
		<script src="<?php echo $base_url;?>js/plugin/datatables/jquery.dataTables.min.js"></script>
		<script src="<?php echo $base_url;?>js/plugin/datatables/dataTables.colVis.min.js"></script>
		<script src="<?php echo $base_url;?>js/plugin/datatables/dataTables.tableTools.min.js"></script>
		<script src="<?php echo $base_url;?>js/plugin/datatables/dataTables.bootstrap.min.js"></script>
		<script src="<?php echo $base_url;?>js/plugin/datatable-responsive/datatables.responsive.min.js"></script>
		<!--/by template-->

		<!--default-->
		<!-- <script src="<?php echo $base_url;?>/js/plugin/datatable-responsive/jquery.dataTables.min.js"></script>
		<script src="<?php echo $base_url;?>js/plugin/datatable-responsive/dataTables.buttons.min.js"></script>
		<script src="<?php echo $base_url;?>js/plugin/datatable-responsive/buttons.flash.min.js"></script>
		<script src="<?php echo $base_url;?>js/plugin/datatable-responsive/jszip.min.js"></script>
		<script src="<?php echo $base_url;?>js/plugin/datatable-responsive/pdfmake.min.js"></script>
		<script src="<?php echo $base_url;?>js/plugin/datatable-responsive/vfs_fonts.js"></script>
		<script src="<?php echo $base_url;?>js/plugin/datatable-responsive/buttons.html5.min.js"></script>
		<script src="<?php echo $base_url;?>js/plugin/datatable-responsive/buttons.print.min.js"></script>
		<link rel="stylesheet" type="text/css" href="<?php echo $base_url;?>js/plugin/datatable-responsive/jquery.dataTables.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo $base_url;?>js/plugin/datatable-responsive/buttons.dataTables.min.css"> -->
		<!--default-->
		


	</head>
	<body class="">
		<!-- possible classes: minified, fixed-ribbon, fixed-header, fixed-width-->

		<!-- HEADER -->
		<header id="header">
			<!-- <div id="logo-group">
				<span id="logo"> <img src="<?php echo $base_url;?>img/logo.png" alt="Logo"> </span>
			</div> -->
			<div class="logo_text" style="font-size: 16px; text-transform: uppercase; width: auto; margin:10px 0 0 10px;">
				<?php echo isset($settings['app_title'])?$settings['app_title']:'Cable Network App';?>
			</div>

			

			<!-- pulled right: nav area -->
			<div class="pull-right">
				
				<!-- collapse menu button -->
				<div id="hide-menu" class="btn-header pull-right">
					<span> <a href="javascript:void(0);" data-action="toggleMenu" title="Collapse Menu"><i class="fa fa-reorder"></i></a> </span>
				</div>
				<!-- end collapse menu -->
				
			

				<!-- logout button -->
				<div id="logout" class="btn-header transparent pull-right">
					<span> <a href="<?php echo base_url("login/logout");?>" title="Sign Out" data-action="userLogout" data-logout-msg="You can improve your security further after logging out by closing this opened browser"><i class="fa fa-sign-out"></i></a> </span>
				</div>
				<!-- end logout button -->

				<!-- search mobile button (this is hidden till mobile view port) -->
				<div id="search-mobile" class="btn-header transparent pull-right">
					<span> <a href="javascript:void(0)" title="Search"><i class="fa fa-search"></i></a> </span>
				</div>
				<!-- end search mobile button -->

				<!-- input: search field -->
				<form method="get" action="<?php echo base_url($admin_path);?>/client" class="header-search pull-right">
					<input id="search-fld"  type="text" name="txtInput" placeholder="Find clients by ID, Name, Mobile" value="<?php echo isset($_GET['txtInput'])?$_GET['txtInput']:'';?>" style="min-width: 300px;">
					<!-- <input id="search-fld"  type="text" name="txtInput" placeholder="Find clients" data-autocomplete='["ActionScript","AppleScript"]'> -->
					<button type="submit">
						<i class="fa fa-search"></i>
					</button>
					<a href="javascript:void(0);" id="cancel-search-js" title="Cancel Search"><i class="fa fa-times"></i></a>
				</form>
				<!-- end input: search field -->

				<!-- fullscreen button -->
				<div id="fullscreen" class="btn-header transparent pull-right">
					<span> <a href="javascript:void(0);" data-action="launchFullscreen" title="Full Screen"><i class="fa fa-arrows-alt"></i></a> </span>
				</div>
				<!-- end fullscreen button -->
				
				<!-- #Voice Command: Start Speech -->
				<!-- <div id="speech-btn" class="btn-header transparent pull-right hidden-sm hidden-xs">
					<div> 
						<a target="_blank" href="<?php echo base_url(); ?>" title="View Frontend"><i class="fa fa-eye"></i></a> 
					</div>
				</div> -->
				<!-- end voice command -->

				<!-- multiple lang dropdown : find all flags in the flags page -->
				<?php /* ?>
				<ul class="header-dropdown-list hidden-xs">
					<li>
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"> <img src="<?php echo $base_url;?>img/blank.gif" class="flag flag-us" alt="United States"> <span> English (US) </span> <i class="fa fa-angle-down"></i> </a>
						<ul class="dropdown-menu pull-right">
							<li class="active">
								<a href="javascript:void(0);"><img src="<?php echo $base_url;?>img/blank.gif" class="flag flag-us" alt="United States"> English (US)</a>
							</li>
							<li>
								<a href="javascript:void(0);"><img src="<?php echo $base_url;?>img/blank.gif" class="flag flag-bd" alt="Bangali"> Bangali</a>
							</li>													
							
						</ul>
					</li>
				</ul>
				<?php */ ?>
				<!-- end multiple lang -->

			</div>
			<!-- end pulled right: nav area -->

		</header>
		<!-- END HEADER -->