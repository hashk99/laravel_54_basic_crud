@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12   ">
            <div class="panel panel-default">
                <div class="panel-heading">Tasks</div>

                <div class="panel-body"> 
                    <h2>Tasks list</h2> 
                    <a href="{{route('create-new-task')}}" class="btn btn-info"> Create a new task </a>
                    <hr>            
                    @if(!is_null($all_tasks) && count($all_tasks) > 0)
                    <table class="table table-hover">
                        <thead>
                          <tr>
                            <th>Task Name</th>
                            <th style="width: 400px;">Description</th>
                            <th>Added by</th>
                            <th>Created At</th>
                            <th>Last Updated At</th>
                            <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach( $all_tasks as $task)
                              <tr>
                                <td>{{$task->name}}</td>
                                <td>{{$task->description}}</td>
                                <td>{{($task->addedUser != null) ? $task->AddedUser->name.' (You)' : 'User not found'}}</td>
                                <td>{{$task->created_at}}</td>
                                <td>{{( $task->created_at != $task->updated_at )? $task->updated_at : 'no update'}}</td>
                                <td>
                                    @if($task->added_user == Auth::user()->id )
                                    <a class="btn btn-sm btn-warning" href="{{route('edit-task',$task->id)}}"> Edit</a>
                                    <a class="btn btn-sm btn-danger" href="{{route('destroy-task',$task->id)}}"> Delete</a>
                                    @else
                                        <small class="warning"> no permissions </small>
                                    @endif
                                </td>
                              </tr>
                            @endforeach
                         
                        </tbody>
                    </table>  
                    @else
                        <h5 class="text-center">Nothing to show. Add some tasks first</h5>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
