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
            <!-- /.col -->
            <div class="col-sm-1"></div>
            <div class="col-sm-10">
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




        var tab = Array();
        //ce tableau permet d'enregster les valeurs des jours déjà pris
        var tabdejapris = Array();
    @foreach($conges as $conge)
          tab["{{$conge->id.' '.$conge->nom.' '.$conge->prenom}}"]={{$conge->jour}};
        tabdejapris["{{$conge->id.' '.$conge->nom.''.$conge->prenom}}"]=0;
    @endforeach






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
                y    = date.getFullYear();
        function getdate(tt) {


            var date = new Date(tt);
            var newdate = new Date(date);

            newdate.setDate(newdate.getDate() + 1);

            var dd = newdate.getDate();
            var mm = newdate.getMonth() + 1;
            var y = newdate.getFullYear();

            if(mm<10){
                mm='0'+mm;
            }
            if(dd<10){
                dd='0'+dd;
            }
            var someFormattedDate =  y+'-'+mm+'-'+dd;

            return someFormattedDate;
        }
        var  tab_events  = [
                @foreach($conges as $congessss)
            {


                title          : '{{$congessss->nom.' '.$congessss->prenom}}',
                start          : '{{$congessss->debut}}',
                @if(isset($congessss->reprise))
                end          : '{{$congessss->reprise}}',
                valeurr         : '{{$congessss->reprise}}',
                @endif
                backgroundColor: '{{$colors[$congessss->id]}}', //red
                borderColor    : '{{$colors[$congessss->id]}}', //red
                editable  : true,
                startEditable : true,
                durationEditable: true,

            },
            @endforeach
        ];
        for(var i=0;i<tab_events.length;i++){

            if(tab_events[i].end!='' && typeof(tab_events[i].end)!="undefined"){
                tab_events[i].end=getdate(tab_events[i].valeurr);
              //  alert(tab_events[0].title+" "+tab_events[i].end);
            }else{

            }

        }
        console.log(tab_events);

     var calendar=   $('#calendar').fullCalendar({
            locale: 'fr',
            header    : {
                left  : 'prev,next today',
                center: 'title',
                right : 'listWeek,month'
            },
         buttonText: {
             list: 'list',
             month: 'month',
             week : 'week',
             day  : 'day'
         },
            //Random default events
            editable  : true,
         durationEditable: true,
         displayEventEnd:true,
            droppable : true, // this allows things to be dropped onto the calendar !!!

            eventRender: function(event, element) {
                element.append( "<span class='closeon' style='color: white; font-size: medium'> X Retirer</span>" );
                element.find(".closeon").click(function() {


                    $('#calendar').fullCalendar('removeEvents',event._id);

                   // var data = table.row($(this).closest('tr')).data();
                   // data[Object.keys(data)[2]]++;
                    //tabdejapris[$(this).closest('div')[0].innerHTML]= tabdejapris[$(this).closest('div')[0].innerHTML]+1;
                  //  console.log(tabdejapris[$(this).closest('div')[0].innerHTML]);
                    //tab[$(this).closest('div')[0].innerHTML]=data[Object.keys(data)[2]];

                   // $(this).closest('td').next().html(tab[$(this).closest('div')[0].innerHTML]);

                    var events = $('#calendar').fullCalendar('clientEvents');
                    var totday=0;
                    for (var i = 0; i < events.length; i++) {
                        events[i].weekdays=false;
                        var start_date = new Date(events[i].start._d);
                        var end_date = '';
                        if (events[i].end != null) {
                            end_date = new Date(events[i].end._d);
                        }
                        var title = events[i].title;

                        if(events[i].title==event.title){
                            var st_day = start_date.getDate();
                            var st_monthIndex = start_date.getMonth() + 1;
                            var st_year = start_date.getFullYear();

                            var en_day ='';
                            var en_monthIndex = '';
                            var en_year = '';
                            if (end_date != '') {
                                en_day = end_date.getDate()-1;
                                en_monthIndex = end_date.getMonth()+1;
                                en_year = end_date.getFullYear();
                            }

                            diff  = new Date(end_date - start_date);
                            days  = diff/1000/60/60/24;
                            console.log(days);
                            totday=totday + days;
                        }

                    }

                    tabdejapris[event.title]=totday;
                    $(".external-event:contains("+event.title+")").closest('td').next().html(tab[event.title]- tabdejapris[event.title] );
                   // console.log('Title-'+title+', start Date-' + st_year + '-' + st_monthIndex + '-' + st_day + ' , End Date-' + en_year + '-' + en_monthIndex + '-' + en_day);

                });
            },
         weekends:false,


            drop      : function (date, allDay) { // this function is called when something is dropped

                var tr = $(this).closest('tr');  //Find DataTables table row
                var theRowObject = table.row(tr); //Get DataTables row object
                var thistr=this;
              //  console.log($(this).closest('div')[0].innerHTML);
                var data = table.row($(this).closest('tr')).data();
                $('#id').val(data[Object.keys(data)[0]]);

                var nombrejourRestant=data[Object.keys(data)[2]];
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
                var events = $('#calendar').fullCalendar('clientEvents');
                var totday=0;
                for (var i = 0; i < events.length; i++) {
                    events[i].weekdays=false;
                    var start_date = new Date(events[i].start._d);
                    var end_date = '';
                    if (events[i].end != null) {
                        end_date = new Date(events[i].end._d);
                    }else{
                        end_date = new Date(events[i].start._d);
                    }
                    var title = events[i].title;

                    if(events[i].title==$(this).closest('div')[0].innerHTML){
                        var st_day = start_date.getDate();
                        var st_monthIndex = start_date.getMonth() + 1;
                        var st_year = start_date.getFullYear();

                        var en_day ='';
                        var en_monthIndex = '';
                        var en_year = '';
                        if (end_date != '') {
                            en_day = end_date.getDate()-1;
                            en_monthIndex = end_date.getMonth()+1;
                            en_year = end_date.getFullYear();
                        }

                        diff  = new Date(end_date - start_date);
                                days  = diff/1000/60/60/24;
                        if(days==0){
                            days=1;
                        }
                        totday=totday + days;
                    }

                }

                tabdejapris[$(this).closest('div')[0].innerHTML]=totday;
                $(".external-event:contains("+$(this).closest('div')[0].innerHTML+")").closest('td').next().html(tab[$(this).closest('div')[0].innerHTML] - tabdejapris[$(this).closest('div')[0].innerHTML]);
                console.log('Title-'+title+', start Date-' + st_year + '-' + st_monthIndex + '-' + st_day + ' , End Date-' + en_year + '-' + en_monthIndex + '-' + en_day);


            },
         eventResize: function(info) {

             var events = $('#calendar').fullCalendar('clientEvents');
             var totday=0;
             for (var i = 0; i < events.length; i++) {
                 events[i].weekdays=false;
                 var start_date = new Date(events[i].start._d);
                 var end_date = '';
                 if (events[i].end != null) {
                     end_date = new Date(events[i].end._d);
                 }
                 var title = events[i].title;

                 if(events[i].title==info.title){
                     var st_day = start_date.getDate();
                     var st_monthIndex = start_date.getMonth() + 1;
                     var st_year = start_date.getFullYear();

                     var en_day ='';
                     var en_monthIndex = '';
                     var en_year = '';
                     if (end_date != '') {
                         en_day = end_date.getDate()-1;
                         en_monthIndex = end_date.getMonth()+1;
                         en_year = end_date.getFullYear();
                     }

                     diff  = new Date(end_date - start_date),
                             days  = diff/1000/60/60/24;
                     totday=totday + days;
                          }

             }
             tabdejapris[info.title]=totday;
             $(".external-event:contains("+info.title+")").closest('td').next().html(tab[info.title] - tabdejapris[info.title]);
             console.log('Title-'+title+', start Date-' + st_year + '-' + st_monthIndex + '-' + st_day + ' , End Date-' + en_year + '-' + en_monthIndex + '-' + en_day+ ' diff'+totday);

         },
         //Random default events

         events    : tab_events
        });

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
        $('#enregistrer_conges').click(function() {

         //   var selectionner=$('#calendar').fullCalendar('clientEvents');
            var events = $('#calendar').fullCalendar('clientEvents');
console.log(events);
            var conges = new Array();
            function Conges (numero,startDate,EndDate,backgroundColor,nb_days) {
                this.numero=numero;
                this.startDate = startDate;
                this.EndDate = EndDate;
                this.backgroundColor=backgroundColor;
                this.nb_days=nb_days;
            }
            for (var i = 0; i < events.length; i++) {
                var start_date = new Date(events[i].start._d);
                var end_date = '';
                if (events[i].end != null) {
                    end_date = new Date(events[i].end._d);
                }
                var title = events[i].title;


                var st_day = start_date.getDate();
                var st_monthIndex = start_date.getMonth() + 1;
                var st_year = start_date.getFullYear();

                var en_day ='';
                var en_monthIndex = '';
                var en_year = '';
                if (end_date != '') {
                    en_day = end_date.getDate()-1;
                    en_monthIndex = end_date.getMonth()+1;
                    en_year = end_date.getFullYear();
                }
                if(end_date!=''){
                    diff  = new Date(end_date - start_date);
                    days  = diff/1000/60/60/24;

                }else{
                    days=1;
                }


                if(en_year=='' && en_monthIndex== '' && en_day==''){
                    conges[i]= new Conges(parseInt(events[i].title),st_year + '-' + st_monthIndex + '-' + st_day, '',events[i].backgroundColor,days);
                }else{
                    conges[i]= new Conges(parseInt(events[i].title),st_year + '-' + st_monthIndex + '-' + st_day, en_year + '-' + en_monthIndex + '-' + en_day,events[i].backgroundColor,days);
                }



                console.log('Title-'+title+', start Date-' + st_year + '-' + st_monthIndex + '-' + st_day + ' , End Date-' + en_year + '-' + en_monthIndex + '-' + en_day);
            }
            console.log('conges_save/'+JSON.stringify(conges));

if (confirm('Voulez vous enregistrer les modification?')){
    var csrf_token = $('meta[name="csrf-token"]').attr('content');
    var variconges=JSON.stringify(conges);

    $.post('conges_save',{variconges:variconges,_token:"{{csrf_token()}}"},function (data){
        console.log(data);
        if(data=='ok'){

            alert('Calendrier des congés mis à jours');
        }

    });
}

        });
    })
</script>
