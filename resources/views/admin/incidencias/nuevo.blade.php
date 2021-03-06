@extends("admin.template.main")

@section("title","Lista de Usuarios")

@section("header")
	@parent

@endsection


@section("content")
<div ng-controller="IncidenciasController">
	<div class="clearfix">
		<div class="pull-right tableTools-container"></div>
	</div>

	<div class="col-xs-12 col-sm-12 col-lg-12">
		<div class="widget-box widget-color-blue">
			<div class="widget-header">
				<h4 class="widget-title">Nueva Atención</h4>
				<span class="widget-toolbar">
					<a href="#" data-action="reload">
						<i class="ace-icon fa fa-refresh"></i>
					</a>
					<a href="#" data-action="collapse">
						<i class="ace-icon fa fa-chevron-up"></i>
					</a>
					<a href="#" data-action="close">
						<i class="ace-icon fa fa-times"></i>
					</a>
				</span>
			</div>

			<div class="widget-body ">
				<form class="form-horizontal" method="POST" action="{{url('incidencia')}}" id="frm">
				{{ csrf_field()  }}
					<div class="widget-main">

						<div class="row">
							<div class="col-xs-12 col-lg-12">
								<div class="widget-box">
									<div class="widget-header">
										<h4 class="widget-title">Datos del cliente</h4>
									</div>
									<div class="widget-body">
										<div class="widget-main padding-6">
											<div class="form-group has-info">
												<div class="col-lg-3 ">
													<label for="inputInfo">Cliente</label>
													<input type="text" name="cliente" id="cliente"  class="form-control input-sm" value="{{ old('cliente') }}" required="">
													<input type="hidden" id="idcliente" name="idcliente" value="">
													<div id="errornombre" class="help-block orange2">{{$errors->first('cliente')}}</div>
												</div>
												<div class="col-lg-3">
													<label for="form-field-select-3">Dni o Ruc</label>
													<input type="text" name="ruc_dni" id="ruc_dni" class="form-control input-sm" required="" value="{{old('ruc_dni')}}">
													<div id="errordniruc" class="help-block orange2">{{$errors->first('ruc_dni')}}</div>
												</div>
												<div class="col-lg-3">
													<label for="form-field-select-2">Teléfono</label>
													<input type="text" name="telefono" id="telefono" class="form-control input-sm" required="" value="{{old('telefono')}}">
													<div id="errortelefono" class="help-block orange2">{{$errors->first('telefono')}}</div>
												</div>
											</div>
											<div class="form-group has-info">
												<div class="col-lg-6">
													<label for="inputInfo">Dirección</label>
													<input type="text" name="direccion" id="direccion" class="form-control input-sm" required="" value="{{old('direccion')}}">
													<div id="errordireccion" class="help-block orange2">{{$errors->first('direccion')}}</div>
												</div>
											</div>
										</div>
									</div>
								</div>		
							</div>	
						</div>							

						<div class="row">
							<div class="col-lg-6">
								<div class="widget-box">
									<div class="widget-header">
										<h4 class="widget-title">Descripción del equipo</h4>
									</div>
									<div class="widget-body">
										<div class="widget-main padding-6">
											<div class="form-group has-info">
												<div class="col-lg-4">
													<label for="form-field-select-1">Marca</label>
													<input type="text" name="marca" id="marca" class="form-control input-sm" value="{{old('marca')}}" required="">
													<div id=" " class="help-block orange2">{{$errors->first('marca')}}</div>
												</div>
												<div class="col-lg-4">
													<label for="form-field-select-2">Modelo</label>
													<input type="text" name="modelo" id="form-field-select-1" class="form-control input-sm" value="{{old('modelo')}}" required="">
													<div id=" " class="help-block orange2">{{$errors->first('modelo')}}</div>
												</div>
												<div class="col-lg-4">
													<label for="form-field-select-3">Serie</label>
													<input type="text" name="serie" id="form-field-select-1" class="form-control input-sm" value="{{old('serie')}}" required="">
													<div id=" " class="help-block orange2">{{$errors->first('serie')}}</div>
												</div>
											</div>
											<div class="form-group has-info">
												<div class="col-lg-8">
													<label for="form-field-select-1">Descripción para el servicio</label>
													<textarea id="form-field-select-1" class="form-control input-sm" rows="3" name="descripcion_servicio" required="">{{old("descripcion_servicio")}}</textarea>
													<div id="" class="help-block orange2">{{$errors->first('descripcion_servicio')}}</div>
												</div>
												<div class="col-lg-4">
													<label>Tipo</label>
													<select class="form-control input-sm" name="tipo_equipo" required="">
														<option value="">Seleccione Tipo de equipo</option>
														<option value="pc">PC</option>
														<option value="laptop">Laptop</option>
														<option value="tablet">Tablet</option>
													</select>
													<div id=" " class="help-block orange2">{{$errors->first('tipo_equipo')}}</div>
												</div>
											</div>
											<div class="form-group has-info">
												<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
													<label for="form-field-select-1">Condición al recepcionar</label>
													<div class="radio-inline">
														<label>
															<input name="condicion" type="radio" class="ace" value="inoperativo" required="">
															<span class="lbl"> Inoperativo</span>
														</label>
													</div>
													<div class="radio-inline">
														<label>
															<input name="condicion" type="radio" class="ace" value="operativo">
															<span class="lbl"> Operativo</span>
														</label>
													</div>
													<div id=" " class="help-block orange2">{{$errors->first('condicion')}}</div>
												</div>
											</div>
										</div>
									</div>
								
								</div>
							</div>
							<div class="col-lg-6">
								<div class="widget-box">
									<div class="widget-header">
										<h4 class="widget-title">Componentes</h4>
									</div>
									<div class="widget-body">
										<div class="widget-main padding-6">
											<?php
											foreach ($componentes as $key => $componente) { ?>
											<?php if($key%2==0){ ?>	
											<div class="form-group has-info">
											<?php } ?>	
												<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
													<div class="col-lg-6">
														<div class="checkbox">
															<label class="block">
																<input type="checkbox" class="ace" name="componente[]" value="{{$componente->idcomponente}}">
																<span class="lbl"> <?= $componente->componente?></span>
															</label>
														</div>
													</div>
													<div class="col-lg-6">
														<input type="text" name="serie_componente[{{$componente->idcomponente}}]" id="form-field-select-1" class="form-control input-sm" placeholder="">
													</div>
												</div>
												
												
											<?php if($key%2!=0){ ?>	
											</div>
											<?php } ?>
											<?php } ?>
												<div id=" " class="help-block orange2">{{$errors->first('componente')}}</div>
										</div>
									</div>
								</div>	
							</div>	
						</div>
						<div class="row">
							<div class="col-lg-6">
							<div class="widget-box">
								
								<div class="widget-body">
									<div class="widget-main padding-6">

										<div class="form-group has-info">
											<div class="col-lg-6">
												<label for="form-field-select-1">Asignar Técnico</label>
												<select id="inputInfo" class="form-control input-sm" name="tecnico" required="">
													<option value="">Selecciones Técnico</option>{{old('$tecnico->id')}}
													@foreach($tecnicos as $tecnico)
														<option value="{{$tecnico->id}}">{{$tecnico->name.' '.$tecnico->apellido}}</option>
													@endforeach
												</select>
												<div class="help-block orange2">{{$errors->first('tecnico')}}</div>
											</div>

											<div class="col-lg-6">
												<label for="form-field-select-1">Prioridad</label>
												<select class="form-control input-sm" name="prioridad" required="">
													<option value="">Selecciones prioridad</option>
													<option value="1">Baja</option>
													<option value="2">Media</option>
													<option value="3">Alta</option>
												</select>
												<div  class="help-block orange2">{{$errors->first('prioridad')}}</div>
											</div>
											<div class="col-lg-6">
												<label for="form-field-select-1">Precio Estimado</label>
												<input type="number" step="any" class="form-control input-sm" name="precioestimado" required="">
												<div  class="help-block orange2">{{$errors->first('precioestimado')}}</div>
											</div>
										</div>	

									</div>
								</div>	
							</div>
							</div>
						</div>


						<div class="clearfix form-actions">
							<div class="col-md-offset-3 col-md-9">
								<button class="btn btn-primary" type="submit" id="btn-guardar">
									<i class="ace-icon fa fa-check bigger-110"></i>
									Crear Atención
								</button>
							</div>
						</div>	
							
						

					</div>
				</form>
			</div>


		</div>
	</div>

