<?php

namespace App\Http\Controllers;

use App\enquiry;
use Illuminate\Http\Request;
use Image;
use Auth;
use App\comment;
use App\User;
use Mail;
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
    
        return  response()->json($all_enquiry);
       
    }


    public function getenquiryforone(){

        $forone_enquiry = enquiry::with('comment')->with('user')->where('for_id',Auth::id())->latest()->paginate(5);
        // dd( $forone_enquiry);
        return  response()->json($forone_enquiry);
    }


    public function getenquirySent(){

        $Sent_enquiry = enquiry::with('comment')->with('user')->where('user_id',Auth::id())->latest()->paginate(5);
        // dd( $forone_enquiry);
        return  response()->json($Sent_enquiry);
    }


    public function getUser() {
        //check authntication
       if(Auth::user()->admin = '1'){
        $user = 'admin';
       } else{
        $user = 'notadmin';
       }
        return  response()->json($user);
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
            // dd($fors);
            // dd($fors);
            foreach($fors as $for){
                $enquiry = new enquiry();
                $enquiry->title = $request->title;
                $enquiry->body =  $request->body;
                $enquiry->user_id = Auth::id();
                $enquiry->for_id = $for;
                if($request->photo){
                    $name = time().'.'  . explode('/', explode(':', substr($request->photo, 0, strpos($request->photo, ';')))[1])[1];
                    \Image::make($request->photo)->resize(500, 200)->save(public_path('images/enquiry/').$name);
                    $request->merge(['photo' => $name]);
                    $enquiry->photo = $name;
                }
              
                $user = user::find($for);
                $email = $user->email;
                $msg = 'there are new enquiry for you ' . $enquiry->title;
                 $emailContent =array(
                   'Name' =>$user->name,
                   'msg' =>$msg ,
                   'enquiryName' =>$enquiry->title ,
                    );
                    Mail::send(['html' => 'msg'], $emailContent, function ($message) use ($emailContent , $email) {

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
                    \Image::make($request->photo)->resize(500, 200)->save(public_path('images/enquiry/').$name);
                    $request->merge(['photo' => $name]);
                    $enquiry->photo = $name;
                }
                $enquiry->save();
            
        }
     
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
