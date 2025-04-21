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
                    <li class="active">User Management</li>
                </ul><!-- /.breadcrumb -->
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
                        <h4 class="widget-title lighter">SUMMARY</h4>
                        <span class="btn btn-app btn-sm btn-primary no-hover">
                            <span class="line-height-1 bigger-170" id="activeQty"> - </span>
                            <br>
                            <span class="line-height-1 smaller-90"> Active </span>
                        </span>
                        <span class="btn btn-app btn-sm btn-primary no-hover">
                            <span class="line-height-1 bigger-170" id="inactiveQty"> - </span>
                            <br>
                            <span class="line-height-1 smaller-90"> Inactive </span>
                        </span>
                        <span class="btn btn-app btn-sm btn-primary no-hover">
                            <span class="line-height-1 bigger-170" id="pendingQty"> - </span>
                            <br>
                            <span class="line-height-1 smaller-90"> Pending </span>
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
                                        <div class="pull-right tableTools-container-activeusers"></div><br />
                                        <table id="active-table" class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Action</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Department</th>
                                                    <th class="hidden-480">Phone Number</th>
                                                    <th>
                                                        <i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
                                                        Registered Since
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
										</table>
                                    </div>

                                    <div id="inactiveusers" class="tab-pane">
                                        <div class="pull-right tableTools-container-inactiveusers"></div><br />
                                        <table id="inactive-table" class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Action</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Department</th>
                                                    <th>Phone Number</th>
                                                    <th>Registered Since</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div id="pendingusers" class="tab-pane">
                                        <div class="pull-right tableTools-container-pendingusers"></div><br />
                                        <table id="pending-table" class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Action</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Department</th>
                                                    <th>Phone Number</th>
                                                    <th>Registered Since</th>
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
        $(document).ready(function () {

            function loadDashboardData() {
                $.ajax({
                    url: '/data/userSummary', // make sure this matches the route in Routes.php
                    method: 'GET',
                    dataType: 'json',
                    success: function (res) {
                        // Facilities
                        $('#activeQty').text(res.active);
                        $('#inactiveQty').text(res.inactive);
                        $('#pendingQty').text(res.pending);
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
                    autoWidth: false,
                    columns: [
                        { sortable: false },
                        { sortable: false },
                        { sortable: false },
                        { sortable: false },
                        { sortable: false },
                        { sortable: false }
                    ],
                    order: [],
                    columnDefs: [
                        {
                            targets: 0,
                            data: "user_id",
                            render: function (data, type, row, meta) {
                                return `<div class="text-center">
                                    <a href="<?= base_url(); ?>user_management/profile/${row[0]}" class="btn btn-xs btn-default">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a href="<?= base_url(); ?>user_management/edit/${row[0]}" class="btn btn-xs btn-warning">
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
                    ajax: {
                        url: '<?= base_url("data/userManagement/") ?>' + status,
                        type: 'GET'
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

                setTimeout(function () {
                    $('.tableTools-container-' + tableId).find('a.dt-button').each(function () {
                        var div = $(this).find(' > div').first();
                        if (div.length === 1) {
                            div.tooltip({ container: 'body', title: div.parent().text() });
                        } else {
                            $(this).tooltip({ container: 'body', title: $(this).text() });
                        }
                    });
                }, 500);

                return myTable;
            }

            // Initialize all tables
            var activeTable = initializeTable('active-table', 'active');
            var inactiveTable = initializeTable('inactive-table', 'inactive');
            var pendingTable = initializeTable('pending-table', 'pending');

            // Delete user with confirmation using Bootbox
            $(document).on('click', '.delete-user', function (e) {
                e.preventDefault();
                let userId = $(this).data('id');
                let url = "<?= base_url(); ?>/user_management/delete/" + userId;

                bootbox.confirm("Are you sure you want to delete this user?", function (result) {
                    if (result === true) {
                        $.ajax({
                            url: url,
                            type: "DELETE",
                            dataType: "JSON",
                            success: function (data) {
                                bootbox.alert(data.message || "User deleted successfully!", function () {
                                    location.reload();
                                });
                            },
                            error: function () {
                                bootbox.alert("Error deleting user. Please try again.");
                            }
                        });
                    }
                });
            });

            // Redirect to add user page
            $('.addbtn').on('click', function () {
                let url = "<?= base_url(); ?>user_management/add";
                window.location.href = url;
            });
        });
        </script>


<?= $this->endSection() ?>
