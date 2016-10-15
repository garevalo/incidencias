<div class="modal-header" style="background-color: #183f67;color: #fff;">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
    <h4 class="modal-title" id="myModalLabel">Incidencia</h4>
</div>
<div class="modal-body" ng-controller="IncidenciasController">


    <div class="">
                                        
        <div id="accordion" class="accordion-style1 panel-group">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                            <i class="ace-icon fa fa-angle-down bigger-110" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>
                            Descripción de la Atención
                        </a>
                    </h4>
                </div>

                <div class="panel-collapse collapse" id="collapseOne">
                    <div class="panel-body no-padding">
                        <table class="table table-condensed table-bordered">
                            <tr class="text-warning bigger-110 orange">
                                <td class=""><strong>Cliente: </strong><% incidencia.nombre %></td>
                                <td class=""><strong>Direccion: </strong><% incidencia.direccion %></td>
                                <td class=""><strong>Ruc o DNI: </strong><% incidencia.dni_ruc %></td>
                                <td class="" colspan="2"><strong>Teléfono: </strong><% incidencia.telefono %></td>
                            </tr>
                            <tr class="text-warning bigger-110 orange">
                                <td class=""><strong>Correo: </strong><% incidencia.correo %></td>
                                <td class=""><strong>Marca: </strong><% incidencia.marca %></td>
                                <td class=""><strong>Modelo: </strong><% incidencia.modelo %></td>
                                <td class="" colspan="2"><strong>Serie: </strong><% incidencia.serie %></td>
                            </tr>
                            <tr class="text-warning bigger-110 orange">
                                <td class=""><strong>Descripción: </strong><% incidencia.descripcion %></td>
                                <td class=""><strong>Tipo: </strong><% incidencia.tipo %></td>
                                <td class=""><strong>Condicion: </strong><% incidencia.condicion %></td>
                                <td class=""><strong>Prioridad: </strong><% nombreprioridad %></td>
                                <td class=""><strong>Precio Estimado: </strong><% incidencia.precio_estimado %></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                            <i class="ace-icon fa fa-angle-right bigger-110" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>
                            Componentes
                        </a>
                    </h4>
                </div>

                <div class="panel-collapse collapse" id="collapseTwo">
                    <div class="panel-body no-padding">
                        <table class="table table-bordered table-condensed table-striped">
                            <thead>
                                <th>Componente</th>
                                <th>Descripción</th>
                            </thead>
                            <tbody>
                                <tr class="text-warning bigger-110 orange" ng-repeat="componente in incidenciacomponente">
                                    <td><% componente.componente %></td>
                                    <td><% componente.serie_componente %></td>
                                </tr>
                            </tbody>
                            
                        </table>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                            <i class="ace-icon fa fa-angle-right bigger-110" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>
                            Técnico
                        </a>
                    </h4>
                </div>

                <div class="panel-collapse collapse in" id="collapseThree">
                    <div class="panel-body">
                        <form name="frmincidencia" id="frmincidencia" class="form-horizontal" novalidate="" ng-submit="guardarIncidencia()">
                            {{ method_field('PUT') }}
                            {{ csrf_field()  }}
     
                            <div class="form-group has-info">
                                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6" <?= (Auth::user()->idrol!=3)?'':'disabled' ?>>
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
                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                    <label for="inputEmail3" class="control-label">Precio Final</label>
                                    <input type="text" name="preciofinal" ng-model="preciofinal" class="form-control" ng-disabled="ispreciofinal" >
                                    <span class="label label-warning label-white middle" ng-bind="error.preciofinal"></span>
                                </div>
                            </div>
                            @if(Auth::user()->idrol!=3)
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary" id="btn-save" ng-disabled="frmincidencia.$invalid || incidencia.estado==3">Guardar</button>
                            </div>
                            @endif
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div><!-- /.col -->
    
</div>

