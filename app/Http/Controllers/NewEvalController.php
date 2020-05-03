<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;

class NewEvalController extends Controller
{
    public function create()
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


        return view('newEval.create', [
            'user' => $user,
            'courses' => $courses
        ]);
    }  

    public function store(Request $request)
    {
    	$user = Auth::user();   

        $course = DB::table('courses')
                    ->where('id','=',$request->input('course'))
                    ->first();
                    
        date_default_timezone_set('America/Los_Angeles');

    	$request->validate([
    		'course' => 'required|exists:courses,id',
    		'evaluation' => 'required|min:10'
    	]);

    	DB::table('evaluations')->insert([
    		'evaluation' => $request->input('evaluation'),
    		'like' => 0,
    		'dislike' => 0,
    		'deleted' => 0,
    		'edited' => 0,
    		'student_id' => $user->id,
    		'course_id' => $request->input('course'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
    	]);

    	return redirect()
            ->route('mEval')
            ->with('success', "Successfully Created New {$course->name} Evaluation.");
    } 


}
