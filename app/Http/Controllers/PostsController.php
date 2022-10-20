<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comments;
use App\Models\Posts;
use Illuminate\Support\Facades\Auth;
use App\Events\NewPost;
use Inertia\Inertia;
use App\Models\User;

class PostsController extends Controller
{
    public function posts(Request $request)
    {
        return Posts::all();
    }
    public function comments(Request $request)
    {
        $comments = Comments::where('post_id',$request->post_id)->get();
        return $comments;
    }
    public function getCommentById($post_id, $id)
    {
        $comments = Comments::where([['post_id',$post_id],['id',$id]])->first();
        return $comments;
    }
    public function getUserById($id)
    {
        $user = User::find($id)->first();
        return $user;
    }
    public function createComment(Request $request)
    {
        $comment = new Comments;
        $comment->user_id =$request->user_id;
        $comment->post_id =$request->post_id;
        $comment->reply_id =$request->reply_id;
        $comment->description = $request->description;
        $comment->save();
        $post = Posts::where('id',$request->post_id)->first();
        $post->comments_count++;

        $post->update();
        return $comment;
    }
    public function createPost(Request $request)
    {
        $post = new Posts;
        $post->user_id = $request->user_id;
        $post->title = $request->title;
        $post->description = $request->description;
        $post->save();
        return response()->json([
            'post' => $post,
        ]);
   }
   public function getPost($postId)
   {
       $post = Posts::find($postId);
       return Inertia::render('Forum/Posts/postPage', ['post' => $post]);
   }

}
