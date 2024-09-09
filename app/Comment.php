<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Comment extends Model
{
	protected $table='comments';
	protected $primaryKey = 'id';
	//    public function union(){
	//        return $this->hasOne('App\Union','UnionId','unionid')
	//            ->where('zillaid','=',null);
	//    }

	protected $fillable = [
		'facility_id', 'user_id','comment'
	];

}
