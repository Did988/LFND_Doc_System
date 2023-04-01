<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class doc_inboundResource extends JsonResource
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
            'doc_Id' => $this->doc_Id,
            'title' => $this->title,
            'date' => $this->date,
            'from' => $this->from,
            'send_to' => $this->send_to,
            'file' => $this->file,
            'doc_Category_Id' => $this->doc_Category_Id
            
        ];
    }
}
