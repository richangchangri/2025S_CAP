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
                <li class="active">Detail Facility</li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content">
            <div class="page-header">
                <h1>
                    Detail Facility
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        <?= esc($facility['name']); ?>
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
                                <input type="hidden" id="facility_id" name="facility_id" placeholder="Username" value="<?= esc($facility['facility_id']); ?>" class="form-control">
                                <input type="text" id="name" name="name" placeholder="fullname" value="<?= esc($facility['name']); ?>" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="email"> Description </label>

                            <div class="col-sm-9">
                                <input type="text" id="email" name="email" placeholder="Text Field" class="form-control" value="<?= esc($facility['description']); ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="department"> Capacity </label>

                            <div class="col-sm-9">
                                 <input type="text" id="capacity" name="capacity" placeholder="Text Field" class="form-control" value="<?= esc($facility['capacity']); ?>">
                          
                            </div>
                        </div> 
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="level"> Facilities Type </label>

                            <div class="col-sm-9">
                                <input type="text" id="facilities_type" name="facilities_type" placeholder="Facilities Type" class="form-control" value="<?= esc($facility['facilities_type_name']); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="level"> Location </label>

                            <div class="col-sm-9">
                                <input type="text" id="location" name="location" placeholder="Location" class="form-control" value="<?= esc($facility['location']); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="level"> Building </label>

                            <div class="col-sm-9">
                                <input type="text" id="building" name="building" placeholder="building" class="form-control" value="<?= esc($facility['building_name']); ?>">
                            </div>
                        </div>
                       
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="status"> Available ? </label>

                            <div class="col-sm-9">
                                <label>
                                    <input name="status" class="ace ace-switch ace-switch-5" <?php if($facility['status'] == "available")  echo "checked"; ?> type="checkbox" value="active">
                                    <span class="lbl"></span>
                                </label>          
                            </div>
                        </div>
                        <div class="space-4"></div>
                        <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9">
                                

                                &nbsp; &nbsp; &nbsp;
                                <a class="btn" href="<?= base_url('facility'); ?>">
                                    <i class="ace-icon fa fa-undo bigger-110"></i>
                                    Back
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

<?= $this->endSection() ?>
