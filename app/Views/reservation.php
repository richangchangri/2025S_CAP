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
                    <li class="active">Reservation</li>
                </ul><!-- /.breadcrumb -->
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
                        <h4 class="widget-title lighter">SUMMARY</h4>
                        <span class="btn btn-app btn-sm btn-primary no-hover">
                            <span class="line-height-1 bigger-170" id="needApproveQty"> - </span>
                            <br>
                            <span class="line-height-1 smaller-90">Waiting</span>
                        </span>
                        <span class="btn btn-app btn-sm btn-primary no-hover">
                            <span class="line-height-1 bigger-170" id="rejectQty"> - </span>
                            <br>
                            <span class="line-height-1 smaller-90"> Reject </span>
                        </span>
                        <span class="btn btn-app btn-sm btn-primary no-hover">
                            <span class="line-height-1 bigger-170" id="cancelQty"> - </span>
                            <br>
                            <span class="line-height-1 smaller-90"> Cancel </span>
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
                                        <a data-toggle="tab" href="#pending_tab" aria-expanded="true">Waiting List</a>
                                    </li>
                                    <li class="">
                                        <a data-toggle="tab" href="#approve_tab" aria-expanded="true">Approve</a>
                                    </li>
                                    <li class="">
                                        <a data-toggle="tab" href="#completed_tab" aria-expanded="false">Completed</a>
                                    </li>
                                    <li class="">
                                        <a data-toggle="tab" href="#cancelled_tab" aria-expanded="false">Cancelled</a>
                                    </li>
                                    <li class="">
                                        <a data-toggle="tab" href="#rejected_tab" aria-expanded="false">Rejected</a>
                                    </li>
                                    <li class="">
                                        <a data-toggle="tab" href="#all_tab" aria-expanded="false">All Reservation</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div id="pending_tab" class="tab-pane active">
                                        <div class="pull-right tableTools-container-available"></div><br />
                                        <table id="pendingReservation" class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Action</th>
                                                    <th>Facility</th>
                                                    <th>Purpose</th>
                                                    <th>Date</th>
                                                    <th>Status</th>
                                                    <th>Reservation By</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Action</th>
                                                    <th>Facility</th>
                                                    <th>Purpose</th>
                                                    <th>Date</th>
                                                    <th>Status</th>
                                                    <th>Reservation By</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>

                                    <div id="approve_tab" class="tab-pane">
                                        <div class="pull-right tableTools-container-maintenance"></div><br />
                                        <table id="approveReservation" class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Action</th>
                                                    <th>Facility</th>
                                                    <th>Purpose</th>
                                                    <th>Date</th>
                                                    <th>Status</th>
                                                    <th>Reservation By</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Action</th>
                                                    <th>Facility</th>
                                                    <th>Purpose</th>
                                                    <th>Date</th>
                                                    <th>Status</th>
                                                    <th>Reservation By</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>

                                    <div id="rejected_tab" class="tab-pane">
                                        <div class="pull-right tableTools-container-all"></div><br />
                                        <table id="rejectedReservation" class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Action</th>
                                                    <th>Facility</th>
                                                    <th>Purpose</th>
                                                    <th>Date</th>
                                                    <th>Status</th>
                                                    <th>Reservation By</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Action</th>
                                                    <th>Facility</th>
                                                    <th>Purpose</th>
                                                    <th>Date</th>
                                                    <th>Status</th>
                                                    <th>Reservation By</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <div id="completed_tab" class="tab-pane">
                                        <div class="pull-right tableTools-container-all"></div><br />
                                        <table id="completedReservation" class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Action</th>
                                                    <th>Facility</th>
                                                    <th>Purpose</th>
                                                    <th>Date</th>
                                                    <th>Status</th>
                                                    <th>Rating <i class="fa fa-star"></i></th>
                                                    <th>Comment</th>
                                                    <th>Reservation By</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Action</th>
                                                    <th>Facility</th>
                                                    <th>Purpose</th>
                                                    <th>Date</th>
                                                    <th>Status</th>
                                                    <th>Rating <i class="fa fa-star"></i></i></th>
                                                    <th>Comment</th>
                                                    <th>Reservation By</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <div id="cancelled_tab" class="tab-pane">
                                        <div class="pull-right tableTools-container-all"></div><br />
                                        <table id="cancelledReservation" class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Action</th>
                                                    <th>Facility</th>
                                                    <th>Purpose</th>
                                                    <th>Date</th>
                                                    <th>Status</th>
                                                    <th>Reservation By</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Action</th>
                                                    <th>Facility</th>
                                                    <th>Purpose</th>
                                                    <th>Date</th>
                                                    <th>Status</th>
                                                    <th>Reservation By</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <div id="all_tab" class="tab-pane">
                                        <div class="pull-right tableTools-container-all"></div><br />
                                        <table id="allReservation" class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Action</th>
                                                    <th>Facility</th>
                                                    <th>Purpose</th>
                                                    <th>Date</th>
                                                    <th>Status</th>
                                                    <th>Reservation By</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Action</th>
                                                    <th>Facility</th>
                                                    <th>Purpose</th>
                                                    <th>Date</th>
                                                    <th>Status</th>
                                                    <th>Reservation By</th>
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
            function loadDashboardData() {
                $.ajax({
                    url: '/data/reservationSummary', // make sure this matches route in Routes.php
                    method: 'GET',
                    dataType: 'json',
                    success: function (res) {
                        // Facilities
                        $('#needApproveQty').text(res.pending);
                        $('#rejectQty').text(res.rejected);
                        $('#cancelQty').text(res.cancel);
                    }
                });
            }      
            
            // Call first time when page loads
            loadDashboardData();

            // Set auto refresh every 5 minutes (300000 ms)
            setInterval(loadDashboardData, 300000); // 5 minutes

            function initializeTable(tableId, status) {
                var myTable = $('#' + tableId).DataTable({
                    bAutoWidth: false,
                    "aoColumns": [
                        { "bSortable": false },
                        { "bSortable": true },
                        { "bSortable": true },
                        { "bSortable": true },
                        { "bSortable": false },
                        { "bSortable": false }
                    ],
                    "aaSorting": [],
                    columnDefs: [
                        {
                            targets: 0,
                            data: "reservation_id",
                            render: function (data, type, row, meta) {
                                let actionHtml = `<div class="text-center">`;
                                

                                // Show feedback icon only if status == "Approved"
                                if (status === 'Approved') {
                                    actionHtml += `
                                    <a href="<?= base_url(); ?>reservation/feedback/${row[0]}" class="text-success" data-id="${row[0]}" title="End Reservation">
                                        <i class="fa fa-check-square-o"></i>
                                    </a>`;
                                } else if (status === 'Pending') {
                                    actionHtml += `<a href="<?= base_url(); ?>reservation/detail/${row[0]}" class="btn btn-xs btn-default" title="See Detail">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a href="<?= base_url(); ?>reservation/edit/${row[0]}" class="btn btn-xs btn-warning" title="Edit Reservation">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="#" class="btn btn-xs btn-danger cancel-reservation" data-id="${row[0]}" title="Cancel Reservation">
                                        <i class="fa fa-times"></i>
                                    </a>`;
                                } else {
                                    actionHtml += `<a href="<?= base_url(); ?>reservation/detail/${row[0]}" class="btn btn-xs btn-default" title="See Detail">
                                        <i class="fa fa-eye"></i>
                                    </a>`;
                                } 

                                actionHtml += `</div>`;
                                return actionHtml;
                            }
                        },
                        {
                            targets: 3,
                            data: "reservation_id",
                            render: function (data, type, row, meta) {
                                return `${row[3]} - ${row[7]}`;
                            }
                        },
                        {
                            targets: 5,
                            data: "reservation_id",
                            render: function (data, type, row, meta) {
                                return `${row[8]} - ${row[9]}`;
                            }
                        }
                    ],
                    select: {
                        style: 'multi'
                    },
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "<?= base_url('data/reservation/') ?>" + status,
                        type: "POST"
                    },
                    dom: 'Bfrtip',
                    buttons: [
                        {
                            text: '<i class="fa fa-plus bigger-110 orange"></i> <span class="hidden">Add</span>',
                            className: 'btn btn-white btn-primary btn-bold addbtn'
                        },
                        {
                            text: '<i class="fa fa-refresh bigger-110 pink"></i> <span class="hidden">Copy to clipboard</span>',
                            className: 'btn btn-white btn-primary btn-bold btnRefresh',
                            action: function (e, dt, node, config) {
                                dt.ajax.reload(null, false);
                            }
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

            var completedTable = $('#completedReservation').DataTable({
                    bAutoWidth: false,
                    "aoColumns": [
                        { "bSortable": false },
                        { "bSortable": true },
                        { "bSortable": true },
                        { "bSortable": true },
                        { "bSortable": false },
                        { "bSortable": true },
                        { "bSortable": false },
                        { "bSortable": false }
                    ],
                    "aaSorting": [],
                    columnDefs: [
                        {
                            targets: 0,
                            data: "reservation_id",
                            render: function (data, type, row, meta) {
                                let actionHtml = `<div class="text-center">`;
                                

                                // Show feedback icon only if status == "Approved"
                                if (status === 'Approved') {
                                    actionHtml += `
                                    <a href="<?= base_url(); ?>reservation/feedback/${row[0]}" class="text-success" data-id="${row[0]}" title="End Your Reservation">
                                        <i class="fa fa-check-square-o"></i>
                                    </a>`;
                                } else if (status === 'Pending') {
                                    actionHtml += `<a href="<?= base_url(); ?>reservation/detail/${row[0]}" class="btn btn-xs btn-default" title="See Detail">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a href="<?= base_url(); ?>reservation/edit/${row[0]}" class="btn btn-xs btn-warning" title="Edit Reservation">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="#" class="btn btn-xs btn-danger cancel-reservation" data-id="${row[0]}" title="Cancel Reservation">
                                        <i class="fa fa-times"></i>
                                    </a>`;
                                } else {
                                    actionHtml += `<a href="<?= base_url(); ?>reservation/detail/${row[0]}" class="btn btn-xs btn-default" title="See Detail">
                                        <i class="fa fa-eye"></i>
                                    </a>`;
                                } 

                                actionHtml += `</div>`;
                                return actionHtml;
                            }
                        },
                        {
                            targets: 3,
                            data: "reservation_id",
                            render: function (data, type, row, meta) {
                                return `${row[3]} - ${row[7]}`;
                            }
                        },
                        {
                            targets: 7,
                            data: "reservation_id",
                            render: function (data, type, row, meta) {
                                return `${row[8]} - ${row[9]}`;
                            }
                        }
                    ],
                    select: {
                        style: 'multi'
                    },
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "<?= base_url('data/reservation/') ?>Completed",
                        type: "POST"
                    },
                    dom: 'Bfrtip',
                    buttons: [
                        {
                            text: '<i class="fa fa-plus bigger-110 orange"></i> <span class="hidden">Add</span>',
                            className: 'btn btn-white btn-primary btn-bold addbtn'
                        },
                        {
                            text: '<i class="fa fa-refresh bigger-110 pink"></i> <span class="hidden">Copy to clipboard</span>',
                            className: 'btn btn-white btn-primary btn-bold btnRefresh',
                            action: function (e, dt, node, config) {
                                dt.ajax.reload(null, false);
                            }
                        }  
                    ]
                });

            // Initialize DataTables
            var pendingTable = initializeTable('pendingReservation', 'Pending');
            var approveTable = initializeTable('approveReservation', 'Approved');
            var rejectedTable = initializeTable('rejectedReservation', 'Rejected');
            var cancelledTable = initializeTable('cancelledReservation', 'Cancelled');
            var allTable = initializeTable('allReservation', 'all');

        // Cancel reservation with confirmation using Bootbox
        $(document).on('click', '.cancel-reservation', function (e) {
            e.preventDefault();
            let reservationId = $(this).data('id');
            let url = "<?= base_url(); ?>reservation/cancel/" + reservationId;

            bootbox.confirm("Are you sure you want to cancel this reservation?", function (result) {
                if (result === true) {
                    $.ajax({
                        url: url,
                        type: "POST",
                        dataType: "JSON",
                        data: { reservation_id: reservationId },
                        success: function (data) {
                            bootbox.alert(data.message || "Reservation canceled successfully!", function () {
                                location.reload();
                            });
                        },
                        error: function () {
                            bootbox.alert("Error canceling reservation. Please try again.");
                        }
                    });
                }
            });
        });

        $('.addbtn').on('click', function() {
            let url = "<?= base_url('reservation/add'); ?>";
            window.location.href = url;
        });

    });
    </script>

    
<?= $this->endSection() ?>