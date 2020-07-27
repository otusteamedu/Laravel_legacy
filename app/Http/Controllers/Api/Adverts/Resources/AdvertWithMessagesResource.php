<?php

namespace App\Http\Controllers\Api\Adverts\Resources;

use App\Models\Advert;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class AdvertResource
 * @package App\Http\Controllers\Api\Adverts\Resources
 * @mixin Advert
 */
class AdvertWithMessagesResource extends AdvertResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
       $data = parent::toArray($request);

       $owner = $this->user->name;
       $town = $this->town->name;
       $division = $this->division->name;

       $messages = $this->messages;

       $messagesData = [];
       foreach ($messages as $message) {
           $messagesData[] = ['userId' => $message->user_id, 'content' => $message->content];
       }

       $data['owner'] = $owner;
       $data['town'] = $town;
       $data['division'] = $division;
       $data['messages'] = $messagesData;

       return $data;


//        return  [
//            'id' => $this->id,
//            'title' => $this->title,
//        ];

    }
}
