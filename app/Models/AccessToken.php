<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccessToken extends Model
{   
    protected $table = 'access_tokens';
    protected $guarded = ['id'];
    public $timestamps = false;
}
