<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Awards extends Model
{
    use SoftDeletes;
    protected $fillable = ['type','created_at','updated_at','deleted_at'];
    protected $table = 'awards';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}
