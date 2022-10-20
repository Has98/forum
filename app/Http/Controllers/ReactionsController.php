<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comments;
use App\Models\Posts;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Reactions;

class ReactionsController extends Controller
{
    public function fetchLike(Request $request)
     {
         if ($request->type == "post") {
             $post = Posts::find($request->obj);
             return response()->json([
                 'obj' => $post,
             ]);
         }else {
             $comment = Comments::find($request->obj);
             return response()->json([
                 'obj' => $comment,
             ]);
         }
     }

     public function handleLike(Request $request)
         {
            if ($request->type == "post") {
                $post = Posts::find($request->obj);

                if (empty(Reactions::where([['post_id',$request->obj],['user_id',$request->user]])->first())) {
                    $r = new Reactions;
                    $r->user_id =$request->user;
                    $r->post_id =$request->obj;
                    if ($request->reaction==1) {
                        $value = $post->likes_count;
                        $post->likes_count = $value+1;

                        $r->like_dislike = 1;
                    }else {
                        $value = $post->dislikes_count;
                        $post->dislikes_count = $value+1;
                        $r->like_dislike = 0;
                    }
                    $r->save();

                }elseif (!empty(Reactions::where([['post_id',$request->obj],['user_id',$request->user],['like_dislike',0]])->first()) && $request->reaction==1) {
                    $r = Reactions::where([['post_id',$request->obj],['user_id',$request->user],['like_dislike',0]])->first();
                    $r->delete();
                    $value = $post->dislikes_count;
                    $post->dislikes_count = $value-1;
                    $value = $post->likes_count;
                    $post->likes_count = $value+1;
                    $r = new Reactions;
                    $r->user_id =$request->user;
                    $r->post_id =$request->obj;
                    $r->like_dislike = 1;
                    $r->save();
                }
                elseif (!empty(Reactions::where([['post_id',$request->obj],['user_id',$request->user],['like_dislike',1]])->first()) && $request->reaction==0) {
                    $r = Reactions::where([['post_id',$request->obj],['user_id',$request->user],['like_dislike',1]])->first();
                    $r->delete();
                    $value = $post->dislikes_count;
                    $post->dislikes_count = $value+1;
                    $value = $post->likes_count;
                    $post->likes_count = $value-1;
                    $r = new Reactions;
                    $r->user_id =$request->user;
                    $r->post_id =$request->obj;
                    $r->like_dislike = 0;
                    $r->save();
                }elseif (!empty(Reactions::where([['post_id',$request->obj],['user_id',$request->user],['like_dislike',1]])->first()) && $request->reaction==1) {
                    $r = Reactions::where([['post_id',$request->obj],['user_id',$request->user],['like_dislike',1]])->first();
                    $r->delete();
                    $value = $post->likes_count;
                    $post->likes_count = $value-1;
                }elseif (!empty(Reactions::where([['post_id',$request->obj],['user_id',$request->user],['like_dislike',0]])->first()) && $request->reaction==0) {
                    $r = Reactions::where([['post_id',$request->obj],['user_id',$request->user],['like_dislike',0]])->first();
                    $r->delete();
                    $value = $post->dislikes_count;
                    $post->dislikes_count = $value-1;
                 }
                 $post->save();
            } else if ($request->type == "comment") {
                $comment = Comments::find($request->id);

                if (empty(Reactions::where([['comment_id',$request->obj],['user_id',$request->user]])->first())) {
                    $r = new Reactions;
                    $r->user_id =$request->user;
                    $r->comment_id =$request->obj;
                    if ($request->reaction==1) {
                        $value = $comment->likes_count;
                        $comment->likes_count = $value+1;

                        $r->like_dislike = 1;
                    }else {
                        $value = $comment->dislikes_count;
                        $comment->dislikes_count = $value+1;
                        $r->like_dislike = 0;
                    }
                    $r->save();

                }elseif (!empty(Reactions::where([['comment_id',$request->obj],['user_id',$request->user],['like_dislike',0]])->first()) && $request->reaction==1) {
                    $r = Reactions::where([['comment_id',$request->obj],['user_id',$request->user],['like_dislike',0]])->first();
                    $r->delete();
                    $value = $comment->dislikes_count;
                    $comment->dislikes_count = $value-1;
                    $value = $comment->likes_count;
                    $comment->likes_count = $value+1;
                    $r = new Reactions;
                    $r->user_id =$request->user;
                    $r->comment_id =$request->obj;
                    $r->like_dislike = 1;
                    $r->save();
                }
                elseif (!empty(Reactions::where([['comment_id',$request->obj],['user_id',$request->user],['like_dislike',1]])->first()) && $request->reaction==0) {
                    $r = Reactions::where([['comment_id',$request->obj],['user_id',$request->user],['like_dislike',1]])->first();
                    $r->delete();
                    $value = $comment->dislikes_count;
                    $comment->dislikes_count = $value+1;
                    $value = $comment->likes_count;
                    $comment->likes_count = $value-1;
                    $r = new Reactions;
                    $r->user_id =$request->user;
                    $r->comment_id =$request->obj;
                    $r->like_dislike = 0;
                    $r->save();
                }elseif (!empty(Reactions::where([['comment_id',$request->obj],['user_id',$request->user],['like_dislike',1]])->first()) && $request->reaction==1) {
                    $r = Reactions::where([['comment_id',$request->obj],['user_id',$request->user],['like_dislike',1]])->first();
                    $r->delete();
                    $value = $comment->likes_count;
                    $comment->likes_count = $value-1;
                }elseif (!empty(Reactions::where([['comment_id',$request->obj],['user_id',$request->user],['like_dislike',0]])->first()) && $request->reaction==0) {
                    $r = Reactions::where([['comment_id',$request->obj],['user_id',$request->user],['like_dislike',0]])->first();
                    $r->delete();
                    $value = $comment->dislikes_count;
                    $comment->dislikes_count = $value-1;
                 }
                 $comment->save();
            }
            return response()->json([
             'message' => 'Liked',
            ]);
     }
}
