<div class="panel panel-default">
    <div class="panel-body">
        @foreach($posts as $post)
            <div class="media">
                <div class="media-left">
                    <a href="{{ url($post->user->username) }}">
                        <img class="media-object" src="uploads/avatars/{{ $post->user->avatar }}" alt="avatar" style="width: 64px; height: 64px;">
                    </a>
                </div>
                <div class="media-body">
                    <h4 class="media-heading">
                        <a href="{{ url($post->user->username) }}">
                            {{ $post->user->name }}
                            <small>
                                {{ '@' . $post->user->username }}
                            </small>
                        </a>
                        <small>
                            &bull; {{ $post->created_at->diffForHumans() }}
                        </small>
                    </h4>
                    {!! $post->body !!}
                    @include('partials.like')
                </div>
            </div>
            @if($posts->last() != $post)
                <hr>
            @endif
        @endforeach
    </div>
</div>