@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Tasks</div>

                <div class="panel-body"> 
                    <h2>Create a new task</h2> 
                    <a href="{{route('view-all-tasks')}}" class="btn btn-info">View all tasks </a>
                    <hr> 
                    @if ($errors->any()) 
					    <div class="alert alert-danger">
					        <ul>
					            @foreach ($errors->all() as $error)
					                <li>{{ $error }}</li>
					            @endforeach
					        </ul>
					    </div>
					@endif 
					<form method="POST" class="form-horizontal js_input_form" id="new_task_form" action="{{route('store-new-task')}}" >
		            {{ csrf_field() }}
			            <div class="form-group">
			                <label for="task_name" class="col-sm-2 control-label">name </label>
			                <div class="col-sm-5">
			                    <input type="text" class="form-control" id="task_name" name="name"  placeholder=" task name " value="{{ old('name') }}">
			                    <span class="help-block">add the task name here</span>
			                </div>
			            </div>
			            <div class="form-group">
			                <label for="description" class="col-sm-2 control-label"> Description </label>
			                <div class="col-sm-5">
			                    <textarea class="form-control" id="description" name="description"  rows="3">{{ old('description') }}</textarea> 
			                </div>
			            </div>
			            <div class="col-sm-offset-2">
			                <button type="submit" class="btn btn-primary">Submit</button>
			                <button type="reset" class="btn btn-default">Reset </button>
			            </div>
		        	</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection