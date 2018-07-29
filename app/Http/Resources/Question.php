<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Question extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
          'id' => $this->Id,
          'title' => $this->Title,
          'description' => $this->Description,
          'created_datetime' => $this->CreatedDateTime,
          'updated_datetime' => $this->UpdatedDateTime,
          'vote' => $this->Vote,
          'avatar_id' => $this->AvatarId
        ];
    }
}
