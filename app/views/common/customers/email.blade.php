@extends('common.layouts.email-layout')

@section('content')
<!-- BEGIN: Content -->
<table class="container content" align="center">
<tr>
	<td>
		<table class="row note">
		<tr>
			<td class="wrapper last">
				<h4>Welcome, {{ucfirst($customer['firstName']).' '.ucfirst($customer['lastName'])}}</h4>
				<h4>Thank you for joining the Mysunless.com!</h4>
				<h4>Your username : {{$customer['email']}} </h4>
				<h4>Your password : {{$customer['password']}} </h4>
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

