<div class="panel panel-default">
    <div class="panel-body">
        @foreach($user->followees as $followee)
            <div class="media">
                <div class="media-left">
                    <a href="{{ url($followee->username) }}">
                        <img class="media-object" src="../uploads/avatars/{{ $followee->avatar }}" alt="avatar" style="width: 64px; height: 64px;">
                    </a>
                </div>
                <div class="media-body">
                    <h4 class="media-heading">
                        <a href="{{ url($followee->username) }}">
                            {{ $followee->name }}
                            <small>
                                {{ '@' . $followee->username }}
                            </small>
                        </a>
                    </h4>
                </div>
            </div>
            @if($user->followees->last() != $followee)
                <hr>
            @endif
        @endforeach
    </div>
</div>