<!-- resources/views/package/index.blade.php -->

<h1>List Page</h1>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
<a href="{{ route('user.create') }}" class="btn btn-primary">Create User</a>

<table class="table mt-3">
    <thead>
    <tr>
        <th>Name</th>
        <th>Email</th>

        <th>Image</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)

        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>

            <td>
                @if($user->image)
                    <img src="{{ asset('storage/' . $user->image) }}" alt="User Image" style="width: 50px; height: 40px">
                @else
                    No Image
                @endif
            </td>

            <td>
                <a href="{{ route('package.user.edit', $user->id) }}" class="btn btn-info">Edit</a>
                <form action="{{ route('package.user.destroy', $user->id) }}" method="post" class="d-inline">
                    @csrf
                    @method('delete') <!-- Use the DELETE method for deletion -->
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
                <a href="{{ route('package.user.show', $user->id) }}" class="btn btn-primary">View</a>
            </td>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

