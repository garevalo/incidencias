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
		<li class="<?= ($menu==3)?'active open':''?>">
			<a href="{{url('cliente')}}">
				<i class="menu-icon fa fa-users"></i>
				<span class="menu-text"> Clientes </span>
			</a>

			<b class="arrow"></b>
		</li>
		@endif
		<li class="<?= ($menu==2)?'active open':''?>">
			<a href="{{url('incidencia')}}" class="dropdown-toggle">
				<i class="menu-icon glyphicon glyphicon-time"></i>
				<span class="menu-text"> Incidencias </span>
			</a>
			<b class="arrow"></b>
			<ul class="submenu nav-show">
				@if(Auth::user()->idrol==1)
				<li class="<?= ($submenu==2.1)?'active':''?>">
					<a href="{{url('incidencia/create')}}">
						<i class="menu-icon fa fa-caret-right"></i>
						Nueva Incidencia
					</a>
					<b class="arrow"></b>
				</li>
				@endif
				<li class="<?= ($submenu==2.2)?'active':''?>">
					<a href="{{url('incidencia')}}">
						<i class="menu-icon fa fa-caret-right"></i>
						Lista de Incidencias
					</a>
					<b class="arrow"></b>
				</li>
			</ul>

		</li>
	</ul><!-- /.nav-list -->

	<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
		<i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
	</div>

	<script type="text/javascript">
		try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
	</script>
</div>