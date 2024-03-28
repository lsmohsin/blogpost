<x-app-layout>
    <x-slot name="header">
    </x-slot>
    <p style="text-align: center; color: #2563eb; font-weight: bold">(This name show using accessor functionality)</p>
    <h1>Welcome, {{ auth()->user()->display_name }}</h1>
    <div class="container mt-5">
        <h1>List of Posts</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @can('create-post')
            <a href="{{ route('post.create') }}" class="btn btn-primary">Add Blog Post</a>
        @endcan
        <div class="table-responsive">
            <input type="text" id="searchInput" class="form-control" placeholder="Search posts...">

            @role('admin')

            <form method="get" action="{{ route('post.index') }}" class="form-inline">
                <div class="form-group mb-2">
                    <label for="tags" class="mr-2">Select Tags:</label>
                    <select id="tags" name="tags[]" class="form-control" multiple>
                        @foreach($allTags as $tag)
                            <option value="{{ $tag->id }}" @if(in_array($tag->id, $tagIds)) selected @endif>{{ $tag->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary mb-2">Apply Filter</button>
            </form>


            <table class="table table-bordered">

                <thead>
                <tr>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Image</th>
                    <th>Tags</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($posts as $post)
                    <tr>
                        <td>{{ \Illuminate\Support\Str::limit($post->title, 10) }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($post->content, 10) }}</td>
                        <td>
                            <img src="{{ Storage::url($post->image) }}" alt="Image" style="max-width: 50px; max-height: 40px;">
                        </td>
                        <td>
                            @foreach($post->tags as $tag)
                                {{ $tag->name }}
                                @if (!$loop->last)
                                    ,
                                @endif
                            @endforeach
                        </td>
                        <td>
                            <a href="{{ route('post.show', $post->id) }}" class="btn btn-primary">View</a>
                            <a href="{{ route('post.edit', $post->id) }}" class="btn btn-primary">Editff</a>

                            <form action="{{ route('post.destroy', ['post' => $post->id]) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            @endrole

            @role('member')

            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Image</th>
                    <th>Tags</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($posts->where('user_id', Auth::id()) as $post)
                    <tr>
                        <td>{{ \Illuminate\Support\Str::limit($post->title, 10) }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($post->content, 10) }}</td>
                        <td>
                            <img src="{{ Storage::url($post->image) }}" alt="Image" style="max-width: 50px; max-height: 40px;">
                        </td>
                        <td>
                            @foreach($post->tags as $tag)
                                {{ $tag->name }}
                                @if (!$loop->last)
                                    ,
                                @endif
                            @endforeach
                        </td>
                        <td>
                            <a href="{{ route('post.show', $post->id) }}" class="btn btn-primary">View</a>
                            <!-- You can add more member-specific actions here if needed -->
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            @endrole

            <a href="{{ route('export.posts') }}" class="btn btn-success">Export to CSV</a>
            <div class="d-flex justify-content-end">
{{--                {{ $posts->links('pagination::bootstrap-4') }}--}}
{{--                {{ $posts->links() }}--}}
            </div>
        </div>
    </div>


</x-app-layout>
<style>
    .btn-danger:hover {

        background-color: #dc3545;

    }
    .btn-danger{
        background: #dc3545;
    }
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
</style>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function () {
        // Attach an event listener to the search input
        $('#searchInput').on('input', function () {
            // Get the value from the input field
            var query = $(this).val();

            // Send an AJAX request to the search route
            $.ajax({
                type: 'GET',
                url: '/posts/search',
                data: { query: query },
                success: function (data) {
                    // Update the table with the search results
                    updateTable(data.posts);
                }
            });
        });

        // Function to update the table with search results
        function updateTable(posts) {
            var tableBody = $('table tbody');
            tableBody.empty();

            // Populate the table with search results
            $.each(posts, function (index, post) {
                var row = '<tr>' +
                    '<td>' + post.title + '</td>' +
                    '<td>' + post.content + '</td>' +

                    '<td><img src="' + post.image + '" alt="Image" style="max-width: 50px; max-height: 40px;" onerror="reloadImage(this, \'' + post.id + '\')"></td>' +
                    '<td>' + getTags(post.tags) + '</td>' +
                    '<td>' +
                    '<a href="/post/edit/' + post.id + '" class="btn btn-primary">Edit</a>' +
                    '<form action="" method="POST" style="display: inline-block;">' +
                    '@csrf' +
                    '@method("DELETE")' +
                    '<button type="submit" class="btn btn-danger" onclick="return confirm(\'Are you sure?\')">Delete</button>' +
                    '</form>' +
                    '</td>' +
                    '</tr>';
                tableBody.append(row);
            });
        }

        // Function to get tags as a comma-separated string
        function getTags(tags) {
            var tagString = '';
            $.each(tags, function (index, tag) {
                tagString += tag.name;
                if (index < tags.length - 1) {
                    tagString += ', ';
                }
            });
            return tagString;
        }
        $('#tags').select2();
    });








</script>


