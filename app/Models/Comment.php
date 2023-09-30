<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = ['status','post_id','body','parent_id','name','email','isAdmin'];
    public function post(){
        return $this->belongsTo(Post::class);
    }
    public function replies(){
        return $this->hasMany(Comment::class,'parent_id');
    }
}
