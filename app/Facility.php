<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Facility extends Model
{
protected $table='facility_registry';
protected $primaryKey = 'facilityid';
//    public function union(){
//        return $this->hasOne('App\Union','UnionId','unionid')
//            ->where('zillaid','=',null);
//    }
}
