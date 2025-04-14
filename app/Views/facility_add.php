<?= $this->extend('layout/page_layout') ?>

<?= $this->section('content') ?>
<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="#">Home</a>
                </li>

                <li>
                    <a href="#">Facility</a>
                </li>
                <li class="active">Add Facility</li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content">
            <div class="page-header">
                <h1>
                    Add Facility
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                    </small>
                </h1>
            </div><!-- /.page-header -->

            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->
                     <span id="alert"></span>
                    <form class="form-horizontal" role="form" name="formSubmit" id="formSubmit">
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Name</label>
                            <div class="col-sm-9">
                                <input type="hidden" id="facility_id" name="facility_id" value="<?= esc($facility['facility_id']); ?>" class="form-control">
                                <input type="text" id="name" name="name" placeholder="facility name" value="" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="description"> Description </label>

                            <div class="col-sm-9">
                                <input type="text" id="description" name="description" placeholder="description" class="form-control" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="capacity"> Capacity </label>

                            <div class="col-sm-9">
                                 <input type="text" id="capacity" name="capacity" placeholder="capacity" class="form-control" value="">
                          
                            </div>
                        </div> 
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="level"> Facilities Type </label>

                            <div class="col-sm-9">
                                <select class="form-control" id="facilitiesType" name="facilitiesType" class="form-control" required>
                                    <option value="">- Choose -</option>
                                    <?php 
                                        foreach($facilitiesType as $facilities){    
                                            echo '<option value="'. $facilities['facility_type_id'] .'">'. $facilities['name'] .'</option>';
                                        }                                                    
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="location"> Location </label>

                            <div class="col-sm-9">
                                <input type="text" id="location" name="location" placeholder="location" class="form-control" value="">
                            </div>
                        </div>
                         <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="building"> Building </label>

                            <div class="col-sm-9">
                                <select class="form-control" id="building" name="building" class="form-control" required>
                                    <option value="">- Choose -</option>
                                    <?php 
                                        foreach($buildings as $building){    
                                            echo '<option value="'. $building['building_id']  .'">'. $building['name']  .'</option>';
                                        }                                                    
                                    ?>
                                </select>
                            </div>
                        </div>
                       
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="status"> Available ? </label>

                            <div class="col-sm-9">
                                <label>
                                    <input name="status" class="ace ace-switch ace-switch-5" <?php if($facility['status'] == "available")  echo "checked"; ?> type="checkbox" value="available">
                                    <span class="lbl"></span>
                                </label>          
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
                                <a class="btn" type="reset" href="<?= base_url('building'); ?>">
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
        $('#btnSubmit').on('click', function(e) {
            if ($('#formSubmit').valid()) {
                $('#btnSubmit').text('wait...'); //change button text
                $('#btnSubmit').attr('disabled', true); //set button disable 
                // ajax adding data to database
                $.ajax({
                    url: "<?= base_url('facility/save'); ?>",
                    type: "POST",
                    data: $('#formSubmit').serialize(),
                    dataType: "JSON",
                    success: function(data) {
                        $('#alert').html(data.message);
                        $('#btnSubmit').html('<i class="ace-icon fa fa-check bigger-110"></i>Submit'); 
                        $('#btnSubmit').attr('disabled', false); //set button enable 
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
                name: {
                    required: true
                },
                description: {
                    required: true
                },
                capacity: {
                    required: true
                },
                facilitiesType: {
                    required: true
                },
                location: {
                    required: true
                },
                building: {
                    required: true
                },
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
