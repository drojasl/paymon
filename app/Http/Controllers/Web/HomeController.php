<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        /*if (auth()->check()) {
            if (auth()->user()->hasRole('admin')) {
                return redirect()->route('admin.courses');
            } else {
                return redirect()->route('courses.index');
            }
        }*/

        return view('index');
    }

    public function about()
    {
        /*if (auth()->check()) {
            if (auth()->user()->hasRole('admin')) {
                return redirect()->route('admin.courses');
            } else {
                return redirect()->route('courses.index');
            }
        }*/

        return view('about');
    }
}
