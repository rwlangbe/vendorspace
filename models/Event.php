<?php

namespace vendorspace\models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
    	'user_id',
    	'title',
    	'start_date',
    	'end_date',
    	'notes',
    ];

    public function user()
	{
		return $this->belongsTo('vendorspace\models\User', 'user_id');
	}
}