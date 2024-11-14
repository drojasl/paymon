<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Video;
use App\Traits\UserTrait;

class CourseController extends Controller
{
    use UserTrait;

    public function index()
    {
        return Course::all();
    }

    public function search(Request $request)
    {
        $query = Course::query();

        if ($request->has('category_id')) {
            $query->where('category_id', $request->category_id);
        }
        if ($request->has('age_range')) {
            $query->where('age_range', $request->age_range);
        }
        if ($request->has('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        return $query->get();
    }

    public function register(Request $request, Course $course)
    {
        $user = $this->getUserFromRequest($request);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->courses()->attach($course->id);
    
        return response()->json(['message' => 'User registered to course successfully']);
    }

    public function videos(Course $course)
    {
        return $course->videos;
    }
}
