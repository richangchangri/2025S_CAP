<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Login Page - Office Facility Reservation System</title>

		<meta name="description" content="User login page" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css'); ?>" />
		<link rel="stylesheet" href="<?= base_url('assets/font-awesome/4.5.0/css/font-awesome.min.css'); ?>" />

		<!-- text fonts -->
		<link rel="stylesheet" href="<?= base_url('assets/css/fonts.googleapis.com.css'); ?>" />

		<!-- ace styles -->
		<link rel="stylesheet" href="<?= base_url('assets/css/ace.min.css'); ?>" />

		<link rel="stylesheet" href="<?= base_url('assets/css/ace-rtl.min.css'); ?>" />

	</head>

	<body class="login-layout light-login">
		<div class="main-container">
			<div class="main-content">
				<div class="row">
					<div class="col-sm-10 col-sm-offset-1">
						<div class="login-container">
							<div class="center">
								<h1>
									<i class="ace-icon fa fa-building blue"></i>
									<span class="blue">Office Facility</span>
									<span class="grey" id="id-text2">Reservation System</span>
								</h1>
								<!-- <h4 class="blue" id="id-company-text">&copy; Company Name</h4> -->
							</div>

							<div class="space-6"></div>

							<div class="position-relative">
								<div id="login-box" class="login-box visible widget-box no-border">
									<div class="widget-body">
										<div class="widget-main">
											<h4 class="header blue lighter bigger">
												<i class="ace-icon fa fa-user blue"></i>
												Please Enter Your Information
											</h4>
											<span id="alert"></span>
											<div class="space-6"></div>

											<form id="loginForm">
												<fieldset>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="text" class="form-control" name="username" id="username" placeholder="Username" />
															<i class="ace-icon fa fa-user"></i>
														</span>
													</label>

													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="password" class="form-control" name="password" id="password" placeholder="Password" />
															<i class="ace-icon fa fa-lock"></i>
														</span>
													</label>

													<div class="space"></div>

													<div class="clearfix">
														<label class="inline">
															<input type="checkbox" class="ace" />
															<span class="lbl"> Remember Me</span>
														</label>

														<button type="button" id="btnLogin" name="btnLogin" class="width-35 pull-right btn btn-sm btn-primary">
															<i class="ace-icon fa fa-key"></i>
															<span class="bigger-110">Login</span>
														</button>
													</div>

													<div class="space-4"></div>
												</fieldset>
											</form>											
										</div><!-- /.widget-main -->

										<div class="toolbar clearfix">
											<div>
												<a href="#" data-target="#forgot-box" class="forgot-password-link">
													<i class="ace-icon fa fa-arrow-left"></i>
													I forgot my password
												</a>
											</div>

											<div>
												<a href="#" data-target="#signup-box" class="user-signup-link">
													I want to register
													<i class="ace-icon fa fa-arrow-right"></i>
												</a>
											</div>
										</div>
									</div><!-- /.widget-body -->
								</div><!-- /.login-box -->

								<div id="forgot-box" class="forgot-box widget-box no-border">
									<div class="widget-body">
										<div class="widget-main">
											<h4 class="header red lighter bigger">
												<i class="ace-icon fa fa-key"></i>
												Retrieve Password
											</h4>

											<div class="space-6"></div>
											<p id="alert-forgotpassword">
												Enter your email and to receive instructions
											</p>

											<form id="forgotPasswordForm">
												<fieldset>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="email" name="email" class="form-control" placeholder="Email" />
															<i class="ace-icon fa fa-envelope"></i>
														</span>
													</label>

													<div class="clearfix">
														<button type="button" id="btnForgotPassword" class="width-35 pull-right btn btn-sm btn-danger">
															<i class="ace-icon fa fa-lightbulb-o"></i>
															<span class="bigger-110">Send Me!</span>
														</button>
													</div>
												</fieldset>
											</form>
										</div><!-- /.widget-main -->

										<div class="toolbar center">
											<a href="#" data-target="#login-box" class="back-to-login-link">
												Back to login
												<i class="ace-icon fa fa-arrow-right"></i>
											</a>
										</div>
									</div><!-- /.widget-body -->
								</div><!-- /.forgot-box -->

								<div id="signup-box" class="signup-box widget-box no-border">
									<div class="widget-body">
										<div class="widget-main">
											<h4 class="header green lighter bigger">
												<i class="ace-icon fa fa-users blue"></i>
												New User Registration
											</h4>
											<span id="alert_signup"></span>
											<div class="space-6"></div>
											<p> Enter your details to begin: </p>

											<form name="registerForm" id="registerForm">
												<fieldset>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="email" class="form-control" id="email" name="email"  placeholder="Email" autocomplete="off" required />
															<i class="ace-icon fa fa-envelope"></i>
														</span>
													</label>

													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="text" id="fullname" name="fullname" class="form-control" placeholder="Full Name" />
															<i class="ace-icon fa fa-user"></i>
														</span>
													</label>

													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="password" id="password" name="password" class="form-control" placeholder="Password" autocomplete="off" required />
															<i class="ace-icon fa fa-lock"></i>
														</span>
													</label>

													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="password" class="form-control" id="repassword" name="repassword" placeholder="Repeat password" autocomplete="off" required />
															<i class="ace-icon fa fa-retweet"></i>
														</span>
													</label>

													<label class="block">
														<input type="checkbox" id="tos" name="tos" class="ace" required />
														<span class="lbl">
															I accept the
															<a href="#">User Agreement</a>
														</span>
													</label>

													<div class="space-24"></div>

													<div class="clearfix">
														<button type="reset" class="width-30 pull-left btn btn-sm">
															<i class="ace-icon fa fa-refresh"></i>
															<span class="bigger-110">Reset</span>
														</button>

														<button type="button" name="btnRegister" id="btnRegister" class="width-65 pull-right btn btn-sm btn-success">
															<span class="bigger-110">Register</span>

															<i class="ace-icon fa fa-arrow-right icon-on-right"></i>
														</button>
													</div>
												</fieldset>
											</form>
										</div>

										<div class="toolbar center">
											<a href="#" data-target="#login-box" class="back-to-login-link">
												<i class="ace-icon fa fa-arrow-left"></i>
												Back to login
											</a>
										</div>
									</div><!-- /.widget-body -->
								</div><!-- /.signup-box -->
							</div><!-- /.position-relative -->
						</div>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.main-content -->
		</div><!-- /.main-container -->

		<!-- basic scripts -->

		<!--[if !IE]> -->
		<script src="<?= base_url('assets/js/jquery-2.1.4.min.js'); ?>"></script>

		<!-- <![endif]-->

		<!--[if IE]>
