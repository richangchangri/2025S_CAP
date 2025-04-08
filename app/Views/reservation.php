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
                    <li class="active">Reservation</li>
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
                        Home
                        <small>
                            <i class="ace-icon fa fa-angle-double-right"></i>
                            Reservation
                        </small>
                    </h1>
                </div><!-- /.page-header -->
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="widget-title lighter">RESERVATION</h4>
                        <span class="btn btn-app btn-sm btn-primary no-hover">
                        <span class="line-height-1 bigger-170"> 4 </span>
                            <br>
                            <span class="line-height-1 smaller-90"> Pending </span>
                        </span>
                        <span class="btn btn-app btn-sm btn-primary no-hover">
                        <span class="line-height-1 bigger-170"> 6 </span>
                            <br>
                            <span class="line-height-1 smaller-90"> Approved </span>
                        </span>
                        <span class="btn btn-app btn-sm btn-primary no-hover">
                        <span class="line-height-1 bigger-170"> 10 </span>
                            <br>
                            <span class="line-height-1 smaller-90"> Rejected </span>
                        </span>
                        <span class="btn btn-app btn-sm btn-primary no-hover">
                        <span class="line-height-1 bigger-170"> 10 </span>
                            <br>
                            <span class="line-height-1 smaller-90"> Total </span>
                        </span>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <h4 class="widget-title lighter">RESERVATION LISTS</h4>
                        <div class="col-sm-12">
                            <div class="tabbable">
                                <ul class="nav nav-tabs padding-12 tab-color-blue background-blue" id="myTab4">
                                    <li class="active">
                                        <a data-toggle="tab" href="#pending" aria-expanded="true">Pending</a>
                                    </li>
                                    <li class="">
                                        <a data-toggle="tab" href="#approved" aria-expanded="false">Approved</a>
                                    </li>
                                    <li class="">
                                        <a data-toggle="tab" href="#rejected" aria-expanded="false">Rejected</a>
                                    </li>
                                    <li class="">
                                        <a data-toggle="tab" href="#allreservation" aria-expanded="false">All Reservation</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div id="pending" class="tab-pane active">
                                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Reservation</th>
                                                    <th>Date</th>
                                                    <th>Employee</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><a href="reservation_detail">COLOMBUS (FINANCE DEPARTMENT)</a></td>
                                                    <td>2025/02/26 10.00 - 12.00</td>
                                                    <td>COLOMBUS</td>
                                                    <td>-</td>
                                                </tr>
                                                <tr>
                                                    <td><a href="reservation_detail">POLO (INFORMATION TECHNOLOGY DEPARTMENT)</a></td>
                                                    <td>2025/02/26 08.00 - 09.50</td>
                                                    <td>COLOMBUS</td>
                                                    <td>-</td>
                                                </tr>
                                                <tr>
                                                    <td><a href="reservation_detail">LEIF (MARKETING DEPARTMENT)</a></td>
                                                    <td>2025/02/27 10.00 - 12.00</td>
                                                    <td>COLOMBUS</td>
                                                    <td>-</td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Reservation</th>
                                                    <th>Date</th>
                                                    <th>Employee</th>
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>

                                    <div id="approved" class="tab-pane">
                                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Reservation</th>
                                                    <th>Date</th>
                                                    <th>Employee</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><a href="reservation_detail">COLOMBUS (FINANCE DEPARTMENT)</a></td>
                                                    <td>2025/02/26 10.00 - 12.00</td>
                                                    <td>COLOMBUS</td>
                                                    <td>-</td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Reservation</th>
                                                    <th>Date</th>
                                                    <th>Employee</th>
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>

                                    <div id="rejected" class="tab-pane">
                                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Reservation</th>
                                                    <th>Date</th>
                                                    <th>Employee</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><a href="reservation_detail">COLOMBUS (FINANCE DEPARTMENT)</a></td>
                                                    <td>2025/02/26 10.00 - 12.00</td>
                                                    <td>COLOMBUS</td>
                                                    <td>-</td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Reservation</th>
                                                    <th>Date</th>
                                                    <th>Employee</th>
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>

                                    <div id="allreservation" class="tab-pane">
                                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Reservation</th>
                                                    <th>Date</th>
                                                    <th>Employee</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><a href="reservation_detail">COLOMBUS (FINANCE DEPARTMENT)</a></td>
                                                    <td>2025/02/26 10.00 - 12.00</td>
                                                    <td>COLOMBUS</td>
                                                    <td>-</td>
                                                </tr>
                                                <tr>
                                                    <td><a href="reservation_detail">POLO (INFORMATION TECHNOLOGY DEPARTMENT)</a></td>
                                                    <td>2025/02/26 08.00 - 09.50</td>
                                                    <td>COLOMBUS</td>
                                                    <td>-</td>
                                                </tr>
                                                <tr>
                                                    <td><a href="reservation_detail">LEIF (MARKETING DEPARTMENT)</a></td>
                                                    <td>2025/02/27 10.00 - 12.00</td>
                                                    <td>COLOMBUS</td>
                                                    <td>-</td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Reservation</th>
                                                    <th>Date</th>
                                                    <th>Employee</th>
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>