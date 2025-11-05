<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
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

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function enrollments()
    {
        return $this->hasMany(CourseEnrollment::class);
    }

    public function enrolledCourses()
    {
        return $this->belongsToMany(Course::class, 'course_enrollments');
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isTeacher()
    {
        return $this->role === 'teacher';
    }

    public function isUser()
    {
        return $this->role === 'user';
    }

    public function canCreateCourses()
    {
        return $this->isAdmin() || $this->isTeacher();
    }

    public function canManageCourse($course)
    {
        \Log::info('canManageCourse check', [
        'isAdmin' => $this->isAdmin(),
        'isTeacher' => $this->isTeacher(),
        'course_user_id' => $course->user_id,
        'auth_id' => $this->id,
        'compare' => ($course->user_id === $this->id),
    ]);

        return $this->isAdmin() || ($this->isTeacher() && (int)$course->user_id === (int)$this->id);
    }

}
