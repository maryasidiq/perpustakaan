<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Chatbot;
use App\Models\Profile;
use Illuminate\Http\Request;

class ChatbotController extends Controller
{
    public function index(Request $request)
    {
        
        $iduser = auth()->id();
        $profile = Profile::where('users_id', $iduser)->first();
        return view('bot', ['profile' => $profile]);
    }

    public function bot(Request $request)
    {
        
        $reply = Chatbot::where('queries', $request->text)->first();
        if ($reply != null) {


            return response()->json([
                'message' => $reply->replies
            ]);
        } else {
            return response()->json([
                'message' => 'Sorry, I do not understand your question.'
            ]);
        }
    }
}
