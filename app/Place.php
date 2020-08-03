<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    public function FavoriteUsers()
    {
        return $this->belongsToMany('App\User', 'favorite_user_place');
    }

    public function CompletedUsers()
    {
        return $this->belongsToMany('App\User', 'completed_user_place');
    }
}