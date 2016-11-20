<?php if(count($incidencias)>0){ ?>

<table class="table table-bordered table-condensed table-striped">
	<thead class="text-primary">
		<th class="text-primary" style="text-align: center;">Item</th>
		<th class="text-primary" style="text-align: center;">Fecha Realizada</th>
		<th class="text-primary" style="text-align: center;">N° Atención Realizada</th>
		<th class="text-primary" style="text-align: center;">N° Atención Previsto</th>
		<th class="text-primary" style="text-align: center;">Grado de eficacia</th>
	</thead>
	<tbody>
		<?php $totalatenciones=''; $cantidadtotal=''; $preciototal=''; ?>	
		<?php foreach ($incidencias as $key => $incidencia) { ?>
		<tr class="text-primary" style="text-align: center;">
			<td><?= $key+1 ?></td>
			<td><?= $incidencia->fecha ?></td>
			<td><?= $incidencia->cantidad?></td>
			<td><?= $cantidade ?></td>
			<td><?= round(($incidencia->cantidad/$cantidade)*100,2) ?>%</td>
		</tr>
		<?php 
		$cantidadtotal+= $incidencia->cantidad;
		} ?>	

		<tr class="text-danger" style="text-align: center;">
			<td><strong> Total:</strong></td>
			<td></td>
			<td><?= $cantidadtotal ?></td>
			<td><?= $totalatenciones=$cantidade * count($incidencias)?></td>
			<td><?= round(($cantidadtotal/$totalatenciones)*100,2)?>%</td>
		</tr>
			


	</tbody>
	
</table>
<?php /*
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
</table> */ ?>

<?php } else { echo "<br><br><div class='alert alert-danger text-center'><h2 >¡No existen datos en la fecha seleccionada!</h2></div>" ;} ?>