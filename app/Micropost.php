<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Micropost extends Model
{
    protected $fillable = ['content', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
   
    
    public function favorite($userId)
{
    // confirm if already following
    $exist = $this->is_favoriting($userId);
    

    if ($exist ) {
        // do nothing if already following
        return false;
    } else {
        // follow if not following
        $this->favoritelists()->attach($userId);
        return true;
    }
}

public function unfavorite($userId)
{
    // confirming if already following
    $exist = $this->is_favoriting($userId);
    

    if ($exist ) {
        // stop following if following
        $this->favoritelists()->detach($userId);
        return true;
    } else {
        // do nothing if not following
        return false;
    }
}


public function is_favoriting($userId) {
    return $this->favoritelists()->where('favo_id', $userId)->exists();
}
}
