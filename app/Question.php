<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Question extends Model
{
protected $table='questions';
    protected $fillable = [
        'question_id','question_text','question_serial','question_type','section_id'
    ];
    public function options(){
        return $this->hasMany('App\Options','question_id','question_id')
            ->where('parent_id','=',null)->where('extra_options','=',null)->orderBy('serial','asc');
    }
    public function extra_options(){
        return $this->hasMany('App\Options','question_id','question_id')
            ->where('extra_options','=',1)->orderBy('serial','asc');
    }
protected $primaryKey = 'question_id';
}
