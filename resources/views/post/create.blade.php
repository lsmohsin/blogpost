
<x-app-layout>
    <x-slot name="header">

    </x-slot>

    <div class="container mt-5">
        <a href="{{ route('post.index') }}" class="btn btn-primary" style="float: right;"> Back</a>

        <h1>Create a New Blog Post</h1>

        <form method="POST" action="{{ route('post.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <!-- Title Input -->
                <div class="col-md-6 mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" placeholder="Enter the title" value="{{ old('title') }}">

                    @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Tags Dropdown -->
                <div class="col-md-6 mb-3">
                    <label for="tags" class="form-label">Tags</label>
                    <select class="form-select @error('tags') is-invalid @enderror" aria-label="Tags" name="tags[]" multiple>
{{--                        <option selected>Select Tags</option>--}}

                        @foreach($tags as $tag)
                            <option value="{{ $tag['id'] }}" {{ in_array($tag['id'], old('tags', [])) ? 'selected' : '' }}>{{ $tag['name'] }}</option>
                        @endforeach
                    </select>

                    @error('tags')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            <!-- Content Textarea -->
            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="5" placeholder="Enter the content">{{ old('content') }}</textarea>

                @error('content')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            @can('create-tag')
            <div class="col-md-6 mb-3">
                <label for="tags" class="form-label">Tags</label>
                <div id="tags-container">
                    <input type="text" class="form-control" id="tagInput" placeholder="Enter tag">
                    <button type="button" class="btn btn-success" onclick="addTag()">Add Tag</button>
                </div>

                @error('tags')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
             @endcan
            <!-- Image Input -->
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>


            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary" style="color: #1a202c">Submit</button>
        </form>
    </div>


</x-app-layout>
<style>
    /* Custom CSS to remove hover effect on the button */
    .btn-primary:hover {
        background-color: #2563eb; /* Set the background color to the normal state color */
    }
    .btn-primary{
        background: #2563eb;
    }

         /* Custom CSS for container and form */
     .container {
         max-width: 1000px;
         margin: auto; /* Center the container horizontally */
         padding: 20px; /* Add padding for spacing */
         border: 1px solid #dee2e6; /* Add border around the container */
         border-radius: 10px; /* Optional: Add border radius for rounded corners */
     }

    /* Centered and Styled Heading */
    h1 {
        text-align: center;
        font-weight: bold;
        font-size: 30px;
        color: #007bff;
    }

</style>
<script>
    function addTag() {
        var tagInput = document.getElementById('tagInput');
        var tagContainer = document.getElementById('tags-container');

        if (tagInput.value.trim() !== "") {
            var tagElement = document.createElement('div');
            var tagName = tagInput.value.trim();
            tagElement.innerHTML = '<input type="hidden" name="tags[]" value="' + tagName + '">' + tagName + ' <button type="button" class="btn btn-danger btn-sm" onclick="removeTag(this)">Remove</button>';
            tagContainer.appendChild(tagElement);
            tagInput.value = "";
        }
    }

    function removeTag(element) {
        element.parentNode.remove();
    }
    $(document).ready(function() {
        $('select[name="tags\[\]"]').select2();
    });
</script>
