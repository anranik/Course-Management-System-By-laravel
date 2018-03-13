<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HelpDesk extends Model
{
    //protected $fillable =['title','message','courseId','userId'];

    public function instructor(){
        return $this->belongsTo('App\user','userId');
    }


    public function course(){
        return $this->belongsTo('App\courses','courseId');
    }
}
