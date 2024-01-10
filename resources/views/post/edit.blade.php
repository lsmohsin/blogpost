<!-- resources/views/post/edit.blade.php -->
<x-app-layout>
    <x-slot name="header">
    </x-slot>
    <div class="centered-container">
        <h1>This data shows as  Blade component "Post Detail "</h1>
        <div class="post-container">
            <x-post-details :post="$post" />

        </div>
    </div>


    <div class="container mt-5">
        <h2>Tag list data show via view Composer</h2>
        <table>
            <thead>
            <tr>
                <th>ID</th>

                <th> :Tag Name</th>
            </tr>
            </thead>
            <tbody>
            @forelse($tags as $tag)
                <tr>
                    <td>{{ $tag->id }}:</td>
                    <td>{{ $tag->name }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="2">No tags available.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
        <h1>Edit Post</h1>


        <form method="POST" action="{{ route('post.update', $post->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Title Input -->
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $post->title) }}">
                @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Tags Dropdown -->
            <div class="mb-3">
                <label for="tags" class="form-label">Tags</label>
                <select class="form-select @error('tags') is-invalid @enderror" aria-label="Tags" name="tags[]" multiple>
                    @foreach($tags as $tag)
                        <option value="{{ $tag->id }}" {{ in_array($tag->id, old('tags', $post->tags->pluck('id')->toArray())) ? 'selected' : '' }}>
                            {{ $tag->name }}
                        </option>
                    @endforeach
                </select>
                @error('tags')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">

                <!-- Display current image if it exists -->
                @if ($post->image)
                    <div class="mt-2">
                        <img src="{{ Storage::url($post->image) }}" alt="Image" style="max-width: 100px; max-height: 80px;">

{{--                        <img src="{{ asset($post->image) }}" alt="Current Image" style="max-width: 200px;">--}}
                    </div>
                @endif

                @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Content Textarea -->
            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="5">{{ old('content', $post->content) }}</textarea>
                @error('content')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</x-app-layout>
<style>
    .btn-primary:hover {
        background-color: #2563eb; /* Set the background color to the normal state color */
    }
    .btn-primary{
        background: #2563eb;
    }
    h1 {
        text-align: center;
        font-weight: bold;
        font-size: 30px;
        color: #007bff;
    }
    h2 {
        text-align: left;
        font-weight: bold;
        font-size: 30px;
        color: #007bff;
    }
    .centered-container {
        display: flex;
        flex-direction: column; /* Stack items vertically */
        align-items: center;
    }

    h1 {
        margin-bottom: 20px; /* Adjust the margin as needed */
    }

    .post-container {
        border-left: 2px solid #ccc; /* Change the color as needed */
        padding-left: 20px; /* Adjust the padding as needed */
    }
</style>
<script>
    $(document).ready(function() {
        // Apply Select2 to your dropdown
        $('select[name="tags\[\]"]').select2();
    });
</script>
