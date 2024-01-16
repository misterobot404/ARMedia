<?php

namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller as BaseController;

use Illuminate\Http\Request;
use App\Http\Requests\StoreMessageRequest;
use App\Models\Message;

class MessagesController extends BaseController
{
    public function index(Request $request)
    {
        return Message::all();
    }

    public function info($obj)
    {
        return Message::where('id', $obj)->first();
    }

    public function store(StoreMessageRequest $request)
    {
        $data = $request->validated();
        Message::create($data);
        return response()->json(['success' => true], 201);
    }

    public function update(StoreMessageRequest $request, Message $obj)
    {
        $data = $request->validated();
        $obj->update($data);
        return response()->json(['success' => true], 201);
    }

    public function destroy(Message $obj)
    {
        $obj->delete();
        return response()->json(['success' => true], 200);
    }

    public function user_messages(User $user) {
        $pool = [];
        $pool['incomes'] = $user->income_messages();
        $pool['outcomes'] = $user->outcome_messages();
        return $pool;
    }
}
