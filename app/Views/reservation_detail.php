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
                <li class="">Reservation</li>
                <li class="active">Meeting Room 1</li>
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
                        Reservation
                    </small>
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        Meeting Room 1
                    </small>
                </h1>
            </div><!-- /.page-header -->
            <div class="row">
                <div class="col-md-12">
                    <h4 class="widget-title lighter">RESERVATION</h4>
                    <span class="btn btn-app btn-sm btn-primary no-hover">
                        <span class="line-height-1 bigger-170"> 4 </span>
                        <br>
                        <span class="line-height-1 smaller-90"> Pending </span>
                    </span>
                    <span class="btn btn-app btn-sm btn-primary no-hover">
                        <span class="line-height-1 bigger-170"> 6 </span>
                        <br>
                        <span class="line-height-1 smaller-90"> Approved </span>
                    </span>
                    <span class="btn btn-app btn-sm btn-primary no-hover">
                        <span class="line-height-1 bigger-170"> 6 </span>
                        <br>
                        <span class="line-height-1 smaller-90"> Rejected </span>
                    </span>
                    <span class="btn btn-app btn-sm btn-primary no-hover">
                        <span class="line-height-1 bigger-170"> 10 </span>
                        <br>
                        <span class="line-height-1 smaller-90"> Total </span>
                    </span>
                </div>
            </div>

            <div class="row">
                <div class="col-md-5">
                    <h4 class="widget-title lighter">MEETING ROOM 1</h4>
                    <div class="profile-user-info profile-user-info-striped">

                        <div class="profile-info-row">
                            <div class="profile-info-name"> Facility Name </div>

                            <div class="profile-info-value">
                                <span class="editable editable-click" id="country">MEETING ROOM 1</span>
                            </div>
                        </div>

                        <div class="profile-info-row">
                            <div class="profile-info-name"> User </div>

                            <div class="profile-info-value">
                                <span class="editable editable-click" id="age">COLOMBUS</span>
                            </div>
                        </div>

                        <div class="profile-info-row">
                            <div class="profile-info-name"> Department</div>

                            <div class="profile-info-value">
                                <span class="editable editable-click" id="signup">FINANCE</span>
                            </div>
                        </div>

                        <div class="profile-info-row">
                            <div class="profile-info-name"> Meeting Details </div>

                            <div class="profile-info-value">
                                <span class="editable editable-click" id="login">ADVISING EMPLOYEES</span>
                            </div>
                        </div>

                        <div class="profile-info-row">
                            <div class="profile-info-name"> Date/Time </div>

                            <div class="profile-info-value">
                                <span class="editable editable-click" id="login">14 October 2025 14.00 to 15.00 EST</span>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-md-7">
                    <h4 class="widget-title lighter">DATE AVAILABLE</h4>
                    <div class="space"></div>

                    <div id="calendar" class="fc fc-ltr fc-unthemed">
                        <div class="fc-toolbar">
                            <div class="fc-left">
                                <div class="fc-button-group"><button type="button"
                                        class="fc-prev-button fc-button fc-state-default fc-corner-left"><span
                                            class="fc-icon fc-icon-left-single-arrow"></span></button><button
                                        type="button"
                                        class="fc-next-button fc-button fc-state-default fc-corner-right"><span
                                            class="fc-icon fc-icon-right-single-arrow"></span></button></div><button
                                    type="button"
                                    class="fc-today-button fc-button fc-state-default fc-corner-left fc-corner-right fc-state-disabled"
                                    disabled="disabled">today</button>
                            </div>
                            <div class="fc-right">
                                <div class="fc-button-group"><button type="button"
                                        class="fc-month-button fc-button fc-state-default fc-corner-left fc-state-active">month</button><button
                                        type="button"
                                        class="fc-agendaWeek-button fc-button fc-state-default">week</button><button
                                        type="button"
                                        class="fc-agendaDay-button fc-button fc-state-default fc-corner-right">day</button>
                                </div>
                            </div>
                            <div class="fc-center">
                                <h2>March 2025</h2>
                            </div>
                            <div class="fc-clear"></div>
                        </div>
                        <div class="fc-view-container" style="">
                            <div class="fc-view fc-month-view fc-basic-view" style="">
                                <table>
                                    <thead class="fc-head">
                                        <tr>
                                            <td class="fc-head-container fc-widget-header">
                                                <div class="fc-row fc-widget-header">
                                                    <table>
                                                        <thead>
                                                            <tr>
                                                                <th class="fc-day-header fc-widget-header fc-sun">Sun
                                                                </th>
                                                                <th class="fc-day-header fc-widget-header fc-mon">Mon
                                                                </th>
                                                                <th class="fc-day-header fc-widget-header fc-tue">Tue
                                                                </th>
                                                                <th class="fc-day-header fc-widget-header fc-wed">Wed
                                                                </th>
                                                                <th class="fc-day-header fc-widget-header fc-thu">Thu
                                                                </th>
                                                                <th class="fc-day-header fc-widget-header fc-fri">Fri
                                                                </th>
                                                                <th class="fc-day-header fc-widget-header fc-sat">Sat
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                    </table>
                                                </div>
                                            </td>
                                        </tr>
                                    </thead>
                                    <tbody class="fc-body">
                                        <tr>
                                            <td class="fc-widget-content">
                                                <div class="fc-day-grid-container" style="">
                                                    <div class="fc-day-grid">
                                                        <div class="fc-row fc-week fc-widget-content"
                                                            style="height: 150px;">
                                                            <div class="fc-bg">
                                                                <table>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="fc-day fc-widget-content fc-sun fc-other-month fc-past"
                                                                                data-date="2025-02-23"></td>
                                                                            <td class="fc-day fc-widget-content fc-mon fc-other-month fc-past"
                                                                                data-date="2025-02-24"></td>
                                                                            <td class="fc-day fc-widget-content fc-tue fc-other-month fc-past"
                                                                                data-date="2025-02-25"></td>
                                                                            <td class="fc-day fc-widget-content fc-wed fc-other-month fc-past"
                                                                                data-date="2025-02-26"></td>
                                                                            <td class="fc-day fc-widget-content fc-thu fc-other-month fc-past"
                                                                                data-date="2025-02-27"></td>
                                                                            <td class="fc-day fc-widget-content fc-fri fc-other-month fc-past"
                                                                                data-date="2025-02-28"></td>
                                                                            <td class="fc-day fc-widget-content fc-sat fc-past"
                                                                                data-date="2025-03-01"></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <div class="fc-content-skeleton">
                                                                <table>
                                                                    <thead>
                                                                        <tr>
                                                                            <td class="fc-day-number fc-sun fc-other-month fc-past"
                                                                                data-date="2025-02-23">23</td>
                                                                            <td class="fc-day-number fc-mon fc-other-month fc-past"
                                                                                data-date="2025-02-24">24</td>
                                                                            <td class="fc-day-number fc-tue fc-other-month fc-past"
                                                                                data-date="2025-02-25">25</td>
                                                                            <td class="fc-day-number fc-wed fc-other-month fc-past"
                                                                                data-date="2025-02-26">26</td>
                                                                            <td class="fc-day-number fc-thu fc-other-month fc-past"
                                                                                data-date="2025-02-27">27</td>
                                                                            <td class="fc-day-number fc-fri fc-other-month fc-past"
                                                                                data-date="2025-02-28">28</td>
                                                                            <td class="fc-day-number fc-sat fc-past"
                                                                                data-date="2025-03-01">1</td>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td class="fc-event-container"><a
                                                                                    class="fc-day-grid-event fc-h-event fc-event fc-start fc-end label-important fc-draggable">
                                                                                    <div class="fc-content"><span
                                                                                            class="fc-time">12a</span>
                                                                                        <span class="fc-title">All Day
                                                                                            Event</span></div>
                                                                                </a></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <div class="fc-row fc-week fc-widget-content"
                                                            style="height: 150px;">
                                                            <div class="fc-bg">
                                                                <table>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="fc-day fc-widget-content fc-sun fc-past"
                                                                                data-date="2025-03-02"></td>
                                                                            <td class="fc-day fc-widget-content fc-mon fc-past"
                                                                                data-date="2025-03-03"></td>
                                                                            <td class="fc-day fc-widget-content fc-tue fc-past"
                                                                                data-date="2025-03-04"></td>
                                                                            <td class="fc-day fc-widget-content fc-wed fc-past"
                                                                                data-date="2025-03-05"></td>
                                                                            <td class="fc-day fc-widget-content fc-thu fc-past"
                                                                                data-date="2025-03-06"></td>
                                                                            <td class="fc-day fc-widget-content fc-fri fc-past"
                                                                                data-date="2025-03-07"></td>
                                                                            <td class="fc-day fc-widget-content fc-sat fc-past"
                                                                                data-date="2025-03-08"></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <div class="fc-content-skeleton">
                                                                <table>
                                                                    <thead>
                                                                        <tr>
                                                                            <td class="fc-day-number fc-sun fc-past"
                                                                                data-date="2025-03-02">2</td>
                                                                            <td class="fc-day-number fc-mon fc-past"
                                                                                data-date="2025-03-03">3</td>
                                                                            <td class="fc-day-number fc-tue fc-past"
                                                                                data-date="2025-03-04">4</td>
                                                                            <td class="fc-day-number fc-wed fc-past"
                                                                                data-date="2025-03-05">5</td>
                                                                            <td class="fc-day-number fc-thu fc-past"
                                                                                data-date="2025-03-06">6</td>
                                                                            <td class="fc-day-number fc-fri fc-past"
                                                                                data-date="2025-03-07">7</td>
                                                                            <td class="fc-day-number fc-sat fc-past"
                                                                                data-date="2025-03-08">8</td>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <div class="fc-row fc-week fc-widget-content"
                                                            style="height: 150px;">
                                                            <div class="fc-bg">
                                                                <table>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="fc-day fc-widget-content fc-sun fc-past"
                                                                                data-date="2025-03-09"></td>
                                                                            <td class="fc-day fc-widget-content fc-mon fc-past"
                                                                                data-date="2025-03-10"></td>
                                                                            <td class="fc-day fc-widget-content fc-tue fc-past"
                                                                                data-date="2025-03-11"></td>
                                                                            <td class="fc-day fc-widget-content fc-wed fc-past"
                                                                                data-date="2025-03-12"></td>
                                                                            <td class="fc-day fc-widget-content fc-thu fc-past"
                                                                                data-date="2025-03-13"></td>
                                                                            <td class="fc-day fc-widget-content fc-fri fc-past"
                                                                                data-date="2025-03-14"></td>
                                                                            <td class="fc-day fc-widget-content fc-sat fc-past"
                                                                                data-date="2025-03-15"></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <div class="fc-content-skeleton">
                                                                <table>
                                                                    <thead>
                                                                        <tr>
                                                                            <td class="fc-day-number fc-sun fc-past"
                                                                                data-date="2025-03-09">9</td>
                                                                            <td class="fc-day-number fc-mon fc-past"
                                                                                data-date="2025-03-10">10</td>
                                                                            <td class="fc-day-number fc-tue fc-past"
                                                                                data-date="2025-03-11">11</td>
                                                                            <td class="fc-day-number fc-wed fc-past"
                                                                                data-date="2025-03-12">12</td>
                                                                            <td class="fc-day-number fc-thu fc-past"
                                                                                data-date="2025-03-13">13</td>
                                                                            <td class="fc-day-number fc-fri fc-past"
                                                                                data-date="2025-03-14">14</td>
                                                                            <td class="fc-day-number fc-sat fc-past"
                                                                                data-date="2025-03-15">15</td>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <div class="fc-row fc-week fc-widget-content"
                                                            style="height: 150px;">
                                                            <div class="fc-bg">
                                                                <table>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="fc-day fc-widget-content fc-sun fc-past"
                                                                                data-date="2025-03-16"></td>
                                                                            <td class="fc-day fc-widget-content fc-mon fc-past"
                                                                                data-date="2025-03-17"></td>
                                                                            <td class="fc-day fc-widget-content fc-tue fc-past"
                                                                                data-date="2025-03-18"></td>
                                                                            <td class="fc-day fc-widget-content fc-wed fc-past"
                                                                                data-date="2025-03-19"></td>
                                                                            <td class="fc-day fc-widget-content fc-thu fc-past"
                                                                                data-date="2025-03-20"></td>
                                                                            <td class="fc-day fc-widget-content fc-fri fc-past"
                                                                                data-date="2025-03-21"></td>
                                                                            <td class="fc-day fc-widget-content fc-sat fc-past"
                                                                                data-date="2025-03-22"></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <div class="fc-content-skeleton">
                                                                <table>
                                                                    <thead>
                                                                        <tr>
                                                                            <td class="fc-day-number fc-sun fc-past"
                                                                                data-date="2025-03-16">16</td>
                                                                            <td class="fc-day-number fc-mon fc-past"
                                                                                data-date="2025-03-17">17</td>
                                                                            <td class="fc-day-number fc-tue fc-past"
                                                                                data-date="2025-03-18">18</td>
                                                                            <td class="fc-day-number fc-wed fc-past"
                                                                                data-date="2025-03-19">19</td>
                                                                            <td class="fc-day-number fc-thu fc-past"
                                                                                data-date="2025-03-20">20</td>
                                                                            <td class="fc-day-number fc-fri fc-past"
                                                                                data-date="2025-03-21">21</td>
                                                                            <td class="fc-day-number fc-sat fc-past"
                                                                                data-date="2025-03-22">22</td>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td rowspan="2"></td>
                                                                            <td rowspan="2"></td>
                                                                            <td rowspan="2"></td>
                                                                            <td rowspan="2"></td>
                                                                            <td class="fc-event-container" colspan="3">
                                                                                <a
                                                                                    class="fc-day-grid-event fc-h-event fc-event fc-start fc-not-end label-success fc-draggable">
                                                                                    <div class="fc-content"> <span
                                                                                            class="fc-title">Long
                                                                                            Event</span></div>
                                                                                </a></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td class="fc-event-container"><a
                                                                                    class="fc-day-grid-event fc-h-event fc-event fc-start fc-end label-info fc-draggable">
                                                                                    <div class="fc-content"><span
                                                                                            class="fc-time">4p</span>
                                                                                        <span class="fc-title">Some
                                                                                            Event</span></div>
                                                                                </a></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <div class="fc-row fc-week fc-widget-content"
                                                            style="height: 150px;">
                                                            <div class="fc-bg">
                                                                <table>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="fc-day fc-widget-content fc-sun fc-past"
                                                                                data-date="2025-03-23"></td>
                                                                            <td class="fc-day fc-widget-content fc-mon fc-past"
                                                                                data-date="2025-03-24"></td>
                                                                            <td class="fc-day fc-widget-content fc-tue fc-today fc-state-highlight"
                                                                                data-date="2025-03-25"></td>
                                                                            <td class="fc-day fc-widget-content fc-wed fc-future"
                                                                                data-date="2025-03-26"></td>
                                                                            <td class="fc-day fc-widget-content fc-thu fc-future"
                                                                                data-date="2025-03-27"></td>
                                                                            <td class="fc-day fc-widget-content fc-fri fc-future"
                                                                                data-date="2025-03-28"></td>
                                                                            <td class="fc-day fc-widget-content fc-sat fc-future"
                                                                                data-date="2025-03-29"></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <div class="fc-content-skeleton">
                                                                <table>
                                                                    <thead>
                                                                        <tr>
                                                                            <td class="fc-day-number fc-sun fc-past"
                                                                                data-date="2025-03-23">23</td>
                                                                            <td class="fc-day-number fc-mon fc-past"
                                                                                data-date="2025-03-24">24</td>
                                                                            <td class="fc-day-number fc-tue fc-today fc-state-highlight"
                                                                                data-date="2025-03-25">25</td>
                                                                            <td class="fc-day-number fc-wed fc-future"
                                                                                data-date="2025-03-26">26</td>
                                                                            <td class="fc-day-number fc-thu fc-future"
                                                                                data-date="2025-03-27">27</td>
                                                                            <td class="fc-day-number fc-fri fc-future"
                                                                                data-date="2025-03-28">28</td>
                                                                            <td class="fc-day-number fc-sat fc-future"
                                                                                data-date="2025-03-29">29</td>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="fc-event-container"><a
                                                                                    class="fc-day-grid-event fc-h-event fc-event fc-not-start fc-end label-success fc-draggable fc-resizable">
                                                                                    <div class="fc-content"> <span
                                                                                            class="fc-title">Long
                                                                                            Event</span></div>
                                                                                    <div
                                                                                        class="fc-resizer fc-end-resizer">
                                                                                    </div>
                                                                                </a></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <div class="fc-row fc-week fc-widget-content"
                                                            style="height: 152px;">
                                                            <div class="fc-bg">
                                                                <table>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="fc-day fc-widget-content fc-sun fc-future"
                                                                                data-date="2025-03-30"></td>
                                                                            <td class="fc-day fc-widget-content fc-mon fc-future"
                                                                                data-date="2025-03-31"></td>
                                                                            <td class="fc-day fc-widget-content fc-tue fc-other-month fc-future"
                                                                                data-date="2025-04-01"></td>
                                                                            <td class="fc-day fc-widget-content fc-wed fc-other-month fc-future"
                                                                                data-date="2025-04-02"></td>
                                                                            <td class="fc-day fc-widget-content fc-thu fc-other-month fc-future"
                                                                                data-date="2025-04-03"></td>
                                                                            <td class="fc-day fc-widget-content fc-fri fc-other-month fc-future"
                                                                                data-date="2025-04-04"></td>
                                                                            <td class="fc-day fc-widget-content fc-sat fc-other-month fc-future"
                                                                                data-date="2025-04-05"></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <div class="fc-content-skeleton">
                                                                <table>
                                                                    <thead>
                                                                        <tr>
                                                                            <td class="fc-day-number fc-sun fc-future"
                                                                                data-date="2025-03-30">30</td>
                                                                            <td class="fc-day-number fc-mon fc-future"
                                                                                data-date="2025-03-31">31</td>
                                                                            <td class="fc-day-number fc-tue fc-other-month fc-future"
                                                                                data-date="2025-04-01">1</td>
                                                                            <td class="fc-day-number fc-wed fc-other-month fc-future"
                                                                                data-date="2025-04-02">2</td>
                                                                            <td class="fc-day-number fc-thu fc-other-month fc-future"
                                                                                data-date="2025-04-03">3</td>
                                                                            <td class="fc-day-number fc-fri fc-other-month fc-future"
                                                                                data-date="2025-04-04">4</td>
                                                                            <td class="fc-day-number fc-sat fc-other-month fc-future"
                                                                                data-date="2025-04-05">5</td>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
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
<?= $this->endSection() ?>