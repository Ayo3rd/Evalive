@extends('layouts.main')

@section('title', 'My Profile')


@section('content')

<div class=" topRow row  mt-100">
	<div class="col-6">
		<h3>Hello, {{$user->name}}</h3>
	</div>
	<div class="col-6 evalButton">
		<div class="type-1">
		  <div>
		    <a href="/NewEvaluation/create" class="btn btn-3">
		      <span class="txt">New Evaluation</span>
		      <span class="round"><i class="fa fa-chevron-right"></i></span>
		    </a>
		  </div>
		</div> 		
	</div>
</div>

<hr>

	


<div class="row">
@foreach($courses as $course)
	<div class="col-sm-4">
		<a class="remove-a" href="/profile/{{$course->courseId}}">
		  <div class="card course">
		    <div class="image">
		      <img src="http://loremflickr.com/320/150?random={{$course->courseId}}
		      " />
		    </div>
		    <div class="card-inner">
		      <div class="header">
		        <h3>Course:</h3>
		        <h2>{{$course->courseName}}</h2>
		    </div>
		    <div class="content">
		      <p>USC Endorsed</p>
		    </div>
		      </div>
		  </div>
		</a>
	</div>
@endforeach	
</div>








@endsection