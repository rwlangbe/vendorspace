<?php

namespace vendorspace\models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
    	'user_id',
    	'image',
    	'title',
    	'body',
    	'description',
    ];
}
