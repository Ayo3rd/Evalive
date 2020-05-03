@extends('layouts.main')

@section('title', 'About EvaLive')


@section('content')



<div class=" topRow row  mt-100">
    <div class="col-6"></div>
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

<h1>About EvaLive</h1>

  
<h2>Question 1: What is the goal of your application?</h2>
<p>
  The goal of this application will be to give realtime reactions to classes by students. It will be a form of progressive course evaluation. Instead of end of the semester poll, students will keep passing anonymous critiques and positive reinforcement to Professor and all teaching staff. Will also help struggling students see others in the same boat.
</p>

<h2>Question 2: Who is the primary audience?</h2>
<p>Primary audience are college students and professors</p>

<h2>Question 3: What will the CRUD operations be?</h2>
<ul>
  <li>Create: Students can anonymously create Evaluations</li>
  <li>Read: Can be read by any user logged in</li>
  <li>Update: Student can go back and change evaluation statement</li>
  <li>Delete: Student can delete evaluations for whatever reason</li>  
</ul>

 


<h2>Question 4: What additional feature would you like to build?</h2>
<p>Students can like (co-sign) comments to show agreement or dislike for disagreement.</p>




@endsection
















