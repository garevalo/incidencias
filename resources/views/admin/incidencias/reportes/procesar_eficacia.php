<?php if(count($incidencias)>0){ ?>

<table class="table table-bordered table-condensed table-striped">
	<thead class="text-primary">
		<th class="text-primary" style="text-align: center;">Cantidad Registros</th>
		<th class="text-primary" style="text-align: center;">Fecha</th>
	</thead>
	<tbody>
		<?php $cantidadtotal=''; $horastotal=''; $preciototal=''; ?>	
		<?php foreach ($incidencias as $key => $incidencia) { ?>
		<tr class="text-primary" style="text-align: center;">
			<td><?= $incidencia->cantidad ?></td>
			<td><?= $incidencia->fecha ?></td>
		</tr>
		<?php 
		$cantidadtotal+= $incidencia->cantidad;
		} ?>	

		<tr class="text-danger" style="text-align: center;">
			<td><strong> Total: <?= $cantidadtotal ?></strong></td>
			<td></td>
		</tr>
			


	</tbody>
	
</table>
<br>

<table class="table table-bordered table-condensed" style="text-align: center;">
	<thead>
		<th style="text-align: center;">Eficacia</th>
	</thead>
	<tr>
		<td>
			<strong>(RA/RE)</strong> / <strong>(RA/RE)</strong>
		</td>
	</tr>
	<tr>
		<td>
			(<?=$cantidadtotal?>/<?= $cantidade?>) = <?php echo round( ($cantidadtotal / $cantidade ),4) ?>
		</td>
	</tr>
	<tr>
		<td class="text-info"><strong>Dónde:</strong><br>R= Registro de equipo de cómputo <br> A=Alcanzado<br> E=Esperado.</td>
	</tr>
</table>

<?php } else { echo "<br><br><div class='alert alert-danger text-center'><h2 >¡No existen datos en la fecha seleccionada!</h2></div>" ;} ?>