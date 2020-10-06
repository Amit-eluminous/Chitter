<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Request;
use App\User;

class UserHasPostsModel extends Model 
{
    use SoftDeletes;

    protected $table = 'user_has_posts';

    protected $fillable = [
        'id', 
        'user_id', 
        'post', 
        'created_at',  
        'updated_at',
        'deleted_at'
    ];

    public function assignedUser(){
      return $this->belongsTo(User::class, 'user_id', 'id');
    }


     
}
