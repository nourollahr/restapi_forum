<?php

namespace App\Http\Controllers\api;

use App\Models\Thread;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\api\Reply\StoreReplyRequest;

class ReplyController extends Controller
{
    public function store(StoreReplyRequest $request, Thread $thread)
    {
        $thread->addReply([
            'user_id' => auth()->id(),
            'body' => $request->body
        ]);

        return [
            'status' => true,
            'message' => trans('api.thread.add_reply')
        ];
    }

    public function update(UpdateReplyRequest $request, Reply $reply)
    {
        $this->authorize('update', $reply);

        $reply->update([
            'body' => $request->body
        ]);

        return [
            'status' => true,
            'message' => trans('api.reply.update_success')
        ];
    }

    public function destroy(Reply $reply)
    {
        $this->authorize('update', $reply);
        $reply->thread->decrement('replies_count');

        $reply->delete();

        return [
            'status' => true,
            'messages' => trans('api.reply.destroy_success')
        ];
    }
}
