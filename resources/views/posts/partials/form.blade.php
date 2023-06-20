<form action="{{ $action }}" method="POST">
    @csrf
    @isset($post)
        @method('PUT')
    @endisset
    <div class="form-group">
        <label for="title">Title</label>
        <input class="form-control" type="text" name="title" id="title" value="{{ $post->title ?? old('title') }}">
    </div>
    @error('title')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <div class="form-group">
        <label for="content">Content</label>
        <textarea class="form-control" name="content" id="content" cols="30" rows="10">{{ $post->content ?? old('content') }}</textarea>
    </div>
    @error('content')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    @if ($errors->any())
        <div class="mb-3">
            <ul class="list-group">
                @foreach ($errors->all() as $error)
                    <li class="list-group-item list-group-item-danger">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="d-grid gap-2 mt-2">
        <input class="btn btn-primary" type="submit" value="{{ !isset($post) ? 'Create' : 'Update' }} Post">
        <a class="btn btn-secondary" href="{{ route('posts.index') }}">Cancel</a>
    </div>
</form>
