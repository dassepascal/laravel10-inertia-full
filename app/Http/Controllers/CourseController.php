<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with('user')
        ->select('courses.*', DB::raw(
            '(SELECT COUNT(DISTINCT(user_id))
             FROM completions
              INNER JOIN episodes ON completions.episode_id = episodes.id
               WHERE episodes.course_id = courses.id
               )AS participants'
        ))
        ->withCount('episodes')->latest()->get();//pour obtenir les dernireres formations
        dd($courses);
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

        public function store(Request $request)
        {
            //champ user_id
            //pb:de masse assignment on user_id title et description
            dd($request->input('episodes'));
            Course::create($request->all());
            return redirect()->route('dashboard')->with('message', 'Formation ajoutée avec succès');


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
