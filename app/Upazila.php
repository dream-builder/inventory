<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Upazila extends Model
{
protected $table='Upazila';
protected $primaryKey = 'UpazilaId';
//    public function zilla(){
//        return $this->hasOne('App\Zilla','ZillaId','ZillaId');
//    }
}
