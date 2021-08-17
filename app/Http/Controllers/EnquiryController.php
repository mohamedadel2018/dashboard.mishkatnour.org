<?php

namespace App\Http\Controllers;

use App\enquiry;
use Illuminate\Http\Request;
use Image;
use Auth;
use App\comment;
use App\User;
use Mail;
use Carbon\Carbon;

class EnquiryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('Dashboard.enquiry' );
    }


    public function getenquiry()
    {
        //
      

        $all_enquiry = enquiry::with('comment')->with('user')->where('for_id',null)->latest()->paginate(5);
    

        foreach($all_enquiry as $forone_enquir){
            $time = $forone_enquir->created_at;
            $dt = Carbon::create($time->year,  $time->month, $time->day , $time->hour );
            $dt->toDateTimeString();

            if($forone_enquir->created_at <= $dt->addDay() && count($forone_enquir->comment) == 0 ){
                 $enquiry  = enquiry::find($forone_enquir->id);
                 $enquiry->status = 'No Response';
                 $enquiry->update();
              }
        }

        return  response()->json($all_enquiry);
       
    }


    public function getenquiryforone(){

        $forone_enquiry = enquiry::with('comment')->with('user')->where('for_id',Auth::id())->latest()->paginate(5);
       
        foreach($forone_enquiry as $forone_enquir){

            $time = $forone_enquir->created_at;
            $dt = Carbon::create($time->year,  $time->month, $time->day , $time->hour , $time->minute);
            $dt->toDateTimeString();
            // dd($time->diffInMinutes());
            if($dt->diffInMinutes() >=  1540 && count($forone_enquir->comment) == 0){
                 $enquiry  = enquiry::find($forone_enquir->id);
                 $enquiry->status = 'No Response';
                 $enquiry->update();
              }
        }

        return  response()->json($forone_enquiry);
    }


    public function getenquirySent(){

        $Sent_enquiry = enquiry::with('comment')->with('user')->where('user_id',Auth::id())->latest()->paginate(5);
        
            foreach($Sent_enquiry as $sent_enquir){

                $time = $sent_enquir->created_at;
                $dt = Carbon::create($time->year,  $time->month, $time->day , $time->hour, $time->minute);
                $dt->toDateTimeString();
                // dd( $dt->diffInMinutes());
                if($dt->diffInMinutes() >=  1440 && count($sent_enquir->comment) == 0){
                    $enquiry  = enquiry::find($sent_enquir->id);
                    $enquiry->status = 'No Response';
                    $enquiry->update();
                }
            }

                return  response()->json($Sent_enquiry);
    }



    public function getUser() {
        //check authntication
       if(Auth::user()->admin = '1'){
        $user = 'admin';
       } else{
        $user = 'notadmin';
       }
       $auth_Id = Auth::id();
        return  response()->json([ 'user' =>$user, 'auth_Id' => $auth_Id]);
    }



    public function changestatus(Request $request,$id){
       
        $enquiry_status = enquiry::find($id);
        $enquiry_status->status = $request->changestatus;
        $enquiry_status->update();
        return   response()->json('done');
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
        // dd($request->for);
        $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);


        if($request->for != []){

            $fors = $request->for;
            // dd(count($fors));
            // dd($fors);
            foreach($fors as $for){
                $enquiry = new enquiry();
                $enquiry->title = $request->title;
                $enquiry->body =  $request->body;
                $enquiry->user_id = Auth::id();
                $enquiry->for_id = $for;
                if($request->photo){
                    $name = time().'.'  . explode('/', explode(':', substr($request->photo, 0, strpos($request->photo, ';')))[1])[1];
                    \Image::make($request->photo)->resize(300, 200)->save(public_path('images/enquiry/').$name);
                    $request->merge(['photo' => $name]);
                    $enquiry->photo = $name;
                }
              
                $user = user::find($for);
                $email = $user->email;
                $msg = 'there are new Enquiry for you ' . $enquiry->title;
                 $emailContent =array(
                   'Name' =>$user->name,
                   'msg' =>$msg ,
                  
                    );
                    Mail::send(['html' => 'msg_enquery'], $emailContent, function ($message) use ($emailContent , $email) {

                        $message->to($email)->subject('New enquiry')->from('pm@dashboard.mishkatnour.org', 'Mishkat Nour');
                               });
                $enquiry->save();
            }
        }else{
            
                $enquiry = new enquiry();
                $enquiry->title = $request->title;
                $enquiry->body =  $request->body;
                $enquiry->user_id = Auth::id();

                if($request->photo){
                    $name = time().'.'  . explode('/', explode(':', substr($request->photo, 0, strpos($request->photo, ';')))[1])[1];
                    \Image::make($request->photo)->save(public_path('images/enquiry/').$name);
                    $request->merge(['photo' => $name]);
                    $enquiry->photo = $name;
                }
                // $users = user::all()->except(Auth::id());
                // dd(  $users->email);
                // foreach($users as $user){
               
                // $email = $user->email;
                // $msg = 'there are new Enquiry for you ' . $enquiry->title;
                //  $emailContent =array(
                //    'Name' =>$user->name,
                //    'msg' =>$msg ,
                  
                //     );
                
                    // Mail::send(['html' => 'msg_enquery'], $emailContent, function ($message) use ($emailContent , $email) {

                    //     $message->to($email)->subject('New enquiry')->from('pm@dashboard.mishkatnour.org', 'Mishkat Nour');
                    //            });
                    }
                // $enquiry->save();
            
        }
     
    

    /**
     * Display the specified resource.
     *
     * @param  \App\enquiry  $enquiry
     * @return \Illuminate\Http\Response
     */
    public function show(enquiry $enquiry)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\enquiry  $enquiry
     * @return \Illuminate\Http\Response
     */
    public function edit(enquiry $enquiry)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\enquiry  $enquiry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, enquiry $enquiry)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\enquiry  $enquiry
     * @return \Illuminate\Http\Response
     */
    public function destroy(enquiry $enquiry)
    {
        //
    }
}
