<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Verification</title>

    <!-- bootstrap & fontawesome -->
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css');?>" />
    <link rel="stylesheet" href="<?= base_url('assets/font-awesome/4.5.0/css/font-awesome.min.css');?>" />

    <!-- text fonts -->
    <link rel="stylesheet" href="<?= base_url('assets/css/fonts.googleapis.com.css');?>" />

    <!-- ace styles -->
    <link rel="stylesheet" href="<?= base_url('assets/css/ace.min.css');?>" class="ace-main-stylesheet" id="main-ace-style" />

    <link rel="stylesheet" href="<?= base_url('assets/css/ace-skins.min.css');?>" />
    <link rel="stylesheet" href="<?= base_url('assets/css/ace-rtl.min.css');?>" />
    
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f4f6f9;
        }
        .login-container {
            max-width: 400px;
            margin: 100px auto;
            padding: 30px;
            background: white;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .otp-input {
            text-align: center;
            font-size: 20px;
            letter-spacing: 10px;
        }
        .loading {
            display: none;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="login-container">
        <h4 class="text-center text-primary">Login Verification</h4>
        <p class="text-center">Enter the 6-digit OTP code sent to your email</p>
        <p id="alert"></p>
        <form id="otp-form">
            <div class="form-group">
                <input type="hidden" id="email" name="email" class="form-control" value="<?= $email; ?>">
                <input type="text" id="otp-code" name="otp-code" class="form-control otp-input" maxlength="6" placeholder="______" required>
            </div>

            <button type="button" id="sendOTP" class="btn btn-primary btn-block">
                <i class="fa fa-check-circle"></i> Verification
            </button>

            <div class="text-center mt-3">
                <a href="#" id="resend-otp">Resend OTP</a>
            </div>

            <!-- Animasi Loading -->
            <div class="loading text-center mt-3">
                <i class="fa fa-spinner fa-spin"></i> Verifying...
            </div>
        </form>
    </div>
</div>
<!--[if !IE]> -->
<script src="<?= base_url('assets/js/jquery-2.1.4.min.js'); ?>"></script>
<!-- Ace Admin 3 Scripts -->
<script src="<?= base_url('assets/js/bootstrap.min.js'); ?>"></script>

<!-- page specific plugin scripts -->

<!--[if lte IE 8]>
    <script src="<?= base_url('assets/js/excanvas.min.js'); ?>"></script>
<![endif]-->
<script src="<?= base_url('assets/js/jquery-ui.custom.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/jquery.ui.touch-punch.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/bootbox.js'); ?>"></script>
<script src="<?= base_url('assets/js/jquery.easypiechart.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/jquery.gritter.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/spin.js'); ?>"></script>

<!-- ace scripts -->
<script src="<?= base_url('assets/js/ace-elements.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/ace.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/jquery.validate.min.js'); ?>"></script>

<script type="text/javascript">
    $(document).ready(function () {
        let otpCode = $('#otp-code').val();
        let loading = $('.loading');
        var $validation = false;
        $('#sendOTP').on('click', function(e) {
            if ($('#otp-form').valid()) {
                $('#sendOTP').text('wait...'); //change button text
                $('#sendOTP').attr('disabled', true); //set button disable 
                // ajax adding data to database
                $.ajax({
                    url: "<?= base_url('login/checkOTP'); ?>",
                    type: "POST",
                    data: $('#otp-form').serialize(),
                    dataType: "JSON",
                    beforeSend: function(data){
                        // loading.style.display = "block";
                        loading.show();
                    },
                    success: function(data) {
                        if(data.status == "success"){									
                            window.location.href = '<?= base_url('dashboard'); ?>'; 
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
                        $('#sendOTP').text('Login'); //change button text
                        $('#sendOTP').attr('disabled', false); //set button enable 
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Error adding / update data');
                        $('#sendOTP').text('Login'); //change button text
                        $('#sendOTP').attr('disabled', false); //set button enable 
                    }
                });
            } else {
                e.preventDefault();
            }
        });
        /********************************/

        $('#otp-form').validate({
            errorElement: 'div',
            errorClass: 'middle',
            focusInvalid: false,
            ignore: "",
            rules: {
                user_id: {
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

        $('#resend-otp').on('click', function (e) {
            $('#resend-otp').text('wait...').attr('disabled', true); // Change button text & disable

            $.ajax({
                url: "<?= base_url('login/resendOTP'); ?>",
                type: "POST",
                dataType: "JSON",
                beforeSend: function () {
                    $('.loading').show();
                },
                success: function (data) {
                    $('.loading').hide();

                    if (data.status === "success") {
                        // Show Bootbox only with OK button
                        bootbox.alert({
                            message: "OTP code successfully sent back, please check your email!",
                            buttons: {
                                ok: {
                                    label: 'OK',
                                    className: 'btn-primary'
                                }
                            }
                        });
                    }

                    $('#resend-otp').text('Resend OTP').attr('disabled', false); // Re-enable button
                },
                error: function () {
                    $('.loading').hide();
                    alert('Error processing request');
                    $('#resend-otp').text('Resend OTP').attr('disabled', false);
                }
            });
        });

        
    });

</script>

</body>
</html>
