<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mapping_Awards extends Model
{
    protected $fillable = ['users_id','awards_id','note','total','created_at','updated_at'];
    protected $table = 'mapping_awards';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}
