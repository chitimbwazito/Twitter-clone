<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use HasFactory, Notifiable,HasApiTokens;



    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'follower_id',
        'email',
        'password',
        'bio',
        'image',
    ];

    public function Ideas(){
        return $this->hasMany(idea::class)->latest();
    }

    public function Comments(){
        return $this->hasMany(Comment::class)->latest();
    }

    //follower_id = id of person followed
    //user_id= id of authorized user
    //users who are your followers
    public function followers(){
        return $this->belongsToMany(User::class, 'follower_user','user_id','follower_id')->withTimestamps();
    }
    //users you are following
    public function following(){
        return $this->belongsToMany(User::class, 'follower_user','follower_id','user_id')->withTimestamps();
    }

    public function getImageURL(){
        if($this->image) {
            return url('storage/'.$this->image);
        }
        return "https://api.dicebear.com/6.x/fun-emoji/svg?seed=(this->name)";
    }

    public function follows(User $user){
        return $this->following()->where('user_id', $user->id)->exists();
    }

    public function likes(){
        return $this->belongsToMany(Idea::class, 'idea_like');
    }

    public function likesIdea(Idea $idea){
        return $this->likes()->where('idea_id', $idea->id)->exists();
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
