<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\task;
use DB;
use App\User;
use Carbon\Carbon;
use App\project;
use Mail;
class outDateTasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = task::where('status' , 'outDate')->orwhere('status' , 'block')->paginate(20);
        $users =  User::all();
        $status = null;
        return  view('Dashboard.outDateTasks',compact('tasks','users','status'));
    }





    public function outDatesearch(Request $request){
        if($request->status == "all"){
            $tasks = task::where('status' , 'outDate')->get();
        }elseif($request->status == 'block'  ){
            $tasks = task::where('status' , 'block')->get();
        }elseif($request->status == 'tasks_user'  ){
            $tasks = task::where('isApproved' ,'=', '0')->where('status' ,'=',null)->Where('statusApproved' ,'=' , '0')->get();
        }elseif($request->status == 'outDate'  ){
            $tasks = task::where('status' , 'outDate')->get();
        }
        else{
            $tasks = task::where('isApproved' ,'=', '0')->where('status' ,$request->status)->get();
        }
      
       
        $users =  User::all();
        $status =  $request->status;
        return  view('Dashboard.outDateTasks',compact('tasks','users','status'));
    }



    public function renwalDueTask(Request $request){

       
        $request->validate([
            'date' => 'required',
        ]);

        $task =  task::find($request->id);
        $task->dueDate = $request->date;
        $task->status = null;
        $task->tasklate = 1;
        $task->update();
       return redirect()->back();
    }


    public function blockTask(Request $request){
        $task =  task::find($request->id);
        $task->status = 'block';
        $task->update();
        return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
