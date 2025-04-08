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
                    <li class="active">Building</li>
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
                            Building
                        </small>
                    </h1>
                </div><!-- /.page-header -->
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="widget-title lighter">BUILDING</h4>
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
            function initializeTable(tableId, status) {
        return $('#' + tableId).DataTable({
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
                            <a href="<?= base_url(); ?>building/edit/${row[0]}" class="btn btn-xs btn-warning">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="#" class="btn btn-xs btn-danger delete-user" data-id="${row[0]}">
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
            type: 'GET'
        });
    }

    // Initialize DataTables
    var availableTable = initializeTable('availableBuilding', 'available');
    var maintenanceTable = initializeTable('maintenanceBuilding', 'maintenance');
    var allTable = initializeTable('allBuilding', 'all');

            $('.delete-user').on('click',  function(e) {
            e.preventDefault();

            let userId = $(this).data('id');
            let url = "<?= base_url(); ?>/building/delete/" + userId;

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
        });
    </script>
<?= $this->endSection() ?>