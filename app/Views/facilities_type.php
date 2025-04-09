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
                    <li class="active">Facilities Type</li>
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
                            Facilities Type
                        </small>
                    </h1>
                </div><!-- /.page-header -->

                <div class="row">
                    <div class="col-md-12">
                        <h4 class="widget-title lighter">FACILITIES TYPE</h4>
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
                                        <table id="availableFacilitiesType" class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Action</th>
                                                    <th>Name</th>
                                                    <th>Description</th>
                                                    <th>Created At</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Action</th>
                                                    <th>Name</th>
                                                    <th>Description</th>
                                                    <th>Created At</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>

                                    <div id="maintenance" class="tab-pane">
                                        <div class="pull-right tableTools-container-maintenance"></div><br />
                                        <table id="maintenanceFacilitiesType" class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Action</th>
                                                    <th>Name</th>
                                                    <th>Description</th>
                                                    <th>Created At</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Action</th>
                                                    <th>Name</th>
                                                    <th>Description</th>
                                                    <th>Created At</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>

                                    <div id="all" class="tab-pane">
                                        <div class="pull-right tableTools-container-all"></div><br />
                                        <table id="allFacilitiesType" class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Action</th>
                                                    <th>Name</th>
                                                    <th>Description</th>
                                                    <th>Created At</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Action</th>
                                                    <th>Name</th>
                                                    <th>Description</th>
                                                    <th>Created At</th>
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
                        { "bSortable": false }
                    ],
                    "aaSorting": [],
                    columnDefs: [
                        {
                            targets: 0,
                            data: "facility_id",
                            render: function (data, type, row, meta) {
                                return `<div class="text-center">
                                    <a href="<?= base_url(); ?>facilities_type/edit/${row[0]}" class="btn btn-xs btn-warning">
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
                        url: "<?= base_url('data/facilities_type/') ?>" + status,
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
            var activeTable = initializeTable('availableFacilitiesType', 'available');
            var inactiveTable = initializeTable('maintenanceFacilitiesType', 'maintenance');
            var pendingTable = initializeTable('allFacilitiesType', 'all');

            $('.delete').on('click',  function(e) {
            e.preventDefault();

            let id = $(this).data('id');
            let url = "<?= base_url(); ?>/facilities_type/delete/" + id;

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
            let url = "<?= base_url(); ?>facilities_type/add";
            window.location.href = url;
        });

    });
    </script>
<?= $this->endSection() ?>