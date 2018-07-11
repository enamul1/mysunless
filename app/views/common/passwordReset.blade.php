@extends('common.layouts.default')

@section('content')

@extends('common.layouts.default')

@section('content')

<link href="{{ URL::asset('assets/css/auth.css') }}" rel="stylesheet">

<!-- BEGIN CONTENT -->
<div class="col-md-9 col-sm-9">
    <h1>Reset Your Password</h1>
    <div class="content-form-page">
        <div class="row">
            <div class="login-error">
                @foreach($errors->all() as $error)
                <h5 class="text-danger">{{$error}}</h5>
                @endforeach
            </div>

            <div class="col-md-7 col-sm-7">
                <form method="post" action="{{ action('RemindersController@postReset') }}" class="form-horizontal form-without-legend" role="form">
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="form-group">
                        <label for="email" class="col-lg-4 control-label">Email <span class="require">*</span></label>
                        <div class="col-lg-8">
                            <input name="email" type="text" class="form-control" id="email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-lg-4 control-label">Password <span class="require">*</span></label>
                        <div class="col-lg-8">
                            <input name="password" type="password" class="form-control" id="email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation" class="col-lg-4 control-label">Confirm Password <span class="require">*</span></label>
                        <div class="col-lg-8">
                            <input name="password_confirmation" type="password" class="form-control" id="email">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 col-md-offset-4 padding-left-0 padding-top-20">
                            <button type="submit" class="btn btn-primary">Reset Password</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-4 col-sm-4 pull-right">
                <div class="form-info">
                    <h2><em>Reset</em> Password</h2>
                    <p>Be sure your Password and Confirmation Password are identical</p>

                </div>
            </div>
        </div>
    </div>
</div>
</div>

@stop


@stop
