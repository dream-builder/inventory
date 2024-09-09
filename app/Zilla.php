<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Zilla extends Model
{
protected $table='Zilla';
protected $primaryKey = 'ZillaId';
//    public function upazila(){
//        return $this->hasMany('App\Upazila','UpazilaId','upazilaid');
//    }
}
