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
                    Users Management
                </li>
                <li class="active">Add User</li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content">
            <div class="page-header">
                <h1>
                    Add User
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
                                <input type="hidden" id="user_id" name="user_id" placeholder="Username" value="" class="form-control">
                                <input type="text" id="name" name="name" placeholder="fullname" value="" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="email"> Email </label>

                            <div class="col-sm-9">
                                <input type="text" id="email" name="email" placeholder="email" class="form-control" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="department"> Department </label>

                            <div class="col-sm-9">
                                <select class="form-control" id="department" name="department" class="form-control">
                                    <option value="">- Choose -</option>
                                    <?php foreach($department as $row){
                                        echo '<option value="'. $row['department_id'].'">'. $row['department_name'].'</option>';
                                    }  ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="phone_number"> Phone Number </label>

                            <div class="col-sm-9">
                                <input type="text" id="phone_number" name="phone_number" placeholder="phone number" class="form-control" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="level"> Level </label>

                            <div class="col-sm-9">
                            <select class="form-control" id="userRole" name="userRole" class="form-control">
                                                    <option value="">- Choose -</option>
                                                    <?php 
                                                        $roles = array('Admin','Facility Manager','Regular User');
                                                        foreach($roles as $role){    
                                                            echo '<option value="'. $role .'">'. $role.'</option>';
                                                        }                                                    
                                                    ?>
                                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="status"> Active ? </label>

                            <div class="col-sm-9">
                                <label>
                                    <input name="status" class="ace ace-switch ace-switch-5" <?php if($user['status'] == "active")  echo "checked"; ?> type="checkbox" value="active">
                                    <span class="lbl"></span>
                                </label>          
                            </div>
                        </div>

                        <div class="space-4"></div>

                        <div class="space-4"></div>
                        <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9">
                                <button class="btn btn-info" type="button" name="btnSubmit" id="btnSubmit">
                                    <i class="ace-icon fa fa-check bigger-110"></i>
                                    Submit
                                </button>

                                &nbsp; &nbsp; &nbsp;
                                <a class="btn" type="reset" href="<?= base_url('user_management'); ?>">
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
                    url: "<?= base_url('user_management/save'); ?>",
                    type: "POST",
                    data: $('#formSubmit').serialize(),
                    dataType: "JSON",
                    success: function(data) {
                        $('#alert').html(data.message);
                        $('#btnSubmit').html('<i class="ace-icon fa fa-check bigger-110"></i>Submit'); 
                        $('#btnSubmit').attr('disabled', false); //set button enable 
                        setTimeout(function() {
                            window.location.href = '<?= base_url('user_management'); ?>';
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
