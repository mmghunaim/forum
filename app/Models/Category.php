<?php

namespace App\Models;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];
    public function getRouteKeyName(){
        return 'slug';
    }
    public function user(){
        return $this->belongsTo(User::class);
    }

}
