<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Thread;
use App\Models\User;
use App\Http\Resources\api\ThreadIndexResource;

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
}