<script src="<?= base_url('assets/js/jquery-1.11.3.min.js'); ?>"></script>
<![endif]-->
<script src="<?= base_url('assets/js/jquery.validate.min.js'); ?>"></script>
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($) {
			 $(document).on('click', '.toolbar a[data-target]', function(e) {
				e.preventDefault();
				var target = $(this).data('target');
				$('.widget-box.visible').removeClass('visible');//hide others
				$(target).addClass('visible');//show target
			 });
			});

			$(document).ready(function () {
				var $validation = false;
				$('#btnLogin').on('click', function(e) {
					if ($('#loginForm').valid()) {
						$('#btnLogin').text('wait...'); //change button text
						$('#btnLogin').attr('disabled', true); //set button disable 
						// ajax adding data to database
						$.ajax({
							url: "<?= base_url('login/auth'); ?>",
							type: "POST",
							data: $('#loginForm').serialize(),
							dataType: "JSON",
							success: function(data) {
								if(data.status == "success"){									
									let emailEncoded = encodeURIComponent(data.email);
									window.location.href = "<?= base_url('login/verify'); ?>" + "?email=" + emailEncoded;
								} else {
									$('#alert').html('<div class="alert alert-danger">' +
												'<button type="button" class="close" data-dismiss="alert">' +
												'<i class="ace-icon fa fa-times"></i>' +
												'</button>' +
												'<strong>' +
												'Oh Sorry! ' +
												'</strong>' + data.message + '.' + '<br>' +
												'</div>');
								}
								$('#btnLogin').text('Login'); //change button text
								$('#btnLogin').attr('disabled', false); //set button enable 
							},
							error: function(jqXHR, textStatus, errorThrown) {
								alert('Error adding / update data');
								$('#btnLogin').text('Login'); //change button text
								$('#btnLogin').attr('disabled', false); //set button enable 
							}
						});
					} else {
						e.preventDefault();
					}
				});
				/********************************/

				$('#loginForm').validate({
					errorElement: 'div',
					errorClass: 'middle',
					focusInvalid: false,
					ignore: "",
					rules: {
						username: {
							required: true
						},
						password: {
							required: true
						}
					},
					errorPlacement: function(error, element) {
						error.addClass("help-block");
						if (element.prop("type") === "checkbox" || element.prop("type") === "radio") {
							error.insertAfter(element.parent("label"));
						} else {
							error.insertAfter(element);
						}
					},
					highlight: function(element, errorClass, validClass) {
						$(element).parents('.form-group').addClass('has-error').removeClass('has-success');
					},
					unhighlight: function(element, errorClass, validClass) {
							$(element).parents('.form-group').addClass('has-success').removeClass('has-error');
						}
						/*submitHandler: function(form) {},
						invalidHandler: function(form) {}*/
				});

				$('#btnForgotPassword').on('click', function(e) {
					if ($('#forgotPasswordForm').valid()) {
						$('#btnForgotPassword').text('wait...'); //change button text
						$('#btnForgotPassword').attr('disabled', true); //set button disable 
						// ajax adding data to database
						$.ajax({
							url: "<?= base_url('login/forgotpassword'); ?>",
							type: "POST",
							data: $('#forgotPasswordForm').serialize(),
							dataType: "JSON",
							success: function(data) {
								$('#alert-forgotpassword').html(data.message);
								$('#btnForgotPassword').text('Login'); //change button text
								$('#btnForgotPassword').attr('disabled', false); //set button enable 
							},
							error: function(jqXHR, textStatus, errorThrown) {
								alert('Error adding / update data');
								$('#btnForgotPassword').text('Login'); //change button text
								$('#btnForgotPassword').attr('disabled', false); //set button enable 
							}
						});
					} else {
						e.preventDefault();
					}
				});
				/********************************/

				$('#forgotPasswordForm').validate({
					errorElement: 'div',
					errorClass: 'middle',
					focusInvalid: false,
					ignore: "",
					rules: {
						email: {
							required: true
						}
					},
					errorPlacement: function(error, element) {
						error.addClass("help-block");
						if (element.prop("type") === "checkbox" || element.prop("type") === "radio") {
							error.insertAfter(element.parent("label"));
						} else {
							error.insertAfter(element);
						}
					},
					highlight: function(element, errorClass, validClass) {
						$(element).parents('.form-group').addClass('has-error').removeClass('has-success');
					},
					unhighlight: function(element, errorClass, validClass) {
							$(element).parents('.form-group').addClass('has-success').removeClass('has-error');
						}
						/*submitHandler: function(form) {},
						invalidHandler: function(form) {}*/
				});


				//Register users
				$('#btnRegister').on('click', function(e) {
					if ($('#registerForm').valid()) {
						$('#btnRegister').text('wait...'); //change button text
						$('#btnRegister').attr('disabled', true); //set button disable 
						// ajax adding data to database
						$.ajax({
							url: "<?= base_url('register'); ?>",
							type: "POST",
							data: $('#registerForm').serialize(),
							dataType: "JSON",
							success: function(data) {
								if(data.status == "success"){									
									let emailEncoded = encodeURIComponent(data.email);
									window.location.href = "<?= base_url('login/verify'); ?>" + "?email=" + emailEncoded;
								} else {
									$('#alert_signup').html('<div class="alert alert-danger">' +
												'<button type="button" class="close" data-dismiss="alert">' +
												'<i class="ace-icon fa fa-times"></i>' +
												'</button>' +
												'<strong>' +
												'Oh Sorry! ' +
												'</strong>' + data.message + '.' + '<br>' +
												'</div>');
								}
								$('#btnRegister').html('<span class="bigger-110">Register</span><i class="ace-icon fa fa-arrow-right icon-on-right"></i>'); //change button text
								$('#btnRegister').attr('disabled', false); //set button enable 
							},
							error: function(jqXHR, textStatus, errorThrown) {
								alert('Error adding / update data');
								$('#btnRegister').html('<span class="bigger-110">Register</span><i class="ace-icon fa fa-arrow-right icon-on-right"></i>'); //change button text
								$('#btnRegister').attr('disabled', false); //set button enable 
							}
						});
					} else {
						e.preventDefault();
					}
				});
				/********************************/

				$('#registerForm').validate({
					errorElement: 'div',
					errorClass: 'middle',
					focusInvalid: false,
					ignore: "",
					rules: {
						email: {
							required: true,
							email: true
						},
						fullname:{
							required: true
						},
						password: {
							required: true,
							minlength: 8
						},
						repassword: {
							required: true,
							minlength: 8,
							// equalTo: '[name="password"]' // <- Make sure #password exists
						},
						tos: {
							required: true
						}
					},
					errorPlacement: function(error, element) {
						error.addClass("help-block");
						if (element.prop("type") === "checkbox" || element.prop("type") === "radio") {
							error.insertAfter(element.parent("label"));
						} else {
							error.insertAfter(element);
						}
					},
					highlight: function(element, errorClass, validClass) {
						$(element).parents('.form-group').addClass('has-error').removeClass('has-success');
					},
					unhighlight: function(element, errorClass, validClass) {
							$(element).parents('.form-group').addClass('has-success').removeClass('has-error');
						}
						/*submitHandler: function(form) {},
						invalidHandler: function(form) {}*/
				});
				
			});
			
		</script>
	</body>
</html>
