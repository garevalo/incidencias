app.controller('UsuariosController', function ($scope, $compile, $http, API_URL, UsuariosFactory) {

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
        ajax: UsuariosFactory.ajax,
        fnCreatedRow: rowCompiler,
        columns: UsuariosFactory.columns,
        language: {
            "url": UsuariosFactory.idioma
        }
    };

    $scope.save = function () {
        var url = API_URL + "usuario/perfil";
        $scope.errorNombre = '';
        $scope.errorNombreShow = '';
        $scope.errorApellido = '';
        $scope.errorCorreo = '';
        $scope.errorUsuario = '';

        $http({
            method: 'POST',
            url: url,
            data: $.param($scope.usuario),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).success(function (response) {
            console.log(response);
            //alert(response.nombre);
            if (response === true) {
                alert("Se actualizo correctamente");
                $scope.nombreTitulo = $scope.usuario.nombre + ' ' + $scope.usuario.apellido;
            } else {
                $scope.errorNombre = response.nombre;
                $scope.errorNombreShow = response.nombre;
                $scope.errorApellido = response.apellido;
                $scope.errorCorreo = response.correo;
                $scope.errorUsuario = response.usuario;
            }
        }).error(function (response) {
            console.log(response);
            alert('Ha Ocurrido un error');
        });
    }


    $scope.guardarUsuario = function () {

        var url = API_URL + "usuario";
        $scope.errorNombre      = '';
        $scope.errorApellido    = '';
        $scope.errorCorreo      = '';
        $scope.errorUsuario     = '';
        $scope.errorPassword    = '';
        $scope.errorRol         = '';
        console.log($scope.usuario.nombre);
        $http({
            method: 'POST',
            url: url,
            data: $.param($scope.usuario),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).success(function (response) {
            console.log(response);
            //alert(response.nombre);
            if (response === true) {
                $.gritter.add({
                        title: 'Notificación',
                        text: '¡El Usuario se guardó correctamente!',
                        //sticky: true,
                        class_name: 'gritter-info'
                });
                $('#modalEdit').modal('hide');
                var table = $('#users-table').DataTable();
                table.ajax.reload();
            } else {
                $scope.errorNombre = response.nombre;
                $scope.errorApellido = response.apellido;
                $scope.errorCorreo = response.correo;
                $scope.errorUsuario = response.usuario;
                $scope.errorPassword = response.password;
                $scope.errorRol = response.rol;
            }
        }).error(function (response) {
            alert('Ha Ocurrido un error');
        });
    }

    $scope.editarUsuario = function(){

        var url = API_URL + "usuario/" + $scope.usuario.id;
        $scope.errorNombre    = '';
        $scope.errorApellido  = '';
        $scope.errorCorreo    = '';
        $scope.errorUsuario   = '';
        $scope.errorPassword  = '';
        $scope.errorRol       = '';
        $scope.errorEstado    = '';
        //console.log($.param($scope.usuario));
        var datos = $( "#frmusuario" ).serialize();
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
                        text: '!El Usuario se actualizó correctamente',
                        //sticky: true,
                        class_name: 'gritter-info'
                    });
            
                    //return false;
                //});
                $('#modalEdit').modal('hide');
                var table = $('#users-table').DataTable();
                table.ajax.reload();
            } else {
                $scope.errorNombre      = response.nombre;
                $scope.errorApellido    = response.apellido;
                $scope.errorCorreo      = response.correo;
                $scope.errorUsuario     = response.usuario;
                $scope.errorPassword    = response.password;
                $scope.errorRol         = response.rol;
                $scope.errorEstado      = response.estado;
            }
        }).error(function (response) {
            alert('Ha Ocurrido un error');
            console.log(response);
        });

    }


    $scope.modalUser = function (modal, iduser) {
        $scope.usuario = "";
        var time = new Date().getTime();

        if (modal == "new") {
            $scope.urlmodal = API_URL + "usuario/modal/new?" + time;
        } else {
            $http.get(API_URL + 'usuario/getdata/' + iduser).success(function (data, status) {
                $scope.usuario = data;
            });
            $scope.urlmodal = API_URL + "usuario/modal/edit/" + iduser + "?" + time;
        }

        $('#modalEdit').modal('show');
    }

    $scope.loadTable = function () {
        $('#users-table').dataTable(options);
    }

});