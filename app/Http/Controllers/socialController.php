<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SocialTable;
use App\SocialRow;
use App\Http\Resources\task as userResource ;

class socialController extends Controller
{
   public function index () 
   {

   		$tables = SocialTable::all();

   		return view('social.index')->with('tables' , $tables);

   }

   public function createTable(Request $Request) 
   {

  		$Request->validate([
    		'date' => 'required',
		]);

		 try {

		 	// create main table

		 	    $table = new SocialTable();
    		 	$table->date = $Request->date ;
    		 	$table->save();

		 	// create ROws
		     	//extracr year month ;
    		     	$date  =  explode("-", $table->date);
        		 	$year  =  $date[0];
        		 	$month =  $date[1];
		 		//get number of days in the month 
		 			$days =  cal_days_in_month(CAL_GREGORIAN, $month, $year);

		 		// for loop to create rows 
		 			for( $i= 1 ; $i <= $days ; $i++ ) 
		 			{
		 				$row = new SocialRow() ;
		 				$row->table_id = $table->id ; 
		 				$row->date = $i . "-" . $month  ; 
		 				$row->save();

		 			}
       		

    	} catch (Exception $e) {
       	  report($e);

           return false;
   		 } 

   		return redirect()->back();

   		

   }

   public function showTable($id) {
   		$date = SocialTable::find($id)->date;
   		return view('social.showTable')->with(['id' => $id , 'date' => $date]);

   }

   public function fetchRows($id) 
   {


   		$table = SocialTable::find($id);
   		$Rows  = $table->rows()->orderBy('created_at')->get();

   		return $Rows;


   }
   public function addRow($id, Request $Request) 
   {
		$row = new SocialRow();
		$row->table_id = $id;
		$row->date =  $Request->date;
		$row->type  = $Request->type;
		$row->progType  = $Request->progType;
		$row->content  = $Request->content;
		$row->PorV  = $Request->PorV;
		$row->path  = $Request->path;
		$row->OorS  = $Request->OorS;
		$row->age  = $Request->age;
		$row->location  = $Request->location;
		$row->gender  = $Request->gender;
		$row->intrst  = $Request->intrst;
		$row->intrstContent  = $Request->intrstContent;
		$row->objective  = $Request->objective;
		$row->duration  = $Request->duration;
		$row->yPaid  = $Request->yPaid;
		$row->yReach  = $Request->yReach;
		$row->yViews  = $Request->yViews;
		$row->ySubs  = $Request->ySubs;
		$row->yLikes  = $Request->yLikes;
		$row->fPaid  = $Request->fPaid;
		$row->fReach  = $Request->fReach;
		$row->fEngagement  = $Request->fEngagement;
		$row->fComment  = $Request->fComment;
		$row->fLikes  = $Request->fLikes;
		$row->fShare  = $Request->fShare;
		$row->iPaid  = $Request->iPaid;
		$row->iReach  = $Request->iReach;
		$row->iEngagement  = $Request->iEngagement;
		$row->iComment  = $Request->iComment;
		$row->iLikes  = $Request->iLikes;
		$row->iShare  = $Request->iShare;
		$row->tPaid  = $Request->tPaid;
		$row->tReach  = $Request->tReach;
		$row->tEngagement  = $Request->tEngagement;
		$row->tComment  = $Request->tComment;
		$row->tLikes  = $Request->tLikes;
		$row->tRetweet  = $Request->tRetweet;
	
		if($Request->yCheck != null  ){
		$row->yCheck  = $Request->yCheck;
	
		}
		if ($Request->iCheck != null ){
		$row->iCheck  = $Request->iCheck;
		}

		if( $Request->fCheck != null ){
		$row->fCheck  = $Request->fCheck;
		}
		if($Request->tCheck != null){
		$row->tCheck  = $Request->tCheck;
		}
		
			$row->save();
			return 'save done';
   }
   public function updateRow(Request $Request) 
   {

     

		$row = SocialRow::find($Request->id);
		
   		$row->type  = $Request->type;
   		$row->progType  = $Request->progType;
   		$row->content  = $Request->content;
   		$row->PorV  = $Request->PorV;
   		$row->path  = $Request->path;
   		$row->OorS  = $Request->OorS;
   		$row->age  = $Request->age;
		$row->location  = $Request->location;
		$row->gender  = $Request->gender;
		$row->intrst  = $Request->intrst;
		$row->intrstContent  = $Request->intrstContent;
   		$row->objective  = $Request->objective;
   		$row->duration  = $Request->duration;
   		$row->yPaid  = $Request->yPaid;
   		$row->yReach  = $Request->yReach;
   		$row->yViews  = $Request->yViews;
   		$row->ySubs  = $Request->ySubs;
   		$row->yLikes  = $Request->yLikes;
   		$row->fPaid  = $Request->fPaid;
   		$row->fReach  = $Request->fReach;
   		$row->fEngagement  = $Request->fEngagement;
   		$row->fComment  = $Request->fComment;
   		$row->fLikes  = $Request->fLikes;
   		$row->fShare  = $Request->fShare;
   		$row->iPaid  = $Request->iPaid;
   		$row->iReach  = $Request->iReach;
   		$row->iEngagement  = $Request->iEngagement;
   		$row->iComment  = $Request->iComment;
   		$row->iLikes  = $Request->iLikes;
   		$row->iShare  = $Request->iShare;
   		$row->tPaid  = $Request->tPaid;
   		$row->tReach  = $Request->tReach;
   		$row->tEngagement  = $Request->tEngagement;
   		$row->tComment  = $Request->tComment;
   		$row->tLikes  = $Request->tLikes;
   		$row->tRetweet  = $Request->tRetweet;
      $row->yCheck  = $Request->yCheck;
      $row->iCheck  = $Request->iCheck;
      $row->fCheck  = $Request->fCheck;
      $row->tCheck  = $Request->tCheck;

   		$row->save();

   }


   public function deleteRow($id){
			$row = SocialRow::find($id)->delete();

   }

   public function statisticsIndex()
   {
      return view('social.statistics');
   }

   public function fetchRowsAll()
   {
     
        $rows = SocialRow::all()->map->format();
        
        return $rows;
   }


}
