@extends("admin.template.main")

@section("title","Perfil de Usuario")

@section("header")
	@parent
	
	<link rel="stylesheet" type="text/css" href="misestilos.css">	

@endsection


@section("content")

	<div class="" ng-controller="Usuarios2Controller">
		<div id="user-profile-2" class="user-profile">
			<div class="tabbable">
				<ul class="nav nav-tabs padding-18">
					<li class="active">
						<a data-toggle="tab" href="#home">
							<i class="green ace-icon fa fa-user bigger-120"></i>
							Perfil
						</a>
					</li>

					<li>
						<a data-toggle="tab" href="#feed">
							<i class="orange ace-icon fa fa-rss bigger-120"></i>
							Cambiar Contraseña
						</a>
					</li>
				</ul>

				<div class="tab-content no-border padding-24">
					<div id="home" class="tab-pane in active">
						<div class="row">
							<div class="col-xs-12 col-sm-3 center">
								<span class="profile-picture">
									<img class="editable img-responsive" alt="{{Auth::user()->name}}" id="avatar2" src="{{asset(Auth::user()->image)}}">
								</span>

							</div><!-- /.col -->

							<div class="col-xs-12 col-sm-9">
								<form name="frmUsuario" class="form-horizontal" novalidate="" ng-submit="save()">
								<h4 class="blue">
									<span class="middle" ng-bind="nombreTitulo"></span>
								</h4>
								
								<div class="profile-user-info">
									<div class="profile-info-row">
										<div class="profile-info-name"> Nombre </div>

										<div class="profile-info-value">
											<input type="text"  id="nombre" name="nombre" placeholder="Nombres" ng-model="usuario.nombre" ng-required="true">
											<?php /*<span class="label label-warning label-white middle" ng-show="frmUsuario.nombre.$invalid && frmUsuario.nombre.$touched && errorNombre"><% errorNombre %></span>*/ ?>
											<span class="label label-warning label-white middle" ng-bind="errorNombre"></span> 
										</div>
									</div>

									<div class="profile-info-row">
										<div class="profile-info-name"> Apellido </div>

										<div class="profile-info-value">
											<input type="text" name="apellido" ng-model="usuario.apellido" ng-required="true">
											<span class="label label-warning label-white middle" ng-bind="errorApellido"></span>
										</div>
									</div>

									<div class="profile-info-row">
										<div class="profile-info-name"> Correo </div>

										<div class="profile-info-value">
											<input type="text" name="correo" ng-model="usuario.correo">
											<span class="label label-warning label-white middle" ng-bind="errorCorreo"></span>
										</div>
									</div>
									<div class="profile-info-row">
										<div class="profile-info-name"> Usuario </div>

										<div class="profile-info-value">
											<input type="text" name="usuario" ng-model="usuario.usuario">
											<span class="label label-warning label-white middle" ng-bind="errorUsuario"></span>
										</div>
									</div>
									

								</div>
								<div class="row col-xs-12 col-sm-12 col-md-8 col-lg-8" style="border-top: 1px solid #ccc;padding-top: 4px;margin-top: 15px;">
									<div class="col-lg-offset-1 col-xs-6 col-sm-4 col-md-6 col-lg-4">
									  <button  type="submit" class="btn btn-primary"  ng-disabled="frmUsuario.$invalid"><i class="fa fa-check" ></i> Guardar</button>
									</div>
									<div class="col-xs-6 col-sm-4 col-md-6 col-lg-4">
									  <button type="reset" class="btn btn-danger"><i class="fa fa-undo"></i> Cancelar</button>
									</div>
								</div>

							</form>	
							</div><!-- /.col -->

						</div><!-- /.row -->

					</div><!-- /#home -->

					<div id="feed" class="tab-pane">
						<div class="profile-feed row">
								
							<div class="col-xs-12 col-sm-9">
								<form name="frmContrasena" class="form-horizontal" novalidate="" ng-submit="">
									<h4 class="blue">Cambiar Contraseña</h4>

									<div class="profile-info-row">
										<div class="profile-info-name"> Contraseña </div>

										<div class="profile-info-value">
											<input type="password" name="contrasena">
										</div>
									</div>
									<div class="profile-info-row">
										<div class="profile-info-name">Repetir Contraseña </div>

										<div class="profile-info-value">
											<input type="password" name="contrasena">
										</div>
									</div>

									<div class="row col-xs-12 col-sm-12 col-md-8 col-lg-8" style="border-top: 1px solid #ccc;padding-top: 4px;margin-top: 15px;">
										<div class="col-lg-offset-1 col-xs-6 col-sm-4 col-md-6 col-lg-4">
										  <button  type="submit" class="btn btn-primary"  ng-disabled="frmUsuario.$invalid"><i class="fa fa-check" ></i> Guardar</button>
										</div>
										<div class="col-xs-6 col-sm-4 col-md-6 col-lg-4">
										  <button class="btn btn-danger"><i class="fa fa-undo"></i> Cancelar</button>
										</div>
									</div>

								</form>
							</div>

						</div><!-- /.row -->
					</div><!-- /#feed -->

				</div>
			</div>
		</div>
	</div>

