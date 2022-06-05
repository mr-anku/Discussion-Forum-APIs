<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;

class TopicController extends Controller
{
    public function createTopic(Request $req){

        $req->validate([
            "title" => "required",  
            "user_id" => "required",
            "type" => "required"
        ]);

        $title = $req->title;
        $about = $req->about;
        $user = $req->user_id;
        $type = $req->type;

        $topic = Topic::create(['title'=> $title, 'about'=> $about, 'user_id'=> $user, 'type' => $type]);

        return response([
            "code" => 200,
            "message" => "topic created successfully",
            "topic" => $topic
        ]);
    }   

    public function removeTopic(Request $req){

        $req->validate([
            "id" => "required",
        ]);

        $id = $req->id;
        $topic = Topic::find($id)->delete();

        if(!$topic){
            return response([
                "code" => 404,
                "message"=> "Topic not found"
            ]);
        }

        return response([
            "code" => 200,
            "message" => "topic deleted successfully"
        ]);
    }

    public function findTopic(Request $req){
        
        $req->validate([
            "topic_id" => "required"
        ]);

        $topic_id = $req->topic_id;
        $topic = Topic::where(["id" => $topic_id])->with(['user', 'comments'])->first();

        if (!$topic){
            return response([
                "code" => 404,
                "message" => "topic not found"
            ]);
        }

        return response([
            "code" => 200,
            "message" => "topic found successfully",
            "topic" => $topic
        ]);
    }
        
    public function editTopic(Request $req){

        $req->validate([
            "id" => "required"       
        ]);
        
        $id = $req->id;
        $title = $req->title;
        $about = $req->about;

        $topic = Topic::find($id);

        if (!$topic){
            return response([
                "code" => 404,
                "message" => "topic not found"
            ]);
        }

        $topic->title = $title;
        $topic->about = $about;
        $topic->save();

        return response([
            "code" => 200,
            "message" => "topic updated successfully"
        ]);
    }
}
