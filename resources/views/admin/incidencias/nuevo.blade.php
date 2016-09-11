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

	<div class="col-xs-12 col-sm-12 col-lg-12">
		<div class="widget-box widget-color-blue">
			<div class="widget-header">
				<h4 class="widget-title">Nueva Incidencia</h4>

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
				<form class="form-horizontal" method="POST" action="{{url('incidencia')}}">
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
													<input type="text" name="cliente" id="inputInfo" class="form-control input-sm">
												</div>
												<div class="col-lg-3">
													<label for="form-field-select-3">Dni o Ruc</label>
													<input type="text" name="ruc" id="form-field-select-1" class="form-control input-sm">
												</div>
												<div class="col-lg-3">
													<label for="form-field-select-2">Teléfono</label>
													<input type="text" name="telefono" id="form-field-select-1" class="form-control input-sm">
												</div>
											</div>
											<div class="form-group has-info">
												<div class="col-lg-6">
													<label for="inputInfo">Dirección</label>
													<input type="text" name="direccion" id="inputInfo" class="form-control input-sm">
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
													<input type="text" name="marca" id="form-field-select-1" class="form-control input-sm">
												</div>
												<div class="col-lg-4">
													<label for="form-field-select-2">Modelo</label>
													<input type="text" name="modelo" id="form-field-select-1" class="form-control input-sm">
												</div>
												<div class="col-lg-4">
													<label for="form-field-select-3">Serie</label>
													<input type="text" name="serie" id="form-field-select-1" class="form-control input-sm">
												</div>
											</div>
											<div class="form-group has-info">
												<div class="col-lg-8">
													<label for="form-field-select-1">Descripción para el servicio</label>
													<textarea id="form-field-select-1" class="form-control input-sm" rows="3" name="descripcion_servicio"></textarea>
												</div>
											</div>
											<div class="form-group has-info">
												<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
													<label for="form-field-select-1">Condición al recepcionar</label>
													<div class="radio-inline">
														<label>
															<input name="condicion" type="radio" class="ace input-lg" value="inoperativo">
															<span class="lbl"> Inoperativo</span>
														</label>
													</div>
													<div class="radio-inline">
														<label>
															<input name="condicion" type="radio" class="ace input-lg" value="operativo">
															<span class="lbl"> Operativo</span>
														</label>
													</div>

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
											//$bloqueComponente = array_chunk($componentes, 2);
											//print_r($componentes);
											foreach ($componentes as $key => $componente) { ?>
											<?php if($key%2==0){ ?>	
											<div class="form-group has-info">
											<?php } ?>	
												<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
													<div class="col-lg-6">
														<div class="checkbox">
															<label class="block">
																<input type="checkbox" class="ace ace-checkbox-2" name="componente[]">
																<span class="lbl bigger-120"> <?= $componente->componente?></span>
															</label>
														</div>
													</div>
													<div class="col-lg-6">
														<input type="text" name="serie_componente[]" id="form-field-select-1" class="form-control input-sm" placeholder="N° Serie">
													</div>
												</div>
												
												
											<?php if($key%2!=0){ ?>	
											</div>
											<?php } ?>
											<?php } ?>	
										</div>
									</div>
								</div>	
							</div>	
						</div>
						<div class="row">
							<div class="col-lg-6">
							<div class="widget-box">
								<div class="widget-header">
									<h4 class="widget-title">Asignar Técnico</h4>
								</div>
								<div class="widget-body">
									<div class="widget-main padding-6">

										<div class="form-group has-info">
											<div class="col-lg-8">
												<select id="inputInfo" class="form-control input-sm" name="tecnico">
													<option value="">Selecciones Técnico</option>
													<option>Tecnico 1</option>
													<option>Tecnico 2</option>
												</select>
											</div>
										</div>	

									</div>
								</div>	
							</div>
							</div>
						</div>


						<div class="clearfix form-actions">
							<div class="col-md-offset-3 col-md-9">
								<button class="btn btn-primary" type="submit">
									<i class="ace-icon fa fa-check bigger-110"></i>
									Crear Incidencia
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
	<script src="{{ asset("js/jquery-ui.custom.min.js") }}"></script>
	<script src="{{ asset("js/jquery.dataTables.min.js") }}"></script>
	<script src="{{ asset("js/jquery.dataTables.bootstrap.min.js") }}"></script>
	<script src="{{ asset("js/jquery.gritter.min.js") }}"></script>
@endsection