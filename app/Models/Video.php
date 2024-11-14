<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'url',
        'course_id',
        'category_id'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function progress()
    {
        return $this->hasMany(Progress::class);
    }

    public function usersWhoLiked()
    {
        return $this->belongsToMany(User::class, 'video_user_like')->withTimestamps();
    }
}
