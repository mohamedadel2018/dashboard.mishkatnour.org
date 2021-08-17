<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\objective;
use App\project;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\task;
use App\task_respon;
use App\task_paper;
use App\branch;
use Auth;
use DB;
use Mail;
use Carbon\Carbon;
class projectController extends Controller
{
    // OBJECTIVE
    public function objectiveIndex() {
        $branches = branch::all();
        return view('Dashboard.objectives')->with('branches' , $branches);
    }
    public function addObjective (Request $request)
    {

        	// validate Input
            $Validator=  Validator::make($request->all(),[

                'objDescription' =>'required',
                'projectName' =>'required',
                'proDescription' =>'required',
                'projectLocation' =>'required',
                'branch' =>'required',

            ])->validate();

        $branchs = $request->input('branch');

            foreach($branchs as $branch){

                    try
                        {

                            $objective = new objective ;
                            $objective->description = $request->objDescription;
                            $objective->save();

                            $project = new project ;
                            $project->name = $projectdata->name;
                            $project->description = $request->proDescription;
                            $project->location = $request->projectLocation;
                            $project->branch =  $branch;
                            $objective->projects()->save($project);
                        }
                    catch (\Exception $e)
                        {
                                return redirect()->back()->with('fail', 'all fields rquierd');
                        }
            }



         return redirect()->back()->with('success', 'Branch is Added');



    }

    public function showObjectives()
    {
    	$objectives = objective::all();
        $users = user::all();
        $projects = project::all();
    	return view('Dashboard.showObectives')->with(['objectives' => $objectives , 'users' => $users, 'projects' =>  $projects]);
    }
    public function deleteObjective(Request $request) {

        $objective = objective::find($request->id) ;
        $objective->delete();
        return redirect()->back()->with('deleted', 'Branch is Added');

    }
    public function editObjective (Request $request) {

         DB::table('objectives')
                 ->where('id', $request->id)
                 ->limit(1)
                 ->update(
                    array('description' => $request->description )
                  );

        return redirect()->back()->with('Updated', 'Branch is Added');

    }
    /////////////////////////////////////////////////////////////
    //  PROJECT
    public function projectIndex(){
    	$objectives = objective::all();
        $Branches = branch::all();
        $projects = project::all();
    	return view('Dashboard.addProject')->with(['objectives' => $objectives ,'Branches' => $Branches , 'projects' => $projects  ]);
    }
    public function addProject(Request $request){
        // dd($request->projectSelect);
        // validate Input

        $branchs = $request->input('branch');

        if($request->projectSelect != null){
         $Validator =  Validator::make($request->all(),[

            'id' =>'required',
            'projectSelect' =>'required',
            'projectLocation' =>'required',
            'branch' =>'required',

        ])->validate();
        $projectdata =  project::find($request->projectSelect);
         // try
         // {
             foreach($branchs as $branch){
                $project = new project;
                
                $project->name = $projectdata->name;
                $project->description = $projectdata->description;
                $project->location = $request->projectLocation;
                $project->objective_id = $request->id;
                $project->branch = $branch;
                $project->save();
            }
         // }
         // catch (\Exception $e)
         // {
         //        return redirect()->back()->with('fail', 'all fields rquierd');
         // }
         }
         else{
            $Validator=  Validator::make($request->all(),[

                'id' =>'required',
                'projectName' =>'required',
                'proDescription' =>'required',
                'projectLocation' =>'required',
                'branch' =>'required',

            ])->validate();

             // try
             // {
                foreach($branchs as $branch){
                 $project = new project ;
                 $project->name = $request->projectName ;
                 $project->description = $request->proDescription;
                 $project->location = $request->projectLocation;
                 $project->objective_id = $request->id;
                 $project->branch = $branch;
                 $project->save();
                }
             // }
             // catch (\Exception $e)
             // {
             //        return redirect()->back()->with('fail', 'all fields rquierd');
             // }
         }
         return redirect()->back()->with('success', 'Branch is Added');

    }
    // show all projects
    public function showProjects(){

    	$projects = project::groupBy('branch')->orderBy('id','asc')->get();
        $users = user::all();
    	return view('Dashboard.showProjects')->with(['projects' => $projects , 'users' => $users]);
    }

    // show specific project
    public function showProject($id,Request $request ) {

        $projects = project::where('branch',$id)->Where('objective_id',$request->objective_id)->with('tasks')->orderBy('name','asc')->get();
        $objectives = objective::all();
        $users = user::all();

       return view('Dashboard.project')->with(['projects' => $projects , 'users' => $users , 'objectives' => $objectives ]);
    }

     public function showProjectforDoneTask($id) {

        $projects = project::where('id',$id)->orderBy('name','asc')->get();
        $users = user::all();
       // dd($projects);
      //  foreach($projects as $project){
      //  $tasks = $project->tasks()->get();
     //  }
     //  dd($tasks);
       return view('Dashboard.project')->with(['projects' => $projects , 'users' => $users]);

    }

