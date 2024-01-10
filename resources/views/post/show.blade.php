<x-app-layout>
    <x-slot name="header">
    </x-slot>
    <div class="container mt-4">
        <div class="mt-3">
            <strong>Post Views:</strong> {{ $post['view_count'] }}
        </div>
        <div class="card">

            <div class="card-body">
                <label for="title">Title:</label>
                <h2 class="card-title">{{$post['title']}}</h2>

                <label for="content">Content:</label>
                <p class="card-subtitle text-muted">{{$post['content']}}</p>

                <label for="image">Image:</label>
                <div class="card-text">
                    <img src="{{ asset($post['image']) }}" class="card-img-top" alt="Post Image" style="max-width: 80px; max-height: 70px;">
                </div>

                <label for="tags">Tags:</label>
                @foreach($post['tags'] as $tag)
                    <h3 class="card-title">{{ $tag->name }}</h3>
                    @if (!$loop->last)
                        ,
                    @endif
                @endforeach
            </div>
        </div>

    </div>
</x-app-layout>

