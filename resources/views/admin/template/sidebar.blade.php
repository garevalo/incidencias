<div id="sidebar" class="sidebar                  responsive">
				<script type="text/javascript">
					try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
				</script>

				<ul class="nav nav-list">

					<li class="<?= ($menu==1)?'active open':''?>">
						<a href="{{url('usuario')}}">
							<i class="menu-icon fa fa-users"></i>
							<span class="menu-text"> Usuarios </span>
						</a>

						<b class="arrow"></b>
					</li>
					<li class="<?= ($menu==2)?'active open':''?>">
						<a href="{{url('asistencia')}}">
							<span class="menu-icon glyphicon glyphicon-time" aria-hidden="true"></span>
							<span class="menu-text"> Incidencias </span>
						</a>

						<b class="arrow"></b>
					</li>

				</ul><!-- /.nav-list -->

				<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					<i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
				</div>

				<script type="text/javascript">
					try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
				</script>
			</div>