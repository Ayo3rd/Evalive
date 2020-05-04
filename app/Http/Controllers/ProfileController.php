<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;

class ProfileController extends Controller
{
    public function index()
    {
    	$user = Auth::user();
    	$courses = DB::table('student_course')
    		   		->select(
		    			'courses.id as courseId',
		    			'courses.name as courseName')
		    		->join('courses', 'student_course.course_id','=','courses.id')
		    		->join('users','student_course.student_id','=','users.id')
		    		->where('users.id','=', $user->id)
		    		->get();

        return view('profile.profile', [
            'user' => $user,
            'courses' => $courses
        ]);
    }

    public function show($id)
    {
    	$user = Auth::user();
    	$course = DB::table('courses')
    				->where('id', '=', $id)
 		    		->first();
        $evaluations = DB::table('evaluations')
                        ->where('course_id','=', $id)
                        ->orderBy('updated_at', 'desc')
                        ->get();

        return view('profile.course', [
           'user' => $user,
            'course' => $course,
            'evaluations' => $evaluations
        ]);
    }

    public function like($id)
    {
        $user = Auth::user();
        $currNum = DB::table('evaluations')
            ->select('like')
            ->where('id', '=', $id)
            ->first();
        $newNum = strval($currNum->like + 1);

         DB::table('evaluations')
            ->where('id','=', $id)
            ->update([
                'like' => $newNum
            ]);
    }

     public function dislike($id)
    {
        $user = Auth::user();
        $currNum = DB::table('evaluations')
            ->select('dislike')
            ->where('id', '=', $id)
            ->first();
        $newNum = strval($currNum->dislike + 1);

         DB::table('evaluations')
            ->where('id','=', $id)
            ->update([
                'dislike' => $newNum
            ]);
    }


}

