<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class QuestionsOptionsMapping extends Model
{
    protected $table = 'questions_options_mapping';
    protected $fillable = [
        'feedback_of_question_id', 'feedback_option_id', 'value'
    ];
    public $timestamps = false;
    protected $primaryKey = 'questions_options_mapping_id';

}