@endsection

@section("fscript")

	@parent 

	<script src="{{ asset("js/jquery-ui.custom.min.js") }}"></script>
	
	
	
	<script type="text/javascript">
			jQuery(function($) {
									
				//another option is using modals
				$('#avatar2').on('click', function(){
					var modal = 
					'<div class="modal fade">\
					  <div class="modal-dialog">\
					   <div class="modal-content">\
						<div class="modal-header">\
							<button type="button" class="close" data-dismiss="modal">&times;</button>\
							<h4 class="blue">Elije tu imagen</h4>\
						</div>\
						\
						<form class="no-margin" enctype="multipart/form-data" id="formimg" method="POST">\
						 <div class="modal-body">\
							<div class="space-4"></div>\
							<div style="width:75%;margin-left:12%;"><input type="file" name="file-input" /><input type="hidden" name="_token" value="{{csrf_token()}}" /></div>\
						 </div>\
						\
						 <div class="modal-footer center">\
							<button type="submit" class="btn btn-sm btn-success"><i class="ace-icon fa fa-check"></i> Guardar</button>\
							<button type="button" class="btn btn-sm" data-dismiss="modal"><i class="ace-icon fa fa-times"></i> Cancelar</button>\
						 </div>\
						</form>\
					  </div>\
					 </div>\
					</div>';
					
					
					var modal = $(modal);
					modal.modal("show").on("hidden", function(){
						modal.remove();
					});
			
					var working = false;
			
					var form = modal.find('form:eq(0)');
					var file = form.find('input[type=file]').eq(0);
					file.ace_file_input({
						style:'well',
						btn_choose:'Click para escoger nuevo avatar',
						btn_change:null,
						no_icon:'ace-icon fa fa-picture-o',
						thumbnail:'large',
						before_remove: function() {
							//don't remove/reset files while being uploaded
							return !working;
						},
						allowExt: ['jpg', 'jpeg', 'png', 'gif'],
						allowMime: ['image/jpg', 'image/jpeg', 'image/png', 'image/gif']
					});
			
					form.on('submit', function(){
						if(!file.data('ace_input_files')) return false;
						


						file.ace_file_input('disable');
						form.find('button').attr('disabled', 'disabled');
						form.find('.modal-body').append("<div class='center'><i class='ace-icon fa fa-spinner fa-spin bigger-150 orange'></i></div>");
						
						var deferred = new $.Deferred;
						working = true;
						deferred.done(function() {
							form.find('button').removeAttr('disabled');
							form.find('input[type=file]').ace_file_input('enable');
							form.find('.modal-body > :last-child').remove();
							
							modal.modal("hide");
			
							var thumb = file.next().find('img').data('thumb');

							var formData = new FormData($("#formimg")[0]);
							//var formData = new FormData(document.getElementById("formimg"));
							//console.log(formData);
							$.ajax({
									url: "/usuario/image",
									type: "post",
									dataType: "html",
									data: formData,
									cache: false,
									contentType: false,
									processData: false,
									success: function(datos)
									{
										console.log(datos);
									}
							});

							if(thumb) $('#avatar2').get(0).src = thumb;
			
							working = false;
						});
						
						
						setTimeout(function(){
							deferred.resolve();
						} , parseInt(Math.random() * 800 + 800));
			
						return false;
					});
							
				});
			

			});
		</script>

	<script src="{{ asset("app/controllers/usuarios.js") }}"></script>

	<script type="text/javascript">
		app.factory('UsuariosFactory',function(){
			var factory={};
			return factory;
		});
		app.controller("Usuarios2Controller", function($scope, $controller)
		{
		    $controller('UsuariosController',{$scope : $scope });
		    $scope.usuario = {
				nombre:'{{ Auth::user()->name }}',
				apellido:'{{Auth::user()->apellido}}',
				correo  : '{{Auth::user()->email}}',
				usuario  : '{{Auth::user()->usuario}}',
			}
			$scope.nombreTitulo = '{{Auth::user()->name.' '.Auth::user()->apellido}}';

		});
	</script>

@endsection	