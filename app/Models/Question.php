<?php
namespace App\Models;
use App\User;
use Illuminate\Database\Eloquent\Model;
class Question extends Model
{
    protected $fillable  = ['title','slug','body','category_id','user_id'];
    //or
    // protected $guarded = [];
    
    // protected $with = ['replies'];
    protected static function boot(){
        parent::boot();
        static::creating(function($question){
            $question->slug = str_slug($question->title);
        });
    }

    public function getRouteKeyName(){
        return 'slug';
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function replies(){
        return $this->hasMany(Reply::class)->latest();
    }
    public function getPathAttribute(){
        return "/question/$this->slug";
    }
}