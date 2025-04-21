<?= $this->extend('layout/page_layout') ?>

<?= $this->section('content') ?>

<div class="main-content">
    <div class="main-content-inner">
        <div class="page-content">
            <div class="page-header">
                <h1>
                    Feedback
                    <small><i class="ace-icon fa fa-angle-double-right"></i> Reservation #<?= $facility['facilities_name'] ?></small>
                </h1>
            </div><!-- /.page-header -->

            <div class="row">
                <div class="col-md-6">
                    <span id="alert"></span>
                    <form class="form-horizontal" role="form" name="formSubmit" id="formSubmit">
                        <?= csrf_field() ?>
                        <div class="form-group">
                            <p class="text-muted">Please rate your experience with the facility you reserved. 1 star = bad, 5 stars = gorgeous.</p>
                            <label for="rating">Rating</label>
                                <input type="hidden" name="rating" id="rating">
                                <div class="rating inline"></div>
                                <div class="hr hr-16 hr-dotted"></div>
                        </div>

                        <div class="form-group">
                            <label for="feedback">Feedback</label>
                            <input id="user_id" name="user_id" type="hidden" class="form-control" value="<?php  $session = session();  echo $session->get('user_id'); ?>" >
                            <input id="reservation_id" name="reservation_id" type="hidden" class="form-control" value="<?php  echo $reservation_id; ?>" >
                            <textarea name="feedback" id="feedback" class="form-control" rows="4" placeholder="Write your comment here..." required></textarea>
                        </div>

                        <div class="space-4"></div>
                        <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9">
                                <button class="btn btn-success" type="button" name="btnSubmit" id="btnSubmit">
                                    <i class="fa fa-paper-plane"></i>
                                    Submit
                                </button>

                                &nbsp; &nbsp; &nbsp;
                                <a class="btn" type="reset" href="<?= base_url('reservation'); ?>">
                                    <i class="ace-icon fa fa-undo bigger-110"></i>
                                    Cancel
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div><!-- /.page-content -->
    </div>
</div>
<script src="<?= base_url('assets/js/jquery.validate.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/jquery.raty.min.js'); ?>"></script>
<script type="text/javascript">
    $(document).ready(function() {			
        	

        $('.rating').raty({
					'cancel' : true,
					'half': true,
					'starType' : 'i',
                    'click': function(score, evt) {
                        $('#rating').val(score);
                    }
				});

        $('#btnSubmit').on('click', function(e) {
            // let reservationId = $('#reservation_id').val();

            if ($('#formSubmit').valid()) {
                $('#btnSubmit').text('wait...'); //change button text
                $('#btnSubmit').attr('disabled', true); //set button disable 
                // ajax adding data to database
                $.ajax({
                    url: "<?= base_url('reservation/submit_feedback'); ?>",
                    type: "POST",
                    data: $('#formSubmit').serialize(),
                    dataType: "JSON",
                    success: function(data) {
                        $('#alert').html(data.message);
                        $('#btnSubmit').html('<i class="ace-icon fa fa-check bigger-110"></i>Submit'); 
                        $('#btnSubmit').attr('disabled', false); //set button enable 
                        setTimeout(function() {
                            window.location.href = '<?= base_url('reservation'); ?>';
                        }, 3000);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Error adding / update data');
                        $('#btnSubmit').html('<i class="ace-icon fa fa-check bigger-110"></i>Submit'); //change button text
                        $('#btnSubmit').attr('disabled', false); //set button enable 
                    }
                });
            } else {
                e.preventDefault();
            }
        });
        /********************************/

        $('#formSubmit').validate({
            errorElement: 'div',
            errorClass: 'middle',
            focusInvalid: false,
            ignore: "",
            rules: {
                rating: {
                    required: true
                },
                feedback: {
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

    $(document).one('ajaxloadstart.page', function(e) {
        $('[class*=select2]').remove();
        $('select[name="duallistbox_demo1[]"]').bootstrapDualListbox('destroy');
        $('.rating').raty('destroy');
        $('.multiselect').multiselect('destroy');
    });
</script>

<?= $this->endSection() ?>
