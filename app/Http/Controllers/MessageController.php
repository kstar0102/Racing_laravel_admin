<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\MessageEvent;

class MessageController extends Controller
{
    //
    public function send(Request $request)
    {
        broadcast(new MessageEvent($request->message));
        return response()->json(['result'], 200);
    }
}
