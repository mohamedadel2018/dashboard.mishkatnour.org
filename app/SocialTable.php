<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialTable extends Model
{
     public function rows(){
    	
    	return $this->hasMany(SocialRow::class , 'table_id');
    }

    public function format()
	{
		$date  =  explode("-",$this->date);
        $year  =  $date[0];
        $month =  $date[1];
		return [
			'year' =>  $year,
			'month' =>  $month,
			'data' => $this->rows()->get(),
		];
	}
}
