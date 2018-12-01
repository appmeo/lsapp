<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// dit is nodig om image te kunnen deleten in de de Storage area  bij een destroy van een Post/
use Illuminate\Support\Facades\Storage;

use App\Post;
//use DB;



class PostsController extends Controller
{


//////////////////////////////////////////////////////////////////////////////    
//add accescontrol to controller and allow index en show to be viewed by guests.
public function __construct()
    {
        $this->middleware('auth', ['except' => ['index','show']]);
    }

   
    
//////////////////////////////////////////////////////////////////////////////
public function index()
    {
        //$posts = Post::all();
        //return Post::where('title', 'Post Two')->get();
        //$posts = DB::select('SELECT * FROM posts');
        //$posts = Post::orderBy('title','desc')->take(1)->get();
        //$posts = Post::orderBy('title','desc')->get();

        $Posts = Post::orderBy('created_at','desc')->paginate(5);

        return view('Posts.index')->with('Posts', $Posts);
    }
  
//////////////////////////////////////////////////////////////////////////////    
public function create()
    {
        return view('posts.create');
    }
  
//////////////////////////////////////////////////////////////////////////////    
public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'cover_image' => 'image|nullable|max:1999'
        ]);

        // Handle File Upload
        if($request->hasFile('cover_image')){
            // Get filename with the extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        // Create Post
        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        $post->cover_image = $fileNameToStore;
        $post->save();
        return redirect('/posts')->with('success', 'Post Created');
    }

//////////////////////////////////////////////////////////////////////////////    
public function show($id)
    {
       $Post = Post::find($id);
       return view('Posts.show')->with('post',$Post);
    }

//////////////////////////////////////////////////////////////////////////////
public function edit($id)
    {
        $Post = Post::find($id);
       
        //check for correct user
        if(auth()->user()->id !== $Post->user_id){
            return redirect('/posts')->with('error','Unauthorized Page');
        }
        
        return view('Posts.edit')->with('post',$Post);
    }

//////////////////////////////////////////////////////////////////////////////
public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'body'  => 'required',
            'cover_image' => 'image|nullable|max:1999'
        ]);

        // Handle File Upload
        if($request->hasFile('cover_image')){
            // Get filename with the extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        }
 
        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        if($request->hasFile('cover_image')){
            $post->cover_image = $fileNameToStore;
        }
        $post->save();
 
        return redirect('/posts')->with('success', 'Post Updated');
    }

//////////////////////////////////////////////////////////////////////////////
public function destroy($id)
    {
        $post = Post::find($id);
        
        //check for correct user
        if(auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('error','Unauthorized Page');
        }

       // Als image van Post niet gelijk is aan 'noimage.jpg' dan delete image in storage
        if($post->cover_image !== 'noimage.jpg'){
                //delete image
            Storage::delete('public/cover_images/'.$post->cover_image);
        }
        
        $post->delete();
        return redirect('/posts')->with('success', 'Post Removed');
    }
}
//////////////////////////////////////////////////////////////////////////////