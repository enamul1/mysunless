@extends('common.layouts.default')

@section('content')

<div class="main">
      <div class="container">
        <ul class="breadcrumb">
            <li><a href="{{url(URL::to('/'))}}">Home</a></li>
            <li class="active">Create new account</li>
        </ul>
        <!-- BEGIN SIDEBAR & CONTENT -->
        <div class="row margin-bottom-40">
          <!-- BEGIN SIDEBAR -->
          <div class="sidebar col-md-3 col-sm-3">
            <ul class="list-group margin-bottom-25 sidebar-menu">
              <li class="list-group-item clearfix"><a href="{{url('/login')}}"><i class="fa fa-angle-right"></i> Login</a></li>
              <li class="list-group-item clearfix"><a href="/password/reset"><i class="fa fa-angle-right"></i> Restore Password</a></li>            </ul>
          </div>
          <!-- END SIDEBAR -->

          <!-- BEGIN CONTENT -->
          <div class="col-md-9 col-sm-9">
            <h1>Create an account</h1>
            <div class="content-form-page">
              <div class="row">
                <div class="col-md-7 col-sm-7 success">
                {{ Form::open(array('url' => 'customers/store', 'class' => 'form-horizontal', 'role'=>'form')) }}
                    <fieldset>
                      <legend>Your personal details</legend>
                      
			          <div class="form-group">
			            {{ HTML::decode(Form::label('firstName', 'First Name <span class="require">*</span>', array('class' => 'col-lg-4 control-label'))) }}
			            <div class="col-lg-8">
			                {{ Form::text('firstName', $value = null, array('class' => 'form-control' )) }}
			            </div>    
			          </div>
			          <div class="form-group">
			            {{ HTML::decode(Form::label('lastName', 'Last Name <span class="require">*</span>', array('class' => 'col-lg-4 control-label'))) }}
			            <div class="col-lg-8">
			                {{ Form::text('lastName', $value = null, array('class' => 'form-control' )) }}
			            </div>    
			          </div>
			          <div class="form-group">
			            {{ HTML::decode(Form::label('email', 'Email <span class="require">*</span>', array('class' => 'col-lg-4 control-label'))) }}
			            <div class="col-lg-8">
			                {{ Form::text('email', $value = null, array('class' => 'form-control' )) }}
			            </div>    
			          </div>               
                    </fieldset>
                    <fieldset>
                      <legend>Your company details</legend>
                      <div class="form-group">
			            {{ HTML::decode(Form::label('company', 'Company Name <span class="require">*</span>', array('class' => 'col-lg-4 control-label'))) }}
			            <div class="col-lg-8">
			                {{ Form::text('company', $value = null, array('class' => 'form-control' )) }}
			            </div>    
			          </div>
			          <div class="form-group">
			            {{ HTML::decode(Form::label('company_type', 'Company Type <span class="require">*</span>', array('class' => 'col-lg-4 control-label'))) }}
			            <div class="col-lg-8">
			                {{Form::select('company_type', array('MOBILE_TANNING_BUSSINESS' => 'MOBILE TANNING BUSSINESS', 'SALON_BASED_BUSINESS' => 'SALON BASED BUSINESS'), 'SALON BASED BUSINESS', array('class' => 'form-control' )) }}
			            </div>    
			          </div>
			          <div class="form-group">
			            {{ HTML::decode(Form::label('company_website', 'Company Website', array('class' => 'col-lg-4 control-label'))) }}
			            <div class="col-lg-8">
			                {{ Form::text('company_website', $value = null, array('class' => 'form-control' )) }}
			            </div>    
			          </div>
			          <div class="form-group">
			            {{ HTML::decode(Form::label('workPhone', 'Work Phone <span class="require">*</span>', array('class' => 'col-lg-4 control-label'))) }}
			            <div class="col-lg-8">
			                {{ Form::text('workPhone', $value = null, array('class' => 'form-control phone' )) }}
			            </div>    
			          </div>
			          <div class="form-group">
			            {{ HTML::decode(Form::label('address', 'Primary Address <span class="require">*</span>', array('class' => 'col-lg-4 control-label'))) }}
			            <div class="col-lg-8">
			                {{ Form::text('address', $value = null, array('class' => 'form-control' )) }}
			            </div>    
			          </div>
			          
			          <div class="form-group">
			            {{ HTML::decode(Form::label('address2', 'Secondary Address', array('class' => 'col-lg-4 control-label'))) }}
			            <div class="col-lg-8">
			                {{ Form::text('address2', $value = null, array('class' => 'form-control' )) }}
			            </div>    
			          </div>
			          <div class="form-group">
			            {{ HTML::decode(Form::label('zip', 'Zip <span class="require">*</span>', array('class' => 'col-lg-4 control-label'))) }}
			            <div class="col-lg-8">
			                {{ Form::text('zip', $value = null, array('class' => 'form-control' )) }}
			            </div>    
			          </div>                        
                      <div class="form-group">
			            {{ HTML::decode(Form::label('city', 'City <span class="require">*</span>', array('class' => 'col-lg-4 control-label'))) }}
			            <div class="col-lg-8">
			                {{ Form::text('city', $value = null, array('class' => 'form-control' )) }}
			            </div>    
			          </div>                        
                      <div class="form-group">
			            {{ HTML::decode(Form::label('state', 'State <span class="require">*</span>', array('class' => 'col-lg-4 control-label'))) }}
			            <div class="col-lg-8">
			                {{ Form::text('state', $value = null, array('class' => 'form-control' )) }}
			            </div>    
			          </div> 			          
                    </fieldset>
                    <fieldset>
                      <legend>Your password</legend>
                      <div class="form-group">
			            {{ HTML::decode(Form::label('password', 'Password <span class="require">*</span>', array('class' => 'col-lg-4 control-label'))) }}
			            <div class="col-lg-8">
			                {{ Form::password('password', array('class' => 'form-control' )) }}
			            </div>    
			          </div> 
			          <div class="form-group">
			            {{ HTML::decode(Form::label('password_confirmation', 'Confirm Password <span class="require">*</span>', array('class' => 'col-lg-4 control-label'))) }}
			            <div class="col-lg-8">
			                {{ Form::password('password_confirmation', array('class' => 'form-control' )) }}
			            </div>    
			          </div>
                    </fieldset>
                    <div class="row">
                    	<div class="col-lg-8 col-md-offset-4 padding-left-0 padding-top-20">  
                    		{{ Form::submit('Create an acoount', array('class' => 'btn btn-primary signup')) }}
                		</div>
                	</div>
                  {{ Form::close() }}
                </div>
                <div class="col-md-4 col-sm-4 pull-right">
                  <div class="form-info">
                    <h2><em>Important</em> Information</h2>
                    <p>Lorem ipsum dolor ut sit ame dolore  adipiscing elit, sed sit nonumy nibh sed euismod ut laoreet dolore magna aliquarm erat sit volutpat. Nostrud exerci tation ullamcorper suscipit lobortis nisl aliquip  commodo quat.</p>

                    <p>Duis autem vel eum iriure at dolor vulputate velit esse vel molestie at dolore.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- END CONTENT -->
        </div>
        <!-- END SIDEBAR & CONTENT -->
      </div>
    </div>
    
   @stop