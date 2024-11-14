@extends('layouts.app')

@section('content')
    <course-create :categories="{{ $categories }}"></course-create>
@endsection
