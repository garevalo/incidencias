<div id="login-box" class="login-box visible widget-box no-border">
	<div class="widget-body">
		<div class="widget-main">
			<h4 class="header blue lighter bigger">
				<i class="ace-icon fa fa-coffee green"></i>
				Ingrese sus datos
			</h4>

			<div class="space-6"></div>
			
			
			<form method="POST" action="{{route('login')}}">
				{!! csrf_field() !!}
				<fieldset>
					@if (Session::has('errors'))
				    <div class="alert alert-danger" role="alert">
					<ul>
					    @foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
				            @endforeach
				        </ul>
				    </div>
					@endif
		    
					<label></label>
					<label class="block clearfix">
						<span class="block input-icon input-icon-right">
							<input type="text" class="form-control" placeholder="Usuario" name="usuario" value="{{ old('usuario') }}"/>
							<i class="ace-icon fa fa-user"></i>
						</span>
					</label>

					<label class="block clearfix">
						<span class="block input-icon input-icon-right">
							<input type="password" class="form-control" placeholder="Contraseña" name="password" id="password"/>
							<i class="ace-icon fa fa-lock"></i>
						</span>
					</label>

					<div class="space"></div>

					<div class="clearfix">
						<?php /*<label class="inline">
							<input type="checkbox" class="ace" />
							<span class="lbl"> Recordame</span>
						</label> */ ?>

						<button type="submit" class="width-35 pull-right btn btn-sm btn-primary">
							<i class="ace-icon fa fa-key"></i>
							<span class="bigger-110">Iniciar</span>
						</button>
					</div>

					<div class="space-4"></div>
				</fieldset>
			</form>
			<?php /*
			<div class="social-or-login center">
				<span class="bigger-110">Or Login Using</span>
			</div>*/ ?>

			<div class="space-6"></div>
			<?php /*
			<div class="social-login center">
				<a class="btn btn-primary">
					<i class="ace-icon fa fa-facebook"></i>
				</a>

				<a class="btn btn-info">
					<i class="ace-icon fa fa-twitter"></i>
				</a>

				<a class="btn btn-danger">
					<i class="ace-icon fa fa-google-plus"></i>
				</a>
			</div>*/ ?>
		</div><!-- /.widget-main -->

		<div class="toolbar clearfix"><br><br>
			<?php /*<div>
				<a href="#" data-target="#forgot-box" class="forgot-password-link">
					<i class="ace-icon fa fa-arrow-left"></i>
					I forgot my password
				</a>
			</div>

			<div>
				<a href="#" data-target="#signup-box" class="user-signup-link">
					I want to register
					<i class="ace-icon fa fa-arrow-right"></i>
				</a>
			</div>
		</div>*/ ?>
	</div><!-- /.widget-body -->
</div><!-- /.login-box -->