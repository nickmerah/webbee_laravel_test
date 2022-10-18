<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\ResourceCollection;

class EventsResource extends ResourceCollection
{
    
    public function toArray($request)
    {
        $events = array();
      foreach ($this->resource as $event) {

        $events[] = array(
            'name' => $event['name'],
            'created_at' => $event['created_at'],
            'updated_at' => $event['updated_at'],
            'workshops' => [
                'id' => $event['id'],
                'start' => $event['start'],
                'end' => $event['end'],
                'event_id' => $event['event_id'],
                'name' => $event['name'],
                'created_at' => $event['created_at'],
                'updated_at' => $event['updated_at'] 
            ]
        );
    }
    return $events;
    }
 }
 
