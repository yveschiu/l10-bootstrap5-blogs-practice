<div class="border rounded mb-3">
    <h3><a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a></h3>

    <div class="mb-3">
        <a class="btn btn-primary" href="{{ route('posts.edit', $post) }}">Edit</a>
        <form class="d-inline" action="{{ route('posts.destroy', $post) }}" method="POST">
            @csrf
            @method('DELETE')
            <input class="btn btn-danger" type="submit" value="Delete">
        </form>
    </div>
</div>
