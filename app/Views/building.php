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
                    <li class="active">Building</li>
                </ul><!-- /.breadcrumb -->
            </div>

            <div class="page-content">

                <div class="page-header">
                    <h1>
                        Home
                        <small>
                            <i class="ace-icon fa fa-angle-double-right"></i>
                            Building
                        </small>
                    </h1>
                </div><!-- /.page-header -->
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="widget-title lighter">SUMMARY</h4>
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
                        <h4 class="widget-title lighter">BUILDING LISTS</h4>
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
                                        <a data-toggle="tab" href="#all" aria-expanded="false">All Building</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div id="available" class="tab-pane active">
                                        <div class="pull-right tableTools-container-available"></div><br />
                                        <table id="availableBuilding" class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Action</th>
                                                    <th>Building Name</th>
                                                    <th>Address</th>
                                                    <th>Floors</th>
                                                    <th>Contact Person</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Action</th>
                                                    <th>Building Name</th>
                                                    <th>Address</th>
                                                    <th>Floors</th>
                                                    <th>Contact Person</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>

                                    <div id="maintenance" class="tab-pane">
                                        <div class="pull-right tableTools-container-maintenance"></div><br />
                                        <table id="maintenanceBuilding" class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Action</th>
                                                    <th>Building Name</th>
                                                    <th>Address</th>
                                                    <th>Floors</th>
                                                    <th>Contact Person</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Action</th>
                                                    <th>Building Name</th>
                                                    <th>Address</th>
                                                    <th>Floors</th>
                                                    <th>Contact Person</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>

                                    <div id="all" class="tab-pane">
                                        <div class="pull-right tableTools-container-allbuilding"></div><br />
                                        <table id="allBuilding" class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Action</th>
                                                    <th>Building Name</th>
                                                    <th>Address</th>
                                                    <th>Floors</th>
                                                    <th>Contact Person</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Action</th>
                                                    <th>Building Name</th>
                                                    <th>Address</th>
                                                    <th>Floors</th>
                                                    <th>Contact Person</th>
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
                    url: '/data/buildingSummary', // make sure this matches the route in Routes.php
                    method: 'GET',
                    dataType: 'json',
                    success: function (res) {
                        // Building
                        $('#availableQty').text(res.available);
                        $('#maintenanceQty').text(res.maintenance);
                        $('#totalQty').text(res.total);
                    }
                });
            }

            // First call when page loads
            loadDashboardData();

            // Set auto refresh every 5 minutes (300000 ms)
            setInterval(loadDashboardData, 300000); // 5 minutes

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
                            data: "building_id",
                            render: function (data, type, row, meta) {
                                return `<div class="text-center">
                                    <a href="<?= base_url(); ?>building/detail/${row[0]}" class="btn btn-xs btn-default">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a href="<?= base_url(); ?>building/edit/${row[0]}" class="btn btn-xs btn-warning">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="<?= base_url(); ?>building/delete/${row[0]}" class="btn btn-xs btn-danger delete-building" data-id="${row[0]}">
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
                    ajax: '<?= base_url("data/building/") ?>' + status,
                    type: 'GET',
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

                // Style the message box
                myTable.on('buttons-action', function(e, buttonApi, dataTable, node, config) {
                    if (buttonApi.index() === 1) { // Copy button
                        $('.dt-button-info').addClass('gritter-item-wrapper gritter-info gritter-center white');
                    }
                });

                // Style column visibility dropdown
                myTable.on('column-visibility', function(e, settings, column, state) {
                    if ($('.dt-button-collection > .dropdown-menu').length === 0) {
                        $('.dt-button-collection')
                            .wrapInner('<ul class="dropdown-menu dropdown-light dropdown-caret dropdown-caret" />')
                            .find('a').attr('href', '#').wrap("<li />");
                    }
                    $('.dt-button-collection').appendTo('.tableTools-container .dt-buttons');
                });

                // Add tooltips
                setTimeout(function() {
                    $('.tableTools-container').find('a.dt-button').each(function() {
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
        var availableTable = initializeTable('availableBuilding', 'available');
        var maintenanceTable = initializeTable('maintenanceBuilding', 'maintenance');
        var allTable = initializeTable('allBuilding', 'allbuilding');

        // Delete building with confirmation using Bootbox
        $(document).on('click', '.delete-building', function (e) {
            e.preventDefault();
            let buildingId = $(this).data('id');
            let url = "<?= base_url(); ?>/building/delete/" + buildingId;

            bootbox.confirm("Are you sure you want to delete this building?", function (result) {
                if (result === true) {
                    $.ajax({
                        url: url,
                        type: "DELETE",
                        dataType: "JSON",
                        success: function (data) {
                            bootbox.alert(data.message || "Building deleted successfully!", function () {
                                location.reload();
                            });
                        },
                        error: function () {
                            bootbox.alert("Error deleting building. Please try again.");
                        }
                    });
                }
            });
        });

        $('.addbtn').on('click', function() {
            let url = "<?= base_url(); ?>building/add";
            window.location.href = url;
        });
    });
    </script>
<?= $this->endSection() ?>