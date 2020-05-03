<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class EvalController extends Controller
{
	public function index()
    {
    	date_default_timezone_set('America/Los_Angeles');
    	$user = Auth::user();
		$evaluations = DB::Table('evaluations')
					->select(
						'evaluations.id as id',
						'evaluations.evaluation as evaluation',
						'evaluations.like as like',
						'evaluations.dislike as dislike',
						'evaluations.deleted as deleted', 
						'evaluations.edited as edited',
						'evaluations.course_id as course_id',
						'evaluations.created_at as created_at',
						'evaluations.updated_at as updated_at',
						'courses.name as course_name'
		    			)
					->join('users', 'student_id','=', 'users.id')
					->join('courses','course_id','=', 'courses.id')
					->where('evaluations.student_id', '=', $user->id)
					->orderBy('updated_at', 'desc')
					->get();
        return view('mEval.mEval', [
            'user' => $user,
            'evaluations' => $evaluations
        ]);
    }


    public function deleteConfirmation($id)
    {
    	$evaluation = DB::Table('evaluations')
					->select('courses.name as course_name',
								'evaluations.id as id')
					->join('users', 'student_id','=', 'users.id')
					->join('courses','course_id','=', 'courses.id')
					->where('evaluations.id', '=', $id)
					->first();

    	return view('mEval.delete-confirmation', [
    		'evaluation' => $evaluation
    	]);
    }


    public function destroy($id)
    {
    	$evaluation = DB::Table('evaluations')
					->select('courses.name as course_name',
								'evaluations.id as id')
					->join('users', 'student_id','=', 'users.id')
					->join('courses','course_id','=', 'courses.id')
					->where('evaluations.id', '=', $id)
					->first();
    	DB::table('evaluations')->where('id', '=', $id)->delete();

    	return redirect()
    		->route('mEval')
    		->with('success', "Your {$evaluation->course_name} Evaluation Was Successfully Deleted");
    }


    public function edit($id)
    {
        $user = Auth::user();
        $evaluation = DB::Table('evaluations')
					->select('courses.name as course_name',
								'evaluations.id as id',
								'courses.id as course_id',
								'evaluations.evaluation as evaluation')
					->join('users', 'student_id','=', 'users.id')
					->join('courses','course_id','=', 'courses.id')
					->where('evaluations.id', '=', $id)
					->first();
        return view('mEval.edit', [
            'user' => $user,
            'evaluation' => $evaluation
        ]);
    }

    public function update($id, Request $request)
    {
    	$request->validate([
            'course' => 'required|exists:courses,id',
    		'evaluation' => 'required|min:10'
        ]);

        date_default_timezone_set('America/Los_Angeles');

        $user = Auth::user();
        $oldEvaluation = DB::Table('evaluations')
					->select('courses.name as course_name',
								'evaluations.id as id',
								'courses.id as course_id',
								'evaluations.evaluation as evaluation')
					->join('users', 'student_id','=', 'users.id')
					->join('courses','course_id','=', 'courses.id')
					->where('evaluations.id', '=', $id)
					->first();

        DB::table('evaluations')
            ->where('id', '=', $id)
            ->update([
                'evaluation' => $request->input('evaluation'),
                'edited' => 1,
                'updated_at' => date('Y-m-d H:i:s')
            ]);		

        return redirect()
        		->route('mEval')
        		->with(
        			'success',
        			"{$oldEvaluation->course_name} Evaluation Has Been Updated");

    }
}
