<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class EmailQueue extends Model
{
	protected $table='email';
	protected $primaryKey = 'id';
	//    public function union(){
	//        return $this->hasOne('App\Union','UnionId','unionid')
	//            ->where('zillaid','=',null);
	//    }

	protected $fillable = [
		'id','issue_id','creator_id','mail_to','cc','bcc','mail_subject','mail_body','status','created_at','updated_at','priority','tags','category'
	];

}
