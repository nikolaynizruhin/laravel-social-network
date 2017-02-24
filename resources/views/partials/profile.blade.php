<div class="panel panel-default">
    <div class="panel-body">
        <img src="/uploads/avatars/{{ $user->avatar }}" class="img-responsive" alt="Responsive image">
        <br>
        <p>{{ $user->name }}</p>
        <p><a href="/{{ $user->username }}">{{ '@' . $user->username }}</a></p>
        <p><i class="fa fa-link" aria-hidden="true"></i> <a href="{{ $user->website }}">Website</a></p>
        <p><i class="fa fa-map-marker" aria-hidden="true"></i> {{ $user->location }}</p>
        <p><i class="fa fa-birthday-cake" aria-hidden="true"></i> {{ $user->birthday }}</p>
        <p><i class="fa fa-calendar" aria-hidden="true"></i> {{ $user->created_at }}</p>
    </div>
</div>