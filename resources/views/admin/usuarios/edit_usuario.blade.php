<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
    <h4 class="modal-title" id="myModalLabel">Editar Usuario</h4>
</div>
<div class="modal-body" ng-controller="UsuariosController">
    <form id="frmusuario" name="frmusuario" class="form-horizontal" novalidate="" ng-submit="editarUsuario()">
        {{ method_field('PUT') }}
        {{ csrf_field()  }}
        
        <div class="form-group error">
            <label for="inputEmail3" class="col-sm-3 control-label">Nombres</label>
            <div class="col-sm-9">
                <input type="text" class="form-control has-error" id="name" name="nombre" placeholder="Nombres" ng-model="usuario.name" ng-required="true" >
                <span class="label label-warning label-white middle" ng-bind="errorNombre"></span>
            </div>
        </div>

        <div class="form-group">
            <label for="inputEmail3" class="col-sm-3 control-label">Apellidos</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellidos"  ng-model="usuario.apellido" ng-required="true">
                <span class="label label-warning label-white middle" ng-bind="errorApellido"></span>
            </div>
        </div>

        <div class="form-group">
            <label for="inputEmail3" class="col-sm-3 control-label">Usuario</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuario"  ng-model="usuario.usuario"  ng-required="true" >
                <span class="label label-warning label-white middle" ng-bind="errorUsuario"></span>
            </div>
        </div>

        <div class="form-group">
            <label for="inputEmail3" class="col-sm-3 control-label">Correo</label>
            <div class="col-sm-9">
                <input type="email" class="form-control" id="correo" name="correo" placeholder="Correo"  ng-model="usuario.email"  ng-required="true">
                <span class="label label-warning label-white middle" ng-bind="errorCorreo"></span>
            </div>
        </div>

        <div class="form-group">
            <label for="inputEmail3" class="col-sm-3 control-label">Contraseña</label>
            <div class="col-sm-9">
                <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña"  value="" ng-required="true">
                <span class="label label-warning label-white middle" ng-bind="errorPassword"></span>
            </div>
        </div>

        <div class="form-group">
            <label for="inputEmail3" class="col-sm-3 control-label">Roles</label>
            <div class="col-sm-9">
               <select name="rol" class="form-control">
                    <option value="">Seleccione Rol de usuario</option>
                    @foreach($roles as $rol)
                        <option value="{{$rol->id}}" <?= ( $rol->id==$idrol )?'selected=""':''?> >{{$rol->nombre_rol}}</option>
                    @endforeach    
               </select> 
               
                <span class="label label-warning label-white middle" ng-bind="errorRol"></span>
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-3 control-label">Estado</label>
            <div class="col-sm-9">
                <select name="estado" class="form-control">
                    <option value="">Seleccione Estado</option>
                    <option value="1" <?= ( $user->estado==1 )?'selected=""':''?>>Activo</option>
                    <option value="0" <?= ( $user->estado==0 )?'selected=""':''?>>Inactivo</option>
                </select>

                <span class="label label-warning label-white middle" ng-bind="errorEstado"></span>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary" id="btn-save" ng-disabled="frmusuario.$invalid">Guardar</button>
        </div>
    
    </form>
</div>