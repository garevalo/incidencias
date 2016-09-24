<script>
    $(function () {
        $('#container').highcharts({
            chart: {
                type: 'area'
            },
            title: {
                text: 'Reporte'
            },
            subtitle: {
                text: 'Incidencias  <?= $tipo ?>'
            },
            xAxis: {
                categories: [
                    <?php
                       $i=1; foreach ($incidencias as $incidencia){
                            echo "'".$incidencia->dia."'";
                            if($i!=count($incidencias)){echo ",";}
                       $i++; }
                    ?> ],
                tickmarkPlacement: 'on',
                title: {
                    enabled: false
                }
            },
            yAxis: {
                title: {
                    text: 'Cantidad de Registros'
                },
                labels: {
                    formatter: function () {
                        return this.value;
                    }
                }
            },
            tooltip: {
                shared: true,
                valueSuffix: ' Registros'
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
                name: 'Cantidad',
                data: [ <?php
                    $x=1; foreach ($incidencias as $incidencia){
                        echo $incidencia->cantidad;
                        if($x!=count($incidencias)){echo ",";}
                        $x++; }
                    ?>]
            }]
        });
    });
</script>

<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>