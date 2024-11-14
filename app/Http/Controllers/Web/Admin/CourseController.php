<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Category;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        return view('admin.courses.index');
    }

    public function show($id)
    {
        $course = Course::with('category')->findOrFail($id);
        $users = $course->users;
        return view('admin.courses.show', compact('course', 'users'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.courses.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'age_range' => 'required|string',
        ]);

        Course::create($request->all());
        return redirect()->route('admin.courses.index');
    }

    public function userIndex()
    {
        return view('user.courses.index');
    }
}
