<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Course;
use App\Models\Episode;
use App\Youtube\YoutubeServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Termwind\Components\Dd;

class CourseController extends Controller
{
    // message error



    public function index()
    {
        $courses = Course::with('user')
        ->select('courses.*', DB::raw(
            '(SELECT COUNT(DISTINCT(user_id))
             FROM completions
              INNER JOIN episodes ON completions.episode_id = episodes.id
               WHERE episodes.course_id = courses.id
               )AS participants'
        ))->addSelect(DB::raw(
            '( SELECT SUM(duration) FROM episodes WHERE episodes.course_id = courses.id

                ) AS total_duration'
        ))
        ->withCount('episodes')->latest()->paginate(5);//pour obtenir les dernireres formations
        // dd($courses);
        return Inertia::render('Courses/Index', [
            'courses' => $courses
        ]);
    }

        public function show(int $id)
        {
            $course = Course::where('id', $id)->with('episodes')->first();
            $watched = auth()->user()->episodes;
            // dd($course);
            // dd($watched);
            return Inertia::render('Courses/Show', [
                'course' => $course,
                'watched' => $watched,
            ]);
        }

        public function store(Request $request, YoutubeServices $ytb) //pour ajouter une formation
        {


            //champ user_id
            //pb:de masse assignment on user_id title et description
            // dans $course on recupere le champ course_id
            //creation des episodes liés à une formation
            $request->validate([
                'title' => 'required',
                'description' => 'required',
                'episodes' => ['required','array'],
                'episodes.*.title' => 'required',
                'episodes.*.description' => 'required',
                'episodes.*.video_url' => 'required',

            ]);
            $course =Course::create($request->all());

            foreach ($request->input('episodes') as $episode) {
                $episode['course_id'] = $course->id;
                $episode['duration'] = $ytb->handleYoutubeVideoDuration($episode['video_url']);
//dd($episode['duration']);
                Episode::create($episode);
            }
            return to_route('dashboard')->with('message', 'Formation ajoutée avec succès');
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
        public function edit(int $id)
        {

            $course = Course::where('id', $id)->with('episodes')->first();
            $this->authorize('update', $course);
             //$this->authorize('update', $course);
            return Inertia::render('Courses/Edit', [
                'course' => $course,
            ]);
        }
        // public function update(Request $request, $id){

        //     dd($request->all());
        //     $course = Course::where('id', $id)->with('episodes')->first();
        //     $course->update($request->all());
        //     return to_route('dashboard')->with('message', 'Formation modifiée avec succès');
        // }

        public function update(Request $request,int $id)
        {

            $request->validate([
                'title' => 'required',
                'description' => 'required',
                'episodes' => ['required','array'],
                'episodes.*.title' => 'required',
                'episodes.*.description' => 'required',
                'episodes.*.video_url' => 'required',

            ]);
            $course = Course::where('id', $id)->with('episodes')->first();
                $this->authorize('update', $course);
             $course->update($request->all());
             $course->episodes()->delete();
            foreach ($request->input('episodes') as $episode) {
                $episode['course_id'] = $course->id;
                Episode::create($episode);
            }

            return to_route('courses')->with('message', 'Formation modifiée avec succès');
        }

    }
