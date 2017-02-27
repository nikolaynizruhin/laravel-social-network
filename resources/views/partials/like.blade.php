<p>
    <a href="{{ url('posts/' . $post->id . '/like') }}">
        <i class="fa fa-heart" aria-hidden="true"></i>
    </a>
    {{ $post->likes()->count() }}
</p>
