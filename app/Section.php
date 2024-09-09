<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Section extends Model
{
    protected $table = 'section';
    protected $fillable = [
        'section_id', 'section_name', 'details'
    ];
    protected $primaryKey = 'section_id';

    public function questions(){
        return $this->hasMany('App\Question','section_id','section_id')->orderBy('question_serial','asc');
    }

}
