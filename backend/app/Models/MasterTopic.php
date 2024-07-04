<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterTopic extends Model
{
    use HasFactory;


    protected $fillable = [
        'serialnumber',
        'title',
        'description',
//        'weightage',
//        'timerequired',
        'parentid',
        'contentid',
//        'tags',
  //      'status'
    ];


    protected $hidden = [
        'id',
        'weightage',
        'timerequired',
        'parentid',
        'contentid',
        'status',
        'created_at',
        'updated_at',
    ];
}
