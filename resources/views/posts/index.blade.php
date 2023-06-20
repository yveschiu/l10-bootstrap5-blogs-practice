@extends('layouts.app')

@section('title', 'Blog Posts')

@section('content')
    <div>
        @forelse ($posts as $post)
            @include('posts.partials.post')
        @empty
            <p>No blog posts yet!</p>
        @endforelse
    </div>
@endsection
