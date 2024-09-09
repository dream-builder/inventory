<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    protected $table='tour';
    protected $primaryKey = 'id';
    protected $fillable = [
        'title', 'content','next','previous','more','style','status','finish_date','target'];
}