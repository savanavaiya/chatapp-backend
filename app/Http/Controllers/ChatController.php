<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Pusher\Pusher;

class ChatController extends Controller
{
    public function sendMessage(Request $request)
    {
        // event(new MessageSent('hello world'));

        // $message = 'Hi There';
        // event(new MessageSent($message));


        // $message = 'Hi here';
        // event(new \App\Events\MessageSent($message));
        // return ['status' => 'Message Sent!'];

        // $user = User::find('1');
        // // $user = Auth::login($ur);
        // // dd($user);
        // $message = 'Hi There';

        // broadcast(new MessageSent($user, $message))->toOthers();

        // return ['status' => 'Message Sent!'];

        // broadcast(new MessageSent('hello world'))->toOthers();

        // return ['status' => 'Message Sent!'];

        $options = [
            'cluster' => env('PUSHER_CLUSTER'),
            'useTLS' => true
        ];
        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

        $response = $pusher->trigger('my-channel', 'my-event', ['message' => 'Hello, This is my first real time message']);

        return ['status' => 'Message Sent!'];
    }
}
