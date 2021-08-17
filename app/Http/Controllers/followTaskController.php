<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\task;
use DB;
use App\User;
use App\note;
use Carbon\Carbon;
use App\project;
use Mail;


class followTaskController extends Controller
{
    public function index() {
        

        $tasks = task::where('isApproved' ,'=', '0')->orWhere('statusApproved' ,'=' , '0')->orderBy('created_at','desc')->paginate(30);
        foreach($tasks as $task){
          
            if(Carbon::now()->toDateTimeString()  >=  $task->dueDate && $task->status == null ){
               $one_task =  task::find($task->id);
               $one_task->status = 'outDate';
               $one_task->update();
            }
        }
        $users =  User::all();
        $status = null;
    	return  view('Dashboard.follow',compact('tasks','users','status'));
    }

    public function taskConfirmation(Request $request){

    	DB::table('tasks')
                 ->where('id', $request->id)  // find your user by their email
                 ->limit(1)  // optional - to ensure only one record is updated.
                 ->update(array(
                 'isApproved' =>1,
                 'approveTaskDate' => Carbon::now()->toDateTimeString(),
                 ));  // update the record in the DB. 
    

       // send confirmation msg
        // send msg
            // select user 
                $task = task::find( $request->id);
                $user_id = $task->tasks->first()->user_id;
                $user = user::find($user_id);
                $email = $user->email;
                $project = project::find($task->project_id);
                $msg =  $task->description . ' has been confirmed';
                $emailContent =array(
                'Name' =>$user->name,
                'msg' =>$msg ,
                'projectName' =>$project->name ,
                 );

            Mail::send(['html' => 'msg'], $emailContent, function ($message) use ($emailContent , $email) {
                    
                 $message->to($email)->subject('Task Confirmation')->from('pm@mishkatnour.org', 'Mishkat Nour');
                        });


        return redirect()->back()->with('success', 'Task Approved Successfully');

    }



    public function taskNotConfirmation(Request $request){

    	DB::table('tasks')
                 ->where('id', $request->id)  // find your user by their email
                 ->limit(1)  // optional - to ensure only one record is updated.
                 ->update(array(
                 'statusApproved' => 0, // for make task not approved
                 'status' => null,
                 ));  // update the record in the DB. 
    

       // send confirmation msg
        // send msg
            // select user 
                $task = task::find( $request->id);
                $user_id = $task->tasks->first()->user_id;
                $user = user::find($user_id);
                $email = $user->email;
                $project = project::find($task->project_id);
                $msg =  $task->description . ' has been confirmed';
                $emailContent =array(
                'Name' =>$user->name,
                'msg' =>$msg ,
                'projectName' =>$project->name ,
                 );

            Mail::send(['html' => 'msg'], $emailContent, function ($message) use ($emailContent , $email) {
                    
                 $message->to($email)->subject('your Task Not Approved')->from('pm@mishkatnour.org', 'Mishkat Nour');
                            

                        });


        return redirect()->back()->with('success', 'Task Not Approved Successfully');

    }

    public function taskDenay(Request $request){
        $task = task::find($request->id);
        $task->delete();
       
        return redirect()->back()->with('Deleted', 'Branch is Added');

    }
    public function statusDenay(Request $request){

        $task = task::find($request->id);
        $task->delete();
        return redirect()->back()->with('Deleted', 'Branch is Added');
    }
    
    public function statusConfirmation(Request $request){
        // case status = transfer
        $task = task::find($request->id) ;
        $user_id = $task->alternative ;
        $from = $task->tasks()->first()->user_id;
        if($task->status == 'transfer') {
            // update responsibility 
            DB::table('task_respons')
                 ->where('task_id', $request->id)  
                 ->limit(1)  
                 ->update(array('user_id' => $user_id ));  

            // update confirmation
                 DB::table('tasks')
                 ->where('id', $request->id)  
                 ->limit(1)  
                 ->update(array(
                    'isApproved'     => 1,
                    'statusApproved' => 0,
                    'from' => $from ,
                    'statusDateApp' => Carbon::now()->toDateTimeString(),
                ));  
        // transferd msg
                  // send confirmation msg
        // send msg to user that transferd to 
            // select user 

                $fromUser = user::find($from);
                $task = task::find( $request->id);
                // to 
                $user = user::find($user_id);
                $email = $user->email;
                $msg =  'You have new transfered task'  ;
                 $project = project::find($task->project_id);
                $emailContent =array(
                'Name' =>$user->name,
                'msg' =>$msg ,
                'projectName' =>$project->name ,
                 );

            Mail::send(['html' => 'msg'], $emailContent, function ($message) use ($emailContent , $email) {
                    
                 $message->to($email)->subject('New Task')->from('pm@dashboard.mishkatnour.org', 'Mishkat Nour');
                            

                        });
        

        }else {


    	DB::table('tasks')
                 ->where('id', $request->id)  
                 ->limit(1)  
                 ->update(array(
                    'statusApproved' =>1,
                    'statusDateApp' => Carbon::now()->toDateTimeString(),

                ));  
             // send confirmation msg
        // send msg
            // select user 
                $task = task::find( $request->id);
                $user_id = $task->tasks->first()->user_id;
                $user = user::find($user_id);
                $email = $user->email;
                $project = project::find($task->project_id);
                $msg =  $task->description . ' status has been confirmed';
                $emailContent =array(
                'Name' =>$user->name,
                'msg' =>$msg ,
                'projectName' =>$project->name ,
                 );

            Mail::send(['html' => 'msg'], $emailContent, function ($message) use ($emailContent , $email) {
                    
                 $message->to($email)->subject('Status Confirmation')->from('pm@dashboard.mishkatnour.org', 'Mishkat Nour');
                            

                        });
        }
    return redirect()->back()->with('success', 'Task Approved Successfully');

    }


    public function followsearch(Request $request){
        // dd($request->status);
        if($request->status == "all"){
            $tasks = task::where('isApproved' ,'=', '0')->orWhere('statusApproved' ,'=' , '0')->orderBy('created_at','desc')->get();
        }elseif($request->status == 'need_approved'  ){
            $tasks = task::where('isApproved' ,'=', '1')->where('status' ,'!=',null)->Where('statusApproved' ,'=' , '0')->orderBy('created_at','desc')->get();
        }elseif($request->status == 'notes'  ){
            $tasks =  task::whereHas('notes')->orderBy('created_at','desc')->get();
        }elseif($request->status == 'tasks_user'  ){
            $tasks = task::where('isApproved' ,'=', '0')->where('status' ,'=',null)->Where('statusApproved' ,'=' , '0')->orderBy('created_at','desc')->get();
        }elseif($request->status == 'outDate'  ){
            $tasks = task::where('status' , 'outDate')->orderBy('created_at','desc')->get();
        }
        else{
            $tasks = task::where('isApproved' ,'=', '0')->where('status' ,$request->status)->orderBy('created_at','desc')->get();
        }
      
       
        $users =  User::all();
        $status =  $request->status;
        return  view('Dashboard.follow',compact('tasks','users','status'));

    }
    
}
