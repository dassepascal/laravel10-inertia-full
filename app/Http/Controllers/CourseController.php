<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with('user')->withCount('episodes')->get();
        //dd($courses);
        return Inertia::render('Courses/Index', [
            'courses' => $courses
        ]);
    }

        public function show(int $id)
        {
            $course = Course::where('id', $id)->with('episodes')->first();
            $watched = auth()->user()->episodes;
            return Inertia::render('Courses/Show', [
                'course' => $course,
                'watched' => $watched,
            ]);
        }

        public function toggleProgress(Request $request)
        {

            //return $request->input('episodeId');
            $id = $request->input('episodeId');
            $user = auth()->user();
           // $user = User::all();
            $user->episodes()->toggle($id);

            return $user->episodes;
        }
}
