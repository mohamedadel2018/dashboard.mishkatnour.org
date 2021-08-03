<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\comment;
use App\User;
use App\enquiry;
use Image;
use Mail;
class allenquiryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('Dashboard.allenquiry');
    }


    public function getallenquiry()
    {
        $enquiries= enquiry::with('user')->with('for')->latest()->paginate(8);
        return  response()->json($enquiries);
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
        // dd($id);
        // $request->validate([
        //     'title' => 'required',
        //     'body' => 'required',
        // ]);

        if($request->for != []){

            $fors = $request->for;
            // dd($fors);
            // dd($fors);
            foreach($fors as $for){

        $update_enqury =  enquiry::find($id);
        $update_enqury->title = $request->title;
        $update_enqury->body = $request->body;
        $update_enqury->for_id = $for;
        if($request->photo  !=   $update_enqury->photo){
            $name = time().'.'  . explode('/', explode(':', substr($request->photo, 0, strpos($request->photo, ';')))[1])[1];
            \Image::make($request->photo)->resize(500, 200)->save(public_path('images/enquiry/').$name);
            $request->merge(['photo' => $name]);
            $update_enqury->photo = $name;
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
        $update_enqury->update();
      }
    }    
    else{
            
        $update_enqury =  enquiry::find($id);
        $update_enqury->title = $request->title;
        $update_enqury->body =  $request->body;

        if($request->photo !=   $update_enqury->photo){
            $name = time().'.'  . explode('/', explode(':', substr($request->photo, 0, strpos($request->photo, ';')))[1])[1];
            \Image::make($request->photo)->resize(500, 200)->save(public_path('images/enquiry/').$name);
            $request->merge(['photo' => $name]);
            $update_enqury->photo = $name;
        }
        $update_enqury->update();
        
        }

        return  response()->json('',200);
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
     
        $delete_enquiry = enquiry::find($id);
        if($delete_enquiry->photo != null){
            $image_path = public_path().'/images/enquiry/'.$delete_enquiry->photo;
            unlink($image_path);
        }
        $delete_enquiry->delete();

        return response()->json([], 200);
    }
}
