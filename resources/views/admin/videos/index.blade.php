@extends('layouts.app')

@section('content')
    <video-manager :course="{{ $course }}" :categories="{{ $categories }}"></video-manager>
@endsection