    public function showallnameProject($id)
     {
        $projects = project::where('branch',$id)->with('tasks')->orderBy('name','asc')->get();
        $objectives = objective::all();
        $users = user::all();
        return view('Dashboard.project')->with(['projects' => $projects , 'users' => $users , 'objectives' => $objectives ]);
     }
    public function deleteProject(Request $request) {

        $project = project::find($request->id) ;
        $project->delete();
        return redirect()->back()->with('deleted' , 'deleted') ;
    }
    public function editProject (Request $request) {
        // dd($request->all());

        if($request->objectiveSelect != null){
          DB::table('projects')
                 ->where('id', $request->project)
                 ->limit(1)
                 ->update(
                    array(
                        'objective_id' => $request->objectiveSelect
                         ));
        return redirect()->back()->with('success', 'Update Successfully');
         }else{
            DB::table('projects')
            ->where('id', $request->project)
            ->limit(1)
            ->update(
               array(

                   'name' => $request->name,
                   'description' => $request->description,
                   'location' => $request->location

                    )
             );
         return redirect()->back()->with('success', 'Update Successfully');
         }


    }




    public function projectTasks() {
        $tasks = task::all();
    	return view('Dashboard.showProject')->with('tasks' , $tasks);
    }
     public function showTasks() {
        $tasks = task::where('statusApproved' , '=' , 1)->get();
        $user  = user::where('admin' , '=' , 0)->get();
    	return view('Dashboard.tasks')->with(['tasks' => $tasks , 'users' =>$user]);
    }
    public function printTasks() {
        $tasks = task::where('statusApproved' , '=' , 1)->get();
        $user  = user::where('admin' , '=' , 0)->get();
        return view('Dashboard.tasksPrint')->with(['tasks' => $tasks , 'users' =>$user]);
    }

    public function addTask(Request $request ,$id){

        // validate Input
         $Validator=  Validator::make($request->all(),[

            'ResponsibiltyInput' =>'required',
            'taskInput' =>'required',
            'dueDate' =>'required',

        ])->validate();

         try
         {
            // echo $id;
            // select project
            $project = project::find($id);

            $task = new task ;
            $task->description = $request->taskInput;
            $task->isApproved = 1;
            $task->dueDate = $request->dueDate;
            $task->urgency = $request->urgency;
            $task->quantity = $request->quantity;
            $project->tasks()->save($task);

            $res = new task_respon ;
            $res->user_id = $request->ResponsibiltyInput;
            $task->tasks()->save($res);

         }
         catch (\Exception $e)
         {
                return redirect()->back()->with('fail', 'all fields rquierd');
         }

         // send msg
            // select user
            //  $user = user::find($request->ResponsibiltyInput);
            //  $email = $user->email;
            //  $msg = 'You have new task ' . $task->description;
            //   $emailContent =array(
            //     'Name' =>$user->name,
            //     'msg' =>$msg ,
            //     'projectName' =>$project->name ,
            //      );

            // Mail::send(['html' => 'msg'], $emailContent, function ($message) use ($emailContent , $email) {

            //      $message->to($email)->subject('New Task')->from('pm@dashboard.mishkatnour.org', 'Mishkat Nour');
            //             });

         return redirect()->back()->with('success', 'Task is Added');


    }
    public function deleteTask(Request $request) {

        $task = task::find($request->id)->delete();
        return redirect()->back()->with('deleted', 'Task is Deleted Successfully');

    }
    public function editTask(Request $request) {



                  $task = task::find($request->id);

                    if($request->date != null && $task->dueDate != $request->date ){
                        DB::table('tasks')
                        ->where('id', $request->id)
                        ->limit(1)
                        ->update(
                           array(
                               'description' => $request->description,
                               'dueDate' => $request->date,
                               'quantity' => $request->quantity
                                )
                         );
                    }else{
                        DB::table('tasks')
                        ->where('id', $request->id)
                        ->limit(1)
                        ->update(
                           array(
                               'description' => $request->description,
                               'quantity' => $request->quantity
                                )
                         );
                    }
        // $task =  task::find($request->id);
        // $task_respons = task_respon::where('task_id',$request->id)->get();
        // dd( $task_respons->);
        // foreach($task_respons as $task_respon){
            // if($task_respon->user_id != $request->user){
                // dd($task_respon->user_id);
                DB::table('task_respons')
                         ->where('task_id', $request->id)
                         ->limit(1)
                         ->update(
                            array(

                                'user_id' => $request->user,

                                 )
                          );
                        // }
        // }


        return redirect()->back()->with('updated' , 'updated');

    }
    // available project
    public function myproject () {




        if(Auth::user()->id   )
        {
         // chech if not admin or his profile
             $user = User::find(Auth::user()->id);
             $noaction = 0;
              $done = 0 ;
             $delay = 0 ;
             $canceled = 0 ;
             $late = 0 ;
             $outDate = 0;
             $block = 0 ;
             $res_rows = $user->tasks()->get();
             $tasks = array();
             foreach ($res_rows as $res_row) {
                 $status = $res_row->task()->first()->status;
                 // $task = $res_row->task()->first()->description;
                 // done
                 switch ($status) {
                     case null:
                         $noaction ++ ;
                         break;
                     case 'done':
                         $done ++ ;
                         break;
                     case 'late':
                         $late ++ ;
                         break;
                     case 'delayed':
                         $delay ++ ;
                         break;
                     case 'canceled':
                         $canceled ++ ;
                         break;
                    case 'outDate':
                        $outDate ++ ;
                        break;
                    case 'block':
                        $block ++ ;
                        break;
 
                 }
 
                 // array_push($tasks ,$task);
 
             }
         $data = array(
             'noaction' => $noaction,
             'done' => $done ,
             'delay' => $delay,
             'canceled' => $canceled,
             'late' => $late,
             'outDate' => $outDate,
             'block' => $block,
         );
        }


        $users = user::all();
        $id = Auth::User()->id;
        $user = User::find($id);
        $rows = $user->tasks()->get()->sortBy('status');
        $status = null;
        $status_time = null;
        // echo $rows;
        // // $task_id = $rows->task_id;
        // $tasks = task::find($task_id)->first();
        $branch_id = Auth::user()->branch;
        $projects = project::groupBy('branch')->orderBy('id','asc')->get();
      
            $status = null;
        
     
        // dd( $projects);
       return view('Dashboard.myProject')->with(['projects' => $projects , 'rows' => $rows , 'users' => $users, 'data' => $data , 'status' => $status,'status_time' => $status_time]);

    }

