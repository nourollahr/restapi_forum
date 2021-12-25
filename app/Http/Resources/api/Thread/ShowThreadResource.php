<?php

namespace App\Http\Resources\api\Thread;

use App\Http\Resources\api\Reply\ShowReplyResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowThreadResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'channel_name' => $this->channel->name,
            'title' => $this->title,
            'body' => $this->body,
            'replies' => ShowReplyResource::collection($this->replies),
        ];
    }
}
