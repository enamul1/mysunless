@extends('common.layouts.email-layout')

@section('content')
<!-- BEGIN: Content -->
<table class="container content" align="center">
<tr>
	<td>
		<table class="row note">
		<tr>
			<td class="wrapper last">
				<h4>New Question from the contact form</h4>
				<p>
					 
				</p>
			</td>
		</tr>
		</table>
		<span class="devider">
		</span>
		<table class="row">
		<tr>
			<td class="wrapper last">
				<!-- BEGIN: Disscount Content -->
				<table class="twelve columns">
				<tr>
					<td>
						<h4>Name: {{$question['name']}}</h4>
						<h4>Email: {{$question['email']}}</h4>
						<p>
							Question : {{$question['question']}}
						</p>
						<img src="../../assets/admin/pages/media/email/article.png" class="ie10-responsive" alt=""/>
					</td>
					<td class="expander">
					</td>
				</tr>
				</table>
				<!-- END: Disscount Content -->
			</td>
		</tr>
		</table>
	</td>
</tr>
</table>
<!-- END CONTENT -->
@stop

