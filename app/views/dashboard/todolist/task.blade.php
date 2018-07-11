@extends('dashboard.layouts.default')
<link href="/assets/dashboard/pages/css/todo.css" rel="stylesheet" type="text/css"/>

<script src="/assets/dashboard/pages/scripts/todo.js" type="text/javascript"></script>

@section('content')
	<!-- BEGIN PAGE HEADER-->
		<div class="row">
			<div class="col-md-12">
				<!-- BEGIN PAGE TITLE & BREADCRUMB-->
				<h3 class="page-title">
				My Todo List <small></small>
				</h3>
				<ul class="page-breadcrumb breadcrumb custom-success">
					<li>
						<i class="fa fa-home"></i>
						<a href="{{url(URL::to('/dashboard'))}}">Home</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="{{url(URL::to('/dashboard/todo'))}}">Todo List</a>
					</li>
				</ul>
				<!-- END PAGE TITLE & BREADCRUMB-->
			</div>
		</div>
	<!-- END PAGE HEADER-->
	<!-- BEGIN PAGE CONTENT-->
	<div class="row">
		<div class="col-md-12">
			<!-- BEGIN TODO SIDEBAR -->
			<div class="todo-ui">
				<!-- BEGIN TODO CONTENT -->
				<div class="todo-content">
					<div class="portlet light">
						<!-- PROJECT HEAD -->
						<!-- <div class="portlet-title">
							<div class="actions">
								<div class="btn-group">
									<a class="btn green-haze btn-circle btn-sm" href="#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
									MANAGE <i class="fa fa-angle-down"></i>
									</a>
									<ul class="dropdown-menu pull-right">
										<li>
											<a href="#">
											<i class="i"></i> New Task </a>
										</li>
										<li class="divider">
										</li>
										<li>
											<a href="#">
											Pending <span class="badge badge-danger">
											4 </span>
											</a>
										</li>
										<li>
											<a href="#">
											Completed <span class="badge badge-success">
											12 </span>
											</a>
										</li>
										<li>
											<a href="#">
											Overdue <span class="badge badge-warning">
											9 </span>
											</a>
										</li>
										<li class="divider">
										</li>
										<li>
											<a href="#">
											<i class="i"></i> Delete Project </a>
										</li>
									</ul>
								</div>
							</div>
						</div> -->
						<!-- end PROJECT HEAD -->
						<div class="portlet-body">
							<div class="row">
								<div class="col-md-5 col-sm-4">
									<div class="scroller" style="max-height: 600px;" data-always-visible="0" data-rail-visible="0" data-handle-color="#dae3e7">
										<div class="todo-tasklist">
											@if(isset($tasks))
												@foreach($tasks as $task)
													<div class="todo-tasklist-item todo-tasklist-item-border-green" data-task-id="{{$task->id}}">
														
														<div class="todo-tasklist-item-title">
															 {{$task->title}}
														</div>
														<div class="todo-tasklist-item-text">
															  {{$task->description}}
														</div>
														<div class="todo-tasklist-controls pull-left">
															<span class="todo-tasklist-date"><i class="fa fa-calendar"></i> {{$task->due_date}} </span>
															<!-- @if(is_array($task->tags))
																@foreach($task->tags as $tag)
																	<span class="todo-tasklist-badge badge badge-roundless">{{$tag}}</span>
																@endforeach
															@endif -->
														</div>
													</div>
												@endforeach
											@else 
												<div class="todo-tasklist-item todo-tasklist-item-border-red">
													<div class="todo-tasklist-item-title">
														 You dont' have any tasks!
													</div>
													<div class="todo-tasklist-item-text">
														 You can start creating your task using the form on the right.
													</div>
												</div>
											@endif
										</div>
									</div>
								</div>
								<div class="todo-tasklist-devider">
								</div>
								<div class="col-md-7 col-sm-8">
									<div class="scroller" style="max-height: 600px;" data-always-visible="0" data-rail-visible="0" data-handle-color="#dae3e7">
										<!-- <form action="#" class="form-horizontal todo-create"> -->
										{{ Form::open(array('url' => '/dashboard/todo/update', 'class' => 'form-horizontal todo-create', 'role'=>'form')) }}
											<!-- TASK HEAD -->
											<div class="form">
												<!-- END TASK HEAD -->
												<input type="hidden" name="id" value="{{$todo[0]->id}}">
												<!-- TASK TITLE -->
												<div class="form-group">
													<div class="col-md-12">
														<input id="title" type="text" name='title' class="form-control todo-taskbody-tasktitle" value="{{$todo[0]->title}}">
														<div class='help-block'> {{ $errors->first('title') }} </div>
													</div>
												</div>
												<!-- TASK DESC -->
												<div class="form-group">
													<div class="col-md-12">
														<textarea id="description" name='description' class="form-control todo-taskbody-taskdesc" rows="8">{{$todo[0]->description}}</textarea>
														<div class='help-block'> {{ $errors->first('description') }} </div>
													</div>
												</div>
												<!-- END TASK DESC -->
												<!-- TASK DUE DATE -->
												<div class="form-group">
													<div class="col-md-12">
														<div class="input-icon">
															<i class="fa fa-calendar"></i>
															<input name='due_date' type="text" class="form-control todo-taskbody-due" value="{{$todo[0]->due_date}}">
															<div class='help-block'> {{ $errors->first('due_date') }} </div>
														</div>
													</div>
												</div>
												<!-- TASK TAGS -->
												<!-- @if($tags)
												<div class="form-group">
													<div class="col-md-12">
														<select id="tags" name = "tags[]" class="form-control todo-taskbody-tags" multiple="">
														<option value="1">Minor</option>
														@foreach($tags as $tag)
															<option value="{{$tag->id}}">{{$tag->todo_tag}}</option>
														@endforeach
													        
													    </select>
												    </div>
												</div>
											    @endif -->
												<!-- TASK TAGS -->
												<div class="form-actions right todo-form-actions">
													<button id="todo-submit" class="btn btn-circle btn-sm green-haze">Save Changes</button>
													<button type="button" id="task-remove"class="btn btn-circle btn-sm btn-default" data-remove-task-id="{{$todo[0]->id}}">Remove</button>
													<button type="button" id="task-completed" class="btn btn-circle btn-sm btn-default" data-complete-task-id="{{$todo[0]->id}}">Mark Complete</button>
												</div>
											</div>
										<!-- </form> -->
										{{ Form::close() }}
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- END TODO CONTENT -->
			</div>
		</div>
		<!-- END PAGE CONTENT-->
	</div>

@stop