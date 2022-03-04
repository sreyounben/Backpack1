<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class UserCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public $collects = Member::class;
    public function toArray($request)
    {
        return [
            'data' => $this->collection,
            'links' => [
            'self' => 'link-value',
            ],
        ];
    }
}
