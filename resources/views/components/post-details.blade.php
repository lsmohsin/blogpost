<div>
<h2>{{ $post->title }}</h2>
<p>{{ $post->content }}</p>
    <div>
        <img src="{{ Storage::url($post->image) }}" alt="Image" style="max-width: 50px; max-height: 40px;">
    </div>
    <div>
        @foreach($post->tags as $tag)
            {{ $tag->name }}
            @if (!$loop->last)
                ,
            @endif
        @endforeach
    </div>
<!-- Add more details as needed -->
</div>
