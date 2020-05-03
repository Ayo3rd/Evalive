@extends('layouts.main')

@section('title', 'Course: ')

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

<hr>

<div class="row d-flex justify-content-center mb-100">
    <div class="col-lg-10">
        <div class="card">
            <div class="card-body text-center">
                <h3 class="card-title">{{$course->name}}  Evaluations</h3>
            </div>
            <div class="comment-widgets">
                <!-- Comment Row -->
                @foreach($evaluations as $evaluation)    
                    <div class="d-flex flex-row comment-row m-t-0">
                        <div class="p-2">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcTTEs7hkRjepFxvSDgOCOzRdwtDjqVExI4cBXn1RJ6VThdn-ObJ&usqp=CAU" alt="user" width="50" class="rounded-circle">
                        </div>
                        <div class="comment-text w-100">
                            <h6 class="font-medium redFont">
                                @if($evaluation->student_id == $user->id)
                                    *My Evaluation
                                @endif
                            </h6> 
                            <span class="m-b-15 d-block">{{$evaluation->evaluation}}</span>
                            <div class="comment-footer"> 
                                @if($evaluation->edited)
                                <p class="greenFont text-muted float-right">(Edited)
                                </p>
                                @endif
                            	<span class="text-muted float-right">{{date_format(date_create($evaluation->updated_at),'h:i A | M, j Y')}}
                                </span> 
                                <div class="reaction like">
                                    <a>
                                        <i class="fa fa-thumbs-o-up"></i>  Like
                                        <input class="qty1" name="qty1" readonly="readonly" type="text" value="0" />
                                    </a>
                                </div>
                                <div class="reaction dislike">
                                    <a>
                                        <i class="fa fa-thumbs-o-down"></i> Dislike 
                                        <input class="qty2"  name="qty2" readonly="readonly" type="text" value="0" />
                                    </a>
                                </div>    
                       		</div>
                        </div>
                    </div> <!-- Comment Row -->   
                    <hr>
                @endforeach              
            </div> <!-- Card -->
        </div>
    </div>
</div>

@endsection