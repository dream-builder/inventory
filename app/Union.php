<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Union extends Model
{
protected $table='Unions';
protected $primaryKey = 'UnionId';
//    public function upazila(){
//        return $this->hasOne('App\Upazila','UpazilaId','UpazilaId');
//    }
}
