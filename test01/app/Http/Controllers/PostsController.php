<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\PostsResource;
use App\Models\Posts;

class PostsController extends Controller
{
    public function store(Request $request){
        $validator = Validator::make(
            $request->all(),
                [
                    'title' => 'required',
                    'content' => 'required',
                ]
        );
        
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 403);
        } else {
            $params = $request->all();
            $post = Posts::create([
                'title' => $params['title'],
                'content' => $params['content'],
            ]);

            return new PostsResource($post);
        }
    }
}
