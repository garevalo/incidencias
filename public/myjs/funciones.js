

 $(function(){

    var f=new Date();
    var hoy= (f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear());

    $(".date").datepicker({
        dateFormat: "dd/mm/yy",
        changeMonth: true,
        changeYear: true ,
        monthNames: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Setiebre", "Octubre", "Noviembre", "Diciembre" ],
        monthNamesShort: [ "Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic" ],
        dayNamesMin: [ "Do", "Lu", "Ma", "Mie", "Jue", "Vie", "Sa" ],
        maxDate: hoy
    });

    $( "#desde" ).datepicker({
        defaultDate: "+1w",
        dateFormat: "dd/mm/yy",
        changeMonth: true,
        changeYear: true ,
        monthNames: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Setiebre", "Octubre", "Noviembre", "Diciembre" ],
        monthNamesShort: [ "Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic" ],
        dayNamesMin: [ "Do", "Lu", "Ma", "Mie", "Jue", "Vie", "Sa" ],
        maxDate: hoy,
      onClose: function( selectedDate ) {
        $( "#hasta" ).datepicker( "option", "minDate", selectedDate );
      }
    });
    $( "#hasta" ).datepicker({
      defaultDate: "+1w",
      dateFormat: "dd/mm/yy",
        changeMonth: true,
        changeYear: true ,
        monthNames: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Setiebre", "Octubre", "Noviembre", "Diciembre" ],
        monthNamesShort: [ "Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic" ],
        dayNamesMin: [ "Do", "Lu", "Ma", "Mie", "Jue", "Vie", "Sa" ],
        maxDate: hoy,
      onClose: function( selectedDate ) {
        $( "#desde" ).datepicker( "option", "maxDate", selectedDate );
      }
    });



                        
                        

 }); 

function contador_input(form) {

    var cont = 0;
    $(form).find(':input').each(function() {
        var type = this.type;
        var tag = this.tagName.toLowerCase();
        if (type === 'text' || type === 'password' || tag === 'textarea' || type === 'date' || tag === 'select' || type === 'number')
        {
            if (this.value === '') {
                cont++;
            }
        }

    });
    return cont;
}


function registrar_ajax_cotizacion(form, c ) {
   
   $('#' + form).submit(function(event) {
       event.preventDefault();
        var formData = new FormData(this);
       var filas=$("#table-body tr").length;
       if(filas === 0){
        
            $("#warning-title").text('Alerta');
            $("#warning-body").text('Seleccione un producto, para continuar con la cotización');
            $('#modal-warning').modal('show');
            
                   
        }else{
         
          $.ajax({
                url: $(this).attr("action"),
                data: formData,
                cache: false,
                mimeType: 'multipart/form-data',
                contentType: false,
                processData: false,
                type: 'POST',
                success: function(data) {
                    var datos = jQuery.parseJSON(data);
                    if (datos.error) {

                        bootbox.alert(datos.error);
                        //location.reload();
                    }

                    else if (datos.dir) {
                        $(".bootbox").modal("hide");
     
                        window.open(datos.mensaje,'Imprimir Cotización','width=900,height=800');
                        window.location = datos.dir;
                        //location.reload();
                    }
                    else if(datos.verificar){
                        
                         bootbox.dialog({
                                title: "Verifique si la información registrada es correcta",
                                message: datos.verificar
                            }
                        );       
                    }
                    else if (datos.datos) {
                        console.log(data);
                    }
                }
            });
           
          event.unbind();
        }
       
   }); 
    
  }
  


function registrar_ajax(form, c) {


    if (contador_input('#' + form) <= c) {

        $('#' + form).submit(function(event) {
            var formData = new FormData(this);
            $.ajax({
                url: $(this).attr("action"),
                data: formData,
                cache: false,
                mimeType: 'multipart/form-data',
                contentType: false,
                processData: false,
                type: 'POST',
                success: function(data) {
                    var datos = jQuery.parseJSON(data);
                    if (datos.error) {

                        bootbox.alert(datos.error);
                        //location.reload();
                    }

                    else if (datos.dir) {
                        $(".modal-body").text(datos.mensaje);
                        $('#modal-success').modal('show');

                        $("#ok").click(function() {
                            // $("#form")[0].reset();
                            window.location = datos.dir;
                        });
                    }
                    else if (datos.datos) {
                        console.log(data);
                    }
                }
            });

            event.preventDefault();
            event.unbind();
        });
    }
}

function registrar_modal(form, c) {


    if (contador_input('#' + form) <= c) {


        $('#' + form).submit(function(event) {
            var formData = new FormData(this);
            $.ajax({
                url: $(this).attr("action"),
                data: formData,
                cache: false,
                mimeType: 'multipart/form-data',
                contentType: false,
                cache: false,
                        processData: false,
                type: 'POST',
                success: function(data) {
                    var datos = jQuery.parseJSON(data);
                    if (datos.error) {

                        $("#modal-error").fadeIn(100).html(datos.error);
                        //location.reload();
                    }

                    else if (datos.dir) {


                    }
                    else if (datos.datos) {
                        console.log(data);
                    }
                    $('.bootbox ').modal('hide');
                    $("#btn-acreditacion").prop("disabled","disabled");
                    $("#alerta-acreditacion").html('<div class="alert alert-info">En proceso de Acreditación <span class="fa fa-check"></span></div>'); 
                    $(".modal-body").text(datos.mensaje);
                    $('#modal-success').modal('show');
                }
            });

            event.preventDefault();

        });
    }
}


