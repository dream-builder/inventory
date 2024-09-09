<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class IssueAction extends Model
{
    protected $table = 'issue_action';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id', 'issue_id', 'detail','created_at','updated_at','status','creator_id'
    ];
}