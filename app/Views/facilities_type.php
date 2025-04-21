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
                            <div class="tab-content">
                                <div id="available" class="tab-pane active">
                                    <div class="pull-right tableTools-container-available"></div><br />
                                    <table id="availableFacilitiesType" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Action</th>
                                                <th>Name</th>
                                                <th>Description</th>
                                                <th>Status</th>
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
                                                <th>Status</th>
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
                                    <a href="<?= base_url(); ?>facilities_type/edit/${row[0]}" class="btn btn-xs btn-warning">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="<?= base_url(); ?>facilities_type/delete/${row[0]}" class="btn btn-xs btn-danger delete-facilities-type" data-id="${row[0]}">
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

        // Initialize DataTables
        var activeTable = initializeTable('availableFacilitiesType', 'available');
        var inactiveTable = initializeTable('maintenanceFacilitiesType', 'maintenance');
        var pendingTable = initializeTable('allFacilitiesType', 'all');


        // Delete facilities type with confirmation using Bootbox
        $(document).on('click', '.delete-facilities-type', function (e) {
            e.preventDefault();
            let facilityId = $(this).data('id');
            let url = "<?= base_url(); ?>/facilities_type/delete/" + facilityId;

            bootbox.confirm("Are you sure you want to delete this facilities type?", function (result) {
                if (result === true) {
                    $.ajax({
                        url: url,
                        type: "DELETE",
                        dataType: "JSON",
                        success: function (data) {
                            bootbox.alert(data.message || "Facilities Type deleted successfully!", function () {
                                location.reload();
                            });
                        },
                        error: function () {
                            bootbox.alert("Error deleting facilities type. Please try again.");
                        }
                    });
                }
            });
        });

        $('.addbtn').on('click', function() {
            let url = "<?= base_url(); ?>facilities_type/add";
            window.location.href = url;
        });

    });
    </script>
<?= $this->endSection() ?>