    public function selectsearch(Request $request){
      
        if(Auth::user()->id   )
        {
         // chech if not admin or his profile
             $user = User::find(Auth::user()->id);
             $noaction = 0;
              $done = 0 ;
             $delay = 0 ;
             $canceled = 0 ;
             $late = 0 ;
             $outDate = 0;
             $block = 0;
             $res_rows = $user->tasks()->get();
             $tasks = array();
             foreach ($res_rows as $res_row) {
                 $status = $res_row->task()->first()->status;
                 // $task = $res_row->task()->first()->description;
                 // done
                 switch ($status) {
                     case null:
                         $noaction ++;
                         break;
                     case 'done':
                         $done ++ ;
                         break;
                     case 'late':
                         $late ++ ;
                         break;
                     case 'delayed':
                         $delay ++ ;
                         break;
                     case 'canceled':
                         $canceled ++ ;
                         break;
                    case 'outDate':
                         $outDate ++ ;
                         break;
                     case 'block':
                         $block ++ ;
                         break;
  
                 }
 
                 // array_push($tasks ,$task);
 
             }
             $data = array(
                'noaction' => $noaction,
                'done' => $done ,
                'delay' => $delay,
                'canceled' => $canceled,
                'late' => $late,
                'outDate' => $outDate,
                'block' => $block,
            );
        }

        $users = user::all();
        $id = Auth::User()->id;
        $user = User::find($id);
        $status =  $request->status;
        $rows = $user->tasks()->get()->sortBy('status');
        $status_time = null;
        // echo $rows;
        // // $task_id = $rows->task_id;
        // $tasks = task::find($task_id)->first();
        $branch_id = Auth::user()->branch;
        $projects = project::groupBy('branch')->orderBy('id','asc')->get();
      
        // dd( $projects);
        return view('Dashboard.myProject')->with(['projects' => $projects , 'rows' => $rows , 'users' => $users , 'data' => $data , 'status' => $status,'status_time'=> $status_time]); 

    }


    public function timesearch(Request $request){
            // dd($request->time);
      if(Auth::user()->id   )
        {
         // chech if not admin or his profile
             $user = User::find(Auth::user()->id);
             $noaction = 0;
              $done = 0 ;
             $delay = 0 ;
             $canceled = 0 ;
             $late = 0 ;
             $outDate = 0;
             $block = 0;
             $res_rows = $user->tasks()->get();
             $tasks = array();
             foreach ($res_rows as $res_row) {
                 $status = $res_row->task()->first()->status;
                 // $task = $res_row->task()->first()->description;
                 // done
                 switch ($status) {
                     case null:
                         $noaction ++;
                         break;
                     case 'done':
                         $done ++ ;
                         break;
                     case 'late':
                         $late ++ ;
                         break;
                     case 'delayed':
                         $delay ++ ;
                         break;
                     case 'canceled':
                         $canceled ++ ;
                         break;
                    case 'outDate':
                         $outDate ++ ;
                         break;
                     case 'block':
                         $block ++ ;
                         break;
  
                 }
 
                 // array_push($tasks ,$task);
 
             }
             $data = array(
                'noaction' => $noaction,
                'done' => $done ,
                'delay' => $delay,
                'canceled' => $canceled,
                'late' => $late,
                'outDate' => $outDate,
                'block' => $block,
            );
        }


        $users = user::all();
        $id = Auth::User()->id;
        $user = User::find(Auth::id());
        $status = null;
        $status_time =  $request->time;
        $rows = $user->tasks()->get()->sortBy('status');
        $branch_id = Auth::user()->branch;
        $projects = project::groupBy('branch')->orderBy('id','asc')->get();
        return view('Dashboard.myProject')->with(['projects' => $projects , 'rows' => $rows , 'users' => $users , 'data' => $data ,'status' => $status ,'status_time' => $status_time]); 

    }
}
