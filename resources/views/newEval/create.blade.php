@extends('layouts.main')

@section('title', 'New Evaluation Form')


@section('content')
    <h1 class="mt-100">New Evaluation Form</h1>

    <form method="post" action="/NewEvaluation">
        @csrf

       <div class="form-group">
            <label for="course">Course</label>
            <select name="course" id="course" class="form-control">
                <option value="">-- Select Course --</option>
                @foreach($courses as $course)
                    <option 
                    value="{{$course->courseId}}"
                    {{$course->courseId === old('course') ? "selected" : ""}}>
                        {{$course->courseName}}
                    </option>
                @endforeach
            </select>
            @error('course')
                <small class="text-danger">{{$message}}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="evaluation">Evaluation</label>
            <textarea 
            type="text" 
            id="evaluation" 
            name="evaluation" 
            class="form-control">{{old('evaluation')}}</textarea>
            @error('evaluation')
                <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
        <input type="submit" value="Submit" class="btn btn-primary">
    </form>
@endsection