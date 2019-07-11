<?php

namespace App\Models;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $fillable = ['body'];
    protected static function boot(){
        parent::boot();
        static::creating(function($reply){
            $reply->user_id = auth()->id();
        });
    }
    protected $guarded = [];
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function question(){
        return $this->belongsTo(Question::class);
    }

    public function like(){
        return $this->hasMany(Like::class);
    }

}
