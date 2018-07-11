@extends('common.layouts.default')

@section('content')
    <div class="main">
      <div class="container">
        <!-- BEGIN SIDEBAR & CONTENT -->
        <div class="row margin-bottom-40">
          <!-- BEGIN CONTENT -->
          <div class="col-md-12">
            <h1>Marketing Materials</h1>
            <div class="content-page">
            	@foreach($marketingMaterials as $marketingMaterial)
	              <div class="search-result-item">
	                <h4 class="marketing-name">{{$marketingMaterial->name}}</h4>
	                <p>{{$marketingMaterial->description}}</p>
	                @if($marketingMaterial->link)
	                <a target="_blank" class="search-link" href="{{$marketingMaterial->link}}">Link</a>
	                @endif
	                <div><a target="_blank" class="search-link fa fa-download" href="{{$marketingMaterial->uploaded_file}}"></a></div>
	              </div>
              	@endforeach
            </div>
            {{ $marketingMaterials->links() }}
          </div>
          <!-- END CONTENT -->
        </div>
      </div>
    </div>
@stop