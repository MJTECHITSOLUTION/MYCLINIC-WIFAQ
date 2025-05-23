<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable=['id','name','price','created_at','updated_at'];
    protected $table = 'payment';
}
