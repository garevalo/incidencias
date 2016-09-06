<!DOCTYPE html>
<html lang="en" ng-app="apprayuela">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>	@yield("title","Proyecto")</title>

		<meta name="description" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
	
		@section("header") 
			@include('admin.template.header')
		@show

	</head>

	<body class="no-skin">
		
		@include('admin.template.nav')

		<div class="main-container" id="main-container">
			<script type="text/javascript">
				try{ace.settings.check('main-container' , 'fixed')}catch(e){}
			</script>

			
			@include('admin.template.sidebar')

			<div class="main-content">
				<div class="main-content-inner">
					<?php /*
					<div class="breadcrumbs" id="breadcrumbs">
						<script type="text/javascript">
							try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
						</script>

						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="#">Home</a>
							</li>

							<li>
								<a href="#">Other Pages</a>
							</li>
							<li class="active">Blank Page</li>
						</ul><!-- /.breadcrumb -->

						<div class="nav-search" id="nav-search">
							<form class="form-search">
								<span class="input-icon">
									<input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
									<i class="ace-icon fa fa-search nav-search-icon"></i>
								</span>
							</form>
						</div><!-- /.nav-search -->
					</div>
					*/ ?>

					<div class="page-content">
						
						<?php /*@include("admin.template.settings")*/ ?>
						
						<div class="page-header">
							<h1>
								{{@$titulo}}
								<?php /*<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									Common form elements and layouts
								</small> */ ?>  
							</h1>
						</div>


						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->

								@yield("content")
	
								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->

			@include("admin.template.footer")

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->

		
		@section("fscript") 
			@include("admin.template.fscript")
		@show
		
	</body>
</html>
