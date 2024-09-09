<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Issues extends Model
{
	protected $table='issues';
	protected $primaryKey = 'id';
	//    public function union(){
	//        return $this->hasOne('App\Union','UnionId','unionid')
	//            ->where('zillaid','=',null);
	//    }

	protected $fillable = [
		'facility_id', 'user_id','title','detail','category','priority','tags','create_date','completion_date','resolved','child_of','assign_to',
        'zilla', 'upazila','union','village','reson_of_visit'];

}

