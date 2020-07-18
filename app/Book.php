<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    // protected $fillable = ['bookName', 'user_id'];
    protected $fillable = ['bookName'];
    use SoftDeletes;
}
