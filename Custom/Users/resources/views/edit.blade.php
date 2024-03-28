<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">


<h1>Edit User</h1>

<form action="{{ route('package.user.update', $user->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put') <!-- Use the PUT method for updates -->

    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" class="form-control" name="name" id="name" value="{{ $user->name }}" required>
    </div>

    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" name="email" id="email" value="{{ $user->email }}" required>
    </div>
    <div class="form-group">
        <label for="image">Image:</label><br>
        @if($user->image)
            <img src="{{ asset('storage/' . $user->image) }}" alt="User Image" style="max-width: 100px; max-height: 100px;"><br>
        @else
            No Image<br>
        @endif
        <input type="file" class="form-control-file" name="image" id="image">
    </div>
    <button type="submit" class="btn btn-primary">Update User</button>
</form>
