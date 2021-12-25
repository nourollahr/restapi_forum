<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reply;

class FavoriteController extends Controller
{
    public function store(Reply $reply)
    {
        $reply->favorite()->create([
            'user_id' => auth()->id(),
            'favorite_id' => $reply->id,
            'favorite_type' => Reply::class
        ]);

        return [
            'status' => true,
            'message' => trans('api.reply.add_favorite'),
        ];
    }
}
