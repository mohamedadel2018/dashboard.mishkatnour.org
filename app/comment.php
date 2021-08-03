<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    //

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function enquiry()
    {
        return $this->belongsTo('App\enquiry');
    }
}
