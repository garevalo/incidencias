app.controller('ClientesController', function ($scope, $compile, $http, API_URL, ClientesFactory) {

    var rowCompiler = function (nRow, aData, iDataIndex) {
        var element, linker;
        linker = $compile(nRow);
        element = linker($scope);
        return nRow = element;
    };

    var options = {
        autoWidth: false,
        processing: true,
        serverSide: true,
        ajax: ClientesFactory.ajax,
        fnCreatedRow: rowCompiler,
        columns: ClientesFactory.columns,
        language: {
            "url": ClientesFactory.idioma
        }
    };

    $scope.guardarCliente = function () {

        var url = API_URL + "cliente";
        $scope.errorNombre      = '';
        $scope.errorRucDni    = '';
        $scope.errorCorreo      = '';
        $scope.errorTelefono     = '';
        $scope.errorDireccion    = '';
        console.log($scope.cliente.nombre);
        $http({
            method: 'POST',
            url: url,
            data: $.param($scope.cliente),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).success(function (response) {
            console.log(response);
            //alert(response.nombre);
            if (response === true) {
                $.gritter.add({
                        title: 'Notificación',
                        text: '¡El Cliente se guardó correctamente!',
                        //sticky: true,
                        class_name: 'gritter-info'
                });
                $('#modalEdit').modal('hide');
                var table = $('#clientes-table').DataTable();
                table.ajax.reload();
            } else {
                $scope.errorNombre = response.nombre;
                $scope.errorRucDni = response.rucdni;
                $scope.errorCorreo = response.correo;
                $scope.errorTelefono = response.telefono;
                $scope.errorDireccion = response.direccion;
            }
        }).error(function (response) {
            alert('Ha Ocurrido un error');
        });
    }

    $scope.editarCliente = function(){

        var url = API_URL + "cliente/" + $scope.cliente.idcliente;
        $scope.errorNombre      = '';
        $scope.errorRucDni    = '';
        $scope.errorCorreo      = '';
        $scope.errorTelefono     = '';
        $scope.errorDireccion    = '';
        //console.log($.param($scope.usuario));
        var datos = $( "#frmcliente" ).serialize();
        //console.log(str);
        $http({
            method: 'POST',
            url: url,
            data: datos,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).success(function (response) {
            console.log(response);

            if (response === true) {
                //alert("Se actualizó usuario correctamente");
                //$('#gritter-center').on(ace.click_event, function(){
                    $.gritter.add({
                        title: 'Notificación',
                        text: '!El cliente se actualizó correctamente',
                        //sticky: true,
                        class_name: 'gritter-info'
                    });
            
                    //return false;
                //});
                $('#modalEdit').modal('hide');
                var table = $('#clientes-table').DataTable();
                table.ajax.reload();
            } else {
                $scope.errorNombre = response.nombre;
                $scope.errorRucDni = response.dni_ruc;
                $scope.errorCorreo = response.correo;
                $scope.errorTelefono = response.telefono;
                $scope.errorDireccion = response.direccion;
            }
        }).error(function (response) {
            alert('Ha Ocurrido un error');
            console.log(response);
        });

    }


    $scope.modalCliente = function (modal, idcliente) {
        $scope.cliente = "";
        var time = new Date().getTime();

        if (modal == "new") {
            $scope.urlmodal = API_URL + "cliente/modal/new?" + time;
        } else {
            $http.get(API_URL + 'cliente/getdata/' + idcliente).success(function (data, status) {
                $scope.cliente = data;
            });
            $scope.urlmodal = API_URL + "cliente/modal/edit/" + idcliente + "?" + time;
        }

        $('#modalEdit').modal('show');
    }

    $scope.loadTable = function () {
        $('#clientes-table').dataTable(options);
    }

    $scope.delete = function(v,idcliente){

        /*if(confirm("¿Está seguro de eliminar este cliente" + id + " ?" )){
            alert("cliente eliminado");
        }*/
        $( "#dialog-confirm" ).removeClass('hide').dialog({
            resizable: false,
            width: '320',
            modal: true,
            title: "Dar de baja usuario",
            title_html: true,
            buttons: [
                {
                    html: "<i class='ace-icon fa fa-trash-o bigger-110'></i>&nbsp; Aceptar",
                    "class" : "btn btn-danger btn-minier",
                    click: function() {

                        $http.get(API_URL + 'cliente/bajacliente/' + idcliente).success(function (data, status) {
                            
                            //table.ajax.reload();
                            if(data===true){
                                $.gritter.add({
                                    title: 'Notificación',
                                    text: '!El cliente fue dado de baja',
                                    //sticky: true,
                                    class_name: 'gritter-error'
                                });
                                var table = $('#clientes-table').DataTable();
                                table.ajax.reload();
                            }     

                        });
                        
                        $( this ).dialog( "close" );
                    }
                }
                ,
                {
                    html: "<i class='ace-icon fa fa-times bigger-110'></i>&nbsp; Cancelar",
                    "class" : "btn btn-minier",
                    click: function() {
                        $( this ).dialog( "close" );
                    }
                }
            ]
        });
    }

});