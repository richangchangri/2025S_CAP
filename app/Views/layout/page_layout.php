<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Office Facility Reservation System</title>

		<meta name="description" content="overview &amp; stats" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css');?>" />
		<link rel="stylesheet" href="<?= base_url('assets/font-awesome/4.5.0/css/font-awesome.min.css');?>" />

		<!-- page specific plugin styles -->
		<link rel="stylesheet" href="<?= base_url('assets/css/jquery-ui.custom.min.css');?>" />
		<link rel="stylesheet" href="<?= base_url('assets/css/fullcalendar.min.css');?>" />

		<!-- text fonts -->
		<link rel="stylesheet" href="<?= base_url('assets/css/fonts.googleapis.com.css');?>" />

		<!-- ace styles -->
		<link rel="stylesheet" href="<?= base_url('assets/css/ace.min.css');?>" class="ace-main-stylesheet" id="main-ace-style" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="assets/css/ace-part2.min.css" class="ace-main-stylesheet" />
		<![endif]-->
		<link rel="stylesheet" href="<?= base_url('assets/css/ace-skins.min.css');?>" />
		<link rel="stylesheet" href="<?= base_url('assets/css/ace-rtl.min.css');?>" />

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->

		<!-- inline styles related to this page -->

		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
		<![endif]-->

		<!-- basic scripts -->

		<!--[if IE]>
			<script src="assets/js/jquery-1.11.3.min.js"></script>
		<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='<?= base_url('assets/js/jquery.mobile.custom.min.js');?>'>"+"<"+"/script>");
		</script>

		<!--[if !IE]> -->
		<script src="<?= base_url('assets/js/jquery-2.1.4.min.js');?>"></script>

		<!-- <![endif]-->

		<script src="<?= base_url('assets/js/bootstrap.min.js');?>"></script>

		<!-- datatables script -->

		<script src="<?= base_url('assets/js/jquery.dataTables.min.js');?>"></script>
		<script src="<?= base_url('assets/js/jquery.dataTables.bootstrap.min.js');?>"></script>
		<script src="<?= base_url('assets/js/dataTables.buttons.min.js');?>"></script>
		<script src="<?= base_url('assets/js/buttons.flash.min.js');?>"></script>
		<script src="<?= base_url('assets/js/buttons.html5.min.js');?>"></script>
		<script src="<?= base_url('assets/js/buttons.print.min.js');?>"></script>
		<script src="<?= base_url('assets/js/buttons.colVis.min.js');?>"></script>
		<script src="<?= base_url('assets/js/dataTables.select.min.js');?>"></script>

		<script src="<?= base_url('assets/js/jquery-ui.custom.min.js');?>"></script>
		<script src="<?= base_url('assets/js/jquery.ui.touch-punch.min.js');?>"></script>
		<script src="<?= base_url('assets/js/jquery.easypiechart.min.js');?>"></script>
		<script src="<?= base_url('assets/js/jquery.sparkline.index.min.js');?>"></script>
		<script src="<?= base_url('assets/js/jquery.flot.min.js');?>"></script>
		<script src="<?= base_url('assets/js/jquery.flot.pie.min.js');?>"></script>
		<script src="<?= base_url('assets/js/jquery.flot.resize.min.js');?>"></script>
		
		<!-- ace scripts -->
		<!-- ace settings handler -->
		<script src="<?= base_url('assets/js/ace-extra.min.js');?>"></script>
		<script src="<?= base_url('assets/js/ace-elements.min.js');?>"></script>
		<script src="<?= base_url('assets/js/ace.min.js');?>"></script>


	</head>

	<body class="no-skin">

			<?= $this->include('layout/navbar') ?>

			<?= $this->include('layout/sidebar') ?>
			
			<?= $this->renderSection('content') ?>
			
			<?= $this->include('layout/footer') ?>

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($) {
			
				/////////////////////////////////////
				$(document).one('ajaxloadstart.page', function(e) {
					$tooltip.remove();
				});
			
			})
		</script>

		
	</body>
</html>
