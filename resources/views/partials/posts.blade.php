<div class="panel panel-default">
    <div class="panel-heading">
        <div class="media">
            <div class="media-left">
                <a href="{{ url($user->username) }}">
                    <img class="media-object" src="uploads/avatars/{{ $user->avatar }}" alt="avatar" style="width: 64px; height: 64px;">
                </a>
            </div>
            <div class="media-body">
                <form method="post" action="/posts">
                    {{ csrf_field() }}
                    <div class="form-group {{ $errors->has('body') ? ' has-error' : '' }}">
                        <textarea name="body" class="form-control" rows="3" placeholder="What's New?" required autofocus>{{ old('body') }}</textarea>

                        @if ($errors->has('body'))
                            <span class="help-block">
                                <strong>{{ $errors->first('body') }}</strong>
                            </span>
                        @endif
                    </div>
                    <button type="submit" class="pull-right btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>

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