</div>



@endsection

@section("fscript")
	@parent
	<script>
		$("#btn-guardar").click(function(event){
			 if( contador_input('#frm') <= 8){
				//$("#btn-guardar").attr("disabled","disabled");
			 	//$("#frm").submit();
			 	registrar_ajax('frm', 8);
			 }else{
			 	console.log(contador_input('#frm'));
			 	//event.preventDefault();
			 }


			
		});

		$( "#cliente" ).autocomplete({
			source: function( request, response ) {
				$.ajax( {
					url: "{{url('cliente/getcliente/nombre')}}"+'/'+request.term,
					//dataType: "jsonp",
					data: {
						term: request.term
					},
					success: function( data ) {

						response( data );
						console.log(data);
					}
				} );
			},
			minLength: 2,
			select: function( event, ui ) {
				//console.log( "Selected: " + ui.item.value + " aka " + ui.item.id );

				$("#idcliente").val(ui.item.id);
				$("#cliente").val(ui.item.nombre);
				$("#ruc_dni").val(ui.item.dni_ruc);
				$("#telefono").val(ui.item.telefono);
				$("#direccion").val(ui.item.direccion);

				$("#cliente").attr('disabled','disabled');
				$("#ruc_dni").attr('disabled','disabled');
				$("#telefono").attr('disabled','disabled');
				$("#direccion").attr('disabled','disabled');

				$("#marca").focus();
			}
		} );

		app.factory('IncidenciasFactory',function(){
			var factory={};
			return factory;

		});
	</script>
	<script src="{{ asset("js/jquery-ui.custom.min.js") }}"></script>
	<script src="{{ asset("js/jquery.dataTables.min.js") }}"></script>
	<script src="{{ asset("js/jquery.dataTables.bootstrap.min.js") }}"></script>
	<script src="{{ asset("js/jquery.gritter.min.js") }}"></script>
	<script src="{{ asset("app/controllers/incidencias.js") }}"></script>
	<script src="{{ asset("myjs/funciones.js") }}"></script>
@endsection