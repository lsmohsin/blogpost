
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">


<form class="container mt-5" action="{{ route('package.user.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" class="form-control" name="name" id="name" required>
    </div>

    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" name="email" id="email" required>
    </div>

    <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" class="form-control" name="password" id="password" required>
    </div>

    <div class="form-group">
        <label for="image">Image:</label>
        <input type="file" class="form-control" name="image" id="image"  required>
    </div>

    <button type="submit" class="btn btn-primary">Create User</button>
</form>


