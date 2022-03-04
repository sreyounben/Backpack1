<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return
        [
        'id'=> $this->id,
        'code'=> $this->code,
        'name'=> $this->name,
        'price'=> $this->price,
        'category_id'=> $this->category_id,
        'image'=> $this->image,
        'created_at'=> Carbon::parse($this->created_at)->format('D, M d, Y h:i A'),
        'updated_at' => Carbon::parse($this->updated_at)->format('d-m-Y h:i:s A'),
        ];
    }
}
