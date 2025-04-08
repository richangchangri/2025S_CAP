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
                    <li class="active">User Management</li>
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
                            User Management
                        </small>
                    </h1>
                </div><!-- /.page-header -->
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="widget-title lighter">USERS</h4>
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
                        <h4 class="widget-title lighter">USER LISTS</h4>
                        <div class="col-sm-12">
                            <div class="tabbable">
                                <ul class="nav nav-tabs padding-12 tab-color-blue background-blue" id="myTab4">
                                    <li class="active">
                                        <a data-toggle="tab" href="#activeusers" aria-expanded="true">Active</a>
                                    </li>
                                    <li class="">
                                        <a data-toggle="tab" href="#inactiveusers" aria-expanded="false">Inactive</a>
                                    </li>
                                    <li class="">
                                        <a data-toggle="tab" href="#pendingusers" aria-expanded="false">Pending</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div id="activeusers" class="tab-pane active">
                                        <table id="active-table" class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th class="hidden-480">Department</th>
                                                    <th>
                                                        <i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
                                                        Registered Since
                                                    </th>
                                                    <th class="hidden-480">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
										</table>
                                    </div>

                                    <div id="inactiveusers" class="tab-pane">
                                        <table id="inactive-table" class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Username</th>
                                                    <th>Department</th>
                                                    <th>Registered Since</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div id="pendingusers" class="tab-pane">
                                        <table id="pending-table" class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Username</th>
                                                    <th>Department</th>
                                                    <th>Registered Since</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
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
                    targets: 4,
                    data: "user_id",
                    render: function (data, type, row, meta) {
                        return `<div class="text-center">
                            <a href="<?= base_url(); ?>user_management/profile/${row[4]}" class="btn btn-xs btn-default">
                                <i class="fa fa-eye"></i>
                            </a>
                            <a href="<?= base_url(); ?>user_management/edit/${row[4]}" class="btn btn-xs btn-warning">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="#" class="btn btn-xs btn-danger delete-user" data-id="${row[4]}">
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
            ajax: '<?= base_url("data/userManagement/") ?>' + status,
            type: 'GET'
        });
    }

    // Initialize DataTables
    var activeTable = initializeTable('active-table', 'active');
    var inactiveTable = initializeTable('inactive-table', 'inactive');
    var pendingTable = initializeTable('pending-table', 'pending');

            $('.delete-user').on('click',  function(e) {
            e.preventDefault();

            let userId = $(this).data('id');
            let url = "<?= base_url(); ?>/user_management/delete/" + userId;

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
