<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ReplyResource;
class QuestionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'title' => $this->title,
            'path' => $this->path,
            'body' => $this->body,
            'created_at' => $this->created_at->diffForHumans(),
            'user' => $this->user->name,
            'user_id'   => $this->user_id,
            'slug'      => $this->slug,
            'replies'   => ReplyResource::collection($this->replies),
            'replies_count' => $this->replies->count()
        ];
    }
}
