<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Video;
use App\Models\Category;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index(Course $course)
    {
        $categories = Category::all();
        return view('admin.videos.index', compact('course', 'categories'));
    }

    public function store(Request $request, Course $course)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'url' => 'required|url',
            'category' => 'required|integer',
        ]);

        $video = new Video();
        $video->course_id = $course->id;
        $video->title = $validated['title'];
        $video->description = $validated['description'];
        $video->category_id = $validated['category'];
        $video->url = $validated['url'];

        $video->save();

        return redirect()->route('videos.index', $course->id)->with('success', 'Video added successfully');
    }

    public function destroy(Video $video)
    {
        $video->delete();
        return response()->json(['message' => 'Video deleted successfully']);
    }
}
