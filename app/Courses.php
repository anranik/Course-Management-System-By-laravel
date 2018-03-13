<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use App\Collages;
use App\Department;

class Courses extends Model
{
    public function collage(){
        return $this->hasMany('App\Collages','id','collageId');
    }

    public function department(){
        return $this->hasOne('App\Department','id','departmentId');
    }
}
