<div class="panel panel-default">
    <div class="panel-body">
        @foreach($user->followers as $follower)
            <div class="media">
                <div class="media-left">
                    <a href="{{ url($follower->username) }}">
                        <img class="media-object" src="../uploads/avatars/{{ $follower->avatar }}" alt="avatar" style="width: 64px; height: 64px;">
                    </a>
                </div>
                <div class="media-body">
                    <h4 class="media-heading">
                        <a href="{{ url($follower->username) }}">
                            {{ $follower->name }}
                            <small>
                                {{ '@' . $follower->username }}
                            </small>
                        </a>
                    </h4>
                </div>
            </div>
            @if($user->followers->last() != $follower)
                <hr>
            @endif
        @endforeach
    </div>
</div>