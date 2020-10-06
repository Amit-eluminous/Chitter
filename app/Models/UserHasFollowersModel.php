<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Request;
use App\User;

class UserHasFollowersModel extends Model 
{
    protected $table = 'user_has_followers';

    protected $fillable = [
        'id', 
        'user_id', 
        'followed_user_id', 
        'created_at',  
        'updated_at'
    ];

     
}
