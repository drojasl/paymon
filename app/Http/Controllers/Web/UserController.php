<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use App\Models\Course;

class UserController extends Controller
{
    public function index()
    {
        return view('user.index');
    }
}
