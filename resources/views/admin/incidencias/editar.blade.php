<div class="modal-header" style="background-color: #183f67;color: #fff;">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
    <h4 class="modal-title" id="myModalLabel">Incidencia</h4>
</div>
<div class="modal-body" ng-controller="IncidenciasController">
    <form name="frmcliente" class="form-horizontal" novalidate="" ng-submit="guardarCliente()">
        {{ csrf_field()  }}

        <div class="form-group has-warning">

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <label for="inputEmail3" class="control-label">Cliente</label>
                <label class="form-control input-sm"><% incidencia.nombre %></label>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <label for="inputEmail3" class="control-label">Dirección</label>
                <label class="form-control input-sm"><% incidencia.direccion %></label>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
                <label for="inputEmail3" class="control-label">Ruc o DNI</label>
                <label class="form-control input-sm"><% incidencia.dni_ruc %></label>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
                <label for="inputEmail3" class="control-label">Teléfono</label>
                <label class="form-control input-sm"><% incidencia.telefono %></label>
            </div>

            <div class="col-lg-3 col-md-4  col-sm-6 col-xs-6">
                <label for="inputEmail3" class="control-label">Correo</label>
                <label class="form-control input-sm"><% incidencia.correo %></label>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
                <label for="inputEmail3" class="control-label">Marca</label>
                <label class="form-control input-sm"><% incidencia.marca %></label>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
                <label for="inputEmail3" class="control-label">Modelo</label>
                <label class="form-control input-sm"><% incidencia.modelo %></label>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
                <label for="inputEmail3" class="control-label">Serie</label>
                <label class="form-control input-sm"><% incidencia.serie %></label>
            </div>

            <div class="col-lg-6 col-md-8 col-sm-6 col-xs-6">
                <label for="inputEmail3" class="control-label">Descripción</label>
                <label class="form-control input-sm"><% incidencia.descripcion %></label>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
                <label for="inputEmail3" class="control-label">Tipo</label>
                <label class="form-control input-sm"><% incidencia.tipo %></label>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
                <label for="inputEmail3" class="control-label">Condicion</label>
                <label class="form-control input-sm"><% incidencia.condicion %></label>
            </div>
        </div>

        <div class="form-group">
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
                <label for="inputEmail3" class="control-label">Estado</label>
                <select class="form-control input-sm"
                        ng-options="option.nombre_estado for option in estados track by option.idestado"
                        ng-model="selectincidencia"></select>

                <select name="mySelect" id="mySelect"
                        ng-options="option.name for option in dataOption track by option.id"
                        ng-model="selected"></select>
            </div>
        </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-primary" id="btn-save" ng-disabled="frmcliente.$invalid">Guardar</button>
        </div>

    </form>
</div>

