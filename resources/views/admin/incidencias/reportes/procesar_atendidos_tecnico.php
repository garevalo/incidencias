<script>

    $(function () {

        $(function () {
    $('#container').highcharts({
        chart: {
            type: 'column' 
        },
        title: {
            text: 'Atendidos por Técnico'
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            type: 'category',
            labels: {
                rotation: -45,
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Cantidad de Atenciones'
            }
        },
        legend: {
            enabled: false
        },
        tooltip: {
            pointFormat: 'Cantidad de Atenciones'
        },
        series: [{
            name: 'Population',
            data: [
            	<?php $i=1; foreach ($incidencias as $key => $incidencia) { ?>
            		['<?= $incidencia->tecnico ?>', <?= $incidencia->cantidad ?>]
            		<?= ($i==count($incidencias))?'':',' ?>
            	<?php $i++;} ?>
            ],
            dataLabels: {
                enabled: true,
                rotation: -90,
                color: '#FFFFFF',
                align: 'right',
                format: '{point.y:.1f}', // one decimal
                y: 10, // 10 pixels down from the top
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        }]
    });
});



    });
</script>

<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>