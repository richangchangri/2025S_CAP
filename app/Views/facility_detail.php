<?= $this->extend('layout/page_layout') ?>

<?= $this->section('content') ?>

<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    Facility
                </li>
                <li class="active"><?= esc($facility['name']); ?></li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content">
            <div class="page-header">
                <h1>
                    Facility
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        Facility Detail
                    </small>
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        <?= esc($facility['name']); ?>
                    </small>
                </h1>
            </div><!-- /.page-header -->
            <div class="row">
                <div class="col-md-5">
                    <h4 class="widget-title lighter"><?= esc($facility['name']); ?></h4>
                    <div class="profile-user-info profile-user-info-striped">

                        <div class="profile-info-row">
                            <div class="profile-info-name"> Location </div>

                            <div class="profile-info-value">
                                <i class="fa fa-map-marker light-orange bigger-110"></i>
                                <input type="hidden" id="facility_id" name="facility_id" placeholder="facility_id" class="form-control" value="<?= $facility['facility_id']; ?>" required>
                                <span class="editable editable-click" id="location"><?= esc($facility['location']); ?></span>
                            </div>
                        </div>

                        <div class="profile-info-row">
                            <div class="profile-info-name"> Type </div>
                            <div class="profile-info-value">
                                <span class="editable editable-click" id="facilities_type"><?= esc($facility['facilities_type_name']); ?></span>
                            </div>
                        </div>

                        <div class="profile-info-row">
                            <div class="profile-info-name"> Status </div>

                            <div class="profile-info-value">
                                <span class="editable editable-click" id="status"><?= esc($facility['status']); ?></span>
                            </div>
                        </div>

                        <div class="profile-info-row">
                            <div class="profile-info-name"> Capacity </div>

                            <div class="profile-info-value">
                                <span class="editable editable-click" id="capacity"><?= esc($facility['capacity']); ?></span>
                            </div>
                        </div>

                        <div class="profile-info-row">
                            <div class="profile-info-name"> Description </div>

                            <div class="profile-info-value">
                                <span class="editable editable-click" id="description"><?= esc($facility['description']); ?></span>
                            </div>
                        </div>
                        <div class="profile-info-row">
                            <div class="profile-info-name"> Link Display </div>

                            <div class="profile-info-value">
                                <span class="editable editable-click" id="description"><a href="<?= base_url('display.html?facility='. esc($facility['facility_code'])); ?>" title="click here to show display facility screen" target="_blank"><?= base_url('display.html?facility='. esc($facility['facility_code'])); ?></a></span>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-md-7">
                    <h4 class="widget-title lighter">CALENDAR</h4>
                    <div class="space"></div>

                    <div id="calendar" class="fc fc-ltr fc-unthemed"> </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
        $(document).ready(function() {
            var date = new Date();
            var d = date.getDate();
            var m = date.getMonth();
            var y = date.getFullYear();


            var calendar = $('#calendar').fullCalendar({
                //isRTL: true,
                //firstDay: 1,// >> change first day of week 
                
                buttonHtml: {
                    prev: '<i class="ace-icon fa fa-chevron-left"></i>',
                    next: '<i class="ace-icon fa fa-chevron-right"></i>'
                },
            
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                events: "<?= base_url('data/loadAgenda/'.$facility['facility_id']); ?>",
              
                /**eventResize: function(event, delta, revertFunc) {

                    alert(event.title + " end is now " + event.end.format());

                    if (!confirm("is this okay?")) {
                        revertFunc();
                    }

                },*/
                
                editable: true,
                droppable: true, // this allows things to be dropped onto the calendar !!!
                drop: function(date) { // this function is called when something is dropped
                
                    // retrieve the dropped element's stored Event Object
                    var originalEventObject = $(this).data('eventObject');
                    var $extraEventClass = $(this).attr('data-class');
                    
                    
                    // we need to copy it, so that multiple events don't have a reference to the same object
                    var copiedEventObject = $.extend({}, originalEventObject);
                    
                    // assign it the date that was reported
                    copiedEventObject.start = date;
                    copiedEventObject.allDay = false;
                    if($extraEventClass) copiedEventObject['className'] = [$extraEventClass];
                    
                    // render the event on the calendar
                    // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                    $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
                    
                    // is the "remove after drop" checkbox checked?
                    if ($('#drop-remove').is(':checked')) {
                        // if so, remove the element from the "Draggable Events" list
                        $(this).remove();
                    }
                    
                } ,
                selectable: true,
                selectHelper: true,
                select: function(start, end, allDay) {
                    
                    bootbox.prompt("New Event Title:", function(title) {
                        if (title !== null) {
                            calendar.fullCalendar('renderEvent',
                                {
                                    title: title,
                                    start: start,
                                    end: end,
                                    allDay: allDay,
                                    className: 'label-info'
                                },
                                true // make the event "stick"
                            );
                        }
                    });
                    

                    calendar.fullCalendar('unselect');
                }
                ,
                eventClick: function(calEvent, jsEvent, view) {
                    // Convert millisecond timestamp to formatted date string
                    function formatDate(timestamp) {
                        var date = new Date(timestamp);
                        // alert(date);
                        var year = date.getFullYear();
                        // alert(year);

                        var month = String(date.getMonth() + 1).padStart(2, '0');
                        var day = String(date.getDate()).padStart(2, '0');

                        // var hours = date.getHours();
                        let hours = date.getHours();
                        // const minutes = String(date.getMinutes()).padStart(2, '0');
                        // const ampm = hours >= 12 ? 'PM' : 'AM';

                        hours = hours % 12;
                        hours = hours ? hours : 12; // 0 => 12
                        const formattedHours = String(hours).padStart(2, '0');
                        alert(hours);
                        alert(formattedHours);
                        var minutes = String(date.getMinutes()).padStart(2, '0');
                        // alert(minutes);
                        var ampm = hours >= 12 ? 'PM' : 'AM';
                        var hour12 = String(hours % 12 || 12).padStart(2, '0');

                        return `${year}-${month}-${day} ${hour12}:${minutes} ${ampm}`;
                    }
                    // alert(calEvent.start);
                    alert(calEvent.start);
                    var formattedStart = formatDate(calEvent.start);
                    var formattedEnd = calEvent.end ? formatDate(calEvent.end.valueOf()) : '';
                    //display a modal
                    var modal = 
                    '<div class="modal fade">\
                    <div class="modal-dialog">\
                    <div class="modal-content">\
                        <div class="modal-body">\
                        <button type="button" class="close" data-dismiss="modal" style="margin-top:-10px;">&times;</button>\
                        <form  class="form-horizontal no-margin" role="form">\
                            <div class="form-group">\
                                <label class="col-sm-3 control-label no-padding-right" for="event">Event </label>\
                                <div class="col-sm-9">\
                                    <input type="text" id="title" name="title" placeholder="Ex. Event Name" class="col-sm-12 col-md-12 medium"  value="' + calEvent.title + '" >\
                                </div>\
                            </div>\
                            <div class="form-group">\
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Start Time </label>\
                                <div class="col-sm-9">\
                                    <input type="text" id="start_time" name="start_time" placeholder="Y/m/d H:i" class="col-sm-12 col-md-12 medium"  value="' + formattedStart  + '" >\
                                </div>\
                            </div>\
                            <div class="form-group">\
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">End Time </label>\
                                <div class="col-sm-9">\
                                    <input type="text" id="end_time" name="end_time" placeholder="Y/m/d H:i" class="col-sm-12 col-md-12 medium"  value="' + formattedEnd + '" >\
                                </div>\
                            </div>\
                        </form>\
                        </div>\
                        <div class="modal-footer">\
                            <button type="button" class="btn btn-sm" data-dismiss="modal"><i class="ace-icon fa fa-times"></i> Close</button>\
                        </div>\
                    </div>\
                    </div>\
                    </div>';
                
                
                    var modal = $(modal).appendTo('body');
                    modal.find('form').on('submit', function(ev){
                        ev.preventDefault();

                        calEvent.title = $(this).find("input[type=text]").val();
                        calendar.fullCalendar('updateEvent', calEvent);
                        modal.modal("hide");
                    });
                    modal.find('button[data-action=delete]').on('click', function() {
                        calendar.fullCalendar('removeEvents' , function(ev){
                            return (ev._id == calEvent._id);
                        })
                        modal.modal("hide");
                    });
                    
                    modal.modal('show').on('hidden', function(){
                        modal.remove();
                    });


                    //console.log(calEvent.id);
                    //console.log(jsEvent);
                    //console.log(view);

                    // change the border color just for fun
                    //$(this).css('border-color', 'red');

                }
                
            });
            
        });
</script>
<?= $this->endSection() ?>
