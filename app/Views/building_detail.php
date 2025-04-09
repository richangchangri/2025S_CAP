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
                    <a href="#">Building</a>
                </li>
                <li class="active">Detail Building</li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content">
            <div class="page-header">
                <h1>
                    Detail Building
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        <?= esc($building['building_name']); ?>
                    </small>
                </h1>
            </div><!-- /.page-header -->

            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->
                     <span id="alert"></span>
                    <form class="form-horizontal" role="form" name="formSubmit" id="formSubmit">
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="name"> Name</label>
                            <div class="col-sm-9">
                                <input type="hidden" id="building_id" name="building_id" placeholder="Username" value="<?= esc($building['building_id']); ?>" class="form-control">
                                <input type="text" id="name" name="name" placeholder="name" value="<?= esc($building['building_name']); ?>" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="address"> Adress </label>

                            <div class="col-sm-9">
                                <input type="text" id="address" name="address" placeholder="address" class="form-control" value="<?= esc($building['address']); ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="floors"> Floors </label>

                            <div class="col-sm-9">
                                 <input type="text" id="floors" name="floors" placeholder="floors" class="form-control" value="<?= esc($building['floors']); ?>">
                          
                            </div>
                        </div> 
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="contact_person"> Contact Person</label>

                            <div class="col-sm-9">
                                <input type="text" id="contact_person" name="contact_person" placeholder="contact person" class="form-control" value="<?= esc($building['contact_person']); ?>">
                            </div>
                        </div>
                       
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="status"> Available ? </label>

                            <div class="col-sm-9">
                                <label>
                                    <input name="status" class="ace ace-switch ace-switch-5" <?php if($building['status'] == "available")  echo "checked"; ?> type="checkbox" value="available">
                                    <span class="lbl"></span>
                                </label>          
                            </div>
                        </div>
                        <div class="space-4"></div>
                        <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9">
                                

                                &nbsp; &nbsp; &nbsp;
                                <a class="btn" href="<?= base_url('building'); ?>">
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
