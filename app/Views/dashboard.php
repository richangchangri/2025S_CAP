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
                    <li class="active">Dashboard</li>
                </ul><!-- /.breadcrumb -->

                <div class="nav-search" id="nav-search">
                    <form class="form-search">
                        <span class="input-icon">
                            <input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input"
                                autocomplete="off" />
                            <i class="ace-icon fa fa-search nav-search-icon"></i>
                        </span>
                    </form>
                </div><!-- /.nav-search -->
            </div>

            <div class="page-content">

                <div class="page-header">
                    <h1>
                        Dashboard
                        <small>
                            <i class="ace-icon fa fa-angle-double-right"></i>
                            overview &amp; stats
                        </small>
                    </h1>
                </div><!-- /.page-header -->
                
                <div class="row">
                    <div class="col-md-3">
                        <h4 class="widget-title lighter">Facilities</h4>
                        <span class="btn btn-app btn-sm btn-light no-hover">
                            <span class="line-height-1 bigger-170 blue"> 4 </span>
                            <br>
                            <span class="line-height-1 smaller-90"> Used </span>
                        </span>
                        <span class="btn btn-app btn-sm btn-light no-hover">
                            <span class="line-height-1 bigger-170 blue"> 6 </span>
                            <br>
                            <span class="line-height-1 smaller-90"> Available </span>
                        </span>
                        <span class="btn btn-app btn-sm btn-light no-hover">
                            <span class="line-height-1 bigger-170 blue"> 10 </span>
                            <br>
                            <span class="line-height-1 smaller-90"> Total </span>
                        </span>
                    </div>
                    <div class="col-md-3">
                        <h4 class="widget-title lighter">New User Approvals</h4>
                        <span class="btn btn-app btn-sm btn-yellow no-hover">
                            <span class="line-height-1 bigger-170"> 10 </span>
                            <br>
                            <span class="line-height-1 smaller-90"> Pending </span>
                        </span>
                        <span class="btn btn-app btn-sm btn-yellow no-hover">
                            <span class="line-height-1 bigger-170"> 3 </span>
                            <br>
                            <span class="line-height-1 smaller-90"> Approved </span>
                        </span>
                        <span class="btn btn-app btn-sm btn-yellow no-hover">
                            <span class="line-height-1 bigger-170"> 5 </span>
                            <br>
                            <span class="line-height-1 smaller-90"> Rejected </span>
                        </span>
                    </div>
                    <div class="col-md-3">
                        <h4 class="widget-title lighter">Feedbacks</h4>
                        <span class="btn btn-app btn-sm btn-pink no-hover">
                            <span class="line-height-1 bigger-170"> 4 </span>
                            <br>
                            <span class="line-height-1 smaller-90"> This Weeks </span>
                        </span>
                        <span class="btn btn-app btn-sm btn-pink no-hover">
                            <span class="line-height-1 bigger-170"> 22 </span>
                            <br>
                            <span class="line-height-1 smaller-90"> Total </span>
                        </span>
                    </div>
                    <div class="col-md-3">
                        <h4 class="widget-title lighter">Users</h4>
                        <span class="btn btn-app btn-sm btn-primary no-hover">
                            <span class="line-height-1 bigger-170"> 10 </span>
                            <br>
                            <span class="line-height-1 smaller-90"> Active </span>
                        </span>
                        <span class="btn btn-app btn-sm btn-primary no-hover">
                            <span class="line-height-1 bigger-170"> 29 </span>
                            <br>
                            <span class="line-height-1 smaller-90"> Inactive </span>
                        </span>
                        <span class="btn btn-app btn-sm btn-primary no-hover">
                            <span class="line-height-1 bigger-170"> 39 </span>
                            <br>
                            <span class="line-height-1 smaller-90"> Total </span>
                        </span>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <h3 class="header smaller lighter green">Facilities</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>

