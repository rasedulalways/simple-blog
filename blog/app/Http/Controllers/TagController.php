<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Tag::orderBy( 'id', 'desc' )->paginate( 10 );
        return view( 'tag.index', compact( 'tags' ) );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view( 'tag.create' );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate( [
            'name' => 'required|unique:tags,name',
        ] );

        Tag::create( [
            'name' => $request->name,
            'slug' => Str::slug( $request->name ),
        ] );

        return redirect()->route( 'tag.index' )->with( 'success', 'Tag created successfully!' );
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        return view( 'tag.edit', compact( 'tag' ) );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $tag)
    {
        $request->validate( [
            'name' => 'required|unique:tags,name,' . $tag->id,
        ] );

        Tag::findOrFail( $tag->id )->update( [
            'name' => $request->name,
            'slug' => Str::slug( $request->name ),
        ] );

        return redirect()->route( 'tag.index' )->with( 'success', 'Tag updated successfully!' );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();

        return redirect()->back()->with( 'success', 'Tag deleted successfully!' );
    }
}
