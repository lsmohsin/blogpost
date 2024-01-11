<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
{{--            @foreach($tags as $tag)--}}
{{--                {{ $tag->name }}--}}
{{--            @endforeach--}}
        </h2>
    </x-slot>
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    @if(session('welcome_email_sent'))
        <div class="alert alert-success">
            Welcome email sent successfully!
        </div>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    You're logged in!


                    <a href="{{ route('post.index') }}" class="btn btn-primary" style="float: right;"> BlogPost List</a>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<style>
    .custom-button {
        padding: 10px 20px;
        background-color: #3498db;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        float: right;
    }

    .custom-button:hover {
        background-color: #2980b9;
    }

</style>
