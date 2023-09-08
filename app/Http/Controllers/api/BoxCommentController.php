<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Box;
use App\Models\BoxComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BoxCommentController extends Controller
{
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'user' => 'required',
            'box' => 'required',
            'comment' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $comment = new BoxComment([
            'user' => $request->get('user'),
            'box' => $request->get('box'),
            'comment' => $request->get('comment'),
            'notation' => $request->get('notation'),
        ]);
        $comment->save();

        $box = Box::query()->find($request->get("box"));
        if ($box) {
            $box->notation = $box->notation + $request->get("notation");
            $box->notation_count = $box->notation_count + 1;
            $box->save();
        }

        return response()->json([
            'message' => 'Comment saved successfully.',
        ], 201);
    }
}
