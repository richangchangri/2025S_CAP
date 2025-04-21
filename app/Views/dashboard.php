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
                    <li class="active">Dashboard</li>
                </ul><!-- /.breadcrumb -->
            </div>

            <div class="page-content">

                <div class="page-header">
                    <h1>
                        Dashboard
                        <small>
                            <i class="ace-icon fa fa-angle-double-right"></i>
                            overview &amp; stats
                        </small>
                    </h1>
                </div><!-- /.page-header -->
                
                <div class="row">
                    <div class="col-md-3">
                        <h4 class="widget-title lighter">Facilities</h4>
                        <span class="btn btn-app btn-sm btn-light no-hover">
                            <span class="line-height-1 bigger-170 blue" id="usedFacilities"> - </span>
                            <br>
                            <span class="line-height-1 smaller-90"> Used </span>
                        </span>
                        <span class="btn btn-app btn-sm btn-light no-hover">
                            <span class="line-height-1 bigger-170 blue" id="availableFacilities"> - </span>
                            <br>
                            <span class="line-height-1 smaller-90" id="availableFacilities"> Available </span>
                        </span>
                        <span class="btn btn-app btn-sm btn-light no-hover">
                            <span class="line-height-1 bigger-170 blue" id="totalFacilities"> - </span>
                            <br>
                            <span class="line-height-1 smaller-90"> Total </span>
                        </span>
                    </div>
                    <div class="col-md-3">
                        <h4 class="widget-title lighter">New User Approvals</h4>
                        <span class="btn btn-app btn-sm btn-yellow no-hover">
                            <span class="line-height-1 bigger-170" id="pendingApprovals"> - </span>
                            <br>
                            <span class="line-height-1 smaller-90"> Pending </span>
                        </span>
                        <span class="btn btn-app btn-sm btn-yellow no-hover">
                            <span class="line-height-1 bigger-170" id="approvedApprovals"> - </span>
                            <br>
                            <span class="line-height-1 smaller-90"> Approved </span>
                        </span>
                        <span class="btn btn-app btn-sm btn-yellow no-hover">
                            <span class="line-height-1 bigger-170" id="rejectedApprovals"> - </span>
                            <br>
                            <span class="line-height-1 smaller-90"> Rejected </span>
                        </span>
                    </div>
                    <div class="col-md-3">
                        <h4 class="widget-title lighter">Feedbacks</h4>
                        <span class="btn btn-app btn-sm btn-pink no-hover">
                            <span class="line-height-1 bigger-170" id="feedbackWeek"> - </span>
                            <br>
                            <span class="line-height-1 smaller-90"> This Weeks </span>
                        </span>
                        <span class="btn btn-app btn-sm btn-pink no-hover">
                            <span class="line-height-1 bigger-170" id="feedbackTotal"> - </span>
                            <br>
                            <span class="line-height-1 smaller-90"> Total </span>
                        </span>
                    </div>
                    <div class="col-md-3">
                        <h4 class="widget-title lighter">Users</h4>
                        <span class="btn btn-app btn-sm btn-primary no-hover">
                            <span class="line-height-1 bigger-170" id="activeUsers"> - </span>
                            <br>
                            <span class="line-height-1 smaller-90"> Active </span>
                        </span>
                        <span class="btn btn-app btn-sm btn-primary no-hover">
                            <span class="line-height-1 bigger-170" id="inactiveUsers"> - </span>
                            <br>
                            <span class="line-height-1 smaller-90"> Inactive </span>
                        </span>
                        <span class="btn btn-app btn-sm btn-primary no-hover">
                            <span class="line-height-1 bigger-170" id="totalUsers"> - </span>
                            <br>
                            <span class="line-height-1 smaller-90"> Total </span>
                        </span>
                    </div>
                </div>
                <div class="hr hr32 hr-dotted"></div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="widget-box transparent" id="recent-box">
                            <div class="widget-header">
                                <h4 class="widget-title lighter smaller">
                                    <i class="ace-icon fa fa-rss orange"></i>RECENT ACTIVITY
                                </h4>
                            </div>

                            <div class="widget-body">
                                <div class="widget-main padding-4">
                                     <div class="comments ace-scroll"style="position: relative;">
                                                <div class="scroll-track" style="display: none;">
                                                    <div class="scroll-bar"></div>
                                                </div>
                                                <div class="scroll-content" id="recentActivities" style="">
                                                   ...
                                                </div>
                                            </div>
                                            <div class="hr hr-double hr8"></div>
                                </div><!-- /.widget-main -->
                            </div><!-- /.widget-body -->
                        </div><!-- /.widget-box -->
                    </div>
                    <div class="col-sm-6">
                        <div class="widget-box transparent" id="recent-box">
                            <div class="widget-header">
                                <h4 class="widget-title lighter smaller">
                                    <i class="ace-icon fa fa-rss orange"></i>RECENT USERS
                                </h4>
                            </div>

                            <div class="widget-body">
                                <div class="widget-main padding-4">
                                     <div class="comments ace-scroll" style="position: relative;">
                                                <div class="scroll-track" style="display: none;">
                                                    <div class="scroll-bar"></div>
                                                </div>
                                                <div class="scroll-content" id="recentUsers" style="">
                                                   ...
                                                </div>
                                            </div>
                                            <div class="hr hr-double hr8"></div>
                                </div><!-- /.widget-main -->
                            </div><!-- /.widget-body -->
                        </div><!-- /.widget-box -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            function loadDashboardData() {
                $.ajax({
                    url: '/data/dashboardSummary', // make sure this matches the route in Routes.php
                    method: 'GET',
                    dataType: 'json',
                    success: function (res) {
                        // Facilities
                        $('#usedFacilities').text(res.facilities.used);
                        $('#availableFacilities').text(res.facilities.available);
                        $('#totalFacilities').text(res.facilities.total);

                        // Users
                        $('#activeUsers').text(res.users.active);
                        $('#inactiveUsers').text(res.users.inactive);
                        $('#totalUsers').text(res.users.total);

                        // Feedbacks
                        $('#feedbackWeek').text(res.feedback.this_week);
                        $('#feedbackTotal').text(res.feedback.total);

                        // Approvals
                        $('#pendingApprovals').text(res.approvals.pending);
                        $('#approvedApprovals').text(res.approvals.approved);
                        $('#rejectedApprovals').text(res.approvals.rejected);

                        // Activities
                        $('#recentActivities').empty();
                        res.activities.forEach(function (act) {
                            $('#recentActivities').append(`
                                <div class="itemdiv commentdiv">
                                    <div class="user">
                                        <img alt="${act.name}'s Avatar" src="${act.gravatar_url}">
                                    </div>
                                    <div class="body">
                                        <div class="name">
                                            <a href="#">${act.name}</a>
                                        </div>
                                        <div class="time">
                                            <i class="ace-icon fa fa-clock-o"></i>
                                            <span class="green">${timeAgo(act.sent_at)}</span>
                                        </div>
                                        <div class="text">
                                            <i class="ace-icon fa fa-quote-left"></i>
                                            ${act.message} …
                                        </div>
                                    </div>
                                </div>`);
                        });

                        // Recent Users
                        $('#recentUsers').empty();
                        res.lastUsers.forEach(function (act) {
                            $('#recentUsers').append(`
                                <div class="itemdiv commentdiv">
                                    <div class="user">
                                        <img alt="${act.name}'s Avatar" src="${act.gravatar_url}">
                                    </div>
                                    <div class="body">
                                        <div class="name">
                                            <a href="#">${act.name}</a>
                                        </div>
                                        <div class="time">
                                            <i class="ace-icon fa fa-clock-o"></i>
                                            <span class="green">${timeAgo(act.created_at)}</span>
                                        </div>
                                        <div class="text">
                                            <i class="ace-icon fa fa-quote-left"></i>
                                            ${act.name} just joined …
                                        </div>
                                    </div>
                                </div>`);
                        });
                    }
                });
            }

            // Call first time when page loads
            loadDashboardData();

            // Set auto refresh every 5 minutes (300000 ms)
            setInterval(loadDashboardData, 300000); // 5 minutes


            function timeAgo(dateTimeStr) {
                const now = new Date();
                const past = new Date(dateTimeStr);
                const diffMs = now - past;

                const seconds = Math.floor(diffMs / 1000);
                const minutes = Math.floor(diffMs / (1000 * 60));
                const hours = Math.floor(diffMs / (1000 * 60 * 60));
                const days = Math.floor(diffMs / (1000 * 60 * 60 * 24));
                const months = Math.floor(days / 30); // approx
                const years = Math.floor(days / 365); // approx

                if (seconds < 5) return "just now";
                if (seconds < 60) return `${seconds} sec ago`;
                if (minutes < 60) return `${minutes} min ago`;
                if (hours < 24) return `${hours} hr${hours > 1 ? 's' : ''} ago`;
                if (days < 30) return `${days} day${days > 1 ? 's' : ''} ago`;
                if (months < 12) return `${months} mon${months > 1 ? 's' : ''} ago`;
                return `${years} yr${years > 1 ? 's' : ''} ago`;
            }
        });
    </script>
<?= $this->endSection() ?>

