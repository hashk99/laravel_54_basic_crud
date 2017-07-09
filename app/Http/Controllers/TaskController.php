<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\Http\Requests\StoreTaskRequest;
use Auth;

class TaskController extends Controller
{    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }  

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$all_tasks = Task::orderBy('id','desc')->get();
        return view('home',compact('all_tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tasks.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTaskRequest $request)
    {

        try{

            $name = $request->input('name');
            $description = $request->input('description');

            $specimen = new Task();
            $specimen->name = $name;
            $specimen->description = $description;
            $specimen->added_user = null;
            $specimen->save();
            
            //$request->session()->flash('success', 'Task was successful!');
            return redirect()
                    ->route('view-all-tasks')
                    ->with('success', 'New Task added successful!');

        }catch (\Exception $e) {
            Log::error( $e->getMessage() );
            $request->session()->flash('error', $e->getMessage() );
            return back()->withInput();
        }
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    	$task = Task::find($id);
    	if(is_null( $task )){
        	return redirect()->route('view-all-tasks');
    	}
        if($task->added_user  != Auth::user()->id){
            return redirect()
                ->route('view-all-tasks')
                ->with('error', 'You do not have permissions to access this task');
        }

        return view('tasks.edit',compact('task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreTaskRequest $request, $id)
    {

        try{

            $element = Task::find($id);
            if($element == null){
                return redirect()
                    ->route('view-all-tasks')
                    ->with('error', 'Task not found !. please try again or refresh the page'); 
            } 
            if($element->added_user  != Auth::user()->id){
                return redirect()
                    ->route('view-all-tasks')
                    ->with('error', 'You do not have permissions to access this task');
            }

            $name = $request->input('name');
            $description = $request->input('description');

            $element->name = $name;
            $element->description = $description;
            $element->added_user = null;
            $element->save();
             
            return redirect()
                    ->route('view-all-tasks')
                    ->with('success', 'Task updated successfully!');

        }catch (\Exception $e) {
            Log::error( $e->getMessage() );
            $request->session()->flash('error', $e->getMessage() );
            return back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        try{ 

            $element = Task::find($id);
            if($element == null || $element->added_user != Auth::user()->id){
                return redirect()
                    ->route('view-all-tasks')
                    ->with('error', 'Task not found or you do not have access to delete this task !. please try again or refresh the page'); 
            }

            $element->delete();

            $request->session()->flash('success', 'Element Deleted !' );
              return redirect()
                    ->route('view-all-tasks')
                    ->with('success', 'Task deleted !');
        }catch (\Exception $e) {

            Log::error( $e->getMessage() ); 
          
            return redirect()
                ->route('view-all-tasks')
                ->with('error', 'Something went wrong!. please try again or refresh the page'); 
        }
         
    }
}
