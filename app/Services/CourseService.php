<?php

namespace App\Services;

use App\Models\Course;

class CourseService
{
    public function createCourse(array $data): Course
    {
        return Course::create($data);
    }

    public function updateCourse(Course $course, array $data): bool
    {
        return $course->update($data);
    }

    public function deleteCourse(Course $course): bool
    {
        return $course->delete();
    }
}
