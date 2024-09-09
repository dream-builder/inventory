<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class UserResetToken extends Model
{
    protected $table='user_reset_token';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id','issue_id','token','created_at','updated_at'
    ];
}
