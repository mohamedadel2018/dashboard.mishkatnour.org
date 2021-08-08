<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\objective;
use App\project;
use Illuminate\Support\Facades\Validator;
use App\user;
use App\task;
use App\task_respon;
use App\branch;
use Auth;
use App\task_paper;
use DB;
use Response;
use Carbon\Carbon;
use App\note;
use Image;


class userTaskController extends Controller
{
    public function addTask(Request $request , $id) {

    	// validate Input
      
         try
         {
         
            // dd( $request->input('quantity'));
            $project = project::find($id);
            $task = new task; 
         
            $task->description = $request->input('taskInput');
            $task->dueDate = $request->input('date');
            $task->urgency = $request->input('urgency');
            $task->quantity = $request->input('quantity');
            
            $project->tasks()->save($task);
            $res = new task_respon;
            $res->user_id = Auth::user()->id;
            $task->tasks()->save($res);
            
            // select project
            // echo ($id);

         }
         catch (\Exception $e)
         {
                return redirect()->back()->with('fail', 'all fields rquierd');
         }

         return redirect()->back()->with('success', 'Branch is Added');



    }
    public function status (Request $request) {

        // validate Input

            // $Validator=  Validator::make($request->all(),[

            //  'status' =>'required',

            // ])->validate();


         if ($request->status == 'transfer') {
            $request->validate([
                'alternative' =>'required',
            ]);
         }

         $task = task::find($request->id);
        //  dd($task->quantity);

        //  if($request->status == 'done' ){
        //     $file = $request->file('files');
        //     if (  $file &&  $task->quantity >= count($file)) {

        //         $request->validate([

        //             'files' =>'required',
        //             // 'files.*' => 'mimes:doc,pdf,docx,zip,png,txt'
        //             ]);
        //     }
        //     else{
        //         return redirect()->back()->with('error', 'Your Files most be More Than Task Quantity');
        //     }
        // }
        //  try
        //  {
       // select project


            $file = $request->file('files');

             if($file) {

            foreach($request->file('files') as $file)
            {
                          // generate a new filename. getClientOriginalExtension() for the file extension
             $filename = $request->id .'-' . time() .'_'. $file->getClientOriginalName();
                          // save to storage/app/photos as the new $filename
                         // $path = $file->storeAs('files', $filename);
                         // $path = $file->store('toPath', ['disk' => 'public']);
            $destination = public_path('/task_paper');
            $file->move($destination , $filename );

            $paper = new task_paper;
            $paper->destination = $filename;
            $task->task_papers()->save($paper);
            }


            }

            // late
            if($request->status == 'late') {

                  DB::table('tasks')
                 ->where('id', $request->id)  // find your user by their email
                 ->limit(1)  // optional - to ensure only one record is updated.
                 ->update(
                    array
                    (
                        'status'    => $request->status,
                         'lateDate' => $request->lateDate,
                        'statusDate' => Carbon::now()->toDateTimeString(),
                    )
                    );  // update the record in the DB.

             // transfer

            }else if ($request->status == 'transfer') {

                 DB::table('tasks')
                 ->where('id', $request->id)  // find your user by their email
                 ->limit(1)  // optional - to ensure only one record is updated.
                 ->update(
                    array
                    (
                        'status'    => $request->status,
                         'alternative' => $request->alternative,
                         'statusDate' => Carbon::now()->toDateTimeString(),
                         'from' =>Auth::user()->id,
                    )
                    );  // update the record in the DB.

            }else {


            //else
            DB::table('tasks')
                 ->where('id', $request->id)  // find your user by their email
                 ->limit(1)  // optional - to ensure only one record is updated.
                 ->update(array(
                 'status' =>$request->status,
                 'statusDate' => Carbon::now()->toDateTimeString(),

                 ));  // update the record in the DB.
            }

            //update quntity
            //else

             if ($request->quantity  && $request->status == "")
               {

                 if( $task->quantity <= $request->quantity ) // for make Done status if quantity <= $request->quantity
                     {
                         DB::table('tasks')
                       ->where('id', $request->id)  // find your user by their email
                       ->limit(1)  // optional - to ensure only one record is updated.
                       ->update(array(
                        'doneQuantity' =>$request->quantity,
                        'status' =>"done",


                       ));  // update the record in the DB.
                      }
                   else {
                       DB::table('tasks')
                       ->where('id', $request->id)  // find your user by their email
                       ->limit(1)  // optional - to ensure only one record is updated.
                       ->update(array(
                        'doneQuantity' =>$request->quantity,

                       ));  // update the record in the DB.
                   }
                }

                // dd ($request->all());
        //  }
        //  catch (\Exception $e)
        //  {
        //         return redirect()->back()->with('fail', 'all fields rquierd');
        //  }

         return redirect()->back()->with('success', 'data is Added');

    }




    // for make user add profile pic
    public function  addUserphoto(Request $request){

        $user = user::find($request->id) ;
        if($request->photo &&  $user->photo != null ){
            $image_path = public_path().'/images/users/'.$user->photo;
            if(file_exists($image_path)) {
            unlink($image_path);
            }
            $photo = $request->photo;
            $photoname =  time() .'_'. $photo->getClientOriginalName();
            \Image::make($request->photo)->resize(200, 200)->save(public_path('/images/users/').$photoname);
            $request->merge(['photo' => $photoname]);
            $user->photo = $photoname;
        }
        else{
            $photo = $request->photo;
            $photoname =  time() .'_'. $photo->getClientOriginalName();
            \Image::make($request->photo)->resize(200, 200)->save(public_path('/images/users/').$photoname);
            $request->merge(['photo' => $photoname]);
            $user->photo = $photoname;
        }
        $user->save();
        return redirect()->back();
    }



    public function add_note (Request $request) {

		$note = new note();
		$note->note = $request->note ;
		$note->task_id = $request->id ;
		$note->user_id = Auth::user()->id ;
		$note->save();
		 return redirect()->back()->with('success', 'Branch is Added');


	}

    // download status resources
    public function getDownload($destination){

        $file = public_path()."\\task_paper\\" . $destination ;
        $headers = array('Content-Type: application/pdf',);
          if (file_exists($file)) {
              return  Response::download($file, $destination,$headers);
          }

      return redirect()->back()->with('failur', 'Branch is Added');
    }
    public function shownotes(){

		 $tasks = task::all();
        return view('Dashboard.showNotes')->with('tasks' , $tasks);
	}
}
