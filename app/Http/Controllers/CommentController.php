<?php

namespace App\Http\Controllers;
use App\Models\Comment;
use App\Models\User;
use App\Models\Topic;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function addComment(Request $req){

        $req->validate([
            "comment" => "required",
            "user_id" => "required",
            "topic_id" => "required",
        ]);

        $comment = $req->comment;
        $topic_id = $req->topic_id;
        $user_id = $req->user_id;

        $topic = Topic::find($topic_id);
        $user = User::find($user_id);

        if(!$user)
        {
            return response([
                "code" => 404,
                "message"=> "User not found"
            ]);
        }

        if(!$topic){    
            return response([
                "code" => 404,
                "message" => "Topic Not Found",
            ]);
        }

        if(!$topic->type == 0 ){
            return response([
            "code" => 422,
            "message" => "you can not add comment to private Topic",
            ]);
        }

        $add_comment = Comment::create(["comment" => $comment, "topic_id" => $topic_id, "user_id" => $user_id]);

        return response([
        "code" => 200,
        "message" => "Comment added successfully",
        "topic" => $add_comment
        ]);

    }

    public function deleteComment(Request $req){

        $req->validate([
            "id" => "required",
        ]);

        $id = $req->id;
        $comment = Comment::find($id)->delete();
        
        if(!$comment){
            return response([
                "code" => 404,
                "message"=> "Comment not found"
            ]);
        }

        return response([
            "code" => 200,
            "message" => "Comment deleted successfully"
        ]);
    }
    
    public function editComment(Request $req){

        $req->validate([
            "id" => "required",
        ]);
            
        $id = $req->id;
        $comment = $req->comment;

        $comment_data = Comment::find($id);
        
        $comment_data->comment = $comment;
        $comment_data->save();

        return response([
            "code" => 200,
            "message" => "comment updated successfully"
        ]);
    }
}
