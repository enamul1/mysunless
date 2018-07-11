@extends('common.layouts.email-layout')

@section('content')
<!-- BEGIN: Content -->
<table class="container content" align="center">
<tr>
	<td>
		<table class="row note">
		<tr>
			<td class="wrapper last">
				<h4>Welcome, {{ucfirst($admin['firstName']).' '.ucfirst($admin['lastName'])}}</h4>
				<h4>Thank you for joining the Mysunless.com!</h4>
				<h4>Your username : {{$admin['email']}} </h4>
				<h4>Your password : {{$admin['password']}} </h4>
			</td>
		</tr>
		</table>
		<span class="devider">
		</span>
		<table class="row">
		<tr>
			<td class="wrapper last">
				
			</td>
		</tr>
		</table>
	</td>
</tr>
</table>
<!-- END CONTENT -->
@stop

