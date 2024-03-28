<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\Comment;
use App\Models\Tag;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ApiPostController extends Controller
{

    public function store(Request $request)
    {
//       return auth()->id();
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads', 'public');
        }
        // Create the post
        $post = Post::create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'user_id' => auth()->id(),
            'image' => $imagePath ?? null,
        ]);

        // Attach tags to the post
        $tags = $request->input('tags', []);
        foreach ($tags as $tagName) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $post->tags()->attach($tag);
            
        }
        return response()->json(['post' => $post]);

    }
    public function index()
    {
        $tags = Tag::all();
        // return $tags;
        return response()->json(['data' => $tags]);
    }
    public function allposts()
    {
        
        $posts = Post::with('tags')->paginate(2);
        
        return response()->json(['posts' => $posts]);
    }
    public function delete($id)
    {
        try {
            $post = Post::findOrFail($id);
            $post->tags()->detach(); 
            $post->delete();

            return response()->json(['success' => true, 'message' => 'Post deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
    public function bulkDelete(Request $request)
    {
      
        $postIds = $request->input('postIds');

        try {
            // Fetch posts with tags
            $posts = Post::whereIn('id', $postIds)->with('tags')->get();

            // Delete the posts and detach tags
            foreach ($posts as $post) {
                $post->tags()->detach(); 
                $post->delete();
            }

            return response()->json(['message' => 'Bulk delete successful'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete posts'], 500);
        }
    }
    
    public function showPostDetails($postId)
    {
        
        $post = Post::with('tags')->find($postId);

        return response()->json(['post' => $post]);
    }
    public function edit($postId)
    {
        
        $post = Post::with('tags')->find($postId);

        return response()->json(['post' => $post]);
    }
    public function update(Request $request, $postId)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            // 'tags' => 'array', 
            
        ]);
    
        
        $post = Post::find($postId);
    
      
        $post->update([
            'title' => $validatedData['title'],
            'content' => $validatedData['content'],
        ]);
    
    
        // $post->tags()->sync($validatedData['tags']);
    
        return response()->json(['message' => 'Post updated successfully']);
    }
    
    public function search($searchpost)
    {
        $results = Post::where('title', 'like', '%' . $searchpost . '%')->paginate(2);
       
    return response()->json(['posts' => $results]);
    }
    
    
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }
    
    
   

    public function storeComment(Request $request, $postId)
    {
        $post = Post::findOrFail($postId);
    
        // Validate the request
        $request->validate([
            'content' => 'required|string',
        ]);
    
        // Create a new comment
        $comment = new Comment([
            'content' => $request->input('content'),
        ]);
    
        // Associate the comment with the post
        $post->comments()->save($comment);
    
        return response()->json(['message' => 'Comment added successfully']);
    }
    
    
}
