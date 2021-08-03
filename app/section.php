<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class section extends Model
{
     public function departments()
    {
    	return $this->hasMany(department::class);
    }
}
