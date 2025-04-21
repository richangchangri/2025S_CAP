<?= $this->extend('layout/page_layout') ?>

<?= $this->section('content') ?>
<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    Home
                </li>

                <li>
                    Reservation
                </li>
                <li class="active">Add Reservation</li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content">
            <div class="page-header">
                <h1>
                    Reservation
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i> Add Reservation
                    </small>
                </h1>
            </div><!-- /.page-header -->

            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->
                     <span id="alert"></span>
                    <form class="form-horizontal" role="form" name="formSubmit" id="formSubmit">
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Facility</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="facility" name="facility" required>
                                    <option value="">- Choose -</option>
                                    <?php foreach($facility as $row){
                                        echo '<option value="'. $row['facility_id'].'">'. $row['name'].'</option>';
                                    }  ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="start_time"> Start Time </label>

                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input id="user_id" name="user_id" type="hidden" class="form-control" value="<?php  $session = session();  echo $session->get('user_id'); ?>" >
                                
                                    <input id="date-timepicker1" name="start_time" placeholder="<?php date('d-m-Y H:i'); ?>" type="text" class="form-control" required>
                                    <span class="input-group-addon">
                                        <i class="fa fa-clock-o bigger-110"></i>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="end_time"> End Time </label>

                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input id="date-timepicker2" name="end_time" placeholder="<?php date('d-m-Y H:i'); ?>" type="text" class="form-control" required>
                                    <span class="input-group-addon">
                                        <i class="fa fa-clock-o bigger-110"></i>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="purpose"> Purpose </label>

                            <div class="col-sm-9">
                                <input type="text" id="purpose" name="purpose" placeholder="purpose" class="form-control" required>
                            </div>
                        </div>
                        <div class="space-4"></div>
                        <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9">
                                <button class="btn btn-info" type="button" name="btnSubmit" id="btnSubmit">
                                    <i class="ace-icon fa fa-check bigger-110"></i>
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

                    <div class="hr hr-18 dotted hr-double"></div>

                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div>
<script src="<?= base_url('assets/js/jquery.validate.min.js'); ?>"></script>
<script type="text/javascript">
    $(document).ready(function() {
        if(!ace.vars['old_ie']) $('#date-timepicker1, #date-timepicker2').datetimepicker({
            //format: 'MM/DD/YYYY h:mm:ss A',//use this option to display seconds
            icons: {
            time: 'fa fa-clock-o',
            date: 'fa fa-calendar',
            up: 'fa fa-chevron-up',
            down: 'fa fa-chevron-down',
            previous: 'fa fa-chevron-left',
            next: 'fa fa-chevron-right',
            today: 'fa fa-arrows ',
            clear: 'fa fa-trash',
            close: 'fa fa-times'
            }
        }).next().on(ace.click_event, function(){
            $(this).prev().focus();
        });
				

        $('#btnSubmit').on('click', function(e) {
            if ($('#formSubmit').valid()) {
                $('#btnSubmit').text('wait...'); //change button text
                $('#btnSubmit').attr('disabled', true); //set button disable 
                // ajax adding data to database
                $.ajax({
                    url: "<?= base_url('reservation/save'); ?>",
                    type: "POST",
                    data: $('#formSubmit').serialize(),
                    dataType: "JSON",
                    success: function(data) {
                        $('#alert').html(data.message);
                        $('#btnSubmit').html('<i class="ace-icon fa fa-check bigger-110"></i>Submit'); 
                        $('#btnSubmit').attr('disabled', false); //set button enable 
                        setTimeout(function() {
                            window.location.href = '<?= base_url('reservation'); ?>';
                        }, 2000);
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
                username: {
                    required: true
                },
                name: {
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

<?= $this->endSection() ?>
