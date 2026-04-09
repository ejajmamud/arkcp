<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\PostFormRequest;
use App\Posts;
use Barryvdh\Debugbar\Facade as DebugBar;

class PostsController extends Controller
{
    public function index()
    {
        //fetch 5 posts from database which are active and latest
        $posts = Posts::where('active',1)->orderBy('created_at','desc')->paginate(5);
        //page heading
        $title = 'Latest Posts';
        //return home.blade.php template from resources/views folder
        return view('blogposts')->withPosts($posts)->withTitle($title);
    }
    public function create(Request $request)
    {
        //
        return view('create');
        if ($request->user()->can_post()) {
        } else {
        return redirect('/')->withErrors('You have not sufficient permissions for writing post');
        }
    }

    public function store(PostFormRequest $request)
    {
        $post = new Posts();
        $post->title = $request->get('title');
        $post->body = $request->get('body');
        $post->slug = Str::slug($post->title);

        $duplicate = Posts::where('slug', $post->slug)->first();
        if ($duplicate) {
        return redirect('new-post')->withErrors('Title already exists.')->withInput();
        }
        
        Debugbar::info($request);
        if ($request->hasFile('file')) {

            $request->validate([
                'image' => 'mimes:jpeg,bmp,png' // Only allow .jpg, .bmp and .png file types.
            ]);

            $request->file->store('blogassets', 'public');

            
            $post->file = $request->file->hashName();
        }

        $post->author_id = $request->user()->id;
        if ($request->has('save')) {
        $post->active = 0;
        $message = 'Post saved successfully';
        } else {
        $post->active = 1;
        $message = 'Post published successfully';
        }
        Debugbar::info($post);
        $post->save();
        return redirect('/admin/create-post')->withMessage($message);
    }

    public function show($slug)
    {
        $post = Posts::where('slug',$slug)->first();
        if(!$post)
        {
        return redirect('/')->withErrors('requested page not found');
        }
        $comments = $post->comments;
        
        Debugbar::info($post);
        return view('blogsingle')->withPost($post)->withComments($comments);
    }

    public function edit(Request $request,$slug)
    {
        $post = Posts::where('slug',$slug)->first();
        if($post && ($request->user()->id == $post->author_id || $request->user()->is_admin()))
        return view('editpost')->with('post',$post);
        return redirect('/')->withErrors('you have not sufficient permissions');
    }

    public function update(Request $request)
    {
        //
        $post_id = $request->input('post_id');
        $post = Posts::find($post_id);
        if ($post && ($post->author_id == $request->user()->id || $request->user()->is_admin())) {
        $title = $request->input('title');
        $slug = Str::slug($title);
        $duplicate = Posts::where('slug', $slug)->first();
        if ($duplicate) {
            if ($duplicate->id != $post_id) {
            return redirect('edit/' . $post->slug)->withErrors('Title already exists.')->withInput();
            } else {
            $post->slug = $slug;
            }
        }

        $post->title = $title;
        $post->body = $request->input('body');

        if ($request->has('save')) {
            $post->active = 0;
            $message = 'Post saved successfully';
            $landing = 'edit/' . $post->slug;
        } else {
            $post->active = 1;
            $message = 'Post updated successfully';
            $landing = $post->slug;
        }
        $post->save();
        return redirect('/admin/blogposts')->withMessage($message);
        } else {
        return redirect('/')->withErrors('you have not sufficient permissions');
        }
    }

    public function destroy(Request $request, $id)
    {
        //
        $post = Posts::find($id);
        if($post && ($post->author_id == $request->user()->id || $request->user()->is_admin()))
        {
        $post->delete();
        $data['message'] = 'Post deleted Successfully';
        }
        else
        {
        $data['errors'] = 'Invalid Operation. You have not sufficient permissions';
        }
        return redirect('/admin/blogposts')->with($data);
    }
}
