<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller {
    public function index() {
        $comments = Comment::where( 'parent_id', null )->latest()->paginate( 10 );
        return view( 'comment.index', compact( 'comments' ) );
    }

    public function store( Request $request ) {
        // dd($request->all());
        $postId = $request->post_id;
        Comment::insert( [
            'user_id'    => Auth::user()->id,
            'post_id'    => $postId,
            'parent_id'  => null,
            'comment'    => $request->comment,
            'status'     => '0',
            'created_at' => Carbon::now(),
        ] );

        return redirect()->back()->with( 'success', 'Comment send successfully!' );
    }

    public function AdminCommentReply( $id ) {
        $comment = Comment::where( 'id', $id )->first();
        return view( 'comment.replay_comment', compact( 'comment' ) );
    }

    public function CommentReplay( Request $request ) {
        // dd($request->all());

        $id = $request->id;
        $user_id = $request->user_id;
        $post_id = $request->post_id;

        Comment::insert( [
            'user_id'    => $user_id,
            'post_id'    => $post_id,
            'parent_id'  => $id,
            'comment'    => $request->comment,
            'status'     => '0',
            'created_at' => Carbon::now(),
        ] );

        return redirect()->back()->with( 'success', 'Comment replay successfully!' );
    }

    public function changeStatus( Request $request ) {
        $comment = Comment::find( $request->comment_id );

        $comment->status = $request->status;
        $comment->save();
    }

    public function destroy( Comment $comment ) {

        $comment->delete();

        return redirect()->route( 'comment.index' )->with( 'success', 'Comment deleted successfully!' );
    }
}
