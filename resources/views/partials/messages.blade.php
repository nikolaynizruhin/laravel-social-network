<div class="panel panel-default">
    <div class="panel-heading">{{ Request::is('inbox*') ? 'Inbox' : 'Outbox' }} Messages</div>

    <div class="panel-body">
        @foreach($messages as $message)
            <div class="media">
                <div class="media-left">
                    <a href="{{ url($message->from->username) }}">
                        <img class="media-object" src="uploads/avatars/{{ $message->from->avatar }}" alt="avatar" style="width: 64px; height: 64px;">
                    </a>
                </div>
                <div class="media-body">
                    <h4 class="media-heading">
                        <small>From</small>
                        <a href="{{ url($message->from->username) }}">
                            <small>
                                {{ '@' . $message->from->username }}
                            </small>
                        </a>
                        <small>to</small>
                        <a href="{{ url($message->to->username) }}">
                            <small>
                                {{ '@' . $message->to->username }}
                            </small>
                        </a>
                        <small>
                            &bull; {{ $message->created_at->diffForHumans() }}
                        </small>
                    </h4>
                    {!! $message->body !!}
                </div>
            </div>
            @if($messages->last() != $message)
                <hr>
            @endif
        @endforeach
    </div>
</div>