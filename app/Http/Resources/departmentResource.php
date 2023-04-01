<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class departmentResource extends JsonResource
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
            'depart_Id' => $this->depart_Id,
            'department_Name' => $this->department_Name,
            
        ];
    }
}
