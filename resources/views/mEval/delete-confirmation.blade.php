@extends('layouts.main')

@section('title', 'Delete Evaluation')

@section('content')
    <form class="mt-100" action="/myEvaluations/{{$evaluation->id}}/delete" method="POST">
        @csrf
        <h4>Are you sure you want to delete your {{$evaluation->course_name}} evaluation?</h4>
        <a href="/myEvaluations" class="btn-primary btn btn-default">Cancel</a>
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
@endsection