<?php

namespace App\Http\Controllers;

use App\Facades\UploadFileFacade;
use App\Services\UploadFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use League\Csv\Writer;
use App\Http\Resources\PostCollection;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests\StorePostRequest;
use App\Events\PostViewed;


class PostController extends Controller
{
    public function create()
    {

        $tags= Tag::all();
        return view('post.create',compact('tags',));
    }

    public function index(Request $request)
    {
        $tagIds = $request->input('tags',[]); // Assuming you're getting tag IDs from the request

        $posts = Cache::remember('posts', 10, function () use ($tagIds) {
            return Post::when($tagIds, function ($query) use ($tagIds) {
                return $query->filterByTags($tagIds);
            })->orderBy('created_at', 'desc')->get();
        });
        $allTags = Tag::all(); // Assuming you have a Tag model

        return view('post.index', compact('posts', 'allTags','tagIds'));

    }
//    public function store(StorePostRequest $request)
//    {
//        $user = Auth::user();
//
//        // Check if the user has the necessary permissions for post creation
//        if (
//            \Gate::allows('create-post') &&
//            \Gate::allows('edit-post') &&
//            \Gate::allows('delete-post') &&
//            \Gate::allows('view-post')
//        ) {
//            $imagePath = UploadFileFacade::upload($request->file('image'));
//            $userId = $user->id;
//
//            $post = Post::create([
//                'title' => $request->input('title'),
//                'content' => $request->input('content'),
//                'user_id' => $userId,
//                'image' => $imagePath,
//            ]);
//
//            $tagIds = [];
//
//            foreach ($request->tags as $tagName) {
//                $tagModel = Tag::firstOrCreate(['name' => $tagName]);
//                $tagIds[] = $tagModel->id;
//            }
//
//            $post->tags()->attach($tagIds);
//
//            return redirect()->route('post.index')->with('success', 'Post created successfully.');
//        } else {
//            // Redirect or show an error message
//            return redirect()->route('dashboard')->with('error', 'You do not have permission to perform this action.');
//        }
//    }
    public function store(StorePostRequest $request)
    {

      //dd($request->all());

        $imagePath = UploadFileFacade::upload($request->file('image'));
        $userId = Auth::id();
        $post = Post::create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'user_id' => $userId,
            'image' =>$imagePath,
        ]);
        $tagIds = [];

        foreach ($request->tags as $tagName) {
            $tagModel = Tag::firstOrCreate(['name' => $tagName]);
            $tagIds[] = $tagModel->id;
        }


        $post->tags()->attach($tagIds);


        return redirect()->route('post.index')->with('success', 'Post created successfully.');
    }
    public function destroy($id)
    {

        $post = Post::findOrFail($id);

        $post->tags()->detach();

        $post->delete();
        \Log::info("Post Deleted: {$id}");
        return redirect()->route('post.index')->with('success', 'Post deleted successfully.');
    }
    public function edit(Request $request, $id)
    {
        $post = Post::find($id);
        $tags = Tag::all();


        return view('post.edit', compact('post', 'tags'));
    }

    public function show(Request $request, $id)
    {
        event(new PostViewed($id));
         $post =  (new \App\Http\Resources\post(Post::find($id)))->toArray($request);

        return view('post.show', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);


        if ($request->hasFile('image')) {
            $imagePath = UploadFileFacade::upload($request->file('image'));
            $post->image = $imagePath;
        }

        // Update other fields
        $post->update([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
        ]);


        $post->tags()->sync($request->tags);

        return redirect()->route('post.index')->with('success', 'Post updated successfully.');
    }
    public function search(Request $request)
    {
        $query = $request->input('query');

        $posts = Post::where('title', 'like', '%' . $query . '%')
            ->orWhere('content', 'like', '%' . $query . '%')
            ->orWhereHas('tags', function ($tagQuery) use ($query) {
                $tagQuery->where('name', 'like', '%' . $query . '%');
            })
            ->with('tags')
            ->get();

        return response()->json(['posts' => $posts]);
    }
    public function exportCsv()
    {
        $posts = Post::all();

        $csv = Writer::createFromFileObject(new \SplTempFileObject());
        $csv->insertOne(['Title', 'Content', 'Image', 'Tags']);

        foreach ($posts as $post) {
            $csv->insertOne([
                $post->title,
                $post->content,
                Storage::url($post->image),
                $post->tags->pluck('name')->implode(','),
            ]);
        }

        $csv->output('posts.csv');
    }


}
