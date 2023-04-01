<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class document_CategoryResource extends JsonResource
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
            'doc_Category_Id' => $this->doc_Category_Id,
            'category_Name' => $this->category_Name,

        ];
    }
}
