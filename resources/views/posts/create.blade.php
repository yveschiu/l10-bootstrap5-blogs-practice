@extends('layouts.app')

@section('title', 'Create Post')


@section('content')
    @include('posts.partials.form', [
        'action' => route('posts.store'),
    ])
@endsection
