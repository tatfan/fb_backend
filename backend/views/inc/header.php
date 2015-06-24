<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
        <base href="/public/admin/" />
		<title><?php echo $setting['site_name'] ?>后台管理系统</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<!-- basic styles -->
		<link rel="stylesheet" href="css/bootstrap.min.css" />
		<link rel="stylesheet" href="css/font-awesome.min.css" />
        
        <!-- page specific plugin styles -->
		<link rel="stylesheet" href="css/jquery-ui-1.10.3.full.min.css" />
		<link rel="stylesheet" href="css/datepicker.css" />
        <link rel="stylesheet" href="css/jquery.gritter.css" />
        <link rel="stylesheet" href="css/select2.css" />
		<link rel="stylesheet" href="css/bootstrap-editable.css" />
        <link rel="stylesheet" href="css/colorbox.css" />
        
        <!-- jquery & jquery-ui -->
        <script src="js/jquery-2.0.3.min.js"></script>
        <script src="js/jquery-ui-1.10.3.full.min.js"></script>
        
        <!-- bootstrap -->
        <script src="js/bootstrap.min.js"></script>
        <script src="js/typeahead-bs2.min.js"></script>
        
		<!-- ace settings handler -->
		<script src="js/ace-extra.min.js"></script>
        
        <!-- ace scripts -->
		<script src="js/ace-elements.min.js"></script>
		<script src="js/ace.min.js"></script>
        
        <script src="js/jquery.ui.touch-punch.min.js"></script>
		<script src="js/jquery.slimscroll.min.js"></script>
        
        <script src="js/bootbox.min.js"></script>
        <script src="js/jquery.form.js"></script>
        <script src="js/jquery.cookie.js"></script>
        
        <script src="js/jquery.gritter.min.js"></script>
        <script src="js/jquery.tablesorter.min.js"></script>
        
        <script src="js/jquery.dataTables.min.js"></script>
        <script src="js/jquery.dataTables.bootstrap.js"></script>
        
        <script src="js/jquery.colorbox-min.js"></script>
        
        <script src="js/admin.js"></script>
        
        <script type="text/javascript">
			if("ontouchend" in document) document.write("<script src='js/jquery.mobile.custom.min.js'>"+"<"+"script>");
            $(function(){
                ace.settings.check('navbar', 'fixed');
                ace.settings.check('breadcrumbs', 'fixed');
                ace.settings.check('sidebar', 'fixed');
                ace.settings.check('sidebar', 'collapsed');
                ace.settings.check('main-container', 'fixed');
            });
		</script>
	</head>

	<body>
		<div class="navbar navbar-default" id="navbar">
			<div class="navbar-container" id="navbar-container">
				<div class="navbar-header pull-left">
					<a href="<?php echo ADMINURL ?>" class="navbar-brand">
						<small>
							<i class="icon-home"></i>
							<?php echo $setting['site_name'] ?>后台管理系统
						</small>
					</a><!-- /.brand -->
				</div><!-- /.navbar-header -->

				<?php include_once 'nav.php' ?>
			</div><!-- /.container -->
		</div>

		<div class="main-container" id="main-container">
			<div class="main-container-inner">
				<a class="menu-toggler" id="menu-toggler" href="#">
					<span class="menu-text"></span>
				</a>

				<?php include_once 'left.php' ?>
                