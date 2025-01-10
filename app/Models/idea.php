<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class idea extends Model
{
    use HasFactory;
    protected $with = ['user:id,name,image','comments.user'];

    protected $withCount = ['likes'];

    protected $fillable = [
        'user_id',
        'content',
    ];

    public function Comments(){
        return $this->hasMany(Comment::class);
    }

    public function User(){
        return $this->belongsTo(User::class);
    }
    public function likes(){
        return $this->belongsToMany(User::class, 'idea_like');
    }
}
