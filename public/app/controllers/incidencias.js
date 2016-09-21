app.controller('IncidenciasController', function ($scope, $compile, $http, API_URL, IncidenciasFactory) {

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
        ajax: IncidenciasFactory.ajax,
        fnCreatedRow: rowCompiler,
        columns: IncidenciasFactory.columns,
        language: {
            "url": IncidenciasFactory.idioma
        }
    };

    $scope.guardarIncidencia = function () {

        var url = API_URL + "incidencia";
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
                $scope.errorRucDni = response.dni_ruc;
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
                $scope.errorRucDni = response.rucdni;
                $scope.errorCorreo = response.correo;
                $scope.errorTelefono = response.telefono;
                $scope.errorDireccion = response.direccion;
            }
        }).error(function (response) {
            alert('Ha Ocurrido un error');
            console.log(response);
        });

    }


    $scope.modalIncidencia = function (modal, idincidencia) {
        $scope.incidencia = "";
        $scope.estados = "";
        var time = new Date().getTime();

        if (modal == "new") {
            $scope.urlmodal = API_URL + "incidencia/modal/new?" + time;
        } else {
            $http.get(API_URL + 'incidencia/getdata/' + idincidencia).success(function (data, status) {
                $scope.incidencia = data;
                $scope.selectincidencia = {idincidencia:2};
            });
            console.log($scope.incidencia);
            $http.get(API_URL + 'estado/getdata').success(function (data, status) {
                $scope.estados = data;
            });
            $scope.data = {
                availableOptions: [
                    {id: '1', name: 'Option A'},
                    {id: '2', name: 'Option B'},
                    {id: '3', name: 'Option C'}
                ],
                selectedOption: {id: '2'} //This sets the default value of the select in the ui
            };

            $scope.dataOption = [
                    {id: '1', name: 'Option A'},
                    {id: '2', name: 'Option B'},
                    {id: '3', name: 'Option C'}
                ];

            $scope.selected={id:3};
            $scope.urlmodal = API_URL + "incidencia/modal/edit/" + idincidencia + "?" + time;
        }

        $('#modalEdit').modal('show');
    }

    $scope.loadTable = function () {
        $('#data-table').dataTable(options);
    }

    /*
    * <div ng-controller="ExampleController">
     <form name="myForm">
     <label for="mySelect">Make a choice:</label>
     <select name="mySelect" id="mySelect"
     ng-options="option.name for option in data.availableOptions track by option.id"
     ng-model="data.selectedOption"></select>
     </form>
     <hr>
     <tt>option = {{data.selectedOption}}</tt><br/>
     </div>
     $scope.data = {
     availableOptions: [
     {id: '1', name: 'Option A'},
     {id: '2', name: 'Option B'},
     {id: '3', name: 'Option C'}
     ],
     selectedOption: {id: '3', name: 'Option C'} //This sets the default value of the select in the ui
     };
    * */

});