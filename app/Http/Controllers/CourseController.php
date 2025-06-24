<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CourseRequest;
use App\Models\Course;
use App\Services\CourseService;
use Illuminate\Support\Facades\Cache;

class CourseController extends Controller
{
    protected $courseService;

    public function __construct(CourseService $courseService)
    {
        $this->courseService = $courseService;
    }

    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);

        $cacheKey = "courses_page_{$request->get('page', 1)}_perpage_{$perPage}";

        $courses = Cache::remember($cacheKey, 60, function () use ($perPage) {
            return Course::paginate($perPage);
        });

        return response()->json($courses);
    }

    public function store(CourseRequest $request)
    {
        $course = $this->courseService->createCourse($request->validated());

        Cache::flush();

        return response()->json($course, 201);
    }

    public function show(Course $course)
    {
        $cacheKey = "course_{$course->id}";

        $cachedCourse = Cache::remember($cacheKey, 60, function () use ($course) {
            return $course;
        });

        return response()->json($cachedCourse);
    }

    public function update(CourseRequest $request, Course $course)
    {
        $this->courseService->updateCourse($course, $request->validated());

        Cache::flush();

        return response()->json([
            'message' => 'Course updated successfully.',
            'data' => $course
        ]);
    }

    public function destroy(Course $course)
    {
        $this->courseService->deleteCourse($course);

        Cache::flush();

        return response()->json([
            'message' => 'Course deleted successfully.'
        ]);
    }
}
