<?php if(count($incidencias)>0){ ?>

<table class="table table-bordered table-condensed table-striped">
	<thead class="text-primary">
		<th class="text-primary" style="text-align: center;">Item</th>
		<th class="text-primary" style="text-align: center;">Fecha Trámite</th>
		<th class="text-primary" style="text-align: center;">Fecha Entrega</th>
		<th class="text-primary" style="text-align: center;">N° Atención Realizada</th>
		<th class="text-primary" style="text-align: center;">N° Atención Terminada</th>
		<th class="text-primary" style="text-align: center;">Grado de Cumplimiento</th>
	</thead>
	<tbody>
		<?php $cantidadAT=''; $totalR=''; $preciototal=''; ?>	
		<?php foreach ($incidencias as $key => $incidencia) { ?>
		<tr class="text-primary" style="text-align: center;">
			<td><?= $incidencia->idincidencia ?></td>
			<td><?= $incidencia->fecha_creacion ?></td>
			<td><?= $incidencia->fecha_completa ?></td>
			<td>1</td>
			<td><?= $at=($incidencia->fecha_completa!='00-00-0000')?'1':'0' ?></td>
			<td><?= ($incidencia->fecha_completa!='00-00-0000')?'100':'0' ?>%</td>
		</tr>
		<?php $cantidadAT = $cantidadAT+$at; } ?>
		<tfoot>
			<tr class="text-danger" style="text-align: center;">
			<td><strong> Total:</strong></td>
			<td><strong></strong></td>
			<td><strong></strong></td>
			<td><strong><?= $totalR = count($incidencias)?></strong></td>
			<td><strong><?= $cantidadAT ?></strong></td>
			<td><strong><?= round(($cantidadAT/$totalR)*100,2) ?>%</strong></td>
			</tr>
		</tfoot>
		
			


	</tbody>
	
</table>
<?php /*
<br>

<table class="table table-bordered table-condensed" style="text-align: center;">
	<thead>
		<th style="text-align: center;">Grado de cumplimiento</th>
	</thead>
	<tr>
		<td>
			<strong>(RA/CA*TA)</strong> / <strong>(RE/CE*TE)</strong>
		</td>
	</tr>
	<tr>
		<td>

		</td>
	</tr>
	<tr>
		<td class="text-info"><strong>Dónde:</strong><br>R= Registro de equipo de cómputo <br> C = Costo<br> T= Tiempo<br> A=Alcanzado<br> E=Esperado.</td>
	</tr>
</table>*/ ?>

<?php } else { echo "<br><br><div class='alert alert-danger text-center'><h2 >¡No existen datos en la fecha seleccionada!</h2></div>" ;} ?>