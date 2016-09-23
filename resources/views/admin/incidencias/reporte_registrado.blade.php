@extends("admin.template.main")

@section("title","Reportes por mes")

@section("header")
    @parent


@endsection

@section("content")
    <div class="container-fluid" ng-controller="IncidenciasController">
        <div class="form-group has-info">
            <form name="frm" id="frm" novalidate="" ng-submit="verreporte()">
                <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label for="inputEmail3" class="control-label">Fecha Inicio</label>
                        <div class="input-group">
                            <input type="text" name="fechaini" class="input-sm form-control" calendar ng-model="fechaini" required>
                            <span class="input-group-addon">
                                <i class="fa fa-calendar bigger-110"></i>
                            </span>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label for="inputEmail3" class="control-label">Fecha Fin</label>
                        <div class="input-group">
                            <input type="text" name="fechaini" class="input-sm form-control" calendar ng-model="fechafin" required>
                            <span class="input-group-addon">
                                <i class="fa fa-calendar bigger-110"></i>
                            </span>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <button class="btn btn-danger btn-sm form-control" ng-disabled="frm.$invalid">Ver Reporte</button>
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
                                <ng-include src="urlreporte"></ng-include>
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
    <script>
        app.factory('IncidenciasFactory',function(){
            var factory={};
            return factory;

        });
    </script>
    <script src="{{ asset("app/controllers/incidencias.js") }}"></script>

    <script>
        $(function () {
            $('#container').highcharts({
                chart: {
                    type: 'area'
                },
                title: {
                    text: 'Historic and Estimated Worldwide Population Growth by Region'
                },
                subtitle: {
                    text: 'Source: Wikipedia.org'
                },
                xAxis: {
                    categories: ['1750', '1800', '1850', '1900', '1950', '1999', '2050'],
                    tickmarkPlacement: 'on',
                    title: {
                        enabled: false
                    }
                },
                yAxis: {
                    title: {
                        text: 'Billions'
                    },
                    labels: {
                        formatter: function () {
                            return this.value / 1000;
                        }
                    }
                },
                tooltip: {
                    shared: true,
                    valueSuffix: ' millions'
                },
                plotOptions: {
                    area: {
                        stacking: 'normal',
                        lineColor: '#666666',
                        lineWidth: 1,
                        marker: {
                            lineWidth: 1,
                            lineColor: '#666666'
                        }
                    }
                },
                series: [{
                    name: 'Asia',
                    data: [502, 635, 809, 947, 1402, 3634, 5268]
                }, {
                    name: 'Africa',
                    data: [106, 107, 111, 133, 221, 767, 1766]
                }, {
                    name: 'Europe',
                    data: [163, 203, 276, 408, 547, 729, 628]
                }, {
                    name: 'America',
                    data: [18, 31, 54, 156, 339, 818, 1201]
                }, {
                    name: 'Oceania',
                    data: [2, 2, 2, 6, 13, 30, 46]
                }]
            });
        });
    </script>
@endsection