function buscar_ajax(form, content) {


    if (contador_input('#' + form) === 0) {


        $('#' + form).submit(function(event) {

            //// $("#"+content).html("Cargando..."); 
            //$( "#dialog" ).dialog();
            $('#small-modal').modal('show');
            $.post($(this).attr("action"), $(this).serialize(), function(data, status) {

                if (status === "success") {
                    $('#small-modal').modal('hide');
                    //$( "#dialog" ).dialog( "close" );  
                    $("#" + content).html(data);

                }
            });

            event.preventDefault();
            event.unbind();
        });

    }

    //alert(contador_input('#'+form));
}


function buscar_ajax_3(form, content) {


    if (contador_input('#' + form) === 0) {


        $('#' + form).submit(function(event) {

            $('#small-modal').modal('show');

            var formData = new FormData(this);
            $.ajax({
                url: $(this).attr("action"),
                data: formData,
                cache: false,
                mimeType: 'multipart/form-data',
                contentType: false,
                processData: false,
                type: 'POST',
                success: function(data) {
                    $('#small-modal').modal('hide');
                    $("#" + content).html(data);
                }
            });

            event.preventDefault();
            event.unbind();
        });

    }

    //alert(contador_input('#'+form));
}


function buscar_ajax2(form, content) {


    $('#' + form).submit(function(event) {

        //// $("#"+content).html("Cargando..."); 
        //$( "#dialog" ).dialog();
        $('#small-modal').modal('show');
        $.post($(this).attr("action"), $(this).serialize(), function(data, status) {

            if (status === "success") {
                $('#small-modal').modal('hide');
                //$( "#dialog" ).dialog( "close" );  
                $("#" + content).html(data);

            }
        });

        event.preventDefault();
    });


}

function eliminar_ajax(dir, id) {


    $('#mod-warning').modal('show');

    $("#eliminar").click(function(event) {
        $.post(dir, {"id": id}, function(data, status) {

            if (status === "success") {
                $(".fila" + id).fadeOut(500);
            }
            else {
                alert("error");
            }
        });

        event.preventDefault();
    });


}


function limpiar() {
    $("#form")[0].reset();

}



function seg(id,idasig,url) {


    $("#" + id).toggle("2000");
    $.post(url,{id:idasig},function(data){
        $("#" + id).html(data);
    });
}




 function form_modal(titulo,form){
 
    $.get(form,function(data){


        bootbox.dialog({
                   title: titulo,
                   message: data
               }
           );

    });
 
 }
 
  function form_modal_acreditacion(titulo,form){
   
    var idcliente =$("#idcliente").val();
    var idcotizacion =$("#codigo").val();
    var ruc=$("#ruc").val();
    var nombre=$("#nombre").val();
    var precio=$("#precioneto").val();

    console.log(idcliente);
    $.get(form,{ruc:ruc,"nombre":nombre,"precio":precio,"idcliente":idcliente,"idcotizacion":idcotizacion},function(data){

        bootbox.dialog({
                   title: titulo,
                   message: data
               }
           );

    });
 
 }
 
function form_modal_rutas(titulo,form){
   

    $.get(form,function(data){

        bootbox.dialog({
                   title: titulo,
                   message: data
               }
           );

    });
 
 }
 
function agregar_producto(url,id){
    var filas = ($("#table-body tr").length)+1;
    var idprod = ($("."+id).length);
   
   if(idprod>0){ 
       
       //alert("Este producto ya ha sido añadido a la cotización. Seleccione otro producto porfavor");
       $("#warning-title").text('Alerta');
       $("#warning-body").text('Este producto ya ha sido añadido a la cotización. Seleccione otro producto porfavor');
       $('#modal-warning').modal('show');
   }else{
    $.post(url,{id:id,filas:filas},function(data,status){
       
       if(status==="success"){
           
           $("#table-body").append(data);
           $(".bootbox").modal("hide");
          // $('#modal-success').modal('show');
           
            
       }
     }); 
  }
 

 }
 

 
function solicitar_productos(idcotizacion,idproducto,url){
     
    
     $.post(url,{idproducto:idproducto,idcotizacion:idcotizacion},function(data,status){

        if(status==="success"){
            //alert(data); 
            $("#modal-body-success").text("Producto solicitado");
            $('#modal-success').modal('show'); 
            $("#solicita-producto"+idproducto).prop("disabled","disabled");   
        }
        else{
            alert("error");
        };
        console.log(data);
     });


     
}

    function despacho(ruta,idoc){

        $.get(ruta,{idoc:idoc},function(data,status){
            
            if(status==="success"){
                var datos = jQuery.parseJSON(data);
                if (datos.ok) {
                    $(".modal-body").html(datos.ok);
                    $('#modal-success').modal('show');
                    $('#btn-despacho').prop("disabled","disabled");
                    $("#ok").click(function() {
                            // $("#form")[0].reset();
                            window.location = datos.dir;
                        });
                }
                else if(datos.error){
                    $(".modal-body").html(datos.error);
                    $('#modal-danger').modal('show');

                    if(datos.activarbtn){
                        $("#ok-error").click(function(){
                            $("#btn-guardar").prop("disabled","");
                            $('#btn-despacho').prop("disabled","disabled");
                        });
                        
                    }
                    
                }
            }
            
        });

    //alert(ruta);
    }