<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
    ];

    //  user can subscribe to many websites
    public function websites()
    {
        return $this->belongsToMany(User::class, 'user_website', 'website_id', 'user_id');
    }

    // Posts that have been sent to this user
    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_user')->withPivot('sent_at')->withTimestamps();
    }
}