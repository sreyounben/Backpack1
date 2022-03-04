<?php

namespace App\Http\Resources;

use Illuminate\Support\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return[
            'id'=> $this->id,
            'title'=>$this->title,
            'body'=>$this->body,
            'photos'=>$this->photos,
            'category_id'=>$this->category_id,
            'created_at'=> Carbon::parse($this->created_at)->format('D, M d, Y h:i A'),
            'updated_at' => Carbon::parse($this->updated_at)->format('d-m-Y h:i:s A'),
        ];

    }
}
