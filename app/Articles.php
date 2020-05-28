<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Articles extends Model
{
    //   The fillable variable makes these columns fillable and we can't insert or change them without calling them here
protected $fillable = ['title', 'slug', 'body','user_id','confirmation'];


public function user(){
    return $this->belongsTo(User::class);
}

}
