@extends('app_base_theme_1')
@section('content')

@section('content_class') content @endsection

<!-- Main navbar -->
@yield('header')
<!-- /main navbar -->


		<!-- Page content -->
		<div class="page-content" >

			<!-- Main sidebar -->
				@yield('sidebar')
			<!-- /main sidebar -->


			<!-- Main content -->
			<div class="content-wrapper" id="sidebarbody">

				<!-- Page header -->
					@yield('page-header')				
				<!-- /page header -->


				<!-- Content area -->
				<div class="@yield('content_class') " >

				@yield('main')
					<!-- Footer -->
				
					
					<!-- /footer -->

				</div>
				<!-- /content area -->

				@yield('footer')
				
			</div>
			<!-- /main content -->

		</div>
		<!-- /page content -->


@endsection

