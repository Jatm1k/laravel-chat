<?php

namespace App\Http\Controllers;

use App\Events\AddedChat;
use App\Events\MessageSent;
use App\Http\Requests\SendMessageRequest;
use App\Http\Requests\StoreChatRequest;
use App\Models\Chat;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        if (auth()->check()) {
            return view('chats.index');
        } else {
            return redirect()->route('login');
        }
    }

    public function show(Chat $chat)
    {
        return view('chats.show', [
            'chat' => $chat
        ]);
    }

    public function getChats()
    {
        return Chat::query()->with([
            'first_user',
            'second_user',
            'messages' => function($query) {
                $query->latest();
            }
        ])
            ->where('first_user_id', auth()->id())
            ->orWhere('second_user_id', auth()->id())
            ->get();
    }

    public function messages(Chat $chat)
    {
        return $chat->messages()->with('user')->get();
//        return Message::query()->with('user')->where('chat_id')->get();
    }

    public function send(SendMessageRequest $request, Chat $chat)
    {
        $message = $request->user()->messages()->create([
            'chat_id' => $chat->id,
            'message' => $request->input('message')
        ]);

        broadcast(new MessageSent($request->user(), $message, $chat));

        return $message;
    }

    public function store(StoreChatRequest $request)
    {
        $user1 = auth()->user();
        $user2 = User::query()->where('email', $request->input('email'))->first();
        $chat = Chat::query()->with(['first_user', 'second_user'])->create([
            'first_user_id' => $user1->id,
            'second_user_id' => $user2->id,
        ]);

        broadcast(new AddedChat($user1, $user2, $chat));

        return $chat;
    }

    public function destroy(Chat $chat)
    {
        $chat->delete();
    }
}
