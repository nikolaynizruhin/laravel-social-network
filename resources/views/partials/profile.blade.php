<div class="panel panel-default">
    <div class="panel-body">
        <img src="/uploads/avatars/{{ $user->avatar }}" class="img-responsive" alt="Responsive image">
        @if(Auth::user() == $user)
            <form enctype="multipart/form-data" action="/profile" method="POST">
                {{ csrf_field() }}
                <label>Update Profile Image</label>
                <input type="file" name="avatar">
                <input type="submit" value="Update" class="pull-right btn btn-xs btn-default">
            </form>
        @else
            <br>
            @if($user->followers->contains(Auth::user()))
                <form method="post" action="{{ url('follows/' . $user->username) }}">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button type="submit" class="btn btn-default btn-block">Unfollow</button>
                </form>
            @else
                <form method="post" action="{{ url('follows/' . $user->username) }}">
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-primary btn-block">Follow</button>
                </form>
            @endif
        @endif
        <br>
        <div class="btn-group btn-group-justified btn-group-sm" role="group" aria-label="...">
            <a type="button" class="btn btn-default" href="{{ url($user->username) }}">Posts<br>{{ $user->posts->count() }}</a>
            <a type="button" class="btn btn-default">Followees<br>{{ $user->followees->count() }}</a>
            <a type="button" class="btn btn-default">Followers<br>{{ $user->followers->count() }}</a>
        </div>
        <p>{{ $user->name }}</p>
        <p><a href="/{{ $user->username }}">{{ '@' . $user->username }}</a></p>
        <p><i class="fa fa-link" aria-hidden="true"></i> <a href="{{ $user->website }}">Website</a></p>
        <p><i class="fa fa-map-marker" aria-hidden="true"></i> {{ $user->location }}</p>
        <p><i class="fa fa-birthday-cake" aria-hidden="true"></i> {{ \Carbon\Carbon::parse($user->birthday)->format('j F Y') }}</p>
        <p><i class="fa fa-calendar" aria-hidden="true"></i> {{ \Carbon\Carbon::parse($user->created_at)->format('F Y') }}</p>
    </div>
</div>