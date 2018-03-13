<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Collages;

class Department extends Model
{

    public function collage(){
        return $this->hasMany('App\Collages','id','collageId');
    }

    public function instructor(){
        return $this->hasMany('App\User','id','instructorId');
    }



}
