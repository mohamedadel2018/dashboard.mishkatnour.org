<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialRow extends Model
{
    public function table(){
    	
    	return $this->belongsTo(SocialTable::class , 'table_id');
    }

    public function format()
	{
	// $date  =  explode("-",$this->table()->first()->date);
        $year  =   '2021'; // $date['0'];
        $month = '07'; // $date['1'];
		return [
			'type'=> $this->type,
			'date'=> $this->date,
   		    'progType'=> $this->progType,
       		'content'=> $this->content,
       		'PorV'=> $this->PorV,
       		'path'=> $this->path,
       		'OorS'=> $this->OorS,
       		'age'=> $this->age,
            'location'=> $this->location,
            'gender'=> $this->gender,
			'intrst'=> $this->intrst,
			'intrstContent' => $this->intrstContent,
       		'objective'=> $this->objective,
       		'duration'=> $this->duration,
       		'yPaid'=> $this->yPaid,
       		'yReach'=> $this->yReach,
       		'yViews'=> $this->yViews,
       		'ySubs'=> $this->ySubs,
       		'yLikes'=> $this->yLikes,
       		'fPaid'=> $this->fPaid,
       		'fReach'=> $this->fReach,
       		'fEngagement'=> $this->fEngagement,
       		'fComment'=> $this->fComment,
       		'fLikes'=> $this->fLikes,
       		'fShare'=> $this->fShare,
       		'iPaid'=> $this->iPaid,
       		'iReach'=> $this->iReach,
       		'iEngagement'=> $this->iEngagement,
       		'iComment'=> $this->iComment,
       		'iLikes'=> $this->iLikes,
       		'iShare'=> $this->iShare,
       		'tPaid'=> $this->tPaid,
       		'tReach'=> $this->tReach,
       		'tEngagement'=> $this->tEngagement,
       		'tComment'=> $this->tComment,
       		'tLikes'=> $this->tLikes,
       		'tRetweet'=> $this->tRetweet,
            'yCheck'=> $this->yCheck,
            'iCheck'=> $this->iCheck,
            'fCheck'=> $this->fCheck,
            'tCheck'=> $this->tCheck,
            'year'=> $year,
            'month'=> $month,
		];
	}

   
}
