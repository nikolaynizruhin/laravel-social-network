<div class="panel panel-default">
    <div class="panel-heading">{{ $user->name }} Posts</div>

    <div class="panel-body">
        @foreach($user->posts()->latest()->get() as $post)
            <div class="media">
                <div class="media-left">
                    <a href="{{ url($user->username) }}">
                        <img class="media-object" src="uploads/avatars/{{ $user->avatar }}" alt="avatar" style="width: 64px; height: 64px;">
                    </a>
                </div>
                <div class="media-body">
                    <h4 class="media-heading">
                        <a href="{{ url($user->username) }}">
                            {{ $user->name }}
                            <small>
                                {{ '@' . $user->username }}
                            </small>
                        </a>
                        <small>
                            &bull; {{ $post->created_at->diffForHumans() }}
                        </small>
                    </h4>
                    {{ $post->body }}
                </div>
            </div>
            @if($user->posts()->latest()->get()->last() != $post)
                <hr>
            @endif
        @endforeach
    </div>
</div>