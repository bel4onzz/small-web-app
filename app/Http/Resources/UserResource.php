<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => ucwords($this->name),
            'email' => $this->email,
            'phone' => $this->phone,
            'age' => $this->getAge($this->birth_date),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }

    private function getAge($birthDate){
        // Calculate age
        $age = Carbon::parse($birthDate)->diffInYears(Carbon::now());

        return $age;
    }
}
