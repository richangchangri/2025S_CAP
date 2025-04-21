<?= $this->extend('layout/page_layout') ?>

<?= $this->section('content') ?>

    <div class="main-content">
        <div class="main-content-inner">
            <div class="breadcrumbs ace-save-state" id="breadcrumbs">
                <ul class="breadcrumb">
                    <li>
                        <i class="ace-icon fa fa-home home-icon"></i>
                        Building
                    </li>
                    <li class="active"><?= esc($building['name']); ?></li>
                </ul><!-- /.breadcrumb -->
            </div>

            <div class="page-content">

                <div class="page-header">
                    <h1>
                        Building
                        <small>
                            <i class="ace-icon fa fa-angle-double-right"></i>
                            <?= esc($building['name']); ?>
                        </small>
                    </h1>
                </div><!-- /.page-header -->
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="widget-title lighter">FACILITIES</h4>
                        <span class="btn btn-app btn-sm btn-primary no-hover">
                            <span class="line-height-1 bigger-170" id="availableQty"> - </span>
                            <br>
                            <span class="line-height-1 smaller-90"> Available </span>
                        </span>
                        <span class="btn btn-app btn-sm btn-primary no-hover">
                            <span class="line-height-1 bigger-170" id="maintenanceQty"> - </span>
                            <br>
                            <span class="line-height-1 smaller-90"> Maintenance </span>
                        </span>
                        <span class="btn btn-app btn-sm btn-primary no-hover">
                            <span class="line-height-1 bigger-170" id="totalQty"> - </span>
                            <br>
                            <span class="line-height-1 smaller-90"> Total </span>
                        </span>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <h4 class="widget-title lighter">FACILITY LISTS FROM <?= esc($building['name']); ?></h4>
                        <div class="col-sm-12">
                            <div class="tabbable">
                                <ul class="nav nav-tabs padding-12 tab-color-blue background-blue" id="myTab4">
                                    <li class="active">
                                        <a data-toggle="tab" href="#available" aria-expanded="true">Available</a>
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
                                                    <th>Facility Name</th>
                                                    <th>Description</th>
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
                                                    <th>Description</th>
                                                    <th>Capacity</th>
                                                    <th>Location</th>
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
                                                    <th>Description</th>
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
                                                    <th>Description</th>
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
                                                    <th>Description</th>
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
                                                    <th>Description</th>
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

            let currentUrl = window.location.pathname;
            let segments = currentUrl.split('/');

            let buildingId = segments[3] || null;

            if (buildingId) {
                loadDashboardData(buildingId);
            } else {
                console.warn("Building ID not found in URL.");
            }

            function loadDashboardData(buildingId) {
                $.ajax({
                    url: '/data/buildingDetailSummary/' + buildingId,
                    method: 'GET',
                    dataType: 'json',
                    success: function (res) {
                        // Building
                        $('#availableQty').text(res.available);
                        $('#maintenanceQty').text(res.maintenance);
                        $('#totalQty').text(res.total);
                    },
                    error: function (xhr, status, error) {
                        console.error("Failed to dashboard:", error);
                    }
                });
            }

            // First call when page loads
            loadDashboardData(buildingId);

            // Set auto refresh every 5 minutes (300000 ms)
            setInterval(loadDashboardData, 300000); // 5 minutes

            function initializeTable(tableId, status) {
                const pathSegments = window.location.pathname.split('/');
                const buildingId = pathSegments[pathSegments.length - 1];
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
                                    <a href="<?= base_url(); ?>facility/delete/${row[0]}" class="btn btn-xs btn-danger delete-facility" data-id="${row[0]}">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </div>`;
                            }
                        },
                        {
                            targets: 4,
                            data: "facility_id",
                            render: function (data, type, row, meta) {
                                return `${row[4]} - ${row[6]}`;
                            }
                        }
                    ],
                    select: {
                        style: 'multi'
                    },
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "<?= base_url('data/building_detail/') ?>" + buildingId + "/" + status,
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
        var activeTable = initializeTable('availableFacility','available');
        var inactiveTable = initializeTable('maintenanceFacility', 'maintenance');
        var pendingTable = initializeTable('allFacility', 'all');            

        // Delete facility with confirmation using Bootbox
        $(document).on('click', '.delete-facility', function (e) {
            e.preventDefault();
            let facilityId = $(this).data('id');
            let url = "<?= base_url(); ?>/facility/delete/" + facilityId;

            bootbox.confirm("Are you sure you want to delete this facility?", function (result) {
                if (result === true) {
                    $.ajax({
                        url: url,
                        type: "DELETE",
                        dataType: "JSON",
                        success: function (data) {
                            bootbox.alert(data.message || "Facility deleted successfully!", function () {
                                location.reload();
                            });
                        },
                        error: function () {
                            bootbox.alert("Error deleting facility. Please try again.");
                        }
                    });
                }
            });
        });

        $('.addbtn').on('click', function() {
            let url = "<?= base_url(); ?>facility/add";
            window.location.href = url;
        });

    });
    </script>
<?= $this->endSection() ?>