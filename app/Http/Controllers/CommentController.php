<?php

namespace App\Http\Controllers;

use App\comment;
use App\enquiry;
use Auth;
use App\User;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    // public function getcomments($id){

    //     $comment = comment::where('enquiry_id',$id)->latest()->get();
    //     return response()->json($comment);
    // }


    public function showComment(Request $request){
     
        $comment = comment::where('enquiry_id',$request->enquiryid)->get();
        
        return response()->json($comment);
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
        // dd($request->all());
        // $request->validate([
        //     'body' => 'required',
        // ]);
        $user = User::find(Auth::id());
        $comment = comment::create([
            'body' => $request->comment,
            'user_id' => Auth::id(),
            'enquiry_id' => $request->enquiryid,
            'name' => $user->name,
            'photo' => $user->photo
        ]);

        // broadcast(new NewComment($comment->user,$comment))->toOthers();

        // $article = enquiry::find($comment->article_id);
      
        // $user->notify(new notifyOwner($comment,$article));
        return response()->json($comment);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(comment $comment)
    {
        //
    }
}
