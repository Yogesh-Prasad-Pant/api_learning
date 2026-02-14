<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
                'id'         => $this->id,
                'name'       => $this->name,
                'email'      => $this->email,
                'role'       => $this->role,
                'status'     => $this->status,
                'address'    => $this->address,
                'contact_no' => $this->contact_no,
                'image'      => $this->image ? asset('storage/' . str_replace('\\', '/', $this->image)) : null,
                'created_at' => $this->created_at->format('Y-m-d'),
    
                // KYC Information
                'kyc_status'    => $this->kyc_status,
                'is_verified'   => (bool) $this->is_verified,
                'kyc_notes'     => $this->kyc_notes,
                'id_proof_type' => $this->id_proof_type,

                // Secure Document URLs
                'id_proof_url' => $this->id_proof_path
                    ? route('admin.kyc.view', ['id' => $this->id, 'type' => 'id_proof'])
                    : null,
    
                'business_license_url' => $this->business_license_path 
                    ? route('admin.kyc.view', ['id' => $this->id, 'type' => 'license'])
                    : null,

                'deleted_at' => $this->deleted_at ? $this->deleted_at->format('Y-m-d') : null,
            ];
    }
}
