<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {   
        return [
            'id'             => $this->id,
            'name'           => $this->name,
            'slug'           => $this->slug,
            'icon'           => $this->icon,
            'description'    => $this->description,
            'image_url'      => $this->image ? Storage::disk('public')->url($this->image) : null,
            'banner_url'     => $this->banner ? Storage::disk('public')->url($this->banner) : null,
            'order_priority' => $this->order_priority,
            'parent_id'      => $this->parent_id,
            
            // Safe conditional loading for nested relations
            'parent'   => new CategoryResource($this->whenLoaded('parent')),
            'children' => CategoryResource::collection($this->whenLoaded('children')),
        ];
    }
}