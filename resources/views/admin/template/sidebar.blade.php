<div id="sidebar" class="sidebar                  responsive">
	<script type="text/javascript">
		try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
	</script>

	<ul class="nav nav-list">

		@if(Auth::user()->idrol==1)
		<li class="<?= ($menu==1)?'active open':''?>">
			<a href="{{url('usuario')}}">
				<i class="menu-icon fa fa-users"></i>
				<span class="menu-text"> Usuarios </span>
			</a>

			<b class="arrow"></b>
		</li>
		@endif

		@if(Auth::user()->idrol==1 || Auth::user()->idrol==3)
		<li class="<?= ($menu==3)?'active open':''?>">
			<a href="{{url('cliente')}}">
				<i class="menu-icon glyphicon glyphicon-user"></i>
				<span class="menu-text"> Clientes </span>
			</a>

			<b class="arrow"></b>
		</li>
		@endif

		<li class="<?= ($menu==2)?'active open':''?>">
			<a href="{{url('incidencia')}}" class="dropdown-toggle">
				<i class="menu-icon glyphicon glyphicon-wrench"></i>
				<span class="menu-text"> Atención de Cliente </span>
			</a>
			<b class="arrow"></b>
			<ul class="submenu nav-show">
				@if(Auth::user()->idrol==1 || Auth::user()->idrol==3)
				<li class="<?= ($submenu==2.1)?'active':''?>">
					<a href="{{url('incidencia/create')}}">
						<i class="menu-icon fa fa-caret-right"></i>
						Nueva Atención
					</a>
					<b class="arrow"></b>
				</li>
				@endif
				<li class="<?= ($submenu==2.2)?'active':''?>">
					<a href="{{url('incidencia')}}">
						<i class="menu-icon fa fa-caret-right"></i>
						Lista de Atención
					</a>
					<b class="arrow"></b>
				</li>
			</ul>

		</li>

		@if(Auth::user()->idrol==1)
		<li class="<?= ($menu==4)?'active open':''?>">
			<a href="{{url('incidencia')}}" class="dropdown-toggle">
				<i class="menu-icon glyphicon glyphicon-list-alt"></i>
				<span class="menu-text"> Reportes </span>
			</a>
			<b class="arrow"></b>
			<ul class="submenu nav-show">
				
				<li class="<?= ($submenu==4.1)?'active':''?>">
					<a href="{{url('reporte/registrados')}}">
						<i class="menu-icon fa fa-caret-right"></i>
						Atenciones Registradas
					</a>
					<b class="arrow"></b>
				</li>
				
				<li class="<?= ($submenu==4.2)?'active':''?>">
					<a href="{{url('reporte/atendidos')}}">
						<i class="menu-icon fa fa-caret-right"></i>
						Atenciones Completas
					</a>
					<b class="arrow"></b>
				</li>
				<li class="<?= ($submenu==4.3)?'active':''?>">
					<a href="{{url('reporte/atendidosxtecnico')}}">
						<i class="menu-icon fa fa-caret-right"></i>
						Atenciones por técnico
					</a>
					<b class="arrow"></b>
				</li>
				<li class="<?= ($submenu==4.4)?'active':''?>">
					<a href="{{url('reporte/eficiencia')}}">
						<i class="menu-icon fa fa-caret-right"></i>
						Reporte Eficiencia
					</a>
					<b class="arrow"></b>
				</li>
				<li class="<?= ($submenu==4.4)?'active':''?>">
					<a href="{{url('reporte/eficacia')}}">
						<i class="menu-icon fa fa-caret-right"></i>
						Reporte Eficacia
					</a>
					<b class="arrow"></b>
				</li>
			</ul>

		</li>
		@endif
	</ul><!-- /.nav-list -->

	<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
		<i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
	</div>

	<script type="text/javascript">
		try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
	</script>
</div>