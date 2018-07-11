@extends('dashboard.layouts.default')

@section('content')

<div class="row">
	<div class="col-md-12">
		<!-- BEGIN PAGE TITLE & BREADCRUMB-->
		<h3 class="page-title">
		Business Tools - {{$businessToolType}} <small></small>
		</h3>
		<ul class="page-breadcrumb breadcrumb">
			<li>
				<i class="fa fa-home"></i>
				<a href="{{url(URL::to('/dashboard'))}}">Home</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<a href="#">Business Tools - {{$businessToolType}} </a>
			</li>
		</ul>
		<!-- END PAGE TITLE & BREADCRUMB-->
	</div>
</div>
<!-- END PAGE HEADER-->

<!-- BEGIN PAGE CONTENT-->
@foreach($businessTools as $businessTool)
<div class="row">
	<div class="col-md-12 blog-page">
		<div class="row">
			<div class="col-md-9 col-sm-8 article-block">

				<div class="row">
					<div class="col-md-4 blog-img blog-tag-data business-tool-block">
						<img src="http://localhost:63342/mysunless/public/metronic_3.0.1/metronic/assets/admin/pages/media/gallery/Chrysanthemum.jpg" alt="" class="img-responsive">
						<ul class="list-inline">
							<li>
								<i class="fa fa-calendar"></i>
								Uploaded at: {{date_format($businessTool->updated_at, 'F m, Y')}}
							</li>
						</ul>
					</div>
					<div class="col-md-8 blog-article">
						<h3>
						{{$businessTool->name}}
						</h3>
						<p>
							{{$businessTool->description}}
						</p>
						<a class="btn blue" target="_blank" href="http://<?php echo $_SERVER['SERVER_NAME'];?>/{{$businessTool->uploaded_file}}">
						Download <i class="m-icon-swapright m-icon-white"></i>
						</a>
					</div>
				</div>

				<hr>

			</div>
			<!--end col-md-9-->

		</div>

@endforeach
{{ $businessTools->links() }}

	</div>
</div>
<!-- END PAGE CONTENT-->
@stop