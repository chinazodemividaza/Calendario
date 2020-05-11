@extends('layouts.app')
 

    @section('scripts')
    <link rel="stylesheet" href="{{asset('/fullcalendar/core/main.css')}}">
    <link rel="stylesheet" href="{{asset('/fullcalendar/daygrid/main.css')}}">    
    <link rel="stylesheet" href="{{asset('/fullcalendar/list/main.css')}}">  
    <link rel="stylesheet" href="{{asset('/fullcalendar/timegrid/main.css')}}"> 
    <link rel="stylesheet" href="{{asset('/clockpicker/bootstrap-clockpicker.css')}}">

    <script src="{{asset('fullcalendar/core/main.js')}}" defer ></script>
    <script src="{{asset('fullcalendar/interaction/main.js')}}" defer ></script>
    <script src="{{asset('fullcalendar/daygrid/main.js')}}" defer ></script>
    <script src="{{asset('fullcalendar/list/main.js')}}" defer ></script>
    <script src="{{asset('fullcalendar/timegrid/main.js')}}" defer ></script>
    <script src="{{asset('clockpicker/bootstrap-clockpicker.js')}}"></script>


    <script>
       
        document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var ilimitado=0;


        $("#selectSede").change(function(){ 
                console.log("que pedo que pedo :v");
                $(".optionSede").each(function(){
                    if($(this).is(":selected")){
                        // console.log($(this).val());
                        ilimitado = $(this).data("ilimitado");
                    }
                    if (ilimitado == 1) {
                        
                     
                        $("#txtHora").prop("disabled", true);
                        $("#txtHoraFin").prop("disabled", true);
                        $("#txtHora").val("00:00");
                        $("#txtHoraFin").val("23:00");

                        
                    }
                    if(ilimitado==0) {
                        $("#txtHora").prop("disabled", false);
                        $("#txtHoraFin").prop("disabled", false);
                    }
                });                
            });
            
            // $("#selectSede").change(function(){ 
            //     var ilimitado=0;
            //     $(".optionSede").each(function(){
            //         if($(this).is(":selected")){
            //             // console.log($(this).val());
            //             sedeid = $(this).val();
            //             ilimitado = $(this).data("ilimitado");
            //             colorsede = $(this).data("color");
            //             console.log(colorsede);
            //         }
            //     });

            //     $("#idSede").val(sedeid);
            //     // console.log(sedeid);
            //     $("#ilimitadoFlag").val(ilimitado);
                
            //     // console.log(ilimitado);
                
            //     $("#colorin").val(colorsede);
                
            // });
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            
            plugins: [ 'dayGrid', 'interaction', 'timeGrid', 'list' ],
            
            droppable: true, editable: true,
            // SI SE COMENTA LA LINEA DE ABAJO , REGRESA A LA VISTA ORIGINAL DE TODO EL MES
            // defaultView:'timeGridWeek'
   
            eventDragStop: (info) => {
                // BUscar evento y modificarlos salu2
                console.log(info.event.id);

                $("#txtID").val(info.event.id) ;
            },
            header:{
                left:'prev,next today, Miboton',
                center:'title',
                right: 'dayGridMonth ,timeGridWeek ,timeGridDay'
            },

            // customButtons:{
            //     Miboton:{
            //         text:"Botón",
            //         click:function(){
            //             alert("que rollo");
            //             $('#exampleModal').modal('toggle');
            //         }
            //     }
            // },

            dateClick:function(info){
                $('#selectSede').val("");
                $("#txtHora").prop("disabled", false);
                $("#txtHoraFin").prop("disabled", false);
                $("#selectSede").change(function(){ 
                var ilimitado=0;
                $(".optionSede").each(function(){
                    if($(this).is(":selected")){
                        // console.log($(this).val());
                        sedeid = $(this).val();
                        ilimitado = $(this).data("ilimitado");
                        colorsede = $(this).data("color");
                        console.log(colorsede);
                    }
                });

                $("#idSede").val(sedeid);
                // console.log(sedeid);
                $("#ilimitadoFlag").val(ilimitado);
                
                // console.log(ilimitado);
                
                $("#colorin").val(colorsede);
                
            });



                $('#txtFecha').val(info.dateStr);
                $('#btnAgregar').show();
                $('#btnBorrar').hide();
                $('#btnModificar').hide();
                $('#exampleModal').modal();
                // console.log(info);
                // calendar.addEvent({title:"Perras",date:info.dateStr});
                LimpiarModal();
            },

            eventClick:function(info){

                console.log(info);
                console.log(info.event.title);
                console.log(info.event.start);
                console.log(info.event.end);
                console.log(info.event.textColor);
                console.log(info.event.backgroundColor);

                console.log(info.event.extendedProps.descripcion);
              

                $('#txtID').val(info.event.id);
                $('#txtTitulo').val(info.event.title);

                mes = (info.event.start.getMonth()+1);
                dia = (info.event.start.getDate());
                anio = (info.event.start.getFullYear());

                mes=(mes<10)?"0"+mes:mes;
                dia=(dia<10)?"0"+dia:dia;


                hora = (info.event.start.getHours()+":"+info.event.start.getMinutes());

                
                console.log($('#txtFecha').val());
                console.log("estamos en el eventclick ");
                
                $('#txtHoraFin').val(info.event.extendedProps.horaFin);
                $('#start1').val($('#txtFecha').val()+" "+$('#txtHora').val());
                $('#end1').val($('#txtFecha').val()+" "+$('#txtHoraFin').val()); 
               $('#txtFecha').val(anio+"-"+mes+"-"+dia);
                $('#txtHora').val(info.event.extendedProps.horaInicio);  
                $('#txtDescripcion').val(info.event.extendedProps.descripcion);
                $('#idSede').val(info.event.extendedProps.idLugar);
                $('#colorin').val(info.event.backgroundColor);
                $('#ilimitadoFlag').val(info.event.extendedProps.ilimitado);
                $('#txtHoraFinInt').val(info.event.extendedProps.horaFinInt);
                $('#txtHoraInt').val(info.event.extendedProps.horaInicioInt);


                var ilimitado=$('#ilimitadoFlag').val();

                if (ilimitado == 1) {
                        
                     
                        $("#txtHora").prop("disabled", true);
                        $("#txtHoraFin").prop("disabled", true);
                        $("#txtHora").val("00:00");
                        $("#txtHoraFin").val("23:00");

                        
                    }

                    if(ilimitado==0) {
                        $("#txtHora").prop("disabled", false);
                        $("#txtHoraFin").prop("disabled", false);
                    }

                $('#selectSede').val(info.event.extendedProps.idLugar);
                
                // $('#txtHora').val(info.event.extendedProps.horaInicio);
                
                
                console.log($('#txtHoraFin').val());
                // $('#txtFecha').val(info.event.extendedProps.diaInicio);
                var YOYO = $('#txtFecha').val();
                $('#btnAgregar').hide();
                $('#btnBorrar').show();
                $('#btnModificar').show();
                $('#exampleModal').modal();
              

            },
            eventDrop: function(info) {

                console.log($(this));
                $('#txtID').val(info.event.id);
                $('#txtTitulo').val(info.event.title);

                mes = (info.event.start.getMonth()+1);
                dia = (info.event.start.getDate());
                anio = (info.event.start.getFullYear());

                mes=(mes<10)?"0"+mes:mes;
                dia=(dia<10)?"0"+dia:dia;


                hora = (info.event.start.getHours()+":"+info.event.start.getMinutes());
                
                $('#txtFecha').val(anio+"-"+mes+"-"+dia);
                console.log($('#txtFecha').val());
                $('#txtHora').val(hora);
               
               
                $('#txtDescripcion').val(info.event.extendedProps.descripcion);
                $('#idSede').val(info.event.extendedProps.idLugar);
                $('#ilimitadoFlag').val(info.event.extendedProps.ilimitado);
                // $('#txtFecha').val(info.event.extendedProps.diaInicio);
                // $('#txtHora').val(info.event.extendedProps.horaInicio);
                $('#txtHoraFin').val(info.event.extendedProps.horaFin);
                $('#txtHoraFinInt').val(info.event.extendedProps.horaFinInt);
                $('#txtHoraInt').val(info.event.extendedProps.horaInicioInt);
                


                $('#colorin').val(info.event.backgroundColor);


                var arreglarFormato=$('#txtHora').val();
                console.log(arreglarFormato);
                console.log("n.n");
           arreglarFormato= arreglarFormato.split(":");


           arreglarFormato= parseInt(arreglarFormato[0],10);
           $('#txtHoraInt').val(arreglarFormato);
           if (arreglarFormato < 10 ) {
            arreglarFormato= arreglarFormato + "";
            arreglarFormato= "0" + arreglarFormato;
           }
           arreglarFormato= arreglarFormato + "";
           arreglarFormato= arreglarFormato + ":00:00";
        //    $('#txtHora').val(arreglarFormato);
           arreglarFormato="";

           arreglarFormato=$('#txtHoraFin').val();
           arreglarFormato= arreglarFormato.split(":");
           arreglarFormato= parseInt(arreglarFormato[0],10);
           $('#txtHoraFinInt').val(arreglarFormato);

           if (arreglarFormato < 10 ) {
            arreglarFormato= arreglarFormato + "";
            arreglarFormato= "0" + arreglarFormato;
           }
           arreglarFormato= arreglarFormato + "";
           arreglarFormato= arreglarFormato + ":00:00";
        //    $('#txtHoraFin').val(arreglarFormato);
           arreglarFormato="";

           if ( $('#ilimitadoFlag').val() == 1) {
                // SumHrs2= 23;
                // SumHrs2= SumHrs2+"";
                // SumHrs[1]="59";
                $('#txtHoraFin').val("23:00");
                $('#txtHoraFinInt').val(24);

            }

            $('#start1').val($('#txtFecha').val()+" "+$('#txtHora').val());
                $('#end1').val($('#txtFecha').val()+" "+$('#txtHoraFin').val()); 

                ObjEvento=recolectarDatosGUI("PATCH");
               

                EnviarInformacion('/'+$('#txtID').val(),ObjEvento,true)
                LimpiarModal();
           
            },

            // Estos son los eventos pre definidos
            // events:[
            //     {
            //         id: 12,
            //         title:"Evento 1",
            //         start:"2020-04-25 12:30:00",
            //         end:"2020-03-30 12:45:00",
            //         color:"#FFCCAA",
            //         textColor:"#000000",
            //         descripcion:"se come chido"

            //     },
            //     {
            //         id: 123,
            //         title:"Evento 2",
            //         start:"2020-03-26 12:30:00",
            //         descripcion:"se come CACA"
            //     }
            // ]

            events:"{{url('/eventos/show')}}"


        });
        calendar.setOption('locale',"Es")

        calendar.render();

        $('#btnAgregar').click(function(){
            $("#selectSede").change(function(){ 
                var ilimitado=0;
                $(".optionSede").each(function(){
                    if($(this).is(":selected")){
                        // console.log($(this).val());
                        sedeid = $(this).val();
                        ilimitado = $(this).data("ilimitado");
                        colorsede = $(this).data("color");
                        console.log(colorsede);
                    }
                });

                $("#idSede").val(sedeid);
                // console.log(sedeid);
                $("#ilimitadoFlag").val(ilimitado);
                
                // console.log(ilimitado);
                
                $("#colorin").val(colorsede);
                
            });
                            
        //     var SumHrs;
        //     var SumHrs2;
        //    SumHrs=$('#txtHora').val();
        //     console.log(SumHrs);
        //     SumHrs = SumHrs.split(":");
        //     console.log(SumHrs);
        //     console.log(SumHrs[0]);
        //     SumHrs2 = parseInt(SumHrs[0], 10);
        //     SumHrs2 = SumHrs2 +4;
            
            // if (SumHrs2<10) 
            // {
            //     SumHrs2= SumHrs2 + "";
            //     SumHrs2="0"+SumHrs2;
            //         if ($('#ilimitadoFlag').val() == 1) 
            //             {
            //                 SumHrs2= 23;
            //                 SumHrs2= SumHrs2+"";
            //                 SumHrs[1]="59";
                            
            //             }
            // }
           
            // if (SumHrs2>=24) {
            //     SumHrs2= 23;
            //     SumHrs2= SumHrs2+"";
            //     SumHrs[1]=59;
                
            // }
          
            // console.log(SumHrs2);
            // SumHrs[0]=SumHrs2;
            // SumHrs=SumHrs[0]+":"+SumHrs[1];
            // console.log(SumHrs);
            // $('#SumHrs').val(SumHrs);
            // console.log($("#colorin").val());
            $('#start1').val($('#txtFecha').val()+" "+$('#txtHora').val());
            $('#end1').val($('#txtFecha').val()+" "+$('#txtHoraFin').val());   

            $("#Bandera").val(0);
           
           var valid1="";
           var valid2="";

           valid1=$('#txtHora').val();
           valid2=$('#txtHoraFin').val();

           valid1 = valid1.split(":");
           valid2 = valid2.split(":");

           valid1 = parseInt(valid1[0], 10);
           valid2 = parseInt(valid2[0], 10);

        //    if (valid1 >= valid2) {
        //     $("#Bandera").val(1);
                
        //    }
        
        var arreglarFormato=$('#txtHora').val();
           arreglarFormato= arreglarFormato.split(":");
           arreglarFormato= parseInt(arreglarFormato[0],10);
           $('#txtHoraInt').val(arreglarFormato);
           if (arreglarFormato < 10 ) {
            arreglarFormato= arreglarFormato + "";
            arreglarFormato= "0" + arreglarFormato;
           }
           arreglarFormato= arreglarFormato + "";
           arreglarFormato= arreglarFormato + ":00:00";
        //    $('#txtHora').val(arreglarFormato);
           arreglarFormato="";

           arreglarFormato=$('#txtHoraFin').val();
           arreglarFormato= arreglarFormato.split(":");
           arreglarFormato= parseInt(arreglarFormato[0],10);
           $('#txtHoraFinInt').val(arreglarFormato);

           if (arreglarFormato < 10 ) {
            arreglarFormato= arreglarFormato + "";
            arreglarFormato= "0" + arreglarFormato;
           }
           arreglarFormato= arreglarFormato + "";
           arreglarFormato= arreglarFormato + ":00:00";
        //    $('#txtHoraFin').val(arreglarFormato);
           arreglarFormato="";
           if ( $('#ilimitadoFlag').val() == 1) {
                // SumHrs2= 23;
                // SumHrs2= SumHrs2+"";
                // SumHrs[1]="59";
                $('#txtHoraFin').val("23:00");
                $('#txtHoraFinInt').val(24);

            }
            
                ObjEvento=recolectarDatosGUI("POST");
                EnviarInformacion('',ObjEvento);
                $('#exampleModal').modal('toggle');

            // if ($("#Bandera").val() == 0) {
                
            //     console.log($("#Bandera").val());
            
            //     }
            //         if ($("#Bandera").val() == 0) {
            //         $("#Exito").fadeTo(5000, 500).slideUp(500, function(){
            //         $("#Exito").alert('hidde');})
            //     }
            // if ($("#Bandera").val() == 1) {
            //     $("#ProblemaHorasModal").fadeTo(5000, 500).slideUp(500, function(){$("#ProblemaHorasModal").alert('hidde');})

                


            // }


            
            LimpiarModal();

        });


        $('#btnBorrar').click(function(){
            ObjEvento=recolectarDatosGUI("DELETE");

            EnviarInformacion('/'+$('#txtID').val(),ObjEvento);
            LimpiarModal();
            // $("#ExitoBorrar").fadeTo(3000, 500).slideUp(500, function(){
            // $("#ExitoBorrar").alert('hidde');})

        });

        $('#btnModificar').click(function(){






            $('#start1').val($('#txtFecha').val()+" "+$('#txtHora').val());
            $('#end1').val($('#txtFecha').val()+" "+$('#txtHoraFin').val());
            $("#Bandera").val(0);

                var valid1="";
                var valid2="";

                valid1=$('#txtHora').val();
                valid2=$('#txtHoraFin').val();

                valid1 = valid1.split(":");
                valid2 = valid2.split(":");

                valid1 = parseInt(valid1[0], 10);
                valid2 = parseInt(valid2[0], 10);

                if (valid1 >= valid2) {
                    $("#Bandera").val(1);                    
                }


                if (valid1 < valid2) {
                    $("#Bandera").val(0);
                }


                var arreglarFormato=$('#txtHora').val();
           arreglarFormato= arreglarFormato.split(":");
           arreglarFormato= parseInt(arreglarFormato[0],10);
           $('#txtHoraInt').val(arreglarFormato);
           if (arreglarFormato < 10 ) {
            arreglarFormato= arreglarFormato + "";
            arreglarFormato= "0" + arreglarFormato;
           }
           arreglarFormato= arreglarFormato + "";
           arreglarFormato= arreglarFormato + ":00:00";
        //    $('#txtHora').val(arreglarFormato);
           arreglarFormato="";

           arreglarFormato=$('#txtHoraFin').val();
           arreglarFormato= arreglarFormato.split(":");
           arreglarFormato= parseInt(arreglarFormato[0],10);
           $('#txtHoraFinInt').val(arreglarFormato);
           if (arreglarFormato < 10 ) {
            arreglarFormato= arreglarFormato + "";
            arreglarFormato= "0" + arreglarFormato;
           }
           arreglarFormato= arreglarFormato + "";
           arreglarFormato= arreglarFormato + ":00:00";
        //    $('#txtHoraFin').val(arreglarFormato);
           arreglarFormato="";

           

        if ($("#selectSede").change()) {
             $("#selectSede").change(function(){ 
                var ilimitado=0;
                $(".optionSede").each(function(){
                    if($(this).is(":selected")){
                        // console.log($(this).val());
                        sedeid = $(this).val();
                        ilimitado = $(this).data("ilimitado");
                        colorsede = $(this).data("color");
                        console.log(colorsede);
                    }
                });
                $("#idSede").val(sedeid);
                $("#ilimitadoFlag").val(ilimitado);
                $("#colorin").val(colorsede);
                // console.log(sedeid);
                // console.log(ilimitado);
                                    if ( $('#ilimitadoFlag').val() == 1) {                                
                                        $('#txtHoraFin').val("23:00");
                                        $('#txtHoraFinInt').val(23);
                                    }
            });  
        }  
                // if ($("#Bandera").val() == 1) {
                // $("#ProblemaHorasModal").fadeTo(5000, 500).slideUp(500, function(){$("#ProblemaHorasModal").alert('hidde');})
                // $('#exampleModal').modal('toggle');


                // }


                // if ($("#Bandera").val() == 0) {
                //     $("#ExitoModificar").fadeTo(5000, 500).slideUp(500, function(){$("#ExitoModificar").alert('hidde');})
                // }

             ObjEvento=recolectarDatosGUI("PATCH");
            EnviarInformacion('/'+$('#txtID').val(),ObjEvento);
            LimpiarModal();

        });

        $('.clockpicker').clockpicker({
 	    afterHourSelect: function(){
            $('.clockpicker').data('clockpicker').done();
    }
 });

 $('.clockpicker2').clockpicker({
 	    afterHourSelect: function(){
            $('.clockpicker2').data('clockpicker').done();
    }
 });

        // function SelectColor(){

        //     switch ($(".selectpicker").children("option:selected").val()) {

        //     case "1":
        //          $("#txtColor").val("#80ffff");
        //         break;
        //     case "2":
        //         $("#txtColor").val("#A82E13");
              
        //         break;
        //     case "3":
        //         $("#txtColor").val("#E073CE") ;
              
        //     break;
        //     }

        // }




        function recolectarDatosGUI(method){



            
        //     var SumHrs;
        //     var SumHrs2;
        //    SumHrs=$('#txtHora').val();
        //     console.log(SumHrs);
        //     SumHrs = SumHrs.split(":");
        //     console.log(SumHrs);
        //     console.log(SumHrs[0]);
        //     SumHrs2 = parseInt(SumHrs[0], 10);
        //     SumHrs2 = SumHrs2 +4;
            
        //     if (SumHrs2<10) 
        //     {
        //         SumHrs2= SumHrs2 + "";
        //         SumHrs2="0"+SumHrs2;
        //             if ($('#ilimitadoFlag').val() == 1) 
        //                 {
        //                     SumHrs2= 23;
        //                     SumHrs2= SumHrs2+"";
        //                     SumHrs[1]="59";
                            
        //                 }
        //     }
        //     if ( $('#ilimitadoFlag').val() == 1) {
        //         SumHrs2= 23;
        //         SumHrs2= SumHrs2+"";
        //         SumHrs[1]="59";
        //     }
        //     if (SumHrs2>=24) {
        //         SumHrs2= 23;
        //         SumHrs2= SumHrs2+"";
        //         SumHrs[1]=59;
                
        //     }
          
        //     console.log(SumHrs2);
        //     SumHrs[0]=SumHrs2;
        //     SumHrs=SumHrs[0]+":"+SumHrs[1];
        //     console.log(SumHrs);
        //     $('#SumHrs').val(SumHrs);
        //     console.log($("#colorin").val());
        //     $('#start1').val($('#txtFecha').val()+" "+$('#txtHora').val());
        //     $('#end1').val($('#txtFecha').val()+" "+$('#SumHrs').val());   
        

            nuevoEvento={
               	title:$('#txtTitulo').val(),
                descripcion:$('#txtDescripcion').val(),
                color:$('#colorin').val(),
               
                idLugar:$('#idSede').val(),
                ilimitado:$('#ilimitadoFlag').val(),
                // color:colores,
                // var selectedCountry = $(this).children("option:selected").val();
                textColor:'#FFFFFF',
                diaInicio:$('#txtFecha').val(),
                start:$('#start1').val(),
                end:$('#end1').val(),
                horaInicio:$('#txtHora').val(),
                horaFin:$('#txtHoraFin').val(),
                horaInicioInt:$('#txtHoraInt').val(),
                horaFinInt:$('#txtHoraFinInt').val(),


               

                '_token':$("meta[name='csrf-token']").attr("content"),
                '_method':method
            }
            
            return(nuevoEvento);
                
        }
        function EnviarInformacion(accion,objEvento,modal){
            console.log(objEvento);
            $.ajax(
                {
                 
                    type:"POST",
                    url:"{{ url('/eventos')}}"+accion,
                    data:objEvento,
                    success:function(msg){
                        if(!modal){
                        $('#exampleModal').modal('toggle');
                        }
                        calendar.refetchEvents();

                            console.log(msg.bandera)

                        if (msg.bandera==4) {
                            //Eventos tienen un maximo de 4 horas
                            $("#MASDE4").fadeTo(3000, 500).slideUp(500, function(){
                            $("#MASDE4").alert('hidde');});

                        }

                        if (msg.bandera==1) {
                            //Horario ocupado o inposible
                            $("#ProblemaHorasModal").fadeTo(5000, 500).slideUp(500, function(){
                                $("#ProblemaHorasModal").alert('hidde');});
                        }

                        if (msg.bandera==6) {
                            //Solo un evento ilimitado por dia
                            $("#ProblemaIlimitado").fadeTo(5000, 500).slideUp(500, function(){
                                $("#ProblemaIlimitado").alert('hidde');});
                        }

                        if (msg.bandera==0) {
                            //Guardado de forma correcta
                            $("#Exito").fadeTo(5000, 500).slideUp(500, function(){
                            $("#Exito").alert('hidde');});
                        }

                        if (msg.bandera==2) {
                            //Guardado de forma correcta
                            $("#ExitoModificar").fadeTo(5000, 500).slideUp(500, function(){
                            $("#ExitoModificar").alert('hidde');
                            });
                        }

                        if (msg.bandera==3) {
                            //Guardado de forma correcta
                            $("#ExitoBorrar").fadeTo(5000, 500).slideUp(500, function(){
                            $("#ExitoBorrar").alert('hidde');
                            });
                        }




                    },


                    error:function(){alert("Problemas");}
                }
            );
            
        }

  

        function LimpiarModal(){
            //  $("#txtID").val("");
            $("#txtTitulo").val("");
            $("#txtDescripcion").val("");
            $("#txtHora").val("");
            $("#txtHoraFin").val("");
            $("selectpicker").val("");


        }
        

        });

       

    </script>


    @endsection

                <!-- AQUI FUNCIONA CHIDO -->


    @section('content')
        <div class="row">
       
            <div class="col-md-2"></div>
            <div class="col-md-8"> 
            <div class="row"> 
                <div class="col-md-8"> 
                    <div class="alert alert-success hidden collapse"  id="Exito">
                    <button class="close" data-dismiss="alert">
                    <span>&times;</span>
                    </button> Todo Correcto
                    </div>

                    <div class="alert alert-danger collapse" id="ProblemaHorasModal" > <button class="close" data-dismiss="alert">
                    <span>&times;</span>
                    </button> Las Horas Seleccionadas No Son Compatibles </div>

                    <div class="alert alert-danger collapse" id="ProblemaIlimitado" > <button class="close" data-dismiss="alert">
                    <span>&times;</span>
                    </button> Solo Se Permite Un Evento Al Dia En Este Lugar </div>

                    

                    <div class="alert alert-danger collapse" id="MASDE4" > <button class="close" data-dismiss="alert">
                    <span>&times;</span>
                    </button> Los Eventos No Pueden Durar Mas De 4 Horas </div>

                    <div class="alert alert-info hidden collapse"  id="ExitoBorrar">
                    <button class="close" data-dismiss="alert">
                    <span>&times;</span>
                    </button> Evento Eliminado
                    </div>

                    <div class="alert alert-success hidden collapse"  id="ExitoModificar">
                    <button class="close" data-dismiss="alert">
                    <span>&times;</span>
                    </button> Modificado Correctamente
                    </div>

                    
                    <!-- <div class="alert alert-warning">ses</div>
                    <div class="alert alert-danger">ses</div>
                    <div class="alert alert-success">ses</div> -->

                </div>
            </div>
             <div id="calendar"></div>
             </div>
            <div class="col-md-2"></div>
        </div>
    
            <!-- MODAL -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Datos del Evento</h5>
                
                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button> -->
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="col-form-label col-md">Titulo:</label>
                    <input type="text" name="txtTitulo" id="txtTitulo" class="col-md form-control form-control-sm">
                    <div class="form-group">
                        <label class="col-form-label col-md">Lugar:</label>
                   
                        <select name="selectSede" id="selectSede" class="col-md form-control form-control-sm">
                        <option hidden selected value=""> selecciona un lugar</option>
                        @foreach( $sedes as $sede ) 
                            <option  class="optionSede" data-color="{{$sede->color}}" data-ilimitado="{{$sede->ilimitado}}" value="{{ $sede->id }}" > {{ $sede->name }} </option>
                        @endforeach
                        </select>
                    </div>
                
                <div class="form-group">
                    <div class="row">  
                
                        <div class="clockpicker form-group col-md-6" data-autoclose="true">
                          <label class="col-form-label ">Hora Inicio:</label>
                            <input type="text" name="txtHora" id="txtHora" class="form-control form-control-sm col-md-5">
                        </div>

                        <div class="clockpicker2 form-group col-md-6" data-autoclose="true"> 
                             <label class="col-form-label ">Hora Fin:</label>
                            <input type="text" name="txtHoraFin" id="txtHoraFin" class="form-control form-control-sm col-md-5">
                        </div>
                    </div>
                </div>
               
                <div class="form-group">
                    <label class="col-form-label col-md">Descripcion:</label>
                <textarea name="txtDescripcion" id="txtDescripcion" class="col-md form-control form-control-sm"></textarea>
                </div>


                <input type="hidden"name="txtColor" id="txtColor">
                <input type="hidden" id="txtID">
                <input type="hidden" name="txtFecha" id="txtFecha">
                <input type="hidden" name="idSede" id="idSede">
                <input type="hidden" name="ilimitadoFlag" id="ilimitadoFlag">
                <input type="hidden" name="colorin" id="colorin">
                <input type="hidden" name="start1" id="start1">
                <input type="hidden" name="end1" id="end1">
                <input type="hidden" name="txtHoraInt" id="txtHoraInt">
                <input type="hidden" name="txtHoraFinInt" id="txtHoraFinInt">
                <input type="hidden" name="SumHrs" id="SumHrs">
                <input type="hidden" name="Bandera" id="Bandera">
                
                <!-- Color:
                <input type="color" name="txtColor" id="txtColor">
                <br/> -->
            </div>
            </div>

            <div class="modal-footer">
                <button id="btnAgregar" class="btn btn-primary" >Agregar</button>
                <button id="btnModificar" class="btn btn-success">Modificar</button>
                <button id="btnBorrar" class="btn btn-danger">Borrar</button>
                <button id="btnCancelar" class="btn btn-warning"  data-dismiss="modal" aria-label="Close"> Cancelar</button>
            </div>

        </div>
        </div>
        </div>

    @endsection