<?php

namespace Custom\Users\Http\Controllers;

use App\Facades\UploadFileFacade;
use App\Http\Controllers\Controller;
use App\Services\UploadFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use League\Csv\Writer;
use App\Http\Resources\PostCollection;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests\StorePostRequest;
use App\Events\PostViewed;
use Illuminate\Support\Facades\Route;


class UserController extends Controller
{

    public function index()
    {
        $users = User::all();

        return view('package::index', compact('users'));
    }
    public function create(){
        return view('package::create');
    }


    public function store(Request $request)
    {

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads', 'public');
        }



        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'image' => $imagePath ?? null,
        ]);


        return redirect()->route('user.index')->with('success', 'User created successfully');
    }
    public function edit($id)
    {
        $user = User::find($id);

        return view('package::edit', compact('user'));
    }
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',

        ]);


        $user->name = $request->input('name');
        $user->email = $request->input('email');

        // Update user image if provided
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads', 'public');
            $user->image = $imagePath;
        }

        $user->save();

        return redirect()->route('user.index')->with('success', 'User updated successfully');
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if ($user) {

            $user->delete();


            return redirect()->route('user.index')->with('success', 'User deleted successfully');
        }


        return redirect()->route('user.index')->with('error', 'User not found');
    }
    public function show($id)
    {
        $user = User::find($id);
        return view('package::show', compact('user'));
    }

}
