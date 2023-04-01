<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Course;

class CoursePolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {

    }
    // delete

    // public function delete(User $user, Course $course)
    // {
    //     return $user->id === $course->user_id;
    // }



    public function update(User $user, Course $course)
    {
        return $user->id === $course->user_id;
    }

    }
