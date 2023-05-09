<?php

namespace iteos\Models;

use Illuminate\Database\Eloquent\Model;

class QuesionerDetail extends Model
{
    protected $fillable = [
    	'questioner_id',
        'question',
        'scale',
    	'answer',
    ];
}
