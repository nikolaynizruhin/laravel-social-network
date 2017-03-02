<div class="panel panel-default">
    <div class="panel-heading">{{ Request::is('inbox*') ? 'Inbox' : 'Outbox' }} Messages</div>

    <div class="panel-body">
        <div class="media">
            <div class="media-left">
                <a href="{{ url($user->username) }}">
                    <img class="media-object" src="uploads/avatars/{{ $user->avatar }}" alt="avatar" style="width: 64px; height: 64px;">
                </a>
            </div>
            <div class="media-body">
                <form method="post" action="/messages">
                    {{ csrf_field() }}
                    <div class="form-group {{ $errors->has('to') ? ' has-error' : '' }}">
                        <select name="to" class="form-control">
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->username }}</option>
                            @endforeach
                        </select>

                        @if ($errors->has('to'))
                            <span class="help-block">
                                    <strong>{{ $errors->first('to') }}</strong>
                                </span>
                        @endif
                    </div>

                    <div class="form-group {{ $errors->has('body') ? ' has-error' : '' }}">
                        <textarea name="body" class="form-control" rows="3" placeholder="Enter your message..." required autofocus>{{ old('body') }}</textarea>

                        @if ($errors->has('body'))
                            <span class="help-block">
                                    <strong>{{ $errors->first('body') }}</strong>
                                </span>
                        @endif
                    </div>
                    <button type="submit" class="pull-right btn btn-primary">Send</button>
                </form>
            </div>
        </div>
        <hr>
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