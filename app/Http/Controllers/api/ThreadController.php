<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Thread;
use App\Models\User;
use App\Http\Resources\api\ThreadIndexResource;
use App\Http\Requests\api\Thread\CreateThreadRequest;
use App\Http\Requests\api\Thread\ShowThreadRequest;
use App\Http\Resources\api\Thread\ShowThreadResource;
use App\Http\Resources\api\Thread\DestroyThreadRequest;

class ThreadController extends Controller
{
    public function index()
    {
        $threads = Thread::query();

        $by = request('by');
        $popular = request('popular');
        $unanswered = request('unanswered');

        if ($popular) {
            $threads = $threads->orderBy('replies_count', 'desc');
        } elseif ($by) {
            $user = User::where('name', $by)->firstOrFail();
            $threads = $threads->where('user_id', $user->id)->latest();
        } elseif ($unanswered) {
            $threads = $threads->where('replies_count', 0)->latest();
        } else {
            $threads = $threads->latest();
        }
        $threads = $threads->paginate(2);
        return ThreadIndexResource::collection($threads);
    }

    public function create(CreateThreadRequest $request)
    {
        /** @var User $user */
        $user = auth()->user();

        \Thread::create([
            'user_id' => $user->id,
            'channel_id' => $request->channel_id,
            'title' => $request->title,
            'body' => $request->body
        ]);

        return [
            'status' => true,
            'message' => trans('api.thread.create_success'),
        ];
    }

    public function show(ShowThreadRequest $request)
    {
        $thread = Thread::find($request->thread_id);
        return new ShowThreadResource($thread);
    }

    public function destroy(DestroyThreadRequest $request)
    {
        $thread = Thread::find($request->thread_id);

        $this->authorize('update', $thread);

        $thread->delete();

        return [
            'status' => true,
            'message' => trans('api.thread.destroy_success'),
        ];
    }
}
