<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class outbound_detailResource extends JsonResource
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
            'outbound_Detail_Id' => $this->outbound_Detail_Id,
            'user_Id' => $this->user_Id,
            'send_to' => $this->send_to,
            'title' => $this->title,
            'note' => $this->note,
            'file' => $this->file,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at

        ];
    }
}
