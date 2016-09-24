<div class="modal-header" style="background-color: #183f67;color: #fff;">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
    <h4 class="modal-title" id="myModalLabel">Incidencia</h4>
</div>
<div class="modal-body" ng-controller="IncidenciasController">
    <form name="frmincidencia" id="frmincidencia" class="form-horizontal" novalidate="" ng-submit="guardarIncidencia()">
        {{ method_field('PUT') }}
        {{ csrf_field()  }}
        <h3>Descripción de la incidencia</h3>
        <div class="form-group has-success">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <label for="inputEmail3" class="control-label orange">Cliente</label>
                <label class="form-control input-sm"><% incidencia.nombre %></label>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <label for="inputEmail3" class="control-label orange">Dirección</label>
                <label class="form-control input-sm"><% incidencia.direccion %></label>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 ">
                <label for="inputEmail3" class="control-label orange">Ruc o DNI</label>
                <label class="form-control input-sm"><% incidencia.dni_ruc %></label>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
                <label for="inputEmail3" class="control-label orange">Teléfono</label>
                <label class="form-control input-sm"><% incidencia.telefono %></label>
            </div>

            <div class="col-lg-3 col-md-4  col-sm-6 col-xs-6">
                <label for="inputEmail3" class="control-label orange">Correo</label>
                <label class="form-control input-sm"><% incidencia.correo %></label>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
                <label for="inputEmail3" class="control-label orange">Marca</label>
                <label class="form-control input-sm"><% incidencia.marca %></label>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
                <label for="inputEmail3" class="control-label orange">Modelo</label>
                <label class="form-control input-sm"><% incidencia.modelo %></label>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
                <label for="inputEmail3" class="control-label orange">Serie</label>
                <label class="form-control input-sm"><% incidencia.serie %></label>
            </div>

            <div class="col-lg-6 col-md-8 col-sm-6 col-xs-6">
                <label for="inputEmail3" class="control-label orange">Descripción</label>
                <label class="form-control input-sm"><% incidencia.descripcion %></label>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
                <label for="inputEmail3" class="control-label orange">Tipo</label>
                <label class="form-control input-sm"><% incidencia.tipo %></label>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
                <label for="inputEmail3" class="control-label orange">Condicion</label>
                <label class="form-control input-sm"><% incidencia.condicion %></label>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
                <label for="inputEmail3" class="control-label orange">Prioridad</label>
                <label class="form-control input-sm"><% nombreprioridad %></label>
            </div>
        </div>
        <h3>Técnico</h3>
        <div class="form-group has-info">
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6" <?= (Auth::user()->idrol!=1)?'':'disabled' ?>>
                <label for="inputEmail3" class="control-label">Estado</label>
                <select class="form-control input-sm" name="estado" ng-options="option.nombre_estado for option in estados track by option.idestado" ng-model="selectincidencia" ng-change="estadoclick()"></select>
            </div>
        </div>

        <div class="form-group has-info">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <label for="inputEmail3" class="control-label">Diágnostico</label>
                <textarea name="diagnostico" id="diagnostico" ng-model="incidencia.diagnostico" class="form-control" ng-disabled="isdiagnostico" ></textarea>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <label for="inputEmail3" class="control-label">Descripción de la repación</label>
                <textarea name="descripcion" ng-model="incidencia.descripcion_tecnico" class="form-control" ng-disabled="isdescripcion" ></textarea>
            </div>
        </div>
        @if(Auth::user()->idrol!=1)
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary" id="btn-save" ng-disabled="frmincidencia.$invalid">Guardar</button>
        </div>
        @endif

    </form>
</div>

