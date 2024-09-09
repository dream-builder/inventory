<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $table='region';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id', 'region_name','zilla','created_at','updated_at'];
}