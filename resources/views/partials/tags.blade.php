<div class="panel panel-default">
    <div class="panel-heading">Trends tags</div>

    <div class="panel-body">
        @foreach($tags as $tag)
            <p><a href="{{ Request::is('tags/*') ? '../' : '' }}tags/{{ $tag->id }}">#{{ $tag->name }}</a></p>
        @endforeach
    </div>
</div>