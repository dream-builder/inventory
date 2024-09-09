<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Last_login extends Model
{
    protected $table='last_login';
    protected $primaryKey = 'id';

    protected $fillable = ['id', 'user_id','created_at','updated_at'];
}
