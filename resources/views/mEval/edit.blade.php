@extends('layouts.main')

@section('title', 'Edit Evaluation')

@section('content')
    <h1 class="mt-100">Edit Evaluation Form</h1>

    <form action="/myEvaluations/{{$evaluation->id}}/edit" method="POST">
        @csrf
         <div class="form-group">
            <label for="course">Course</label>
            <select name="course" id="course" class="form-control">
                <option value="{{$evaluation->course_id}}">{{$evaluation->course_name}}</option>                  
            </select>           
        </div>
        @error('course')
            <small class="text-danger">{{$message}}</small>
        @enderror

        <div class="form-group">
            <label for="evaluation">Evaluation</label>
            <textarea 
            type="text" 
            id="evaluation" 
            name="evaluation" 
            class="form-control">@if(old('evaluation')){{old('evaluation')}} @else{{$evaluation->evaluation}}@endif</textarea>
            @error('evaluation')
                <small class="text-danger">{{$message}}</small>
            @enderror
        </div>



        <a href="/myEvaluations" class="btn-primary btn btn-default">Cancel</a>
        <button type="submit" class="btn btn-success">Update</button>
    </form>
@endsection