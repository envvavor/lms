<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'user_id',
        'price',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class)->orderBy('id', 'asc');
    }

    public function enrollments()
    {
        return $this->hasMany(CourseEnrollment::class, 'course_id');
    }

    public function enrolledUsers()
    {
        return $this->belongsToMany(User::class, 'course_enrollments');
    }
} 