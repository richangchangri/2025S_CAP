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
                            <span class="line-height-1 smaller-90"> Used </span>
                        </span>
                        <span class="btn btn-app btn-sm btn-primary no-hover">
                            <span class="line-height-1 bigger-170"> 6 </span>
                            <br>
                            <span class="line-height-1 smaller-90"> Available </span>
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
                                    <li class="pending">
                                        <a data-toggle="tab" href="#pending_tab" aria-expanded="true">Need Approval</a>
                                    </li>
                                    <li class="active">
                                        <a data-toggle="tab" href="#approve_tab" aria-expanded="true">Approve</a>
                                    </li>
                                    <li class="">
                                        <a data-toggle="tab" href="#maintenance" aria-expanded="false">Maintenance</a>
                                    </li>
                                    <li class="">
                                        <a data-toggle="tab" href="#all" aria-expanded="false">All Facility</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div id="available" class="tab-pane active">
                                        <div class="pull-right tableTools-container-available"></div><br />
                                        <table id="availableFacility" class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Action</th>
                                                    <th>Reservation Name</th>
                                                    <th>Date</th>
                                                    <th>Facility</th>
                                                    <th>Reservation By</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Action</th>
                                                    <th>Reservation Name</th>
                                                    <th>Date</th>
                                                    <th>Facility</th>
                                                    <th>Reservation By</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>

                                    <div id="maintenance" class="tab-pane">
                                        <div class="pull-right tableTools-container-maintenance"></div><br />
                                        <table id="maintenanceFacility" class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Action</th>
                                                    <th>Facility Name</th>
                                                    <th>Location</th>
                                                    <th>Capacity</th>
                                                    <th>Location</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Action</th>
                                                    <th>Facility Name</th>
                                                    <th>Location</th>
                                                    <th>Capacity</th>
                                                    <th>Location</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>

                                    <div id="all" class="tab-pane">
                                        <div class="pull-right tableTools-container-all"></div><br />
                                        <table id="allFacility" class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Action</th>
                                                    <th>Facility Name</th>
                                                    <th>Location</th>
                                                    <th>Capacity</th>
                                                    <th>Location</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Action</th>
                                                    <th>Facility Name</th>
                                                    <th>Location</th>
                                                    <th>Capacity</th>
                                                    <th>Location</th>
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
    <script type="text/javascript">
        $(document).ready(function() {
            function initializeTable(tableId, status) {
                var myTable = $('#' + tableId).DataTable({
                    bAutoWidth: false,
                    "aoColumns": [
                        { "bSortable": false },
                        { "bSortable": false },
                        { "bSortable": false },
                        { "bSortable": false },
                        { "bSortable": false }
                    ],
                    "aaSorting": [],
                    columnDefs: [
                        {
                            targets: 0,
                            data: "facility_id",
                            render: function (data, type, row, meta) {
                                return `<div class="text-center">
                                    <a href="<?= base_url(); ?>facility/detail/${row[0]}" class="btn btn-xs btn-default">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a href="<?= base_url(); ?>facility/edit/${row[0]}" class="btn btn-xs btn-warning">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="#" class="btn btn-xs btn-danger delete" data-id="${row[0]}">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </div>`;
                            }
                        }
                    ],
                    select: {
                        style: 'multi'
                    },
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "<?= base_url('data/facility/') ?>" + status,
                        type: "GET"
                    },
                    dom: 'Bfrtip',
                    buttons: [
                        {
                            text: '<i class="fa fa-plus bigger-110 orange"></i> <span class="hidden">Add</span>',
                            className: 'btn btn-white btn-primary btn-bold addbtn'
                        },
                        {
                            extend: 'copy',
                            text: '<i class="fa fa-copy bigger-110 pink"></i> <span class="hidden">Copy to clipboard</span>',
                            className: 'btn btn-white btn-primary btn-bold'
                        },                       
                        {
                            extend: 'csv',
                            text: '<i class="fa fa-file-excel-o bigger-110 green"></i> <span class="hidden">Export to Excel</span>',
                            className: 'btn btn-white btn-primary btn-bold'
                        },
                        {
                            extend: 'pdf',
                            text: '<i class="fa fa-file-pdf-o bigger-110 red"></i> <span class="hidden">Export to PDF</span>',
                            className: 'btn btn-white btn-primary btn-bold'
                        },
                        {
                            extend: 'print',
                            text: '<i class="fa fa-print bigger-110 grey"></i> <span class="hidden">Print</span>',
                            className: 'btn btn-white btn-primary btn-bold',
                            autoPrint: false,
                            message: 'This print was produced using the Print button for DataTables'
                        }
                    ]
                });

                // Style column visibility dropdown
                myTable.on('column-visibility', function(e, settings, column, state) {
                    if ($('.dt-button-collection > .dropdown-menu').length === 0) {
                        $('.dt-button-collection')
                            .wrapInner('<ul class="dropdown-menu dropdown-light dropdown-caret dropdown-caret" />')
                            .find('a').attr('href', '#').wrap("<li />");
                    }
                    $('.dt-button-collection').appendTo('.tableTools-container-'+ tableId +' .dt-buttons');
                });

                // Add tooltips
                setTimeout(function() {
                    $('.tableTools-container-'+ tableId).find('a.dt-button').each(function() {
                        var div = $(this).find(' > div').first();
                        if(div.length === 1) {
                            div.tooltip({container: 'body', title: div.parent().text()});
                        } else {
                            $(this).tooltip({container: 'body', title: $(this).text()});
                        }
                    });
                }, 500);

                return myTable;
            }

            // Initialize DataTables
            var activeTable = initializeTable('availableFacility', 'available');
            var inactiveTable = initializeTable('maintenanceFacility', 'maintenance');
            var pendingTable = initializeTable('allFacility', 'all');

            $('.delete').on('click',  function(e) {
            e.preventDefault();

            let id = $(this).data('id');
            let url = "<?= base_url(); ?>/facility/delete/" + id;

            if (confirm("Are you sure you want to delete this user?")) {
                $.ajax({
                    url: url,
                    type: "DELETE",
                    dataType: "json",
                    success: function(response) {
                        alert(response.message); // Show success/error message
                        location.reload(); // Refresh table after delete
                    },
                    error: function() {
                        alert("Error deleting user. Please try again.");
                    }
                });
            }
        });

        $('.addbtn').on('click', function() {
            let url = "<?= base_url(); ?>facility/add";
            window.location.href = url;
        });

    });
    </script>

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