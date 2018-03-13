<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Courses;

class CourseRequest extends Model
{

    public function instructor(){
        return $this->hasOne('App\user','id','instructorId');
    }
	
    public function otherInstructor(){
        return $this->hasMany('App\user','id','instructorId');
    }
	
    public function builder(){
        return $this->hasOne('App\user','id','builderId');
    }
	
    public function course(){
        return $this->belongsTo('App\Courses','courseId','id');
    }


}
