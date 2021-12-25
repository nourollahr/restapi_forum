<?php

namespace App\Http\Resources\api\Reply;

use Illuminate\Http\Resources\Json\JsonResource;

class ShowReplyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     * @mixin Reply
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'user_id' => $this->user_id,
            'Body' => $this->Body
        ];
    }
}
