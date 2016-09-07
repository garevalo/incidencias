@extends("admin.template.main")

@section("title","Lista de Usuarios")

@section("header")
	@parent
	
@endsection


@section("content")
<div ng-controller="UsuariosController">
	<div class="clearfix">
		<div class="pull-right tableTools-container"></div>
	</div>
	<div class="table-header">
		Incidencias
	</div>

	<!-- div.table-responsive -->

	<!-- div.dataTables_borderWrap -->
	<style>
		#users-table td  {
			vertical-align: inherit;
			text-align: center;
		}
	</style>

	<div>
		<table id="users-table" class="table table-striped table-bordered table-condensed table-hover" ng-init="loadTable()">
			<thead>
				<tr>
					<th class="center">
						<label class="pos-rel">
							<input type="checkbox" class="ace" /><span class="lbl"></span>
						</label>
					</th>
					<th>Nombres</th>
					<th>Apellidos</th>
					<th>Usuario</th>
					<th>Correo</th>
					<th>Rol</th>
					<?php /*<th>Imagen</th>*/?>
					<th style="text-align: center;"><button class="btn btn-success btn-sm" ng-click="modalUser('new')">Nuevo Usuario</button></th>
				</tr>
			</thead>
		</table>
	</div>

	<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
		<div class="modal-dialog">
			<div class="modal-content">
				<ng-include src="urlmodal"></ng-include>
			</div>
		</div>
	</div>

</div>



@endsection

@section("fscript")
	@parent
	<script src="{{ asset("js/jquery-ui.custom.min.js") }}"></script>
	<script src="{{ asset("js/jquery.dataTables.min.js") }}"></script>
	<script src="{{ asset("js/jquery.dataTables.bootstrap.min.js") }}"></script>

	<script src="{{ asset("app/controllers/usuarios.js") }}"></script>

@endsection