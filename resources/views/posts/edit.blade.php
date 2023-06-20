@extends('layouts.app')

@section('title', 'Update Post')

@section('content')
    @include('posts.partials.form', [
        'action' => route('posts.update', $post),
        'post' => $post,
    ])
@endsection
