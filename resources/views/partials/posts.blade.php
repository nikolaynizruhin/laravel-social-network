<div class="panel panel-default">
    <div class="panel-heading">{{ $user->name }} Posts</div>

    <div class="panel-body">
        @foreach($user->posts as $post)
            <p>{{ $post->body }}</p>
        @endforeach
    </div>
</div>