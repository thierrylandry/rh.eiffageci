<!-- Bootstrap CSS-->
<link href="{{  URL::asset("vendor/bootstrap-4.1/bootstrap.min.css") }}" rel="stylesheet" media="screen">
<!-- fullCalendar -->
<link rel="stylesheet" href="{{asset('public/fullcalendar/dist/fullcalendar.min.css')}}">
<link rel="stylesheet" href="{{asset('public/fullcalendar/dist/fullcalendar.print.min.css')}}" media="print">
<!-- Theme style -->
<link rel="stylesheet" href="{{asset('public/dist/css/AdminLTE.min.css')}}">
<!-- AdminLTE Skins. Choose a skin from the css/skins
     folder instead of downloading all of them to reduce the load. -->
<link rel="stylesheet" href="{{asset('public/dist/css/skins/_all-skins.min.css')}}">
<link href="{{ asset("css/jquery.dataTables.min.css") }}" rel="stylesheet" media="screen">



<style>
    .fc-title{
        color: #ffffff;
        font-size: medium;
    }
</style>
<!-- Bootstrap CSS-->
<link href="{{  URL::asset("vendor/bootstrap-4.1/bootstrap.min.css") }}" rel="stylesheet" media="screen">

    <!-- Main content -->
        <div class="row">
            <div class="col-sm-3">
                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h4 class="box-title">Glissez deposer dans le calendrier</h4>
                    </div>
                    <div class="box-body">
                        <!-- the events -->
                        <div id="external-events">
                            <table class=" table  data-table">
                                <thead>
                                <td>id</td>
                                <td>personne</td>
                                <td>jours de congé</td>
                                </thead>
                                <tbody>
                                @foreach($personnes as $personne)
                                <tr>
                                        <td>{{$personne->id}} </td>
                                        <td> <div class="external-event" style="background-color:
{{isset($colors[$personne->id])?$colors[$personne->id]:'black'}};color: white">{{$personne->nom.' '.$personne->prenom}}</div></td>
                                        <td>{{isset($personne->contrat_renouvelles()->where('datedebutc','!=',null)->orderBy('datedebutc','ASC')->first()->datedebutc)? date_diff(new DateTime($personne->contrat_renouvelles()->where('datedebutc','!=',null)->orderBy('datedebutc','ASC')->first()->datedebutc),new DateTime('now'))->m:''}}</td>
                                </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>

            </div>
            <!-- /.col -->
            <div class="col-sm-9">
                <div class="box box-primary">
                    <div class="box-body no-padding">
                        <!-- THE CALENDAR -->
                        <div id="calendar"></div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /. box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    <!-- /.content -->

<!-- jQuery 3 -->
<script src="{{ asset("public/js/jquery.min.js") }}"></script>
<script src="{{ asset("js/dataTables.min.js") }}"></script>

<script src="{{ asset("js/dataTables.checkboxes.js") }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset("public/bootstrap/dist/js/bootstrap.min.js") }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset("public/jquery-ui/jquery-ui.min.js") }}"></script>
<!-- Slimscroll -->
<script src="{{ asset("public/jquery-slimscroll/jquery.slimscroll.min.js") }}"></script>
<!-- FastClick -->
<script src="{{ asset("public/fastclick/lib/fastclick.js") }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset("public/dist/js/adminlte.min.js") }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset("public/dist/js/demo.js") }}"></script>
<!-- fullCalendar -->
<script src="{{ asset("public/moment/moment.js") }}"></script>
<script src="{{asset('public/fullcalendar/dist/fullcalendar.min.js')}}"></script>
<script src="{{asset('public/fullcalendar/dist/locale/fr.js')}}"></script>
<!-- Page specific script -->
<script>
    $(function () {



            var table= $('.data-table').DataTable({
                "order": [[ 0, "desc" ]],
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                language: {
                    url: "{{ asset('public/js/French.json')}}"
                },

                "ordering":true,
                "responsive": true,

                "createdRow": function( row, data, dataIndex){

                },
                columnDefs: [
                    { responsivePriority: 1, targets: 0 },
                    { responsivePriority: 2, targets: -1 }
                ]
            }).column(0).visible(false);
        $(".current").click(function (){
            alert("eee");
        });

        /* initialize the external events
         -----------------------------------------------------------------*/
        function init_events(ele) {
            ele.each(function () {

                // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
                // it doesn't need to have a start or end
                var eventObject = {
                    title: $.trim($(this).text()) // use the element's text as the event title
                }

                // store the Event Object in the DOM element so we can get to it later
                $(this).data('eventObject', eventObject)

                // make the event draggable using jQuery UI
                $(this).draggable({
                    zIndex        : 1070,
                    revert        : true, // will cause the event to go back to its
                    revertDuration: 0  //  original position after the drag
                })

            })
        }

        init_events($('#external-events div.external-event'))

        /* initialize the calendar
         -----------------------------------------------------------------*/
        //Date for the calendar events (dummy data)
        var date = new Date()
        var d    = date.getDate(),
                m    = date.getMonth(),
                y    = date.getFullYear()
        $('#calendar').fullCalendar({
            locale: 'fr',
            header    : {
                left  : 'prev,next today',
                center: 'title',
                right : 'month,agendaWeek,agendaDay'
            },
            buttonText: {
                today: 'today',
                month: 'month',
                week : 'week',
                day  : 'day'
            },
            //Random default events
            editable  : true,
            droppable : true, // this allows things to be dropped onto the calendar !!!

            eventRender: function(event, element) {
                element.append( "<span class='closeon' style='color: white; font-size: medium'> X Retirer</span>" );
                element.find(".closeon").click(function() {
                    $('#calendar').fullCalendar('removeEvents',event._id);
                });
            },


            drop      : function (date, allDay) { // this function is called when something is dropped

                // retrieve the dropped element's stored Event Object
                var originalEventObject = $(this).data('eventObject')

                // we need to copy it, so that multiple events don't have a reference to the same object
                var copiedEventObject = $.extend({}, originalEventObject)

                // assign it the date that was reported
                copiedEventObject.start           = date
                copiedEventObject.allDay          = allDay
                copiedEventObject.backgroundColor = $(this).css('background-color')
                copiedEventObject.borderColor     = $(this).css('border-color')
                copiedEventObject.eventColor='#FFFFFF'

                // render the event on the calendar
                // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                $('#calendar').fullCalendar('renderEvent', copiedEventObject, true)

                // is the "remove after drop" checkbox checked?
                if ($('#drop-remove').is(':checked')) {
                    // if so, remove the element from the "Draggable Events" list
                    $(this).remove()
                }

            }
        })

        /* ADDING EVENTS */
        var currColor = '#3c8dbc' //Red by default
        //Color chooser button
        var colorChooser = $('#color-chooser-btn')
        $('#color-chooser > li > a').click(function (e) {
            e.preventDefault()
            //Save color
            currColor = $(this).css('color')
            //Add color effect to button
            $('#add-new-event').css({ 'background-color': currColor, 'border-color': currColor })
        })
        $('#add-new-event').click(function (e) {
            e.preventDefault()
            //Get value and make sure it is not null
            var val = $('#new-event').val()
            if (val.length == 0) {
                return
            }

            //Create events
            var event = $('<div />')
            event.css({
                'background-color': currColor,
                'border-color'    : currColor,
                'color'           : '#fff'
            }).addClass('external-event')
            event.html(val)
            $('#external-events').prepend(event)

            //Add draggable funtionality
            init_events(event)

            //Remove event from text input
            $('#new-event').val('')
        })
    })
</script>
