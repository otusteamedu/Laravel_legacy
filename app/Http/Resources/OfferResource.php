<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use phpDocumentor\Reflection\Project;

class OfferResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $project = \App\Models\Project::find($this->project_id);

        return [
            'type'          => 'offers',
            'id'            => (string)$this->id,
            'attributes'    => [
                'offer' => [
                    'name' => $this->name,
                    'description' => $this->description,
                    'teaser_image' => $this->teaser_image,
                    'expiration_date' => $this->expiration_date,
                    'project_id' => $this->project_id,
                    'city_id' => $this->city_id,
                    'lat' => $this->lat,
                    'lon' => $this->lon,
                    'created_at' => $this->created_at,
                    'updated_at' => $this->updated_at,
                    'author_id' => $this->author_id,
                    'category_id' => $this->category_id,
                    'promo_code' => $this->promo_code,
                ],
                'project' => [
                    'name' => $project->name,
                    'description' => $project->description,
                    'contact_data' => $project->contact_data,
                    'logo_path' => $project->logo_path,
                    'instagram' => $project->instagram,
                    'vk' => $project->vk,
                    'website' => $project->website,
                    'address1' => $project->address1,
                    'address2' => $project->address2,
                    'address3' => $project->address3,
                ],
            ],
            //'relationships' => new OfferRelationshipResource($this),
            'links'         => [
                'self' => route('offers.show', ['offer' => $this->id]),
            ],
        ];
    }
}
