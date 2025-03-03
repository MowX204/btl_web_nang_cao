<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'instructor_name']; 

    public function students()
    {
        return $this->belongsToMany(Student::class); // Liên kết khóa học với học viên
    }
}





