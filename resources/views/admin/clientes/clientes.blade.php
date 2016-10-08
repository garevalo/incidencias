@extends("admin.template.main")

@section("title","Lista de Clientes")

@section("header")
	@parent
	<link rel="stylesheet" href="{{ asset("css/jquery.gritter.min.css") }}" />
@endsection


@section("content")
<div ng-controller="ClientesController">
	<div class="clearfix">
		<div class="pull-right tableTools-container"></div>
	</div>
	<div class="table-header">
		Clientes Registrados
	</div>

	<!-- div.table-responsive -->

	<!-- div.dataTables_borderWrap -->
	<style>
		#clientes-table td  {
			vertical-align: inherit;
			text-align: center;
		}
	</style>

	<div>
		<table id="clientes-table" class="table table-striped table-bordered table-condensed table-hover" ng-init="loadTable()">
			<thead>
				<tr>
					<th class="center">
						<label class="pos-rel">
							<input type="checkbox" class="ace" /><span class="lbl"></span>
						</label>
					</th>
					<th>Nombre</th>
					<th>Ruc-DNI</th>
					<th>Teléfono</th>
					<th>Dirección</th>
					<th>Correo</th>
					<th style="text-align: center;"><button class="btn btn-success btn-sm" ng-click="modalCliente('new')">Nuevo Cliente</button></th>
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

<div id="dialog-confirm" class="hide">
	
	<div class="space-6"></div>

	<p class="bigger-110 bolder center grey">
		<i class="ace-icon fa fa-hand-o-right blue bigger-120"></i>
		¿Estás seguro de dar de baja a este cliente?
	</p>
</div><!-- #dialog-confirm -->




@endsection

@section("fscript")
	@parent
	<script src="{{ asset("js/jquery-ui.custom.min.js") }}"></script>

	<script>
	app.factory('ClientesFactory',function(){
		var factory={};
		 factory.ajax='{{ route('clientedata') }}';
		 factory.idioma='{{ asset('js/Spanish.json') }}';
		 factory.columns=[
              { data: 'check',  name: 'check',orderable:false,searchable:false },
			  { data: 'nombre',   name: 'nombre' },
	          { data: 'dni_ruc',   name: 'dni_ruc' },
              { data: 'telefono',  name: 'telefono' },
              { data: 'direccion',  name: 'direccion' },
			  { data: 'correo',  name: 'correo' },
              { data: 'edit',   name: 'edit',orderable:false,searchable:false }
          ];
	   return factory;

	});
	</script>

	<script src="{{ asset("js/jquery.dataTables.min.js") }}"></script>
	<script src="{{ asset("js/jquery.dataTables.bootstrap.min.js") }}"></script>

	<script src="{{ asset("app/controllers/clientes.js") }}"></script>
	<script src="{{ asset("js/jquery.gritter.min.js") }}"></script>

@endsection