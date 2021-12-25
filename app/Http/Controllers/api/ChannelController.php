<?php

namespace App\Http\Controllers\api;

use App\Models\Channel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\api\Channel\ChannelIndexResource;
use App\Http\Resources\api\Channel\ChannellThreadsResource;

class ChannelController extends Controller
{
    public function index()
    {
        $channels = Channel::paginate(5);

        return ChannelIndexResource::collection($channels);
    }

    public function threads(Channel $channel)
    {
        $threads = $channel->threads()->latest()->paginate(10);

        return ChannellThreadsResource::collection($threads);
    }
}
