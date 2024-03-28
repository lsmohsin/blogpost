<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

<div class="container">
    <h1 class="text-center">User Profile</h1>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $user->name }}</div>

                <div class="card-body">
                    <p>Email: {{ $user->email }}</p>
                    <p>Image:</p>
                    @if($user->image)
                        <img src="{{ asset('storage/' . $user->image) }}" alt="User Image" style="max-width: 100px; max-height: 100px;">
                    @else
                        No Image
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
