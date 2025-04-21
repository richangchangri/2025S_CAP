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
                    <li class="active">Feedback</li>
                </ul><!-- /.breadcrumb -->
            </div>

            <div class="page-content">

                <div class="page-header">
                    <h1>
                        Home
                        <small>
                            <i class="ace-icon fa fa-angle-double-right"></i>
                            Feedback
                        </small>
                    </h1>
                </div><!-- /.page-header -->

                <div class="row">
                    <div class="col-md-12">
                        <h4 class="widget-title lighter">FEEDBACK LISTS</h4>
                        <div class="col-sm-12">
                            <table id="feedback" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <!-- <th>Action</th> -->
                                        <th>Facility Name</th>
                                        <th>Location</th>
                                        <th>Rating <i class="fa fa-star"></i></th>
                                        <th>Comment</th>
                                        <th>Submitted By</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <!-- <th>Action</th> -->
                                        <th>Facility Name</th>
                                        <th>Location</th>
                                        <th>Rating <i class="fa fa-star"></i></th>
                                        <th>Comment</th>
                                        <th>Submitted By</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            function initializeTable(tableId) {
                var myTable = $('#' + tableId).DataTable({
                    bAutoWidth: false,
                    "aoColumns": [
                        // { "bSortable": false },
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
                            data: "feedback_id",
                            render: function (data, type, row, meta) {
                                return `${row[5]}, ${row[4]}`;
                            }
                        }
                    ],
                    select: {
                        style: 'multi'
                    },
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "<?= base_url('data/getFeedback') ?>",
                        type: "POST"
                    },
                    dom: 'Bfrtip',
                    buttons: [
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
        var feedbackTable = initializeTable('feedback');         

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