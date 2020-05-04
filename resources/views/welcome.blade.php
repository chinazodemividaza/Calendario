<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>    


    <link href='core/main.css' rel='stylesheet' />
    <link href='daygrid/main.css' rel='stylesheet' />

    <!-- etilos de vistas -->

    <link href='list/main.css' rel='stylesheet' />
    <link href='timegrid/main.css' rel='stylesheet' />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style>
    /* css de bootstrap */
    
    html,body{
        margin: 0; padding: 0;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 14px;
    }
    #calendar{ max-width: 900px; margin: 40px auto;}
    </style>
    
    <!-- js de bootstrap -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <!-- CODIGO DE FullCalendar -->
    <script src='core/main.js'></script>
    <script src='interaction/main.js'></script>   
    <script src='daygrid/main.js'></script>   



    <!-- PLUGINS (funcionalidadesADICIONALES) -->
    <script src='list/main.js'></script> 
    <script src='timegrid/main.js'></script> 

    <!-- funcionalidades y uso de FullCalendar -->
    <script>

    document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        defaultDate:new Date(2020,2,25),
        plugins: [ 'dayGrid', 'interaction', 'timeGrid', 'list' ],
        // SI SE COMENTA LA LINEA DE ABAJO , REGRESA A LA VISTA ORIGINAL DE TODO EL MES
        // defaultView:'timeGridWeek'

        header:{
            left:'prev,next today, Miboton',
            center:'title',
            right: 'dayGridMonth ,timeGridWeek ,timeGridDay'
        },

        customButtons:{
            Miboton:{
                text:"Botón",
                click:function(){
                    alert("que rollo");
                    $('#exampleModal').modal('toggle');
                }
            }
        },

        dateClick:function(info){
            $('#exampleModal').modal();
            console.log(info);
            calendar.addEvent({title:"Perras",date:info.dateStr});
        },

        eventClick:function(info){

            console.log(info);
            console.log(info.event.title);
            console.log(info.event.start);
            console.log(info.event.end);
            console.log(info.event.textColor);
            console.log(info.event.backgroundColor);

            console.log(info.event.extendedProps.descripcion);
        },

        events:[
            {
                title:"Evento 1",
                start:"2020-03-25 12:30:00",
                end:"2020-03-30 12:45:00",
                color:"#FFCCAA",
                textColor:"#000000",
                descripcion:"se come chido"

            },
            {
                title:"Evento 2",
                start:"2020-03-26 12:30:00",
                descripcion:"se come CACA"
            }
        ]


    });
    calendar.setOption('locale',"Es")

    calendar.render();
    });

</script>
</head>
<body>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<div class="alert alert-danger" >
  This is a danger alert—check it out!
</div>
<div id="calendar">

</div>
</body>
</html>