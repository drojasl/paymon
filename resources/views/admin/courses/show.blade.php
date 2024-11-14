@extends('layouts.app')

@section('content')
    <course :course="{{ $course }}" :users="{{ $users }}"></course>
@endsection
