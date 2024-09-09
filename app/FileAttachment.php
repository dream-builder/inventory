<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class FileAttachment extends Model
{
	protected $table='file_attachment';
	protected $primaryKey = 'id';

	protected $fillable = [
		'issue_id','user_id','file_name','type'
        ];

}

