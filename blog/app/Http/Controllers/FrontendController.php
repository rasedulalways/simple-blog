<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function BlogDetails($id){
        $post = Post::where('status','active')->where('id',$id)->first();
        // dd($post);
        return view('blog_details',compact('post'));
    }
}
