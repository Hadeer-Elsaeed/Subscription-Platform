<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'website_id',
        'title',
        'description',
    ];

    // Post belongs to a website
    public function website()
    {
        return $this->belongsTo(Website::class);
    }

    // Users who received posts
    public function users()
    {
        return $this->belongsToMany(User::class, 'post_user')->withPivot('sent_at')->withTimestamps();
    }
}