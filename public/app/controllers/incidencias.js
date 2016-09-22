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

        var url = API_URL + "incidencia/" + $scope.incidencia.idincidencia;
        $scope.errorNombre      = '';
        $scope.errorRucDni      = '';

        console.log($scope.selectincidencia);
        console.log($scope.incidencia.idincidencia);
        var frmdatos = $( "#frmincidencia" ).serialize();
        $http({
            method: 'POST',
            url: url,
            data: frmdatos,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).success(function (response) {
            console.log(response);
            //alert(response.nombre);
            if (response === true) {
                console.log(response);
                /*$.gritter.add({
                        title: 'Notificación',
                        text: '¡El Cliente se guardó correctamente!',
                        //sticky: true,
                        class_name: 'gritter-info'
                });*/
                alert('ok');
                $('#modalEdit').modal('hide');
                var table = $('#data-table').DataTable();
                table.ajax.reload();
            } else {
                alert(response);
            }
        }).error(function (response) {
            alert('Ha Ocurrido un error');
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
                $scope.selectincidencia = {idestado: data.estado };
                if(data.prioridad == 1){
                    $scope.nombreprioridad = 'Baja' ;
                }else if(data.prioridad==2){
                    $scope.nombreprioridad = 'Media' ;
                }else{
                    $scope.nombreprioridad = 'Alta' ;
                }

            });

            $http.get(API_URL + 'estado/getdata').success(function (data, status) {
                $scope.estados = data;
            });

            $scope.urlmodal = API_URL + "incidencia/modal/edit/" + idincidencia + "?" + time;
        }

        $('#modalEdit').modal('show');
    }

    $scope.loadTable = function () {
        $('#data-table').dataTable(options);
    }
    $scope.isdiagnostico=true;
    $scope.isdescripcion=true;
    $scope.estadoclick = function () {
        $scope.isdiagnostico=true;
        $scope.isdescripcion=true;
        var idestado = $scope.selectincidencia.idestado;
        console.log(idestado);
        if(idestado == 2){
            $scope.isdiagnostico=false;
        }
        if(idestado == 3){
            $scope.isdescripcion=false;
        }
    }


});