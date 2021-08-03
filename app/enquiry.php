<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class enquiry extends Model
{
    //

    protected $guarded = [];

    public function comment()
    {
        return $this->hasMany('App\comment','enquiry_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function for()
    {
        return $this->belongsTo('App\User','for_id');
    }
  
}
