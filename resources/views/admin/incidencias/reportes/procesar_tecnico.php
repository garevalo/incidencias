<?php if(count($incidencias)>0){ ?>

<table class="table table-bordered table-condensed table-striped">
	<thead class="text-primary">
		<th class="text-primary" style="text-align: center;">Cantidad Registros</th>
		<th class="text-primary" style="text-align: center;">Horas</th>
		<th class="text-primary" style="text-align: center;">Precio</th>
		<th class="text-primary" style="text-align: center;">Fecha</th>
	</thead>
	<tbody>
		<?php $cantidadtotal=''; $horastotal=''; $preciototal=''; ?>	
		<?php foreach ($incidencias as $key => $incidencia) { ?>
		<tr class="text-primary" style="text-align: center;">
			<td><?= $incidencia->cantidad ?></td>
			<td><?= $incidencia->horas ?></td>
			<td><?= $incidencia->precio ?></td>
			<td><?= $incidencia->fecha ?></td>
		</tr>
		<?php 
		$cantidadtotal+= $incidencia->cantidad;
		$horastotal+= $incidencia->horas;
		$preciototal+= $incidencia->precio;
		} ?>	

		<tr class="text-danger" style="text-align: center;">
			<td><strong> Total: <?= $cantidadtotal ?></strong></td>
			<td><strong>Total: <?= $horastotal ?></strong></td>
			<td><strong>Total: <?= $preciototal ?></strong></td>
			<td></td>
		</tr>
			


	</tbody>
	
</table>
<br>

<?php } else { echo "<br><br><div class='alert alert-danger text-center'><h2 >¡No existen datos en la fecha seleccionada!</h2></div>" ;} ?>