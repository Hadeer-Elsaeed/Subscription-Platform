<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'url',
    ];

    // A website has many posts
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    // A website can have many subscribers
    public function users()
    {
        
        return $this->belongsToMany(Website::class, 'user_website')->withTimestamps();
    }
}