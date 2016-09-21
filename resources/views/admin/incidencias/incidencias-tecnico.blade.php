@extends("admin.template.main")

@section("title","Lista de Incidencias")

@section("header")
	@parent

@endsection


@section("content")
<div ng-controller="IncidenciasController">
	<div class="clearfix">
		<div class="pull-right tableTools-container"></div>
	</div>
	<div class="table-header">
		Incidencias Asignadas
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
		<table id="data-table" class="table table-striped table-bordered table-condensed table-hover" ng-init="loadTable()">
			<thead>
				<tr>
					<th class="center">
						<label class="pos-rel">
							<input type="checkbox" class="ace" /><span class="lbl"></span>
						</label>
					</th>
					<th>ID</th>
					<th>Cliente</th>
					<th>Marca</th>
					<th>Modelo</th>
					<th>Serie</th>
					<th>Estado</th>
					<th>Prioridad</th>
					<th></th>
				</tr>
			</thead>
		</table>
	</div>

	<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" >
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<ng-include src="urlmodal"></ng-include>
			</div>
		</div>
	</div>


</div>


@endsection

@section("fscript")
	@parent

	<script>
		app.factory('IncidenciasFactory',function(){
			var factory={};
			factory.ajax='{{ route('incidenciaasignada') }}';
			factory.idioma='{{ asset('js/Spanish.json') }}';
			factory.columns=[
				{ data: 'check',  name: 'check',orderable:false,searchable:false },
				{ data: 'idincidencia',   name: 'idincidencia' },
				{ data: 'nombre',   name: 'nombre' },
				{ data: 'marca',   name: 'marca' },
				{ data: 'modelo',  name: 'modelo' },
				{ data: 'serie',  name: 'serie' },
				{ data: 'estado',  name: 'estado' },
				{ data: 'prioridad',  name: 'prioridad' },
				{ data: 'edit',   name: 'edit',orderable:false,searchable:false }
			];
			return factory;

		});
	</script>

	<script src="{{ asset("js/jquery-ui.custom.min.js") }}"></script>
	<script src="{{ asset("js/jquery.dataTables.min.js") }}"></script>
	<script src="{{ asset("js/jquery.dataTables.bootstrap.min.js") }}"></script>

	<script src="{{ asset("app/controllers/incidencias.js") }}"></script>

@endsection