@extends("admin.template.main")

@section("title","Reportes incidencias atendidas")

@section("header")
    @parent


@endsection

@section("content")
    <div class="container-fluid">
        <div class="form-group has-info">
            <form name="frm" id="frm" action="{{url('incidencia/reporte/procesaratendido')}}">
                {{ csrf_field()  }}
                <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label for="inputEmail3" class="control-label">Fecha Inicio</label>
                        <div class="input-group">
                            <input type="text" name="fechaini" id="desde" class="input-sm form-control" required>
                            <span class="input-group-addon">
                                <i class="fa fa-calendar bigger-110"></i>
                            </span>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label for="inputEmail3" class="control-label">Fecha Fin</label>
                        <div class="input-group">
                            <input type="text" name="fechafin" id="hasta" class="input-sm form-control" required>
                            <span class="input-group-addon">
                                <i class="fa fa-calendar bigger-110"></i>
                            </span>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <button class="btn btn-danger btn-sm form-control"  onclick="generar_reporte('frm','reporte')">Ver Reporte</button>
                    </div>
                </div>

                <div class="col-md-10 col-lg-10 col-xs-12 col-sm-12 widget-container-col ui-sortable">
                    <div class="widget-box widget-color-blue ui-sortable-handle">
                        <div class="widget-header">
                            <h5 class="widget-title bigger lighter">
                                Reporte
                            </h5>
                        </div>

                        <div class="widget-body">
                            <div class="widget-main no-padding">

                                <div id="reporte" style="height: 400px"></div>
                            </div>
                        </div>
                    </div>
                </div>


            </form>
        </div>
    </div>


@endsection

@section("fscript")
    @parent
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>

    <script src="{{ asset("myjs/funciones.js") }}"></script>
    <script src="{{ asset("myjs/reportes.js") }}"></script>

@endsection