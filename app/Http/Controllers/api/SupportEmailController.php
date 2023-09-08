<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ApiResource;
use App\Mail\SendSupportMail;
use App\Models\FAQ;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class SupportEmailController extends Controller
{
    public function index(Request  $request)
    {
        $validator = Validator::make($request->all(), [
            'message' => 'required|string',
            'email' => 'required|string|email|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $name = $request->get("name");
        $mail = $request->get("mail");
        $message = $request->get("message");

        Mail::to($request->email)->send(new SendSupportMail($name, $mail, $message));

        return response()->json([
            'message' => 'Mail envoyé.',
        ], 201);
    }
}
