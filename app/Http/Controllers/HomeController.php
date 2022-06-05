<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;

class HomeController extends Controller
{
    public function homeView(){

        $topics = Topic::with(['user', 'comments'])->get();
        
        if (!$topics){
            return response([
                "code" => 404,
                "message" => "No topics for discussion right now"
            ]);
        }

        return response([
            "code" => 200,
            "message" => "success",
            "topics" => $topics,
        ]);
        
    }
}
