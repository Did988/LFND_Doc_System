<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class inbound_to_departResource extends JsonResource
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
            'inbound_to_Depart_Id' => $this->inbound_to_Depart_Id,
            'form_name' => $this->form_name,
            'send_to' => $this->send_to,
            'title' => $this->title,
            'comment' => $this->comment,
            'file' => $this->file,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            
        ];
    }
}
