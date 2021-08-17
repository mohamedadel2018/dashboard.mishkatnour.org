<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Hash;
use App\paper ;

class profileController extends Controller
{
    public function profile($id) {
    	// check if admin or his profile
    if(Auth::user()->id == $id || Auth::user()->admin )
       {
    	// chech if not admin or his profile
    	    $user = User::find($id);
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
        $paperNames = paper::all();
    	return view('Dashboard.profile')->with(['user' => $user , 'data' => $data , 'paperNames' => $paperNames]);
       }
       return redirect('/Dashboard');

    }
    public function setPassword(Request $request) {

        user::where('id','=' , Auth::user()->id)->update(['password' => Hash::make($request->password)]);

         return redirect()->back()->with('passwordChanged', 'Branch is Added');
        // echo 'hello';



    }
}
