<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class doc_outboundResource extends JsonResource
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
            'outbound_Detail_Id ' => $this->outbound_Detail_Id ,
            'doc_Category_Id ' => $this->doc_Category_Id ,
            'user_Id ' => $this->user_Id ,
            'title' => $this->title,
            'doc_C_Id' => $this->doc_C_Id,
            'date' => $this->date,
            'from' => $this->from,
            'send_to' => $this->send_to,
            'doc_quantity' => $this->doc_quantity,
            'doc_purpose' => $this->doc_purpose,
            'file' => $this->file
        ];
    }
}
