<?php

namespace App\Http\Resources;

use Illuminate\Support\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ContactResource extends JsonResource
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
            'first_name'=> $this->first_name,
            'last_name'=> $this->last_name,
            'email'=> $this->email,
            'job_title'=> $this->job_title,
            'city'=> $this->city,
            'country'=>$this->country,
            'created_at'=> Carbon::parse($this->created_at)->format('D, M d, Y h:i A'),
            'updated_at' => Carbon::parse($this->updated_at)->format('d-m-Y h:i:s A'),

        ];
    }
}
