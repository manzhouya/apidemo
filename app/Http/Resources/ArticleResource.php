<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class ArticleResource extends Resource
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
            'type' => 'article',
            'id'   => (string)$this->id,
            'attributes' => [
                'title' => $this->title,
                'content' => $this->body,
            ],
            'comments' => new ArticleCommentsResource($this->comments),
        ];
    }

    public function with($request)
    {
        return [
            'links'    => [
                'self' => url('api/articles/' . $this->id),
            ],
        ];
    }
}
