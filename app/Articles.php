<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Articles extends Model
{
protected $fillable = ['title', 'slug', 'body','user_id','confirmation'];


public function user(){
    return $this->belongsTo(User::class);
}

}
