<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Options extends Model
{
    protected $table = 'options';
    protected $fillable = [
        'question_id', 'option_text', 'option_value', 'parent_id'
    ];
    public $timestamps = false;
    protected $primaryKey = 'option_id';
    public function child_options(){
        return $this->hasMany('App\Options','parent_id','option_id')->orderBy('serial','asc');
    }
}
