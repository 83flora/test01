<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\CommentsResource;
use App\Models\Comments;

class CommentsController extends Controller
{
    public function store(Request $request){
        $validator = Validator::make(
            $request->all(),
                [
                    'messages' => 'required',
                    'post_id' => 'required',
                ]
        );
        
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 403);
        } else {
            $params = $request->all();
            $comment = Comments::create([
                'messages' => $params['messages'],
                'post_id' => $params['post_id'],
            ]);

            return new CommentsResource($comment);
        }
    }
}
