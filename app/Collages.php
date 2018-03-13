<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\user;

class Collages extends Model
{

    protected $fillable = [
        'name',
        'instructor'
    ];

    public function instructor(){
        return $this->hasOne('App\user','id','instructorId');
    }


}
