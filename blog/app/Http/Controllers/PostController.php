<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('category','user')->orderBy( 'id', 'desc' )->paginate( 5 );
        return view( 'post.index', compact( 'posts' ) );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $all_tags = Tag::all();
        $categories = Category::all();
        return view( 'post.create', compact('categories','all_tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd( $request->all() );

        $request->validate([
            'category_id' => 'required',
            'title' => 'required',
            'content' => 'required',
            'thumbnail' => 'required|mimes:png,jpg,jpeg,webp',
            'tag_id' => 'required',
        ]);

        $tagId = implode("," , $request->tag_id);

        if($image = $request->file('thumbnail')){
            $file_name = hexdec( uniqid() ) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->save('uploads/'.$file_name);
        }

        Post::create([
            'category_id' => $request->category_id,
            'user_id' => Auth::user()->id,
            'tag_id' => $tagId,
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content'=> $request->content,
            'status' => $request->status,
            'thumbnail' => $file_name,
        ]);

        return redirect()->route( 'post.index' )->with( 'success', 'Post created successfully!' );

    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $all_tags = Tag::all();
        $categories = Category::all();
        $post_tag = explode( ',', $post->tag_id );

        return view('post.edit',compact('post','categories','all_tags','post_tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $request->validate( [
            'category_id' => 'required',
            'title'       => 'required|unique:posts,title,' . $post->id,
            'content'     => 'required',
            'thumbnail'   => 'required|mimes:png,jpg,jpeg,webp',
            'tag_id'      => 'required',
        ] );

        $tagId = implode( ",", $request->tag_id );

        if ( $image = $request->file( 'thumbnail' ) ) {
            unlink(public_path('uploads/'.$post->thumbnail));
            $file_name = hexdec( uniqid() ) . '.' . $image->getClientOriginalExtension();
            Image::make( $image )->save( 'uploads/' . $file_name );
        }

        Post::findOrFail($post->id)->update( [
            'category_id' => $request->category_id,
            'user_id'     => Auth::user()->id,
            'tag_id'      => $tagId,
            'title'       => $request->title,
            'slug'        => Str::slug( $request->title ),
            'content'     => $request->content,
            'status'      => $request->status,
            'thumbnail'   => $file_name,
        ] );

        return redirect()->route( 'post.index' )->with( 'success', 'Post created successfully!' );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        unlink( public_path( 'uploads/' . $post->thumbnail ) );

        $post->delete();

        return redirect()->route( 'post.index' )->with( 'success', 'Post deleted successfully!' );
    }
}
