<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
    <h4 class="modal-title" id="myModalLabel">Nuevo Cliente</h4>
</div>
<div class="modal-body" ng-controller="ClientesController">
    <form name="frmcliente" class="form-horizontal" novalidate="" ng-submit="guardarCliente()">
        {{ csrf_field()  }}
        <div class="form-group error">
            <label for="inputEmail3" class="col-sm-3 control-label">Nombre o Razón Social</label>
            <div class="col-sm-9">
                <input type="text" class="form-control has-error" id="nombre" name="nombre" placeholder="Nombres"  ng-model="cliente.nombre" ng-required="true">
                <span class="label label-warning label-white middle" ng-bind="errorNombre"></span>
            </div>
        </div>

        <div class="form-group">
            <label for="inputEmail3" class="col-sm-3 control-label">Ruc o DNI</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="rucdni" name="rucdni" placeholder="RUC o DNI"  ng-model="cliente.rucdni" ng-required="true">
                <span class="label label-warning label-white middle" ng-bind="errorRucDni"></span>
            </div>
        </div>

        <div class="form-group">
            <label for="inputEmail3" class="col-sm-3 control-label">Teléfono</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Teléfono"  ng-model="cliente.telefono" ng-required="true">
                <span class="label label-warning label-white middle" ng-bind="errorTelefono"></span>
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-3 control-label">Dirección</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Direccion"  ng-model="cliente.direccion" ng-required="true">
                <span class="label label-warning label-white middle" ng-bind="errorDireccion"></span>
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-3 control-label">Correo</label>
            <div class="col-sm-9">
                <input type="email" class="form-control" id="correo" name="correo" placeholder="Correo"  ng-model="cliente.correo" ng-required="true">
                <span class="label label-warning label-white middle" ng-bind="errorCorreo"></span>
            </div>
        </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-primary" id="btn-save" ng-disabled="frmcliente.$invalid">Guardar</button>
        </div>
    
    </form>
    
</div>

